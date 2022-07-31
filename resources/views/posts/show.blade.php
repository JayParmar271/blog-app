<x-layout>

<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-12 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Post detail</p>
                <center>
                  <h5><a href="/posts">Go to Dashboard</a></h5>
                </center>

                <div id="post">
                  <p>
                    <h2>@{{ post.title }}</h2>
                    <button class="btn btn-info btn-lg text-light" v-if="post.user_id == userId">
                      <a :href="'/posts/' + post.id + '/edit'" >Edit</a>
                    </button>
                  </p>
                  <img :src="post.image"/>
                  <p>@{{ post.description }}</p>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</x-layout>

<script>
  Vue.createApp({
      data() {
          return {
              post: '',
          }
      },

      mounted() {
        axios.get('/api/posts/' + getIDfromURL(), config)
          .then((response) => {
            this.post = response.data.post
          })
          .catch((error) => {
            this.errors = error.response.data.errors
          });
      },
  }).mount('#app')
</script>
