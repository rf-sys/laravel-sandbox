@extends('layout')

@section('content')
    <article>
        <h1>
            <a href="/posts/{{ $post->id }}">
                {!! $post->title !!}
            </a>
        </h1>
        <div>{!! $post->body !!}</div>
    </article>
    <a href="/">Go Back</a>
@endsection
