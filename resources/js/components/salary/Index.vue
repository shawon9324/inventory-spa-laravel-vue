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
            <i class="fas fa-money-check-alt"></i> Salary Payment Session&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <router-link to="/given-salary" class="btn btn-info" style="float:right;"><i class="fas fa-hand-holding-usd"></i></router-link>
          </div>

          <div class="row mb-3 p-2">
              <div class="col-xl-3 col-md-6 mb-4" v-for="session in sessions" :key="session.id">
                  <router-link :to="{name:'salary-year',params:{id:session.salary_year }}" >
                      <div class="card h-100 shadow-sm">
                          <div class="card-body">
                              <div class="row align-items-center">
                                  <div class="col mr-2">
                                          <div class="h5 mb-0 font-weight-bold text-gray-800 text-center">{{ session.salary_year }}</div>
                                          <div class="mt-2 mb-0 text-muted text-xs text-center">
                                            <span class="text-success mr-2 text-center">View</span>
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
            sessions:{},
        }
    },
    methods:{
        allSalary(){
          axios.get('/api/salary/')
          .then(({data}) => (this.sessions = data))
          .catch()
        },
     },
     created(){
            this.allSalary();
      }
  };
</script>
<style>
a:hover {
  text-decoration: none;
}
</style>
