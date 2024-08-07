@php $active = 'videos'; @endphp
@extends('layouts.app')
@section('content')

    <section class="section">
        @if (session()->has('msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('msg') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        <div class="card card-body pt-4">
            <form action="" method="GET">
                <div class="row gy-0">
                    <div class="col-sm-3">
                        <div class="mb-2">
                            <input type="search" name="search_id" value="{{ request()->input('search_id') }}"
                                class="form-control" placeholder="Search by ID ..">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="mb-2">
                            <input type="search" name="search_title" value="{{ request()->input('search_title') }}"
                                class="form-control" placeholder="Search by title ..">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="mb-2">
                            <input type="date" name="search_date" value="{{ request()->input('search_date') }}"
                                class="form-control" placeholder="Search by ID ..">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-dark">
                            <i class="bi bi-search"></i>
                        </button>
                        <a href="{{ route('videos.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-repeat"></i>
                        </a>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                {{-- Pagination --}}
                {{ $videos->links() }}
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr class="text-center">
                            <th width="5%">No:</th>
                            <th class="text-start">Title</th>
                            <th width="10%">Channel</th>
                            <th width="10%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($videos as $video)
                            {{-- {{dd($video)}} --}}
                            <tr class="text-center align-middle">
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-start">
                                    <span class="text-capitalize">{{ $video->title }}</span>
                                </td>

                                <td>{{ $video->channel_names }}</td>


                                <td>
                                    <a href="{{ route('videos.show', $video->id) }}" class="me-2">
                                        <i class="bi bi-eye text-primary"></i>
                                    </a>
                                    <a href="{{ route('videos.edit', $video->id) }}" class="me-2">
                                        <i class="bi bi-pencil-square text-warning"></i>
                                    </a>
                                    <a href="{{ route('videos.remove', $video->id) }}"
                                        onclick="return confirm('Are you sure to delete?');">
                                        <i class="bi bi-trash3 text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <th colspan="5">No data yet ..</th>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </section>


@endsection
