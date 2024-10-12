<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'bio',
        'picture',
    ];

//     protected static function booted(){
//     static::deleting(function ($author) {
//         // Delete author's picture
//         if ($author->picture && file_exists(public_path('authors/' . $author->picture))) {
//             unlink(public_path('authors/' . $author->picture));
//         }

//         // Loop through author's books to delete associated files
//         foreach ($author->books as $book) {
//             // Delete book's image
//             if ($book->image && file_exists(public_path('images/' . $book->image))) {
//                 unlink(public_path('images/' . $book->image));
//             }

//             // Delete book's PDF
//             if ($book->pdf && file_exists(public_path('pdfs/' . $book->pdf))) {
//                 unlink(public_path('pdfs/' . $book->pdf));
//             }
//         }
//     });
// }


    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
