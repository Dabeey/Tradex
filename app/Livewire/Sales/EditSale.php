<?php

namespace App\Livewire\Sales;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use App\Models\Sales;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\ToggleButtons;
use Filament\Notifications\Notification;

class EditSale extends Component implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;

    public Sales $record;

    public ?array $data = [];

    public function mount(Sales $record): void
    {
        $this->form->fill($this->record->attributesToArray());
            
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Edit Customer')
                    ->description('Update the customer details as you wish!')
                    ->columns(2)
                    ->schema([

                        // namespace
                        TextInput::make('name')
                            ->label('Customer Name'),
                        TextInput::make('email')
                            ->unique(),
                        TextInput::make('phone')
                            ->tel(),
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
        ->title('Customer Updated!')
        ->success()
        ->body("Customer {$this->record->name} has been updated successfully")
        ->send();
    }

    public function render(): View
    {
        return view('livewire.sale.edit-sale');
    }
}
