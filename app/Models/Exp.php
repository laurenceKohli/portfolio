<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exp extends Model
{
    protected $table='table_exps';
    protected $fillable = ['name'];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'table_exp_project');
    }
}

