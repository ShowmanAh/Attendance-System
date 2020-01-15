<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CheckinResource extends JsonResource
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
            'head' => $this->checkin_time,
            'content' =>$this->checkin_date,
        ];
        //return parent::toArray($request);
    }
}
