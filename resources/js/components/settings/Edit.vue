<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Settings</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active" aria-current="page">Edit Store Info</li>
            </ol>
          </div>
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm">
          <div class="card-header text-center h4 text-gray-900 d-flex justify-content-between align-items-center">
            <button @click="back()" class="btn btn-info"><i class="fas fa-arrow-alt-circle-left"></i></button>
            <span><i class="fas fa-user-edit"></i>  Edit Store Info</span>
            <button @click="refresh()" class="btn btn-info"><i class="fas fa-redo-alt"></i></button>
          </div>
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                    <form class="store" @submit.prevent="updateStoreInfo" enctype="multipart/form-data">
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                  <input type="text" class="form-control" id="store_name"  placeholder="Enter Store Name" v-model="form.store_name">
                                </div> 
                                <div class="form-group col-md-6">
                                  <input type="email" class="form-control" id="email"  placeholder="Enter Email" v-model="form.email">
                                </div>
                              </div>
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                  <input type="text" class="form-control" id="phone"  placeholder="Enter Contact No" v-model="form.phone">
                                </div> 
                                <div class="form-group col-md-6">
                                  <input type="text" class="form-control" id="address"  placeholder="Enter Address" v-model="form.address">
                                </div>
                              </div>
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                  <input type="text" class="form-control" id="vat"  placeholder="Enter Vat(%)" v-model="form.vat">
                                </div>
                              </div>
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="custom-file" >
                                      <input type="file" class="custom-file-input"  id="customFile" @change="onFileSelected" accept="image/png,image/jpeg,image/jpg">
                                      <label data-v-afc914bc="" class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div> 
                                <div class="form-group col-md-4" style = "z-index: 1;">
                                  <img class="zoom img-fluid" :src="form.logo"  alt="">
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
               vat: null,
               logo: null,
               new_logo: null,
               store_name: null,
               phone: null,
               email: null,
               address: null,
            },
        }
    },
    created() {
      let id = this.$route.params.id
      axios.get('/api/settings/'+id)
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
              this.form.new_logo = event.target.result
              console.log(event.target.result)
            };
            reader.readAsDataURL(file)
          }
        },
        updateStoreInfo(){
          let id = this.$route.params.id
          axios.patch('/api/settings/'+id,this.form)
          .then(res => {
            Notification.success("Shop Info updated successfully!")
            this.$router.push({name:'setting'})
          })
          .catch()
        },
        refresh(){
           location.reload();
        },
        back(){
            window.history.back()
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
