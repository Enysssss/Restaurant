<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            /* Image de fond personnalisable : change le lien ci-dessous */
            background-image: url('https://images.unsplash.com/photo-1481833761820-0509d3217039?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .overlay {
            /* Pour un léger effet sombre sur l'image de fond */
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 0;
        }

        .center-content {
            position: relative;
            z-index: 1;
        }

        .btn-lg {
            width: 200px; /* boutons larges et uniformes */
        }

        .gap-3 > a {
            margin-bottom: 20px; /* espace vertical entre boutons */
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100 position-relative">

    <div class="overlay"></div> <!-- effet sombre sur fond -->

    <div class="text-center center-content">
        <div class="gap-3 d-flex flex-column align-items-center">
            <a href="{{ route('form_user') }}" class="btn btn-primary btn-lg">
                Signup
            </a>

            <a href="{{ route('form_login') }}" class="btn btn-outline-light btn-lg">
                Sign in
            </a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
