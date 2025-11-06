@extends('frontend.layouts.app')

@section('title', 'Join Us')

@section('content')
<section class="join-hero-section flex-stack mb-custom">
      <div class="container flex-stack flex-column">
        <h1 class="display-2 fw-900 font-satoshi text-white mb-3">{{ $content->hero_title ?? 'Join Us' }}</h1>

        <p class="text-white text-center fw-400 fs-18 mb-4">
          {!! nl2br(e($content->hero_description ?? 'Reliable Phone Repair Services, Guaranteed to Meet Expectations')) !!}
        </p>
      </div>
    </section>
    <!-- Hero Section End -->

    <!-- offer-section  -->
    <section>
      <div class="container mb-custom">
        <div class="row row-cols-1 row-cols-md-2">
          <div class="col">
            <div class="h-100">
              <img class="img-fluid" src="{{ asset('front-assets/img/offer-bg.svg') }}" alt="" />
            </div>
          </div>
          <div class="col">
            <button class="btn-gradient-outline mt-4 mt-md-0">{{ $content->our_team_badge ?? 'Our Team' }}</button>
            <h1 class="my-3">
              {{ $content->our_team_title ?? 'If you want to lift yourself up, lift up someone else.' }}
            </h1>
            <p class="fs-18 fw-400 my-4">
              {{ $content->our_team_description ?? 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,' }}
            </p>
            @php
              $features = $content->our_team_features ?? ['Fast Turnaround Time', 'Comprehensive Warranty'];
              $featureImages = ['choose-1.svg', 'choose-2.svg'];
            @endphp
            @foreach($features as $index => $feature)
              <div class="choose-card h-auto mt-3 w-md-75">
                <img src="{{ asset('front-assets/img/' . ($featureImages[$index] ?? 'choose-1.svg')) }}" alt="img" />
                <span>{{ $feature }}</span>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="container mb-custom">
        <div class="text-center">
          <button class="btn-gradient-outline">{{ $content->meet_team_badge ?? 'Meet Our Team' }}</button>
          <h1 class="my-4">
            {!! $content->meet_team_title ?? 'The Faces Behind MobiCare\'s <br /> Reliable Service' !!}
          </h1>
        </div>
        <div class="row row-cols-lg-4 row-cols-2 g-3">
          @php
            $teamMembers = $content->team_members ?? [
              ['name' => 'Team Name', 'designation' => 'Designation'],
              ['name' => 'Team Name', 'designation' => 'Designation'],
              ['name' => 'Team Name', 'designation' => 'Designation'],
              ['name' => 'Team Name', 'designation' => 'Designation'],
            ];
          @endphp
          @foreach($teamMembers as $member)
            <div class="col">
              <div class="team-card">
                <div class="outer-div">
                  <img
                    class="img-fluid"
                    src="{{ asset('front-assets/img/placholder-img.svg') }}"
                    alt="Team Member Image"
                  />
                </div>
                <h5>{{ $member['name'] ?? 'Team Name' }}</h5>
                <p>{{ $member['designation'] ?? 'Designation' }}</p>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    <section>
      <div class="container mb-custom">
        <div class="row row-cols-1 row-cols-md-2 g-3">
          <div class="col">
            <button class="btn-gradient-outline">{{ $content->join_us_badge ?? 'Join Us' }}</button>
            <h1 class="my-3">
              {{ $content->join_us_title ?? 'Passionate About Phone Repair? Join MobiCare Now!' }}
            </h1>
            <p class="fs-18 fw-400 my-4">
              {{ $content->join_us_description ?? 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,' }}
            </p>
            <button class="btn-gradient rounded" onclick="window.location.href='{{ route('frontend.contact') }}'">{{ $content->join_us_button_text ?? 'Contact Us' }}</button>
          </div>
          <div class="col">
            <div class="h-100">
              <img class="img-fluid" src="{{ asset('front-assets/img/join-us-2.svg') }}" alt="" />
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection

