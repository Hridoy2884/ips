<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;

use function Laravel\Prompts\textarea;

class AddressRelationManager extends RelationManager
{
    protected static string $relationship ='address';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
             TextInput::make('first_name')
                ->required()
                ->maxLength(255),
                TextInput::make('last_name')
                ->required()
                ->maxLength(255),

                TextInput::make('phone')
                ->required()
                ->tel()
                ->maxLength(20),

                TextInput::make('city')
                ->required()
                ->maxLength(255),

                TextInput::make('state')
                ->required()
                ->maxLength(255),

                TextInput::make('zip_code')
                ->required()  
                ->numeric()
                ->maxLength(10),  


               

              Textarea::make('street_address')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('street_address')
            ->columns([
                TextColumn::make('fullname')
                ->label('Full Name')
                ->formatStateUsing(fn ($record) => $record->first_name . ' ' . $record->last_name),
            
                TextColumn::make('phone')
                ->label('Phone Number'),
                TextColumn::make('city')
                ->label('City'),
                TextColumn::make('district')
                ->label('District'),
                TextColumn::make('zip_code')
                ->label('Zip Code'),
                TextColumn::make('street_address')
                ->label('Street Address'),
           
                
             
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->label('Edit')
                        ->icon('heroicon-o-pencil'),
                    Tables\Actions\DeleteAction::make()
                        ->label('Delete')
                        ->icon('heroicon-o-trash')
                        ->color('danger'),

                    Tables\Actions\ViewAction::make('View')
                        ->label('View')
                        ->icon('heroicon-o-eye')
                       
                        ->color('success'),
                       
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
