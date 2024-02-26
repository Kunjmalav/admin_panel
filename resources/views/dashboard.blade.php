<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <section class="vh-100" style="background-color: #eee;">

        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">

                <div class="col-md-12 col-xl-4">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body text-center">
                            <div class="mt-3 mb-4">

                                @if ($userprofile->userMedia)
                                @if (strpos($userprofile->userMedia->mime_type, 'image') !== false)
                              
                                <img src="{{ $userprofile->userMedia->getUrl() }}" class="rounded-circle img-fluid" style="height: 200px; width: 50%;" />
                                @elseif (strpos($userprofile->userMedia->mime_type, 'video') !== false)

                                <video controls class="rounded-circle img-fluid" style="height: 200px; width: 50%;">
                                    <source src="{{ $userprofile->userMedia->getUrl() }}" type="{{ $userprofile->userMedia->mime_type }}">
                                    Your browser does not support the video tag.

                                </video>
                                @else

                                <img src="{{ asset('path/to/default-image.jpg') }}" class="rounded-circle img-fluid" style="height: 200px; width: 50%;" />
                                @endif
                                @else

                                <p>No media available</p>
                                @endif
                            </div>

                            <h4 class="mb-2">{{ $user->name }}</h4>

                            <div>
                                <div class="card-body p-4">
                                    <h6>Information</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>Username</h6>
                                            <p class="text-muted">{{ $user->username }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Phone</h6>
                                            <p class="text-muted"> {{ $user->mobile }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form method="post" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-warning px-5">Logout</button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
            <form method="post" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-warning px-5">Logout</button>
                            </form>
    </section>
    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>