<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Salary</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active" aria-current="page">All Salary </li>
            </ol>
          </div>
          <div class="card-header text-center h4 text-gray-900">
            <i class="fas fa-money-check-alt"></i> All Salary Information ( {{year}} )&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <router-link to="/given-salary" class="btn btn-info" style="float:right;"><i class="fas fa-hand-holding-usd"></i></router-link>
            <button @click="back()" class="btn btn-info" style="float:left"><i class="fas fa-arrow-alt-circle-left"></i></button>

          </div>
          <div class="row mb-3 p-2">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4" v-for="salary in filterSearch" :key="salary.id">
              <router-link :to="{name:'view-salary',params:{id:year,id2:salary.salary_month}}" >
              <div class="card h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="h5 mb-0 font-weight-bold text-gray-800 text-center">{{ salary.salary_month }}</div>
                      <div class="mt-2 mb-0 text-muted text-xs text-center">
                        <span class="text-success mr-2 text-center">Session: {{year}}</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              </router-link>
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
            salaries:[],
            searchData:'',
            year:null,
        }
    },
    computed:{
      filterSearch(){
        return this.salaries.filter(salary =>{
          return (salary.salary_month.match(this.searchData))
        })
      }
    },
    methods:{
        allSalary(){
          let id = this.$route.params.id
          this.year = id
          axios.get('/api/salary/session/'+id)
          .then(({data}) => (this.salaries = data))
          .catch()
        },
        back(){
            window.history.back()
        }
     },
     created(){
            this.allSalary();
      }
     
  };
</script>
<style>

</style>
