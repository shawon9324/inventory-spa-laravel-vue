
<template>
<div>
 <div class="row justify-content-center" style="margin-top:70px;">
      <div class="col-xl-6 col-lg-6 col-md-6">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4"><i class="fas fa-user-plus"></i> Register</h1>
                  </div>
                    <form @submit.prevent="signup">
                            <div class="form-group">
                            <input type="text" class="form-control" id="name"  placeholder="Enter Your Name"
                            v-model="form.name">
                            <small class="text-danger" v-if="errors.name">{{errors.name[0]}}</small>
                            </div>
                            <div class="form-group">
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                                placeholder="Enter Email Address" v-model="form.email">
                            <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small>

                            </div>
                            <div class="form-group">
                            <input type="password" class="form-control" id="password" placeholder="Password"
                            v-model="form.password">
                            <small class="text-danger" v-if="errors.password">{{errors.password[0]}}</small>

                            </div>
                            <div class="form-group">
                            <input type="password" class="form-control" id="password_confirmation" 
                                placeholder="Confirm Password" v-model="form.password_confirmation">
                            <small class="text-danger" v-if="errors.password_confirmation">{{errors.password_confirmation[0]}}</small>

                            </div>
                            <div class="form-group">
                            <button type="submit" id="register" class="btn btn-info btn-block">Register</button>
                            </div>
                    </form>
                  <hr>
                  <div class="text-center">
                    <a class="font-weight-bold small" > <router-link to="/">Already have an account?</router-link></a>
                  </div>
                  <div class="text-center">
                  </div>
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
            if (User.loggedIn()) {
                this.$router.push({
                    name: "home"
                });
            }
        },
        data() {
            return {
                form: {
                    name: null,
                    email: null,
                    password: null,
                    password_confirmation: null,
                },
                errors:{
                    
                }
            };
        },
        methods: {
            signup() {
                axios
                    .post("/api/auth/signup", this.form)
                    .then(res => {
                        User.responseAfterLogin(res);
                        Toast.fire({
                            icon: "success",
                            title: "Signed in successfully"
                        });
                        this.$router.push({
                            name: "home"
                        });
                    })
                    .catch(error => this.errors = error.response.data.errors)
                    
            }
        }
    };
</script>


<style type="text/css">

</style>