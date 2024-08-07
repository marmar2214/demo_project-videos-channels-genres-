@php $active = 'genres'; @endphp
@extends('layouts.app')
@section('content')

<section class="section">
    <form action="{{ route('genres.update', $genre->id)}}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-10">

                <div class="mb-3">
                    <label for="editName" class="form-label">Name</label>
                    <input type="text" name="name" id="editName" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="editName_mm" class="form-label">Name (MM)</label>
                    <input type="text" name="name_mm" id="editName_mm" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Status</label>
                    <br />
                    <input type="radio" class="btn-check" name="status" value="1" id="editShow" autocomplete="off">
                    <label class="btn btn-success" for="editShow">Show</label>

                    <input type="radio" class="btn-check" name="status" value="0" id="editHide" autocomplete="off">
                    <label class="btn btn-outline-danger" for="editHide">Hide</label>
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
