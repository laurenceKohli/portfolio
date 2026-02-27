<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table='table_tags'; 
    public $timestamps = false;
    protected $fillable = ['name', 'color'];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function certifications()
    {
        return $this->hasMany(Certif::class);
    }
}

