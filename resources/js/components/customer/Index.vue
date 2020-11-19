<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Customer</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active" aria-current="page">All Customer</li>
            </ol>
          </div>
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm">
          <div class="card-header text-center h4 text-gray-900" >
            <input type="text" v-model="searchData" class="form-control-sm"  placeholder="Search here" style="float:left; color:gray;border:1px solid #a9a9a9 ;">
            <i class="fas fa-users"></i> All Customer({{filterSearch.length}})  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <router-link to="/store-customer" class="btn btn-info" style="float:right"><i class="fas fa-user-plus"></i></router-link>
          </div>
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                  <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Photo</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="customer in filterSearch" :key="customer.id">
                        <td>#{{ customer.id}}</td>
                        <td>{{ customer.name }}</td>
                        <td>{{ customer.phone }}</td>
                        <td>{{ customer.address }}</td>
                        <td><img :src="customer.photo" id="customer-photo"></td>
                        <td>
                            <router-link :to="{name:'edit-customer',params:{id:customer.id}}" ><button href="#" class="btn btn-success"><i class="fas fa-user-edit"></i></button></router-link>
                            <button @click="deleteCustomer(customer.id)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
            customers:[],
            searchData:'',
        }
    },
    computed:{
      filterSearch(){
        return this.customers.filter(customer =>{
          return (customer.phone.match(this.searchData) || customer.name.match(this.searchData))
        })
      }
    },
    methods:{
        allCustomer(){
          axios.get('/api/customer/')
          .then(({data}) => (this.customers = data))
          .catch()
        },
        deleteCustomer(id){
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
              axios.delete('/api/customer/'+id)
              .then(() =>{
                this.customers = this.customers.filter(customer =>{
                  return customer.id != id
                })
              })
              .catch(()=>{
                this.$router.push({name:'customer'})
              })
              Swal.fire("Deleted!", "Your file has been deleted.", "success");
              }
          });
      },
    },
    created(){
          this.allCustomer();
     }

  };
</script>
<style>
#customer-photo{
  height: 60px;
  width: 60px;
}
</style>
