{{-- filepath: resources/views/resume/partials/_experience.blade.php --}}
<section id="experience">
    <h2>Work Experience</h2>
    @forelse($experiences as $job)
    <div class="job">
        <h3>{{ $job->job_title }}</h3>
        <p class="company-date">
            <strong>{{ $job->company }}</strong> 
            @if($job->location) | {{ $job->location }} @endif | 
            {{ $job->start_date->format('M Y') }} - 
            {{ $job->is_current ? 'Present' : $job->end_date->format('M Y') }}
        </p>
        @if($job->description)
        <p>{{ $job->description }}</p>
        @endif
    </div>
    @empty
    <p>No work experience added yet.</p>
    @endforelse
</section>
