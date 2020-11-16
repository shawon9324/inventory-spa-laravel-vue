<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Category</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active" aria-current="page">All Category</li>
            </ol>
          </div>
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm">
          <div class="card-header text-center h4 text-gray-900" >
            <input type="text" v-model="searchData" class="form-control-sm"  placeholder="Search here" style="float:left; color:gray;border:1px solid #a9a9a9 ;">
            <i class="fas fa-list"></i> All Category &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <router-link to="/store-category" class="btn btn-info" style="float:right"><i class="fas fa-plus-circle"></i></router-link>
          </div>
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                  <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>No</th>
                        <th>Category Name</th>
                        <th>Details</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="category in filterSearch" :key="category.id">
                        <td>{{ category.id }}</td>
                        <td>{{ category.category_name }}</td>
                        <td>{{ category.details }}</td>
                        <td>
                            <router-link :to="{name:'edit-category',params:{id:category.id}}" ><button href="#" class="btn btn-success"><i class="fas fa-edit"></i></button></router-link>
                            <button @click="deleteCategory(category.id)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
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
            categories:[],
            searchData:''
        }
    },
    computed:{
      filterSearch(){
        return this.categories.filter(category =>{
          return (category.category_name.match(this.searchData) || category.details.match(this.searchData) )
        })
      }
    },
    methods:{
        allCategory(){
          axios.get('/api/category/')
          .then(({data}) => (this.categories = data))
          .catch()
        },
        deleteCategory(id){
          Swal.fire({
              title: "Are you sure?",
              text: "You won't be able to revert this!",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Yes, delete it!",
            }).then((result) => {
              axios.delete('/api/category/'+id)
              .then(() =>{
                this.categories = this.categories.filter(category =>{
                  return category.id != id
                })
              })
              .catch(()=>{
                this.$router.push({name:'category'})
              })
              Swal.fire("Deleted!", "Your file has been deleted.", "success");
          });
      },
    },
    created(){
          this.allCategory();
    }

    
  };
</script>
<style>
#category-photo{
  height: 60px;
  width: 60px;
}
</style>
