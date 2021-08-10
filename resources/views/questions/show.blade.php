@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="justify-content-center row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-heading">
                        <h1>{{$question->title}}</h1>
                    </div>
                    <div class="card-body">
                        <div>{!!$question->body!!}</div>
                    </div>
                    <div class="card-footer">
                    <div class="d-flex justify-content-between mr-3">
                            <div class="d-flex">
                            <div>
                                    @auth
                                    <form action="{{route('questions.vote',[$question->id,1])}}" method="post">
                                        @csrf
                                        <button class="btn {{auth()->user()->hasQuestionUpVote($question)?'text-dark' : 'text-black-50'}}" type="submit" title="Up Vote">
                                            <i class="fa fa-caret-up fa-3x"></i>
                                        </button>
                                    </form>
                                    @else
                                    <a href="" title="vote-up" class="vote-up d-block text-center text-black-50">
                                    <i class="fa fa-caret-up fa-3x"></i>    
                                </a>
                                    @endauth
                                    <h4 class='votes_count text-center text-muted m-0'>{{$question->votes_count}}</h4>
                                    @auth
                                    <form action="{{route('questions.vote',[$question->id,-1])}}" method="post">
                                        @csrf
                                        <button class="btn {{auth()->user()->hasQuestionUpVote($question)?'text-dark' : 'text-black-50'}}" type="submit" title="Up Vote">
                                            <i class="fa fa-caret-down fa-3x"></i>
                                        </button>
                                    </form>
                                    @else
                                    <a href="" title="vote-up" class="vote-up d-block text-center text-black-50">
                                    <i class="fa fa-caret-up fa-3x"></i>    
                                </a>
                                    @endauth
                                </div>
                                <div class="ml-5 mt-3">
                                            <form action="{{route($question->is_favorite ? 'questions.unfavorite':'questions.favorite', $question->id)}}" method="post">
                                                @csrf
                                                @if($question->is_favorite)
                                                    @method('DELETE')
                                                @endif
                                                <button type="submit" class="btn {{ $question->is_favorite ? 'text-dark':'text-black-50'}}">
                                                    <i class="fa fa-star fa-2x"></i>
                                                </button>
                                            </form>
                                            </i>
                                            <h4 class="views-count text-muted text-center m-0">123</h4>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @include('answers._index')
        @include('answers._create')
    </div>
@endsection