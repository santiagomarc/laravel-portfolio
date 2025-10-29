{{-- filepath: resources/views/resume/public.blade.php --}}
@extends('layouts.app')

@section('title', 'Marc Santiago - Resume')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/resume-style.css') }}">
<style>
    /* Hide dashboard-specific elements */
    .dashboard-actions,
    .logout-link {
        display: none !important;
    }
    /* Public view badge */
    .public-badge {
        position: fixed;
        top: 20px;
        right: 20px;
        background: #27ae60;
        color: white;
        padding: 8px 15px;
        border-radius: 20px;
        font-size: 12px;
        z-index: 1000;
    }
</style>
@endsection

@section('content')
<div class="container public-view">
    <div class="public-badge">
        Public View
    </div>

    <!-- Simple Navigation (no logout) -->
    <nav class="floating-nav" id="floatingNav">
        <ul>
            <li><a href="#summary" class="nav-link">Summary</a></li>
            <li><a href="#experience" class="nav-link">Experience</a></li>
            <li><a href="#education" class="nav-link">Education</a></li>
            <li><a href="#skills" class="nav-link">Skills</a></li>
            <li><a href="#projects" class="nav-link">Projects</a></li>
            <li><button id="themeToggle" class="theme-toggle" title="Toggle Dark/Light Mode">🌙</button></li>
        </ul>
    </nav>

    @include('resume.partials._header')
    @include('resume.partials._summary')
    @include('resume.partials._experience')
    @include('resume.partials._education')
    @include('resume.partials._skills')
    @include('resume.partials._projects')

    <footer>
        <p>© {{ date('Y') }} {{ $profile->full_name }}</p>
        <p><small>Public Resume View</small></p>
    </footer>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/resume.js') }}"></script>
@endsection
