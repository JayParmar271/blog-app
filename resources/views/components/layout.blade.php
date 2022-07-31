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
        <section class="vh-100" style="background-color: #eee;">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                  <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                      <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-12 order-2 order-lg-1">
                                <div id="general">
                                    <div class="col-md-12 bg-light text-end">
                                      <a class="btn btn-primary" @click="logout" role="button" v-if="this.accessToken">Logout</a>
                                    </div>
                                </div>

                                <div id="app">
                                    {{ $slot }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script>
            axios.defaults.baseURL = window.location.origin;

            function getIDfromURL() {
                return window.location.pathname.split('/')[2];
            }

            accessToken = localStorage.getItem('accessToken');

            const config = {
                headers: { Authorization: `Bearer ${accessToken}` }
            };

            Vue.createApp({
                data() {
                    return {
                        accessToken: localStorage.getItem('accessToken'),
                    }
                },

                methods: {
                    logout: function() {
                        localStorage.removeItem('accessToken')
                        location.href = location.origin + '/login'
                    },
                }
            }).mount('#general')
        </script>
    </body>
</html>
