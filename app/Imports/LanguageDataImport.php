<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;

class LanguageDataImport implements WithMultipleSheets
{
    use WithConditionalSheets;
    public function conditionalSheets(): array
    {
        return [
            'Language' => new LanguageImport(),
        ];
    }
}
