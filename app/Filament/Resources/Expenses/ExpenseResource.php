<?php

namespace App\Filament\Resources\Expenses;

use App\Filament\Resources\Expenses\Pages\ManageExpenses;
use App\Filament\Resources\Expenses\Widgets\MyWidget;
use App\Filament\Resources\Expenses\Widgets\TotalExpensesOverview;
use App\Models\Expense;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
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
                DatePicker::make('payment_date')
                    ->label('Data de Pagamento')
                    ->default(now())
                    ->displayFormat('d/m/Y')  // mostra no formato brasileiro no formulário
                    ->format('Y-m-d')  // salva no formato padrão do banco
                    ->native(false)  // usa o calendário do Filament/Flatpickr (não o nativo do navegador)
                    ->nullable(),
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
                            : 'R$ ' . number_format($state, 2, ',', '.')
            ),
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
                TextColumn::make('payment_date')
                    ->label('Payment Date')
                    ->date('d/m/Y')
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
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
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
