<?php

namespace App\Filament\Resources\Expenses;

use App\Action\ImportCsvData;
use App\Filament\Resources\Expenses\Pages\ManageExpenses;
use App\Models\BankAccount;
use App\Models\Expense;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use BackedEnum;

class ExpenseResource extends Resource
{
    protected static ?string $model = Expense::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBanknotes;
    protected static ?string $recordTitleAttribute = 'expense';
    protected static ?string $navigationLabel = 'Finanças';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Main Section - Basic Information
                Section::make('Informações Básicas')
                    ->description('Detalhes sobre a transação.')
                    ->schema([
                        // Type - First to influence other fields
                        ToggleButtons::make('type')
                            ->label('Tipo')
                            ->options([
                                'expense' => 'Despesa',
                                'income' => 'Entrada'
                            ])
                            ->icons([
                                'expense' => 'heroicon-o-arrow-trending-down',
                                'income' => 'heroicon-o-arrow-trending-up'
                            ])
                            ->colors([
                                'expense' => 'danger',
                                'income' => 'success'
                            ])
                            ->inline()
                            ->default('expense')
                            ->required()
                            ->live(),
                        TextInput::make('title')
                            ->label('Descrição')
                            ->placeholder('Ex: Conta de Luz, Salário, Mercado...')
                            ->required()
                            ->maxLength(255)
                            ->autocomplete('off'),
                        TextInput::make('amount')
                            ->label('Valor (R$)')
                            ->numeric()
                            ->prefix('R$')
                            ->inputMode('decimal')
                            ->placeholder('0.00')
                            ->required()
                            ->minValue(0.01)
                            ->step(0.01)
                            ->helperText('Use ponto (.) como separador decimal.'),
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'paid' => 'Pago',
                                'pending' => 'Pendente',
                                'overdue' => 'Atrasado'
                            ])
                            ->default('pending')
                            ->required()
                            ->native(false)
                            ->live(),
                    ]),
                // Categorization Section
                Section::make('Categorização')
                    ->description('Organize suas contas separando por categoria adequada.')
                    ->schema([
                        Select::make('category_id')
                            ->label('Categoria')
                            ->options(fn() => \App\Models\Category::query()
                                ->where(function ($query) {
                                    $query
                                        ->where('user_id', Auth::id())
                                        ->orWhereNull('user_id');
                                })
                                ->orderBy('name')
                                ->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->native(false)
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label('Nome de Categoria')
                                    ->required(),
                            ])
                            ->createOptionModalHeading('New Category')
                            ->placeholder('Selecione ou crie uma nova categoria')
                            ->helperText('Categorias ajudam a organizar seus gastos.'),
                        Select::make('bank_account_id')
                            ->label('Conta Bancária')
                            ->options(fn() => BankAccount::query()
                                ->where('user_id', Auth::id())
                                ->orderBy('name')
                                ->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->native(false)
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label('Nome do banco')
                                    ->required()
                                    ->placeholder('Ex: Nubank, Itaú...'),
                                TextInput::make('initial_balance')
                                    ->label('Saldo esperado')
                                    ->numeric()
                                    ->prefix('R$')
                                    ->default(0)
                            ])
                            ->createOptionModalHeading('New Bank Account')
                            ->placeholder('Selecione um banco (opcional)')
                            ->helperText('Indique a conta bancária à qual este lançamento pertence para um melhor controle financeiro.'),
                    ])
                    ->collapsible(),
                // Dates Section - Conditional and Intelligent
                Section::make('Datas')
                    ->description('Informe as datas de pagamento e vencimento para melhor controle')
                    ->schema([
                        DatePicker::make('payment_date')
                            ->label(fn(Get $get) =>
                                $get('status') === 'paid'
                                    ? 'Data de pagamento'
                                    : 'Data de vencimento')
                            ->displayFormat('d/m/Y')
                            ->format('Y-m-d')
                            ->native(false)
                            ->closeOnDateSelection()
                            ->default(now())
                            ->helperText(fn(Get $get) =>
                                $get('status') === 'paid'
                                    ? 'Data de quando o pagamento foi efetuado.'
                                    : 'Data de vencimento.')
                            ->visible(fn(Get $get) =>
                                in_array($get('status'), ['paid', 'pending'])),
                        DatePicker::make('due_date')
                            ->label('Data de vencimento')
                            ->displayFormat('d/m/Y')
                            ->format('Y-m-d')
                            ->native(false)
                            ->closeOnDateSelection()
                            ->helperText('When the bill is due')
                            ->visible(fn(Get $get) =>
                                $get('type') === 'expense' &&
                                in_array($get('status'), ['pending', 'overdue']))
                            ->nullable(),
                    ])
                    ->collapsible()
                    ->collapsed(),
                // Hidden field for user_id
                Hidden::make('user_id')
                    ->default(fn() => Auth::id())
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title')
                    ->label('Title')
                    ->icon('heroicon-o-document-text')
                    ->weight('bold'),
                TextEntry::make('amount')
                    ->label('Amount')
                    ->numeric()
                    ->icon('heroicon-o-currency-dollar')
                    ->color(fn($record) => $record->type === 'income' ? 'success' : 'gray')
                    ->formatStateUsing(fn($state) => '$' . number_format($state, 2, '.', ',')),
                TextEntry::make('type')
                    ->label('Type')
                    ->badge()
                    ->color(fn($state) => $state === 'income' ? 'success' : 'gray')
                    ->formatStateUsing(fn($state) => $state === 'income' ? 'Income' : 'Expense'),
                TextEntry::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'paid' => 'success',
                        'pending' => 'warning',
                        'overdue' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn($state) => ucfirst($state)),
                TextEntry::make('bankAccount.name')
                    ->label('Bank Account')
                    ->icon('heroicon-o-building-office')
                    ->placeholder('—'),
                TextEntry::make('payment_date')
                    ->label('Payment Date')
                    ->date('m/d/Y H:i')
                    ->icon('heroicon-o-calendar')
                    ->placeholder('—'),
                TextEntry::make('due_date')
                    ->label('Due Date')
                    ->icon('heroicon-o-clock')
                    ->date('m/d/Y')
                    ->color(fn($record) =>
                        $record->due_date
                            ? ($record->due_date->isPast() && $record->status !== 'paid'
                                ? 'danger'
                                : 'gray')
                            : 'gray')
                    ->placeholder('—'),
                TextEntry::make('created_at')
                    ->label('Created At')
                    ->dateTime('m/d/Y H:i:s')
                    ->icon('heroicon-o-calendar-days')
                    ->placeholder('—'),
                TextEntry::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('m/d/Y H:i:s')
                    ->icon('heroicon-o-arrow-path')
                    ->placeholder('—'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->striped()
            ->recordTitleAttribute('Expenses')
            ->columns([
                TextColumn::make('title')
                    ->label('Título')
                    ->searchable(),
                TextColumn::make('amount')
                    ->label('Valor')
                    ->sortable()
                    ->alignment('left')
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
                    ->label('Tipo')
                    ->badge()
                    ->sortable()
                    ->colors([
                        'info' => 'income',
                        'gray' => 'expense',
                    ]),
                TextColumn::make('category.name')
                    ->label('Categoria')
                    ->badge()
                    ->color('info')
                    ->placeholder('Sem categoria')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('bankAccount.name')
                    ->label('Banco')
                    ->formatStateUsing(function ($state) {
                        $lower = strtolower($state);
                        $icon = match (true) {
                            str_contains($lower, 'picpay') => '/images/banks/picpay.png',
                            str_contains($lower, 'inter') => '/images/banks/inter.png',
                            str_contains($lower, 'next') => '/images/banks/next.png',
                            str_contains($lower, 'bradesco') => '/images/banks/bradesco.png',
                            str_contains($lower, 'itau') => '/images/banks/itau.png',
                            str_contains($lower, 'santander') => '/images/banks/santander.png',
                            default => '/images/banks/next.png',
                        };

                        return "<img src='{$icon}' alt='' style='height:20px;width:20px;display:block;margin:auto;border-radius:4px;margin-left:6px;'>";
                    })
                    ->width(60)
                    ->alignCenter()
                    ->tooltip(fn($state) => $state)
                    ->html()  // importante para renderizar o <img>
                    ->sortable(),
                TextColumn::make('payment_date')
                    ->label('Vencimento')
                    ->date('d/m/Y')
                    ->sortable(query: function ($query, $direction) {
                        $query->orderBy('payment_date', $direction);
                    })
                    ->color(fn($record) =>
                        $record->status === 'paid'
                            ? 'success'
                            : ($record->payment_date && $record->payment_date->isPast() ? 'danger' : 'gray'))
                    ->tooltip(fn($record) =>
                        $record->payment_date
                            ? 'Pago em ' . $record->payment_date->format('d/m/Y')
                            : '-'),
                TextColumn::make('created_at')
                    ->label('Registrado em')
                    ->dateTime()
                    ->date('d/m/Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Atualizado em')
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
                        'paid' => 'Pago',
                        'pending' => 'Pendente',
                        'overdue' => 'Vencida',
                    ])
                    ->attribute('status'),
                SelectFilter::make('type')
                    ->multiple()
                    ->options([
                        'income' => 'Entrada',
                        'expense' => 'Saída',
                    ])
                    ->attribute('type'),
                Filter::make('month')
                    ->form([
                        DatePicker::make('from')->label('From'),
                        DatePicker::make('to')->label('To'),
                    ])
                    ->query(fn($query, array $data) =>
                        $query
                            ->when($data['from'], fn($q, $date) => $q->whereDate('payment_date', '>=', $date))
                            ->when($data['to'], fn($q, $date) => $q->whereDate('payment_date', '<=', $date)))
            ])
            ->deferFilters(false)
            ->recordActions([
                ActionGroup::make([
                    Action::make('paid')
                        ->color('success')
                        ->icon('heroicon-o-banknotes')
                        ->tooltip('Marcar conta como paga')
                        ->label('Marcar como pago')
                        ->requiresConfirmation()
                        ->visible(fn(Expense $record): bool => in_array($record->status, ['pending', 'overdue']))
                        ->action(fn(Expense $record) => $record->update(['status' => 'paid'])),
                    ViewAction::make()
                        ->label('Detalhes')
                        ->tooltip('Ver mais detalhes sobre a conta')
                        ->icon('heroicon-o-eye')
                        ->color('gray'),
                    EditAction::make()
                        ->label('Editar')
                        ->tooltip('Editar conta')
                        ->icon('heroicon-o-pencil-square')
                        ->color('warning'),
                    DeleteAction::make()
                        ->label('Apagar')
                        ->tooltip('Apagar registro de conta')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->requiresConfirmation(),
                ])->dropdownPlacement('top-start')
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
                Action::make('import')
                    ->label('Importar')
                    ->icon('heroicon-o-arrow-up-tray')
                    ->modalHeading('Importar dados')
                    ->modalDescription('Importe seus dados a partir de uma planilha. Somente planilhas geradas pelo Filament Wallet serão importadas corretamente.')
                    ->modalWidth('md')
                    ->form([
                        \Filament\Forms\Components\FileUpload::make('csv_file')
                            ->label('Arquivo CSV')
                            ->acceptedFileTypes(['text/csv', 'application/csv'])
                            ->required()
                            ->helperText('Selecione uma planilha CSV válida gerada pelo Filament Wallet.')
                            ->disk('local')  // Importante definir o disco
                            ->directory('imports'),  // Diretório temporário
                    ])
                    ->action(function (array $data) {
                        $file = $data['csv_file'];

                        $path = storage_path('app/private/' . $file);

                        $uploadedFile = new \Illuminate\Http\UploadedFile(
                            $path,
                            basename($file),
                            'text/csv',
                            null,
                            true
                        );

                        $importer = new ImportCsvData();
                        $valid = $importer->execute($uploadedFile);

                        if ($valid) {
                            \Filament\Notifications\Notification::make()
                                ->title('Dados importados com sucesso')
                                ->success()
                                ->duration(6000)
                                ->send();
                        } else {
                            \Filament\Notifications\Notification::make()
                                ->title('Houve um erro ao tentar importar os dados')
                                ->danger()
                                ->duration(6000)
                                ->send();
                        }

                        // Limpar arquivo temporário
                        Storage::disk('local')->delete($file);
                    })
                    ->color('gray'),
                Action::make('export')
                    ->label('Exportar')
                    ->color('primary')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->modalHeading('Exportar finanças')
                    ->modalSubheading('Selecione o tipo de arquivo desejado')
                    ->modalWidth('md')
                    ->form([
                        Select::make('type')
                            ->label('Tipos')
                            ->options([
                                'csv' => 'CSV',
                                'xlsx' => 'XLSX',
                            ])
                            ->required(),
                    ])
                    ->action(function (array $data) {
                        return redirect()->route('web.export', ['type' => $data['type']]);
                    }),
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
        return [];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('expenses.user_id', Auth::id());
    }
}
