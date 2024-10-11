<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publications extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image', 'document', 'user_id', 'type_id', 'state', 'date', 'date_start', 'date_end'];
    public function type()
    {
        return $this->belongsTo(TypePublications::class, 'type_id', 'id');
    }
}