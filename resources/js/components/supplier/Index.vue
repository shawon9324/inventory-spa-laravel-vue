<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Supplier</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active" aria-current="page">All Supplier</li>
            </ol>
          </div>
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm">
          <div class="card-header text-center h4 text-gray-900" >
            <input type="text" v-model="searchData" class="form-control-sm"  placeholder="Search here" style="float:left; color:gray;border:1px solid #a9a9a9 ;">
            <i class="fas fa-users"></i> All Supplier &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <router-link to="/store-supplier" class="btn btn-info" style="float:right"><i class="fas fa-user-plus"></i></router-link>
          </div>
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                  <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>ID No</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Shop Name</th>
                        <th>Photo</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="supplier in filterSearch" :key="supplier.id">
                        <td>{{ supplier.id }}</td>
                        <td>{{ supplier.name }}</td>
                        <td>{{ supplier.phone }}</td>
                        <td>{{ supplier.shop_name }}</td>
                        <td><img :src="supplier.photo" id="supplier-photo"></td>
                        <td>
                            <router-link :to="{name:'edit-supplier',params:{id:supplier.id}}" ><button href="#" class="btn btn-success"><i class="fas fa-user-edit"></i></button></router-link>
                            <button @click="deleteSupplier(supplier.id)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                        </td>
                        <!-- <td>Nasi Padang</td> -->
                        <!-- <td><span class="badge badge-success">Delivered</span></td> -->
                        <!-- <td><a href="#" class="btn btn-sm btn-primary">Action</a></td> -->
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
            suppliers:[],
            searchData:''
        }
    },
    computed:{
      filterSearch(){
        return this.suppliers.filter(supplier =>{
          return (supplier.phone.match(this.searchData) || supplier.name.match(this.searchData) || supplier.shop_name.match(this.searchData) )
        })
      }
    },
    methods:{
        allSupplier(){
          axios.get('/api/supplier/')
          .then(({data}) => (this.suppliers = data))
          .catch()
        },
        deleteSupplier(id){
          Swal.fire({
              title: "Are you sure?",
              text: "You won't be able to revert this!",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Yes, delete it!",
            }).then((result) => {
              if (result.isConfirmed) {
              axios.delete('/api/supplier/'+id)
              .then(() =>{
                this.suppliers = this.suppliers.filter(supplier =>{
                  return supplier.id != id
                })
              })
              .catch(()=>{
                this.$router.push({name:'supplier'})
              })
              Swal.fire("Deleted!", "Your file has been deleted.", "success");
              }
          });
      },
    },
    created(){
          this.allSupplier();
    }

    
  };
</script>
<style>
#supplier-photo{
  height: 60px;
  width: 60px;
}
</style>
