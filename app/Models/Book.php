<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $primaryKey = "book_id";

    protected $fillable = [
        'author',
        'title'
    ];

    public function copies()
        {  
            //kapcsolat iránya, paraméterek sorrendje: model, honnan, hová
            return $this->hasMany(Copy::class, 'book_id', 'book_id');  
        }

}
