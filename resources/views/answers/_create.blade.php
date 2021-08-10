<div class="row mt-4 justify-content-center">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3>Your Ans</h3>
            </div>
            <div class="card-body">
                <form action="{{route('questions.answers.store',$question->id)}}" method="post">
                    @csrf
                    <div class="form-group">
                                <!-- <label for="">Enter Question</label> -->
                                <input type="hidden" id="body" name="body" value="{{old('body')}}">
                                <trix-editor input="body" class="form-control {{$errors->has('body') ? 'is-invalid':''}}"></trix-editor>
                                @error('body')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-success">Submit</button>
                            </div>
                </form>
            </div>
        </div>
    </div>
    @section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js "></script>
@endsection
</div>