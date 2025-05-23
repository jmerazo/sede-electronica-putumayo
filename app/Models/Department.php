<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $table = 'departments';
    protected $fillable = ['name', 'lat', 'long'];
    public $timestamps = false;

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
