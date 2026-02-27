<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $table='table_formations';
    protected $fillable = [
        'title', 'school', 'location',
        'desc', 'start_date', 'end_date', 'url'
    ];
}

