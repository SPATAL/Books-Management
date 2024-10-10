<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'image',
        'pdf',
        'published_at',
    ];
    // app/Models/Book.php

protected $casts = [
    'published_at' => 'date',
];


    // public function author()
    // {
    //     return $this->belongsTo(Author::class);
    // }

    
}
