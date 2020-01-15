<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CheckResource extends JsonResource
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
            'key' => $this->user_id,
            'head' => $this->checkout_time,
            'content' =>$this->checkout_date,
        ];
       // return parent::toArray($request);
    }
}
