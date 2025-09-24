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

{{-- Contenu --}}
<div class="container py-5">

    {{-- Message flash après suppression --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

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

                        <!-- Bouton Supprimer avec modal -->
                        @can('Edit Dish')
                        <button type="button" class="btn btn-danger btn-sm" 
                                data-bs-toggle="modal" data-bs-target="#deleteModal" 
                                data-dishid="{{ $plat->id }}">
                            Supprimer
                        </button>
                        @endcan
                        </form>
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

{{-- Modal de suppression --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir supprimer ce plat ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <form id="deleteForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Passer l'ID du plat dans la modal de suppression
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var dishId = button.getAttribute('data-dishid');
        var form = deleteModal.querySelector('#deleteForm');

        form.action = "{{ url('deleteDish') }}/" + dishId;
    });
</script>

</body>
</html>
