<?php

namespace App\Interfaces\Repositories;

use Illuminate\Support\Str;

trait FormatsDataTrait
{
    protected function formatData(array $data)
    {
        $mappedData = [];

        foreach ($data as $field => $value) {
            $column = Str::snake($field);
            $mappedData[$column] = $value;
        }

        return $mappedData;
    }
}