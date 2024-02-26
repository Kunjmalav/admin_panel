<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center justify-content-center mt-5">

  <div class="w-25 mx-auto">
    <div class="card p-4">
      @if(session('success'))
      <div class="container mt-3 text-success">
        {{ session('success') }}
      </div>
      @endif

      @if(session('Username'))
      <div class="container mt-3 text-success">
        {{ session('Username') }}
      </div>
      @endif
      @if(session('error'))
      <div class="container mt-3 text-danger">
        {{ session('error') }}
      </div>
      @endif
      <h2 class="text-center mb-4">Login</h2>

      <form method="post" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
          @error('username')
          <div class="text-danger">{{ $message }}</div>
          @enderror
          <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="{{ old('username', $username) }}" required>
        </div>
        <div class="mb-3">
          @error('password')
          <div class="text-danger">{{ $message }}</div>
          @enderror

          <input type="password" id="password" name="password" class="form-control" placeholder="Password" value="{{ old('username', $password) }}" required>
        </div>
        <div class="d-grid gap-2 d-flex justify-content-center">
          <button type="submit" class="btn btn-primary px-5">Login</button>
          <a href="{{ route('signup.form') }}" class="btn btn-warning px-3">Signup</a>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>