<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>

<body>

    <section class="vh-100 ">
        <div class=" d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-4">
                                <h2 class="text-uppercase text-center mb-3">Create an account</h2>

                                @if(session('success'))
                                <div class="container alert alert-success">
                                    {{ session('success') }}
                                </div>
                                @endif

                                @if(session('error'))
                                <div class="container alert alert-danger">
                                    {{ session('error') }}
                                </div>
                                @endif

                                <form method="post" action="{{ route('signup') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name:</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ old('name') }}" required>
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="mobile" class="form-label">Mobile:</label>
                                        <input type="number"  name="mobile" id="mobile" class="form-control" placeholder="Mobile" value="{{ old('mobile') }}" required min="1000000000">
                                        @error('mobile')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="photo" class="form-label">Photo/Video:</label>
                                        <input type="file" name="photo_video" id="photo" class="form-control" accept="image/*,video/*" required>
                                        @error('photo')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password:</label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                        <div class="mt-2 text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Password must meet the following criteria:

                                         At least 8 characters long,
                                        Contains at least one uppercase letter,
                                       Contains at least one special character from @#$%&,
                                        Contains at least one numeric character,

                                        Example: P@ssw0rd123"> password requirements*</div>

                                        @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>



                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary px-5">Sign Up</button>
                                    </div>

                                    <p class="text-center text-muted my-3 mb-0">Have already an account? <a href="{{route('login')}}" class="fw-bold "><u>Login here</u></a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var tooltips = new bootstrap.Tooltip(document.body, {
                    selector: '[data-bs-toggle="tooltip"]'
                });
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>