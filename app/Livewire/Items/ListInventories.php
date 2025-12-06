<?php

namespace App\Livewire\Items;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Inventory;
use Filament\Tables\Columns\TextColumn;
use Livewire\Component;
use Filament\Actions\Action;

class ListInventories extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithTable;
    use InteractsWithSchemas;
protected string $tableClass = Inventory::class;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Inventory::query())
            ->columns([
                TextColumn::make('item.name')
                     ->searchable()
                     ->sortable(),
                TextColumn::make('quantity')
                    ->sortable()
                    ->badge(),
                TextColumn::make('created_at')
                    ->toggleable( isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                Action::make('delete')
                    ->requiresConfirmation()
                    ->color('danger')
                    ->badge()
                    ->action(fn (Inventory $record) => $record->delete())
                    ->successNotificationTitle('Inventory Deleted Successfully'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.items.list-inventories');
    }
}
