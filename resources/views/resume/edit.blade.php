{{-- filepath: resources/views/resume/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Resume')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/resume-style.css') }}">
<style>
    .edit-container {
        max-width: 900px;
        margin: 50px auto;
        padding: 30px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    .edit-header {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #3498db;
    }
    .edit-header h1 {
        color: #2c3e50;
        margin: 0;
    }
    .form-section {
        margin-bottom: 40px;
    }
    .form-section h2 {
        color: #3498db;
        font-size: 24px;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #ecf0f1;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 8px;
    }
    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
        font-family: inherit;
        transition: border-color 0.3s;
    }
    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #3498db;
    }
    .form-group textarea {
        min-height: 120px;
        resize: vertical;
    }
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    .form-actions {
        display: flex;
        gap: 15px;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #ecf0f1;
    }
    .btn {
        padding: 12px 30px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s;
    }
    .btn-primary {
        background: #3498db;
        color: white;
    }
    .btn-primary:hover {
        background: #2980b9;
    }
    .btn-secondary {
        background: #95a5a6;
        color: white;
    }
    .btn-secondary:hover {
        background: #7f8c8d;
    }
    .success-message {
        background: #2ecc71;
        color: white;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }
    .error-message {
        background: #e74c3c;
        color: white;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }
    .helper-text {
        font-size: 12px;
        color: #7f8c8d;
        margin-top: 5px;
    }
    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
        .edit-container {
            margin: 20px;
            padding: 20px;
        }
    }
</style>
@endsection

@section('content')
<div class="edit-container">
    <div class="edit-header">
        <h1>📝 Edit Your Resume</h1>
        <p>Update your personal information and resume details</p>
    </div>

    @if(session('success'))
        <div class="success-message">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="error-message">
            <strong>⚠️ Please fix the following errors:</strong>
            <ul style="margin: 10px 0 0 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf

        <!-- Personal Information Section -->
        <div class="form-section">
            <h2>👤 Personal Information</h2>
            
            <div class="form-group">
                <label for="full_name">Full Name *</label>
                <input 
                    type="text" 
                    id="full_name" 
                    name="full_name" 
                    value="{{ old('full_name', $profile->full_name) }}" 
                    required
                    placeholder="Enter your full name"
                >
            </div>

            <div class="form-group">
                <label for="title">Professional Title</label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    value="{{ old('title', $profile->title) }}"
                    placeholder="e.g., Full Stack Developer, Software Engineer"
                >
                <div class="helper-text">Your job title or professional role</div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input 
                        type="tel" 
                        id="phone" 
                        name="phone" 
                        value="{{ old('phone', $profile->phone) }}"
                        placeholder="+63 912 345 6789"
                    >
                </div>

                <div class="form-group">
                    <label for="location">Location</label>
                    <input 
                        type="text" 
                        id="location" 
                        name="location" 
                        value="{{ old('location', $profile->location) }}"
                        placeholder="City, Country"
                    >
                </div>
            </div>
        </div>

        <!-- Online Presence Section -->
        <div class="form-section">
            <h2>🌐 Online Presence</h2>
            
            <div class="form-group">
                <label for="github">GitHub Profile</label>
                <input 
                    type="url" 
                    id="github" 
                    name="github" 
                    value="{{ old('github', $profile->github) }}"
                    placeholder="https://github.com/yourusername"
                >
            </div>
        </div>

        <!-- About Me Section -->
        <div class="form-section">
            <h2>📄 About Me / Professional Summary</h2>
            
            <div class="form-group">
                <label for="bio">Bio / Summary</label>
                <textarea 
                    id="bio" 
                    name="bio" 
                    placeholder="Write a brief summary about yourself, your skills, and what you're passionate about..."
                >{{ old('bio', $profile->bio) }}</textarea>
                <div class="helper-text">A short paragraph describing your professional background and goals (max 1000 characters)</div>
            </div>
        </div>


        <!-- Form Actions -->
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                💾 Save Changes
            </button>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                ❌ Cancel
            </a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    // Auto-save draft (optional enhancement)
    document.querySelectorAll('input, textarea').forEach(element => {
        element.addEventListener('blur', function() {
            // Could implement auto-save to localStorage here
            console.log('Field updated:', this.name);
        });
    });

    // Confirm before leaving if form has changes
    let formChanged = false;
    document.querySelectorAll('input, textarea').forEach(element => {
        element.addEventListener('change', function() {
            formChanged = true;
        });
    });

    window.addEventListener('beforeunload', function(e) {
        if (formChanged) {
            e.preventDefault();
            e.returnValue = 'You have unsaved changes. Are you sure you want to leave?';
        }
    });

    // Clear flag when form is submitted
    document.querySelector('form').addEventListener('submit', function() {
        formChanged = false;
    });
</script>
@endsection
