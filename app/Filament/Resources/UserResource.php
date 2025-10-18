<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->required()
                ->maxLength(255),

            // Input untuk Email
            TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),

            // Pilihan untuk Role
            Select::make('role_id')
                ->label('Role')
                ->options([
                    1 => 'Superadmin',
                    2 => 'Admin',
                    3 => 'User',
                ])
                ->required(),

            // Input untuk Password
            TextInput::make('password')
                ->password()
                ->required()
                ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                ->dehydrated(fn (?string $state): bool => filled($state))
                ->required(fn (string $operation): bool => $operation === 'create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            // Kolom untuk ID, bisa di-sort
            TextColumn::make('id')->sortable(),

            // Kolom untuk Nama, bisa dicari
            TextColumn::make('name')->searchable(),

            // Kolom untuk Email, bisa dicari
            TextColumn::make('email')->searchable(),

            // Kolom untuk Role (kita akan perbaiki ini agar lebih bagus)
            TextColumn::make('role.name') // <-- Gunakan dot notation
                ->label('Role')         // <-- Ubah labelnya
                ->searchable()          // <-- Buat agar bisa dicari
                ->sortable(),

            // Kolom untuk tanggal dibuat
            TextColumn::make('created_at')->dateTime()->sortable(),
        ])
        ->filters([
            // (Filter bisa ditambahkan nanti)
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
