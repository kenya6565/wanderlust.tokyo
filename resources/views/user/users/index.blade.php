@extends('layouts.app')
@section('title', 'users')
@section('breadcrumbs', Breadcrumbs::render('user_mypage',$user_info))
@section('content')
    <div class="container">
        <div class="row justify-content-center mb50">
            <div class="col-12">
                @if(Auth::user()->is_following($user_info->id) || Auth::id() == $user_info->id || Auth::user()->is_unlocked($user_info->id))
                    <div class="card">
                        <h3 class="card-header">
                            {{ $user_info->name }}
                            @if(Auth::user()->is_locked($user_info->id))
                                <i class="fas fa-user-lock float-left"></i>
                            @endif
                            @if(Auth::id() == $user_info->id)
                                <div class="d-flex justify-content-end flex-grow-1">
                                    @if(Auth::user()->is_locked(Auth::id()))
                                        <form action="{{ route('unlock') }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger">鍵を解除する</button>
                                        </form>
                                    @else
                                        <form action="{{ route('lock') }}" method="POST">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-primary">鍵をかける</button>
                                        </form>
                                    @endif
                                </div>
                            @endif
                        </h3>
                        <div class="card-body">
                            <h6 class="float-right">
                                <p class="font-weight-bolder">フォロワー</p>
                                <a class="text-secondary" href="{{ action('User\FollowsController@showFollowers', ['id' => $user_info->id] )}}">{{ $counts['count_followers'] }}</a>
                            </h6>
                            <h6 class="float-right mr20">
                                <p class="font-weight-bolder">フォロー</p>
                                <a class="text-secondary" href="{{ action('User\FollowsController@showFollowings',  ['id' => $user_info->id] )}}">{{ $counts['count_followings'] }}</a>
                            </h6> 
                            @if(Auth::user()->is_locked(Auth::id()) && Auth::id() == $user_info->id)
                                <h6 class="float-right mr20">
                                    <p class="font-weight-bolder">フォローリクエスト</p>
                                    <a class="text-secondary" href="{{ action('User\FollowsController@showFollowrequests',  ['id' => $user_info->id] )}}">{{ $follow_request_sum }}</a>
                                </h6> 
                            @endif
                            <p class="card-text">
                                {{ $user_info->profile }}
                            </p>
                            @if(Auth::id() == $user_info->id)
                 
                            @elseif(Auth::user()->is_following($user_info->id))
                                <form action="{{ route('unfollow', ['id' => $user_info->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger">フォロー解除</button>
                                </form>
                            @else(Auth::user()->is_following($user_info->id))
                                <form action="{{ route('follow', ['id' => $user_info->id]) }}" method="POST">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-primary">フォローする</button>
                                </form>
                            @endif
                            @if(Auth::id() == $user_info->id)
                                <a href="{{ action('User\PagesController@edit', ['id' => $user_info->id] )}}" role="button" class="btn btn-secondary">編集</a>
              
                            @endif
                        </div>
                    </div>
                    <div class="row justify-content-center container pt20">
                        @foreach($posts as $post)
                            <div class="col-lg-4 col-12 mb50">
                                <div class="card">
                                    @if(isset($post->firstPhoto()->image))
                                        <img class="card-img-top" src="{{ Storage::disk('s3')->url('public/images/' . $post->firstPhoto()->image) }}">
                                    @else
                                        <img class="card-img-top" src="{{ asset('images/'.'noimageavailable.png') }}">
                                    @endif
                                    <div class="card-body">
                                        <h4 class="card-title">{{ $post->title }}</h4>
                                        <p class="card-text">
                                            <div>{{ $post->post }}</div>
                                        </p>
                                        <a href="{{ action('User\TimelineController@show',  $post->id )}}" class="btn btn-secondary">詳細</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading"><i class="fas fa-user-lock">{{ $user_info->name }}はロックされています</i></h4>
                        @if(Auth::user()->is_follow_requesting($user_info->id))
                            <div class="d-flex justify-content-end flex-grow-1">
                                <form action="{{ route('unfollowRequest', ['id' => $user_info->id]) }}"  method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger">フォローリクエスト解除</button>
                                </form>
                            </div>
                        @else
                            <div class="d-flex justify-content-end flex-grow-1">
                                <form action="{{ route('followRequest', ['id' => $user_info->id]) }}"  method="POST">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-primary">フォローリクエスト</button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
@endsection