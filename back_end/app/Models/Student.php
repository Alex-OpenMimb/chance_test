<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $fillable= [
        'name',
        'born_date',
        'father_name',
        'mother_name',
        'section',
        'date_entry',
        'grade_id',
    ];

    //Relationships
    public function grade()
    {
        return $this->belongsTo( Grade::class );
    }




}
