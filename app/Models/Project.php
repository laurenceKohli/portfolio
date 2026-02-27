<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table='table_projects';
    protected $fillable = [
        'tag_id', 'title', 'date', 'duration', 'url',
        'goals', 'desc', 'team', 'contribution', 'proud'
    ];

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function imgs()
    {
        return $this->hasMany(Img::class);
    }

    public function techs()
    {
        return $this->belongsToMany(Tech::class, 'table_project_tech');
    }

    public function exps()
    {
        return $this->belongsToMany(Exp::class, 'table_exp_project');
    }
}

