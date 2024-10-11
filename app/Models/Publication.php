<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = ['type_id', 'title'];

    public function publications()
    {
        return $this->belongsTo(Publication::class);
    }
}
