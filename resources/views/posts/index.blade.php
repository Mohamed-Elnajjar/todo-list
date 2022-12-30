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

                @if (session()->has('danger'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('danger') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session()->has('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ session('warning') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (count($posts) > 0)
                    <div style="height: 300px;overflow-Y: auto;" class="mt-5">
                        @foreach ($posts as $post)
                            <div class="card mt-4">
                                <ul class="list-group list-group-flush">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <img style="width: 100%" src="/images/posts/{{ $post->image }}">
                                        </div>
                                        <div class="col-md-8 col-12">
                                            <h3>
                                                {{ $post->title }}
                                            </h3>
                                            <small>Written on {{ $post->created_at }}</small>
                                            <a href="/posts/{{ $post->id }}"
                                                class="btn btn-sm btn-info float-right mr-2">Show</a>
                                            {{-- {{ route('posts.edit', ['post' => $post->id]) }} --}}
                                            <a href="/posts/{{ $post->id }}/edit"
                                                class="btn btn-sm btn-warning float-right mr-2">Edit</a>

                                            {{-- <a href="{{ route('posts.destroy', ['post' => $post->id]) }}"
                                                class="btn btn-sm btn-danger float-right mr-2">Delete</a> --}}

                                            <form action="/posts/{{ $post->id }}" method="post"
                                                style="display: inline">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"
                                                    class="btn btn-sm btn-danger float-right mr-2 delete_post">Delete
												</button>
                                            </form>
                                        </div>
                                    </div>
                                </ul>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
