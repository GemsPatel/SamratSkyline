<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)//, $user='', $is_single_return=false
    {
        return [
            'id' => $this->id,
            'sku' => $this->sku,
            'name' => $this->name,
            'slug' => $this->slug,
            'category_id' => $this->category_id,
            'country_id' => $this->country_id,
            'type' => $this->type,
            'profile_pic' => ($this->profile_pic) ? $this->getImages($this->profile_pic ): '',
            'description' => $this->description,
            'status' => $this->status,
            'auth_type' => $this->auth_type,
            'auth_tag' => $this->auth_tag
        ];
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
