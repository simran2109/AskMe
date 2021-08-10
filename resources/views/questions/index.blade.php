@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="d-flex justify-content-end mb-2">
                    <a href="{{ route('questions.create') }}" class="btn btn-outline-primary">Ask a Question!</a>
                </div>

                <div class="card">
                    <div class="card-header">All Questions</div>
                    @foreach ($questions as $question)
                        <div class="card-body">
                            <div class="media">
                                <div class="mr-4 statistics">
                                    <div class="vo tes text-center mb-3">
                                        <strong class="d-block">{{$question->votes_count}}</strong> Votes
                                    </div>
                                    <div class="text-center mb-3 answers {{$question->answer_style}}">
                                        <strong class="d-block">{{$question->answers_count}}</strong>Answers
                                    </div>
                                    <div class="views text-center mb-3">
                                        <strong class="d-block">{{$question->views_count}}</strong> Views
                                    </div>

                                </div>
                                <div class="media-body">
                                    <h4><a href="{{ $question->url }}">{{$question->title}}</a></h4>
                                    <p>
                                        Asked By: <a href="#">{{$question->owner->name}}</a>
                                        <span class="text-muted">{{$question->created_date}}</span>
                                    </p>
                                    <p>{!! Str::limit($question->body,255) !!}</p>
                                    @if(auth()->check() && auth()->user()->can('update',$question))
                                    <a href="{{route('questions.edit',$question->id)}}" class="btn btn-outline-info btn-sm">edit</a>
                                    @endif
                                    @can('delete',$question)
                                    <form action="{{route('questions.destroy',$question->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-info" type="submit">Delete</button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    <div class="card-footer">
                        {{ $questions->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection