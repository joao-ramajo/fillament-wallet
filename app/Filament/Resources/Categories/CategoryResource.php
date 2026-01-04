<?php

namespace App\Filament\Resources\Categories;

use App\Filament\Resources\Categories\Pages\ManageCategories;
use App\Filament\Resources\Categories\Widgets\ExpensesByCategory;
use App\Models\Category;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use BackedEnum;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Categorias';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nome da categoria')
                    ->placeholder('Ex: Alimentação, Aluguel, Transporte')
                    ->required(),
                Hidden::make('user_id')
                    ->default(fn() => Auth::id()),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('Nome da categoria'),
                TextEntry::make('created_at')
                    ->label('Criada em')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('—'),
                TextEntry::make('updated_at')
                    ->label('Última atualização')
                    ->dateTime('d/m/Y H:i')
                    ->placeholder('—'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->label('Categoria')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Criada em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Última atualização')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                ViewAction::make()
                    ->label('Visualizar'),
                EditAction::make()
                    ->label('Editar'),
                DeleteAction::make()
                    ->label('Excluir'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('Excluir selecionadas'),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageCategories::route('/'),
        ];
    }
}
