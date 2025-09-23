<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
          crossorigin="anonymous" />
</head>
<body class="bg-light">
  @include('layouts.navbar') <!-- La navbar est incluse ici -->

<div class="container-fluid p-0">
  <div class="d-flex">
    <!-- Colonne gauche : boutons -->
    <div class="d-flex flex-column p-2" style="min-width: 200px;">
      @can('Create Dish')
        <a href="{{ route('form_dish') }}" class="btn btn-primary btn-lg mb-3">
          Créer un plat
        </a>
        <a href="{{ route('Users_list') }}" class="btn btn-primary btn-lg mb-3">
          Liste Utilisateurs
        </a>
      @endcan

      <a href="{{ route('list_dishes') }}" class="btn btn-outline-primary btn-lg mb-3">
        Liste des plats
      </a>

      <a href="{{ route('My_Likes') }}" class="btn btn-outline-primary btn-lg mb-3">
        Favoris
      </a>

      <a href="{{ route('liste_dishes_user') }}" class="btn btn-outline-primary btn-lg mb-3">
        Mes Plats
      </a>
    </div>

    <!-- Colonne droite : champs pour écrire des numéros -->
    <div class="flex-grow-1 p-3">
        <div class="row g-3">
          <!-- Première ligne : 2 stats -->
          <div class="col-md-6">
            <div class="p-4 bg-white shadow rounded text-center">
              <h5 class="fw-bold">Nombre TOTAL de Plats </h5>
              <div class="display-4">{{ $NB_Dishes }}</div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="p-4 bg-white shadow rounded text-center">
              <h5 class="fw-bold">Nombre d'Utilisateurs</h5>
              <div class="display-4">{{ $NB_client }}</div>
            </div>
          </div>

          <!-- Deuxième ligne : 2 autres stats -->
          <div class="col-md-6">
            <div class="p-4 bg-white shadow rounded text-center">
              <h5 class="fw-bold">Nombre de vos plats</h5>
              <div class="display-4">{{$NB_MY_DISHES}}</div>
            </div>
    </div>

    <div class="col-md-6">
      <div class="p-4 bg-white shadow rounded text-center">
        <h5 class="fw-bold">Nombre de like sur vos plats</h5>
        <div class="display-4">{{$NB_MY_LIKES}}</div>
      </div>
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