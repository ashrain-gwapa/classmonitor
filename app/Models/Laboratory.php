<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    use HasFactory;

    // 🔒 Only use columns that exist in your database
    protected $fillable = [
        'lab_name',
        'status',
        'section_name',
        'updated_by_faculty_id',
    ];

    /**
     * Link the laboratory to the user using the actual column name
     */
    public function faculty()
    {
        // Force the relationship to map to your actual database column
        return $this->belongsTo(User::class, 'updated_by_faculty_id');
    }
}