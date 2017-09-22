<?php

class PostCommentSeeder extends Seeder{
    
    public function run(){
        $comment = 'この文章はダミーです。文字、の大きさ、時間などの確認に使います。この文章はダミーです。文字、の大きさ、時間などの確認に使います。この文章はダミーです。文字、の大きさ、時間などの確認に使います。この文章はダミーです。文字、の大きさ、時間などの確認に使います。';
        
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
                
                // Model(Post.php)
            }
        }
    }
}