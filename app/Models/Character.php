<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $casts = [
      'occupation' => 'array',
      'appearance' => 'array',
      'category'   => 'array'
    ];

    protected $guarded = [];

    use HasFactory;
}
