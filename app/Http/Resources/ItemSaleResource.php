<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemSaleResource extends JsonResource
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
            'type' => 'itemSale',
            "attributes" => [
                'price_sale' => $this->price_sale,
                'amount' => $this->amount,
                'discount' => $this->discount,
                // Convert the date to string using the instance of Carbon
                'created_at' => $this->created_at
                        ?->setTimezone('America/Sao_Paulo')
                    ->format('Y-m-d H:i:s'),
                'updated_at' => $this->updated_at
                        ?->setTimezone('America/Sao_Paulo')
                    ->format('Y-m-d H:i:s'),
            ],
            'relationships' => [
                'product' => [
                    'data' => [
                        'id' => $this->product_id,
                        'type' => 'product'
                    ]
                ]
            ]
        ];
    }

    /**
     * Include custom data in resource response
     */
    public function with($request): array
    {
        return [
            'included' => [
                'product' => new ProductResource($this->product),
            ]
        ];
    }
}