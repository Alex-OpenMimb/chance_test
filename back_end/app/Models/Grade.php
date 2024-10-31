<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $table = 'grades';
    protected $fillable= [
        'grade',
    ];


    //Data
    const GRADES = ['Primero','Segundo','Tercero','Cuarto','Quinto'];

    //Relationships

    public function students()
    {
        return $this->hasMany( Student::class );
    }
}
