<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Page;
use App\Models\Post;

class PageController extends Controller
{
    public function FollowPage(Request $request, $pageId){
        try{
            $follower = Auth::user();
            $page = Page::find($pageId);
            $follower->followingPage()->attach($pageId);
            return response([
                'message'=>"You are now following this page",
                'page'=>$page
            ],200);
        }catch(\Exception $exception){
            return response([
                'message'=>$exception->getMessage()
            ],400);
        }
    }

    public function Post(Request $request){
        try{
            $post = new Post();
            $post->post_content = $request->post_content;
            $post->user_id = Auth::user()->id;
            $post->page_id = null;
            $post->save();
            return response([
                'message'=>"Post Created",
                'post'=>$post
            ],200);
        }catch(\Exception $exception){
            return response([
                'message'=>$exception->getMessage()
            ],400);
        }
    }

    public function PagePost(Request $request){
        try{
            $user = Auth::user();
            $page = Page::find($request->pageId);
            // var_dump($page);
            if($user->id == $page->admin){
                $post = new Post();
                $post->post_content = $request->post_content;
                $post->user_id = $user->id;
                $post->page_id = $request->pageId;
                $post->save();
                return response([
                    'message'=>"Post Created",
                    'post'=>$post
                ],200);

             
            }
        }catch(\Exception $exception){
            return response([
                'message'=>$exception->getMessage()
            ],400);
        }
    }
}
