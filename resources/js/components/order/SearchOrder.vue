<template>
<div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Search Order</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active" aria-current="page">Search Order</li>
            </ol>
          </div>
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm">
          <div class="card-header text-center h4 text-gray-900">
            <i class="fas fa-search"></i> Search Order
            <router-link to="/order" class="btn btn-info" style="float:right"><i class="far fa-eye"></i></router-link>
          </div>
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-4">
                <div class="login-form">
                    <form class="category" @submit.prevent="searchOrder">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="">Search by Date</label>
                                <input type="date" class="form-control" id="serach" v-model="date">
                            </div> 
                         </div>
                        <div class="form-group">
                            <button type="submit" id="submit" class="btn btn-info btn-block"><i class="fas fa-search"></i> Search</button>
                        </div>
                    </form>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="login-form">
                    <form class="category" @submit.prevent="searchOrderbyMonth">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                  <label for="expense_date">Search by Months</label>
                                  <select class="form-control" id="month" v-model="month">
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                  </select>
                           </div> 
                         </div>
                        <div class="form-group">
                            <button type="submit" id="submit" class="btn btn-info btn-block"><i class="fas fa-search"></i> Search</button>
                        </div>
                    </form>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="login-form">
                    <form class="category" @submit.prevent="searchOrderbyYear">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                  <label for="expense_date">Search by Year</label>
                                  <select class="form-control" id="year" v-model="year">
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                  </select>
                           </div> 
                         </div>
                        <div class="form-group">
                            <button type="submit" id="submit" class="btn btn-info btn-block"><i class="fas fa-search"></i> Search</button>
                        </div>
                    </form>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                  <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Subtotal</th>
                        <th>Vat</th>
                        <th>Total</th>
                        <th>Paid</th>
                        <th>Due</th>
                        <th>Payment Method</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="order in orders" :key="order.id">
                        <td>{{ order.id }}</td>
                        <td>{{ order.name }}</td>
                        <td>{{ order.sub_total }}</td>
                        <td>{{ order.vat }}</td>
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
            date:'',
            month:'',
            year:'',
            orders:{},
        }
    },
    methods:{
        searchOrder(){
          var data = {date:this.date}
          axios.post('/api/search/order',data)
          .then(({data}) => (this.orders = data))
        },
        searchOrderbyMonth(){
           var data = {month:this.month}
          axios.post('/api/search/order',data)
          .then(({data}) => (this.orders = data))
        },
        searchOrderbyYear(){
           var data = {year:this.year}
          axios.post('/api/search/order',data)
          .then(({data}) => (this.orders = data))
        },
    },

  };
</script>

<style scoped>

</style>
