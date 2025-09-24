<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Création d'utilisateur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #000; /* fond noir */
        }
        .card {
            background-color: #fff; /* carte blanche */
            color: #000; /* texte noir */
        }
        .card-header {
            background-color: #000; /* header noir */
            color: #fff; /* texte blanc */
        }
        .btn-custom {
            background-color: #000;
            color: #fff;
            border: 1px solid #fff;
        }
        .btn-custom:hover {
            background-color: #fff;
            color: #000;
        }
        a {
            color: #000;
        }
        a:hover {
            color: #555;
        }
        .form-control {
            background-color: #f8f9fa; /* input clair */
            color: #000;
            border: 1px solid #ccc;
        }
        .form-control:focus {
            background-color: #fff;
            color: #000;
            border-color: #000;
            box-shadow: none;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="col-md-6">

        <div class="card shadow-sm">
            <div class="card-header text-center">
                <h4>Créer un compte utilisateur</h4>
            </div>
            <div class="card-body">

                <form method="post" action="{{ route('createUser') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="username" class="form-label">Nom d'utilisateur</label>
                        <input type="text" class="form-control" id="username" name="username">
                        @error('username')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <button type="submit" class="btn btn-custom w-100">Créer le compte</button>

                    <div class="text-center mt-3">
                        <small class="text-muted">
                            Déjà un compte ? 
                            <a href="{{ route('formLogin') }}" class="fw-semibold">Se connecter</a>
                        </small>
                    </div>
                </form>

            </div>
        </div>

    </div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
