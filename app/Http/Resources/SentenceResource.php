<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SentenceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            
            'sentence'       => $this->sentence,
            'pronounciation' => $this->pronounciation,
            'language'       => $this->language,
  
            'hebrew'         => $this->hebrew,
            'english'        => $this->english,
            'japanese'       => $this->japanese,
            'spanish'        => $this->spanish,

            'words'          => $this->words()->get(), 
       
            'type'           => $this->type,
            'extra'          => $this->extra,
       
        ];
    }
}
