<template>
  <div style="margin-top:100px;margin-right:100px;margin-left:100px;">
      <el-card>
        <div class="mb-4 text-center">
          <img width="300" height="150" src="/assets/images/logo.png" alt="" />
        </div>
        <div class="row">
          <h3 class="text-center text-uppercase mb-4">{{ $t("Login") }}</h3>
          <hr />
        </div>

        <el-row>
            <el-col :md="10" :offset="7">
              <div
                class="form-group"
                :class="{ 'has-error': errors.has('addEditValidation.email') }"
              >
                <h4 class="mb-3">{{ $t("Email") }} <span class="required">*</span></h4>
                <el-input
                  type="email"
                  name="email"
                  class="form-control"
                  v-model="object.email"
                  v-validate="'required|email'"
                  data-vv-scope="addEditValidation"
                  :data-vv-as="$t('Email')"
                />
                <div
                  class="help-block"
                  v-if="errors.has('addEditValidation.email')"
                >
                  {{ errors.first("addEditValidation.email") }}
                </div>
              </div>
            </el-col>
            
        </el-row>

         <el-row class="mt-3">
            <el-col :md="10" :offset="7">
              <div
                class="form-group"
                :class="{ 'has-error': errors.has('addEditValidation.password') }"
              >
                <h4 class="mb-3">{{ $t("Password") }} <span class="required">*</span></h4>
                <el-input
                  type="password"
                  name="password"
                  class="form-control"
                  v-model="object.password"
                  v-validate="'required'"
                  data-vv-scope="addEditValidation"
                  :data-vv-as="$t('Password')"
                />
                <div
                  class="help-block"
                  v-if="errors.has('addEditValidation.password')"
                >
                  {{ errors.first("addEditValidation.password") }}
                </div>
              </div>
            </el-col>
            
        </el-row>

        <el-row class="mt-3">
            <el-col :md="10" :offset="7">
              <el-button @click="login" style="width:100%;" type="primary">{{ $t("Login") }}</el-button>
            </el-col>
            
        </el-row>

      </el-card>
  </div>
</template>

<script>
export default {
  data() {
    return {
      object: {
        email: "",
        password: "",
      },
    };
  },
  methods: {
    login() {
      this.$validator.validateAll("addEditValidation").then((valid) => {
        if (valid) {
          this.$store
            .dispatch("auth/login", this.object)
            .then((result) => {
              this.$root.notifySuccess("Login", result);
              this.$root.loginSuccess(result);
            })
            .catch((error) => {
              console.log(error);
              this.$root.notifyError("Login", error);
            });
        }
      });
    },
  },
};
</script>

<style>
</style>