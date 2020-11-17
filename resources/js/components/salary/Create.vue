<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Salary</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active" aria-current="page">Employee Salary Payment</li>
            </ol>
          </div>
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm">
          <div class="card-header text-center h4 text-gray-900">
            <i class="fas fa-hand-holding-usd"></i>  Employee Salary Payment &nbsp;&nbsp;&nbsp;&nbsp;
            <router-link to="/employee" class="btn btn-info" style="float:left"><i class="fas fa-arrow-alt-circle-left"></i></router-link>
          </div>
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                    <form id="paySalary" class="employee" @submit.prevent="paySalary" >
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                   <label for="expense_date">Employee Name</label>
                                  <input type="text" class="form-control" id="name"  placeholder="Employee Name" v-model="form.name" disabled>
                                  <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                                </div> 
                                <div class="form-group col-md-6">
                                <label for="expense_date">Employee Email</label>
                                  <input type="email" class="form-control" id="email" v-model="form.email" disabled>
                                  <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                                </div> 
                              </div>
                              
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                   <label for="expense_date">Employee Salary</label>
                                  <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                      </div>
                                      <input type="text" class="form-control" id="salary" placeholder="Salary" v-model="form.salary" >
                                      <div class="input-group-append">
                                      </div>
                                  </div>
                                  <small class="text-danger" v-if="errors.salary">{{ errors.salary[0] }}</small>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="expense_date">Select Salary Months</label>
                                  <select class="form-control" id="salary_month" v-model="form.salary_month">
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
                                  <small class="text-danger" v-if="errors.salary_month">{{ errors.salary_month[0] }}</small>
                                </div> 
                              </div>
                              <div class="form-row">
                                
                              </div>
                            <div class="form-group">
                              <button type="submit" id="pay" class="btn btn-info btn-block">Pay Now</button>
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
                salary_month:null,
                salary:null,
                name:null,
                email:null,
            },
            errors:{ },

        }
    },
    created() {
      let id = this.$route.params.id
      axios.get('/api/employee/'+id)
      .then(({data}) =>(this.form = data))
      .catch(console.log('error'))
    },
    methods:{
        paySalary(){
          let id = this.$route.params.id
          axios.post('/api/salary/paid/'+id,this.form)
          .then(res => {
            this.$router.push({name:'given-salary'})
            Notification.success("Salary payment successfully!")
          })
          .catch(error => (this.errors = error.response.data.errors))
        },
        
    },

  };
</script>

<style scoped>

</style>
