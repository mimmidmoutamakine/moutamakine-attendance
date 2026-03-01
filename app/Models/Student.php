<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'full_name',
        'date_of_birth',
        'parent_name',
        'phone',
        'active',
        'notes',
    ];

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }
}