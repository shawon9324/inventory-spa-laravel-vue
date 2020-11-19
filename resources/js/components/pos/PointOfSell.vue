<template>
<div>
        <div class="d-sm-flex align-items-center justify-content-between mb-0">
            <h1 class="h5 mb-0 text-gray-800">POS Mangement</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active" aria-current="page">POS</li>
            </ol>
        </div>
        <div class="row mb-3">
            <div class="col-xl-5 col-lg-5">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Expense Insert</h6>
                  <router-link to="/store-customer" class="btn btn-sm btn-info"><i class="fas fa-user-plus"></i> Add Customer</router-link>
                </div>
                <div class="table-responsive" style="font-size:18px">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="cart in carts" :key="cart.id">
                        <td>{{cart.pro_name}}</td>
                        <td>
                            <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                <span class="input-group-btn input-group-prepend">
                                <button :disabled="cart.pro_qty == 1" @click.prevent="decrement(cart.id)" class="btn btn-danger btn-sm" type="button">-</button></span>
                                <input style="text-align:center"  type="text" class="form-control form-control-sm " readonly :value="cart.pro_qty">
                                <span class="input-group-btn input-group-append">
                                <button @click.prevent="increment(cart.id)" class="btn btn-success btn-sm" type="button">+</button></span>
                            </div>
                        </td>
                        <td>{{cart.pro_price}}</td>
                        <td>{{cart.sub_total}}</td>
                        <td><button @click="removeItem(cart.id)"  class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="card-footer" >
                   <ul class="list-group" >
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Total Quantity
                            <div class="text-xs font-weight-bold" style="font-size: 18px;">20</div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Sub Total
                            <div class="text-xs font-weight-bold" style="font-size: 18px;">40,000</div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Vat(%)
                            <div class="text-xs font-weight-bold" style="font-size: 18px;">15%</div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Total
                            <div class="text-xs font-weight-bold" style="font-size: 18px;">45000</div>
                        </li>
                    </ul>
                 </div>
                 <div class="card-footer" >
                     <form>
                        <label for="">Customer</label>
                        <select class="form-control form-control-sm mb-3" v-model="customer_id">
                                <option  v-for="customer in customers" :key="customer.id">{{customer.name}}</option>
                        </select>
                        <label for="">Pay</label>
                        <input class="form-control form-control-sm  mb-3" type="text" placeholder=".form-control-sm" v-model="pay">
                        <label for="">Due</label>
                        <input class="form-control form-control-sm  mb-3" type="text" placeholder=".form-control-sm" v-model="due">
                        <label for="">Pay By</label>
                        <select class="form-control form-control-sm mb-3" v-model="payby">
                                <option value="HandCash">Handcash</option>
                                <option value="GiftCard">Gift Card</option>
                                <option value="OnlineBanking">Online Banking</option>
                        </select>
                        <button type="button" class="btn btn-success mb-1">Submit</button>

                     </form>
              </div>
              </div>
            </div>


            <!-- RIGHT:ALL PRODUCTS -->
            <div class="col-xl-7 col-lg-7">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Products</h6>
                        <input type="text" v-model="searchData" class="form-control-sm"  placeholder="Search here" style="color:gray;border:1px solid #a9a9a9;">
                    </div>
                    <div class="card-body">
                            <ul class="nav nav-pills btn-sm mb-2" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="allProducts-tab" data-toggle="pill" href="#allProducts" role="tab" aria-controls="allProducts" aria-selected="true">All Products</a>
                                </li>
                                <li class="nav-item" v-for="category in categories" :key="category.id">
                                    <a class="nav-link" id="categoryProducts-tab" data-toggle="pill" href="#categoryProducts" role="tab" aria-controls="categoryProducts" aria-selected="false" @click="subProduct(category.id)">{{category.category_name}}</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="allProducts" role="tabpanel" aria-labelledby="allProducts-tab">
                                    <div class="row" >
                                        <div class="col-lg-3 col-md-3 col-sm-3 d-flex align-items-stretch" v-for="product in filterSearch" :key="product.id">
                                            
                                            <div @click="addTocart(product.id)" class="card" style="width: 25rem; margin-bottom:8px;cursor:pointer;">
                                                <img :src="product.product_image" class="card-img-top custom-photo my-img-container">
                                                <div class="card-body">
                                                    <div class="text-xs font-weight-bold  mb-1" style="font-size:18px;">{{ product.product_name }}</div>
                                                </div>
                                                <div  class="ribbon bg-light text-xs text-success mr-2 font-weight-bold   text-uppercase text-center ">$ {{ product.selling_price }}</div>
                                                <!-- Stock Status -->
                                                <div v-if="(product.product_quantity >= 1)" class="ribbon bg-success text-xs text-uppercase text-center custom-rib">Available: {{ product.product_quantity }}</div>
                                                <div  v-else class="ribbon bg-danger text-xs  text-uppercase text-center custom-rib">Stock Out</div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="categoryProducts" role="tabpanel" aria-labelledby="categoryProducts-tab">
                                    <div class="row" >
                                        <div class="col-lg-3 col-md-3 col-sm-3 d-flex align-items-stretch" v-for="product in getfilterSearch" :key="product.id">
                                            <div @click="addTocart(product.id)" class="card" style="width: 25rem; margin-bottom:8px;cursor:pointer;">
                                                <img :src="product.product_image" class="card-img-top custom-photo my-img-container">
                                                <div class="card-body">
                                                    <div class="text-xs font-weight-bold  mb-1" style="font-size:18px;">{{ product.product_name }}</div>
                                                </div>
                                                <!-- Stock Status -->
                                                <div v-if="(product.product_quantity >= 1)" class="ribbon bg-success text-xs text-uppercase text-center custom-rib">Available: {{ product.product_quantity }}</div>
                                                <div  v-else class="ribbon bg-danger text-xs  text-uppercase text-center custom-rib">Stock Out</div>
                                            </div>
                                        </div>
                                    </div>
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
    created(){
          this.allProduct();
          this.allCategory();
          this.allCustomer();
          this.cartProduct();
          Reload.$on('afterAddToCart',() =>{
              this.cartProduct();
          })
    },
    data(){
        return{
            products:[],
            categories:'',
            getproducts:[],
            customers:'',
            carts:[],
            searchData:'',
            errors:''
        }
    },
    computed:{
      filterSearch(){
        return this.products.filter(product =>{
          return (product.product_name.match(this.searchData))
        })
      },
      getfilterSearch(){
        return this.getproducts.filter(getproduct =>{
          return (getproduct.product_name.match(this.searchData))
        })
      },
    },
    methods:{
        addTocart(id){
          axios.post('/api/addToCart/'+id)
          .then(res => {
              Reload.$emit('afterAddToCart')
              Notification.success("Successfully add to Cart!")
          })
          .catch()
        },
        cartProduct(){
          axios.get('/api/cart/product')
          .then(({data}) => (this.carts = data))
          .catch()
        },
        removeItem(id){
           axios.post('/api/cart/remove/'+id)
          .then(res => {
              Reload.$emit('afterAddToCart')
              Notification.success("Item removed Successfully!")
          })
          .catch()
        },
        increment(id){
            axios.post('/api/increment/'+id)
            .then(res => {
              Reload.$emit('afterAddToCart')
              Notification.success("Item Incremented Successfully!")
          })
          .catch()
        },
        decrement(id){
            axios.post('/api/decrement/'+id)
            .then(res => {
              Reload.$emit('afterAddToCart')
              Notification.success("Item Decremented Successfully!")
            })
            .catch()
        },
        allProduct(){
          axios.get('/api/product/')
          .then(({data}) => (this.products = data))
          .catch()
        },
        allCategory(){
          axios.get('/api/category/')
          .then(({data}) => (this.categories = data))
          .catch()
        },
        allCustomer(){
          axios.get('/api/customer/')
          .then(({data}) => (this.customers = data))
          .catch()
        },
        subProduct(id){
          axios.get('/api/getting/product/'+id)
          .then(({data}) => (this.getproducts = data))
          .catch()
        },
    },
  };
</script>
<style type="text/css" scoped>
.custom-photo{
  height: 130px;
  width: 130px;
  align-content: center;
  
}
.custom-rib{
    border-radius: 0px 0px 6px 6px;
    color:white
}

</style>
