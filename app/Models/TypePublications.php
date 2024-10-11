<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePublications extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function publications()
    {
        return $this->hasMany(Publications::class, 'type_id');
    }
}
