@extends('layouts.main')

@section('container')
    <div class="container-fluid py-2">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-0 h4 font-weight-bolder">Events</h3>
                <p class="mb-0">Manage your events & guests</p>
            </div>

            <a href="{{ route('events.create') }}" class="btn bg-gradient-dark">
                + Create Event
            </a>
        </div>

        {{-- CARD LIST --}}
        <div class="row">

            @forelse ($events as $event)
                <div class="col-xl-3 col-sm-6 mb-4">

                    <a href="{{ route('events.show', $event->id) }}" style="text-decoration: none;">
                        <div class="card h-100">

                            {{-- IMAGE --}}
                            @if ($event->event_photo_1)
                                <img src="{{ asset('storage/' . $event->event_photo_1) }}" class="card-img-top"
                                    style="height: 180px; width: 100%; object-fit: cover; object-position: top;">
                            @else
                                <img src="{{ asset('assets/img/no-image.jpg') }}" class="card-img-top">
                            @endif

                            <div class="card-body">

                                {{-- TITLE --}}
                                <h5 class="mb-1 text-dark">
                                    {{ $event->title }}
                                </h5>

                                {{-- NAME --}}
                                <p class="text-sm mb-1 text-secondary">
                                    {{ $event->event_name }}
                                </p>

                                {{-- DATE --}}
                                <p class="text-xs mb-2">
                                    <i class="material-symbols-rounded text-sm">calendar_today</i>
                                    {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                                </p>

                                {{-- VENUE --}}
                                <p class="text-xs text-muted mb-0">
                                    <i class="material-symbols-rounded text-sm">location_on</i>
                                    {{ $event->venue }}
                                </p>

                            </div>

                        </div>
                    </a>

                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-secondary text-center text-white">
                        Belum ada event 😢
                    </div>
                </div>
            @endforelse

        </div>

    </div>
@endsection
