<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipateSection extends Model
{
    use HasFactory;

    protected $fillable = ['participate_id', 'title', 'content', 'link'];

    // Relación inversa con el modelo Participate
    public function participate()
    {
        return $this->belongsTo(Participate::class);
    }

        public function links()
    {
        return $this->hasMany(SectionLink::class, 'section_id');
    }

}
