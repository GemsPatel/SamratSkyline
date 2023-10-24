<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TitleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type_id' => $this->type_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'serial_number' => $this->serial_number,
            'membership_type' => $this->membership_type,
            'status' => $this->status,
            'author_titles' => $this->author_titles,
            'country' => $this->country,
            'language' => $this->language,
            'genre' => GenreArrResource::collection( $this->genre),
            'sub_category' => $this->sub_category,
            'type' => $this->getType( $this->type ),
            'tags' => $this->tags,
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

    /**
     * 
     */
    // public function getGenre(  $genre ){
    //     return [
    //         'id' => $this->id,
    //         'parent_id' => $this->parent_id,
    //         'type_id' => $this->type_id,
    //         'title' => $this->title,
    //         'slug' => $this->slug,
    //         'image' => ($this->image) ? $this->getImages($this->image ): '',
    //         'status' => $this->status,
    //         'type' => $this->type,
    //         'level' => $this->level,
    //     ];
    // }

    /**
     * 
     */
    public function getType(  $type ){
        return [
            'id' => $this->id,
            'parent_id' => $this->type->parent_id,
            'title' => $this->type->title,
            'slug' => $this->type->slug,
            'level' => $this->type->level,
            'type' => $this->type->type,
        ];
    }
}
