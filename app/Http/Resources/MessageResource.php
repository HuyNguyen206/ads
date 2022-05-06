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
            'sender' => $this->whenLoaded('sender'),
            'receiver' => $this->whenLoaded('receiver'),
            'advertisement' => $ad = $this->whenLoaded('advertisement'),
            'link_ads' => $ad ? route('ads.show-detail', $ad->slug) : null,
            'ad_feature_image' => $ad ? $ad->getFirstMediaUrl('ads.feature_image') : null,
            'created_at' => [
                'created_at_raw' => $this->created_at,
                'created_at_human' => $this->created_at->diffForHumans()
            ]
        ];
    }
}
