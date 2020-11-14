<template>
  <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div>
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4"><i class="fas fa-user-plus"></i> Add Employee</h1>
                  </div>
                    <form class="employee" @submit.prevent="storeEmployee" enctype="multipart/form-data">
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                  <input type="text" class="form-control" id="name"  placeholder="Employee Name" v-model="form.name">
                                  <!-- <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small> -->
                                </div> 
                                <div class="form-group col-md-6">
                                  <input type="email" class="form-control" id="email"  placeholder="Email" v-model="form.email">
                                  <!-- <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small> -->
                                </div>
                              </div>
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                  <input type="text" class="form-control" id="phone"  placeholder="Contact No" v-model="form.phone">
                                  <!-- <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small> -->
                                </div> 
                                <div class="form-group col-md-6">
                                  <input type="text" class="form-control" id="address"  placeholder="Address" v-model="form.address">
                                  <!-- <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small> -->
                                </div>
                              </div>
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                   <select class="form-control" id="exampleFormControlSelect1">
                                      <option>Select Gender</option>
                                      <option>Male</option>
                                      <option>Female</option>
                                      <option>Other</option>
                                      </select>
                                  <!-- <small class="text-danger" v-if="errors.nid">{{ errors.nid[0] }}</small> -->
                                </div> 
                                <div class="form-group col-md-6">
                                   <input type="text" class="form-control" id="nid"  placeholder="National ID Card No" v-model="form.nid">
                                  <!-- <small class="text-danger" v-if="errors.joining_date">{{ errors.joining_date[0] }}</small> -->
                                </div>
                                
                              </div>
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                  <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                      </div>
                                      <input type="text" class="form-control" id="salary" placeholder="Salary" v-model="form.salary" >
                                      <div class="input-group-append">
                                      </div>
                                  </div>
                                  <!-- <small class="text-danger" v-if="errors.salary">{{ errors.salary[0] }}</small> -->
                                </div>
                                <div class="form-group col-md-6">
                                  <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">Joining Date</span>
                                      </div>
                                  <input type="date" class="form-control" id="joining_date"  placeholder="Joining Date" v-model="form.joining_date">
                                      <div class="input-group-append">
                                      </div>
                                  </div>
                                  <!-- <small class="text-danger" v-if="errors.salary">{{ errors.salary[0] }}</small> -->
                                </div>
                                 
                              </div>
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input"  id="customFile">
                                      <!-- <small class="text-danger" v-if="errors.photo">{{ errors.photo[0] }}</small> -->
                                      <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div> 
                                <div class="form-group col-md-6">
                                  <img src="form.photo" style="height:60px; width:60px;" alt="">
                                </div>
                              </div>
                            <div class="form-group">
                              <button type="submit" id="submit" class="btn btn-info btn-block">Submit</button>
                            </div>
                    </form>
                  <hr>
                  
                  <div class="text-center">
                  </div>
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
                name:null,
                email:null,
                phone:null,
                salary:null,
                address:null,
                photo:null,
                nid:null,
                joining_date:null,
            }
        }
    },
    methods:{
        storeEmployee(){

        }
    },

  };
</script>

<style>

</style>
