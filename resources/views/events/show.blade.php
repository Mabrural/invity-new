@extends('layouts.main')

@section('container')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* Image Modal */
        .custom-modal {
            display: none;
            position: fixed;
            z-index: 9999;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.9);
            justify-content: center;
            align-items: center;
        }

        .custom-modal.show {
            display: flex;
        }

        .custom-modal img {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        }

        .close-btn {
            position: absolute;
            top: 20px;
            right: 30px;
            color: white;
            font-size: 35px;
            font-weight: bold;
            cursor: pointer;
            z-index: 10000;
            transition: opacity 0.2s;
        }

        .close-btn:hover {
            opacity: 0.7;
        }

        /* Guest List Scroll */
        .guest-list-scroll {
            max-height: 280px;
            overflow-y: auto;
            overscroll-behavior: contain;
        }

        .guest-list-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .guest-list-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .guest-list-scroll::-webkit-scrollbar-thumb {
            background-color: #e0e0e0;
            border-radius: 10px;
        }

        .guest-list-scroll::-webkit-scrollbar-thumb:hover {
            background-color: #bdbdbd;
        }

        /* Guest Item */
        .guest-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 12px;
            border-bottom: 1px solid #f0f0f0;
            transition: background-color 0.2s;
            cursor: pointer;
        }

        .guest-item:last-child {
            border-bottom: none;
        }

        .guest-item:hover {
            background-color: #f8f9fa;
        }

        .guest-name {
            font-size: 0.875rem;
            font-weight: 500;
            color: #344767;
            flex: 1;
            margin-right: 8px;
        }

        .guest-actions {
            display: flex;
            gap: 4px;
            opacity: 0;
            transition: opacity 0.2s;
        }

        .guest-item:hover .guest-actions {
            opacity: 1;
        }

        .btn-guest-action {
            width: 28px;
            height: 28px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            font-size: 0.75rem;
            transition: all 0.2s;
        }

        .guest-empty {
            padding: 20px;
            text-align: center;
            color: #9e9e9e;
            font-size: 0.875rem;
        }
    </style>

    <div class="container-fluid py-2">
        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-0 h4 font-weight-bolder">{{ $event->title }}</h3>
                <p class="mb-0 text-sm text-muted">{{ $event->event_name }}</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('events.edit', $event->id) }}" class="btn bg-gradient-warning btn-sm">
                     Edit
                </a>
                <form action="{{ route('events.destroy', $event->id) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus event ini? Data tidak bisa dikembalikan!')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                         Delete
                    </button>
                </form>
                <a href="{{ route('events.index') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>

        <div class="row">
            {{-- Left Column --}}
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        {{-- Photos --}}
                        @if($event->event_photo_1 || $event->event_photo_2 || $event->event_photo_3)
                        <div class="row mb-3">
                            @foreach (['event_photo_1', 'event_photo_2', 'event_photo_3'] as $photo)
                                @if ($event->$photo)
                                    <div class="col-md-4 mb-3">
                                        <img src="{{ asset('storage/' . $event->$photo) }}"
                                            class="img-fluid border-radius-lg"
                                            style="height:180px; width:100%; object-fit:cover; object-position: top; cursor:pointer;"
                                            onclick="openImage('{{ asset('storage/' . $event->$photo) }}')"
                                            alt="Event Photo">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        @endif

                        {{-- Event Info --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong class="text-xs text-uppercase text-muted">Date</strong><br>
                                <span class="text-sm">{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong class="text-xs text-uppercase text-muted">Venue</strong><br>
                                <span class="text-sm">{{ $event->venue ?? '-' }}</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong class="text-xs text-uppercase text-muted">Time 1</strong><br>
                                <span class="text-sm">{{ $event->event_time ?? '-' }}</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong class="text-xs text-uppercase text-muted">Time 2</strong><br>
                                <span class="text-sm">{{ $event->event_time_2 ?? '-' }}</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong class="text-xs text-uppercase text-muted">Dresscode</strong><br>
                                <span class="text-sm">{{ $event->dresscode ?? '-' }}</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong class="text-xs text-uppercase text-muted">WA Confirmation</strong><br>
                                <span class="text-sm">{{ $event->no_wa_confirmation ?? '-' }}</span>
                            </div>
                            <div class="col-md-12 mb-3">
                                <strong class="text-xs text-uppercase text-muted">Google Maps</strong><br>
                                @if ($event->link_googlemaps)
                                    <a href="{{ $event->link_googlemaps }}" target="_blank" class="text-sm">
                                        <i class="fas fa-map-marker-alt"></i> Open Location
                                    </a>
                                @else
                                    <span class="text-sm">-</span>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <strong class="text-xs text-uppercase text-muted">Other Info</strong><br>
                                <span class="text-sm">{{ $event->other_information ?? '-' }}</span>
                            </div>
                            <div class="col-md-12">
                                <strong class="text-xs text-uppercase text-muted">Notes</strong><br>
                                <span class="text-sm">{{ $event->notes ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column --}}
            <div class="col-lg-4">
                {{-- Guest Management --}}
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <h5 class="mb-3">Guest Management</h5>
                        <button class="btn bg-gradient-dark w-100 mb-2" data-bs-toggle="modal"
                            data-bs-target="#createGuestModal">
                            <i class="fas fa-plus"></i> Create Guest
                        </button>
                    </div>
                </div>

                {{-- Guest List --}}
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-3 d-flex justify-content-between align-items-center">
                            List Guests
                            <span class="badge bg-dark" id="guestCount">
                                {{ $guests->count() }}
                            </span>
                        </h6>
                        
                        <input type="text" id="guestSearch" class="form-control mb-3" 
                            placeholder="Search guest..." autocomplete="off">

                        <div class="guest-list-scroll" id="guestListContainer">
                            @forelse ($guests as $guest)
                                <div class="guest-item" data-guest-name="{{ strtolower($guest->name) }}">
                                    <span class="guest-name" data-bs-toggle="modal"
                                        data-bs-target="#editGuestModal{{ $guest->id }}">
                                        {{ $guest->name }}
                                    </span>
                                    <div class="guest-actions">
                                        <button class="btn btn-sm btn-outline-primary btn-guest-action share-guest-btn" 
                                            data-guest-id="{{ $guest->id }}"
                                            data-guest-name="{{ $guest->name }}"
                                            data-guest-slug="{{ $guest->slug }}"
                                            title="Share">
                                            <i class="fas fa-share-alt"></i>
                                        </button>
                                    </div>
                                </div>

                                {{-- Edit Guest Modal --}}
                                <div class="modal fade" id="editGuestModal{{ $guest->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{ route('guests.update', $guest->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Guest</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Guest Name</label>
                                                        <input type="text" name="name" class="form-control"
                                                            value="{{ $guest->name }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer d-flex justify-content-between">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="deleteGuest({{ $guest->id }})">
                                                         Delete
                                                    </button>
                                                    <div>
                                                        <button type="button" class="btn btn-light btn-sm"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn bg-gradient-dark btn-sm">
                                                            Update
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                            <form id="delete-form-{{ $guest->id }}"
                                                action="{{ route('guests.destroy', $guest->id) }}" method="POST"
                                                style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="guest-empty" id="emptyState">
                                    <i class="fas fa-users mb-2" style="font-size: 2rem; opacity: 0.3;"></i>
                                    <br>No guests yet
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Image Modal --}}
    <div id="imageModal" class="custom-modal" onclick="closeImage(event)">
        <span class="close-btn">&times;</span>
        <img id="modalImage" alt="Preview">
    </div>

    {{-- Create Guest Modal --}}
    <div class="modal fade" id="createGuestModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('guests.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Guest</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <div class="mb-3">
                            <label class="form-label">Guest Name</label>
                            <input type="text" name="name" class="form-control" required
                                placeholder="Enter guest name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn bg-gradient-dark">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Share Guest Modal (Single Dynamic Modal) --}}
    <div class="modal fade" id="shareGuestModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Share Invitation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <p class="mb-3">Share via:</p>
                    
                    <a href="#" id="whatsappShareBtn" target="_blank" class="btn btn-success w-100 mb-2">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                    
                    <a href="#" id="facebookShareBtn" target="_blank" class="btn btn-primary w-100 mb-2">
                        <i class="fab fa-facebook"></i> Facebook
                    </a>
                    
                    <button onclick="copyShareText()" class="btn btn-dark w-100 mb-2">
                        <i class="fas fa-copy"></i> Copy Text
                    </button>
                    
                    <small id="copyMsg" class="text-success d-none">
                        <i class="fas fa-check"></i> Text copied successfully!
                    </small>
                    
                    <div class="alert alert-light mt-3 text-start border">
                        <strong class="text-xs">Share manually:</strong><br>
                        <small class="text-muted" id="shareTextPreview"></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Global variable to store current share data
    let currentShareData = {
        name: '',
        slug: '',
        text: '',
        link: ''
    };

    // Image Modal Functions
    function openImage(src) {
        const modal = document.getElementById("imageModal");
        const img = document.getElementById("modalImage");
        img.src = src;
        modal.classList.add("show");
    }

    function closeImage(e) {
        if (e.target.id === "imageModal" || e.target.classList.contains("close-btn")) {
            document.getElementById("imageModal").classList.remove("show");
        }
    }

    // Close image modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById("imageModal");
            if (modal.classList.contains("show")) {
                modal.classList.remove("show");
            }
        }
    });

    // Guest Search Filter
    function filterGuest() {
        const input = document.getElementById("guestSearch");
        const filter = input.value.toLowerCase().trim();
        const guestItems = document.querySelectorAll("#guestListContainer .guest-item");
        const emptyState = document.getElementById("emptyState");
        let visibleCount = 0;

        guestItems.forEach(item => {
            const guestName = item.getAttribute("data-guest-name");
            if (guestName && guestName.includes(filter)) {
                item.style.display = "";
                visibleCount++;
            } else {
                item.style.display = "none";
            }
        });

        // Update guest count badge
        const guestCountBadge = document.getElementById("guestCount");
        if (guestCountBadge) {
            guestCountBadge.textContent = visibleCount;
        }

        // Show/hide empty state
        if (emptyState) {
            if (filter === "" && guestItems.length === 0) {
                emptyState.style.display = "block";
            } else if (visibleCount === 0 && filter !== "") {
                // Create temporary empty state for search
                let tempEmpty = document.getElementById("tempEmptyState");
                if (!tempEmpty) {
                    tempEmpty = document.createElement("div");
                    tempEmpty.id = "tempEmptyState";
                    tempEmpty.className = "guest-empty";
                    tempEmpty.innerHTML = '<i class="fas fa-search mb-2" style="font-size: 2rem; opacity: 0.3;"></i><br>No guests found';
                    document.getElementById("guestListContainer").appendChild(tempEmpty);
                }
                tempEmpty.style.display = "block";
                emptyState.style.display = "none";
            } else {
                emptyState.style.display = "none";
                const tempEmpty = document.getElementById("tempEmptyState");
                if (tempEmpty) {
                    tempEmpty.style.display = "none";
                }
            }
        }
    }

    // Delete Guest
    function deleteGuest(id) {
        if (confirm('Are you sure you want to delete this guest?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }

    // Share Guest Functions
    document.addEventListener('DOMContentLoaded', function() {
        // Handle share button clicks
        document.querySelectorAll('.share-guest-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const guestId = this.getAttribute('data-guest-id');
                const guestName = this.getAttribute('data-guest-name');
                const guestSlug = this.getAttribute('data-guest-slug');
                
                // Set current share data
                currentShareData.name = guestName;
                currentShareData.slug = guestSlug;
                currentShareData.link = window.location.origin + '/invitation/' + guestSlug;
                // currentShareData.text = 'Halo ' + guestName + ', kamu diundang ke acara {{ $event->title }} 🎉\n\nLihat detail di:\n' + currentShareData.link;
                currentShareData.text =
`Shalom,

We are grateful for God's goodness in our lives.
With all due respect, we would like to invite you, ladies and gentlemen;

${guestName}

Here is our invitation link:

${currentShareData.link}

It would be an honor and pleasure for us if you could attend and join our celebration event.

Belva Angeline Githa`;

                // Update modal content
                updateShareModal();
                
                // Show modal
                const shareModal = new bootstrap.Modal(document.getElementById('shareGuestModal'));
                shareModal.show();
            });
        });
    });

    function updateShareModal() {
        // Update WhatsApp link
        const whatsappBtn = document.getElementById('whatsappShareBtn');
        whatsappBtn.href = 'https://wa.me/?text=' + encodeURIComponent(currentShareData.text);
        
        // Update Facebook link
        const facebookBtn = document.getElementById('facebookShareBtn');
        facebookBtn.href = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(currentShareData.link);
        
        // Update preview text
        const previewText = document.getElementById('shareTextPreview');
        previewText.textContent = currentShareData.text;
        
        // Hide copy message
        document.getElementById('copyMsg').classList.add('d-none');
    }

    function copyShareText() {
        if (currentShareData.text) {
            navigator.clipboard.writeText(currentShareData.text).then(function() {
                const msgElement = document.getElementById('copyMsg');
                msgElement.classList.remove('d-none');
                
                // Hide message after 2 seconds
                setTimeout(() => {
                    msgElement.classList.add('d-none');
                }, 2000);
            }).catch(function(err) {
                console.error('Failed to copy text: ', err);
                // Fallback for older browsers
                const textArea = document.createElement('textarea');
                textArea.value = currentShareData.text;
                document.body.appendChild(textArea);
                textArea.select();
                try {
                    document.execCommand('copy');
                    const msgElement = document.getElementById('copyMsg');
                    msgElement.classList.remove('d-none');
                    setTimeout(() => {
                        msgElement.classList.add('d-none');
                    }, 2000);
                } catch (err) {
                    console.error('Fallback: Oops, unable to copy', err);
                }
                document.body.removeChild(textArea);
            });
        }
    }

    // Initialize search on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Add event listener for search input
        const searchInput = document.getElementById('guestSearch');
        if (searchInput) {
            searchInput.addEventListener('keyup', filterGuest);
            searchInput.addEventListener('search', filterGuest); // For clear button
        }
    });
</script>
@endpush