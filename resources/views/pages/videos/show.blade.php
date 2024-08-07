@php $active='videos'; @endphp
@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card mb-3">
            <iframe width="800" height="500" src="https://www.youtube.com/embed/{{ $video->youtube_url }}?rel=0"
                title="{{ $video->youtube_title }}" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen></iframe>
            <div class="card-body">
                <h5 class="card-title text-decoration-underline">{{ $video->title }}</h5>
                {{-- @foreach ($video->channels as $channel) --}}
                    <p class="card-text">{{ $video->channel_names }}</p>
                {{-- @endforeach --}}
                <p class="card-text">{{ $video->vimeo_url}}</p>
                    <p class="card-text">{{ $video->youtube_url}}</p>
                    <p class="card-text">{{$video->body}}</p>
                </p>
            </div>
        </div>
    </div>
@endsection
