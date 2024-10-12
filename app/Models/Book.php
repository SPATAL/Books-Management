<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'price',
        'image',
        'pdf',
        'author_id',
        'published_at',
    ];
    // app/Models/Book.php

protected $casts = [
    'published_at' => 'date',
];


// protected static function booted()
// {
//     static::deleting(function ($book) {
//         // Delete book's image
//         if ($book->image && file_exists(public_path('images/' . $book->image))) {
//             unlink(public_path('images/' . $book->image));
//         }

//         // Delete book's PDF
//         if ($book->pdf && file_exists(public_path('pdfs/' . $book->pdf))) {
//             unlink(public_path('pdfs/' . $book->pdf));
//         }
//     });
// }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    
}
