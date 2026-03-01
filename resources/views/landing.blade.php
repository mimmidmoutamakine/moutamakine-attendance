<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Moutamakine</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center">

    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-100 p-10 max-w-md w-full text-center">

        <div class="mb-6">
            <img src="/logo.png" class="h-14 mx-auto mb-4">
            <h1 class="text-2xl font-semibold text-slate-900">
                Moutamakine Management
            </h1>
            <p class="text-sm text-slate-500 mt-2">
                School management system
            </p>
        </div>

        <div class="space-y-3">
            <a href="{{ route('login') }}"
               class="block w-full rounded-xl bg-sky-500 text-white py-2 font-medium shadow-md shadow-sky-300/60 hover:bg-sky-600 transition">
                Login
            </a>

            <a href="{{ route('register') }}"
               class="block w-full rounded-xl border border-slate-200 py-2 font-medium text-slate-700 hover:bg-slate-100 transition">
                Register
            </a>
        </div>

    </div>

</body>
</html>