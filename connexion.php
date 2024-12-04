<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full bg-gray-800 p-8 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold text-center mb-6">Connexion</h1>
        <form method="POST" action="/connexion">
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-300">Adresse email</label>
                <input type="email" id="email" name="email" class="w-full mt-1 p-2 bg-gray-700 text-white rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Votre adresse email" required>
            </div>
            <div class="mb-4">
                <label for="mot_de_passe" class="block text-sm font-medium text-gray-300">Mot de passe</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" class="w-full mt-1 p-2 bg-gray-700 text-white rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Votre mot de passe" required>
            </div>
            <div class="flex justify-between items-center mb-4">
                <label class="flex items-center">
                    <input type="checkbox" class="form-checkbox text-blue-500 bg-gray-700 border-gray-600 focus:ring-2 focus:ring-blue-500">
                    <span class="ml-2 text-sm text-gray-300">Se souvenir de moi</span>
                </label>
                <a href="#" class="text-sm text-blue-400 hover:underline">Mot de passe oublié ?</a>
            </div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Se connecter</button>
        </form>
        <p class="mt-6 text-center text-gray-400 text-sm">
            Vous n'avez pas de compte ?
            <a href="/inscription" class="text-blue-400 hover:underline">Inscrivez-vous ici</a>.
        </p>
    </div>
</body>
</html>


