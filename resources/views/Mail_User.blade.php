<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bienvenue sur 🍽️ MonRestaurant</title>
    <style>
        /* Reset basique pour les emails */
        body, table, td, a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        body {
            margin: 0;
            padding: 0;
            width: 100% !important;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            padding: 30px;
        }
        h2 {
            color: #0d6efd;
        }
        p {
            line-height: 1.6;
            font-size: 16px;
        }
        .btn {
            display: inline-block;
            padding: 12px 25px;
            margin-top: 20px;
            font-size: 16px;
            color: #ffffff;
            background-color: #0d6efd;
            text-decoration: none;
            border-radius: 6px;
        }
        .btn:hover {
            background-color: #0b5ed7;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #6c757d;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Bonjour {{$user['name']}},</h2>
        <p>Nous sommes ravis de vous accueillir sur <strong>🍽️ MonRestaurant</strong> !</p>
        <p>Votre compte a bien été créé et vous pouvez dès maintenant commencer à découvrir et créer vos plats favoris.</p>

        <a href="{{ route('form_login') }}" class="btn">Accéder à votre compte</a>

        <p>Merci de nous avoir rejoint et bon appétit !</p>

        <div class="footer">
            &copy; {{ date('Y') }} MonRestaurant. Tous droits réservés.
        </div>
    </div>
</body>
</html>
