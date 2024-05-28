<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlayerResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'avatar' => $this->avatar,
            'birthday' => $this->birthday,
            'gender' => $this->gender,
            'performance_score' => $this->performance_score,
            'overall_score' => $this->overall_score,
        ];
    }
}