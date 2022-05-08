<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdsResource extends JsonResource
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
            'slug'=> $this->slug,
            'link_ads' => route('ads.show-detail', $this->slug),
            'ad_feature_image' => $this->getFirstMediaUrl('ads.feature_image'),
            'name' => $this->name
        ];
    }
}
