<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — MariBelajarCoding</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-stone-50 flex items-center justify-center p-4">

<div class="w-full max-w-md">

    {{-- Logo --}}
    <div class="text-center mb-8">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5">
            <div class="w-10 h-10 rounded-xl bg-brand-500 flex items-center justify-center shadow-md">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <span class="font-display font-bold text-stone-900 text-xl">
                Mari<span class="text-brand-500">BelajarCoding</span>
            </span>
        </a>
        <p class="text-stone-500 text-sm mt-3">Masuk ke Panel Admin</p>
    </div>

    {{-- Card --}}
    <div class="card p-8">
        <h1 class="text-xl font-semibold text-stone-900 mb-1">Selamat Datang!</h1>
        <p class="text-stone-500 text-sm mb-7">Masuk untuk mengelola konten website.</p>

        {{-- Error --}}
        @if($errors->any())
            <div class="mb-5 p-4 rounded-xl bg-red-50 border border-red-100 text-red-700 text-sm flex items-center gap-2">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="form-label">Alamat Email</label>
                <input type="email" id="email" name="email"
                       value="{{ old('email') }}"
                       placeholder="admin@email.com"
                       autofocus required
                       class="form-input {{ $errors->has('email') ? 'border-red-300' : '' }}">
            </div>

            <div>
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" id="password" name="password"
                       placeholder="••••••••"
                       required
                       class="form-input">
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" id="remember" name="remember"
                       class="w-4 h-4 rounded border-stone-300 text-brand-500 focus:ring-brand-400">
                <label for="remember" class="text-sm text-stone-600">Ingat saya</label>
            </div>

            <button type="submit" class="btn-primary w-full justify-center py-3 mt-2">
                Masuk ke Admin
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </button>
        </form>
    </div>

    <p class="text-center text-xs text-stone-400 mt-6">
        <a href="{{ route('home') }}" class="hover:text-stone-600 transition-colors">← Kembali ke Website</a>
    </p>
</div>

</body>
</html>
