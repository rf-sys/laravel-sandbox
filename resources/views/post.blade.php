@extends('layout')

@section('content')
    <article>
        <h1>
            <a href="/posts/{{ $post->id }}">
                {!! $post->title !!}
            </a>
        </h1>

        <p>

            By <a href="#">{{ $post->user->name }}</a> in <a href="/categories/{{ $post->category->slug  }}">{{ $post->category->name }}</a>
        </p>

        <div>{!! $post->body !!}</div>
    </article>
    <a href="/">Go Back</a>
@endsection
