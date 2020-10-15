<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TimelineGuestControllerTest extends TestCase
{
    //use RefreshDatabase;
     //未ログイン時
    public function test_showTimelinePage_Guest()
    {
        $response = $this->get(route('guest_timeline'));
        
        //タイムラインに遷移しているか
        $response->assertStatus(200)->assertViewIs('guest.timeline.index');
        
        //ゲストとして画面遷移しているか
        $this->assertGuest($guard = null);
    }
    
    public function test_showPostDetail_Guest()
    {
        $response = $this->get(route('guest_postdetail',['id' => '2']));
        $response->assertStatus(200)->assertViewIs('guest.timeline.detail');
            
         //postテーブルのidが1である投稿に正しくアクセスできているか確認
        $response->assertSee('ピラミッド エジプト'); 
    }
    
    //昇順になっているか
    public function test_sortAsc_Guest()
    {
        $response = $this->get(route('guest_timeline',['sort'=>'asc']));
        
        //タイムラインに遷移しているか
        $response->assertStatus(200)->assertViewIs('guest.timeline.index');
        $response->assertSeeText('ピラミッド エジプト'); 
        //ゲストとして画面遷移しているか
        $this->assertGuest($guard = null);
    }
    
    //降順になっているか
    public function test_sortDesc_Guest()
    {
        $response = $this->get(route('guest_timeline',['sort'=>'desc']));
        
        //タイムラインに遷移しているか
        $response->assertStatus(200)->assertViewIs('guest.timeline.index');
        $response->assertDontSee('エッフェル塔　フランス'); 
        //ゲストとして画面遷移しているか
        $this->assertGuest($guard = null);
    }
    
    // public function test_language()
    // {
    //     $response = $this->get(route('lang.switch','日本語'));
        
    //     //タイムラインに遷移しているか
    //     $response->assertStatus(200)->assertViewIs('guest.timeline.index');
    //     $response->assertSee('タイムライン'); 
    //     //ゲストとして画面遷移しているか
    //     $this->assertGuest($guard = null);
    // }
    
  
    
   
    
    
}
