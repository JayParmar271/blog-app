<x-layout>

  <div class="card text-black" style="border-radius: 25px;">
    <div class="card-body p-md-5">
      <div class="row justify-content-center">
        <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

          <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

          <div v-if="errors" class="bg-danger rounded p-3 mb-5">
            <div v-for="(v, k) in errors" :key="k">
              <p v-for="error in v" :key="error" class="text-sm">
                @{{ error }}
              </p>
            </div>
          </div>

          <form class="mx-1 mx-md-4" @submit.prevent="register">

            <div class="d-flex flex-row align-items-center mb-4">
              <i class="fas fa-user fa-lg me-3 fa-fw"></i>
              <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="name">Your Name</label>
                <input v-model="name" type="text" id="name" class="form-control" />
              </div>
            </div>

            <div class="d-flex flex-row align-items-center mb-4">
              <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
              <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="email">Your Email</label>
                <input v-model="email" name="email" type="email" id="email" class="form-control" />
              </div>
            </div>

            <div class="d-flex flex-row align-items-center mb-4">
              <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
              <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="password">Password</label>
                <input v-model="password" name="password" type="password" id="password" class="form-control" />
              </div>
            </div>

            <div class="d-flex flex-row align-items-center mb-4">
              <i class="fas fa-key fa-lg me-3 fa-fw"></i>
              <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="password_confirmation">Repeat your password</label>
                <input v-model="password_confirmation" name="password_confirmation" type="password" id="password_confirmation" class="form-control" />
              </div>
            </div>

            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
              <button type="submit" class="btn btn-primary btn-lg">Register</button>
            </div>

            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
              Already have an account?
                <a href='login/' class="text-black">Login</a>
            </div>

          </form>

        </div>
        <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
            class="img-fluid" alt="Sample image">

        </div>
      </div>
    </div>
  </div>

</x-layout>


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

      mounted() {
        accessToken = localStorage.getItem('accessToken')
        if (accessToken) {
          window.location.href = 'posts'
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
