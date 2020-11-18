<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Salary</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active" aria-current="page">Salary Payment Info</li>
            </ol>
          </div>
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm">
          <div class="card-header text-center h4 text-gray-900" >
            <input type="text" v-model="searchData" class="form-control-sm"  placeholder="Search here" style="float:right; color:gray;border:1px solid #a9a9a9 ;">
            &nbsp;&nbsp;&nbsp;<i class="fas fa-dollar-sign"></i> Salary Payment Info ({{this.$route.params.id2}}/{{this.$route.params.id}})
            <button @click="back()" class="btn btn-info" style="float:left"><i class="fas fa-arrow-alt-circle-left"></i></button>
          </div>
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                  <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <th>Paid Amount</th>
                        <th>Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="salary in filterSearch" :key="salary.id">
                        <td>#{{ salary.employee_id }}</td>
                        <td>{{ salary.employee['name'] }}</td>
                        <td>{{ salary.amount }}</td>
                        <td>{{ salary.salary_date }}</td>
                        <td>
                            <router-link :to="{name:'update-salary',params:{id:salary.id}}" ><button class="btn btn-success"><i class="fas fa-edit"></i></button></router-link>
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
          return (salary.employee['name'].match(this.searchData))
        })
      }
    },
    methods:{
        viewSalary(){
          let year= this.$route.params.id
          let month = this.$route.params.id2
          let url = year+'/'+month
          axios.get('/api/salary/view/'+url)
          .then(({data}) => (this.salaries = data))
          .catch(error => (this.errors = error.response.data.errors))
        },
        back(){
            window.history.back()
        }
     },
     created(){
            this.viewSalary();
      }
     
  };
</script>
<style>

</style>
