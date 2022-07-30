<x-layout>

<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-12 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">All Posts</p>

                <div id="posts">
                  @{{ posts }}
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
              posts: null,
          }
      },

      mounted() {
          axios.get('/api/posts')
            .then( (response) => {
              this.posts = response.data.posts
            })
            .catch( (error) => {
              this.errors = error.response.data.errors
            });
      },

      template: `
        <ul>
          <li v-for="post in posts">
            <h2>@{{ post.title }}</h2>
            <img :src="post.image"/>
            <p>@{{ post.description }}</p>
          </li>
        </ul>
        <br>
      `
  }).mount('#posts')
</script>
