<!DOCTYPE html>
<html lang="en">

<head>
<style>
    /* Default expanded width */
    #sidebar.sidebar-expanded {
        width: 220px;
    }

    /* Collapsed width */
    #sidebar.collapsed {
        width: 70px !important;
    }

    /* Hide text when collapsed */
    #sidebar.collapsed .menu-text {
        display: none !important;
    }

    /* Center icons */
    #sidebar.collapsed a {
        justify-content: center !important;
    }

    /* Topbar & main shift when collapsed */
    body.sidebar-collapsed nav {
        left: 60px !important;
    }

    body.sidebar-collapsed main {
        margin-left: 60px !important;
    }

    /* Logo switching */
    #sidebar.collapsed #logo-full {
        display: none !important;
    }

    #sidebar.collapsed #logo-small {
        display: block !important;
    }

    /* By default, small logo hidden */
    #logo-small {
        display: none;
    }
</style>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helios Scheduler</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    @stack('styles')
</head>

<body class="bg-light" style="overflow-x:hidden;">

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Topbar --}}
    @include('layouts.topbar')

    {{-- Main content --}}
    <main class="p-4" style="margin-left:220px; margin-top:60px;">
        @yield('content')
    </main>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

    @yield('scripts')

    <script>
document.addEventListener('DOMContentLoaded', function () {

    const toggleBtn = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');

    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', function () {
            sidebar.classList.toggle('collapsed');
            sidebar.classList.toggle('sidebar-expanded');
            document.body.classList.toggle('sidebar-collapsed');
        });
    }
});
</script>





</body>
</html>
