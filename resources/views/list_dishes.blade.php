<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Liste des Plats</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        .like-btn {
            cursor: pointer;
            width: 24px;
            height: 24px;
            fill: none;
            stroke: red;
            stroke-width: 2;
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
    <h1 class="text-center mb-5">🍽️ Liste des Plats</h1>

    <div class="row g-4">
        @foreach ($plats as $plat)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <a href="{{ route('detailDish', $plat->id) }}">
                        <img 
                            src="{{ \Illuminate\Support\Str::startsWith($plat->image, ['http://', 'https://']) 
                                    ? $plat->image 
                                    : asset('storage/' . $plat->image) }}" 
                            class="card-img-top img-fluid"
                            alt="Image du plat" 
                            style="height: 250px; object-fit: cover;"
                        >
                    </a>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $plat->name }}</h5>
                        <p class="card-text">{{ $plat->description }}</p>

                        <div class="mt-auto d-flex justify-content-between align-items-center">

                            <!-- Bouton Supprimer simple avec confirm -->
                            @can('Edit Dish')
                            <form action="{{ route('deleteDish', $plat->id) }}" method="POST" 
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce plat ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                            @endcan

                            <!-- Bouton Liker -->
                            <form action="{{ $platsLiked[$plat->id] ? route('unlike', $plat->id) : route('like', $plat->id) }}" 
                                  method="POST" class="d-flex align-items-center gap-2">
                                @csrf
                                @if($platsLiked[$plat->id])
                                    @method('DELETE') 
                                @endif

                                <button type="submit" class="btn btn-sm d-flex align-items-center">
                                    <svg class="like-btn me-1 {{ $platsLiked[$plat->id] ? 'liked' : '' }}" 
                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 
                                                 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09 
                                                 C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5 
                                                 c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                    </svg>
                                    {{$nbLikes[$plat->id]}}
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $plats->links('pagination::bootstrap-5') }}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
