<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UsersCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
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
