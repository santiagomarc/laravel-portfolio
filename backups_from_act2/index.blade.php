{{-- filepath: resources/views/resume/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Portfolio - {{ $name }}')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/resume-style.css') }}">
@endsection

@section('content')
<div class="container">
    <header class="resume-header">
        <div class="header-left">
            <h1>{{ $name }}</h1>
            <h2 class="job-title">{{ $jobTitle }}</h2>
            <div class="contact-info">
                <p><strong>Email:</strong> {{ $email }}</p>
                <p><strong>Phone:</strong> {{ $phone }}</p>
                <p><strong>Address:</strong> {{ $location }}</p>
                <p><strong>GitHub:</strong> <a href="{{ $github }}" target="_blank" class="github-link">{{ $github }}</a></p>
            </div>
        </div>
        <div class="header-right">
            <div class="profile-photo">
                <img src="{{ asset('images/me.jpg') }}" alt="Profile Photo" class="profile-img">
            </div>
        </div>
    </header>
    
    <!-- Floating Navigation -->
    <nav class="floating-nav" id="floatingNav">
        <ul>
            <li><a href="#summary" class="nav-link">Summary</a></li>
            <li><a href="#experience" class="nav-link">Experience</a></li>
            <li><a href="#education" class="nav-link">Education</a></li>
            <li><a href="#skills" class="nav-link">Skills</a></li>
            <li><a href="#projects" class="nav-link">Projects</a></li>
            <li><a href="#contact" class="nav-link">Contact</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="nav-link logout-link" style="border: none; cursor: pointer;">
                    Logout
                </button>
                </form>
            </li>
            <li><button id="themeToggle" class="theme-toggle" title="Toggle Dark/Light Mode">🌙</button></li>
        </ul>
    </nav>
    
    <section id="summary">
        <h2>About Me</h2>
        <p>A third-year BS Computer Science student with a strong passion for machine learning, artificial intelligence, 
            and full-stack development. Eager to apply theoretical knowledge to real-world projects, with growing experience 
            in software development, problem-solving, and research. Enthusiastic about continuous learning, collaboration, 
            and building innovative solutions.</p>
    </section>
    
    <section id="experience">
        <h2>Work Experience</h2>
        @foreach($experience as $job)
        <div class="job">
            <h3>{{ $job['title'] }}</h3>
            <p class="company-date"><strong>{{ $job['company'] }}</strong> | {{ $job['period'] }}</p>
            <ul>
                @foreach($job['duties'] as $duty)
                <li>{{ $duty }}</li>
                @endforeach
            </ul>
        </div>
        @endforeach
    </section>

    <section id="education">
        <h2>Education</h2>
        @foreach($education as $edu)
        <div class="education-item">
            <h3>{{ $edu['degree'] }}</h3>
            <p class="school-date"><strong>{{ $edu['school'] }}</strong> | {{ $edu['period'] }}</p>
            <p>{{ $edu['details'] }}</p>
        </div>
        @endforeach
    </section>
    
    <section id="skills">
        <h2>Technical Skills</h2>
        <div class="skills-grid">
            @foreach($skills as $category => $skillList)
            <div class="skill-category">
                <h4>{{ $category }}</h4>
                <div class="skills-list">
                    @foreach($skillList as $skill)
                    <div class="skill-item">
                        <div class="skill-info">
                            <span class="skill-name">{{ $skill['name'] }}</span>
                            <span class="skill-percentage">{{ $skill['level'] }}%</span>
                        </div>
                        <div class="skill-bar">
                            <div class="skill-progress" data-level="{{ $skill['level'] }}"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </section>
    
    <section id="projects">
        <h2>Notable Projects</h2>
        @foreach($projects as $project)
        <div class="project">
            <h3><a href="#" class="project-link" data-project="{{ $project['id'] }}">{{ $project['title'] }}</a></h3>
            <p>{{ $project['description'] }}</p>
            @if(isset($project['technologies']))
            <p><strong>Technologies:</strong> {{ implode(', ', $project['technologies']) }}</p>
            @endif
        </div>
        @endforeach
        
        <div id="project-modal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div id="modal-body"></div>
            </div>
        </div>
    </section>

    <section id="contact">
        <h2>Get In Touch</h2>
        <p>Feel free to reach out for collaboration opportunities or just to say hello!</p>
        <form id="contactForm" method="POST" action="{{ route('contact.send') }}">
            @csrf
            <div class="form-row">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
            </div>
            <textarea name="message" placeholder="Your Message" required></textarea>
            <button type="submit">Send Message</button>
        </form>
        <div id="form-response"></div>
    </section>
    
    <!-- PHP-powered footer -->
    <footer>
        <p>© {{ date('Y') }} {{ $name }}. Last updated: {{ date('F j, Y') }}</p>
        <p><small>Built with Laravel Framework | Authenticated Session Active</small></p>
    </footer>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/resume.js') }}"></script>
@endsection