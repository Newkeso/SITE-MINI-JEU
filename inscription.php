<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.js" defer></script>
    <style>
        /* Fond animé avec gris foncé et bleu */
        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        body {
            background: linear-gradient(45deg, #1F2937, #3B82F6, #2563EB, #1D4ED8);
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center text-white">

    <!-- Icône Home à gauche -->
    <div class="absolute top-4 left-4">
        <a href="/">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 text-white hover:text-gray-300">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9.75L12 4l9 5.75v8.5A2.75 2.75 0 0 1 18.25 21H5.75A2.75 2.75 0 0 1 3 18.25V9.75z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 21V12h6v9" />
            </svg>
        </a>
    </div>

    <!-- Container d'inscription -->
    <div class="bg-gray-900 p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6 text-white">Créer un compte</h2>
        
        <form method="POST" action="/inscription" class="space-y-6" x-data="{ showPassword: false }">
            <!-- Nom -->
            <div>
                <label for="nom" class="block text-sm font-medium mb-2 text-white">Nom</label>
                <input type="text" id="nom" name="nom" class="w-full p-3 rounded-lg border border-gray-700 bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Votre nom" required>
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium mb-2 text-white">Adresse Email</label>
                <input type="email" id="email" name="email" class="w-full p-3 rounded-lg border border-gray-700 bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="exemple@email.com" required>
            </div>

            <!-- Mot de passe -->
            <div>
                <label for="mot_de_passe" class="block text-sm font-medium mb-2 text-white">Mot de passe</label>
                <div class="relative">
                    <input :type="showPassword ? 'text' : 'password'" id="mot_de_passe" name="mot_de_passe" class="w-full p-3 rounded-lg border border-gray-700 bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="********" required>
                    <button type="button" class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-200" @click="showPassword = !showPassword">
                        <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825a10.05 10.05 0 001.22-.123M21 12c0-4.418-3.582-8-8-8-1.544 0-3.03.437-4.375 1.2M3.055 6.795a9.985 9.985 0 00-.895 4.205c0 4.418 3.582 8 8 8 1.93 0 3.71-.68 5.1-1.818M15.899 14.293a3.9 3.9 0 11-7.796-1.586M7.301 9.704A3.901 3.901 0 0112.599 7" />
                        </svg>
                        <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 6.795a9.985 9.985 0 01.895-4.205M21 12c0 4.418-3.582 8-8 8-1.544 0-3.03-.437-4.375-1.2M15.899 14.293a3.9 3.9 0 007.796 1.586M13.875 18.825A10.05 10.05 0 0112 19M9.201 4.53A3.9 3.9 0 007.3 9.704m-4.246 4.246A3.901 3.901 0 012.099 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Bouton d'inscription -->
            <form method="GET" action="/" class="space-y-6" x-data="{ showPassword: false }">
    

             <div>
                 <button type="submit" class="w-full p-3 rounded-lg bg-indigo-600 hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 font-semibold">
                    S'inscrire
                 </button>
             </div>
           </form>

            <!-- Lien vers connexion -->
            <p class="text-sm text-center text-gray-400">Déjà un compte ? 
                <a href="/connexion" class="text-indigo-500 hover:underline">Connectez-vous</a>.
            </p>
        </form>
    </div>

</body>
</html>
