<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MIHAINGO Store MG - Friperie de qualité, Parfums et Accessoires au meilleur prix à Madagascar">
    <title>{{ $title ?? 'MIHAINGO Store MG' }} - Votre Boutique en Ligne</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">

        <!-- Main Navigation -->
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-pink-500 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <span class="text-xl font-bold bg-gradient-to-r from-purple-600 to-pink-500 bg-clip-text text-transparent">MIHAINGO Store MG</span>
                </a>

                <!-- Search Bar -->
                <div class="hidden md:flex flex-1 max-w-lg mx-8 items-center gap-2">
                    <form action="{{ route('shop') }}" method="GET" class="flex-1">
                        <div class="relative">
                            <input type="text" name="search" placeholder="Rechercher un produit..."
                                   class="w-full pl-4 pr-12 py-2 border border-gray-300 rounded-full focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                   value="{{ request('search') }}">
                            <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-gradient-to-r from-purple-600 to-pink-500 text-white p-2 rounded-full hover:opacity-90 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                    <!-- Search by Image Button -->
                    <button type="button" onclick="document.getElementById('imageSearchModal').classList.remove('hidden')"
                            class="flex-shrink-0 text-gray-400 hover:text-purple-600 p-2 transition" title="Rechercher par image">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </button>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-purple-600 font-medium transition">Accueil</a>
                    <a href="{{ route('shop') }}" class="text-gray-700 hover:text-purple-600 font-medium transition">Boutique</a>

                    <!-- Cart -->
                    @livewire('cart-icon')
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center space-x-4">
                    @livewire('cart-icon')
                    <button id="mobile-menu-btn" class="text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden pb-4">
                <div class="flex items-center gap-2 mb-4">
                    <form action="{{ route('shop') }}" method="GET" class="flex-1">
                        <input type="text" name="search" placeholder="Rechercher..."
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    </form>
                    <button type="button" onclick="document.getElementById('imageSearchModal').classList.remove('hidden')"
                            class="flex-shrink-0 p-2 border border-gray-300 rounded-lg text-gray-500 hover:text-purple-600 hover:border-purple-500 transition" title="Rechercher par image">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </button>
                </div>
                <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-purple-600">Accueil</a>
                <a href="{{ route('shop') }}" class="block py-2 text-gray-700 hover:text-purple-600">Boutique</a>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About -->
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-pink-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-bold">MIHAINGO Store MG</span>
                    </div>
                    <p class="text-gray-400">Votre destination pour la mode de seconde main de qualité, parfums et accessoires au meilleur prix à Madagascar.</p>
                </div>

                <!-- Categories -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Categories</h3>
                    <ul class="space-y-2 text-gray-400">
                        @php $categories = \App\Models\Category::take(5)->get(); @endphp
                        @foreach($categories as $category)
                            <li><a href="{{ route('shop', ['category' => $category->slug]) }}" class="hover:text-white transition">{{ $category->nom }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Antananarivo, Madagascar</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span>+261 34 77 677 72</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span>+261 38 37 363 62</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>contact@mihaingo.mg</span>
                        </li>
                    </ul>
                </div>

                <!-- Payment -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Paiement</h3>
                    <p class="text-gray-400 mb-4">Paiement à la livraison uniquement</p>
                    <div class="flex items-center space-x-2 text-gray-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span>Cash à la livraison</span>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} MIHAINGO Store MG. Tous droits reserves.</p>
            </div>
        </div>
    </footer>

    <!-- Image Search Modal -->
    <div id="imageSearchModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/50" onclick="document.getElementById('imageSearchModal').classList.add('hidden')"></div>

        <!-- Modal Content -->
        <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 z-10">
            <button type="button" onclick="document.getElementById('imageSearchModal').classList.add('hidden')"
                    class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <div class="text-center mb-6">
                <div class="w-16 h-16 mx-auto mb-3 bg-gradient-to-br from-purple-100 to-pink-100 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Rechercher par image</h3>
                <p class="text-sm text-gray-500 mt-1">Importez une photo pour trouver des produits similaires</p>
            </div>

            <form action="{{ route('shop.search-by-image') }}" method="POST" enctype="multipart/form-data" id="imageSearchForm">
                @csrf
                <!-- Drop Zone -->
                <label id="imageDropZone"
                       class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-purple-500 hover:bg-purple-50/50 transition-all duration-200">
                    <div id="imageDropContent" class="flex flex-col items-center justify-center py-4">
                        <svg class="w-10 h-10 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-sm text-gray-600 font-medium">Cliquez ou glissez une image ici</p>
                        <p class="text-xs text-gray-400 mt-1">JPG, PNG, WEBP (max 5 Mo)</p>
                    </div>
                    <div id="imagePreviewContainer" class="hidden w-full h-full flex items-center justify-center p-2">
                        <img id="imagePreview" class="max-h-full max-w-full object-contain rounded-lg" alt="Preview">
                    </div>
                    <input type="file" name="image" accept="image/*" class="hidden" id="imageSearchInput">
                </label>

                <!-- Submit -->
                <button type="submit" id="imageSearchSubmit"
                        class="w-full mt-4 bg-gradient-to-r from-purple-600 to-pink-500 text-white font-medium py-3 px-4 rounded-xl hover:opacity-90 transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2"
                        disabled>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <span id="imageSearchBtnText">Rechercher</span>
                </button>
            </form>
        </div>
    </div>

    @livewireScripts
    <script>
        document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        // Image Search Modal Logic
        (function() {
            const input = document.getElementById('imageSearchInput');
            const preview = document.getElementById('imagePreview');
            const previewContainer = document.getElementById('imagePreviewContainer');
            const dropContent = document.getElementById('imageDropContent');
            const submitBtn = document.getElementById('imageSearchSubmit');
            const btnText = document.getElementById('imageSearchBtnText');
            const form = document.getElementById('imageSearchForm');
            const dropZone = document.getElementById('imageDropZone');

            input?.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        previewContainer.classList.remove('hidden');
                        dropContent.classList.add('hidden');
                        submitBtn.disabled = false;
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });

            // Drag and drop
            ['dragenter', 'dragover'].forEach(evt => {
                dropZone?.addEventListener(evt, function(e) {
                    e.preventDefault();
                    this.classList.add('border-purple-500', 'bg-purple-50/50');
                });
            });

            ['dragleave', 'drop'].forEach(evt => {
                dropZone?.addEventListener(evt, function(e) {
                    e.preventDefault();
                    this.classList.remove('border-purple-500', 'bg-purple-50/50');
                });
            });

            dropZone?.addEventListener('drop', function(e) {
                const files = e.dataTransfer.files;
                if (files.length > 0 && files[0].type.startsWith('image/')) {
                    input.files = files;
                    input.dispatchEvent(new Event('change'));
                }
            });

            // Loading state on submit
            form?.addEventListener('submit', function() {
                submitBtn.disabled = true;
                btnText.textContent = 'Recherche en cours...';
            });
        })();
    </script>
</body>
</html>
