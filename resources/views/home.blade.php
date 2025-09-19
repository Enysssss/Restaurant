<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div class="text-center">
        <!--<h2 class="mb-4">🍽️ Restaurant trop bon</h2> -->

        <div class=" gap-3 col-12 col-md-6 mx-auto">

            <a href="{{ route('form_user') }}" class="btn btn-primary btn-lg">
                Signup
            </a>

            <a href="{{ route('form_login') }}" class="btn btn-outline-primary btn-lg">
                Sign in
            </a>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!-- By gpt -->
