<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Mes plats aimés</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .like-btn {
            cursor: pointer;
            width: 24px;
            height: 24px;
            fill: gray;
            transition: fill 0.3s ease;
        }
        .like-btn.liked {
            fill: red;
        }
    </style>
</head>
@include('layouts.navbar')
<body class="bg-light">
<div class="container py-5">
    <h1 class="text-center mb-5">❤️ Mes plats aimés</h1>

    <div class="row g-4">
        @forelse ($dishes as $dish)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    @if($dish->image)
                        <img 
                            src="{{ $dish->image }}" 
                            class="card-img-top img-fluid"
                            alt="Image du plat" 
                            style="height: 250px; object-fit: cover;"
                        >
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $dish->name }}</h5>
                        <p class="card-text">{{ $dish->description ?? 'Pas de description disponible.' }}</p>

                        <!-- Bouton "Ne plus aimer" -->
                        <form action="{{ route('unlike', $dish->id) }}" method="POST" onsubmit="return confirm('Retirer ce plat de vos likes ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100 mt-3">💔 Ne plus aimer</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-muted">
                <h4>Aucun plat aimé pour le moment.</h4>
                <p>Tu peux liker des plats depuis la liste principale ! 🍔🍟</p>
            </div>
        @endforelse
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
