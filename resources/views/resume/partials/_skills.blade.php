{{-- filepath: resources/views/resume/partials/_skills.blade.php --}}
<section id="skills">
    <h2>Technical Skills</h2>
    <div class="skills-grid">
        @php
            $groupedSkills = $skills->groupBy('category');
        @endphp
        
        @foreach($groupedSkills as $category => $skillList)
        <div class="skill-category">
            <h4>{{ $category ?: 'General' }}</h4>
            <div class="skills-list">
                @foreach($skillList as $skill)
                <div class="skill-item">
                    <div class="skill-info">
                        <span class="skill-name">{{ $skill->name }}</span>
                        <span class="skill-percentage">{{ $skill->proficiency_level }}%</span>
                    </div>
                    <div class="skill-bar">
                        <div class="skill-progress" data-level="{{ $skill->proficiency_level }}"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</section>
