<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>{{ $plat->name }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .dish-image {
            max-height: 500px;
            object-fit: cover;
            border-radius: 15px;
        }
        .action-btn {
            width: 100%; /* tous les boutons mêmes largeur */
            margin-bottom: 10px; /* espace entre les boutons */
        }
        .comment-card {
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .comment-section {
            margin-top: 50px;
        }
        .comment-card2 {
            background-color: #e0f7fa; /* couleur bleu clair */
        }

    </style>
</head>
@include('layouts.navbar')
<body class="bg-light">

<div class="container py-5">
    <div class="row align-items-center">
        <!-- Image du plat -->
        <div class="col-md-6 mb-4 mb-md-0">
            <img 
                src="{{ $plat->image }}" 
                alt="Image du plat {{ $plat->name }}" 
                class="img-fluid shadow dish-image"
            >
        </div>

        <!-- Infos du plat -->
        <div class="col-md-6">
            <h1 class="mb-3">{{ $plat->name }}</h1>
            <p class="lead text-muted">{{ $plat->description }}</p>

            <div class="mt-4 d-grid gap-2">
                <a href="{{ route('listDishes') }}" class="btn btn-secondary action-btn">
                    ⬅️ Retour à la liste
                </a>
                @if ($plat->user_id == Auth::id())
                    <a href="{{ route('edit', $plat->id) }}" class="btn btn-warning action-btn">
                    ✏️ Modifier
                </a>
                @endif
                
                @can('Edit Dish')
                    <form action="{{ route('deleteDish', $plat->id) }}" method="POST" 
                      class="d-inline" 
                      onsubmit="return confirm('Supprimer ce plat ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger action-btn">
                        🗑️ Supprimer
                    </button>
                </form>
                @endcan
                
                <a>{{$plat->likedBy()->count()}}</a>
            </div>
        </div>
    </div>

    <!-- Section Commentaires -->
    <div class="comment-section">
        <h3 class="mb-3">💬 Commentaires</h3>

        <div class="mb-4">
            @foreach ($comments as $comment)
                @php
                    $isCurrentUser = Auth::user() && $comment->user->id === Auth::user()->id;
                @endphp

                <div class="card mb-2 {{ $isCurrentUser ? 'comment-card2' : 'comment-card' }} p-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-0">{{ $comment->text }}</p>
                            <small class="text-muted">
                                Par {{ $comment->user->name }}{{ $isCurrentUser ? ' (moi)' : '' }}
                                • {{ $comment->created_at->format('d/m/Y H:i') }}
                            </small>
                        </div>

                        @if ($isCurrentUser)
                            <form action="{{ route('deleteComment', $comment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

        <!-- Formulaire de commentaire -->
        <form action="{{ route('putComment', $plat->id) }}" method="POST" class="d-flex gap-2">
            @csrf
            <input type="text" name="text" class="form-control" placeholder="Votre commentaire" required>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
