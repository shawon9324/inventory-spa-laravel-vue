<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Product</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active" aria-current="page">Edit Product Info</li>
            </ol>
          </div>
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm">
          <div class="card-header text-center h4 text-gray-900">
            <i class="fas fa-user-edit"></i>  Edit Product Info &nbsp;&nbsp;&nbsp;&nbsp;
            <button @click="back()" class="btn btn-info" style="float:left"><i class="fas fa-arrow-alt-circle-left"></i></button>
            <button @click="refresh()" class="btn btn-info" style="float:right"><i class="fas fa-redo-alt"></i></button>
          </div>
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                    <form id="edit-product" class="product" @submit.prevent="updateProduct" enctype="multipart/form-data">
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                  <label for="exampleFormControlSelect1">Product Name</label>
                                  <input type="text" class="form-control" id="product_name"  placeholder="Enter Product Name" v-model="form.product_name">
                                  <small class="text-danger" v-if="errors.product_name">{{ errors.product_name[0] }}</small>
                                </div> 
                                <div class="form-group col-md-6">
                                  <label for="exampleFormControlSelect1">Product Code</label>
                                  <input type="text" class="form-control" id="product_code"  placeholder="Enter Product Code" v-model="form.product_code">
                                  <small class="text-danger" v-if="errors.product_code">{{ errors.product_code[0] }}</small>
                                </div> 
                              </div>
                              <div class="form-row">
                                 <div class="form-group col-md-6">
                                    <label for="product_category">Product Category</label>
                                      <select class="form-control" id="product_category" v-model="form.category_id">
                                        <option :value="category.id" v-for="category in categories" :key="category.id" >{{category.category_name}}</option>
                                      </select>
                                      <small class="text-danger" v-if="errors.category_id">{{ errors.category_id[0] }}</small>
                                  </div>
                                 <div class="form-group col-md-6">
                                    <label for="product_category">Product Supplier</label>
                                      <select class="form-control" id="product_supplier" v-model="form.supplier_id">
                                        <option :value="supplier.id" v-for="supplier in suppliers" :key="supplier.id" >{{supplier.name}}</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="root">Product Root</label>
                                    <input type="text" class="form-control" id="root"   v-model="form.root">
                                    <small class="text-danger" v-if="errors.root">{{ errors.root[0] }}</small>
                                </div> 
                                <div class="form-group col-md-4">
                                  <label for="buying_price">Buying Price</label>
                                  <input type="text" class="form-control" id="buying_price"   v-model="form.buying_price">
                                  <small class="text-danger" v-if="errors.buying_price">{{ errors.buying_price[0] }}</small>
                                </div> 
                                <div class="form-group col-md-4">
                                  <label for="selling_price">Selling Price</label>
                                  <input type="text" class="form-control" id="selling_price"   v-model="form.selling_price">
                                  <small class="text-danger" v-if="errors.selling_price">{{ errors.selling_price[0] }}</small>
                                </div> 
                              </div>
                              <div class="form-row">
                                <div class="form-group col-md-4">
                                  <label for="buying_date">Buying Date</label>
                                  <input type="date" class="form-control" id="buying_date"   v-model="form.buying_date">
                                  <small class="text-danger" v-if="errors.buying_date">{{ errors.buying_date[0] }}</small>
                                </div> 
                                <div class="form-group col-md-4">
                                  <label for="product_quantity">Product Quantity</label>
                                  <input type="number" class="form-control" id="product_quantity" min="0" v-model="form.product_quantity">
                                  <small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</small>
                                </div> 
                                <div class="form-group col-md-3">
                                      <label for="selling_price">Product Image</label>
                                      <div class="custom-file" >
                                        <input type="file" class="custom-file-input"  id="customFile" @change="onFileSelected" accept="image/png,image/jpeg,image/jpg">
                                        <label data-v-afc914bc="" class="custom-file-label" for="customFile">Choose file</label>
                                      </div>
                                   </div>
                                  <div class="form-group col-md-1" style = "z-index: 1;margin-top:35px;">
                                    <img class="zoom img-fluid" :src="form.product_image"  alt="">
                                  </div>
                              </div>
                              <div class="form-row">
                                <div class="form-group col-md-12">
                                      <textarea class="form-control" id="product_details"  placeholder="Enter Product Details" v-model="form.product_details" rows="3"></textarea>
                                <small class="text-danger" v-if="errors.product_details">{{ errors.product_details[0] }}</small>
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
                    category_id:'',
                    supplier_id:'',
                    product_code:'',
                    product_name:'',
                    product_image	:'',
                    new_photo	:'',
                    product_details:'',
                    root:'',
                    buying_price:'',
                    selling_price:'',
                    buying_date:'',
                    product_quantity:''
            },
            errors:{ },
            categories:{},
            suppliers:{},
        }
    },
    created() {
      let id = this.$route.params.id
      axios.get('/api/product/'+id)
      .then(({data}) =>(this.form = data))
      axios.get('/api/category')
      .then(({data}) => (this.categories = data))
      axios.get('/api/supplier')
      .then(({data}) => (this.suppliers = data))
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
        updateProduct(){
          let id = this.$route.params.id
          axios.patch('/api/product/'+id,this.form)
          .then(res => {
            Notification.success("Product updated successfully!")
            this.$router.push({name:'product'})
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
.zoom {
  transition: 0.2s all ease-in-out; 
  width: 60px;
  height: 60px;
}
.zoom:hover { 
  transform: scale(4);
}
</style>
