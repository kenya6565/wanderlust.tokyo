@extends('layouts.app')

@section('content')
<div class="container">
  <div class="pt20 row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        @if ($errors->has('email'))
          <p class="error-message" style="margin-left: 20px; padding-top: 20px; font-size: 0.7rem; color: red;">{{ $errors->first('email') }}</p>
        @endif
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