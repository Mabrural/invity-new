<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GuestController extends Controller
{
    public function index(Event $event)
    {
        $guests = Guest::where('event_id', $event->id)->latest()->get();

        return view('guests.index', compact('event', 'guests'));
    }

    public function create(Request $request)
    {
        $event = Event::findOrFail($request->event_id);
        return view('guests.create', compact('event'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'name' => 'required|string|max:255',
        ]);

        Guest::create($request->all());

        return redirect()->route('events.show', $request->event_id)
            ->with('success', 'Guest berhasil ditambahkan');
    }

    public function show(Guest $guest)
    {
        return view('guests.show', compact('guest'));
    }

    public function edit(Guest $guest)
    {
        return view('guests.edit', compact('guest'));
    }

    public function update(Request $request, Guest $guest)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $guest->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . uniqid()
        ]);

        return back()->with('success', 'Guest updated');
    }

    public function destroy(Guest $guest)
    {
        $eventId = $guest->event_id;
        $guest->delete();

        return redirect()->route('events.show', $eventId)
            ->with('success', 'Guest berhasil dihapus');
    }
}