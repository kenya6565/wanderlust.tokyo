@extends('layouts.app')

@section('content')
<!-- <form method="POST" action="{{ route('contact.confirm') }}">
    @csrf

    <label>メールアドレス</label>
    <input
        name="email"
        value="{{ old('email') }}"
        type="text">
    @if ($errors->has('email'))
        <p class="error-message">{{ $errors->first('email') }}</p>
    @endif

    <label>タイトル</label>
    <input
        name="title"
        value="{{ old('title') }}"
        type="text">
    @if ($errors->has('title'))
        <p class="error-message">{{ $errors->first('title') }}</p>
    @endif


    <label>お問い合わせ内容</label>
    <textarea name="body">{{ old('body') }}</textarea>
    @if ($errors->has('body'))
        <p class="error-message">{{ $errors->first('body') }}</p>
    @endif

    <button type="submit">
        入力内容確認
    </button>
</form> -->
<div class="container">
  <div class="pt20 row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <form method="POST" action="{{ route('contact.confirm') }}">
          @csrf
            <div class="Form-Item">
              <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>{{ __('messages.email') }}</p>
              <input type="text" class="Form-Item-Input @error('email') is-invalid @enderror" placeholder="example@gmail.com"  name="email" value="{{ old('email') }}" required autocomplete="email">
             
            </div>
            <div class="Form-Item">
              <p class="Form-Item-Label"><span class="Form-Item-Label-Required">必須</span>{{ __('messages.title_of_inquiry') }}</p>
              <input type="text" class="Form-Item-Input @error('title') is-invalid @enderror" placeholder="{{ __('messages.example') }}" name="title" value="{{ old('title') }}" required autocomplete="title">
            </div>
            <div class="Form-Item">
              <p class="Form-Item-Label isMsg"><span class="Form-Item-Label-Required">必須</span>{{ __('messages.content_of_inquiry') }}</p>
              <textarea class="Form-Item-Textarea @error('body') is-invalid @enderror" name="body" required autocomplete="body">{{ old('body') }}</textarea>
            </div>
            <input type="submit" class="Form-Btn" value="入力内容確認">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection