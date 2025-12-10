<?php

namespace App\Livewire\Items;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use App\Models\Inventory;
use Filament\Forms\Components\TextInput;
use Livewire\Component;

use Filament\Forms\Components\ToggleButtons;
use Filament\Notifications\Notification;


class EditInventory extends Component implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;

    public Inventory $record;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Edit Inventory')
                    ->columns(2)
                    ->description('Update the item details as you wish!')
                    ->schema([
                        TextInput::make('name')
                            ->label('Inventory Name'),
                        TextInput::make('Quantity')
                            ->numeric(),
                        TextInput::make('Created_At')
                           ->label(''),

                    ])
            ])
            ->statePath('data')
            ->model($this->record);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->record->update($data);

        Notification::make()
            ->title('Inventory Updated!')
            ->success()
            ->body("Inventory {$this->record->name} has been updated successfully.")
            ->send();
        }

    public function render(): View
    {
        return view('livewire.items.edit-inventory');
    }
}
