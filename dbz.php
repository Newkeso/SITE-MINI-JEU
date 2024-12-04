<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail Jeu Aventure</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white">

    <!-- Header -->
    <header class="bg-gray-800 py-4 px-6">
        <div class="flex justify-between items-center">
            <a href="index.html" class="text-xl font-bold text-gray-300 hover:text-white">← Retour à l'accueil</a>
            <h1 class="text-2xl font-bold text-white">Détail du Jeu</h1>
        </div>
    </header>

    <!-- Main content -->
    <section class="py-16">
        <div class="container mx-auto px-6">
            <!-- Fenêtre du jeu -->
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg mb-6">
                <h3 class="text-xl font-semibold mb-2">Nom du Jeu Aventure</h3>
                <p class="text-gray-400 mb-4">Une brève description du jeu et de son gameplay.</p>

                <!-- Formulaire pour lancer le jeu -->
                <form action="/play_game1" method="POST">
                    <button type="submit" class="bg-blue-500 px-6 py-2 rounded-lg text-white hover:bg-blue-600">Jouer au jeu</button>
                </form>

                <!-- Affichage du message -->
                {% if message %}
                    <div class="mt-4 text-lg text-white">
                        <p>{{ message }}</p>
                    </div>
                {% endif %}
            </div>
        </div>
    </section>

</body>

</html>
