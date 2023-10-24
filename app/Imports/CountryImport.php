<?php

namespace App\Imports;

use App\Models\Admin\Country;
use App\Models\Admin\Type;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CountryImport implements ToModel, WithHeadingRow
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
        $country = Country::where( 'alias', $alias )->first();
        if(!$country) {
            $country = new Country();
        }

        $country->name = $row['name'];
        $country->sortname = strtoupper( $row['country_code'] );
        $country->alias = $alias;
        $country->code = $row['country_dial_code'];
        $country->status =  $row['status'];
        $country->save();
    }
}
