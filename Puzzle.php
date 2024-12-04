<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeux Aventure</title>
    <!-- Lien CDN de Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js" defer></script>
    <!-- Choices.js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <style>
        /* Effet dynamique au survol */
        .game-card:hover {
            transform: scale(1.1);
            transition: transform 0.3s ease-in-out;
        }
    </style>
</head>

<body class="bg-gray-900 text-white">

    <!-- Header -->
    <header class="bg-gray-800 py-4 px-6 relative">
        <div class="flex justify-between items-center">
            <!-- Formulaire avec un bouton pour la route /home -->
            <form action="/" method="GET">
                <button type="submit" class="text-gray-300 hover:text-white focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2 2 7-7 7 7 2-2-9-9-9 9z" />
                    </svg>
                </button>
            </form>

            <h1 class="text-2xl font-bold text-white">Jeux Aventure</h1>

           
        </div>

       
    </header>

    <!-- Liste des jeux -->
    <section class="py-16 bg-gray-900">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Cartes des jeux -->
                <div class="game-card bg-gray-800 p-4 rounded-lg shadow-md transition-transform duration-300">
                    <img src="https://via.placeholder.com/300" alt="Jeu 1" class="rounded mb-4">
                    <h3 class="text-lg font-semibold">Jeu Aventure 1</h3>
                    <p class="text-gray-400">Description rapide du jeu.</p>
                </div>
                <div class="game-card bg-gray-800 p-4 rounded-lg shadow-md transition-transform duration-300">
                    <img src="https://via.placeholder.com/300" alt="Jeu 2" class="rounded mb-4">
                    <h3 class="text-lg font-semibold">Jeu Aventure 2</h3>
                    <p class="text-gray-400">Description rapide du jeu.</p>
                </div>
                <div class="game-card bg-gray-800 p-4 rounded-lg shadow-md transition-transform duration-300">
                    <img src="https://via.placeholder.com/300" alt="Jeu 3" class="rounded mb-4">
                    <h3 class="text-lg font-semibold">Jeu Aventure 3</h3>
                    <p class="text-gray-400">Description rapide du jeu.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Script -->
    <script>
        // Initialisation des dropdowns avec Choices.js
        document.addEventListener('DOMContentLoaded', () => {
            const filters = document.querySelectorAll('.choices');
            filters.forEach(filter => {
                new Choices(filter);
            });
        });
    </script>

</body>

</html>
