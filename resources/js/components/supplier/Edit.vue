<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Supplier</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active" aria-current="page">Edit Supplier Info</li>
            </ol>
          </div>
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm">
          <div class="card-header text-center h4 text-gray-900">
            <i class="fas fa-user-edit"></i>  Edit Supplier Info &nbsp;&nbsp;&nbsp;&nbsp;
            <router-link to="/supplier" class="btn btn-info" style="float:left"><i class="fas fa-arrow-alt-circle-left"></i></router-link>
            <button @click="refresh()" class="btn btn-info" style="float:right"><i class="fas fa-redo-alt"></i></button>
          </div>
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                    <form id="edit-employee" class="employee" @submit.prevent="updateSupplier" enctype="multipart/form-data">
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                  <input type="text" class="form-control" id="name"  placeholder="Supplier Name" v-model="form.name">
                                  <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                                </div> 
                                <div class="form-group col-md-6">
                                  <input type="email" class="form-control" id="email"  placeholder="Email" v-model="form.email">
                                  <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                                </div>
                              </div>
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                  <input type="text" class="form-control" id="phone"  placeholder="Contact No" v-model="form.phone">
                                  <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                                </div> 
                                <div class="form-group col-md-6">
                                  <input type="text" class="form-control" id="address"  placeholder="Address" v-model="form.address">
                                  <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
                                </div>
                              </div>
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                   <select class="form-control mb-3" v-model="form.gender">
                                      <option disabled value="">Select Gender</option>
                                      <option>Male</option>
                                      <option>Female</option>
                                      <option>Other</option>
                                      </select>
                                  <small class="text-danger" v-if="errors.gender">{{ errors.gender[0] }}</small>
                                </div> 
                                <div class="form-group col-md-6">
                                  <input type="text" class="form-control" id="shop_name"  placeholder="Shop Name" v-model="form.shop_name">
                                  <small class="text-danger" v-if="errors.shop_name">{{ errors.shop_name[0] }}</small>
                                </div>
                              </div>
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="custom-file" >
                                      <input type="file" class="custom-file-input"  id="customFile" @change="onFileSelected" accept="image/png,image/jpeg,image/jpg">
                                      <!-- <small class="text-danger" v-if="errors.photo">{{ errors.photo[0] }}</small> -->
                                      <label data-v-afc914bc="" class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div> 
                                <div class="form-group col-md-4" style = "z-index: 1;">
                                  <img class="zoom img-fluid" :src="form.photo"  alt="">
                                </div>
                              </div>
                            <div class="form-group">
                              <button type="submit" id="update" class="btn btn-info btn-block">Update</button>
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
                name:'',
                email:'',
                phone:'',
                address:'',
                photo:'',
                new_photo:'',
                shop_name:'',
                gender:'',
            },
            errors:{ },
        }
    },
    created() {
      let id = this.$route.params.id
      axios.get('/api/supplier/'+id)
      .then(({data}) =>(this.form = data))

      
    },
    methods:{
        onFileSelected(event){
          let file = event.target.files[0];
          if(file.size > 1048576){
            let message = 'Please upload image less then 1MB'
            Notification.error(message)
          }else{
            
            let reader = new FileReader();
            reader.onload = event => {
              this.form.new_photo = event.target.result
              console.log(event.target.result)
            };
            reader.readAsDataURL(file)
          }
        },
        updateSupplier(){
          let id = this.$route.params.id
          axios.patch('/api/supplier/'+id,this.form)
          .then(res => {
            Notification.success("Supplier updated successfully!")
            this.$router.push({name:'supplier'})
          })
          .catch(error => (this.errors = error.response.data.errors))
        },
        refresh(){
            document.getElementById("edit-supplier").reset();
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
