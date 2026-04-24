@extends('layouts.main')

@section('container')
    <div class="container-fluid py-2">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-0 h4 font-weight-bolder">Guest List</h3>
                <p class="mb-0 text-sm">{{ $event->title }} - {{ $event->event_name }}</p>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('guests.create', ['event_id' => $event->id]) }}" class="btn bg-gradient-dark">
                    ➕ Add Guest
                </a>

                <a href="{{ route('events.show', $event->id) }}" class="btn btn-light">
                    ← Back
                </a>
            </div>
        </div>

        {{-- CARD --}}
        <div class="card">
            <div class="card-body">

                @if ($guests->count())
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">

                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">No</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Name</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Slug</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder">Action
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($guests as $index => $guest)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>

                                        <td>
                                            <strong>{{ $guest->name }}</strong>
                                        </td>

                                        <td>
                                            <span class="badge bg-gradient-secondary">
                                                {{ $guest->slug }}
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            <a href="#" class="btn btn-sm btn-outline-warning">
                                                Edit
                                            </a>

                                            <form action="#" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <h6 class="text-muted">Belum ada guest 😢</h6>
                        <p class="text-sm">Klik tombol "Add Guest" untuk mulai</p>
                    </div>
                @endif

            </div>
        </div>

    </div>
@endsection
