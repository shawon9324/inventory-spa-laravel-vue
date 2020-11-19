<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Product Stock</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active" aria-current="page">Product Stock</li>
            </ol>
          </div>
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm">
          <div class="card-header text-center h4 text-gray-900" >
            <input type="text" v-model="searchData" class="form-control-sm"  placeholder="Search here" style="float:left; color:gray;border:1px solid #a9a9a9 ;">
            <i class="fas fa-box-open"></i> Add Product Stock &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <router-link to="/store-product" class="btn btn-info" style="float:right"><i class="fas fa-cart-plus"></i></router-link>
          </div>
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                  <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Code</th>
                        <th>Category</th>
                        <th>Buying Price</th>
                        <th>Quantity</th>
                        <th>Stock Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="product in filterSearch" :key="product.id">
                        <td><img :src="product.product_image" id="product-photo"></td>
                        <td>{{ product.product_name }}</td>
                        <td>{{ product.product_code }}</td>
                        <td>{{ product.category['category_name'] }}</td>
                        <td><span class="badge badge-light">{{ product.buying_price }}</span></td>
                        <td><span class="badge badge-light">{{ product.product_quantity }}</span></td>
                        <td v-if="(product.product_quantity >= 1)"><span class="badge badge-success">Available</span></td>
                        <td v-else><span class="badge badge-danger">Stock Out</span></td>
                        <td>
                            <router-link :to="{name:'edit-stock',params:{id:product.id}}" ><button class="btn btn-success"><i class="fas fa-user-edit"></i></button></router-link>
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
