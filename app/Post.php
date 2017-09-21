<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function Comments(){
        //Post has many comments
        return $this->hasMany('Comment', 'post_id');
    }
    
    public function Category(){
        //Post belongs to a Category
        return $this->belongsTo('Category', 'cat_id');
    }
}
