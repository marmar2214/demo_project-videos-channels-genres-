@php $active='genres'; @endphp
@extends('layouts.app')

@section('content')
    <section class="section">
        @if (session()->has('msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('msg') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-9">
                <div class="card card-body pt-4">
                    <div class="table-responsive">
                        <form action="{{ route('genres.index') }}" method="GET" class="mb-3">
                            <input type="text" name="search" value="{{ $search }}" placeholder="Search genres...">
                            <button type="submit">Search</button>
                        </form>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%">No:</th>
                                    <th class="text-start">Name</th>
                                    <th class="text-start">Name (MM)</th>
                                    <th width="5%">Status</th>
                                    <th width="10%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($genres as $genre )
                                    <tr class="text-center align-middle">
                                        <td>{{$loop->iteration}}</td>
                                        <td class="text-start">{{ $genre->name }}</td>
                                        <td class="text-start">{{ $genre->name_mm }}</td>
                                        <td>
                                            @if ($genre->status)
                                                <i class="bi bi-check-circle text-success"></i>
                                            @else
                                                <i class="bi bi-x-circle text-danger"></i>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" class="me-2 edit-genre" data-id="{{ $genre->id }}" data-name="{{ $genre->name }}" data-name-mm="{{ $genre->name_mm }}" data-status="{{ $genre->status }}">
                                                <i class="bi bi-pencil-square text-warning"></i>
                                            </a>
                                            <a href="{{ route('genres.destroy', $genre->id) }}"
                                                onclick="return confirm('Are you sure to delete?');">
                                                <i class="bi bi-trash3 text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No genres found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- Create Section --}}
            <div class="col-md-3">
                <div class="card card-body pt-4">
                    <form action="{{route('genres.store')}}" method="POST" id="genreForm">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Genre Name..." required>
                        </div>
                        <div class="mb-3">
                            <label for="name_mm" class="form-label">Name (MM)</label>
                            <input type="text" name="name_mm" id="name_mm" class="form-control" placeholder="Genre Name (MM)..." required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <br />
                            <input type="radio" class="btn-check" name="status" value="1" id="show"
                                autocomplete="off">
                            <label class="btn btn-success" for="show">
                                Show
                            </label>

                            <input type="radio" class="btn-check" name="status" value="0" id="hide"
                                autocomplete="off">
                            <label class="btn btn-outline-danger" for="hide">
                                Hide
                            </label>
                        </div>
                        <div >
                            <div class="row float-end">
                                <div class="col-6">
                                    <button type="reset" class="btn btn-outline-dark">
                                        Clear
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button type="submit" class="btn btn-success me-2">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>

@endsection
