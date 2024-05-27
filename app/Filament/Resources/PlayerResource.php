<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlayerResource\Pages;
use App\Models\Player;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Team;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Forms\Get;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class PlayerResource extends Resource
{
    protected static ?string $model = Player::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Basic Information')
                        ->icon('heroicon-o-user')
                        ->schema([
                            Forms\Components\TextInput::make('name')->label('Player name')->required()->live()
                                ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                                    if (($get('slug') ?? '') !== Str::slug($old)) {
                                        return;
                                    }
                                    $set('slug', Str::slug($state));
                                }),
                            Forms\Components\TextInput::make('slug'),
                            SpatieMediaLibraryFileUpload::make('avatar')->label('Player Avatar')->avatar()->required(),
                        ])
                        ->columnSpan('full')
                        ->columns(2),
                    Wizard\Step::make('Additional Information')
                        ->icon('heroicon-o-information-circle')
                        ->schema([
                            Forms\Components\DatePicker::make('birthday')->label('Birthday')->required(),
                            Forms\Components\Select::make('gender')
                                ->label('Gender')
                                ->options([
                                    'male' => 'Male',
                                    'female' => 'Female',
                                ])
                                ->required(),
                            Forms\Components\TextInput::make('email')->label('Email')->email()->required(),
                            Forms\Components\TextInput::make('phone')->label('Phone')->tel(),
                            Forms\Components\TextInput::make('performance_score')->label('Preformance Score')->numeric()->required(),
                            Forms\Components\TextInput::make('overall_score')->label('Overall Score')->numeric()->required(),
                        ])
                        ->columnSpan('full')
                        ->columns(2),
                    Wizard\Step::make('Team Selection')
                        ->icon('heroicon-o-user-group')
                        ->schema([
                            Forms\Components\Select::make('team_id')
                                ->label('Team')
                                ->options(Team::all()->pluck('name', 'id'))
                                ->searchable()
                                ->required(),
                        ])
                        ->columnSpan('full')
                        ->columns(2),
                ])

            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\SpatieMediaLibraryImageColumn::make('avatar')
                ->collection('avatars')
                ->circular(),
                Tables\Columns\TextColumn::make('team.name')
                    ->label('Team')
                    ->sortable(),
                Tables\Columns\TextColumn::make('birthday')->label('Birthday'),
                Tables\Columns\TextColumn::make('gender')->label('Gender'),
                Tables\Columns\TextColumn::make('email')->label('Email'),
                Tables\Columns\TextColumn::make('phone')->label('Phone'),
                Tables\Columns\TextColumn::make('performance_score')->label('Performance Score'),
                Tables\Columns\TextColumn::make('overall_score')->label('Overall Score'),
            ])
            ->filters([
                SelectFilter::make('team')->relationship('team', 'name'),
            ])
            ->actions([
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
            'index' => Pages\ListPlayers::route('/'),
            'create' => Pages\CreatePlayer::route('/create'),
            'edit' => Pages\EditPlayer::route('/{record}/edit'),
        ];
    }
}
