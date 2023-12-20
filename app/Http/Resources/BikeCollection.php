<?php

namespace App\Http\Resources;

use App\Models\Bike;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BikeCollection extends ResourceCollection
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
            'data' => BikeResource::collection($this->collection),
            'results' => $this->collection->count(),
            'total' => Bike::published()->unpaused()->unsold()->count(),
        ];
    }
}
