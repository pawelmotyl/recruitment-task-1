<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CharacterResource extends JsonResource
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
            'id' => $this->id,
            'url' => $this->url,
            'name' => $this->name,
            'gender' => $this->gender,
            'culture' => $this->culture,
            'born' => $this->born,
            'died' => $this->died,
            'father' => $this->father,
            'mother' => $this->mother,
            'spouse' => $this->spouse,
            'titles' => new TitleCollection($this->titles)
        ];
    }
}
