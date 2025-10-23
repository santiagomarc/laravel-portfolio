{{-- filepath: resources/views/resume/partials/_education.blade.php --}}
<section id="education">
    <h2>Education</h2>
    @forelse($education as $edu)
    <div class="education-item">
        <h3>{{ $edu->degree }} in {{ $edu->field_of_study }}</h3>
        <p class="school-date">
            <strong>{{ $edu->school }}</strong> 
            @if($edu->location) | {{ $edu->location }} @endif | 
            {{ $edu->start_date->format('Y') }} - 
            {{ $edu->is_current ? 'Present' : $edu->end_date->format('Y') }}
        </p>
        @if($edu->description)
        <p>{{ $edu->description }}</p>
        @endif
    </div>
    @empty
    <p>No education records added yet.</p>
    @endforelse
</section>
