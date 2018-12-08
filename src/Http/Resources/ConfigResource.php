<?php
namespace Aruberuto\Configurable\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class ConfigResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

    //  Alternative return
    //  return [
    //      'id' => $this->id,
    //      // ...a
    //      'created_at' => $this->created_at,
    //      'updated_at' => $this->updated_at,
    //  ];
        return parent::toArray($request);

    }
}

