<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Expense</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active" aria-current="page">Add Expense</li>
            </ol>
          </div>
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm">
          <div class="card-header text-center h4 text-gray-900">
            <i class="fas fa-plus-circle"></i> Add Expense
            <router-link to="/expense" class="btn btn-info" style="float:right"><i class="far fa-eye"></i></router-link>
          </div>
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                    <form class="expense" @submit.prevent="storeExpense">
                              <div class="form-row">
                                <div class="form-group col-md-12">
                                      <label for="details">Expense Details</label>
                                      <textarea class="form-control" id="details"  placeholder="Enter Expense Details" v-model="form.details" rows="3"></textarea>
                                  <small class="text-danger" v-if="errors.details">{{ errors.details[0] }}</small>
                                </div> 
                              </div>
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                  <label for="Amount">Expense Amount</label>
                                  <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                      </div>
                                      <input type="text" class="form-control" id="amount" placeholder="Expense Amount" v-model="form.amount" >
                                      <div class="input-group-append">
                                      </div>
                                  </div>
                                  <small class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}</small>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="expense_date">Expense Date</label>
                                  <input type="date" class="form-control" id="expense_date" v-model="form.expense_date">
                                  <small class="text-danger" v-if="errors.expense_date">{{ errors.expense_date[0] }}</small>
                                </div> 
                              </div>
                            <div class="form-group">
                              <button type="submit" id="submit" class="btn btn-info btn-block">Submit</button>
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
                details:null,
                amount:null,
                expense_date:null,
            },
            errors:{ },

        }
    },
    methods:{
        storeExpense(){
          axios.post('/api/expense',this.form)
          .then(res => {
            Notification.success("Expense added successfully!")
            this.$router.push({name:'expense'})
          })
          .catch(error => (this.errors = error.response.data.errors))
        }
    },

  };
</script>

<style scoped>

</style>
