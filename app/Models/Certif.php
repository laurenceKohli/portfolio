<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certif extends Model
{
    protected $table='table_certifs';
    protected $fillable = ['tag_id', 'title', 'date', 'goals', 'url'];

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
