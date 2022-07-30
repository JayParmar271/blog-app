<html>
    <head>
        <title>Blog App</title>

        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

        <script src="https://unpkg.com/vue@3"></script>
    </head>
    <body>
        <div id="app">
            {{ $slot }}
        </div>

        <script>
        Vue.createApp({
            data() {
                return {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    errors: null,
                }
            },

            methods: {
                register() {
                    axios.post('/api/register', {
                        name: this.name,
                        email: this.email,
                        password: this.password,
                        password_confirmation: this.password_confirmation
                      })
                      .then( (response) => {
                        this.name = ''
                        this.email = ''
                        this.password = ''
                        this.password_confirmation = ''

                        window.location.href = '/login'
                      })
                      .catch( (error) => {
                        window.scrollTo(0, 0);

                        this.errors = error.response.data.errors
                      });
                }
            }
        }).mount('#app')
        </script>
    </body>
</html>
