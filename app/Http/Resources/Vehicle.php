<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Vehicle extends JsonResource
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
        'brand' => $this->brand,
        'model' => $this->model,
        'plate' => $this->plate,
        'city'  => $this->city,
        'user'  => $this->user,
        'documents' => Document::collection( $this->documents ),
      ];
    }
}
