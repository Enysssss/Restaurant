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

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
  <div class="container">
    <a class="navbar-brand" href="#">
      {{ Auth::user()->name }}
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="#">Accueil</a>
        </li>
      </ul>
      <form class="d-flex me-3" role="search">
        <input class="form-control me-2" type="search" placeholder="Rechercher" aria-label="Search" />
        <button class="btn btn-outline-success" type="submit">Recherche</button>
      </form>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-danger">Se déconnecter</button>
      </form>
    </div>
  </div>
</nav>

<div class="container">
  <div class="d-flex gap-3 justify-content-center">
    <ul>
    <a href="{{ route('form_dish') }}" class="btn btn-primary btn-lg">
      Créer un plat
    </a>
    <a href="{{ route('list_dishes') }}" class="btn btn-outline-primary btn-lg">
      Liste des plats
    </a>
    <a href="{{ route('My_Likes') }}" class="btn btn-outline-primary btn-lg">
      Favories
    </a>
    <a href="{{ route('liste_dishes_user') }}" class="btn btn-outline-primary btn-lg">
      Mes Plats
    </a>
  </ul>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>
</html>
<!-- By gpt -->