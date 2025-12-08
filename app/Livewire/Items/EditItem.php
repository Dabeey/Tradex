<?php

namespace App\Livewire\Items;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use App\Models\Item;
use Filament\Forms\Components\TextInput;
use Livewire\Component;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\ToggleButtons;

class EditItem extends Component implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;

    public Item $record;

    public ?array $data = [];

    public function mount(): void
    {
        // populate the default value from db
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Add the section
                Section::make('Edit the item')
                    ->description('Update the item details as you wish!')
                    ->schema([

                        // namespace
                        TextInput::make('name')
                            ->label('Item Name'),
                        TextInput::make('squ')
                            ->unique(),
                        TextInput::make('price')
                            ->numeric(),



                        ToggleButtons::make('Status')
                            ->label('Is this item active?')
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'In Active',

                            ])
                            ->grouped()

                    ])
            ])
            ->statePath('data')
            ->model($this->record);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->record->update($data);
    }

    public function render(): View
    {
        return view('livewire.items.edit-item');
    }
}
