<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page non trouvée</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
        }

        .container {
            text-align: center;
            padding: 30px 40px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
        }

        h1 {
            font-size: 6rem;
            color: #ff6b6b;
        }

        h2 {
            font-size: 2rem;
            margin: 20px 0;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            color: #555;
        }

        a.btn {
            display: inline-block;
            text-decoration: none;
            padding: 12px 30px;
            background: #6c63ff;
            color: white;
            border-radius: 50px;
            transition: all 0.3s ease;
            font-weight: bold;
        }

        a.btn:hover {
            background: #574fd6;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px);}
            to { opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>404</h1>
        <h2>Oups ! Page introuvable</h2>
        <p>La page que vous cherchez n'existe pas ou a été déplacée.</p>
        <a href="{{ route('home') }}" class="btn">Retour à l'accueil</a>
    </div>
</body>
</html>
