<x-layout>
  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">All Posts</p>
  <center>
    <h5><a href="posts/create">Create new post</a></h5>
  </center>

  <div id="posts">
    @{{ posts }}
  </div>
</x-layout>

<script>
  Vue.createApp({
      data() {
          return {
              posts: null,
              userId: '',
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
            this.getPosts()
          })
          .catch((error) => {
            this.errors = error.response.data.errors
          });
        },

        getPosts: function() {
          axios.get('/api/posts', config)
            .then((response) => {
              this.posts = response.data.posts,
              this.userId = response.data.userId
            })
            .catch((error) => {
              this.errors = error.response.data.errors
            });
        }
      },

      beforeMount() {
        this.getPosts()
      },

      template: `
        <ul>
          <li v-for="post in posts">
            <p>
              <h2><a :href="'/posts/' + post.id" >@{{ post.title }}</a></h2>
              <a :href="'/posts/' + post.id + '/edit'" v-if="post.user_id == userId">
                <button class="btn btn-info btn-lg text-light">Edit</button>
              </a>
            </p>
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
          </li>
        </ul>
        <br>
      `
  }).mount('#posts')
</script>
