@php $active = 'channels'; @endphp
@extends('layouts.app')
@section('content')
    <form action="{{route('channels.store')}}" method="POST" class="needs-validateion" novalidate enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div col-md-10>
                <div class="card card-body pt-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">Name</label>
                                <input type="text" name="name" value="{{old('name')}}" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name .. " required>
                            </div>
                            <div class="mb-3">
                                <label for="name_mm" class="form-label fw-bold">Name (MM)</label>
                                <input type="text" name="name_mm" value="{{ old('name_mm') }}" id="name_mm"
                                    class="form-control" placeholder="Name (MM) .. ">
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image:</label>
                                <input type="file" accept="images/*" id="image_path" name="image_path" class="form-control{{ $errors->has('image_path') ? 'is-invalid' : '' }}">
                                @if ($errors->has('image_path'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('image_path') }}
                                    </div>
                                @endif
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
                                    Create
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


@endsection
