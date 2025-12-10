<?php

namespace App\Livewire\Sales;

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
use Livewire\Component;
use App\Models\Sales;
use Filament\Actions\Action;


class ListSales extends Component implements HasActions, HasTable
{
    use InteractsWithActions;
    use InteractsWithTable;
    use InteractsWithSchemas;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Sales::query())
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
                    ->action(fn (Sales $record) => $record->delete())
                    ->successNotificationTitle('Sale Deleted Successfully'),

                Action::make('edit')
                // redirect to this url
                    ->url(fn (Sales $record): string => route('sales.update', $record))
                
            
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.sales.list-sales');
    }
}
