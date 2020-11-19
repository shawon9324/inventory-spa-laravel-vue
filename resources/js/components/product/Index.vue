<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Product</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active" aria-current="page">All Product</li>
            </ol>
          </div>
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm">
          <div class="card-header text-center h4 text-gray-900" >
            <input type="text" v-model="searchData" class="form-control-sm"  placeholder="Search here" style="float:left; color:gray;border:1px solid #a9a9a9 ;">
            <i class="fas fa-box-open"></i> All Product ({{filterSearch.length}}) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <router-link to="/store-product" class="btn btn-info" style="float:right"><i class="fas fa-cart-plus"></i></router-link>
          </div>
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                  <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Supplier</th>
                        <th>Buying Price</th>
                        <th>Selling Price</th>
                        <th>Quantity</th>
                        <th>Photo</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="product in filterSearch" :key="product.id">
                        <td>{{ product.product_name }}</td>
                        <td>{{ product.category['category_name'] }}</td>
                        <td>{{ product.supplier['name'] }}</td>
                        <td><span class="badge badge-light">{{ product.buying_price }}</span></td>
                        <td><span class="badge badge-light">{{ product.selling_price }}</span></td>
                        <td><span class="badge badge-light">{{ product.product_quantity }}</span></td>
                        <td><img :src="product.product_image" id="product-photo"></td>
                        <td>
                            <router-link :to="{name:'edit-product',params:{id:product.id}}" ><button class="btn btn-success"><i class="fas fa-user-edit"></i></button></router-link>
                            <button @click="deleteProduct(product.id)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
            products:[],
            searchData:''
        }
    },
    computed:{
      filterSearch(){
        return this.products.filter(product =>{
          return (product.product_name.match(this.searchData))
        })
      }
    },
    methods:{
        allProduct(){
          axios.get('/api/product/')
          .then(({data}) => (this.products = data))
          .catch()
        },
        deleteProduct(id){
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
              axios.delete('/api/product/'+id)
              .then(() =>{
                this.products = this.products.filter(product =>{
                  return product.id != id
                })
              })
              .catch(()=>{
                this.$router.push({name:'product'})
              })
              Swal.fire("Deleted!", "Your file has been deleted.", "success");
              }
          });
      },
    },
    created(){
          this.allProduct();
    }

    
  };
</script>
<style>
#product-photo{
  height: 60px;
  width: 60px;
}
</style>
