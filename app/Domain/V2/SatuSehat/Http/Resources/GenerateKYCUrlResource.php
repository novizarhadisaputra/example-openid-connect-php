<?php

namespace App\Domain\V2\SatuSehat\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GenerateKYCUrlResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'url'     => $this->url,
        ];
    }
}
