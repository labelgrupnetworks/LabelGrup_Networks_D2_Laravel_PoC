<?php

namespace Support\Services;

use Domain\Shared\Interfaces\IData;

class ClearNullOnUpdatesService
{
    public static function execute(IData $data): array
    {
        $data = collect($data)->toArray();

        foreach ($data as $key => $value) {
            if (is_null($value)){
                unset($data[$key]);
            }
        }

        return $data;
    }
}
