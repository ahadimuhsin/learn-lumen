<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model{
    //tentukan tabelnya
    protected $table = 'posts';

    //fillable
    protected $fillable = [
        'title', 'content'
    ];


}

?>
