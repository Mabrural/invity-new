<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    // 🔹 GET /events
    public function index()
    {
        $events = Event::latest()->get();
        return view('events.index', compact('events'));
    }

    // 🔹 GET /events/create
    public function create()
    {
        return view('events.create');
    }

    // 🔹 POST /events
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
        ]);

        // Upload favicon
        if ($request->hasFile('favicon')) {
            $validated['favicon'] = $request->file('favicon')->store('events', 'public');
        }

        // Upload photos
        foreach ([1, 2, 3] as $i) {
            if ($request->hasFile("event_photo_$i")) {
                $validated["event_photo_$i"] = $request->file("event_photo_$i")->store('events', 'public');
            }
        }

        // Field lain
        $validated += $request->only([
            'venue',
            'event_time',
            'event_time_2',
            'link_googlemaps',
            'dresscode',
            'no_wa_confirmation',
            'other_information',
            'notes',
        ]);

        Event::create($validated);

        return redirect()->route('events.index')->with('success', 'Event berhasil dibuat');
    }

    // 🔹 GET /events/{event}
    // public function show(Event $event)
    // {
    //     return view('events.show', compact('event'));
    // }

    public function show(Event $event)
    {
        $guests = Guest::where('event_id', $event->id)->latest()->get();

        return view('events.show', compact('event', 'guests'));
    }

    // 🔹 GET /events/{event}/edit
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    // 🔹 PUT /events/{event}
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
        ]);

        // Upload favicon
        if ($request->hasFile('favicon')) {
            $validated['favicon'] = $request->file('favicon')->store('events', 'public');
        }

        // Upload photos
        foreach ([1, 2, 3] as $i) {
            if ($request->hasFile("event_photo_$i")) {
                $validated["event_photo_$i"] = $request->file("event_photo_$i")->store('events', 'public');
            }
        }

        // Field lain
        $validated += $request->only([
            'venue',
            'event_time',
            'event_time_2',
            'link_googlemaps',
            'dresscode',
            'no_wa_confirmation',
            'other_information',
            'notes'

        ]);

        $event->update($validated);

        return redirect()->route('events.index')->with('success', 'Event berhasil diupdate');
    }

    // DELETE /events/{event}
    // public function destroy(Event $event)
    // {
    //     $event->delete();

    //     return redirect()->route('events.index')->with('success', 'Event berhasil dihapus');
    // }
    public function destroy(Event $event)
    {
        // Hapus favicon
        if ($event->favicon && Storage::disk('public')->exists($event->favicon)) {
            Storage::disk('public')->delete($event->favicon);
        }

        // Hapus semua foto
        foreach (['event_photo_1', 'event_photo_2', 'event_photo_3'] as $photo) {
            if ($event->$photo && Storage::disk('public')->exists($event->$photo)) {
                Storage::disk('public')->delete($event->$photo);
            }
        }

        // Hapus data
        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Event berhasil dihapus beserta file');
    }
}