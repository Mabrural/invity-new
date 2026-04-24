@extends('layouts.main')

@section('container')
    <div class="container-fluid py-2">

        {{-- HEADER --}}
        <div class="mb-4">
            <h3 class="mb-0 h4 font-weight-bolder">Dashboard</h3>
            <p class="text-sm text-muted">Overview sistem event & guest management</p>
        </div>

        {{-- STATS CARDS --}}
        <div class="row">

            {{-- TOTAL EVENT --}}
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-sm mb-0">Total Event</p>
                            <h4 class="mb-0">{{ $totalEvents ?? 0 }}</h4>
                        </div>
                        <div class="icon icon-shape bg-gradient-dark text-white rounded-circle shadow">
                            <i class="fas fa-calendar"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TOTAL GUEST --}}
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-sm mb-0">Total Guest</p>
                            <h4 class="mb-0">{{ $totalGuests ?? 0 }}</h4>
                        </div>
                        <div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- EVENT AKTIF --}}
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-sm mb-0">Event Aktif</p>
                            <h4 class="mb-0">{{ $activeEvents ?? 0 }}</h4>
                        </div>
                        <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">
                            <i class="fas fa-bolt"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- GUEST HARI INI --}}
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-sm mb-0">Guest Today</p>
                            <h4 class="mb-0">{{ $guestToday ?? 0 }}</h4>
                        </div>
                        <div class="icon icon-shape bg-gradient-warning text-white rounded-circle shadow">
                            <i class="fas fa-user-plus"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- CONTENT ROW --}}
        <div class="row mt-3">

            {{-- LEFT: RECENT EVENTS --}}
            <div class="col-lg-8 mb-3">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Recent Events</h6>
                    </div>

                    <div class="card-body">

                        <ul class="list-group">

                            @forelse ($recentEvents ?? [] as $event)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $event->title }}</strong><br>
                                        <small class="text-muted">{{ $event->event_date }}</small>
                                    </div>
                                    <span class="badge bg-gradient-dark">View</span>
                                </li>
                            @empty
                                <li class="list-group-item text-center text-muted">
                                    No event found
                                </li>
                            @endforelse

                        </ul>

                    </div>
                </div>
            </div>

            {{-- RIGHT: QUICK ACTION --}}
            <div class="col-lg-4 mb-3">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Quick Actions</h6>
                    </div>

                    <div class="card-body d-grid gap-2">

                        <a href="{{ route('events.create') }}" class="btn btn-dark">
                            ➕ Create Event
                        </a>

                        <a href="{{ route('events.index') }}" class="btn btn-outline-dark">
                            📅 View Events
                        </a>


                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
