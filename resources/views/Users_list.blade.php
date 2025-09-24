<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Cards utilisateurs */
        .user-card {
            transition: all 0.3s ease;
            color: black;
        }
        .user-card:hover {
            background-color: black;
            color: white;
        }

        /* Boutons */
        .btn-theme {
            transition: all 0.3s ease;
        }
        .btn-theme:hover {
            background-color: black !important;
            color: white !important;
        }

        /* Navbar theme */
        .navbar-brand, .nav-link {
            color: black !important;
        }
        .navbar-brand:hover, .nav-link:hover {
            color: #333 !important;
        }

        /* Fond général */
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>
@include('layouts.navbar')

<body>

<div class="container py-5">
    <h1 class="text-center mb-5">👥 Gestion des Utilisateurs</h1>

    <div class="row g-4">
        @foreach ($Users as $user)
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 h-100 user-card">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">{{ $user->name }}</h5>
                        <p class="card-text text-muted">ID : {{ $user->id }}</p>

                        <div class="mt-auto d-flex justify-content-between">
                            <form action="{{ route('deleteUser', $user->id) }}" method="POST" onsubmit="return confirm('Supprimer cet utilisateur ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" name="action" value="delete" class="btn btn-danger btn-sm btn-theme">
                                    🗑 Supprimer
                                </button>
                            </form>

                            <form action="{{ route('userBecomeAdmin', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                
                                @if ($user->hasRole('admin'))
                                    <button type="submit" name="action" value="remove_admin" class="btn btn-danger btn-sm btn-theme">
                                        ❌ Retirer droits admin
                                    </button>
                                @else
                                    <button type="submit" name="action" value="make_admin" class="btn btn-warning btn-sm btn-theme">
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
