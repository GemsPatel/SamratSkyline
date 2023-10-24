<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;

class CountryDataImport implements WithMultipleSheets
{
    use WithConditionalSheets;
    public function conditionalSheets(): array
    {
        return [
            'Country' => new CountryImport(),
        ];
    }
}
