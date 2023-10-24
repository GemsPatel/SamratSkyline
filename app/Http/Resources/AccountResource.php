<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'profile_pic' => $this->profile_pic,
            'mobile_number' => $this->mobile_number,
            'address' => $this->address,
            'pin_code' => $this->pin_code,
            'account_created_at' => Carbon::parse($this->created_at)->format('d-M-Y'),
            'refer_code' => strtoupper( $this->refer_code ),
            'member_type' => $this->member_type,
        ];
        // return parent::toArray($request);
    }
}
