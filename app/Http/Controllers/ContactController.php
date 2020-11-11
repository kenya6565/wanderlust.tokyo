<?php

namespace App\Http\Controllers;

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

class ContactController extends Controller
{
    public function index()
    {
      //フォーム入力画ページのviewを表示
      return view('contact.index');
    }

    public function confirm(Request $request)
    {
      $request->validate([
          'email' => 'required|email',
          'title' => 'required',
          'body'  => 'required',
      ]);
    
      //フォームから受け取ったすべてのinputの値を取得
      $inputs = $request->all();

      //入力内容確認ページのviewに変数を渡して表示
      return view('contact.confirm', [
          'inputs' => $inputs,
      ]);
    }


    public function send(Request $request)
    {
    }
}