
{{-- filepath: resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Resume Portfolio</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>LOGIN FORM</h1>
        <p>Please enter your credentials to log in.</p>
        
        @if($errors->any())
            <div class="error-message">
                @foreach($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif
        
        <form method="POST" action="{{ route('authenticate') }}">
            @csrf
            <input type="text" name="username" placeholder="Username" value="{{ old('username') }}" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>

    {{-- Add JavaScript for form validation --}}
    <script>
        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const username = document.querySelector('input[name="username"]').value.trim();
            const password = document.querySelector('input[name="password"]').value.trim();
            
            if (username.length < 3) {
                e.preventDefault();
                alert('Username must be at least 3 characters long.');
                return;
            }
            
            if (password.length < 4) {
                e.preventDefault();
                alert('Password must be at least 4 characters long.');
                return;
            }
        });

        // Auto-focus on username field
        document.querySelector('input[name="username"]').focus();
    </script>
</body>
</html>