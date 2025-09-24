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
        a {
            color: #000;
        }
        a:hover {
            color: #555;
        }
        .alert-success {
            background-color: #0f0f0f; 
            color: #fff;
            border: 1px solid #fff;
        }
        .btn-close {
            filter: invert(1);
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="col-md-6">
        @if(session('succes'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('succes') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-header text-center">
                <h4>Connexion utilisateur</h4>
            </div>
            <div class="card-body">

                <form method="post" action="{{ route('loginUser') }}">
                    @csrf

                    <!-- Nom d'utilisateur -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Nom d'utilisateur</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                               id="username" name="username" value="{{ old('username') }}" required>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Mot de passe -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Bouton -->
                    <button type="submit" class="btn btn-custom w-100">Se connecter</button>
                    <div class="text-center mt-3">
                        <small class="text-muted">
                            Pas encore de compte ? 
                            <a href="{{ route('formUser') }}" class="fw-semibold">Créer un compte</a>
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
