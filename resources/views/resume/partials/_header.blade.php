{{-- filepath: resources/views/resume/partials/_header.blade.php --}}
<header class="resume-header">
    <div class="header-left">
        <h1>{{ $profile->full_name }}</h1>
        <h2 class="job-title">{{ $profile->title ?? 'Full Stack Developer' }}</h2>
        <div class="contact-info">
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Phone:</strong> {{ $profile->phone ?? 'N/A' }}</p>
            <p><strong>Location:</strong> {{ $profile->location ?? 'N/A' }}</p>
            @if($profile->github)
            <p><strong>GitHub:</strong> <a href="{{ $profile->github }}" target="_blank" class="github-link">{{ $profile->github }}</a></p>
            @endif
        </div>
    </div>
    <div class="header-right">
        <div class="profile-photo">
            @if($profile->profile_image)
                <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="Profile Photo" class="profile-img">
            @else
                <img src="{{ asset('images/me.jpg') }}" alt="Profile Photo" class="profile-img">
            @endif
        </div>
    </div>
</header>
