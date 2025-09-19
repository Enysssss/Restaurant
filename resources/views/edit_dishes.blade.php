<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit a Dish</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <div class="container mt-5">
    <h2>Edit Your Dish</h2>

    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <form action="{{ route('edit', ['id' => $dish->id]) }}" method="post" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
        <label for="dishName" class="form-label">Dish Name</label>
        <input
          name="name"
          type="text"
          class="form-control"
          id="dishName"
          value="{{ old('name', $dish->name) }}"
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
        >{{ old('description', $dish->description) }}</textarea>
      </div>

      <button type="submit" class="btn btn-primary">Update Dish</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
