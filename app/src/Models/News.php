<?php

namespace App\src\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'name',
        'description',
        'author_id'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

}
