<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GenreArrResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->genre;
    }

    /**
     * @deprecated
     *
     * @param [type] $imagesObject
     * @return void
     */
    public function getImages($image)
    {
        return url('../storage/app/'.$image);
    }
}
