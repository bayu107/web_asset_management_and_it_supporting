<!-- resources/views/includes/sidebar.blade.php -->

<div class="sidebar">
    @guest
        <!-- Tampilkan tautan login dan register jika pengguna belum login -->
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
    @else
        <!-- Tampilkan tautan dashboard jika pengguna sudah login -->
        <a href="{{ route('dashboard') }}">Dashboard</a>

        <!-- Tampilkan tautan logout jika pengguna sudah login -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @endguest
</div>
