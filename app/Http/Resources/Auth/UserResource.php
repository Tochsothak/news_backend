<?php

namespace App\Http\Resources\Auth;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" =>  $this->uuid,
            "name" => $this->name,
            "email" => $this->email,
            "phone_number" => $this->phone_number,
            "email_verified_at" => Carbon::parse($this->email_verified_at)->toDateTimeString(),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "date_of_birth" => $this->date_of_birth,
            "gender" => $this->gender,
            "is_active" => $this->is_active,
            "status" => $this->status,
            "address" => $this->status,
            "city" => $this->address,
            "state" => $this->state,
            "country" => $this->country,
            "postal_code" => $this->postal_code,
            "role" => $this->role,
        ];
    }
}
