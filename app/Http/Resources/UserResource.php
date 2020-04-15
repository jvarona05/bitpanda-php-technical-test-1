<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'type' => 'user',
            'attributes' => [
                'email' => $this->email,
                'active' => $this->active,
                'first_name' => $this->details->first_name ?? '',
                'last_name' => $this->details->last_name ?? '',
                'phone_number' => $this->details->phone_number ?? ''
            ],
            'id' => $this->id
        ];
    }
}
