<?php

namespace App\Imports;

use App\Models\Admin\Language;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LanguageImport implements ToModel, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        if( empty( $row['name'] ) ){
            return true;
        }
        
        $alias = convertStringToSlug(  $row['name'] );
        $country = Language::where( 'alias', $alias )->first();
        if(!$country) {
            $country = new Language();
        }

        $country->name = $row['name'];
        $country->key = strtoupper( $row['code'] );
        $country->alias = $alias;
        $country->status =  $row['status'];
        $country->save();
    }
}
