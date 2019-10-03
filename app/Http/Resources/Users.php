<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Users extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'type' => $this->type,
            'created_at' => $this->created_at,
        ];
    }

    public function with($request) {
        return [
            'author' => [
                'name' => 'Pasindu Priyanakra',
                'email' => 'pasinduxx@hotmail.com'
            ]
        ];
    }

}
