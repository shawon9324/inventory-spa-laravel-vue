<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Order</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active" aria-current="page">Today's Order</li>
            </ol>
          </div>
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm">
          <div class="card-header text-center h4 text-gray-900" >
            <input type="text" v-model="searchData" class="form-control-sm"  placeholder="Search here" style="float:left; color:gray;border:1px solid #a9a9a9 ;">
            <i class="fas fa-hand-holding-usd"></i> All Today's Order &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <router-link to="/store-expense" class="btn btn-info" style="float:right"><i class="fas fa-plus-circle"></i></router-link>
          </div>
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                  <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Total Amount</th>
                        <th>Paid</th>
                        <th>Due</th>
                        <th>PaidBy</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="order in filterSearch" :key="order.id">
                        <td>{{ order.id }}</td>
                        <td>{{ order.name }}</td>
                        <td>{{ order.total }}</td>
                        <td>{{ order.pay }}</td>
                        <td v-if="order.due == 0"><span class="badge badge-success">No Due</span></td>
                        <td v-else><span class="badge badge-danger">{{ order.due }}</span></td>
                        <td>{{ order.payby }}</td>
                        <td>
                            <router-link :to="{name:'view-order',params:{id:order.id}}" ><button  class="btn btn-success"><i class="fas fa-eye"></i></button></router-link>
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
            orders:[],
            searchData:''
        }
    },
    computed:{
      filterSearch(){
        return this.orders.filter(order =>{
          return (order.name.match(this.searchData))
        })
      }
    },
    methods:{
        allOrder(){
          axios.get('/api/orders/')
          .then(({data}) => (this.orders = data))
          .catch()
        },
    },
    created(){
          this.allOrder();
    }
  };
</script>
<style>

</style>
