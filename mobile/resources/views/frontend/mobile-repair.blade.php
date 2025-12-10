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
        @if(!$brandId)
            {{-- BRAND SELECTION VIEW --}}
            <section>
                <div class="container mb-custom">
                    <div class="text-center">
                        <button class="btn-gradient-outline Choose">Choose</button>
                        <h1 class="text-center my-4">Please Select Your Brand</h1>
                    </div>

                    <!-- Search Bar -->
                    <div class="row justify-content-center mb-3 mt-4">
                        <div class="col-md-8 col-lg-6">
                            <div class="position-relative">
                                <input type="text" id="brandSearch" class="custom-input" placeholder="Search brands..."
                                    autocomplete="off"
                                    style="padding-left: 50px; padding-right: 50px; font-size: clamp(14px, 1vw, 16px);">
                                <i class="bi bi-search position-absolute"
                                    style="left: 1rem; top: 50%; transform: translateY(-50%); color: var(--muted, #6c757d); font-size: 1.1rem; pointer-events: none; z-index: 1;"></i>
                                <button type="button" id="clearSearch" class="position-absolute d-none"
                                    style="right: 0.75rem; top: 50%; transform: translateY(-50%); background: transparent; border: none; color: var(--muted, #6c757d); font-size: 1.2rem; cursor: pointer; z-index: 1; padding: 0.25rem 0.5rem;"
                                    title="Clear search">
                                    <i class="bi bi-x-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div id="brandList" class="device-grid mt-4 pt-2">
                        @foreach($brands as $brand)
                            <div class="device-item" data-search="{{ strtolower($brand->name) }}">
                                <a href="{{ route('frontend.mobile-repair', ['service' => $service->id, 'brand' => $brand->id]) }}"
                                    class="device-card flex-center gap-2 text-decoration-none"
                                    style="padding: 12px 10px; font-size: 12px;">
                                    @if($brand->logo)
                                        <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}" style="height: 15px;">
                                    @elseif(strtolower($brand->name) === 'apple' || strtolower($brand->name) === 'iphone')
                                        <i class="bi bi-apple"></i>
                                    @elseif(strtolower($brand->name) === 'samsung')
                                        <img src="{{ asset('front-assets/img/repair-samsung-2.svg') }}" alt="{{ $brand->name }}"
                                            style="height: 15px;">
                                    @elseif(strtolower($brand->name) === 'google pixel' || strtolower($brand->name) === 'google')
                                        <img src="{{ asset('front-assets/img/Googlep.png') }}" alt="{{ $brand->name }}"
                                            style="height: 15px;">
                                    @elseif(strtolower($brand->name) === 'dell')
                                        <img src="{{ asset('front-assets/img/dell-logo.png') }}" alt="{{ $brand->name }}"
                                            style="height: 15px;">
                                    @elseif(strtolower($brand->name) === 'hp')
                                        <img src="{{ asset('front-assets/img/hp-logo.png') }}" alt="{{ $brand->name }}"
                                            style="height: 15px;">
                                    @elseif(strtolower($brand->name) === 'asus')
                                        <img src="{{ asset('front-assets/img/asus-logo.png') }}" alt="{{ $brand->name }}"
                                            style="height: 15px;">
                                    @elseif(strtolower($brand->name) === 'lenovo')
                                        <img src="{{ asset('front-assets/img/lenovo-logo.jpg') }}" alt="{{ $brand->name }}"
                                            style="height: 15px;">
                                    @endif
                                    {{ $brand->name }}
                                    <span class="check-icon">
                                        <img src="{{ asset('front-assets/img/select-check.svg') }}" alt="" />
                                    </span>
                                </a>
                            </div>
                        @endforeach

                        <div class="device-item device-item-others" data-search="others other">
                            <a href="{{ route('frontend.select', ['service_id' => $service->id, 'device_type_id' => 'other']) }}"
                                class="device-card text-decoration-none" style="padding: 15px 12px; font-size: 12px;">
                                Others
                                <span class="check-icon">
                                    <img src="{{ asset('front-assets/img/select-check.svg') }}" alt="" />
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        @else
            {{-- DEVICE SELECTION VIEW --}}
            <section>
                <div class="container mb-custom">
                    <div class="text-center">
                        <button class="btn-gradient-outline Choose">Choose</button>
                        <h1 class="text-center my-4">
                            @if($selectedBrand)
                                Select Your {{ $selectedBrand->name }} Device
                            @else
                                Please Select Your Device
                            @endif
                        </h1>
                        <a href="{{ route('frontend.mobile-repair', ['service' => $service->id]) }}"
                            class="btn btn-outline-secondary mb-4">
                            <i class="bi bi-arrow-left me-2"></i>Back to Brands
                        </a>
                    </div>

                    <!-- Search Bar -->
                    <div class="row justify-content-center mb-3 mt-4">
                        <div class="col-md-8 col-lg-6">
                            <div class="position-relative">
                                <input type="text" id="deviceSearch" class="custom-input" placeholder="Search devices..."
                                    autocomplete="off"
                                    style="padding-left: 50px; padding-right: 50px; font-size: clamp(14px, 1vw, 16px);">
                                <i class="bi bi-search position-absolute"
                                    style="left: 1rem; top: 50%; transform: translateY(-50%); color: var(--muted, #6c757d); font-size: 1.1rem; pointer-events: none; z-index: 1;"></i>
                                <button type="button" id="clearSearch" class="position-absolute d-none"
                                    style="right: 0.75rem; top: 50%; transform: translateY(-50%); background: transparent; border: none; color: var(--muted, #6c757d); font-size: 1.2rem; cursor: pointer; z-index: 1; padding: 0.25rem 0.5rem;"
                                    title="Clear search">
                                    <i class="bi bi-x-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <form id="deviceSelectionForm" action="{{ route('frontend.select') }}" method="GET">
                        <input type="hidden" name="service_id" value="{{ $service->id }}">
                        <div class="text-center mt-5 d-none">
                            <button type="submit" class="btn-gradient py-3 rounded w-lg-25">
                                Confirm
                            </button>
                        </div>
                        <div id="deviceList" class="device-grid mt-4 pt-2">
                            @foreach($deviceTypes as $deviceType)
                                @php
                                    $brandModel = $deviceType->repairBrand;
                                    $brandName = $brandModel ? $brandModel->name : ($deviceType->getAttributes()['brand'] ?? '');
                                    $searchText = strtolower($deviceType->name . ' ' . $brandName);
                                @endphp

                                <div class="device-item" data-search="{{ $searchText }}">
                                    <input type="radio" class="btn-check" name="device_type_id" id="device_{{ $deviceType->id }}"
                                        value="{{ $deviceType->id }}" autocomplete="off" />
                                    <label class="device-card flex-center gap-2" for="device_{{ $deviceType->id }}"
                                        style="padding: 12px 10px; font-size: 12px;">
                                        @if($brandModel && $brandModel->logo)
                                            <img src="{{ asset('storage/' . $brandModel->logo) }}" alt="{{ $deviceType->name }}"
                                                style="height: 15px;">
                                        @elseif($deviceType->brand === 'Apple')
                                            <i class="bi bi-apple"></i>
                                        @elseif($deviceType->brand === 'Samsung')
                                            <img src="{{ asset('front-assets/img/repair-samsung-2.svg') }}" alt="{{ $deviceType->name }}"
                                                style="height: 15px;">
                                        @elseif($deviceType->brand === 'Google Pixel')
                                            <img src="{{ asset('front-assets/img/Googlep.png') }}" alt="{{ $deviceType->name }}"
                                                style="height: 15px;">
                                        @elseif($deviceType->brand === 'Dell')
                                            <img src="{{ asset('front-assets/img/dell-logo.png') }}" alt="{{ $deviceType->name }}"
                                                style="height: 15px;">
                                        @elseif($deviceType->brand === 'HP')
                                            <img src="{{ asset('front-assets/img/hp-logo.png') }}" alt="{{ $deviceType->name }}"
                                                style="height: 15px;">
                                        @elseif($deviceType->brand === 'Asus')
                                            <img src="{{ asset('front-assets/img/asus-logo.png') }}" alt="{{ $deviceType->name }}"
                                                style="height: 15px;">
                                        @elseif($deviceType->brand === 'Lenovo')
                                            <img src="{{ asset('front-assets/img/lenovo-logo.jpg') }}" alt="{{ $deviceType->name }}"
                                                style="height: 15px;">
                                        @endif
                                        {{ $deviceType->name }}
                                        <span class="check-icon">
                                            <img src="{{ asset('front-assets/img/select-check.svg') }}" alt="" />
                                        </span>
                                    </label>
                                </div>
                            @endforeach

                            <div class="device-item device-item-others" data-search="others">
                                <input type="radio" class="btn-check" name="device_type_id" id="device_other" value="other"
                                    autocomplete="off" />
                                <label class="device-card" for="device_other" style="padding: 15px 12px; font-size: 12px;">
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
        @endif
    @else
        <section>
            <div class="container mb-custom">
                <div class="alert alert-warning text-center">
                    <p>Please select a service from the <a href="{{ route('frontend.book-repair') }}">Book Repair</a> page.</p>
                </div>
            </div>
        </section>
    @endif

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 justify-content-center position-relative">
                    <h5 class="modal-title fs-24 fw-bold" id="confirmationModalLabel">Confirm Selection</h5>
                    <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <p class="fs-18 mb-3">You have selected <span id="selectedDeviceName"
                            class="fw-bold text-primary"></span>.</p>
                    <p class="text-muted">Do you want to proceed with this device?</p>
                </div>
                <div class="modal-footer border-0 justify-content-center pb-4 gap-3">
                    <button type="button" class="btn btn-outline-secondary px-0" style="width: 160px;"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn-gradient px-0" style="width: 160px;" id="confirmSelectionBtn">Yes,
                        Proceed</button>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            #deviceSearch,
            #brandSearch {
                transition: all 0.3s ease;
            }

            .device-card {
                color: #000000;
                min-height: 80px; /* Balanced height */
                display: flex;
                flex-direction: row; /* Side by side */
                justify-content: center;
                align-items: center;
                text-align: center;
                gap: 10px;
                padding: 10px 15px;
            }

            #deviceSearch:focus,
            #brandSearch:focus {
                background: #fff;
                box-shadow: 0 0 0 3px rgba(104, 68, 113, 0.1);
            }

            #clearSearch:hover {
                color: var(--primary, #684471) !important;
            }

            .device-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 15px;
                max-width: 1200px;
                margin-left: auto;
                margin-right: auto;
            }

            @media (max-width: 768px) {
                .device-grid {
                    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
                    gap: 12px;
                }
                
                .device-card {
                    min-height: 70px;
                    font-size: 14px;
                }
            }

            @media (max-width: 576px) {
                .device-grid {
                    grid-template-columns: repeat(auto-fit, minmax(100%, 1fr));
                    gap: 10px;
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
            .btn-check:checked+.device-card {
                background-color: var(--primary, #684471) !important;
                color: white !important;
                border-color: var(--primary, #684471) !important;
            }

            .btn-check:checked+.device-card .check-icon {
                display: none;
            }

            .btn-check:checked+.device-card img,
            .btn-check:checked+.device-card i {
                filter: brightness(0) invert(1);
            }

            /* Brand card hover state */
            .device-card:hover {
                background-color: var(--primary, #684471) !important;
                color: white !important;
                border-color: var(--primary, #684471) !important;
            }

            .device-card:hover img,
            .device-card:hover i {
                filter: brightness(0) invert(1);
            }

            /* Logo sizing */
            .device-card img {
                height: 24px !important; /* Balanced icon size */
                margin-bottom: 0;
                object-fit: contain;
            }

            .device-card i {
                font-size: 20px;
                margin-bottom: 0;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Brand search functionality
                const brandSearchInput = document.getElementById('brandSearch');
                const brandList = document.getElementById('brandList');

                // Device search functionality
                const deviceSearchInput = document.getElementById('deviceSearch');
                const deviceList = document.getElementById('deviceList');

                const clearBtn = document.getElementById('clearSearch');

                // Get the active search input and list
                const searchInput = brandSearchInput || deviceSearchInput;
                const itemList = brandList || deviceList;
                const items = itemList ? itemList.querySelectorAll('.device-item') : [];

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
                    searchInput.addEventListener('input', function (e) {
                        updateClearButton();
                        const searchTerm = e.target.value.toLowerCase().trim();

                        let visibleCount = 0;
                        let firstVisible = null;
                        const othersItem = itemList.querySelector('.device-item-others');

                        // Filter items (exclude "Others")
                        items.forEach(function (item) {
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
                                // Uncheck hidden items (for device selection)
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

                        // Show/hide "No results" message
                        const noResultsMsg = document.getElementById('noResultsMessage');
                        if (visibleCount === 0 && searchTerm !== '') {
                            if (!noResultsMsg) {
                                const msg = document.createElement('div');
                                msg.id = 'noResultsMessage';
                                msg.className = 'text-center py-3 mb-3';
                                msg.style.color = 'var(--muted, #6c757d)';
                                msg.style.width = '100%';
                                msg.innerHTML = '<p class="mb-0 fs-18">No results found. You can select "Others" below.</p>';
                                itemList.insertBefore(msg, othersItem);
                            }
                        } else {
                            if (noResultsMsg) {
                                noResultsMsg.remove();
                            }
                        }
                    });

                    // Clear search button
                    if (clearBtn) {
                        clearBtn.addEventListener('click', function () {
                            searchInput.value = '';
                            searchInput.dispatchEvent(new Event('input'));
                            searchInput.focus();
                        });
                    }

                    // Clear search on Escape key
                    searchInput.addEventListener('keydown', function (e) {
                        if (e.key === 'Escape') {
                            e.target.value = '';
                            e.target.dispatchEvent(new Event('input'));
                            e.target.blur();
                        }
                    });

                    // Initial state
                    updateClearButton();
                }

                // Device selection modal logic (only for device selection view)
                const deviceRadios = document.querySelectorAll('input[name="device_type_id"]');
                const modalElement = document.getElementById('confirmationModal');

                if (modalElement && deviceRadios.length > 0) {
                    const confirmationModal = new bootstrap.Modal(modalElement);
                    const selectedDeviceNameSpan = document.getElementById('selectedDeviceName');
                    const confirmSelectionBtn = document.getElementById('confirmSelectionBtn');
                    const form = document.getElementById('deviceSelectionForm');

                    deviceRadios.forEach(radio => {
                        radio.addEventListener('change', function () {
                            if (this.checked) {
                                let deviceName = '';
                                const label = this.nextElementSibling;
                                if (label) {
                                    // Clone the label to avoid modifying the original
                                    const labelClone = label.cloneNode(true);
                                    // Remove the check icon from the clone if it exists
                                    const checkIcon = labelClone.querySelector('.check-icon');
                                    if (checkIcon) {
                                        checkIcon.remove();
                                    }
                                    // Extract text content
                                    deviceName = labelClone.innerText.trim();
                                }

                                if (selectedDeviceNameSpan) {
                                    selectedDeviceNameSpan.textContent = deviceName;
                                }
                                confirmationModal.show();
                            }
                        });
                    });

                    if (confirmSelectionBtn) {
                        confirmSelectionBtn.addEventListener('click', function () {
                            form.submit();
                        });
                    }
                }
            });
        </script>
    @endpush

@endsection