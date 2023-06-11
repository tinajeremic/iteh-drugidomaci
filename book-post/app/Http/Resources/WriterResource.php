<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WriterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public static $wrap = 'writer';
    public function toArray(Request $request)
    {
        return [
            'name' =>$this->resource->name,
            'country' =>$this->resource->country,
            'gender'=>$this->resource->gender,            
        ];
    }
}
