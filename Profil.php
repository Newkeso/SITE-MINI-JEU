<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white">

    <!-- Profil Content -->
    <div class="max-w-4xl mx-auto mt-10">
        <h1 class="text-3xl font-semibold text-center mb-8">
            Profil de {{ utilisateur[1] if utilisateur else 'Utilisateur inconnu' }}
        </h1>

        <!-- Bannière -->
        <div class="mb-4">
            <!-- Affiche la bannière enregistrée ou une image par défaut si elle n'existe pas -->
            <img src="{{ url_for('static', filename='uploads/' + utilisateur[4]) if utilisateur and utilisateur[4] else 'https://via.placeholder.com/1500x300' }}" alt="Bannière" class="w-full h-48 object-cover rounded-lg">
        </div>

        <!-- Image de Profil -->
        <div class="flex justify-center mb-6">
            <!-- Affiche l'image de profil enregistrée ou une image par défaut si elle n'existe pas -->
            <img src="{{ url_for('static', filename='uploads/' + utilisateur[5]) if utilisateur and utilisateur[5] else 'https://via.placeholder.com/150' }}" alt="Image Profil" class="w-32 h-32 rounded-full object-cover border-4 border-gray-800">
        </div>

        <!-- Formulaire pour modifier le profil -->
        <form method="POST" enctype="multipart/form-data" class="space-y-6">
            <div>
                <label for="statut" class="block text-sm mb-2">Modifier votre statut</label>
                <input type="text" id="statut" name="statut" class="w-full p-3 rounded-lg bg-gray-800 border border-gray-700" value="{{ utilisateur[6] if utilisateur else '' }}">
            </div>

            <div>
                <label for="image_profil" class="block text-sm mb-2">Changer l'image de profil</label>
                <input type="file" id="image_profil" name="image_profil" class="w-full p-3 rounded-lg bg-gray-800 border border-gray-700" accept="image/*">
            </div>

            <div>
                <label for="image_banniere" class="block text-sm mb-2">Changer la bannière</label>
                <input type="file" id="image_banniere" name="image_banniere" class="w-full p-3 rounded-lg bg-gray-800 border border-gray-700" accept="image/*, .gif">
            </div>

            <button type="submit" class="w-full p-3 mt-4 rounded-lg bg-blue-600 hover:bg-blue-700">Mettre à jour le profil</button>
        </form>
    </div>

</body>
</html>
