
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Liste des Plats</title>

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
    <h1 class="text-center mb-5">🍽️ Liste des Plats que vous avez créés !</h1>

    <div class="row g-4">
        @forelse ($plats as $plat)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <img 
                        src="{{ $plat->image }}" 
                        class="card-img-top img-fluid"
                        alt="Image du plat" 
                        style="height: 250px; object-fit: cover;"
                    >
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $plat->name }}</h5>
                        <p class="card-text">{{ $plat->descriptionXX }}</p>

                        <div class="mt-auto d-flex justify-content-between">
                            <!-- Bouton Supprimer -->
                            <form action="{{ route('delete_dish', $plat->id) }}" method="POST" onsubmit="return confirm('Supprimer ce plat ?')" class="me-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm w-100">
                                    🗑️ Supprimer
                                </button>
                            </form>

                            <!-- Bouton Edit -->
                            <form action="{{ route('edit', $plat->id) }}" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm w-100">
                                    ✏️ Edit
                                </button>
                            </form>  
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                <h4>Aucun plat créé pour le moment.</h4>
                <p>Va créer ton premier plat ! 🍔🍟</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $plats->links('pagination::bootstrap-5') }}
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.querySelectorAll('.like-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            btn.classList.toggle('liked');
        });

        // Optionnel : activation au clavier (Enter ou Espace)
        btn.addEventListener('keydown', e => {
            if(e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                btn.classList.toggle('liked');
            }
        });
    });
</script>

</body>
</html>
