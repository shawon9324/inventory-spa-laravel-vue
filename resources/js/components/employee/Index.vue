<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Employee</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
              <li class="breadcrumb-item active" aria-current="page">All Employee</li>
            </ol>
          </div>
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm">
          <div class="card-header text-center h4 text-gray-900" >
            <input type="text" v-model="searchData" class="form-control-sm"  placeholder="Search here" style="float:left; color:gray;border:1px solid #a9a9a9 ;">
            <i class="fas fa-users"></i> All Employee({{filterSearch.length}})  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <router-link to="/store-employee" class="btn btn-info" style="float:right"><i class="fas fa-user-plus"></i></router-link>
          </div>
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                  <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>ID</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Salary</th>
                        <th>Joining Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="employee in filterSearch" :key="employee.id">
                        <td>#{{ employee.id}}</td>
                        <td><img :src="employee.photo" id="employee-photo"></td>
                        <td>{{ employee.name }}</td>
                        <td>{{ employee.phone }}</td>
                        <td>{{ employee.salary }}</td>
                        <td>{{ employee.joining_date }}</td>
                        <td>
                            <router-link :to="{name:'edit-employee',params:{id:employee.id}}" ><button href="#" class="btn btn-success"><i class="fas fa-user-edit"></i></button></router-link>
                            <button @click="deleteEmployee(employee.id)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
            employees:[],
            searchData:'',
        }
    },
    computed:{
      filterSearch(){
        return this.employees.filter(employee =>{
          return (employee.phone.match(this.searchData) || employee.name.match(this.searchData))
        })
      }
    },
    methods:{
        allEmployee(){
          axios.get('/api/employee/')
          .then(({data}) => (this.employees = data))
          .catch()
        },
        deleteEmployee(id){
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
              axios.delete('/api/employee/'+id)
              .then(() =>{
                this.employees = this.employees.filter(employee =>{
                  return employee.id != id
                })
              })
              .catch(()=>{
                this.$router.push({name:'employee'})
              })
              Swal.fire("Deleted!", "Your file has been deleted.", "success");
              }
          });
      },
    },
    created(){
          this.allEmployee();
     }

  };
</script>
<style>

</style>
