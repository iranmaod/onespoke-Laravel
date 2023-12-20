<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class BikeResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'truncated_description' => Str::limit(strip_tags($this->description), 150, $end = '...'),
            'model' => $this->model,
            'year' => $this->year,
            'additional_details' => $this->additional_details,
            'price' => $this->formattedPrice(),
            'postcode' => $this->postcode,
            'uploaded_to_veloeye' => $this->uploaded_to_veloeye,
            'sold' => $this->sold,
            'published' => $this->published,
            'paused' => $this->paused,
            'paused_at' => optional($this->paused_at)->format('d/m/Y H:i'),
            'views' => $this->views,
            'manufacturer' => optional($this->manufacturer)->name,
            'frame_type' => optional($this->frameType)->name,
            'condition' => optional($this->condition)->name,
            'frame_size' => optional($this->frameSize)->name,
            'wheel_size' => optional($this->wheelSize)->name,
            'gender' => optional($this->gender)->name,
            'created_at' => $this->created_at,
            'listed_on' => optional($this->published_at)->format('d/m/Y'),
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'link' => route('bike.show', [$this->getRouteKey(), $this->slug]),
            'edit_url' => route('bike.edit', [$this->getRouteKey(), $this->slug]),
            'cover_image' => optional($this->coverImage())->url(),
            'images' => BikeImageResource::collection($this->images),
            'distance' => empty($this->distance) ? null : round($this->distance, 2),
            'user_id' => $this->user->getRouteKey(),
        ];
    }
}
