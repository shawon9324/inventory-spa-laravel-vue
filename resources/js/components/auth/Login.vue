<template>
  <div>
    <div class="row justify-content-center"  style="margin-top:70px;">
      <div class="col-xl-4 col-lg-4 col-md-4">
        <div class="card shadow-sm my-5 ">
          <div class="card-body p-0 ">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">
                      <i class="fas fa-sign-in-alt"></i> Login
                    </h1>
                  </div>
                  <form class="user" @submit.prevent="login">
                    <div class="form-group">
                      <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter Email Address" v-model="form.email" />
                      <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" id="password" placeholder="Password" v-model="form.password" />
                      <small class="text-danger" v-if="errors.password">{{ errors.password[0] }}</small>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small" style="line-height: 1.5rem">
                        <input type="checkbox" class="custom-control-input" id="customCheck" />
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" id="login" class="btn btn-info btn-block">
                        Login
                      </button>
                    </div>
                    <hr />
                  </form>
                  <div class="text-center">
                    <a class="font-weight-bold small">
                      <router-link to="/register">Create an Account!</router-link>
                    </a>
                  </div>
                  <div class="text-center">
                    <a class="font-weight-bold small">
                      <router-link to="/forget">Forget Password</router-link>
                    </a>
                  </div>
                  <div class="text-center"></div>
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
          email: null,
          password: null
        },
        errors: {},
      };
    },
    methods: {
      login() {
        axios
          .post("/api/auth/login", this.form)
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
          .catch(error => (this.errors = error.response.data.errors))
          .catch(errors =>
            Toast.fire({
              icon: "error",
              title: "Wrong Email & Password"
            })
          );
      }
    }
  };
</script>

<style>

</style>
