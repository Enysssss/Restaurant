<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Create a Dish</title>
  <!-- Bootstrap CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
@include('layouts.navbar')
<body>

  <div class="container mt-5">
    <h2>Create a New Dish</h2>
    
    <form method="post" action="{{ route('create_dish') }}" enctype="multipart/form-data">
      @csrf <!-- Protection CSRF -->

      <div class="mb-3">
        <label for="dishName" class="form-label">Dish Name</label>
        <input
          name="name"
          type="text"
          class="form-control"
          id="dishName"
          placeholder="Enter dish name"
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
          placeholder="Describe your dish"
          required
          maxlength="2048"
        ></textarea>
      </div>

      <div class="mb-3">
        <label for="dishImage" class="form-label">Dish Image</label>
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

      <button type="submit" class="btn btn-primary">Create Dish</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
