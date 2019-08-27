<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessagesResource extends JsonResource
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
            'name' => str_limit($this->name, 10),
            'body' => str_limit($this->body, 100),
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
