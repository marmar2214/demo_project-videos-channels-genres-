@php $active='videos'; @endphp
@extends('layouts.app')
@section('content')
    <section class="section">
        <form action="{{route('videos.store')}}" method="POST" class="needs-validation" novalidate
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-10">
                <div class="card card-body pt-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title" class="form-label fw-bold">Title</label>
                                <input type="text" name="title" value="{{ old('title') }}" id="title"
                                    class="form-control @error('body') is-invalid @enderror" placeholder="Title .. "
                                    required>

                                @error('title')
                                    <div class="alert alert-danger border my-2 py-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="channel" class="form-label fw-bold">Channel Name</label>
                                <select name="channels[]" id="channel" class="form-control" multiple>
                                    <option value="">Select Channel Name ..</option>
                                    @foreach ($channels as $channel)
                                    <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="vimeo_url" class="form-label fw-bold">Vimeo URL</label>
                                <input type="text" name="vimeo_url" value="{{ old('vimeo_url') }}" id="vimeo_url"
                                    class="form-control" placeholder="Vimeo URL .. ">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="youtube_url" class="form-label fw-bold">Youtube URL</label>
                                <input type="text" name="youtube_url" value="{{ old('youtube_url') }}"
                                    id="youtube_url" class="form-control" placeholder="Youtube URL .. ">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label fw-bold">Description</label>
                        @error('body')
                            <div class="alert alert-danger border py-1">{{ $message }}</div>
                        @enderror
                        <textarea name="body" id="body" class="form-control" placeholder="Description .."></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image:</label>
                        <input type="file" accept="images/*" id="myday_image" name="myday_image" class="form-control {{ $errors->has('myday_image') ? 'is-invalid' : '' }}">

                    </div>
                    <div class="col-md-2">
                        <div class="card card-body position-sticky pt-3 mb-0" style="top: 5rem;">
                            <button type="reset" class="btn btn-outline-dark btn-lg w-100">
                                <i class="bi bi-x-circle"></i>
                                Reset
                            </button>
                            <button type="submit" class="btn btn-success mb-2 btn-lg w-100 mt-2">
                                <i class="bi bi-check-circle"></i>
                                Create
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        </form>
    </section>
@endsection
