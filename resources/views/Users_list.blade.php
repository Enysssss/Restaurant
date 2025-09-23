<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
    <div class="container-fluid px-0">
        <!-- Nom utilisateur -->
        <a class="navbar-brand ms-2 fw-bold text-primary" href="#">
            {{ Auth::user()->name }}
        </a>

        <!-- Accueil -->
        <ul class="navbar-nav d-flex flex-row">
            <li class="nav-item">
                <a class="nav-link active fw-semibold" href="{{ route('dashboard') }}">🏠 Accueil</a>
            </li>
        </ul>

        <!-- Déconnexion -->
        <div class="ms-auto d-flex align-items-center">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-danger">Se déconnecter</button>
            </form>
        </div>
    </div>
</nav>

<div class="container py-5">
    <h1 class="text-center mb-5">👥 Gestion des Utilisateurs</h1>

    <div class="row g-4">
        @foreach ($Users as $user)
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-primary fw-bold">{{ $user->name }}</h5>
                        <p class="card-text text-muted">ID : {{ $user->id }}</p>

                        <div class="mt-auto d-flex justify-content-between">
                            <form action="{{ route('Del_User', $user->id) }}" method="POST" onsubmit="return confirm('Supprimer cet utilisateur ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" name="action" value="delete" class="btn btn-danger btn-sm">
                                    🗑 Supprimer
                                </button>
                            </form>

                            <form action="{{ route('User_Admin', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                
                                @if ($user->hasRole('admin'))
                                    <button type="submit" name="action" value="remove_admin" class="btn btn-danger btn-sm">
                                        ❌ Retirer droits admin
                                    </button>
                                @else
                                    <button type="submit" name="action" value="make_admin" class="btn btn-warning btn-sm">
                                        ⭐ Donner droits admin
                                    </button>
                                @endif

                                    
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
