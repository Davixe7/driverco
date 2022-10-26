<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Document extends JsonResource
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
        'id'         => $this->id,
        'file'       => new Media($this->getFirstMedia('file')),
        'type'       => $this->type,
        'expires_at' => $this->expires_at,
      ];
    }
}
