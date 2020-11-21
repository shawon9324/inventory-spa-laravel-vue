<template>
<div>
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm card mb-3">
          <div class="card-header text-center h5 text-gray-900">
            Order Details &nbsp;&nbsp;&nbsp;&nbsp;
            <button @click="back()" class="btn btn-info" style="float:left"><i class="fas fa-arrow-alt-circle-left"></i></button>
          </div>
        </div>
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Customer Details</h6>
                    </div>
                    <div class="table-responsive">
                        <ul class="list-group" style="font-family:consolas">
                            <li class="list-group-item d-flex justify-content-between align-items-center"><strong>Name:</strong> {{orders.name}} </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center"><strong>Gender:</strong> {{orders.gender}} </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center"><strong>Mobile No:</strong> {{orders.phone}} </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center"><strong>Address:</strong> {{orders.address}} </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center"><strong>Order Date:</strong> {{orders.order_date}} </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center"><strong>Payment Method:</strong> {{orders.payby}} </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Order Details</h6>
                        <div class="text-xs font-weight-bold badge badge-info">#Order ID: {{orders.id}}</div>
                    </div>
                    <div class="table-responsive">
                        <ul class="list-group" style="font-family:consolas">
                            <li class="list-group-item d-flex justify-content-between align-items-center"><strong>Sub Total:</strong> {{orders.sub_total}}/= </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center"><strong>Vat:</strong> {{orders.vat}} % </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center"><strong>Total:</strong> {{orders.total}}/= </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center"><strong>Paid:</strong> {{orders.pay}}/= </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center"><strong>Due:</strong><span v-if="orders.due==0" class="text-success mr-2">No Due</span> <span v-else class="text-danger mr-2">{{orders.due}}/=</span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center"><strong>Payment Status:</strong><span v-if="orders.due==0" class="badge badge-success">Clear</span><span v-else class="badge badge-danger">Not Clear</span> </li>
                        </ul>
                    </div>
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center ">
                        <h6 class="m-0 font-weight-bold text-primary">Product Details </h6>
                       <div class="text-xs font-weight-bold badge badge-info">Total Products: {{orders.qty}}</div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Product Code</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Sub Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="detail in details" :key="detail.id">
                                <td><img :src="'/'+detail.product_image" id="product-photo"></td>
                                <td>{{detail.product_name}}</td>
                                <td><span class="badge badge-info">{{detail.product_code}}</span></td>
                                <td>{{detail.pro_qty}}</td>
                                <td>{{detail.pro_price}}</td>
                                <td>{{detail.sub_total}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer"></div>
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
            errors:{},
            orders:{},
            details:{},
        }
    },
    created() {
      let id = this.$route.params.id
      axios.get('/api/order/details/'+id)
      .then(({data}) =>(this.orders = data))
      axios.get('/api/order/orderdetails/'+id)
      .then(({data}) =>(this.details = data))
    },
    methods:{
        back(){
            window.history.back()
        }
    },
    

  };
</script>

<style scoped>
#product-photo{
  height: 60px;
  width: 60px;
}
</style>
