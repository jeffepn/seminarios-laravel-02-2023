<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'product',
            "attributes" => [
                'name' => $this->name,
                'price' => $this->price,
                'slug' => $this->slug,
                'created_at' => $this->created_at
                        ?->setTimezone('America/Sao_Paulo')
                    ->format('Y-m-d H:i:s'),
                'updated_at' => $this->updated_at
                        ?->setTimezone('America/Sao_Paulo')
                    ->format('Y-m-d H:i:s'),
                'deleted_at' => $this->deleted_at
                        ?->setTimezone('America/Sao_Paulo')
                    ->format('Y-m-d H:i:s'),
            ]
        ];
    }
}