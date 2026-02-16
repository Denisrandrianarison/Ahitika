<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationLabel = 'Commandes';

    protected static ?string $modelLabel = 'Commande';

    protected static ?string $pluralModelLabel = 'Commandes';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations commande')
                    ->schema([
                        Forms\Components\TextInput::make('numero')
                            ->disabled()
                            ->label('Numéro de commande'),
                        Forms\Components\Select::make('statut')
                            ->options([
                                'en_attente' => 'En attente',
                                'en_preparation' => 'En préparation',
                                'en_livraison' => 'En livraison',
                                'livree' => 'Livrée',
                            ])
                            ->required()
                            ->label('Statut'),
                        Forms\Components\TextInput::make('total')
                            ->disabled()
                            ->suffix('Ar')
                            ->label('Total'),
                    ])->columns(3),
                Forms\Components\Section::make('Informations client')
                    ->schema([
                        Forms\Components\TextInput::make('client_nom')
                            ->disabled()
                            ->label('Nom du client'),
                        Forms\Components\TextInput::make('client_tel')
                            ->disabled()
                            ->label('Téléphone'),
                        Forms\Components\Textarea::make('adresse')
                            ->disabled()
                            ->label('Adresse de livraison')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('numero')
                    ->searchable()
                    ->sortable()
                    ->label('N° Commande'),
                Tables\Columns\TextColumn::make('client_nom')
                    ->searchable()
                    ->label('Client'),
                Tables\Columns\TextColumn::make('client_tel')
                    ->searchable()
                    ->label('Téléphone'),
                Tables\Columns\TextColumn::make('total')
                    ->numeric()
                    ->sortable()
                    ->suffix(' Ar')
                    ->label('Total'),
                Tables\Columns\TextColumn::make('statut')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'en_attente' => 'En attente',
                        'en_preparation' => 'En préparation',
                        'en_livraison' => 'En livraison',
                        'livree' => 'Livrée',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'en_attente' => 'warning',
                        'en_preparation' => 'info',
                        'en_livraison' => 'primary',
                        'livree' => 'success',
                        default => 'gray',
                    })
                    ->label('Statut'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->label('Date'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('statut')
                    ->options([
                        'en_attente' => 'En attente',
                        'en_preparation' => 'En préparation',
                        'en_livraison' => 'En livraison',
                        'livree' => 'Livrée',
                    ])
                    ->label('Statut'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
