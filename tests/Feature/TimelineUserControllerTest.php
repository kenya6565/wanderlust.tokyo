<?php

namespace Tests\Feature;

use App\User;
use App\Post;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\ImageService;

class TimelineUserControllerTest extends TestCase
{
  
    //use RefreshDatabase;

    //タイムライン表示
    public function test_login()
    {
        $user = factory(User::class)->create();
        
        //ログイン状態でタイムラインに遷移しているか
        $response = $this->actingAs($user)->get(route('user_timeline'));
        $response->assertStatus(200)->assertViewIs('user.timeline.index');
        
        //ログイン状態であるか
        $this->assertAuthenticated($guard = null);
    }
    
    public function test_logout()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->assertTrue(Auth::check());
     
         // ログアウトを実行
        Auth::logout();
        
        // Welcomeページにリダイレクトすることを確認
        //$response->assertRedirect('/');
         // 認証されていない
        $this->assertGuest($guard = null);

    }
    
    public function test_showPostDetail()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get(route('user_postdetail',['id' => '2']));
        $response->assertStatus(200)->assertViewIs('user.timeline.detail');
        // /$response->dump();
         //postテーブルのidが1である投稿に正しくアクセスできているか確認
        $response->assertSee('ピラミッド エジプト'); 
    }
    
    public function test_showMyPage()
    {
        //ログイン状態でマイページにアクセスできているか
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get(route('mypage',['id' => '4']));
        $response->assertStatus(200)->assertViewIs('user.users.index');
        $response->assertSee('テストユーザー'); 
    }
    
    //投稿
    public function test_post()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();
        $response = $this->actingAs($user)->get(route('user_timeline'));
        $response->assertStatus(200)->assertViewIs('user.timeline.index');
        $this->assertDatabaseHas('posts', [
            'post' => $post['post'],
            'title' => $post['title'],
        ]);
    }
    
    public function test_postDelete()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();
        $response = $this->actingAs($user)->get(route('user_postdetail',['id' => $post['id']]));
        \App\Post::where('title', $post['title'])->delete();
        $response->assertStatus(200);
       
        $this->assertDatabaseMissing('posts', [
            'title' => $post['title'],
        ]);
    }
    
    //画像がアップされてるか
    public function testUploadImage()
    {
        Storage::fake('design'); // テスト後ファイルは削除される
        // UploadedFileクラス用意
        $uploadedFile = UploadedFile::fake()->image('design.jpg');
        $uploadedFile->move('storage/framework/testing/disks/design');
        // storage/framework/testing/disks/design内に該当ファイルが存在するか
        // S3にアップロードされたかはS3のバケットを確認しました。
        Storage::disk('design')->assertExists($uploadedFile->getFilename());

    }
    
    // public function test_follow()
    // {
    //     $user = factory(User::class)->create();
    //     $response = $this->actingAs($user)->get(route('user_postdetail',['id' => '2']));
    //     $response->assertStatus(200)->assertViewIs('user.timeline.detail');
    //     // /$response->dump();
    //      //postテーブルのidが1である投稿に正しくアクセスできているか確認
    //     $response->assertSee('ピラミッド エジプト'); 
    // }
    
    //フォローメソッドのテスト→factoryでユーザを作らずにテストユーザでログインして実際にフォローする
    
}
