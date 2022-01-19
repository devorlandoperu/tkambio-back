<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $date = date_create($this->created_at);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'report_link'=>$this->report_link,
            'created_at'=> date_format($date, 'd/m/Y')
        ];
    }
}
