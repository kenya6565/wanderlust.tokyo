@extends('layouts.app')

@section('content')
<div class="container">
  <div class="pt20 row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <form method="POST" action="{{ route('contact.send') }}">
          @csrf
            <div class="Form-Item">
              <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>メールアドレス</p>
              <input type="hidden" class="Form-Item-Input" name="email" value="{{ $inputs['email'] }}">{{ $inputs['email'] }}</input>
            </div>
            <div class="Form-Item">
              <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>タイトル</p>
              <input type="hidden" class="Form-Item-Input"  name="title" value="{{ $inputs['title'] }}">{{ $inputs['title'] }}</input>
            </div>
            <div class="Form-Item">
              <p class="Form-Item-Label isMsg"><span class="Form-Item-Label-Required">必須</span>お問い合わせ内容</p>
              <input type="hidden" class="Form-Item-Textarea" name="body" value="{{ $inputs['body'] }}">{!! nl2br(e($inputs['body'])) !!}</input>
            </div>
            <button type="submit" class= "Form-Btn_gray" name="action" value="back">
              入力内容修正
            </button>
            <button type="submit" class= "Form-Btn" name="action" value="submit">
                送信する
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection