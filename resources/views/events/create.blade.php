@extends('layouts.main')

@section('container')
<div class="container-fluid py-2">

    {{-- HEADER --}}
    <div class="mb-4">
        <h3 class="mb-0 h4 font-weight-bolder">Create Event</h3>
        <p class="mb-0">Isi detail event kamu</p>
    </div>

    {{-- FORM --}}
    <div class="card">
        <div class="card-body">

            <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    {{-- TITLE --}}
                    <div class="col-md-6">
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                    </div>

                    {{-- EVENT NAME --}}
                    <div class="col-md-6">
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">Event Name</label>
                            <input type="text" name="event_name" class="form-control" required>
                        </div>
                    </div>

                    {{-- DATE --}}
                    <div class="col-md-4">
                        <div class="input-group input-group-outline my-3 is-filled">
                            <label class="form-label">Event Date</label>
                            <input type="date" name="event_date" class="form-control" required>
                        </div>
                    </div>

                    {{-- TIME 1 --}}
                    <div class="col-md-4">
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">Event Time 1</label>
                            <input type="text" name="event_time" class="form-control">
                        </div>
                    </div>

                    {{-- TIME 2 --}}
                    <div class="col-md-4">
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">Event Time 2</label>
                            <input type="text" name="event_time_2" class="form-control">
                        </div>
                    </div>

                    {{-- VENUE --}}
                    <div class="col-md-6">
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">Venue</label>
                            <input type="text" name="venue" class="form-control">
                        </div>
                    </div>

                    {{-- GOOGLE MAPS --}}
                    <div class="col-md-6">
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">Google Maps Link</label>
                            <input type="text" name="link_googlemaps" class="form-control">
                        </div>
                    </div>

                    {{-- DRESSCODE --}}
                    <div class="col-md-6">
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">Dresscode</label>
                            <input type="text" name="dresscode" class="form-control">
                        </div>
                    </div>

                    {{-- WHATSAPP --}}
                    <div class="col-md-6">
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">No WA Confirmation</label>
                            <input type="text" name="no_wa_confirmation" class="form-control">
                        </div>
                    </div>

                    {{-- OTHER INFO --}}
                    <div class="col-md-12">
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">Other Information</label>
                            <textarea name="other_information" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    {{-- NOTES --}}
                    <div class="col-md-12">
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">Quotes</label>
                            <textarea name="notes" class="form-control" rows="3"></textarea>
                        </div>
                    </div>

                    {{-- FAVICON --}}
                    <div class="col-md-6">
                        <label class="form-label">Favicon</label>
                        <input type="file" name="favicon" class="form-control">
                    </div>

                    {{-- PHOTO 1 --}}
                    <div class="col-md-6">
                        <label class="form-label">Photo 1</label>
                        <input type="file" name="event_photo_1" class="form-control">
                    </div>

                    {{-- PHOTO 2 --}}
                    <div class="col-md-6 mt-3">
                        <label class="form-label">Photo 2</label>
                        <input type="file" name="event_photo_2" class="form-control">
                    </div>

                    {{-- PHOTO 3 --}}
                    <div class="col-md-6 mt-3">
                        <label class="form-label">Photo 3</label>
                        <input type="file" name="event_photo_3" class="form-control">
                    </div>

                </div>

                {{-- BUTTON --}}
                <div class="mt-4 text-end">
                    <a href="{{ route('events.index') }}" class="btn btn-light">Cancel</a>
                    <button type="submit" class="btn bg-gradient-dark">Save Event</button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection