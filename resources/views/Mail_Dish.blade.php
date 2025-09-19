<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de Création de Plat</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            background: #ffffff;
            margin: 40px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 2px solid #eee;
        }

        .header h1 {
            color: #2c3e50;
            font-size: 26px;
        }

        .content {
            padding-top: 20px;
            color: #555;
            font-size: 16px;
            line-height: 1.6;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 13px;
            color: #888;
            text-align: center;
        }

        .highlight {
            color: #27ae60;
            font-weight: bold;
        }

        .gpt-tag {
            font-size: 12px;
            color: #aaa;
            margin-top: 15px;
        }

        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            background-color: #27ae60;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }

        .button:hover {
            background-color: #219150;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🍽️ Mail de Confirmation</h1>
        </div>

        <div class="content">
            <p>Bonjour,</p>
            <p>
                Nous sommes ravis de vous confirmer que votre plat a bien été <span class="highlight">créé avec succès</span> sur notre plateforme.
            </p>
            <p>
                Vous pouvez maintenant le consulter, le modifier ou l'ajouter à votre menu du jour.
            </p>

            <a href="#" class="button">Voir mon plat</a>

            <p class="gpt-tag">
                ✨ Cette page a été générée avec ❤️ par ChatGPT
            </p>
        </div>

        <div class="footer">
            © {{ date('Y') }} VotreApplication. Tous droits réservés.
        </div>
    </div>
</body>
</html>
