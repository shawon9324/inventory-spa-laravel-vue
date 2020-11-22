<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Settings</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active" aria-current="page">All Settings</li>
            </ol>
          </div>
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm">
          <div class="card-header text-center h4 text-gray-900 d-flex justify-content-between align-items-center"  >
            <span></span>
            <span><i class="fas fa-cog"></i>  Store Settings</span>
            <span v-if="stores.length == 0"><router-link to="/store-setting"   class="btn btn-info"><i class="fas fa-tools"></i></router-link></span>
            <span v-else></span>
          </div>
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                  <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Store Logo</th>
                        <th>Store Name</th>
                        <th>Vat</th>
                        <th>Owner Phone</th>
                        <th>Owner Email</th>
                        <th>Owner Address</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="store in stores" :key="store.id">
                        <td><img :src="store.logo" id="store-photo"></td>
                        <td>{{ store.store_name }}</td>
                        <td>{{ store.vat }} %</td>
                        <td>{{ store.phone }}</td>
                        <td>{{ store.email }}</td>
                        <td>{{ store.address }}</td>
                        <td>
                            <router-link :to="{name:'edit-setting',params:{id:store.id}}" ><button href="#" class="btn btn-success"><i class="fas fa-edit"></i></button></router-link>
                            <button @click="deleteInfo(store.id)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
            stores:[],

            
        }
    },
    computed:{
      
    },
    methods:{
        allStoreInfo(){
          axios.get('/api/settings/')
          .then(({data}) => (this.stores = data))
          .catch()
        },
        deleteInfo(id){
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
              axios.delete('/api/settings/'+id)
              .then(() =>{
                this.stores = this.stores.filter(store =>{
                  return store.id != id
                })
              })
              .catch(()=>{
                this.$router.push({name:'setting'})
              })
              Swal.fire("Deleted!", "Your file has been deleted.", "success");
              }
          });
      },
    },
    created(){
          this.allStoreInfo();
    }

    
  };
</script>
<style>
#store-photo{
  height: 60px;
  width: 60px;
}
</style>
