<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    protected $fillable = [
        'lab_name',
        'section_name',
        'status',
        'updated_by_faculty_id'
    ];

    // Connects the Lab to the Faculty user who updated it
    public function faculty()
    {
        return $this->belongsTo(User::class, 'updated_by_faculty_id');
    }
}