<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <div class="box">
        <h2>Login</h2>

        @if ($errors->any())
            <p style="color:red">{{ $errors->first() }}</p>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <select name="role" required>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Login sebagai Admin</option>
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Login sebagai User</option>
            </select>

            <input type="email" name="email" required placeholder="Email" value="{{ old('email') }}">
            <input type="password" name="password" required placeholder="Password">

            <button type="submit" class="btn">Masuk</button>
        </form>
    </div>
</body>
</html>