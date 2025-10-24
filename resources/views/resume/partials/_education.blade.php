{{-- filepath: resources/views/resume/partials/_education.blade.php --}}
<section id="education">
    <h2>Education</h2>
    @forelse($education as $edu)
    <div class="education-item">
        <h3>{{ $edu->degree }}</h3>
        <p class="school-date">{{ $edu->school_details }}</p>
        @if($edu->description)
        <p>{{ $edu->description }}</p>
        @endif
    </div>
    @empty
    <p>No education records added yet.</p>
    @endforelse
</section>
