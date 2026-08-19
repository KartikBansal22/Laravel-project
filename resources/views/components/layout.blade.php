<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 text-slate-900">


<header class="bg-slate-800 shadow-lg relative z-50">
    <nav class="max-w-screen-lg mx-auto flex items-center justify-between p-4">

        <a href="{{ route('products.index') }}" class="nav-link font-bold text-white">
           Whitecliffe Clothhouse
        </a>

        @auth
            <div class="flex items-center gap-6">

                {{-- Customer nav links --}}
                @if (auth()->user()->role === 'customer')
                    <a href="{{ route('products.index') }}" class="nav-link">Shop</a>
                    <a href="{{ route('cart.index') }}" class="nav-link">Cart</a>
                    <a href="{{ route('orders.index') }}" class="nav-link">My Orders</a>
                    <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                @endif

                {{-- Admin nav links --}}
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
                    <a href="{{ route('admin.products.index') }}" class="nav-link">Products</a>
                    <a href="{{ route('admin.categories.index') }}" class="nav-link">Categories</a>
                    <a href="{{ route('admin.orders.index') }}" class="nav-link">Orders</a>
                    <a href="{{ route('admin.users.index') }}" class="nav-link">Users</a>
                    <a href="{{ route('admin.reports.index') }}" class="nav-link">Reports</a>
                    @endif

                {{-- Profile dropdown --}}
                <div class="relative" x-data="{ open:false }">

                    <button @click="open=!open" class="round-btn">
                        <img src="{{ asset('img/img_avatar2.png') }}" alt="profile">
                    </button>

                    <div x-show="open"
                         x-transition
                         @click.outside="open=false"
                         class="bg-white shadow-lg absolute top-12 right-0 rounded-lg overflow-hidden w-44 z-50">

                        <p class="username px-4 py-2 text-sm text-slate-500 border-b">
                            {{ auth()->user()->username }}
                            <span class="block text-xs capitalize">{{ auth()->user()->role }}</span>
                        </p>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left hover:bg-slate-100 px-4 py-2 text-sm">
                                Logout
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        @endauth

        @guest
        <div class="flex gap-4">
            <a href="{{ route('login') }}" class="nav-link">Login</a>
            <a href="{{ route('register') }}" class="nav-link">Register</a>
        </div>
        @endguest

    </nav>
</header>


<section class="hero relative overflow-hidden h-[40vh]">

   
    <div class="slider absolute inset-0 z-0">

        <div class="slide active absolute w-full h-full">
            <img class="w-full h-full object-cover"
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSLT7ukTQGyw5bLa-IUobbcLIQSXS6g89Ch_JXfnBcaV3lbma8WW_pqP-JG&s=10">
        </div>

        <div class="slide absolute w-full h-full">
            <img class="w-full h-full object-cover"
                src="https://img.freepik.com/free-photo/makeup-brush-eyeglasses-cactus-plant-white-flower-bouquet-with-laptop-blue-background_23-2148178672.jpg">
        </div>

        <div class="slide absolute w-full h-full">
            <img class="w-full h-full object-cover"
                src="https://img.freepik.com/free-photo/flowers-notebook-near-laptop_23-2147759307.jpg">
        </div>

    </div>

  
    <div class="absolute inset-0 bg-black/80 z-10"></div>

   
    <div class="absolute inset-0 flex items-center pl-10 text-white z-20">
        <div>
       <h1 class="text-4xl font-bold">Welcome to Whitecliffe Clothhouse</h1>
        </div>
    </div>

</section>


<main class="py-8 px-4 mx-auto max-w-screen-lg">

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    {{ $slot }}
</main>

</body>
</html>