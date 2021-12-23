<?php

 use \App\Post as post;
 
 use \App\Like as like;
 
 
 
 if(! function_exists('getPost'))
 {
     function getPost($type = 'data')
     {
         if($type == 'data')
         {
             
            $post = Post::where('status', 0)->orderBy('created_at', 'desc')->get();
            
         }else {
             
            $post = Post::where('status', 0)->count();
             
         }
         return $post;
         
         
     } // end of function
 }// end of if 
 
 
 ?>