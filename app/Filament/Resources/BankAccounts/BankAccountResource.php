<?php

namespace App\Filament\Resources\BankAccounts;

use App\Enum\BankAccountType;
use App\Filament\Resources\BankAccounts\Pages\ManageBankAccounts;
use App\Models\BankAccount;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use BackedEnum;

class BankAccountResource extends Resource
{
    protected static ?string $model = BankAccount::class;
    protected static ?string $navigationLabel = 'Contas bancárias';
    protected static ?string $modelLabel = 'Conta bancária';
    protected static ?string $pluralModelLabel = 'Contas bancárias';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingLibrary;
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nome da conta')
                    ->placeholder('Ex: Nubank, Banco do Brasil, Carteira')
                    ->helperText('Use um nome fácil de identificar esta conta')
                    ->required(),
                Select::make('type')
                    ->label('Tipo de conta')
                    ->options(fn() => collect(BankAccountType::cases())
                        ->mapWithKeys(fn($case) => [$case->value => $case->label()])
                        ->toArray())
                    ->default(BankAccountType::Checking->value)
                    ->helperText('Escolha o tipo que melhor representa esta conta')
                    ->required(),
                TextInput::make('balance')
                    ->label('Saldo inicial')
                    ->numeric()
                    ->default(0)
                    ->prefix('R$')
                    ->helperText('Informe o saldo atual desta conta')
                    ->required(),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('Nome da conta')
                    ->weight('bold'),
                TextEntry::make('user.name')
                    ->label('Usuário')
                    ->placeholder('—'),
                TextEntry::make('type')
                    ->label('Tipo de conta')
                    ->badge()
                    ->color(fn($state) => match ($state->value) {
                        'checking' => 'success',
                        'savings' => 'info',
                        'credit' => 'warning',
                        default => 'secondary',
                    })
                    ->formatStateUsing(fn($state) => $state->label()),
                TextEntry::make('balance')
                    ->label('Saldo atual')
                    ->money('BRL', locale: 'pt_BR'),
                RepeatableEntry::make('recent_expenses')
                    ->label('Últimas transações')
                    ->schema([
                        TextEntry::make('title')
                            ->label('Descrição')
                            ->limit(30)
                            ->weight('medium'),
                        TextEntry::make('type')
                            ->label('Tipo')
                            ->badge()
                            ->color(fn($state) => $state === 'income' ? 'success' : 'danger')
                            ->formatStateUsing(fn($state) => $state === 'income' ? 'Entrada' : 'Saída'),
                        TextEntry::make('amount')
                            ->label('Valor')
                            ->money('BRL', locale: 'pt_BR'),
                        TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn($state) => match ($state) {
                                'paid' => 'success',
                                'pending' => 'warning',
                                'overdue' => 'danger',
                                default => 'gray',
                            })
                            ->formatStateUsing(fn($state) => match ($state) {
                                'paid' => 'Pago',
                                'pending' => 'Pendente',
                                'overdue' => 'Em atraso',
                                default => '—',
                            }),
                        TextEntry::make('payment_date')
                            ->label('Data de pagamento')
                            ->date('d/m/Y')
                            ->placeholder('—'),
                    ])
                    ->columns(5)
                    ->state(fn($record) =>
                        $record
                            ->expenses()
                            ->latest('payment_date')
                            ->take(10)
                            ->get()
                            ->toArray())
                    ->visible(fn($record) => $record->expenses()->exists())
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('—'),
                TextEntry::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('—'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')  // campo real do model
            ->columns([
                // TextColumn::make('user.name')
                //     ->label('Usuário')
                //     ->searchable()
                //     ->sortable(),
                TextColumn::make('name')
                    ->label('Nome da conta')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('type')
                    ->label('Tipo de conta')
                    ->badge()
                    ->color(fn($state) => match ($state->value) {
                        'checking' => 'success',
                        'savings' => 'info',
                        'credit' => 'warning',
                        default => 'secondary',
                    })
                    ->formatStateUsing(fn($state) => $state->label())
                    ->sortable(),
                // TextColumn::make('balance')
                //     ->label('Saldo atual')
                //     ->sortable()
                //     ->alignRight()
                //     ->money('BRL', locale: 'pt_BR'),
                TextColumn::make('created_at')
                    ->label('Criada em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Atualizada em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // aqui você pode adicionar filtros por tipo, saldo, usuário, etc.
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('Visualizar'),
                EditAction::make()
                    ->label('Editar'),
                DeleteAction::make()
                    ->label('Excluir'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Excluir selecionadas'),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageBankAccounts::route('/'),
        ];
    }
}
