<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $table = 'modules';
    protected $fillable = ['name', 'route', 'icon'];
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany(User::class, 'module_user');
    }

    public function submodules()
    {
        return $this->hasMany(Submodule::class);
    }
}
