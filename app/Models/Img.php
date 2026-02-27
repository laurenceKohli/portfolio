<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Img extends Model
{
    protected $table='table_imgs';
    protected $fillable = ['project_id', 'img_path', 'desc'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}

