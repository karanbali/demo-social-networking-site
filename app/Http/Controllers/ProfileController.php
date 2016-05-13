<?php

namespace App\Http\Controllers;
use Config;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Http\Requests;
use Storage;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }    
    public function profile(Request $request){
        return view('profile');
    }
    
    //public function home(Request $request){
            //return view('base');
        
    //}
    //var $filename = '6.jpg';
    
    public function info($id){
        return $query_info = DB::select('select * from userProfiles where user_id = :id',['id' => $id]);
    }
    
    public function createPost(Request $request){
        $id = Auth::id();
        $postContent = Input::get('postContent');
        $query_post = DB::insert('insert into events (user_id,view,content) values (?,1,?)',[$id,$postContent]);
        return Redirect::to('profile'); 
    }
    
    public function post($id){
        $query = DB::select('select * from events where user_id = :id',['id' => $id]);
        $post = collect([]);
        foreach($query as $value) {
            $query_info = DB::select('select * from userProfiles where user_id = :id',['id' => $value->user_id]);
            $post->push([ 'name' => $query_info[0]->name , 'pic' => $query_info[0]->pic , 'content' => $value->content ]);
        }
        return $post;
    }
    
    public function friends($id){
        $query_friends = DB::select('select * from friends where user_id = :id',['id' => $id]);
        $list = collect([]);
        foreach($query_friends as $friend){
            $list->push($friend->friend_id);
        }
        $info_list = DB::table('userProfiles')->whereIn('user_id',$list)->get();
        return $info_list;
    }
    
    public function main(Request $request){
        $id = Auth::id();
        $info = app('App\Http\Controllers\ProfileController')->info($id);
        $post = app('App\Http\Controllers\ProfileController')->post($id);
        $friends = app('App\Http\Controllers\ProfileController')->friends($id);
        $s = DB::table('friends')->where('user_id',$id)->lists('friend_id');
        $id = collect([]);
        foreach($s as $f){
            $p = DB::table('users')->where('id',$f)->get();
            $p = $p[0]->username;
            $id->push($p);
            
        }
        $in = collect([]);
        foreach($s as $p){
            //return var_dump($p);
            $info = app('App\Http\Controllers\ProfileController')->info($p);
            //return var_dump($info);
            $in->push($info[0]);
        }
        return view('profile', compact('info','post','friends','id','in'));
        //->with(['info' => $info, 'post' => $post, 'friends' => $friends]);
    }
    
    public function post_all(){
        $id = Auth::id();
        $friends = DB::select('select * from friends where user_id = :id',['id' => $id]);
        $list = collect([]);
        foreach($friends as $friend){
            $list->push($friend->friend_id);
        }
        $post_list = DB::table('events')
                    ->whereIn('user_id', $list)->where('view',1)->orderBy('updated_at','desc')
                    ->get();
        $post = collect([]);
        foreach($post_list as $event){
            $id = $event->user_id;
            $profile = DB::select('select * from userProfiles where user_id = :id',['id' => $id]);
            //$name = DB::select('select name from userProfiles where user_id = :id',['id' => $id]);
            $post->push(['name' => $profile[0]->name ,'pic' => $profile[0]->pic , 'content' => $event->content ]);
        }
        return $post;
    }
    
    public function home(){
        $post = app('App\Http\Controllers\ProfileController')->post_all();
        return view('home', compact('post'));
    }
    
    public function createProfileGet(){
        return view('createProfile');
    }
    
    public function createProfilePost(Request $request){
        $id = Auth::id();
        $name = Input::get('name');
        $pic = Input::get('pic');
        //$bpic = Input::get('bpic');
        $dob = Input::get('dob');
        $sex = Input::get('sex');
        $about_me = Input::get('about_me');
        $file1 = Input::file('pic');
        $file = File::get($file1);
        $ext = $file1->getClientOriginalExtension(); 
        $filename =$id.'.'.$ext;
        Storage::put($filename,$file);
        if(!(DB::table('userProfiles')->select('user_id')->where('user_id',$id))){
                DB::table('userProfiles')
        ->insert(['user_id' => $id,'name' => $name, 'pic' => $filename, 'dob' => $dob, 'sex' => $sex, 'about_me' => $about_me ]);
        }
        else {
            DB::table('userProfiles')->where('user_id',$id)
        ->update(['name' => $name, 'pic' => $filename, 'dob' => $dob, 'sex' => $sex, 'about_me' => $about_me ]);
        }
        
        return Redirect::to('profile');
    }
    
    public function image($image){
        $file = Storage::get($image);
        return Response($file,200);
    }
    

    public function status($user_id,$friendId){
        $status = DB::table('request')->where('user_id',$user_id)->where('friend_id',$friendId)->get();
        //return var_dump($status);
        return $status;
    }
    
    public function publicProfile($username){
        $authid = Auth::id();
        $checkname = DB::table('users')->where('id',$authid)->get();
        if($checkname[0]->username == $username){
            return Redirect::to('profile');
        }
        $id = DB::table('users')->where('username',$username)->get();
        $id = $id[0]->id;
        //return var_dump($id);
        $info = app('App\Http\Controllers\ProfileController')->info($id);
        $post = app('App\Http\Controllers\ProfileController')->post($id);
        $friends = app('App\Http\Controllers\ProfileController')->friends($id);
        $status = app('App\Http\Controllers\ProfileController')->status($authid,$id);
        $statusRev = app('App\Http\Controllers\ProfileController')->status($id,$authid);
        //return var_dump($status);
        if($status){
            $status = $status[0]->status;
        }
        elseif ($statusRev) {
            $status = 3;
        if ($statusRev[0]->status == 2) {
            $status = 2;
        }}
        else{
            $status = 0;
        }
        //return var_dump($status);
        return view('publicProfile',compact('info','friends','post','status','id','username'));
    }
    
    public function setRequest($friendId){
        $id = Auth::id();
        $username = Input::get('username');
        $request = DB::table('request')->insert(['user_id' => $id, 'friend_id' => $friendId, 'status' => 1]);
        return Redirect::route('username',$username);
    }
    
    public function updateRequest($id){
        $authid = Auth::id();
        $username = Input::get('username');
        $request = DB::table('request')->where('user_id',$id)->where('friend_id',$authid)->update(['status' => 2]);
        DB::table('friends')->insert(['user_id' => $id,'friend_id' => $authid]);
        DB::table('friends')->insert(['user_id' => $authid,'friend_id' => $id]);
        return Redirect::route('username',$username);
    }
    
    public function requests(){
        $id = Auth::id();
        $s = DB::table('request')->where('friend_id',$id)->where('status',1)->lists('user_id');
        $id = collect([]);
        foreach($s as $f){
            $p = DB::table('users')->where('id',$f)->get();
            $p = $p[0]->username;
            $id->push($p);
            
        }
        $in = collect([]);
        foreach($s as $p){
            //return var_dump($p);
            $info = app('App\Http\Controllers\ProfileController')->info($p);
            //return var_dump($info);
            $in->push($info[0]);
        }
        $stat = collect([]);
        foreach($in as $p){
            $con = DB::table('request')->where('user_id',$p->user_id)->orwhere('friend_id',$p->user_id)->get();
            //return var_dump($con);
            if(!(empty($con[0]))){
                if($con[0]->status == 2){
                    $stat->push(2);
                }
                elseif($con[0]->status == 1||3){
                    $stat->push(1);
                }
            }
            else{
                $stat->push(0);;
            }}
        $searchcheck = 0;
        return view('search',compact('in','id','stat','searchcheck'));
    }
    
    public function searchView(){
        $searchcheck = 1;
        return view('search',compact('searchcheck'));
    }
    
    public function search(){
        $by = Input::get('by');
        $search = Input::get('search');
        $in = DB::table('userProfiles')->where($by,'LIKE','%'.$search.'%')->get();
        //return var_dump($query);
        $id = collect([]);
        foreach($in as $f){
            $p = DB::table('users')->where('id',$f->user_id)->get();
            $p = $p[0]->username;
            $id->push($p);
        }
        $stat = collect([]);
        foreach($in as $p){
            $con = DB::table('request')->where('user_id',$p->user_id)->orwhere('friend_id',$p->user_id)->get();
            //return var_dump($con);
            if(!(empty($con[0]))){
                if($con[0]->status == 2){
                    $stat->push(2);
                }
                elseif($con[0]->status == 1||3){
                    $stat->push(1);
                }
            }
            else{
                $stat->push(0);;
            }
        }
        //return var_dump($stat);
        $searchcheck=0 ;
        return view('search',compact('in','id','search','stat','searchcheck'));
    }
}
