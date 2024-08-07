@php $active = 'channels'; @endphp
@extends('layouts.app')
@section('content')

<section>
    @if (session()->has('msg'))
        <div class="alert alert-success alert-dismissible  show" role="alert">
            {{session()->get('msg')}}
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    @endif

    {{-- Pagination --}}
    {{ $channels->links() }}



    <div class="card card-body pt-4">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="text-center">
                        <th width="5%">No:</th>
                        <th width="10%">Image</th>
                        <th class="text-start">Name</th>
                        <th class="text-start">Name (MM)</th>
                        <th width="5%">Status</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($channels as $channel)
                        <tr class="text-center align-middle">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($channel->image_path)
                                    <img src="{{ asset($channel->image_path) }}" alt="Channel Image" class="rounded-pill"
                                        width="60" height="60">
                                @endif
                            </td>
                            <td class="text-start">
                                <span class="text-capitalize">{{ $channel->name }}</span>
                            </td>
                            <td class="text-start">
                                <span class="text-capitalize">{{ $channel->name_mm }}</span>
                            </td>
                            <td>
                                @if ($channel->status)
                                    <i class="bi bi-check-circle text-success"></i>
                                @else
                                    <i class="bi bi-x-circle text-danger"></i>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('channels.toggle', $channel->id) }}" class="me-2"
                                    onclick="return confirm('Are you sure?');">
                                    <i class="bi bi-arrow-repeat text-info"></i>
                                </a>
                                <a href="{{ route('channels.edit', $channel->id) }}" class="me-2">
                                    <i class="bi bi-pencil-square text-warning"></i>
                                </a>
                                <a href="{{ route('channels.remove', $channel->id) }}"
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
