<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail du Plat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .like-btn {
            cursor: pointer;
            width: 28px;
            height: 28px;
            fill: gray;
            transition: fill 0.3s ease;
        }
        .like-btn.liked {
            fill: red;
        }
        .dish-image {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            border-radius: 8px;
        }
        .btn-custom {
            min-width: 120px;
        }
    </style>
</head>
<body class="bg-light">
@include('layouts.navbar')

<div class="container py-5">
    <div class="row g-4 align-items-start">
        {{-- Image à gauche --}}
        <div class="col-lg-6">
            <img src="{{ $dish->image }}" alt="{{ $dish->name }}" class="dish-image shadow-sm">
        </div>

        {{-- Détails à droite --}}
        <div class="col-lg-6 d-flex flex-column justify-content-between">
            <div>
                <h1 class="mb-4">{{ $dish->name }}</h1>
            </div>

            <div class="mb-4">
                <p class="lead">{{ $dish->description ?? 'Pas de description disponible.' }}</p>
            </div>

            <div class="d-flex gap-3 mt-auto">
                {{-- Bouton Liker --}}
                <form action="{{ route('like', $dish->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary btn-custom d-flex align-items-center">
                        <svg class="like-btn me-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                        Liker
                    </button>
                </form>

                {{-- Bouton Supprimer --}}
                <button type="button" class="btn btn-danger btn-custom" 
                        data-bs-toggle="modal" 
                        data-bs-target="#deleteModal" 
                        data-dishid="{{ $dish->id }}">
                    Supprimer
                </button>
            </div>
        </div>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Like bouton visuel
    document.querySelectorAll('.like-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            btn.classList.toggle('liked');
        });
    });

    // Passer l'ID du plat dans la modal de suppression
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var dishId = button.getAttribute('data-dishid');
        var form = deleteModal.querySelector('#deleteForm');

        form.action = "{{ url('delete_dish') }}/" + dishId;
    });
</script>

</body>
</html>
