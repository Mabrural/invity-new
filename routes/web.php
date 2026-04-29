<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Event;
use App\Models\Guest;
use Illuminate\Support\Carbon;

Route::redirect('/', '/dashboard');

Route::get('/storage/{folder}/{filename}', function ($folder, $filename) {
    $allowedFolders = ['events'];

    if (!in_array($folder, $allowedFolders)) {
        abort(403);
    }

    $path = storage_path('app/public/' . $folder . '/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
})->where('filename', '.*');

Route::get('/dashboard', function () {

    return view('dashboard', [
        'totalEvents' => Event::count(),
        'totalGuests' => Guest::count(),
        'activeEvents' => Event::whereDate('event_date', '>=', now())->count(),
        'guestToday' => Guest::whereDate('created_at', today())->count(),
        'recentEvents' => Event::latest()->take(5)->get(),
    ]);

})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('events', EventController::class)->middleware('auth');

Route::resource('guests', GuestController::class)->middleware('auth');

Route::get('/events/{event}/guests', [GuestController::class, 'index'])->name('guests.index');

Route::get('/invitation/{slug}', function ($slug) {

    $guest = Guest::with('event')->where('slug', $slug)->firstOrFail();

    $event = $guest->event;

    return view('invitation.v3', compact('guest', 'event'));

})->name('invitation.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
