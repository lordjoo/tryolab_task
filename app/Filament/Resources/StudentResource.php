<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\School;
use App\Models\Student;
use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Forms\Components\TextInput::make("name")->label("Name"),
                    Forms\Components\Select::make("school_id")->label("School")
                        ->options(School::all()->pluck("name","id"))->searchable()
                        ->reactive()
                        ->afterStateUpdated(function (Closure $set, $state, Closure $get) {
                            $state = (int) $state;
                            if (is_int($state)) {
                                $order = Student::where("school_id", $state)->count() + 1;
                                $set("order", $order);
                            }
                        }),
                ])->columnSpan(2),
                Forms\Components\Card::make()->schema([
                    Forms\Components\TextInput::make("order")->disabled()->label("Order")
                        ->reactive()
                        ->default( "Select a school"),
                ])->columnSpan(1),
            ])->columns([
                "sm"=>3,
                "lg"=>null
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("id")->label("ID"),
                Tables\Columns\TextColumn::make('name')->label('Name'),
                Tables\Columns\TextColumn::make('school.name')->label('School'),
                Tables\Columns\TextColumn::make('order')->label('Order'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
