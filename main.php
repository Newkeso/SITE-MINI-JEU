<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plateforme de Mini-Jeux</title>
    <!-- Lien CDN de Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <!-- Choices.js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <style>
        .game-card:hover {
            transform: scale(1.1);
        }

        .game-card {
            transition: transform 0.3s ease;
        }

        .profile-pic {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
    </style>
</head>

<body class="bg-gray-900 text-white scroll-smooth">

<!-- Navigation -->
 <header class="bg-gray-800 py-4 px-6 flex justify-between items-center">
    <!-- Icône Home -->
    <div x-data="{ open: false }" class="relative">
        <button @click="open = !open" class="text-gray-300 hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9.75L12 4l9 5.75v8.5A2.75 2.75 0 0 1 18.25 21H5.75A2.75 2.75 0 0 1 3 18.25V9.75z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 21V12h6v9" />
            </svg>
        </button>
        <!-- Menu déroulant -->
        <div x-show="open" @click.outside="open = false" class="absolute left-0 top-12 bg-gray-700 rounded-lg shadow-md w-40 py-2 z-10">
            <a href="#home" class="block px-4 py-2 text-gray-300 hover:bg-gray-600 hover:text-white">Accueil</a>
            <a href="dbz.html" class="block px-4 py-2 text-gray-300 hover:bg-gray-600 hover:text-white">Univers</a>
            <a href="#games" class="block px-4 py-2 text-gray-300 hover:bg-gray-600 hover:text-white">Jeux</a>
        </div>
    </div>

   <!-- Profil Utilisateur -->
   <div x-data="{ isLoggedIn: {{ 'true' if is_logged_in else 'false' }} , openProfile: false }" class="relative">
            <!-- Cercle de Profil ou Initiales -->
            <button @click="openProfile = !openProfile" class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-400 text-white text-xl font-bold">
                <template x-if="!isLoggedIn">
                    <span>?</span> <!-- Initiale par défaut si non connecté -->
                </template>
                <template x-if="isLoggedIn">
                    <!-- Affichage du profil de l'utilisateur lorsqu'il est connecté -->
                    {% if utilisateur %}
                        <img src="{{ url_for('static', filename='uploads/' + utilisateur[7]) }}" alt="Profil" class="w-10 h-10 rounded-full object-cover">
                    {% endif %}
                </template>
            </button>

          
 <!-- Menu Profil -->
 <div x-show="openProfile" @click.outside="openProfile = false" x-transition class="absolute right-0 mt-2 bg-gray-700 rounded-lg shadow-md w-72 py-2 z-50">
    <template x-if="isLoggedIn">
        <!-- Si l'utilisateur est connecté -->
        <div class="px-4 py-2 text-gray-300 border-b border-gray-600">
            Temps passé sur le site : <span x-text="timeSpent + 's'"></span>
            <a href="{{ url_for('deconnexion') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-600">Déconnexion</a>
            <a href="{{ url_for('profil') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-600">Modifier le profil</a>
        </div>
        <a href="{{ url_for('profil') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-600">Modifier le profil</a>
        <a href="{{ url_for('deconnexion') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-600">Déconnexion</a>
    </template>
    <template x-if="!isLoggedIn">
        <!-- Si l'utilisateur n'est pas connecté, afficher les liens Connexion et Inscription -->
        <a href="{{ url_for('connexion') }}" class="block px-4 py-3 text-gray-300 hover:bg-gray-600 hover:text-white text-center">Connexion</a>
        <a href="{{ url_for('inscription') }}" class="block px-4 py-3 text-gray-300 hover:bg-gray-600 hover:text-white text-center">Inscription</a>
    </template>
 </div>


        </div>
 </div>





 </div>


 </header>




    <!-- Section Accueil -->
    <section id="home" class="h-screen flex flex-col justify-center items-center text-center">
        <h1 class="text-6xl font-extrabold text-white mb-4">Explorez vos limites</h1>
        <p class="text-lg text-gray-300 mb-6">Découvrez des aventures uniques et des défis captivants.</p>
        <button onclick="document.getElementById('about').scrollIntoView({ behavior: 'smooth' })"
            class="text-gray-300 hover:text-white transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12l-7.5 7.5-7.5-7.5" />
            </svg>
        </button>
    </section>

     <!-- Section Univers -->
     <section id="about" class="bg-gray-800 py-16 relative">
        <!-- Titre centré -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-white">Les types de jeux</h2>
        </div>
    
        <!-- Grille des cartes -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 px-6">
            <!-- Carte Aventure -->
            <form action="/game1" method="GET" class="relative group">
                <button type="submit" class="w-full h-full focus:outline-none">
                    <img src="https://cdn.discordapp.com/attachments/1073409893668757626/1311980994831847504/Design_sans_titre_11.png?ex=674ad504&is=67498384&hm=aefb2ab3f21300a3e43c183e5d6568d4ea8855abadd5c7b914e9dc42a20c5d3b&" alt="Aventure" class="rounded-lg object-cover w-full h-80 transition-transform duration-300 group-hover:scale-105 group-hover:blur-sm">
                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg">
                        <span class="text-white text-xl font-bold">Aventure</span>
                    </div>
                </button>
            </form>
    
            <!-- Carte Stratégie -->
            <form action="/strategie" method="GET" class="relative group">
                <button type="submit" class="w-full h-full focus:outline-none">
                    <img src="https://cdn.discordapp.com/attachments/1073409893668757626/1311981404623470652/Design_sans_titre_12.png?ex=674ad566&is=674983e6&hm=243f77a9d238240b9b28e1a5ff7e40861825fd38d83e2fe73bba6ccabe6cfe32&" alt="Stratégie" class="rounded-lg object-cover w-full h-80 transition-transform duration-300 group-hover:scale-105 group-hover:blur-sm">
                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg">
                        <span class="text-white text-xl font-bold">Stratégie</span>
                    </div>
                </button>
            </form>
    
            <!-- Carte Action -->
            <form action="/action" method="GET" class="relative group">
                <button type="submit" class="w-full h-full focus:outline-none">
                    <img src="https://cdn.discordapp.com/attachments/1073409893668757626/1311980350683217960/Design_sans_titre_10.png?ex=674ad46b&is=674982eb&hm=90077437dec056dd239b2a9ed1274fd9826fa995c6a011abf0d44c2da7346ea2&" alt="Action" class="rounded-lg object-cover w-full h-80 transition-transform duration-300 group-hover:scale-105 group-hover:blur-sm">
                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg">
                        <span class="text-white text-xl font-bold">Action</span>
                    </div>
                </button>
            </form>
    
            <!-- Carte Puzzle -->
            <form action="/puzzle" method="GET" class="relative group">
                <button type="submit" class="w-full h-full focus:outline-none">
                    <img src="https://cdn.discordapp.com/attachments/1073409893668757626/1311983066918420562/Design_sans_titre_13.png?ex=674ad6f2&is=67498572&hm=e8035ab4bdf978363b09426f79b21fd5756e045be002559c4622e500ab8b4512&" alt="Puzzle" class="rounded-lg object-cover w-full h-80 transition-transform duration-300 group-hover:scale-105 group-hover:blur-sm">
                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg">
                        <span class="text-white text-xl font-bold">Puzzle</span>
                    </div>
                </button>
            </form>
    
            <!-- Carte Sport -->
            <form action="/sport" method="GET" class="relative group">
                <button type="submit" class="w-full h-full focus:outline-none">
                    <img src="https://cdn.discordapp.com/attachments/1073409893668757626/1311983445970518077/Design_sans_titre_14.png?ex=674ad74c&is=674985cc&hm=4d381b1bd6412e05273fd6f3aa1eb9dd44bd6282211a660b4f8482647cf705ad&" alt="Sport" class="rounded-lg object-cover w-full h-80 transition-transform duration-300 group-hover:scale-105 group-hover:blur-sm">
                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg">
                        <span class="text-white text-xl font-bold">Sport</span>
                    </div>
                </button>
            </form>
    
            <!-- Carte Arcade -->
            <form action="/arcade" method="GET" class="relative group">
                <button type="submit" class="w-full h-full focus:outline-none">
                    <img src="https://via.placeholder.com/300x400" alt="Arcade" class="rounded-lg object-cover w-full h-80 transition-transform duration-300 group-hover:scale-105 group-hover:blur-sm">
                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg">
                        <span class="text-white text-xl font-bold">Beta : Scrible Pvp</span>
                    </div>
                </button>
            </form>
        </div>
    
        <!-- Flèche pour remonter -->
        <button onclick="document.getElementById('home').scrollIntoView({ behavior: 'smooth' })"
            class="absolute top-4 right-4 bg-gray-600 p-3 rounded-full hover:bg-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12l-7.5-7.5-7.5 7.5" />
            </svg>
        </button>
    </section>
    
</body>

</html>
