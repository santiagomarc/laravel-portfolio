{{-- filepath: resources/views/resume/partials/_projects.blade.php --}}
<section id="projects">
    <h2>Notable Projects</h2>
    @forelse($projects as $project)
    <div class="project">
        <h3>
            <a href="#" class="project-link" data-project="{{ $project->id }}">{{ $project->title }}</a>
        </h3>
        <p>{{ $project->description }}</p>
        @if($project->technologies)
        <p><strong>Technologies:</strong> {{ $project->technologies }}</p>
        @endif
    </div>
    @empty
    <p>No projects added yet.</p>
    @endforelse
    
    <!-- Project Modal -->
    <div id="project-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="modal-body"></div>
        </div>
    </div>
</section>
