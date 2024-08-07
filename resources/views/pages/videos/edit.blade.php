@php $active='videos'; @endphp
@extends('layouts.app')
@section('content')

    <section class="section">
        <form action="{{route('videos.update', $video->id )}}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-10">
                    <div class="card card-body pt-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label fw-bold">Title</label>
                                    <input type="text" name="title" value="{{ old('title', $video->title) }}" id="title"
                                        class="form-control @error('title') is-invalid @enderror" placeholder="Title .. "
                                        required>

                                    @error('title')
                                        <div class="alert alert-danger border my-2 py-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="mb-3">
                                <label for="channel" class="form-label">Channels</label>
                                <select class="form-select {{ $errors->has('channels') ? 'is-invalid' : '' }}" name="channels[]" multiple>
                                    <option value="">Choose Channel</option>
                                    @foreach ($channels as $id => $name)
                                        <option value="{{ $id }}"
                                        {{ in_array($id, old('channels', $video->channels->pluck('id')->toArray())) ? 'selected' : '' }}>{{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('channels')
                                    <div class="alert alert-danger border my-2 py-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="vimeo_url" class="form-label fw-bold">Vimeo URL</label>
                                    <input type="text" name="vimeo_url" value="{{ old('vimeo_url', $video->vimeo_url) }}" id="vimeo_url"
                                        class="form-control" placeholder="Vimeo URL .. ">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="youtube_url" class="form-label fw-bold">Youtube URL</label>
                                    <input type="text" name="youtube_url" value="{{ old('youtube_url', $video->youtube_url) }}"
                                        id="youtube_url" class="form-control" placeholder="Youtube URL .. ">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="body" class="form-label fw-bold">Description</label>
                            @error('body')
                                <div class="alert alert-danger border py-1">{{ $message }}</div>
                            @enderror
                            <textarea name="body" id="body" class="form-control" placeholder="Description ..">{{ old('body', $video->body) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="mb-3">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="old_image-tab" data-bs-toggle="tab"
                                            data-bs-target="#old_image-tab-pane" type="button" role="tab"
                                            aria-controls="old_image-tab-pane" aria-selected="true">Old Image</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="new_image-tab" data-bs-toggle="tab"
                                            data-bs-target="#new_image-tab-pane" type="button" role="tab"
                                            aria-controls="new_image-tab-pane" aria-selected="false">New Image</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="old_image-tab-pane" role="tabpanel"
                                        aria-labelledby="old_image-tab" tabindex="0">
                                        <img src="{{ asset( $video->myday_image) }}" alt="" class="w-25 h25 my-3">
                                        <input type="hidden" name="old_image" id="" value="{{ $video->myday_image }}">
                                    </div>
                                    <div class="tab-pane fade" id="new_image-tab-pane" role="tabpanel" aria-labelledby="new_image-tab"
                                        tabindex="0">
                                        <input type="file" accept="image/*" class="form-control my-3" id="new_image"
                                            name="new_image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card card-body position-sticky pt-3 mb-0" style="top: 5rem;">
                        <button type="reset" class="btn btn-outline-dark btn-lg w-100">
                            <i class="bi bi-x-circle"></i>
                            Reset
                        </button>
                        <button type="submit" class="btn btn-success mb-2 btn-lg w-100 mt-2">
                            <i class="bi bi-check-circle"></i>
                            Update
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </section>

@endsection
