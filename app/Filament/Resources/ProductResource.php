<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Produits';

    protected static ?string $modelLabel = 'Produit';

    protected static ?string $pluralModelLabel = 'Produits';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations générales')
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'nom')
                            ->required()
                            ->label('Catégorie')
                            ->searchable()
                            ->preload(),
                        Forms\Components\TextInput::make('nom')
                            ->required()
                            ->maxLength(191)
                            ->label('Nom du produit')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(191)
                            ->unique(ignoreRecord: true),
                        Forms\Components\RichEditor::make('description')
                            ->columnSpanFull()
                            ->label('Description'),
                    ])->columns(2),
                Forms\Components\Section::make('Prix et Stock')
                    ->schema([
                        Forms\Components\TextInput::make('prix')
                            ->required()
                            ->numeric()
                            ->suffix('Ar')
                            ->label('Prix (Ariary)'),
                        Forms\Components\TextInput::make('stock')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->label('Quantité en stock')
                            ->helperText('Badge "Stock limité" si ≤ 5'),
                        Forms\Components\Toggle::make('actif')
                            ->default(true)
                            ->label('Produit actif'),
                        Forms\Components\Toggle::make('is_nouveau')
                            ->default(false)
                            ->label('Marquer comme Nouveauté')
                            ->helperText('Affiche le badge "Nouveau" sur le produit'),
                    ])->columns(2),
                Forms\Components\Section::make('Images')
                    ->schema([
                        Forms\Components\FileUpload::make('images')
                            ->multiple()
                            ->image()
                            ->disk('public')
                            ->directory('products')
                            ->reorderable()
                            ->visibility('public')
                            ->label('Images du produit'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('images')
                    ->disk('public')
                    ->circular()
                    ->stacked()
                    ->limit(1)
                    ->label('Image'),
                Tables\Columns\TextColumn::make('nom')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.nom')
                    ->sortable()
                    ->label('Catégorie'),
                Tables\Columns\TextColumn::make('prix')
                    ->numeric()
                    ->sortable()
                    ->suffix(' Ar')
                    ->label('Prix'),
                Tables\Columns\TextColumn::make('stock')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color(fn (int $state): string => match(true) {
                        $state <= 0 => 'danger',
                        $state <= 5 => 'warning',
                        default => 'success',
                    }),
                Tables\Columns\IconColumn::make('actif')
                    ->boolean()
                    ->label('Actif'),
                Tables\Columns\IconColumn::make('is_nouveau')
                    ->boolean()
                    ->label('Nouveauté')
                    ->trueIcon('heroicon-o-sparkles')
                    ->falseIcon('heroicon-o-minus')
                    ->trueColor('success')
                    ->falseColor('gray'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'nom')
                    ->label('Catégorie'),
                Tables\Filters\TernaryFilter::make('actif')
                    ->label('Statut'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
