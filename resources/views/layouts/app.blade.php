<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'User Management') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/assets/css/styles.css') }}">

    <style>
        body {
            background: #f5f6fa;
        }

        .auth-card {
            max-width: 420px;
            margin: auto;
            margin-top: 8vh;
            padding: 2rem;
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }

        .auth-card h3 {
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .sidebar {
            min-height: 100vh;
            border-right: 1px solid #ddd;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">



            <!-- Main Content -->
            @if (auth()->check() && in_array(auth()->user()->role->name, ['admin', 'moderator']))
                <div class="container-fluid">
                    <div class="row">
                        @include('partials.sidebar')
                        <main class="col-md-9 ms-sm-auto col-lg-9 px-md-4 main-content">

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            @yield('content')
                        </main>
                    </div>
                </div>
            @else
                <main class="container my-5">
                    @yield('content')
                </main>
            @endif


        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
