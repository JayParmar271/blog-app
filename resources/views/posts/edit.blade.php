<x-layout>

<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-12 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Update post</p>

                <div v-if="errors" class="bg-danger rounded p-3 mb-5">
                  <div v-for="(v, k) in errors" :key="k">
                    <p v-for="error in v" :key="error" class="text-sm">
                      @{{ error }}
                    </p>
                  </div>
                </div>

                <form class="mx-1 mx-md-4" @submit.prevent="update">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <label class="form-label" for="form3Example3c">Title</label>
                      <input name="title" type="text" id="form3Example3c" class="form-control"  v-model="title" />
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <img :src="this.currentImage"/>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <label class="form-label" for="form3Example4c">Image</label>
                      <input name="image" type="file" id="form3Example3c" class="form-control" v-on:change="onImageChange" />
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <label class="form-label" for="form3Example4c">Description</label>
                      <textarea class="form-control" v-model="description"></textarea>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <label class="form-label" for="form3Example4c">Category</label>
                      <select name="category" class="form-control" v-model="category">
                        <option
                          :value="category.id"
                          v-for="category in categories"
                          :selected="category == category.id"
                        >
                          @{{ category.name }}
                        </option>
                      </select>
                    </div>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" class="btn btn-primary btn-lg">Save</button>
                  </div>

                </form>

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
          errors: null,
          title: '',
          description: '',
          category: '',
          categories: null,
          image: '',
          currentImage: '',
        }
      },

      mounted() {
        axios.get('/api/categories', config)
          .then((response) => {
            this.categories = response.data.categories
          });

        axios.get('/api/posts/' + getIDfromURL() + '/edit', config)
          .then((response) => {
            this.title = response.data.post.title,
            this.category = response.data.post.category_id,
            this.description = response.data.post.description,
            this.currentImage = response.data.post.image
          })
          .catch( (error) => {
            this.errors = error.response.data.errors
          });
      },

      methods: {
          onImageChange(e){
            this.image = e.target.files[0];
          },

          update() {
            const config = {
              headers: {
                'content-type': 'multipart/form-data',
                'Authorization': `Bearer ${accessToken}`
              }
            }

            axios.post('/api/posts/' + getIDfromURL(), {
                title: this.title,
                description: this.description,
                category: this.category,
                image: this.image,
                _method: 'patch'
               }, config)
              .then( (response) => {
                this.title = ''
                this.description = ''

                location.href = location.origin + '/posts'

                alert('post updated successfully')
              })
              .catch( (error) => {
                window.scrollTo(0, 0);

                this.errors = error.response.data.errors
              });
          }
      }
  }).mount('#app')
</script>
