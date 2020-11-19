<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Salary</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active" aria-current="page">Update Salary Payment Info</li>
            </ol>
          </div>
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm">
          <div class="card-header text-center h4 text-gray-900">
            <i class="fas fa-hand-holding-usd"></i>  Update Salary Payment Info&nbsp;&nbsp;&nbsp;&nbsp;
            <button @click="back()" class="btn btn-info" style="float:left"><i class="fas fa-arrow-alt-circle-left"></i></button>
            <button @click="refresh()" class="btn btn-info" style="float:right"><i class="fas fa-redo-alt"></i></button>
          </div>
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                    <form id="updateSalary" class="employee" @submit.prevent="updateSalary" >
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
                                      <input type="text" class="form-control" id="amount" placeholder="amount" v-model="form.amount" >
                                      <div class="input-group-append">
                                      </div>
                                  </div>
                                  <small class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}</small>
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
                              <button type="submit" id="pay" class="btn btn-info btn-block">Update</button>
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
                salary_month:'',
                amount:'',
                name:'',
                email:'',
            },
            errors:{ },

        }
    },
    created() {
      let id = this.$route.params.id
      axios.get('/api/salary/edit/'+id)
      .then(({data}) =>(this.form = data))
      .catch(console.log('error'))
    },
    methods:{
        updateSalary(){
          let id = this.$route.params.id
          axios.post('/api/salary/update/'+id,this.form)
          .then(res => {
            Notification.success("Salary Info updated successfully!")
            window.history.go(-2)
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
