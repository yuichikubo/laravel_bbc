<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Comment;
use App\Category;

class PostCommentSeeder extends Seeder{
    
    public function run(){
        $content = 'この文章はダミーです。文字、の大きさ、時間などの確認に使います。この文章はダミーです。文字、の大きさ、時間などの確認に使います。この文章はダミーです。文字、の大きさ、時間などの確認に使います。この文章はダミーです。文字、の大きさ、時間などの確認に使います。';
        
        $commentdammy = 'コメントダミーです。';
        
        for( $i = 1 ; $i <= 10 ; $i++){
            $post = new Post;
            $post->title = "$i 番目の投稿";
            $post->content = $content;
            $post->cat_id = 1;
            $post->save();
            
            $maxComments = mt_rand(3, 15);
            for ($j=0; $j <= $maxComments; $j++){
                $comment = new Comment;
                $comment->commenter = '名無しさん';
                $comment->comment = $commentdammy;
                
                // reading Model(Post.php)->comments method
                $post->comments()->save($comment);
                $post->increment('comment_count');
            }
        }
        
        //add category
        $cat1 = new Category;
        $cat1->name = "電化製品";
        $cat1->save();
        
        $cat2 = new Category;
        $cat2->name = "食品";
        $cat2->save();
    }
}