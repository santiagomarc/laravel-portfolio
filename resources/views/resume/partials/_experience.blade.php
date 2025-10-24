{{-- filepath: resources/views/resume/partials/_experience.blade.php --}}
<section id="experience">
    <h2>Work Experience</h2>
    @forelse($experiences as $job)
    <div class="job">
        <h3>{{ $job->job_title }}</h3>
        <p class="company-date">{{ $job->company_details }}</p>
        @if($job->description)
        <p style="white-space: pre-line;">{{ $job->description }}</p>
        @endif
    </div>
    @empty
    <p>No work experience added yet.</p>
    @endforelse
</section>
