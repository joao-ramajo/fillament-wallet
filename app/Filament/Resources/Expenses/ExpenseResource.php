<?php

namespace App\Filament\Resources\Expenses;

use App\Filament\Resources\Expenses\Pages\ManageExpenses;
use App\Filament\Resources\Expenses\Widgets\MyWidget;
use App\Filament\Resources\Expenses\Widgets\TotalExpensesOverview;
use App\Models\BankAccount;
use App\Models\Expense;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use BackedEnum;

class ExpenseResource extends Resource
{
    protected static ?string $model = Expense::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Expenses';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('amount')
                    ->label('Valor (R$)')
                    ->numeric()
                    ->step('0.01')
                    ->inputMode('decimal')
                    ->placeholder('0,00')
                    ->required(),
                Select::make('status')
                    ->options(['paid' => 'Paid', 'overdue' => 'Overdue', 'pending' => 'Pending'])
                    ->default('pending')
                    ->required(),
                Select::make('type')
                    ->options(['expense' => 'Expense', 'income' => 'Income'])
                    ->default('expense')
                    ->required(),
                DateTimePicker::make('payment_date')
                    ->label('Payment Date')
                    ->displayFormat('d/m/Y H:i:s')
                    ->format('Y-m-d H:i:s')
                    ->timezone('America/Sao_Paulo')
                    ->default(now())
                    ->native(false)
                    ->seconds(false)
                    ->nullable(),
                Select::make('bank_account_id')
                    ->label('Bank Account')
                    ->options(fn() => BankAccount::query()
                        ->where('user_id', Auth::id())
                        ->orderBy('name')
                        ->pluck('name', 'id'))
                    ->nullable()
                    ->required(false),
                Hidden::make('user_id')
                    ->default(fn() => Auth::id())
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title'),
                TextEntry::make('amount')
                    ->label('Valor')
                    ->numeric()
                    ->formatStateUsing(fn($state) => 'R$ ' . number_format($state, 2, ',', '.')),
                TextEntry::make('status')
                    ->badge(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Expenses')
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('amount')
                    ->label('Value')
                    ->sortable()
                    ->alignment('right')
                    ->formatStateUsing(fn($state, $record, $livewire) =>
                        $livewire->hideValues
                            ? '???'
                            : 'R$ ' . number_format($state, 2, ',', '.')),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->sortable()
                    ->colors([
                        'success' => 'paid',
                        'danger' => 'overdue',
                        'warning' => 'pending',
                    ])
                    ->formatStateUsing(fn(string $state) => ucfirst($state)),
                TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->sortable()
                    ->colors([
                        'info' => 'income',
                        'gray' => 'expense',
                    ]),
                TextColumn::make('bankAccount.name')
                    ->label('Bank Account')
                    ->sortable(),
                TextColumn::make('payment_date')
                    ->label('Payment Date')
                    ->date('d/m/Y H:i:s')
                    ->sortable()
                    ->color(fn($record) =>
                        $record->status === 'paid'
                            ? 'success'
                            : ($record->payment_date && $record->payment_date->isPast() ? 'danger' : 'gray'))
                    ->tooltip(fn($record) =>
                        $record->payment_date
                            ? 'Due on ' . $record->payment_date->format('d/m/Y')
                            : 'No date set'),
                TextColumn::make('created_at')
                    ->label('Register at    ')
                    ->dateTime()
                    ->date('d/m/Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('payment_date')
                    ->form([
                        DatePicker::make('date')
                            ->label('Data de Pagamento')
                            ->displayFormat('d/m/Y')  // mostra no formato brasileiro no formulário
                            ->native(false)  // usa o calendário do Filament/Flatpickr (não o nativo do navegador)
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['date'],
                                fn($query, $date) => $query->whereDate('payment_date', $date)
                            );
                    }),
                SelectFilter::make('status')
                    ->multiple()
                    ->options([
                        'paid' => 'paid',
                        'pending' => 'pending',
                        'overdue' => 'overdue',
                    ])
                    ->attribute('status'),
                SelectFilter::make('type')
                    ->multiple()
                    ->options([
                        'income' => 'income',
                        'expense' => 'expense',
                    ])
                    ->attribute('type'),
            ])
            ->deferFilters(false)
            ->recordActions([
                ActionGroup::make([
                    Action::make('paid')
                        ->color('success')
                        ->icon('heroicon-o-banknotes')
                        // ->button()
                        ->tooltip('mark as paid')
                        // ->outlined()
                        ->label('Mark as paid')
                        ->requiresConfirmation()
                        ->visible(fn(Expense $record): bool => in_array($record->status, ['pending', 'overdue']))
                        ->action(fn(Expense $record) => $record->update(['status' => 'paid'])),
                    ViewAction::make()
                        ->label('View expense')
                        ->tooltip('View')
                        ->icon('heroicon-o-eye')
                        ->color('gray'),
                    EditAction::make()
                        ->label('Edit expense')
                        ->tooltip('Edit')
                        ->icon('heroicon-o-pencil-square')
                        ->color('warning'),
                    DeleteAction::make()
                        ->label('Delete expense')
                        ->tooltip('Delete')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->requiresConfirmation(),
                ])->dropdownPlacement('top-start')
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageExpenses::route('/'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            // TotalExpensesOverview::class,
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', Auth::id());
        // ou: ->whereBelongsTo(Auth::user());
    }
}
