<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageUserResource extends JsonResource
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
            'id' => $this->getRouteKey(),
            'first_name' => $this->first_name,
            'display_name' => $this->displayName,
            'slug' => $this->slug,
            'profile_image_url' => empty($this->profileImage()) ? url('/images/empty-profile.png') : $this->profileImage()->url(),
            'link' => route('user.profile', [$this->getRouteKey(), $this->slug]),
        ];
    }
}
