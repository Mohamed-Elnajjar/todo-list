@extends('layouts.app')
@section('content')

<div class="container">
	<div class="card mt-4">
        <ul class="list-group list-group-flush">
            <div class="row">
                <div class="col-md-4 col-12">
                    <img style="width: 100%" src="/images/posts/{{ $show->image }}">
                </div>
                <div class="col-md-8 col-12">
                    <h3 class="p-2">
                        Title is => {{ $show->title }}
                    </h3>
                    <hr>
                    <p class="p-2">
						Body is => {{ $show->body }}
					</p>
                    <hr>
                    <small>
						Written on Create is => {{ $show->created_at }}
					</small>
                    <br>
                    <small>
						Written on Update is => {{ $show->updated_at }}
					</small>
                </div>
            </div>
        </ul>
    </div>
</div>

@endsection
