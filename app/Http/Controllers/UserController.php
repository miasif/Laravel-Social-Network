<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Page;
use App\Models\Post;
use App\Models\User;

class UserController extends Controller
{
    public function PageCreate(Request $request){
        try{
            $user = Auth::user();
            $page = new Page();
            $page->page_name = $request->page_name;
            $page->admin = $user->id;
            $page->save();
            return response([  
                'message'=>"Page Created",
                'page'=>$page
            ],200);

        }catch(\Exception $exception){
            return response([
                'message'=>$exception->getMessage()
            ],400);
        }
    }

    public function FollowUser(Request $request,$personId){
        try{
            $follower = Auth::user();
            if($follower->id == $personId){
                return response([
                    'message'=>"You can't follow yourself"
                ],400);
            }
            if($follower->following->contains($personId)){
                return response([
                    'message'=>"You are already following this person"
                ],400);
            }
            if(!$follower->following->contains($personId)){
                $follower->following()->attach($personId);
                return response([
                    'message'=>"You are now following this person",
                    'follower'=>$follower
                ],200);
            }
        }catch(\Exception $exception){
            return response([
                'message'=>$exception->getMessage()
            ],400);
        }
    }

    public function Feed(){
        try{

            $follows = Auth::user()->following->pluck('id');
            $articles = Post::whereIn('user_id',$follows)->where('page_id',null)
            ->latest()
            ->limit(10)
            ->get();

            // $pageFollows = Auth::user()->pageFollowing->pluck('page_id');
            
            // var_dump($pageFollows);
            return response([
                'message'=>"Feed",
                'articles'=>$articles
            ],200);

        }catch(\Exception $exception){
            return response([
                'message'=>$exception->getMessage()
            ],400);
        }
    }
 
}
