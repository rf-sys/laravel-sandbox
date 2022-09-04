@extends('layout')

@section('content')
    @foreach ($posts as $post)
        <article>
            <h1 class="{{ $loop->even ? 'even' : '' }}">
                <a href="/posts/{{ $post->id }}">
                    {{ $post->title }}
                </a>
            </h1>
            <div>{{ $post->excerpt }}</div>
        </article>
    @endforeach
@endsection
