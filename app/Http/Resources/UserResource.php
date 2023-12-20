<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'last_name' => $this->last_name,
            'name' => $this->name,
            'email' => $this->email,
            'bio' => $this->bio,
            'account_type' => $this->account_type,
            'location' => $this->location,
            'address_1' => $this->address_1,
            'address_2' => $this->address_2,
            'town' => $this->town,
            'county' => $this->county,
            'country' => $this->country,
            'postcode' => $this->postcode,
            'phone' => $this->phone,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'instagram' => $this->instagram,
            'linkedin' => $this->linkedin,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'link' => route('user.profile', [$this->getRouteKey(), $this->slug]),
            'banner_image' => optional($this->bannerImage())->url(),
            'profile_image' => optional($this->profileImage())->url(),
        ];
    }
}
