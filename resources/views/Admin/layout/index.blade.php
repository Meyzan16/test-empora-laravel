
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}">  --}}

    <title>Dashboard - Mazer Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/template-admin/demo/assets/css/bootstrap.css">

   

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    

    <link rel="stylesheet" href="/template-admin/demo/assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="/template-admin/demo/assets/vendors/fontawesome/all.min.css">

    <link rel="stylesheet" href="/template-admin/demo/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="/template-admin/demo/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="/template-admin/demo/assets/css/app.css">
    <link rel="shortcut icon" href="/template-admin/demo/assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="/template-admin/demo/assets/vendors/simple-datatables/style.css">

</head>

<body>
    <div id="app">

        @include('admin.partials.sidebar')
    
        @include('admin.partials.header')

        @yield('content')
        
            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="http://ahmadsaugi.com">A. Saugi</a></p>
                    </div>
                </div>
            </footer>

          
        </div>
    </div>
    @stack('addon-script')

    <script>
        window.setTimeout(function() {
            $(".autohide").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 5000);
    </script>
    
    <script src="/template-admin/demo/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/template-admin/demo/assets/js/bootstrap.bundle.min.js"></script>

    <script src="/template-admin/demo/assets/js/pages/dashboard.js"></script>
    <script src="/template-admin/demo/assets/vendors/fontawesome/all.min.js"></script>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>


    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="/template-admin/demo/assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="/template-admin/demo/assets/vendors/fontawesome/all.min.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    <script src="/template-admin/demo/assets/js/main.js"></script>

    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNUmHx3Et1_3SI2gQOe23vG0olB5cAmkk --}}
   
    @stack('prepend-script')
</body>

</html>