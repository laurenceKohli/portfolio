<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='table_categorys'; 
    public $timestamps = false;
    protected $fillable = ['name'];

    public function techsCategory()
    {
        return $this->hasMany(Tech::class);
    }

}

