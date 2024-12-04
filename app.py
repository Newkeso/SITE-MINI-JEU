from flask import Flask, render_template, request, jsonify, redirect, url_for, session
import mysql.connector



from werkzeug.utils import secure_filename
from werkzeug.datastructures import FileStorage
from werkzeug.security import generate_password_hash, check_password_hash
from flask_uploads import UploadSet, configure_uploads, IMAGES
from flask import g


import subprocess
import os
import subprocess
import os

# Initialisation de Flask
app = Flask(__name__, template_folder='.')
app.secret_key = 'secret-key'

# Configuration MySQL
db_config = {
    'host': 'localhost',
    'user': 'root',
    'password': '',  # Ton mot de passe MySQL
    'database': 'rhazgame'
}

# Configuration pour Flask-Uploads
app.config['UPLOADED_PHOTOS_DEST'] = 'static/uploads'
photos = UploadSet('photos', IMAGES)
configure_uploads(app, photos)

@app.route('/')
def main():
    is_logged_in = session.get('is_logged_in', False)
    utilisateur_id = session.get('id', None)

    # Vérification de l'utilisateur dans la base de données
    utilisateur_nom = 'Utilisateur'  # Valeur par défaut
    if utilisateur_id:
        conn = mysql.connector.connect(**db_config)
        cursor = conn.cursor()
        cursor.execute("SELECT nom FROM utilisateurs WHERE id = %s", (utilisateur_id,))
        utilisateur = cursor.fetchone()  # Récupère le nom de l'utilisateur depuis la base de données
        conn.close()

        if utilisateur:
            utilisateur_nom = utilisateur[0]  # utilisateur[0] est le nom dans la base de données

    return render_template('main.php', is_logged_in=is_logged_in, utilisateur_nom=utilisateur_nom)


@app.route('/game1')
def game1():
    return render_template('aventure.php')

@app.route('/action')
def action():
    return render_template('action.php')

@app.route('/puzzle')
def puzzle():
    return render_template('puzzle.php')

@app.route('/strategie')
def strategie():
    return render_template('Strategie.php')

@app.route('/sport')
def sport():
    return render_template('Sport.php')

@app.route('/arcade')
def arcade():
    return render_template('Arcade.php')

@app.route('/profil', methods=['GET', 'POST'])
def profil():
    if 'id' not in session:
        return redirect(url_for('connexion'))

    user_id = session['id']
    conn = mysql.connector.connect(**db_config)
    cursor = conn.cursor()
    cursor.execute("SELECT * FROM utilisateurs WHERE id = %s", (user_id,))
    utilisateur = cursor.fetchone()  # Récupère l'utilisateur depuis la base de données
    conn.close()

    if utilisateur:  # Assurer que l'utilisateur existe
        if request.method == 'POST':
            statut = request.form.get('statut')
            image_profil = request.files.get('image_profil')
            image_banniere = request.files.get('image_banniere')

            # Traitement des fichiers uploadés
            if image_profil:
                image_profil_filename = photos.save(image_profil)
                conn = mysql.connector.connect(**db_config)
                cursor = conn.cursor()
                cursor.execute("UPDATE utilisateurs SET image_profil = %s WHERE id = %s", (image_profil_filename, user_id))
                conn.commit()
                conn.close()

            if image_banniere:
                image_banniere_filename = photos.save(image_banniere)
                conn = mysql.connector.connect(**db_config)
                cursor = conn.cursor()
                cursor.execute("UPDATE utilisateurs SET image_banniere = %s WHERE id = %s", (image_banniere_filename, user_id))
                conn.commit()
                conn.close()

            if statut:
                conn = mysql.connector.connect(**db_config)
                cursor = conn.cursor()
                cursor.execute("UPDATE utilisateurs SET statut = %s WHERE id = %s", (statut, user_id))
                conn.commit()
                conn.close()

            return redirect(url_for('profil'))

        return render_template('profil.php', utilisateur=utilisateur)
    else:
        return "Utilisateur non trouvé", 404

@app.route('/get_comments/<int:jeu_id>', methods=['GET'])
def get_comments(jeu_id):
    try:
        conn = mysql.connector.connect(**db_config)
        cursor = conn.cursor(dictionary=True)
        cursor.execute("""
            SELECT c.id, c.texte, c.note, c.date_creation, 
                   (SELECT u.nom FROM utilisateurs u WHERE u.id = c.utilisateur_id) AS utilisateur
            FROM commentaires c
            WHERE c.jeu_id = %s
            ORDER BY c.date_creation DESC
        """, (jeu_id,))
        commentaires = cursor.fetchall()
        conn.close()
        return jsonify(commentaires)
    except mysql.connector.Error as err:
        return jsonify({"error": str(err)}), 500


@app.route('/add_comment', methods=['POST'])
def add_comment():
    if 'id' not in session:  # Vérifie si l'utilisateur est connecté
        return jsonify({"error": "Utilisateur non connecté"}), 401

    data = request.json
    jeu_id = data.get('jeu_id')
    texte = data.get('texte')
    note = data.get('note')
    utilisateur_id = session['id']

    if not texte or not note or not jeu_id:
        return jsonify({"error": "Tous les champs sont requis"}), 400

    try:
        conn = mysql.connector.connect(**db_config)
        cursor = conn.cursor()

        # Vérification si le jeu existe
        cursor.execute("SELECT COUNT(*) FROM jeux WHERE id = %s", (jeu_id,))
        if cursor.fetchone()[0] == 0:
            return jsonify({"error": "Jeu non trouvé"}), 404

        # Insertion du commentaire
        cursor.execute("""
            INSERT INTO commentaires (jeu_id, utilisateur_id, texte, note)
            VALUES (%s, %s, %s, %s)
        """, (jeu_id, utilisateur_id, texte, note))
        conn.commit()
        conn.close()
        return jsonify({"message": "Commentaire ajouté avec succès"}), 201
    except mysql.connector.Error as err:
        return jsonify({"error": str(err)}), 500




@app.route('/inscription', methods=['GET', 'POST'])
def inscription():
    if request.method == 'POST':
        nom = request.form['nom']
        email = request.form['email']
        mot_de_passe = request.form['mot_de_passe']

        # Hash du mot de passe
        mot_de_passe_hash = generate_password_hash(mot_de_passe)

        try:
            conn = mysql.connector.connect(**db_config)
            cursor = conn.cursor()
            cursor.execute("""
                INSERT INTO utilisateurs (nom, email, mot_de_passe)
                VALUES (%s, %s, %s)
            """, (nom, email, mot_de_passe_hash))
            conn.commit()
            user_id = cursor.lastrowid
            cursor.close()
            conn.close()

            # Connexion immédiate après inscription
            session['id'] = user_id  # Stocke 'id' dans la session
            return redirect(url_for('main'))
        except mysql.connector.Error as err:
            return f"Erreur : {err}"

    return render_template('inscription.php')


@app.route('/connexion', methods=['GET', 'POST'])
def connexion():
    if request.method == 'POST':
        email = request.form['email']
        mot_de_passe = request.form['mot_de_passe']
        conn = mysql.connector.connect(**db_config)
        cursor = conn.cursor()
        cursor.execute("SELECT * FROM utilisateurs WHERE email = %s", (email,))
        utilisateur = cursor.fetchone()

        if utilisateur and check_password_hash(utilisateur[3], mot_de_passe):  # utilisateur[3] est le mot de passe
            session['id'] = utilisateur[0]  # utilisateur[0] c'est l'ID
            session['is_logged_in'] = True  # Marque l'utilisateur comme connecté
            return redirect(url_for('main'))
        else:
            return "Identifiants incorrects", 401

    return render_template('connexion.php')


@app.route('/deconnexion')
def deconnexion():
    session.pop('id', None)  # Supprime 'id' de la session
    return redirect(url_for('main'))

@app.before_request
def before_request():
    g.is_logged_in = 'user_id' in session  # Vérifie si l'utilisateur est connecté

@app.route('/')
def index():
    return render_template('index.html', is_logged_in=g.is_logged_in)


# Route pour exécuter les jeux
@app.route('/play_game1', methods=['POST'])
def play_game1():
    try:
        result = subprocess.run(['python', 'Jeux/mini-dbz/play.py'], capture_output=True, text=True)
        print(result.stdout)
        message = "Le jeu a démarré avec succès !"
    except Exception as e:
        message = f"Erreur lors du démarrage du jeu: {str(e)}"
    return render_template('action.php', message=message)

@app.route('/play_game2', methods=['POST'])
def play_game2():
    try:
        result = subprocess.run(['python', 'Jeux\spaceShooter-master\spaceshooter\spaceShooter.py'], capture_output=True, text=True)
        print(result.stdout)
        message = "Le jeu a démarré avec succès !"
    except Exception as e:
        message = f"Erreur lors du démarrage du jeu: {str(e)}"
    return render_template('action.php', message=message)

@app.route('/play_game3', methods=['POST'])
def play_game3():
    try:
        result = subprocess.run(['python', 'Jeux\war007_Game\main.py'], capture_output=True, text=True)
        print(result.stdout)
        message = "Le jeu a démarré avec succès !"
    except Exception as e:
        message = f"Erreur lors du démarrage du jeu: {str(e)}"
    return render_template('action.php', message=message)


# Code identique pour les autres jeux

if __name__ == '__main__':
    app.run(debug=True)
