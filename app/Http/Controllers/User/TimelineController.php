<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Http\Controllers;
use App\Library\BaseClass;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use \App\Post;
use \App\PostPhoto;
use \App\Comment;
use \App\User;
use Storage;

class TimelineController extends Controller
{
 
    public function index(Request $request)
    {
        //自分の投稿とフォローしてるユーザの投稿を取得してそれを作成日時順で表示
       // もしログインユーザが誰かをフォローしていたならforeachでフォローしてるユーザ１つ１つの投稿を取得
        $user_id = [Auth::id()];
        if(count(Auth::user()->followings) > 0) {
            foreach( Auth::user()->followings as $following_user) {
                //フォローしてるユーザーのID＋ログインユーザのID
                array_push($user_id,$following_user->id);
            }
        }
        //postsテーブルのユーザID(投稿ユーザ)にフォローしてるユーザのIDかログインユーザのIDがあったら取得
        if($request->sort == "asc"){
            $all_posts = Post::whereIn('user_id',$user_id)
                           ->orderBy('id','ASC')
                           ->paginate(9);
        }else{
            $all_posts = Post::whereIn('user_id',$user_id)
                           ->orderBy('id','DESC')
                           ->paginate(9);
        }
                
        return view('user.timeline.index',compact(
            'all_posts'
        ));
        
    }
   
    public function post(Request $request)
    {
        $this->validate($request, Post::$rules);
        $form = $request->all();
        $post = new Post;
        $post->fill($form)->fill(['user_id' => Auth::id()])->save();
        if($request->hasFile('image')){
            //dd($images);
            foreach($request->file('image') as $image){
                //$image->store('/public/images');
                //どんなサイズ形式でもjpegになって投稿される
                $image_hash = $image->hashName(). '.jpg';
                PostPhoto::create([
                    'post_id' => $post->id,
                    'image' => $image_hash,
                ]);
                $image_s3 = \Image::make($image)->resize(416,416)->encode('jpg');
                Storage::disk('s3')->put('public/images/' . $image_hash ,$image_s3,'public');
                //デフォルトでこの値はstorage/appディレクトリに設定されています。
                //Storage::putFile('dir', $file);
                // で$fileを'dir'に保存することができます。Storage::putFileでは
                // ファイル名は自動で設定されます。
            }
        }
        return redirect(route('user_timeline'))->with('flash_message', '投稿が完了しました');
    }
    
    public function show(Request $request)
    {
        $post = Post::find($request->id);
        $user_info = User::find($post->user_id);
        //投稿詳細で開いているpost以外の全ての同一ユーザの投稿を取得
        $recent_posts = Post::where('user_id',$post->user_id)
                            ->whereNotIn('id',[$post->id])
                            ->get();
        $images = $post->photos;
        //１つの投稿を表示する際それについてるコメントを表示

        $comments = Comment::where('post_id',$post->id)->get();
        //dd($comments);
        return view('user.timeline.detail', compact(
            'post',
            'comments',
            'recent_posts',
            'images',
            'user_info'
        ));
    }
    
    public function edit(Request $request)
    {
        $edit_post = Post::find($request->id);
        $post = Post::find($request->id);
        $user_info = $post->User;
       
        return view('user.timeline.edit',compact(
            'post',
            'edit_post',
            'user_info'
        ));
    }
    
    public function update(Request $request)
    {
        $this->validate($request, Post::$rules);
        $post= Post::find($request->id);
        $updated_post = $request->all(); 
        $post->fill($updated_post)->save();
        
        return redirect(route('user_timeline')); 
    }
   
    public function delete(Request $request)
    {
       
        $deleted_post = Post::find($request->id);
        $deleted_photos = $deleted_post->photos;
        if($deleted_photos->count() > 0) {
            foreach($deleted_photos as $deleted_photo) {
                //s3内の画像を削除
                Storage::disk('s3')->delete('public/images/' . $deleted_photo->image);
                //DB内の画像を削除
                $deleted_photo->delete();
            }
        }
        //投稿自体を削除
        $deleted_post->delete();

        return redirect(route('user_timeline')); 
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $user_info = User::find(Auth::id());
        if (isset($keyword)) {
            $results = Post::where('title', 'like','%'.$keyword.'%')
                   ->orderBy('created_at','DESC')
                   ->paginate(9);
        }else{
            $results = null;
        }
     
        return view('user.timeline.search', compact(
            'results',
            'keyword',
            'user_info'
            
        ));
    }
    
    public function comment(Request $request)
    {
        $this->validate($request, Comment::$rules);
        Comment::create([ 
            'user_id' => Auth::id(), 
            'post_id' => $request->post_id,
            'comment' => $request->comment, 
        ]);
        return redirect(route('user_postdetail',['id'=>$request->post_id]))->with('flash_message', 'コメントが完了しました');
    }
}
