<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TypeResource extends JsonResource
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
            'parent_id' => $this->parent_id,
            'title' => $this->title,
            'slug' => $this->slug,
            // 'image' => ($this->image) ? $this->getImages( $this->image ) : '',
            'level' => $this->level,
            'type' => $this->type,
            'status' => $this->status
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
