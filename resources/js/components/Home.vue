
<template>
    <div>
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div>

          <div class="row mb-3">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Todays Income</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">$ {{ todays.income }}</div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                          <span>{{todays.day}}  {{todays.month}}</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="far fa-money-bill-alt fa-2x text-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Todays Sales </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">$ {{ todays.sell }}</div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                        <span>{{todays.day}}  {{todays.month}}</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-shopping-cart fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Todays Due</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">$ {{todays.due}}</div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                          <span>{{todays.day}}  {{todays.month}}</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments-dollar fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- New User Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Todays Expense</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">$ {{todays.expense}}</div>
                      <div class="mt-2 mb-0 text-muted text-xs">
                          <span>{{todays.day}}  {{todays.month}}</span>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-hand-holding-usd fa-2x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Invoice Example -->
          </div>
          <!--Row-->
          <div class="row">
             <div class="col-xl-4 col-lg-5">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-certificate"></i> Top 5 Products Sold</h6>
                </div>
                <div class="card-body">
                  <div v-for="topProduct in topSellProducts " :key="topProduct.id" class="mb-3">
                    <div class="small text-gray-600">{{topProduct.product_name}}
                      <div class="small float-right"><b>{{topProduct.qty}} of {{parseInt(topProduct.qty)+parseInt(topProduct.stock) }} Items</b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                      <div class="progress-bar bg-info" role="progressbar" style="width:100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center ">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-hourglass-start"></i> Out of Stock Product </h6>
                       <!-- <div class="text-xs font-weight-bold badge badge-info">Total out of stock: {{this.todays.products.length}}</div> -->
                    </div>
                          <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                              <thead class="thead-light">
                                <tr>
                                  <th>Image</th>
                                  <th>Product Name</th>
                                  <th>Code</th>
                                  <th>Buying Price</th>
                                  <th>Quantity</th>
                                  <th>Stock Status</th>
                                  <!-- <th>Action</th> -->
                                </tr>
                              </thead>
                              <tbody>
                                <tr v-for="product in todays.products" :key="product.id">
                                  <td><img :src="product.product_image" id="product-photo"></td>
                                  <td>{{ product.product_name }}</td>
                                  <td>{{ product.product_code }}</td>
                                  <td><span class="badge badge-light">{{ product.buying_price }}</span></td>
                                  <td><span class="badge badge-light">{{ product.product_quantity }}</span></td>
                                  <td v-if="(product.product_quantity >= 1)"><span class="badge badge-success">Available</span></td>
                                  <td v-else><span class="badge badge-danger">Stock Out</span></td>
                                  <!-- <td>
                                      <router-link :to="{name:'edit-stock',params:{id:product.id}}" ><button class="btn btn-success"><i class="fas fa-user-edit"></i></button></router-link>
                                  </td> -->
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <div class="card-footer"></div>
                    </div>
             </div>
            </div>
          </div>
</template>


<script>
export default {
    created() {
        if(!User.loggedIn()){
            this.$router.push({name: '/'})
        }
    },
    data() {
        return {
           
            products:'',
            todays:'',
            topSellProducts:''
        }
    },
    mounted(){
      this.todayInfo()
      this.topSellProduct()
    },   
    methods: {
        todayInfo(){
         axios.get('/api/today/info')
        .then(({data}) => (this.todays = data))
        .catch()
      },
        topSellProduct(){
         axios.get('/api/topsell')
        .then(({data}) => (this.topSellProducts = data))
        .catch()
      }
    },
};
</script>


<style type="text/css">

</style>