from flask import Flask, render_template
import subprocess
import os

app = Flask(__name__, template_folder='.')  # Indiquer que les templates sont dans le dossier actuel

# Route pour afficher la page du jeu


@app.route('/')
def main():
    return render_template('main.html')

@app.route('/game1')
def game1():
    return render_template('aventure.html')



# Route pour exécuter le jeu et afficher un message
@app.route('/play_game1', methods=['POST'])
def play_game1():
    try:
        # Lance le jeu ici (par exemple en exécutant un script Python)
        result = subprocess.run(['python', 'Jeux/mini-dbz/play.py'], capture_output=True, text=True)
        print(result.stdout)  # Affiche la sortie du jeu dans le terminal
        
        # Si le jeu se lance correctement, renvoyer un message positif
        message = "Le jeu a démarré avec succès !"
    except Exception as e:
        # Si une erreur se produit, afficher un message d'erreur
        message = f"Erreur lors du démarrage du jeu: {str(e)}"
    
    return render_template('dbz.html', message=message)

if __name__ == '__main__':
    app.run(debug=True)
