{{-- filepath: resources/views/resume/partials/_summary.blade.php --}}
<section id="summary">
    <h2>About Me</h2>
    <p>{{ $profile->bio ?? 'A passionate developer eager to build innovative solutions.' }}</p>
</section>
