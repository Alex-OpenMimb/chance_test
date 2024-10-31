<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'born_date' => $this->born_date,
            'father_name' => $this->father_name,
            'mother_name' => $this->mother_name,
            'section' => $this->section,
            'date_entry' => $this->date_entry,
            'grade_id' => $this->grade->grade,
            'created_at'            => date_format($this->created_at, 'Y-m-d, h:m'),
            'updated_at'            => date_format($this->updated_at, 'Y-m-d, h:m'),
        ];
    }
}
