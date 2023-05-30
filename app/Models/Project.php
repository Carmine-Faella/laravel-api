<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'cover_image',
        'slug',
        'type_id'
    ];

    public static function generateSlug(string $title) {
        return Str::slug($title, '-');
    }

    public function type() {
        return $this->belongsTo(Type::class);
    }

    public function tecnologies() {
        return $this->belongsToMany(Tecnology::class);
    }
}
