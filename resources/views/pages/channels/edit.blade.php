@php $active = 'channels'; @endphp
@extends('layouts.app')
@section('content')

    <section class="section">
        <form action="{{ route('channels.update', $channel->id)}}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-md-10">

                    <div class="card card-body pt-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label fw-bold">Name</label>
                                    <input type="text" name="name" value="{{ $channel->name }}" id="name"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Name .. "
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="name_mm" class="form-label fw-bold">Name (MM)</label>
                                    <input type="text" name="name_mm" value="{{ $channel->name_mm }}" id="name_mm"
                                        class="form-control" placeholder="Name (MM) .. ">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Status</label>
                                    <br />
                                    <input type="radio" class="btn-check" name="status" value="1" id="show"
                                        autocomplete="off" {{ $channel->status === 1 ? 'checked' : '' }}>
                                    <label class="btn btn-outline-success" for="show">
                                        Show Channel
                                    </label>

                                    <input type="radio" class="btn-check" name="status" value="0" id="hide"
                                        autocomplete="off" {{ $channel->status === 0 ? 'checked' : '' }}>
                                    <label class="btn btn-outline-danger" for="hide">
                                        Hide Channel
                                    </label>
                                </div>
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
                                            <img src="{{ asset($channel->image_path) }}" alt="" class="w-25 h25 my-3">
                                            <input type="hidden" name="old_image" id="" value="{{ $channel->image_path }}">
                                        </div>
                                        <div class="tab-pane fade" id="new_image-tab-pane" role="tabpanel" aria-labelledby="new_image-tab"
                                            tabindex="0">
                                            <input type="file" accept="image/*" class="form-control my-3" id="image"
                                                name="new_image">
                                        </div>
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

            </div>
        </form>

    </section>



@endsection
