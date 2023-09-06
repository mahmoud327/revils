<?php

namespace App\Http\Resources\Core;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'payment_type' => $this->payment_type,
            'card_type' => $this->card_type,
            'payment_status' => $this->payment_status,
            'card_digits' => $this->card_digits,
            'remarks' => $this->remarks,
            'capture_date' => $this->capture_date,
            'paid_on' => $this->paid_on,
            "image" => $this->image


        ];
    }
}
