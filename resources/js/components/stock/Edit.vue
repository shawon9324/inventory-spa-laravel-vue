<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Product Stock</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active" aria-current="page">Update Product Stock</li>
            </ol>
          </div>
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm">
          <div class="card-header text-center h4 text-gray-900">
            <i class="fas fa-trash-restore-alt"></i>  Update Product Stock &nbsp;&nbsp;&nbsp;&nbsp;
            <button @click="back()" class="btn btn-info" style="float:left"><i class="fas fa-arrow-alt-circle-left"></i></button>
            <button @click="refresh()" class="btn btn-info" style="float:right"><i class="fas fa-redo-alt"></i></button>
          </div>
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                    <form id="edit-product" class="product" @submit.prevent="updateStock" enctype="multipart/form-data">
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                  <label for="exampleFormControlSelect1">Product Name</label>
                                  <input type="text" class="form-control" id="product_name" v-model="form.product_name" disabled>
                                </div> 
                                <div class="form-group col-md-6">
                                  <label for="exampleFormControlSelect1">Product Code</label>
                                  <input type="text" class="form-control" id="product_code" v-model="form.product_code" disabled>
                                </div> 
                              </div>
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                  <label for="product_quantity">Product Quantity</label>
                                  <input type="number" class="form-control" id="product_quantity" min="0" v-model="form.product_quantity">
                                  <small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</small>
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
                    product_code:'',
                    product_name:'',
                    product_quantity:''
            },
            errors:{ },
        }
    },
    created() {
      let id = this.$route.params.id
      axios.get('/api/product/'+id)
      .then(({data}) =>(this.form = data))
    },
    methods:{
        updateStock(){
          let id = this.$route.params.id
          axios.post('/api/stock/update/'+id,this.form)
          .then(res => {
            Notification.success("Product Stock updated successfully!")
            this.$router.push({name:'stock'})
          })
          .catch(error => (this.errors = error.response.data.errors))
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

</style>
