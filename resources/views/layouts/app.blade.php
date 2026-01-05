<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Cart</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('styles')
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="flex h-screen overflow-hidden">
        
        <aside class="w-64 bg-[#1e293b] text-gray-300 flex-shrink-0 flex flex-col">
            <div class="p-6 flex items-center gap-2 text-white font-bold text-lg">
                <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7a1 1 0 00.9 1.5h12.1a1 1 0 00.9-1.5L17 13M7 13V6h10v7M10 21a1 1 0 11-2 0 1 1 0 012 0zm10 0a1 1 0 11-2 0 1 1 0 012 0z"/>
                </svg>
                E-Commerce Cart
            </div>

            
            <nav class="flex-1 px-4 space-y-2 py-4">
                <a href="{{ route('products') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-slate-800 rounded-lg transition">
                    <span>Products</span>
                </a>
                <a href="{{ route('cart') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-slate-800 rounded-lg transition">
                    <span>Shopping Cart</span>
                </a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col overflow-y-auto">
            
        <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-8">
            <h2 class="text-xl font-semibold text-gray-800">
                @yield('pageTitle', 'Dashboard')
            </h2>

            
            <div x-data="{ open: false }" class="relative">
                <!-- Display logged-in user's name -->
                <button @click="open = !open" class="flex items-center gap-2 text-sm font-medium text-gray-600 hover:text-gray-900 focus:outline-none">
                    {{ auth()->user()->name }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg py-1 z-50">
                    <hr>
                    <!-- Logout form -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </header>


            <main class="p-8">
                {{-- Check if $slot exists (Livewire), otherwise use @yield (Blade) --}}
                @if(isset($slot))
                    {{ $slot }}
                @else
                    @yield('content')
                @endif
            </main>
        </div>
    </div>
    @livewireScripts
    @stack('scripts')
</body>
</html>