@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8-md col-12">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                {{-- /posts/{{ $edit->id }} --}}
                {{-- {{ route('posts.update', ['post' => $edit->id]) }} --}}
                <form action="/posts/{{ $edit->id }}" method="post" enctype="multipart/form-data" class="md-3">
                    @csrf
                    @method('put')
                    {{-- {{ method_field('PUT') }} --}}
                    <legend>Update POST</legend>

                    <div class="md-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" id="title" name="title" value="{{ $edit->title }}"
                            placeholder="enter title" required class="form-control mb-3" />
                    </div>

                    <div class="md-3">
                        <label for="body" class="form-label">Body</label>
                        <textarea name="body" id="body" cols="40" rows="10" required placeholder="enter body"
                            class="form-control mb-3">{{ $edit->body }}</textarea>
                    </div>

                    <div class="md-3">
                        <label for="photo" class="form-label">Select Image: {{ $edit->image }}</label>
                        <input type="file" id="photo" name="image" value="{{ $edit->image }}" accept="image/*"
                            class="form-control form-control-file mb-3" />
                    </div>

                    <div class="md-3">
                        <button type="submit" title="send data to database four-app"
                            class="btn btn-sm btn-warning form-control form-control-lg">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
