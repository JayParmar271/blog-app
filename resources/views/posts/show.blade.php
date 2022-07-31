<x-layout>
  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Post detail</p>
  <center>
    <h5><a href="/posts">Go to Dashboard</a></h5>
  </center>

  <div id="post"></div>
</x-layout>

<script>
  Vue.createApp({
      data() {
          return {
              post: '',
          }
      },

      methods: {
        onEnter: function() {
          var comment = event.target.value
          event.target.value = ''

          axios.post('/api/comments', {
            comment: comment,
            postId: event.target.getAttribute('data-postId')
          }, config)
          .then((response) => {
            this.getPost()
          })
          .catch((error) => {
            this.errors = error.response.data.errors
          });
        },

        getPost: function() {
          axios.get('/api/posts/' + getIDfromURL(), config)
            .then((response) => {
              this.post = response.data.post
            })
            .catch((error) => {
              this.errors = error.response.data.errors
            });
        }
      },

      beforeMount() {
        this.getPost()
      },

      template: `
        <p><h2>@{{ post.title }}</h2></p>
        <img :src="post.image"/>
        <p>@{{ post.description }}</p>

        <h3>Comments (@{{ post.comments.length }}) </h3>

        <div class="flex-row align-items-center mb-2">
          <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
          <div class="form-outline flex-fill mb-0">
            <input name="comment" type="text" placeholder="Write a comment..." class="form-control" :data-postId="post.id" v-on:keyup.enter="onEnter" />
          </div>
        </div>

        <div v-if="post.comments != ''">
          <p v-for="comment in post.comments">
            <b>@{{ comment.user.name }} : </b>
            @{{ comment.comment }}
          </p>
        </div>
      `
  }).mount('#post')
</script>
