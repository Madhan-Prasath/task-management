<!DOCTYPE html>
<html>
<head>
    <title>Task Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    @yield('styles')
</head>
<body>

<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Coalition Technologies Task Management</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item {{ request()->is('projects*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('projects.index') }}">Projects</a>
                    </li>
                    <li class="nav-item {{ request()->is('tasks*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('tasks.index') }}">Tasks</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>


<script>
$(document).ready(function () {
    // Display Toastr notification if there's a session message
    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        toastr.options = {
            "closeButton": true,
            "progressBar": false,
            "timeOut": 5000,
            "positionClass": "toast-top-center"
        };
        switch (type) {
            case 'info':
                toastr.info("{!! Session::get('message') !!}");
                break;
            case 'success':
                toastr.success("{!! Session::get('message') !!}");
                break;
            case 'warning':
                toastr.warning("{!! Session::get('message') !!}");
                break;
            case 'error':
                toastr.error("{!! Session::get('message') !!}");
                break;
        }
    @endif
});
</script>
@yield('scripts')
</body>
</html>
