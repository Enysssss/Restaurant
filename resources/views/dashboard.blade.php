<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
          crossorigin="anonymous" />
          <style>
    .menu-card {
        color: black;
        transition: all 0.3s ease;
    }
    .menu-card:hover {
        background-color: black;
        color: white !important;
    }
</style>

</head>
<body class="bg-light">
  @include('layouts.navbar') <!-- La navbar est incluse ici -->

<div class="container-fluid p-0">
  <div class="d-flex">
    <!-- Colonne gauche : boutons -->
    <!-- Colonne gauche : boutons stylés comme des cards -->
<div class="d-flex flex-column p-3" style="min-width: 220px; gap: 15px;">
    @can('Create Dish')
        <a href="{{ route('formDish') }}" class="card text-center shadow-sm py-3 fw-bold text-decoration-none menu-card">
            <div class="card-body">
                Créer un plat
            </div>
        </a>
        <a href="{{ route('userList') }}" class="card text-center shadow-sm py-3 fw-bold text-decoration-none menu-card">
            <div class="card-body">
                Liste Utilisateurs
            </div>
        </a>
    @endcan

    <a href="{{ route('listDishes') }}" class="card text-center shadow-sm py-3 fw-bold text-decoration-none menu-card">
        <div class="card-body">
            Liste des plats
        </div>
    </a>

    <a href="{{ route('myLikes') }}" class="card text-center shadow-sm py-3 fw-bold text-decoration-none menu-card">
        <div class="card-body">
            Favoris
        </div>
    </a>

    <a href="{{ route('listUserDish') }}" class="card text-center shadow-sm py-3 fw-bold text-decoration-none menu-card">
        <div class="card-body">
            Mes Plats
        </div>
    </a>
</div>



    <!-- Colonne droite : champs pour écrire des numéros -->
    <div class="flex-grow-1 p-3">
        <div class="row g-3">
          <!-- Première ligne : 2 stats -->
          <div class="col-md-6">
            <div class="p-4 bg-white shadow rounded text-center">
              <h5 class="fw-bold">Nombre TOTAL de Plats </h5>
              <div class="display-4">{{ $NbDishes }}</div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="p-4 bg-white shadow rounded text-center">
              <h5 class="fw-bold">Nombre d'Utilisateurs</h5>
              <div class="display-4">{{ $NbClient }}</div>
            </div>
          </div>

          <!-- Deuxième ligne : 2 autres stats -->
          <div class="col-md-6">
            <div class="p-4 bg-white shadow rounded text-center">
              <h5 class="fw-bold">Nombre de vos plats</h5>
              <div class="display-4">{{$nbMyDishes}}</div>
            </div>
    </div>

    <div class="col-md-6">
      <div class="p-4 bg-white shadow rounded text-center">
        <h5 class="fw-bold">Nombre de plats que vous avez liker</h5>
        <div class="display-4">{{$nbDishesIlike}}</div>
      </div>
    </div>

     <div class="col-md-6">
      <div class="p-4 bg-white shadow rounded text-center">
        <h5 class="fw-bold">Nombre de like sur vos plats</h5>
        <div class="display-4">{{$nbLikeOnMyDishes}}</div>
      </div>
      </div>

      <div class="col-md-6">
        <div class="p-4 bg-white shadow rounded text-center">
          <h5 class="fw-bold">Le plat du moment</h5>
          <div class="display-4">X</div>
        </div>
      </div>
 
</div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>
</html>
<!-- By gpt -->