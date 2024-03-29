<?php

namespace App\Filament\Pages;

use App\Models\ModuleType;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Pages\Page;

class CheckElements extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.check-elements';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Select::make('id')
                        ->label('Module Type')
                        ->required()
                        ->options(function () {
                            return ModuleType::all()->pluck('full_name', 'id');
                        })
                        ->live()
                        ->searchable()
                        ->preload()
                        ->afterStateUpdated(function (Select $component) {
                                $fieldset = $component
                                    ->getContainer()
                                    ->getComponent('dynamicTypeFields');

                                if (!is_null($fieldset) && $fieldset->hasChildComponentContainer()) {
                                    $fieldset
                                        ->getChildComponentContainer()
                                        ->fill();
                                }
                    }),
                    Fieldset::make('elements')
                        ->label('Elements')
                        ->schema(fn(Get $get) => $get("id") ? self::getElements($get("id")) : [])
                        ->columns(10)
                        ->key('dynamicTypeFields')
                        ->hidden(
                            fn(Get $get): bool => !$get("id") ||
                                ModuleType::findOrFail(
                                    $get("id")
                                )->elements->count() == 0
                        ),
                ]),
            ])
            ->statePath('data')
            ->model(ModuleType::class);
    }

    public static function getElements(?int $module_type): array
    {
        $array = [];

        if ($module_type) {
            $module_type = ModuleType::findOrFail($module_type);
            $elements = $module_type->elements;

            foreach ($elements as $element) {
                $array[] = TextInput::make('name'.$element->id)
                    ->label('Name')
                    ->default($element->name)
                    ->readOnly()
                    ->columnSpan([
                        'md' => 4,
                    ]);

                $array[] = TextInput::make(
                    'module_type_quantity'.$element->id
                )
                    ->label('Qty (ModuleType)')
                    ->default(
                        $module_type->elements->find($element->id)->pivot
                            ->quantity
                    )
                    ->readOnly()
                    ->columnSpan([
                        'md' => 2,
                    ]);

                $array[] = TextInput::make('total_quantity'.$element->id)
                    ->label('Qty (Storage)')
                    ->default($element->quantity)
                    ->readOnly()
                    ->columnSpan([
                        'md' => 2,
                    ]);

                $array[] = TextInput::make('reserve_quantity'.$element->id)
                    ->label('Qty (Reserve)')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(32767)
                    ->columnSpan([
                        'md' => 2,
                    ]);
            }
        }

        return $array;
    }

    public function check(): void
    {
        $this->form->getState();
    }
}
