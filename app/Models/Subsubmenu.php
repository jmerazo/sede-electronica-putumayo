<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subsubmenu extends Model
{
    use HasFactory;

    protected $fillable = ['submenu_id', 'name', 'route', 'order'];

    public function submenu()
    {
        return $this->belongsTo(Submenu::class);
    }
}
