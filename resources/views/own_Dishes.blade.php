
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
<body class="bg-light">

<div class="container py-5">
    <h1 class="text-center mb-5">🍽️ Liste des Plats</h1>

    <div class="row g-4">
        @foreach ($plats as $plat)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <img 
                        src="{{ $plat->image }}" 
                        class="card-img-top img-fluid"
                        alt="Image du plat" 
                        style="height: 250px; object-fit: cover;"
                    >
                    <div class="card-body">
                        <h5 class="card-title d-flex justify-content-between align-items-center">
                            {{ $plat->name }}

                            <form action="{{ route("delete_dish", $plat->id) }}" method="POST" onsubmit="return confirm('Supprimer ce plat ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Supprimer</button>
                            </form>
                            
                            <form action="{{ route('edit', $plat->id) }}" method="POST" >
                                @csrf
                                @method('GET')

                                <button type="submit">MODIFIER</button>
                            </form>                         
                            
                        </h5>
                        <p class="card-text">{{ $plat->descriptionXX }}</p>
                    </div>
                </div>
                </div>
            @endforeach
            
             {{ $plats->links() }} <!-- link(a vue to custumise-->
           

            @if ($plats->isEmpty())
                <div class="empty-message">
                    PLUS A MANGER VA A MCDO C BON MMMMM
                </div>
            @endif

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
