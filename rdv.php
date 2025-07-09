<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $service = htmlspecialchars($_POST['service']);
    $date = htmlspecialchars($_POST['date']);
    $heure = htmlspecialchars($_POST['heure']);
    $message = htmlspecialchars($_POST['message']);

    // Validation des données
    $erreurs = [];
    if (empty($nom)) $erreurs[] = "Le nom est requis";
    if (empty($telephone)) $erreurs[] = "Le téléphone est requis";
    if (empty($date)) $erreurs[] = "La date est requise";
    if (empty($heure)) $erreurs[] = "L'heure est requise";

    if (empty($erreurs)) {
        // Envoi d'email
        $to = "contact@yadi.ci, secondemail@gmail.com";
        $sujet = "Nouveau RDV en ligne - $service";
        $contenu = "Nom: $nom\n";
        $contenu .= "Email: $email\n";
        $contenu .= "Téléphone: $telephone\n";
        $contenu .= "Service: $service\n";
        $contenu .= "Date: $date à $heure\n";
        $contenu .= "Message: $message\n";

        $headers = "From: $email";

        if (mail($to, $sujet, $contenu, $headers)) {
            $confirmation = "Votre rendez-vous a été confirmé. Nous vous contacterons pour validation.";
        } else {
            $erreurs[] = "Une erreur est survenue lors de l'envoi";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prendre rendez-vous - Yadi car center</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Open+Sans&display=swap">
    <style>
        :root {
            --orange: #FF6B00;
            --orange-fonce: #E67E22;
            --blanc: #FFFFFF;
            --noir: #333333;
            --gris: #F5F5F5;
            --gris-fonce: #666666;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            color: var(--noir);
            line-height: 1.6;
        }

        /* Header */
        header {
            background-color: var(--blanc);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            z-index: 1000;
            padding: 15px 0;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-img {
            height: 50px;
            width: auto;
        }

        .logo-icon {
            width: 30px;
            height: 30px;
            background-color: var(--orange);
            border-radius: 50%;
            margin-right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--blanc);
            font-weight: bold;
            cursor: pointer;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--orange);
            cursor: pointer;
        }

        nav ul {
            display: flex;
            list-style: none;
        }

        nav ul li {
            margin-left: 30px;
        }

        nav ul li a {
            text-decoration: none;
            color: var(--noir);
            font-weight: 500;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: var(--orange);
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-orange {
            background-color: var(--orange);
            color: var(--blanc);
        }

        .btn-orange:hover {
            background-color: var(--orange-fonce);
            transform: translateY(-2px);
        }

        /* Hero RDV */
        .hero-rdv {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1493238792000-8113da705763?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center/cover;
            color: var(--blanc);
            padding: 180px 0 100px;
            text-align: center;
        }

        .hero-rdv h1 {
            font-size: 2.5rem;
            margin-bottom: 30px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .rdv-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 10px;
            max-width: 800px;
            margin: 0 auto;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .form-rdv {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            color: var(--noir);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--noir);
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: 'Open Sans', sans-serif;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: var(--orange);
            outline: none;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .submit-btn {
            background-color: var(--orange);
            color: var(--blanc);
            border: none;
            padding: 15px 30px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s;
            font-size: 1rem;
            grid-column: 1 / -1;
        }

        .submit-btn:hover {
            background-color: var(--orange-fonce);
        }

        .horaires-dispo {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
            gap: 10px;
            margin-top: 10px;
        }

        .creneau {
            padding: 8px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .creneau:hover {
            background: var(--orange);
            color: white;
        }

        .creneau.selected {
            background: var(--orange);
            color: white;
        }

        .confirmation {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            grid-column: 1 / -1;
        }

        .erreur {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            grid-column: 1 / -1;
        }

        /* Footer */
        footer {
            background-color: var(--orange-fonce);
            color: var(--blanc);
            padding: 60px 0 30px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-column h4 {
            font-size: 1.3rem;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-column h4::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 2px;
            background-color: var(--blanc);
        }

        .footer-column ul {
            list-style: none;
        }

        .footer-column ul li {
            margin-bottom: 10px;
        }

        .footer-column ul li a {
            color: var(--blanc);
            text-decoration: none;
            transition: opacity 0.3s;
        }

        .footer-column ul li a:hover {
            opacity: 0.8;
        }

        .footer-column .contact-info p {
            margin: 6px 0;
        }

        .social-links {
            display: flex;
            gap: 15px;
        }

        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: var(--blanc);
            transition: background-color 0.3s;
            text-decoration: none;
            margin-top: 20px;
        }

        .social-links a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
            }

            nav ul {
                margin-top: 15px;
                flex-wrap: wrap;
                justify-content: center;
            }

            nav ul li {
                margin: 0 10px 5px;
            }

            .hero-rdv {
                padding: 150px 0 60px;
            }

            .hero-rdv h1 {
                font-size: 2rem;
            }

            .rdv-container {
                padding: 20px;
            }
        }
        
        /* scrollToTop */
        #scrollToTop {
            position: fixed;
            bottom: 40px;
            right: 30px;
            z-index: 999;
            font-size: 14px;
            background-color: #f57c00;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 50px;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            display: none;
            /* Caché par défaut */
            transition: all 0.3s ease;
        }

        #scrollToTop:hover {
            background-color: #e65100;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <a href="index.php">
                        <img src="image/logo/logo yadi car center-01.png" alt="YADI Logo" class="logo-img">
                        <!-- <div class="logo-text">YADI CAR CENTER</div> -->
                    </a>
                </div>
                <nav>
                    <ul>
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="index.php#services">Services</a></li>
                        <li><a href="index.php#galerie">Galerie</a></li>
                        <li><a href="index.php#contact">Contact</a></li>
                        <li><a href="rdv.php" class="btn btn-orange">RDV en ligne</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero RDV -->
    <section class="hero-rdv">
        <div class="container">
            <h1>Prenez rendez-vous en ligne</h1>
            <div class="rdv-container">
                <?php if (!empty($confirmation)): ?>
                    <div class="confirmation"><?= $confirmation ?></div>
                <?php endif; ?>

                <?php if (!empty($erreurs)): ?>
                    <div class="erreur">
                        <?php foreach ($erreurs as $erreur): ?>
                            <p><?= $erreur ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <form class="form-rdv" method="POST" action="">
                    <div class="form-group">
                        <label for="nom">Nom complet</label>
                        <input type="text" id="nom" name="nom" required value="<?= $_POST['nom'] ?? '' ?>">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required value="<?= $_POST['email'] ?? '' ?>">
                    </div>

                    <div class="form-group">
                        <label for="telephone">Téléphone</label>
                        <input type="tel" id="telephone" name="telephone" required value="<?= $_POST['telephone'] ?? '' ?>">
                    </div>

                    <div class="form-group">
                        <label for="service">Service demandé</label>
                        <select id="service" name="service" required>
                            <option value="">-- Sélectionnez --</option>
                            <option value="entretien" <?= ($_POST['service'] ?? '') == 'entretien' ? 'selected' : '' ?>>Entretien</option>
                            <option value="reparation" <?= ($_POST['service'] ?? '') == 'reparation' ? 'selected' : '' ?>>Réparation</option>
                            <option value="diagnostic" <?= ($_POST['service'] ?? '') == 'diagnostic' ? 'selected' : '' ?>>Diagnostic</option>
                            <option value="carrosserie" <?= ($_POST['service'] ?? '') == 'carrosserie' ? 'selected' : '' ?>>Carrosserie</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" id="date" name="date" min="<?= date('Y-m-d') ?>" required value="<?= $_POST['date'] ?? '' ?>">
                    </div>

                    <div class="form-group">
                        <label>Heure</label>
                        <div class="horaires-dispo" id="horaires">
                            <!-- Les créneaux seront générés par JavaScript -->
                        </div>
                        <input type="hidden" id="heure" name="heure" required value="<?= $_POST['heure'] ?? '' ?>">
                    </div>

                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label for="message">Informations complémentaires</label>
                        <textarea id="message" name="message" rows="4"><?= $_POST['message'] ?? '' ?></textarea>
                    </div>

                    <button type="submit" class="submit-btn">Confirmer le rendez-vous</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h4>GARAGE AUTO</h4>
                    <p>Expert en réparation automobile depuis 20 ans, nous mettons notre savoir-faire à votre service.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="footer-column">
                    <h4>LIENS RAPIDES</h4>
                    <ul>
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="index.php#services">Services</a></li>
                        <li><a href="index.php#galerie">Galerie</a></li>
                        <li><a href="index.php#contact">Contact</a></li>
                        <li><a href="#">Yadi-Group</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>HORAIRES</h4>
                    <ul>
                        <li>Lundi - Vendredi: 8h - 18h</li>
                        <li>Samedi: 9h - 13h</li>
                        <li>Dimanche: Fermé</li>
                        <li>Dépannage: 24h/24</li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>NOS FILIALES</h4>
                    <ul>
                        <li><a href="#">YADI CAR</a></li>
                        <li><a href="#">DDCS</a></li>
                        <li><a href="#">VROM</a></li>
                        <li><a href="#">AUTRES</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>CONTACT</h4>
                    <div class="contact-info">
                        <p>Abidjan, Cocody, Angré face au nouveau CHU</p>
                        <p>Tél: 06 633 32 32 / 22 00 78 30</p>
                        <p>Email: contact@yadi.ci</p>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2023 Garage Auto. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script>
        // Génération des créneaux horaires
        function genererCreneaux() {
            const horairesDiv = document.getElementById('horaires');
            const heures = [];

            // Matin
            for (let h = 8; h <= 11; h++) {
                heures.push(`${h}:00`);
                heures.push(`${h}:30`);
            }

            // Après-midi
            for (let h = 14; h <= 17; h++) {
                heures.push(`${h}:00`);
                heures.push(`${h}:30`);
            }

            // Générer les boutons
            horairesDiv.innerHTML = '';
            heures.forEach(heure => {
                const btn = document.createElement('div');
                btn.className = 'creneau';
                btn.textContent = heure;
                btn.addEventListener('click', function() {
                    // Désélectionner les autres
                    document.querySelectorAll('.creneau').forEach(c => {
                        c.classList.remove('selected');
                    });

                    // Sélectionner ce créneau
                    this.classList.add('selected');
                    document.getElementById('heure').value = heure;
                });

                // Pré-sélection si déjà choisi
                if (heure === "<?= $_POST['heure'] ?? '' ?>") {
                    btn.classList.add('selected');
                }

                horairesDiv.appendChild(btn);
            });
        }

        // Désactiver les weekends
        document.getElementById('date').addEventListener('change', function() {
            const date = new Date(this.value);
            if (date.getDay() === 0 || date.getDay() === 6) {
                alert('Nous sommes fermés le weekend. Veuillez choisir un jour en semaine.');
                this.value = '';
                document.getElementById('horaires').innerHTML = '';
            } else {
                genererCreneaux();
            }
        });

        // Initialisation
        document.addEventListener('DOMContentLoaded', function() {
            genererCreneaux();
        });
    </script>

    <!-- Bouton scroll -->
    <button id="scrollToTop" title="Remonter en haut">⬆</button>

    <script>
        const scrollBtn = document.getElementById("scrollToTop");

        window.addEventListener("scroll", function() {
            if (window.scrollY > 300) {
                scrollBtn.style.display = "block";
            } else {
                scrollBtn.style.display = "none";
            }
        });

        scrollBtn.addEventListener("click", function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
</body>

</html>