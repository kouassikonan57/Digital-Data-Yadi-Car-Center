<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yadi car center | Entretien et Réparation</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Open+Sans&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
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

        h1,
        h2,
        h3,
        h4 {
            font-family: 'Roboto', sans-serif;
            font-weight: 700;
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

        .btn-outline {
            border: 2px solid var(--blanc);
            color: var(--blanc);
            margin-left: 15px;
        }

        .btn-outline:hover {
            background-color: var(--blanc);
            color: var(--orange);
        }

        /* Hero Section */
        .hero {
            position: relative;
            height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            text-align: center;
            color: var(--blanc);
            padding-top: 80px;
        }

        .hero-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
            opacity: 1;
            /* Tu peux jouer sur ça si tu veux plus ou moins visible */
            pointer-events: none;
        }

        /* Image de fond par-dessus la vidéo */
        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 110%;
            height: 110%;
            background: url('https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center;
            background-size: cover;
            transform: scale(1);
            animation: zoomEffect 20s ease-in-out infinite alternate;
            z-index: 1;
            filter: brightness(0.5);
            opacity: 0.7;
            /* 👉 diminue cette valeur pour plus de transparence */
        }

        .fireworks-canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 2;
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 3;
            max-width: 800px;
            margin: 0 auto;
        }

        @keyframes zoomEffect {
            0% {
                transform: scale(1) translateY(0);
            }

            100% {
                transform: scale(1.1) translateY(-10px);
            }
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        /* Services Section */
        .services {
            padding: 80px 0;
            background-color: var(--gris);
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-title h2 {
            font-size: 2.5rem;
            color: var(--noir);
        }

        .section-title p {
            color: var(--gris-fonce);
            max-width: 700px;
            margin: 0 auto;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .service-card {
            background-color: var(--blanc);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            text-align: center;
            padding: 30px 20px;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .service-icon {
            width: 60px;
            height: 60px;
            background-color: var(--orange);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: var(--blanc);
            font-size: 1.5rem;
        }

        .service-card h3 {
            margin-bottom: 15px;
            color: var(--noir);
        }

        .service-card p {
            color: var(--gris-fonce);
            margin-bottom: 20px;
        }

        .service-link {
            color: var(--orange);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
        }

        .service-link:hover {
            text-decoration: underline;
        }

        /* Emergency Banner */
        .emergency {
            background-color: var(--orange-fonce);
            color: var(--blanc);
            text-align: center;
            padding: 20px 0;
        }

        .emergency-content {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .emergency h3 {
            font-size: 1.5rem;
            margin-right: 20px;
        }

        .emergency .phone {
            font-size: 1.5rem;
            font-weight: 700;
        }

        /* Gallery Section */
        .gallery {
            padding: 80px 0;
        }

        .gallery-filters {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }

        .filter-btn {
            padding: 8px 20px;
            margin: 0 10px;
            background: none;
            border: 2px solid var(--orange);
            color: var(--orange);
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background-color: var(--orange);
            color: var(--blanc);
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .gallery-item {
            height: 250px;
            overflow: hidden;
            border-radius: 8px;
            position: relative;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .gallery-item .overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
            color: var(--blanc);
            padding: 20px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .gallery-item:hover .overlay {
            opacity: 1;
        }

        /* responsive */
        @media (max-width: 768px) {
            .gallery-filters {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                /* 2 colonnes de même taille */
                gap: 10px;
                /* espace entre les boutons */
                padding: 0 10px;
                margin-bottom: 30px;
            }

            .filter-btn {
                width: 100%;
                /* chaque bouton remplit sa colonne */
                padding: 12px 10px;
                /* un peu plus grand pour l’accessibilité */
                font-size: 0.95rem;
                text-align: center;
                white-space: nowrap;
                border-radius: 20px;
                border: 2px solid var(--orange);
                background: none;
                color: var(--orange);
                font-weight: 600;
                transition: all 0.3s;
            }

            .filter-btn:hover,
            .filter-btn.active {
                background-color: var(--orange);
                color: var(--blanc);
            }
        }

        /* Contact Form */
        .contact {
            background-color: var(--gris);
            padding: 80px 0;
        }

        .contact-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 50px;
        }

        .contact-container .contact-info {
            width: 90%;
        }

        .contact-info h3 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: var(--noir);
        }

        .contact-info p {
            margin-bottom: 30px;
            text-align: justify;
        }

        .contact-details {
            margin-bottom: 30px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .contact-icon {
            width: 40px;
            height: 40px;
            background-color: var(--orange);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--blanc);
            margin-right: 15px;
        }

        .contact-form {
            background-color: var(--blanc);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: 'Open Sans', sans-serif;
        }

        .form-control:focus {
            border-color: var(--orange);
            outline: none;
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .submit-btn {
            background-color: var(--orange);
            color: var(--blanc);
            border: none;
            padding: 12px 30px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s;
            display: flex;
            align-items: center;
        }

        .submit-btn:hover {
            background-color: var(--orange-fonce);
        }

        .submit-btn i {
            margin-left: 10px;
        }

        .radio-group {
            display: flex;
            gap: 20px;
            margin-top: 10px;
        }

        .radio-group label {
            display: flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
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

        .footer-column .contact-info p {
            margin: 6px 0;
        }

        .footer-column {
            text-align: justify;
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

        .footer-column .contact-info {
            margin-bottom: 20px;
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
            color: white;
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

        /* Messages de statut */
        .status-message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            text-align: center;
            display: none;
        }

        .status-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            display: block;
        }

        .status-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            display: block;
        }

        .contact-item .map-wrapper {
            width: 100%;
            border-radius: 6px;
            overflow: hidden;
            margin-top: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        /* Section Partenaires */
        .partenaires {
            padding: 60px 0;
            background-color: var(--blanc);
            overflow: hidden;
        }

        .partenaires-container {
            position: relative;
            width: 100%;
            overflow: hidden;
            margin-top: 30px;
        }

        .partenaires-track {
            display: flex;
            align-items: center;
            gap: 40px;
            width: max-content;
            animation: defilement 20s linear infinite;
        }

        .partenaire {
            flex-shrink: 0;
            padding: 15px;
            background: var(--gris);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100px;
            width: 200px;
            transition: transform 0.3s;
        }

        .partenaire img {
            max-width: 100%;
            max-height: 100%;
            filter: grayscale(100%);
            opacity: 0.7;
            transition: all 0.3s;
        }

        .partenaire:hover img {
            filter: grayscale(0);
            opacity: 1;
        }

        .partenaire:hover {
            transform: translateY(-5px);
        }

        .section-subtitle {
            text-align: center;
            margin-top: -50px;
        }

        .partenaires .section-title {
            font-size: 40px;
        }

        @keyframes defilement {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .partenaires {
                padding: 40px 0;
            }

            .partenaire {
                width: 150px;
                height: 80px;
            }

            .partenaires-track {
                gap: 20px;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
            }

            .logo {
                margin-bottom: 15px;
            }

            nav ul {
                flex-wrap: wrap;
                justify-content: center;
            }

            nav ul li {
                margin: 0 15px 10px;
            }

            .hero h1 {
                font-size: 2.2rem;
            }

            .hero-buttons {
                display: flex;
                flex-direction: column;
            }

            .btn-outline {
                margin-left: 0;
                margin-top: 15px;
            }

            .emergency-content {
                flex-direction: column;
            }

            .emergency h3 {
                margin-right: 0;
                margin-bottom: 10px;
            }
        }

        @media (max-width: 480px) {
            .hero h1 {
                font-size: 1.8rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .section-title h2 {
                font-size: 1.8rem;
            }

            .services-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Section Témoignages */
        .temoignages {
            padding: 80px 0;
            background-color: var(--gris);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .background-video {
            position: absolute;
            top: 0;
            left: 0;
            min-width: 100%;
            min-height: 100%;
            object-fit: cover;
            z-index: 0;
        }

        .temoignages .container {
            position: relative;
            z-index: 1;
            /* Pour que le contenu soit au-dessus de la vidéo */
            color: white;
            /* Optionnel, pour plus de lisibilité */
        }

        .temoignages .section-title {
            font-size: 40px;
        }

        .temoignages .section-subtitle {
            text-align: center;
        }

        .temoignages-carousel {
            position: relative;
            max-width: 800px;
            margin: 40px auto;
            overflow: hidden;
        }

        .temoignage {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        .temoignage.active {
            display: block;
        }

        .temoignage-content {
            background: var(--blanc);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin: 0 20px;
        }

        .rating {
            color: var(--orange);
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .temoignage .texte {
            font-size: 1.1rem;
            line-height: 1.6;
            font-style: italic;
            margin-bottom: 25px;
            color: var(--noir);
        }

        .client-info {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .client-photo {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--orange);
        }

        .client-info h4 {
            margin: 0;
            color: var(--noir);
            text-align: left;
        }

        .client-ville {
            margin: 5px 0 0;
            color: var(--gris-fonce);
            font-size: 0.9rem;
            text-align: left;
        }

        .carousel-controls {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin-top: 30px;
        }

        .prev-btn,
        .next-btn {
            background: var(--orange);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .prev-btn:hover,
        .next-btn:hover {
            background: var(--orange-fonce);
            transform: scale(1.1);
        }

        .dots {
            display: flex;
            gap: 10px;
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #ccc;
            cursor: pointer;
            transition: all 0.3s;
        }

        .dot.active {
            background: var(--orange);
            transform: scale(1.2);
        }

        @keyframes fadeIn {
            from {
                opacity: 0.4;
            }

            to {
                opacity: 1;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .temoignages {
                padding: 50px 0;
            }

            .temoignage-content {
                padding: 20px;
            }

            .client-info {
                flex-direction: column;
                text-align: center;
            }

            .client-info h4,
            .client-ville {
                text-align: center;
            }
        }

        /* Modal Services */
        .service-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            overflow-y: auto;
            animation: fadeIn 0.3s;
        }

        .modal-content {
            background-color: var(--blanc);
            margin: 50px auto;
            padding: 30px;
            width: 90%;
            max-width: 900px;
            border-radius: 8px;
            position: relative;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.3);
        }

        .close-modal {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 28px;
            color: var(--orange);
            cursor: pointer;
            transition: transform 0.3s;
        }

        .close-modal:hover {
            transform: rotate(90deg);
        }

        .modal-body {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .service-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            align-items: center;
        }

        .service-details img {
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
            opacity: 0;
            transform: translateX(-20px);
            transition: all 0.6s ease;
        }

        .service-details img.animated {
            opacity: 1;
            transform: translateX(0);
        }

        .service-text {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease 0.3s;
        }

        .service-text.animated {
            opacity: 1;
            transform: translateY(0);
        }

        .service-text h3 {
            color: var(--orange);
            font-size: 1.8rem;
            margin-bottom: 15px;
        }

        .service-text p {
            margin-bottom: 15px;
            line-height: 1.7;
        }

        .service-features {
            margin-top: 20px;
        }

        .service-features li {
            margin-bottom: 10px;
            position: relative;
            padding-left: 25px;
        }

        .service-features li:before {
            content: "✓";
            color: var(--orange);
            position: absolute;
            left: 0;
            font-weight: bold;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .service-details {
                grid-template-columns: 1fr;
            }

            .modal-content {
                padding: 20px;
                margin: 20px auto;
            }
        }

        /* Popup Bienvenue */
        .welcome-popup {
            display: none;
            position: absolute;
            top: 0;
            left: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            z-index: 9999;
            animation: fadeIn 0.5s;
        }

        .popup-container {
            position: relative;
            width: 90%;
            cursor: auto;
            max-width: 1000px;
            background: white;
            border-radius: 10px;
            margin: 2% auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            max-height: 95vh;
        }

        .popup-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .popup-images {
            position: relative;
            height: 100%;
            min-height: 400px;
        }

        .slide {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .slide.active {
            opacity: 1;
        }

        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
            color: white;
            padding: 20px;
            text-align: center;
        }

        .image-caption h3 {
            margin: 0 0 5px 0;
            font-size: 1.3rem;
            color: var(--orange);
        }

        .image-caption p {
            margin: 0;
            font-size: 0.9rem;
        }

        .popup-text {
            padding: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .popup-text h2 {
            color: var(--orange);
            margin-bottom: 20px;
            font-size: 1.8rem;
        }

        .popup-text p {
            margin-bottom: 20px;
            line-height: 1.4;
            text-align: justify;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin: 25px 0;
        }

        .feature-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 15px 10px;
            background: rgba(255, 107, 0, 0.1);
            border-radius: 5px;
            transition: transform 0.3s;
        }

        .feature-item:hover {
            transform: translateY(-5px);
        }

        .feature-item i {
            font-size: 1.8rem;
            color: var(--orange);
            margin-bottom: 8px;
        }

        .feature-item span {
            font-size: 0.9rem;
            font-weight: 600;
        }

        .btn-popup {
            background: var(--orange);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
            margin-top: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-popup:hover {
            background: var(--orange-fonce);
            transform: translateY(-3px);
        }

        .slider-controls {
            /* position: absolute; */
            bottom: 10px;
            left: 0;
            right: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            padding: 10px;
        }

        .prev-slide,
        .next-slide {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .prev-slide:hover,
        .next-slide:hover {
            background: var(--orange);
            transform: scale(1.1);
        }

        .slider-dots {
            display: flex;
            gap: 10px;
        }

        .slider-dots .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s;
        }

        .slider-dots .dot.active {
            background: var(--orange);
            transform: scale(1.2);
        }

        .close-popup {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 28px;
            color: white;
            cursor: pointer;
            z-index: 10;
            transition: transform 0.3s;
            background: rgba(0, 0, 0, 0.5);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
        }

        .close-popup:hover {
            transform: rotate(90deg);
            background: var(--orange);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .popup-container {
                max-height: 90vh;
                overflow-y: auto;
                /* Permet de scroller si le contenu dépasse */
            }

            .popup-text {
                padding: 20px;
                overflow-wrap: break-word;
                word-break: break-word;
            }

            .popup-content {
                display: block;
            }

            .popup-images {
                height: 200px;
            }

            .features {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .feature-item span {
                font-size: 0.85rem;
            }

            .btn-popup {
                font-size: 1rem;
                padding: 10px 20px;
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
                        <li><a href="#accueil">Accueil</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#galerie">Galerie</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <li><a href="rdv.php" class="btn btn-orange">RDV en ligne</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="accueil">
        <!-- 🎥 Vidéo de fond -->
        <video class="hero-video" autoplay muted loop playsinline>
            <source src="video/hero1.mp4" type="video/mp4">
        </video>
        <canvas class="fireworks-canvas"></canvas> <!-- 🔥 Feux d’artifice -->
        <div class="container">
            <div class="hero-content">
                <h1>VOTRE EXPERT AUTOMOBILE DEPUIS 20 ANS</h1>
                <p>Entretien, réparation, dépannage - Un service de qualité pour votre véhicule</p>
                <div class="hero-buttons">
                    <a href="rdv.php#rdv" class="btn btn-orange">Prendre RDV</a>
                    <a href="#services" class="btn btn-outline">Nos services</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Services -->
    <section class="services" id="services">
        <div class="container">
            <div class="section-title">
                <h2>NOS SERVICES</h2>
                <p>Nous proposons une gamme complète de services pour répondre à tous vos besoins automobiles</p>
            </div>
            <div class="services-grid">
                <!-- Service 1 -->
                <div class="service-card">
                    <div class="service-icon">🔧</div>
                    <h3>Mécanique générale</h3>
                    <p>Vidange, distribution, freinage, suspension et tous travaux de mécanique automobile.</p>
                    <a href="#" class="service-link" data-service="mecanique">En savoir plus</a>
                </div>

                <!-- Service 2 -->
                <div class="service-card">
                    <div class="service-icon">🚗</div>
                    <h3>Diagnostic électronique</h3>
                    <p>Identification des pannes moteur et électronique avec outils professionnels.</p>
                    <a href="#" class="service-link" data-service="diagnostic">En savoir plus</a>
                </div>

                <!-- Service 3 -->
                <div class="service-card">
                    <div class="service-icon">🛞</div>
                    <h3>Pneumatiques</h3>
                    <p>Montage, équilibrage, géométrie et vente de pneus toutes marques.</p>
                    <a href="#" class="service-link" data-service="pneus">En savoir plus</a>
                </div>

                <!-- Service 4 -->
                <div class="service-card">
                    <div class="service-icon">🎨</div>
                    <h3>Carrosserie & Peinture</h3>
                    <p>Réparation de carrosserie, peinture et traitement des chocs mineurs.</p>
                    <a href="#" class="service-link" data-service="carrosserie">En savoir plus</a>
                </div>

                <!-- Service 5 -->
                <div class="service-card">
                    <div class="service-icon">⚙️</div>
                    <h3>Vente de pièces</h3>
                    <p>Pièces d'origine et équivalentes pour toutes marques de véhicules.</p>
                    <a href="#" class="service-link" data-service="pieces">En savoir plus</a>
                </div>

                <!-- Service 6 - Quick Service -->
                <div class="service-card">
                    <div class="service-icon">⚡</div>
                    <h3>Quick Service</h3>
                    <p>Service de vidange et autre disponible jour et nuit.</p>
                    <a href="#" class="service-link" data-service="quick">En savoir plus</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Services -->
    <div id="service-modal" class="service-modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <div class="modal-body">
                <!-- Contenu chargé dynamiquement -->
            </div>
        </div>
    </div>

    <!-- Emergency Banner -->
    <section class="emergency">
        <div class="container">
            <div class="emergency-content">
                <h3>URGENCE ROUTIÈRE ? APPELEZ-NOUS :</h3>
                <div class="phone">(225) 06 633 32 32 / 22 00 78 30</div>
            </div>
        </div>
    </section>

    <!-- Section Partenaires -->
    <section class="partenaires" id="partenaires">
        <div class="container">
            <h2 class="section-title">NOS PARTENAIRES</h2>
            <p class="section-subtitle">Ils nous font confiance</p>

            <div class="partenaires-container">
                <div class="partenaires-track">
                    <!-- Partenaire 1 -->
                    <div class="partenaire">
                        <img src="image/partenaires/Cote-dIvoire.jpg" alt="Logo Partenaire 1">
                    </div>

                    <!-- Partenaire 2 -->
                    <div class="partenaire">
                        <img src="image/partenaires/UCPS-BM.png" alt="Logo Partenaire 2">
                    </div>

                    <!-- Partenaire 3 -->
                    <div class="partenaire">
                        <img src="image/partenaires/unnamed.jpg" alt="Logo Partenaire 3">
                    </div>

                    <!-- Partenaire 4 -->
                    <div class="partenaire">
                        <img src="image/partenaires/bnetd.jpg" alt="Logo Partenaire 4">
                    </div>

                    <!-- Partenaire 5 -->
                    <div class="partenaire">
                        <img src="image/partenaires/logo ansut.jpg" alt="Logo Partenaire 5">
                    </div>

                    <!-- Partenaire 6 -->
                    <div class="partenaire">
                        <img src="image/partenaires/63367333-45696710.jpg.png" alt="Logo Partenaire 6">
                    </div>

                    <!-- Dupliquez pour l'effet de boucle -->
                    <div class="partenaire">
                        <img src="image/partenaires/0.jpg" alt="Logo Partenaire 1">
                    </div>

                    <div class="partenaire">
                        <img src="image/logo/logo_Ydia.png" alt="Logo Partenaire 2">
                    </div>

                    <div class="partenaire">
                        <img src="image/logo/YADI Group_Logotype_DDCS_- Vf.jpg" alt="Logo Partenaire 3">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="gallery" id="galerie">
        <div class="container">
            <div class="section-title">
                <h2>NOS RÉALISATIONS</h2>
                <p>Découvrez quelques-uns de nos travaux récents</p>
            </div>
            <div class="gallery-filters">
                <button class="filter-btn active" data-filter="all">Tout</button>
                <button class="filter-btn" data-filter="carrosserie">Carrosserie</button>
                <button class="filter-btn" data-filter="mecanique">Mécanique</button>
                <button class="filter-btn" data-filter="pneus">Pneus</button>
                <button class="filter-btn" data-filter="diagnostic">Diagnostic</button>
                <button class="filter-btn" data-filter="climatisation">Climatisation</button>
            </div>
            <div class="gallery-grid">
                <div class="gallery-item" data-category="carrosserie">
                    <img src="https://images.unsplash.com/photo-1550355291-bbee04a92027?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Réparation carrosserie">
                    <div class="overlay">
                        <h3>Réparation carrosserie</h3>
                        <p>Peinture et restauration complète</p>
                    </div>
                </div>
                <div class="gallery-item" data-category="mecanique">
                    <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Révision mécanique">
                    <div class="overlay">
                        <h3>Révision complète</h3>
                        <p>Vidange et contrôle technique</p>
                    </div>
                </div>
                <div class="gallery-item" data-category="pneus">
                    <img src="image/Img3.jpg" alt="Changement de pneus">
                    <div class="overlay">
                        <h3>Changement de pneus</h3>
                        <p>Montage et équilibrage</p>
                    </div>
                </div>
                <div class="gallery-item" data-category="carrosserie">
                    <img src="image/Peinture5.jpg" alt="Peinture automobile">
                    <div class="overlay">
                        <h3>Peinture automobile</h3>
                        <p>Rénovation complète</p>
                    </div>
                </div>
                <div class="gallery-item" data-category="diagnostic">
                    <img src="image/Diagnostic.jpg" alt="Diagnostic électronique">
                    <div class="overlay">
                        <h3>Diagnostic électronique</h3>
                        <p>Lecture des codes d’erreur et reprogrammation</p>
                    </div>
                </div>
                <div class="gallery-item" data-category="climatisation">
                    <img src="image/Service.jpg" alt="Service climatisation">
                    <div class="overlay">
                        <h3>Climatisation</h3>
                        <p>Recharge, nettoyage et réparation</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Témoignages -->
    <section class="temoignages" id="temoignages">
        <video class="background-video" autoplay muted loop playsinline>
            <source src="video/temoignages-bg.mp4" type="video/mp4">
            Votre navigateur ne prend pas en charge les vidéos HTML5.
        </video>
        <div class="container">
            <h2 class="section-title">TEMOIGNAGES</h2>
            <p class="section-subtitle">Ce que nos clients disent de nous</p>

            <div class="temoignages-carousel">
                <!-- Témoignage 1 -->
                <div class="temoignage active">
                    <div class="temoignage-content">
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="texte">"Excellent service ! Mon véhicule est comme neuf après la révision. Le personnel est professionnel et accueillant."</p>
                        <div class="client-info">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Client 1" class="client-photo">
                            <div>
                                <h4>Jean D.</h4>
                                <p class="client-ville">Abidjan</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Témoignage 2 -->
                <div class="temoignage">
                    <div class="temoignage-content">
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <p class="texte">"Rapide et efficace pour le changement de mes pneus. Prix très corrects comparés aux autres garages de la zone."</p>
                        <div class="client-info">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Client 2" class="client-photo">
                            <div>
                                <h4>Amina K.</h4>
                                <p class="client-ville">Cocody</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Témoignage 3 -->
                <div class="temoignage">
                    <div class="temoignage-content">
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="texte">"Mon dépannage a été pris en charge en moins de 30 minutes. Je recommande vivement ce garage sérieux !"</p>
                        <div class="client-info">
                            <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Client 3" class="client-photo">
                            <div>
                                <h4>Paul B.</h4>
                                <p class="client-ville">Angré</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contrôles du carrousel -->
            <div class="carousel-controls">
                <button class="prev-btn" aria-label="Témoignage précédent"><i class="fas fa-chevron-left"></i></button>
                <div class="dots">
                    <span class="dot active"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
                <button class="next-btn" aria-label="Témoignage suivant"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" id="contact">
        <div class="container">
            <?php
            // Traitement du formulaire
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Configuration
                $destinataire = "contact@yadi.ci, secondemail@gmail.com";
                $sujet = "Nouveau message depuis le site Yadi Car Center";

                // Récupération des données
                $nom = htmlspecialchars($_POST['name']);
                $email = htmlspecialchars($_POST['email']);
                $telephone = htmlspecialchars($_POST['phone']);
                $service = htmlspecialchars($_POST['service']);
                $message = htmlspecialchars($_POST['message']);
                $type_demande = htmlspecialchars($_POST['type_demande']);

                // Infos supplémentaires pour devis
                $marque_vehicule = isset($_POST['marque_vehicule']) ? htmlspecialchars($_POST['marque_vehicule']) : '';
                $modele_vehicule = isset($_POST['modele_vehicule']) ? htmlspecialchars($_POST['modele_vehicule']) : '';
                $annee_vehicule = isset($_POST['annee_vehicule']) ? htmlspecialchars($_POST['annee_vehicule']) : '';
                $probleme = isset($_POST['probleme']) ? htmlspecialchars($_POST['probleme']) : '';

                // Construction du message
                $contenu_email = "Type de demande: $type_demande\n";
                $contenu_email .= "Nom: $nom\n";
                $contenu_email .= "Email: $email\n";
                $contenu_email .= "Téléphone: $telephone\n";
                $contenu_email .= "Service concerné: $service\n\n";

                if ($type_demande == "devis") {
                    $contenu_email .= "Détails du véhicule:\n";
                    $contenu_email .= "Marque: $marque_vehicule\n";
                    $contenu_email .= "Modèle: $modele_vehicule\n";
                    $contenu_email .= "Année: $annee_vehicule\n";
                    $contenu_email .= "Problème rencontré:\n$probleme\n\n";
                }

                $contenu_email .= "Message:\n$message\n";

                // Entêtes email
                $headers = "From: $email\r\n";
                $headers .= "Reply-To: $email\r\n";
                $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

                // Envoi de l'email (simulé pour cet exemple)
                $envoi_reussi = true; // En production, utiliser mail($destinataire, $sujet, $contenu_email, $headers)

                if ($envoi_reussi) {
                    echo '<div class="status-message status-success">Votre message a bien été envoyé. Nous vous contacterons rapidement.</div>';
                } else {
                    echo '<div class="status-message status-error">Une erreur est survenue lors de l\'envoi de votre message. Veuillez réessayer.</div>';
                }
            }
            ?>

            <div class="contact-container">
                <div class="contact-info">
                    <h3>CONTACTEZ-NOUS</h3>
                    <p>Notre équipe est à votre disposition pour répondre à toutes vos questions et prendre rendez-vous.</p>
                    <div class="contact-details">
                        <div class="contact-item">
                            <div class="contact-icon">📍</div>
                            <div>Abidjan, Cocody, Angré face au nouveau CHU </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">📞</div>
                            <div>(+225) 06 633 32 32 / 22 00 78 30</div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">✉️</div>
                            <div>contact@yadi.ci</div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">⏱️</div>
                            <div>Lun-Ven: 8h-18h | Sam: 9h-13h</div>
                        </div>
                        <div class="contact-item">
                            <div class="map-wrapper">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3975.8313972902155!2d-3.9901235!3d5.3601011!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfc1ecf9b65c340d%3A0x1e2871ed9b47ecf4!2sCHU%20Angr%C3%A9!5e0!3m2!1sfr!2sci!4v1719943850000!5m2!1sfr!2sci"
                                    width="100%"
                                    height="400"
                                    style="border:0;"
                                    allowfullscreen=""
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact-form">
                    <form action="#contact" method="POST" id="contact-form">
                        <div class="form-group">
                            <label>Type de demande</label>
                            <div class="radio-group">
                                <label>
                                    <input type="radio" name="type_demande" value="contact" checked> Demande de contact
                                </label>
                                <label>
                                    <input type="radio" name="type_demande" value="devis"> Demande de devis
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">Nom complet</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Téléphone</label>
                            <input type="tel" id="phone" name="phone" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="service">Service demandé</label>
                            <select id="service" name="service" class="form-control" required>
                                <option value="">-- Sélectionnez --</option>
                                <option value="entretien">Entretien</option>
                                <option value="reparation">Réparation</option>
                                <option value="diagnostic">Diagnostic</option>
                                <option value="carrosserie">Carrosserie</option>
                                <option value="pneus">Pneus</option>
                                <option value="autre">Autre</option>
                            </select>
                        </div>

                        <!-- Champs spécifiques pour les devis -->
                        <div id="devis-fields" style="display: none;">
                            <div class="form-group">
                                <label for="marque_vehicule">Marque du véhicule</label>
                                <input type="text" id="marque_vehicule" name="marque_vehicule" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="modele_vehicule">Modèle du véhicule</label>
                                <input type="text" id="modele_vehicule" name="modele_vehicule" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="annee_vehicule">Année du véhicule</label>
                                <input type="text" id="annee_vehicule" name="annee_vehicule" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="probleme">Problème rencontré</label>
                                <textarea id="probleme" name="probleme" class="form-control" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" class="form-control" rows="5" required></textarea>
                        </div>

                        <button type="submit" class="submit-btn">Envoyer <i>→</i></button>
                    </form>
                </div>
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
                        <li><a href="#accueil">Accueil</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#galerie">Galerie</a></li>
                        <li><a href="#contact">Contact</a></li>
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
                    <h4>CONTACT</h4>
                    <div class="contact-info">
                        <p>Abidjan, Cocody, Angré face au nouveau CHU </p>
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
        // Gallery Filter
        document.addEventListener('DOMContentLoaded', function() {
            const filterBtns = document.querySelectorAll('.filter-btn');
            const galleryItems = document.querySelectorAll('.gallery-item');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Remove active class from all buttons
                    filterBtns.forEach(btn => btn.classList.remove('active'));
                    // Add active class to clicked button
                    this.classList.add('active');

                    const filter = this.getAttribute('data-filter');

                    galleryItems.forEach(item => {
                        if (filter === 'all' || item.getAttribute('data-category') === filter) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            });

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();

                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;

                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        const headerHeight = document.querySelector('header').offsetHeight;
                        const targetPosition = targetElement.offsetTop - headerHeight;

                        window.scrollTo({
                            top: targetPosition,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Header shadow on scroll
            window.addEventListener('scroll', function() {
                const header = document.querySelector('header');
                if (window.scrollY > 50) {
                    header.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.1)';
                } else {
                    header.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
                }
            });

            // Afficher/masquer les champs spécifiques aux devis
            document.querySelectorAll('input[name="type_demande"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    const devisFields = document.getElementById('devis-fields');
                    if (this.value === 'devis') {
                        devisFields.style.display = 'block';
                        // Rendre requis certains champs pour les devis
                        document.getElementById('marque_vehicule').required = true;
                        document.getElementById('modele_vehicule').required = true;
                    } else {
                        devisFields.style.display = 'none';
                        // Retirer le required pour les autres demandes
                        document.getElementById('marque_vehicule').required = false;
                        document.getElementById('modele_vehicule').required = false;
                    }
                });
            });

            // Validation du formulaire avant soumission
            document.getElementById('contact-form').addEventListener('submit', function(e) {
                // Ici vous pourriez ajouter des validations supplémentaires
                // Si tout est OK, le formulaire sera soumis
            });
        });
    </script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const track = document.querySelector('.partenaires-track');

            // Pause l'animation au survol
            track.addEventListener('mouseenter', function() {
                this.style.animationPlayState = 'paused';
            });

            // Reprend l'animation quand la souris quitte
            track.addEventListener('mouseleave', function() {
                this.style.animationPlayState = 'running';
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const temoignages = document.querySelectorAll('.temoignage');
            const dots = document.querySelectorAll('.dot');
            const prevBtn = document.querySelector('.prev-btn');
            const nextBtn = document.querySelector('.next-btn');
            let currentIndex = 0;
            let intervalId;

            // Afficher un témoignage spécifique
            function showTemoignage(index) {
                temoignages.forEach(t => t.classList.remove('active'));
                dots.forEach(d => d.classList.remove('active'));

                currentIndex = (index + temoignages.length) % temoignages.length;
                temoignages[currentIndex].classList.add('active');
                dots[currentIndex].classList.add('active');
            }

            // Témoignage suivant
            function nextTemoignage() {
                showTemoignage(currentIndex + 1);
            }

            // Témoignage précédent
            function prevTemoignage() {
                showTemoignage(currentIndex - 1);
            }

            // Défilement automatique
            function startAutoSlide() {
                intervalId = setInterval(nextTemoignage, 5000);
            }

            // Événements
            nextBtn.addEventListener('click', () => {
                nextTemoignage();
                resetAutoSlide();
            });

            prevBtn.addEventListener('click', () => {
                prevTemoignage();
                resetAutoSlide();
            });

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    showTemoignage(index);
                    resetAutoSlide();
                });
            });

            // Réinitialiser le défilement automatique après interaction
            function resetAutoSlide() {
                clearInterval(intervalId);
                startAutoSlide();
            }

            // Démarrer le carrousel
            startAutoSlide();

            // Pause au survol
            const carousel = document.querySelector('.temoignages-carousel');
            carousel.addEventListener('mouseenter', () => clearInterval(intervalId));
            carousel.addEventListener('mouseleave', startAutoSlide);
        });
    </script>

    <script>
        // Données des services
        const servicesData = {
            mecanique: {
                title: "Mécanique Générale",
                image: "https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80",
                description: "Notre atelier de mécanique générale prend en charge tous les travaux d'entretien et de réparation de votre véhicule. Nos mécaniciens certifiés utilisent des pièces de qualité pour garantir la longévité de votre automobile.",
                features: [
                    "Vidange complète avec filtres",
                    "Distribution (courroie/chaîne)",
                    "Système de freinage",
                    "Suspension et direction",
                    "Climatisation",
                    "Tous travaux mécaniques"
                ]
            },
            diagnostic: {
                title: "Diagnostic Électronique",
                image: "image/Service.jpg",
                description: "Grâce à nos outils de diagnostic dernier cri, nous identifions précisément les pannes électroniques de votre véhicule. Un gain de temps et d'argent pour une réparation ciblée et efficace.",
                features: [
                    "Diagnostic moteur complet",
                    "Lecture et effacement des défauts",
                    "Analyse des calculateurs",
                    "Vérification des systèmes ADAS",
                ]
            },
            pneus: {
                title: "Pneumatiques",
                image: "image/Pneumatique2.png",
                description: "Service complet pour vos pneumatiques : du simple changement au réglage de géométrie. Nous proposons les meilleures marques à des prix compétitifs avec un service rapide.",
                features: [
                    "Montage/démontage de pneus",
                    "Équilibrage précis",
                    "Géométrie 3D",
                    "Contrôle usure et pression",
                    "Vente de pneus neufs"
                ]
            },
            carrosserie: {
                title: "Carrosserie & Peinture",
                image: "image/Peinture2.jpg",
                description: "Notre atelier carrosserie redonne à votre véhicule son aspect d'origine après un accident ou des dommages mineurs. Peinture professionnelle avec garantie couleur.",
                features: [
                    "Réparation de carrosserie",
                    "Peinture aérosol ou pistolet",
                    "Traitement des chocs",
                    "Débosselage sans peinture",
                    "Protection anti-corrosion"
                ]
            },
            pieces: {
                title: "Vente de Pièces",
                image: "image/Pièce2.png",
                description: "Nous fournissons des pièces détachées de qualité pour toutes marques, avec un conseil personnalisé. Pièces d'origine ou équivalentes selon votre budget.",
                features: [
                    "Pièces moteur et transmission",
                    "Freinage et suspension",
                    "Échappement et climatisation",
                    "Électricité automobile",
                    "Livraison rapide disponible"
                ]
            },
            quick: {
                title: "Quick Service",
                image: "image/vidange.png",
                description: "Notre service express vous permet d'effectuer les interventions rapides comme les vidanges, changements de filtres ou contrôles techniques sans rendez-vous, même en dehors des heures d'ouverture classiques.",
                features: [
                    "Vidange express (30 min max)",
                    "Changement de filtres rapide",
                    "Contrôle des niveaux",
                    "Gonflage des pneus",
                    "Disponible sans RDV",
                    "Service de nuit sur demande"
                ]
            }
        };

        // Gestion du modal
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('service-modal');
            const modalBody = document.querySelector('.modal-body');
            const closeBtn = document.querySelector('.close-modal');
            const serviceLinks = document.querySelectorAll('.service-link');

            // Ouvrir le modal
            serviceLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const serviceId = this.getAttribute('data-service');
                    loadServiceData(serviceId);
                    modal.style.display = 'block';
                    document.body.style.overflow = 'hidden'; // Empêche le défilement
                });
            });

            // Fermer le modal
            closeBtn.addEventListener('click', function() {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            });

            // Fermer en cliquant à l'extérieur
            window.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            });

            // Charger les données du service
            function loadServiceData(serviceId) {
                const service = servicesData[serviceId];

                modalBody.innerHTML = `
            <div class="service-details">
                <img src="${service.image}" alt="${service.title}">
                <div class="service-text">
                    <h3>${service.title}</h3>
                    <p>${service.description}</p>
                    <ul class="service-features">
                        ${service.features.map(feature => `<li>${feature}</li>`).join('')}
                    </ul>
                </div>
            </div>
        `;

                // Animation progressive
                setTimeout(() => {
                    const img = modalBody.querySelector('img');
                    const text = modalBody.querySelector('.service-text');

                    img.classList.add('animated');
                    text.classList.add('animated');
                }, 100);
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const popup = document.getElementById('welcome-popup');
            const closeBtn = document.querySelector('.close-popup');
            const slides = document.querySelectorAll('.slide');
            const dotsContainer = document.querySelector('.slider-dots');
            let currentSlide = 0;
            let slideInterval;

            // Création des dots
            slides.forEach((_, index) => {
                const dot = document.createElement('span');
                dot.classList.add('dot');
                if (index === 0) dot.classList.add('active');
                dot.addEventListener('click', () => goToSlide(index));
                dotsContainer.appendChild(dot);
            });

            const dots = document.querySelectorAll('.dot');

            // Navigation slider
            document.querySelector('.prev-slide').addEventListener('click', prevSlide);
            document.querySelector('.next-slide').addEventListener('click', nextSlide);

            // Fonction de fermeture
            function closePopup() {
                popup.style.display = 'none';
                document.body.style.overflow = 'auto';
                clearInterval(slideInterval);
            }

            // Événements de fermeture
            closeBtn.addEventListener('click', closePopup);

            popup.addEventListener('click', function(e) {
                if (e.target === popup) {
                    closePopup();
                }
            });

            // Affichage initial
            setTimeout(() => {
                popup.style.display = 'block';
                document.body.style.overflow = 'hidden';
                slideInterval = setInterval(nextSlide, 4000);
            }, 1500);

            // Fonctions slider
            function goToSlide(index) {
                slides[currentSlide].classList.remove('active');
                dots[currentSlide].classList.remove('active');
                currentSlide = (index + slides.length) % slides.length;
                slides[currentSlide].classList.add('active');
                dots[currentSlide].classList.add('active');
            }

            function nextSlide() {
                goToSlide(currentSlide + 1);
            }

            function prevSlide() {
                goToSlide(currentSlide - 1);
            }

            // Fermeture avec la touche ESC
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && popup.style.display === 'block') {
                    closePopup();
                }
            });
        });
    </script>

    <!-- Popup "Qui sommes-nous" -->
    <div id="welcome-popup" class="welcome-popup">
        <div class="popup-container">
            <span class="close-popup">&times;</span>
            <div class="popup-content">
                <div class="popup-images">
                    <!-- Slide 1 -->
                    <div class="slide active">
                        <img src="image/Garage1.jpg" alt="Atelier moderne">
                        <div class="image-caption">
                            <h3>Atelier High-Tech</h3>
                            <p>Notre atelier équipé des dernières technologies pour des diagnostics précis</p>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="slide">
                        <img src="image/Img2.png" alt="Équipe professionnelle">
                        <div class="image-caption">
                            <h3>Experts Certifiés</h3>
                            <p>Une équipe formée aux dernières techniques de réparation automobile</p>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="slide">
                        <img src="image/Depannage.jpg" alt="Équipements de pointe">
                        <div class="image-caption">
                            <h3>Outils Spécialisés</h3>
                            <p>Matériel professionnel pour toutes marques de véhicules</p>
                        </div>
                    </div>
                </div>

                <div class="popup-text">
                    <h2>Bienvenue chez <span class="highlight">YADI CAR CENTER</span></h2>
                    <p>Garage automobile de dernière génération doté d'équipements de pointe, d'un personnel technique de grande expérience et de structures d'accueil très confortables (Café - Salles Climatisées - Wifi).</p>
                    <p>Nous garantissons des réparations de qualité, peu importe le modèle et la marque de votre véhicule. Notre savoir-faire évolue constamment avec les avancées technologiques de l'industrie automobile.</p>
                    <div class="features">
                        <div class="feature-item">
                            <i class="fas fa-tools"></i>
                            <span>Technologie de pointe</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-user-tie"></i>
                            <span>Experts certifiés</span>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-clock"></i>
                            <span>Délais respectés</span>
                        </div>
                    </div>

                    <button class="btn-popup" onclick="location.href='rdv.php'">
                        <i class="fas fa-arrow-right"></i> Découvrir notre histoire
                    </button>
                </div>
            </div>

            <!-- Contrôles du slider -->
            <div class="slider-controls">
                <button class="prev-slide"><i class="fas fa-chevron-left"></i></button>
                <div class="slider-dots"></div>
                <button class="next-slide"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </div>

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

    <script>
        const canvas = document.querySelector(".fireworks-canvas");
        const ctx = canvas.getContext("2d");

        let width = canvas.width = canvas.offsetWidth;
        let height = canvas.height = canvas.offsetHeight;

        window.addEventListener("resize", () => {
            width = canvas.width = canvas.offsetWidth;
            height = canvas.height = canvas.offsetHeight;
        });

        const particles = [];

        function random(min, max) {
            return Math.random() * (max - min) + min;
        }

        function createFirework() {
            const x = random(0, width);
            const y = random(0, height / 2);
            const color = `hsl(${Math.floor(random(0, 360))}, 100%, 70%)`;

            for (let i = 0; i < 30; i++) {
                particles.push({
                    x,
                    y,
                    radius: 2,
                    angle: random(0, Math.PI * 2),
                    speed: random(1, 4),
                    alpha: 1,
                    decay: random(0.01, 0.02),
                    color
                });
            }
        }

        function animateFireworks() {
            ctx.clearRect(0, 0, width, height);

            for (let i = particles.length - 1; i >= 0; i--) {
                const p = particles[i];
                p.x += Math.cos(p.angle) * p.speed;
                p.y += Math.sin(p.angle) * p.speed;
                p.alpha -= p.decay;

                if (p.alpha <= 0) {
                    particles.splice(i, 1);
                } else {
                    ctx.beginPath();
                    ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
                    ctx.fillStyle = `rgba(255,255,255,${p.alpha})`;
                    ctx.shadowColor = p.color;
                    ctx.shadowBlur = 10;
                    ctx.fill();
                }
            }

            requestAnimationFrame(animateFireworks);
        }

        setInterval(createFirework, 1000);
        animateFireworks();
    </script>
</body>

</html>