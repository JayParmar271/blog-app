<html>
    <head>
        <title>Blog App</title>

        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

        <style>
            img {
              max-width: 80%;
              height: 500px;
            }
        </style>

        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

        <script src="https://unpkg.com/vue@3"></script>
    </head>
    <body>
        <div id="app">{{ $slot }}</div>

        <script>
        axios.defaults.baseURL = window.location.origin;

        function getIDfromURL(){
            return window.location.pathname.split('/')[2];
        }

        accessToken = localStorage.getItem('accessToken');

        const config = {
            headers: { Authorization: `Bearer ${accessToken}` }
        };
        </script>
    </body>
</html>
