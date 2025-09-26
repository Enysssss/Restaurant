<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Créer un Plat</title>
  <!-- Bootstrap CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
@include('layouts.navbar')
<body>

  <div class="container mt-5">
    <h2>Créer un Nouveau Plat</h2>
    
    <form method="post" action="{{ route('createDish') }}" enctype="multipart/form-data">
      @csrf <!-- Protection CSRF -->

      <div class="mb-3">
        <label for="dishName" class="form-label">Nom du plat</label>
        <input
          name="name"
          type="text"
          class="form-control"
          id="dishName"
          placeholder="Entrez le nom du plat"
          required
        />
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea
          name="description"
          class="form-control"
          id="description"
          rows="3"
          placeholder="Décrivez votre plat"
          required
          maxlength="2048"
        ></textarea>
      </div>

      <div class="mb-3">
        <label for="dishImage" class="form-label">Image du plat</label>
        <input
          name="image"
          class="form-control"
          type="file"
          id="dishImage"
        />
      </div>

      @if ($errors->has('error_create_dish'))
          <div class="alert alert-danger">
              {{ $errors->first('error_create_dish') }}
          </div>
      @endif

      <button type="submit" class="btn btn-primary">Créer le plat</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
