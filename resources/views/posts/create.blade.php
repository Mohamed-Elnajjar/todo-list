@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8-md col-12">
                <form action="{{ url('/posts') }}" method="post" enctype="multipart/form-data" class="md-3">
                    @csrf
                    <legend>Create POST</legend>

                    <div class="md-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" id="title" name="title" placeholder="enter title" required
                            class="form-control mb-3" />
                    </div>

                    <div class="md-3">
                        <label for="body" class="form-label">Body</label>
                        <textarea name="body" id="body" cols="40" rows="10" required placeholder="enter body"
                            class="form-control mb-3"></textarea>
                    </div>

                    <div class="md-3">
                        <label for="image" class="form-label">Select Image</label>
                        <input type="file" id="image" name="image" placeholder="select your photo" accept="image/*"
                            class="form-control form-control-file mb-3" />
                    </div>
                    <div class="md-3">
                        <button type="submit" title="send data to database four-app"
                            class="btn btn-sm btn-primary form-control form-control-lg">Create Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
