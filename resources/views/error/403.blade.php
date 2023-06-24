
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Mazer Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/template-admin/demo/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/template-admin/demo/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="/template-admin/demo/assets/css/app.css">
    <link rel="stylesheet" href="/template-admin/demo/assets/css/pages/error.css">
</head>

<body>
    <div id="error">


        <div class="error-page container">
            <div class="col-md-8 col-12 offset-md-2">
                <div class="text-center">
                    <h1 class="error-title">Forbidden</h1>
                    <p class="fs-5 text-gray-600">You are unauthorized to see this page.</p>
                    <a href="{{route('login')}}" class="btn btn-lg btn-outline-primary mt-3">Go Login</a>
                </div>
            </div>
        </div>


    </div>
</body>

</html>