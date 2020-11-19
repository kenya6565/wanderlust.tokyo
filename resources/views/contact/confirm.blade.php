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
              <p class="Form-Item-Label"><span class="Form-Item-Label-Required" style=" width: auto; padding : 8px;">{{ __('messages.must') }}</span>{{ __('messages.email') }}</p>
              <input type="hidden" class="Form-Item-Input" name="email" value="{{ $inputs['email'] }}">{{ $inputs['email'] }}</input>
            </div>
            <div class="Form-Item">
              <p class="Form-Item-Label"><span class="Form-Item-Label-Required" style=" width: auto; padding : 8px;">{{ __('messages.must') }}</span>{{ __('messages.title_of_inquiry') }}</p>
              <input type="hidden" class="Form-Item-Input"  name="title" value="{{ $inputs['title'] }}">{{ $inputs['title'] }}</input>
            </div>
            <div class="Form-Item">
              <p class="Form-Item-Label isMsg"><span class="Form-Item-Label-Required" style=" width: auto; padding : 8px;">{{ __('messages.must') }}</span>{{ __('messages.content_of_inquiry') }}</p>
              <input type="hidden" class="Form-Item-Textarea" name="body" value="{{ $inputs['body'] }}">{!! nl2br(e($inputs['body'])) !!}</input>
            </div>
            <button type="submit" class= "Form-Btn_gray" name="action" value="back">
              {{ __('messages.fix') }}
            </button>
            <button type="submit" class= "Form-Btn" name="action" value="submit">
             {{ __('messages.send') }}
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection