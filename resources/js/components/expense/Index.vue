<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Expense</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active" aria-current="page">All Expense</li>
            </ol>
          </div>
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm">
          <div class="card-header text-center h4 text-gray-900" >
            <input type="text" v-model="searchData" class="form-control-sm"  placeholder="Search here" style="float:left; color:gray;border:1px solid #a9a9a9 ;">
            <i class="fas fa-hand-holding-usd"></i> All Expense &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <router-link to="/store-expense" class="btn btn-info" style="float:right"><i class="fas fa-plus-circle"></i></router-link>
          </div>
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                  <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Details</th>
                        <th>Expense Amount</th>
                        <th>Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="expense in filterSearch" :key="expense.id">
                        <td>{{ expense.details }}</td>
                        <td>{{ expense.amount }}</td>
                        <td>{{ expense.expense_date }}</td>
                        <td>
                            <router-link :to="{name:'edit-expense',params:{id:expense.id}}" ><button href="#" class="btn btn-success"><i class="fas fa-edit"></i></button></router-link>
                            <button @click="deleteExpense(expense.id)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
            expenses:[],
            searchData:''
        }
    },
    computed:{
      filterSearch(){
        return this.expenses.filter(expense =>{
          return (expense.details.match(this.searchData) || expense.amount.match(this.searchData) )
        })
      }
    },
    methods:{
        allExpense(){
          axios.get('/api/expense/')
          .then(({data}) => (this.expenses = data))
          .catch()
        },
        deleteExpense(id){
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
              axios.delete('/api/expense/'+id)
              .then(() =>{
                this.expenses = this.expenses.filter(expense =>{
                  return expense.id != id
                })
              })
              .catch(()=>{
                this.$router.push({name:'expense'})
              })
              Swal.fire("Deleted!", "Your file has been deleted.", "success");
              }
          });
      },
    },
    created(){
          this.allExpense();
    }

    
  };
</script>
<style>
#expense-photo{
  height: 60px;
  width: 60px;
}
</style>
