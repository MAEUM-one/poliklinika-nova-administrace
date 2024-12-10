<?php

namespace App\Filament\Resources\OfficeResource\Pages;

use App\Filament\Resources\OfficeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class EditOffice extends EditRecord
{
    protected static string $resource = OfficeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            $this->getSaveFormAction()->action('save'),
            $this->getCancelFormAction()
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $fields = ['header', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        collect($fields)->each(function ($field) use ($data, $record) {
            for ($i = 1; $i <= 4; $i++) {
                $label = "{$field}_m{$i}";
                if (isset($data[$label])) {
                    $days = [
                        'header' => 'HEADER',
                        'monday' => 'MON',
                        'tuesday' => 'TUE',
                        'wednesday' => 'WED',
                        'thursday' => 'THU',
                        'friday' => 'FRI',
                        'saturday' => 'SAT',
                        'sunday' => 'SUN',
                    ];
                    $o = match ($i) {
                        2 => $record->hours2()->first(),
                        3 => $record->hours3()->first(),
                        4 => $record->hours4()->first(),
                        default => $record->hours()->first(),
                    };
                    if ($o) {
                        $o->{$days[$field]} = $data[$label];
                        $o->save();
                    }
                }
            }
        });

        return parent::handleRecordUpdate($record, $data); // TODO: Change the autogenerated stub
    }
}
