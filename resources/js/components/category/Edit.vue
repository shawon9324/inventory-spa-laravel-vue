<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Category</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active" aria-current="page">Edit Category Info</li>
            </ol>
          </div>
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm">
          <div class="card-header text-center h4 text-gray-900">
            <i class="fas fa-edit"></i>  Edit Category Info &nbsp;&nbsp;&nbsp;&nbsp;
            <router-link to="/category" class="btn btn-info" style="float:left"><i class="fas fa-arrow-alt-circle-left"></i></router-link>
            <button @click="refresh()" class="btn btn-info" style="float:right"><i class="fas fa-redo-alt"></i></button>
          </div>
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                    <form class="category" id="edit-category" @submit.prevent="updateCategory" enctype="multipart/form-data">
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
                              <button type="submit" id="submit" class="btn btn-info btn-block">Update</button>
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
                category_name:'',
                details:'',
            },
            errors:{ },
        }
    },
    created() {
      let id = this.$route.params.id
      axios.get('/api/category/'+id)
      .then(({data}) =>(this.form = data))
    },
    methods:{
        updateCategory(){
          let id = this.$route.params.id
          axios.patch('/api/category/'+id,this.form)
          .then(res => {
            Notification.success("Category updated successfully!")
            this.$router.push({name:'category'})
          })
          .catch(error => (this.errors = error.response.data.errors))
        },
        refresh(){
            document.getElementById("edit-category").reset();
        }
    },

  };
</script>

<style scoped>
.zoom {
  transition: 0.2s all ease-in-out; 
  width: 60px;
  height: 60px;
}
.zoom:hover { 
  transform: scale(4);
}
</style>
