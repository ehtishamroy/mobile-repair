@extends('frontend.layouts.app')

@section('title', $service ? $service->name . ' - Book Repair' : 'Book Repair')

@section('content')
<section class="service-hero-section flex-stack mb-custom">
    <div class="container flex-stack flex-column">
        <h1 class="display-2 fw-900 font-satoshi text-white mb-3">
            {{ $service ? $service->name : 'Harrow Mobiles' }}
        </h1>
        <p class="text-white text-center fw-400 fs-18 mb-4">
            Reliable Repair Services, Guaranteed to <br />
            Meet Expectations
        </p>
    </div>
</section>

@if($service)
<section>
    <div class="container mb-custom">
        <div class="text-center">
            <button class="btn-gradient-outline Choose">Choose</button>
            <h1 class="text-center my-4">Please Select Your Device</h1>
        </div>
        
        <!-- Search Bar -->
        <div class="row justify-content-center mb-3 mt-4">
            <div class="col-md-8 col-lg-6">
                <div class="position-relative">
                    <input 
                        type="text" 
                        id="deviceSearch" 
                        class="custom-input" 
                        placeholder="Search by brand or model..." 
                        autocomplete="off"
                        style="padding-left: 50px; padding-right: 50px; font-size: clamp(14px, 1vw, 16px);"
                    >
                    <i class="bi bi-search position-absolute" style="left: 1rem; top: 50%; transform: translateY(-50%); color: var(--muted, #6c757d); font-size: 1.1rem; pointer-events: none; z-index: 1;"></i>
                    <button 
                        type="button" 
                        id="clearSearch" 
                        class="position-absolute d-none" 
                        style="right: 0.75rem; top: 50%; transform: translateY(-50%); background: transparent; border: none; color: var(--muted, #6c757d); font-size: 1.2rem; cursor: pointer; z-index: 1; padding: 0.25rem 0.5rem;"
                        title="Clear search"
                    >
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <form id="deviceSelectionForm" action="{{ route('frontend.select') }}" method="GET">
            <input type="hidden" name="service_id" value="{{ $service->id }}">
            <div class="text-center mt-5">
                <button type="submit" class="btn-gradient py-3 rounded w-lg-25">
                    Confirm
                </button>
            </div>
            <div id="deviceList" class="device-grid mt-4 pt-2">
                @foreach($service->deviceTypes as $deviceType)
                @php
                    $brandModel = $deviceType->repairBrand;
                    $brandName = $brandModel ? $brandModel->name : ($deviceType->getAttributes()['brand'] ?? '');
                    $searchText = strtolower($deviceType->name . ' ' . $brandName);
                @endphp
               
                <div class="device-item" data-search="{{ $searchText }}">
                    <input
                        type="radio"
                        class="btn-check"
                        name="device_type_id"
                        id="device_{{ $deviceType->id }}"
                        value="{{ $deviceType->id }}"
                        autocomplete="off"
                    />
                    <label class="device-card flex-center gap-2" for="device_{{ $deviceType->id }}" style="padding: 5px 8px; font-size: 12px;">
                        @if($brandModel && $brandModel->logo)
                            <img src="{{ asset('storage/' . $brandModel->logo) }}" alt="{{ $deviceType->name }}" style="height: 15px;">
                        @elseif($deviceType->brand === 'Apple')
                            <i class="bi bi-apple"></i>
                        @elseif($deviceType->brand === 'Samsung')
                            <img src="{{ asset('front-assets/img/repair-samsung-2.svg') }}" alt="{{ $deviceType->name }}" style="height: 15px;">
                        @elseif($deviceType->brand === 'Google Pixel')
                            <img src="{{ asset('front-assets/img/Googlep.png') }}" alt="{{ $deviceType->name }}" style="height: 15px;">
                             @elseif($deviceType->brand === 'Dell')
                            <img src="{{ asset('front-assets/img/dell-logo.png') }}" alt="{{ $deviceType->name }}" style="height: 15px;">
                             @elseif($deviceType->brand === 'HP')
                            <img src="{{ asset('front-assets/img/hp-logo.png') }}" alt="{{ $deviceType->name }}" style="height: 15px;">
                             @elseif($deviceType->brand === 'Asus')
                            <img src="{{ asset('front-assets/img/asus-logo.png') }}" alt="{{ $deviceType->name }}" style="height: 15px;">
                             @elseif($deviceType->brand === 'Lenovo')
                            <img src="{{ asset('front-assets/img/lenovo-logo.jpg') }}" alt="{{ $deviceType->name }}" style="height: 15px;">
                        @endif
                        {{ $deviceType->name }}
                        <span class="check-icon">
                            <img src="{{ asset('front-assets/img/select-check.svg') }}" alt="" />
                        </span>
                    </label>
                </div>
                @endforeach
                 
                <div class="device-item device-item-others" data-search="others">
                    <input
                        type="radio"
                        class="btn-check"
                        name="device_type_id"
                        id="device_other"
                        value="other"
                        autocomplete="off"
                    />
                    <label class="device-card" for="device_other" style="padding: 8px 12px; font-size: 12px;">
                        Others
                        <span class="check-icon">
                            <img src="{{ asset('front-assets/img/select-check.svg') }}" alt="" />
                        </span>
                    </label>
                </div>
            </div>

       
           
        </form>
    </div>
</section>
@else
<section>
    <div class="container mb-custom">
        <div class="alert alert-warning text-center">
            <p>Please select a service from the <a href="{{ route('frontend.book-repair') }}">Book Repair</a> page.</p>
        </div>
    </div>
</section>
@endif

@push('styles')
<style>
    #deviceSearch {
        transition: all 0.3s ease;
    }
    
    #deviceSearch:focus {
        background: #fff;
        box-shadow: 0 0 0 3px rgba(104, 68, 113, 0.1);
    }
    
    #clearSearch:hover {
        color: var(--primary, #684471) !important;
    }
    
    .device-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 12px;
        max-width: 1000px;
        margin-left: auto;
        margin-right: auto;
    }

    @media (max-width: 768px) {
        .device-grid {
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 10px;
        }
    }

    @media (max-width: 576px) {
        .device-grid {
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 8px;
        }
    }
    
    .device-item {
        transition: opacity 0.3s ease, transform 0.3s ease;
    }
    
    .device-item[style*="display: none"] {
        opacity: 0;
        transform: scale(0.95);
    }

    /* Checked state styles */
    .btn-check:checked + .device-card {
        background-color: var(--primary, #684471) !important;
        color: white !important;
        border-color: var(--primary, #684471) !important;
    }

    .btn-check:checked + .device-card .check-icon {
        display: none;
    }

    .btn-check:checked + .device-card img,
    .btn-check:checked + .device-card i {
        filter: brightness(0) invert(1);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('deviceSearch');
        const clearBtn = document.getElementById('clearSearch');
        const deviceItems = document.querySelectorAll('.device-item');
        const deviceList = document.getElementById('deviceList');
        
        function updateClearButton() {
            if (searchInput && clearBtn) {
                if (searchInput.value.trim() !== '') {
                    clearBtn.classList.remove('d-none');
                } else {
                    clearBtn.classList.add('d-none');
                }
            }
        }
        
        if (searchInput) {
            // Show/hide clear button
            searchInput.addEventListener('input', function(e) {
                updateClearButton();
                const searchTerm = e.target.value.toLowerCase().trim();
                
                let visibleCount = 0;
                let firstVisible = null;
                const othersItem = document.querySelector('.device-item-others');
                
                // Filter regular device items (exclude "Others")
                deviceItems.forEach(function(item) {
                    // Skip "Others" button - it should always be visible
                    if (item.classList.contains('device-item-others')) {
                        return;
                    }
                    
                    const searchText = item.getAttribute('data-search') || '';
                    const isVisible = searchText.includes(searchTerm);
                    
                    if (isVisible) {
                        item.style.display = '';
                        if (visibleCount === 0) {
                            firstVisible = item;
                        }
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                        // Uncheck hidden items
                        const radio = item.querySelector('input[type="radio"]');
                        if (radio && radio.checked) {
                            radio.checked = false;
                        }
                    }
                });
                
                // Always show "Others" button
                if (othersItem) {
                    othersItem.style.display = '';
                }
                
                // Auto-select logic (only when searching, not on initial load)
                if (searchTerm !== '') {
                    if (visibleCount > 0) {
                        // If there are visible devices, select the first one
                        const checkedRadio = deviceList.querySelector('input[type="radio"]:checked');
                        if (!checkedRadio || checkedRadio.closest('.device-item').style.display === 'none') {
                            if (firstVisible) {
                                const firstRadio = firstVisible.querySelector('input[type="radio"]');
                                if (firstRadio) {
                                    firstRadio.checked = true;
                                }
                            }
                        }
                    } else {
                        // If no devices found but search term exists, auto-select "Others"
                        if (othersItem) {
                            const othersRadio = othersItem.querySelector('input[type="radio"]');
                            if (othersRadio) {
                                othersRadio.checked = true;
                            }
                        }
                    }
                }
                
                // Show/hide "No results" message (only when search term exists and no devices found)
                const noResultsMsg = document.getElementById('noResultsMessage');
                if (visibleCount === 0 && searchTerm !== '') {
                    if (!noResultsMsg) {
                        const msg = document.createElement('div');
                        msg.id = 'noResultsMessage';
                        msg.className = 'text-center py-3 mb-3';
                        msg.style.color = 'var(--muted, #6c757d)';
                        msg.style.width = '100%';
                        msg.innerHTML = '<p class="mb-0 fs-18">No devices found matching your search. You can select "Others" below.</p>';
                        deviceList.insertBefore(msg, othersItem);
                    }
                } else {
                    if (noResultsMsg) {
                        noResultsMsg.remove();
                    }
                }
            });
            
            // Clear search button
            if (clearBtn) {
                clearBtn.addEventListener('click', function() {
                    searchInput.value = '';
                    searchInput.dispatchEvent(new Event('input'));
                    searchInput.focus();
                });
            }
            
            // Clear search on Escape key
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    e.target.value = '';
                    e.target.dispatchEvent(new Event('input'));
                    e.target.blur();
                }
            });
            
            // Initial state
            updateClearButton();
        }
    });
</script>
@endpush

@endsection
