{{-- filepath: resources/views/resume/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Marc Santiago - Dashboard')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/resume-style.css') }}">
@endsection

@section('content')
<div class="container">
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
                    <button type="submit" class="nav-link logout-link" style="border: none; background: none; cursor: pointer;">
                        Logout
                    </button>
                </form>
            </li>
            <li><a href="{{ route('profile.edit') }}" class="nav-link">📝</a></li>
            <li><button id="themeToggle" class="theme-toggle" title="Toggle Dark/Light Mode">🌙</button></li>
        </ul>
    </nav>

    <!-- Shared Resume Sections -->
    @include('resume.partials._header')
    @include('resume.partials._summary')
    @include('resume.partials._experience')
    @include('resume.partials._education')
    @include('resume.partials._skills')
    @include('resume.partials._projects')
    @include('resume.partials._contact')

    <!-- Footer -->
    <footer>
        <p>© {{ date('Y') }} {{ $profile->full_name }}. Last updated: {{ $profile->updated_at->format('F j, Y') }}</p>
        <p><small>Dashboard View | Authenticated Session Active</small></p>
    </footer>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/resume.js') }}"></script>
@endsection
