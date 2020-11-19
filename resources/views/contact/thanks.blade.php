@extends('layouts.app')

@section('content')

<div class="container">
  <div class="pt20 row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-body" style="text-align:center;">
            <h1><br>{{ __('messages.complete') }}</br></h1>
            @if(Auth::check())
              <a href="{{ action('User\TimelineController@index' )}}">{{ __('messages.back') }}</a>
            @else
              <a href="{{ action('Guest\TimelineController@index' )}}">{{ __('messages.back') }}</a>
            @endif
        </div>
      
      </div>
    </div>
  </div>
</div>
@endsection