@extends('layouts.main')

@section('container')
<div class="container-fluid py-2">

    {{-- HEADER --}}
    <div class="mb-4">
        <h3 class="mb-0 h4 font-weight-bolder">Edit Event</h3>
        <p class="mb-0">Update data event kamu</p>
    </div>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">

                    {{-- TITLE --}}
                    <div class="col-md-6">
                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control"
                                value="{{ old('title', $event->title) }}" required>
                        </div>
                    </div>

                    {{-- EVENT NAME --}}
                    <div class="col-md-6">
                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Event Name</label>
                            <input type="text" name="event_name" class="form-control"
                                value="{{ old('event_name', $event->event_name) }}" required>
                        </div>
                    </div>

                    {{-- DATE --}}
                    <div class="col-md-4">
                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Event Date</label>
                            <input type="date" name="event_date" class="form-control"
                                value="{{ old('event_date', $event->event_date) }}" required>
                        </div>
                    </div>

                    {{-- TIME 1 --}}
                    <div class="col-md-4">
                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Event Time 1</label>
                            <input type="text" name="event_time" class="form-control"
                                value="{{ old('event_time', $event->event_time) }}">
                        </div>
                    </div>

                    {{-- TIME 2 --}}
                    <div class="col-md-4">
                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Event Time 2</label>
                            <input type="text" name="event_time_2" class="form-control"
                                value="{{ old('event_time_2', $event->event_time_2) }}">
                        </div>
                    </div>

                    {{-- VENUE --}}
                    <div class="col-md-6">
                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Venue</label>
                            <input type="text" name="venue" class="form-control"
                                value="{{ old('venue', $event->venue) }}">
                        </div>
                    </div>

                    {{-- GOOGLE MAPS --}}
                    <div class="col-md-6">
                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Google Maps Link</label>
                            <input type="text" name="link_googlemaps" class="form-control"
                                value="{{ old('link_googlemaps', $event->link_googlemaps) }}">
                        </div>
                    </div>

                    {{-- DRESSCODE --}}
                    <div class="col-md-6">
                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Dresscode</label>
                            <input type="text" name="dresscode" class="form-control"
                                value="{{ old('dresscode', $event->dresscode) }}">
                        </div>
                    </div>

                    {{-- WHATSAPP --}}
                    <div class="col-md-6">
                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">No WA Confirmation</label>
                            <input type="text" name="no_wa_confirmation" class="form-control"
                                value="{{ old('no_wa_confirmation', $event->no_wa_confirmation) }}">
                        </div>
                    </div>

                    {{-- OTHER INFO --}}
                    <div class="col-md-12">
                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Other Information</label>
                            <textarea name="other_information" class="form-control" rows="3">{{ old('other_information', $event->other_information) }}</textarea>
                        </div>
                    </div>

                    {{-- NOTES --}}
                    <div class="col-md-12">
                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Quotes</label>
                            <textarea name="notes" class="form-control" rows="3">{{ old('notes', $event->notes) }}</textarea>
                        </div>
                    </div>

                    {{-- FAVICON --}}
                    <div class="col-md-6">
                        <label class="form-label">Favicon</label>
                        @if($event->favicon)
                            <div class="mb-2">
                                <img src="{{ asset('storage/'.$event->favicon) }}" width="60">
                            </div>
                        @endif
                        <input type="file" name="favicon" class="form-control">
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti</small>
                    </div>

                    {{-- PHOTO 1 --}}
                    <div class="col-md-6">
                        <label class="form-label">Photo 1</label>
                        @if($event->event_photo_1)
                            <div class="mb-2">
                                <img src="{{ asset('storage/'.$event->event_photo_1) }}"
                                     class="img-fluid border-radius-lg" style="height:80px;">
                            </div>
                        @endif
                        <input type="file" name="event_photo_1" class="form-control">
                    </div>

                    {{-- PHOTO 2 --}}
                    <div class="col-md-6 mt-3">
                        <label class="form-label">Photo 2</label>
                        @if($event->event_photo_2)
                            <div class="mb-2">
                                <img src="{{ asset('storage/'.$event->event_photo_2) }}"
                                     class="img-fluid border-radius-lg" style="height:80px;">
                            </div>
                        @endif
                        <input type="file" name="event_photo_2" class="form-control">
                    </div>

                    {{-- PHOTO 3 --}}
                    <div class="col-md-6 mt-3">
                        <label class="form-label">Photo 3</label>
                        @if($event->event_photo_3)
                            <div class="mb-2">
                                <img src="{{ asset('storage/'.$event->event_photo_3) }}"
                                     class="img-fluid border-radius-lg" style="height:80px;">
                            </div>
                        @endif
                        <input type="file" name="event_photo_3" class="form-control">
                    </div>

                </div>

                {{-- BUTTON --}}
                <div class="mt-4 text-end">
                    <a href="{{ route('events.index') }}" class="btn btn-light">Cancel</a>
                    <button type="submit" class="btn bg-gradient-dark">Update Event</button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection