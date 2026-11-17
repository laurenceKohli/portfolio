<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tech extends Model
{
    protected $table='table_techs';
    public $timestamps = false;
    protected $fillable = ['name', 'logo_path', 'on_home_page', 'category_id'];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'table_project_tech');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

