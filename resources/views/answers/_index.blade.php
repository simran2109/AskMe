<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="mt-0">{{Str::plural('Answer',$question->answer_count)}}</h3>
            </div>
            <div class="card-body">
                @foreach ($question->answers as $answer)
                    {!! $answer->body !!}
                    <div class="d-flex justify-content-between mr-3 mt-2">
                        <div class="card-footer">
                            <div class="d-flex">
                                <div class="">
                                    <a href="" title="Up Vote" class="vote-up d-block text-center text-black-50">
                                        <i class="fa fa-caret-up fa-3x"></i>
                                    </a>
                                    <h4 class="votes-count text-muted text-center m-0">45</h4>
                                    <a href="" title="Down Vote" class="vote-down d-block text-center text-black-50">
                                        <i class="fa fa-caret-down fa-3x"></i>
                                    </a>
                                </div>
                                <div class="ml-5 mt-3">
                                    @can('markAsBest',$answer)
                                        <form action="{{route('answers.bestAnswer',$answer->id)}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn {{ $answer->best_answer_style}}">
                                                <i class="fa fa-check fa-2x text-black"></i>
                                            </button>
                                        </form>
                                    @else
                                        @if ($answer->is_best_answer)
                                            <i class="fa fa-check fa-2x text-success d-block mb-2"></i>
                                        {{-- @else
                                            <i class="fa fa-check fa-2x text-dark d-block mb-2"></i> --}}
                                        @endif
                                    @endcan
                                    <h4 class="views-count text-muted text-center m-0">123</h4>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mr-3">
                            <div>
                                @can('update', $answer)
                                    <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}" class="btn btn-sm btn-outline-info">Edit</a>
                                @endcan

                                @can('delete', $answer)
                                    <form action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}" class="d-inline" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure?');" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                @endcan
                            </div>
                        </div>

                        <div class="d-flex flex-column">
                            <div class="text-muted mb-2 text-right">
                                <p>Answered {{$answer->created_date}}</p>
                            </div>
                            <div class="d-flex mb-2">
                                <div>
                                    <img src="{{$answer->author->avatar}}" alt="">
                                </div>
                                <div class="mt-2 ml-2">
                                    <p>{{ $answer->author->name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>