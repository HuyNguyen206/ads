<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
            'body' => $this->body,
            'sender' => UserResource::make($this->whenLoaded('sender')),
            'receiver' =>  UserResource::make($this->whenLoaded('receiver')),
            'advertisement' => AdsResource::make($this->whenLoaded('advertisement')),
            'created_at' => [
                'created_at_raw' => $this->created_at,
                'created_at_human' => $this->created_at->diffForHumans()
            ]
        ];
    }
}
