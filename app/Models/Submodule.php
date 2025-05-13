<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submodule extends Model
{
    use HasFactory;

    protected $table = 'submodules';
    protected $fillable = ['module_id', 'name', 'route', 'icon'];

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }
}
