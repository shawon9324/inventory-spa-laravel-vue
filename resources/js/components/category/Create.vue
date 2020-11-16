<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Category</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active" aria-current="page">Add Category</li>
            </ol>
          </div>
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm">
          <div class="card-header text-center h4 text-gray-900">
            <i class="fas fa-plus-circle"></i> Add Category
            <router-link to="/category" class="btn btn-info" style="float:right"><i class="far fa-eye"></i></router-link>
          </div>
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                    <form class="category" @submit.prevent="storeCategory" enctype="multipart/form-data">
                              <div class="form-row">
                                <div class="form-group col-md-12">
                                  <input type="text" class="form-control" id="category_name"  placeholder="Category Name" v-model="form.category_name">
                                  <small class="text-danger" v-if="errors.category_name">{{ errors.category_name[0] }}</small>
                                </div> 
                              </div>
                              <div class="form-row">
                                <div class="form-group col-md-12">
                                      <textarea class="form-control" id="details"  placeholder="Category Details" v-model="form.details" rows="4"></textarea>
                                  <small class="text-danger" v-if="errors.details">{{ errors.details[0] }}</small>
                                </div> 
                              </div>
                            <div class="form-group">
                              <button type="submit" id="submit" class="btn btn-info btn-block">Submit</button>
                            </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
</template>

<script type="text/javascript">
  export default {
    created() {
      if (!User.loggedIn()) {
        this.$router.push({
          name: "/"
        });
      }
    },
    data(){
        return{
            form:{
                category_name:null,
                details:null,
            },
            errors:{ },

        }
    },
    methods:{
        storeCategory(){
          axios.post('/api/category',this.form)
          .then(res => {
            Notification.success("Category added successfully!")
            this.$router.push({name:'category'})
          })
          .catch(error => (this.errors = error.response.data.errors))
        }
    },

  };
</script>

<style scoped>

</style>
