<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Salary</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active" aria-current="page">All Salary</li>
            </ol>
          </div>
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm">
          <div class="card-header text-center h4 text-gray-900" >
            <input type="text" v-model="searchData" class="form-control-sm"  placeholder="Search here" style="float:left; color:gray;border:1px solid #a9a9a9 ;">
            <i class="fas fa-user"></i>All Salary Information&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <router-link to="/given-salary" class="btn btn-info" style="float:right"><i class="fas fa-user-plus"></i></router-link>
          </div>
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                  <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Month Name</th>
                        <th>Details</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="salary in filterSearch" :key="salary.id">
                        <td>{{ salary.salary_month }}</td>
                        <td>
                            <router-link :to="{name:'view-salary',params:{id:salary.salary_month}}" ><button class="btn btn-light">View Salary</button></router-link>
                        </td>
                        <!-- <td><span class="badge badge-success">Delivered</span></td> -->
                        <!-- <td><a href="#" class="btn btn-sm btn-primary">Action</a></td> -->
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
            salaries:[],
            searchData:'',
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
          axios.get('/api/salary/')
          .then(({data}) => (this.salaries = data))
          .catch()
        },
     },
     created(){
            this.allSalary();
      }
     
  };
</script>
<style>

</style>
