<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModulePermission extends Model
{
    use HasFactory;
    
    protected $table = 'user_module_permissions';
    protected $fillable = [
        'user_id',
        'module_id',
        'submodule_id',
        'permission_id'
    ];

    public function submodule()
    {
        return $this->belongsTo(Submodule::class, 'submodule_id');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public $timestamps = false;
}
