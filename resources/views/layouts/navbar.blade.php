<!-- resources/views/layouts/navbar.blade.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
  <div class="container-fluid px-0">
    <!-- Nom utilisateur collé au bord gauche -->
    <a class="navbar-brand ms-2" href="#">
      {{ Auth::user()->name }}
    </a>

    <!-- Lien Accueil juste à côté -->
    <ul class="navbar-nav d-flex flex-row">
      <li class="nav-item">
        <a class="nav-link active" href="{{route('home')}}">Accueil</a>
      </li>
    </ul>

    <!-- Le reste du menu aligné à droite -->
    <div class="ms-auto d-flex align-items-center">

      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-danger">Se déconnecter</button>
      </form>
    </div>
  </div>
</nav>
