<?php

namespace App\Filament\Resources\OrganizationResource\Pages;

use App\Filament\Resources\OrganizationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditOrganization extends EditRecord
{
    protected static string $resource = OrganizationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            $this->getSaveFormAction()->submit(null)
                ->action('save'),
            $this->getCancelFormAction()
        ];
    }
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $fields = ['header', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        collect($fields)->each(function ($field) use ($data, $record) {
            for ($i = 1; $i <= 2; $i++) {
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
