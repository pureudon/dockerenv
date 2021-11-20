<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DatatypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'varchartype' => $this->varchartype,
            'inttype' => $this->inttype,
            'yeartype' => (string) $this->yeartype,
            'datetype' => (string) $this->datetype,
            'datetimetype' => $this->datetimetype,
          ];
    }
}
