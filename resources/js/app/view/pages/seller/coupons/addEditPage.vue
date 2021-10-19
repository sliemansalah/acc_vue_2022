<template>
  <div>
    <div class="mt-3">
      <label>
        <router-link to="/">{{ $t("Home") }}</router-link>
      </label>
      <span>/</span>
      <router-link to="/coupons">{{ $t("Coupons") }}</router-link>
      <span>/</span>
      <label active>
        <span v-if="id && !viewOnly">{{ $t("Edit") }}</span>
        <span v-else-if="viewOnly">{{ $t("Details") }}</span>
        <span v-else>{{ $t("AddNew") }}</span>
      </label>
    </div>
    <h4 class="mt-3">
      <span v-if="id && !viewOnly">{{ $t("Edit") }}</span>
      <span v-else-if="viewOnly">{{ $t("Details") }}</span>
      <span v-else>{{ $t("AddNew") }}</span>
    </h4>
    <div class="mt-3">
      <div class="row mb-3">
        <div class="col-md-12">
          <span id="listWrapper">
            <router-link
              variant="primary"
              tag="button"
              :to="{ name: 'coupons' }"
              class="btn mb-2 btn-transition btn-outline-secondary"
            >
              <i class="pe-7s-back btn-icon-wrapper"></i>
              {{ $t("BackToList") }}
            </router-link>
          </span>
        </div>
      </div>
      <div ref="form">
        <b-card>
          <div class="row">
            <div class="col-md-3">
              <div
                class="form-group"
                :class="{ 'has-error': errors.has('addEditValidation.code') }"
              >
                <label class="control-label">{{ $t("Code") }}</label>
                <label class="required">*</label>
                 <b-input-group>
                <template #append>
                  <b-input-group-text @click="generateCode" class="cursorPointer"><i class="fa fa-plus"></i></b-input-group-text>
                </template>
               <input
                  type="text"
                  name="code"
                  class="form-control"
                  v-validate="'required'"
                  data-vv-scope="addEditValidation"
                  :data-vv-as="$t('Code')"
                  v-model="addEditObj.code"
                  :disabled="viewOnly"
                />
              </b-input-group>
                
                <div
                  class="help-block"
                  v-if="errors.has('addEditValidation.code')"
                >
                  {{ errors.first("addEditValidation.code") }}
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div
                class="form-group"
                :class="{ 'has-error': errors.has('addEditValidation.name') }"
              >
                <label class="control-label">{{ $t("Name") }}</label>
                <label class="required">*</label>
                <input
                  type="text"
                  name="name"
                  class="form-control"
                  v-validate="'required'"
                  data-vv-scope="addEditValidation"
                  :data-vv-as="$t('Name')"
                  v-model="addEditObj.name"
                  :disabled="viewOnly"
                />
                <div
                  class="help-block"
                  v-if="errors.has('addEditValidation.name')"
                >
                  {{ errors.first("addEditValidation.name") }}
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div
                class="form-group"
                :class="{ 'has-error': errors.has('addEditValidation.is_percent') }"
              >
                <label class="control-label">{{ $t("IsPercent") }}</label>
                <b-checkbox
                  type="text"
                  name="is_percent"
                  class=""
                  v-validate="'required'"
                  data-vv-scope="addEditValidation"
                  :data-vv-as="$t('IsPercent')"
                  v-model="addEditObj.is_percent"
                  :disabled="viewOnly"
                />
                <div
                  class="help-block"
                  v-if="errors.has('addEditValidation.is_percent')"
                >
                  {{ errors.first("addEditValidation.is_percent") }}
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div
                class="form-group"
                :class="{ 'has-error': errors.has('addEditValidation.value') }"
              >
                <label class="control-label">{{ $t("Value") }}</label>
                <label class="required">*</label>
                <input
                  type="text"
                  name="value"
                  class="form-control"
                  v-validate="'required'"
                  data-vv-scope="addEditValidation"
                  :data-vv-as="$t('Value')"
                  v-model="addEditObj.value"
                  :disabled="viewOnly"
                />
                <div
                  class="help-block"
                  v-if="errors.has('addEditValidation.value')"
                >
                  {{ errors.first("addEditValidation.value") }}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div
                class="form-group"
                :class="{ 'has-error': errors.has('addEditValidation.start_date') }"
              >
                <label class="control-label">{{ $t("StartDateOfCoupon") }}</label>
                <label class="required">*</label>
                <el-date-picker
                    type="date"
                    name="start_date"
                    class="w-100"
                    v-model="addEditObj.start_date"
                    v-validate="'required'"
                    data-vv-scope="addEditValidation"
                    :data-vv-as="$t('StartDateOfCoupon')"
                    :disabled="viewOnly"
                />
                <div
                  class="help-block"
                  v-if="errors.has('addEditValidation.start_date')"
                >
                  {{ errors.first("addEditValidation.start_date") }}
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div
                class="form-group"
                :class="{ 'has-error': errors.has('addEditValidation.end_date') }"
              >
                <label class="control-label">{{ $t("EndDateOfCoupon") }}</label>
                <label class="required">*</label>
                <el-date-picker
                    type="date"
                    name="end_date"
                    class="w-100"
                    v-model="addEditObj.end_date"
                    v-validate="'required'"
                    data-vv-scope="addEditValidation"
                    :data-vv-as="$t('EndDateOfCoupon')"
                    :disabled="viewOnly"
                />
                <div
                  class="help-block"
                  v-if="errors.has('addEditValidation.end_date')"
                >
                  {{ errors.first("addEditValidation.end_date") }}
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div
                class="form-group"
                :class="{ 'has-error': errors.has('addEditValidation.usage_limit_per_coupon') }"
              >
                <label class="control-label">{{ $t("UsageLimitPerCoupon") }}</label>
                <label class="required">*</label>
                <input
                  type="text"
                  name="usage_limit_per_coupon"
                  class="form-control"
                  v-validate="'required'"
                  data-vv-scope="addEditValidation"
                  :data-vv-as="$t('UsageLimitPerCoupon')"
                  v-model="addEditObj.usage_limit_per_coupon"
                  :disabled="viewOnly"
                />
                <div
                  class="help-block"
                  v-if="errors.has('addEditValidation.usage_limit_per_coupon')"
                >
                  {{ errors.first("addEditValidation.usage_limit_per_coupon") }}
                </div>
              </div>
            </div>
             <div class="col-md-3">
              <div
                class="form-group"
                :class="{ 'has-error': errors.has('addEditValidation.usage_limit_per_customer') }"
              >
                <label class="control-label">{{ $t("UsageLimitPerCustomer") }}</label>
                <label class="required">*</label>
                <input
                  type="text"
                  name="usage_limit_per_customer"
                  class="form-control"
                  v-validate="'required'"
                  data-vv-scope="addEditValidation"
                  :data-vv-as="$t('UsageLimitPerCustomer')"
                  v-model="addEditObj.usage_limit_per_customer"
                  :disabled="viewOnly"
                />
                <div
                  class="help-block"
                  v-if="errors.has('addEditValidation.usage_limit_per_customer')"
                >
                  {{ errors.first("addEditValidation.usage_limit_per_customer") }}
                </div>
              </div>
            </div>
          </div>
        </b-card>
        <itemsList :addEditObj="addEditObj" />
        <b-button
        v-if="!viewOnly"
        class="mt-3"
        @click="saveAddEdit"
         variant="primary">
          {{ $t("Save") }}
        </b-button>
      </div>
    </div>
  </div>
</template>

<script>
import itemsList from "./itemsList";
import moment from 'moment';

export default {
  name: "couponsAddEdit",
  components: {
    itemsList,
  },
  data() {
    return {
      id: this.$route.params.id || 0,
      idCopy: this.$route.params.idCopy || 0,
      viewOnly: false,
      addEditObj:{
        id:0,
        code: '',
        name: '',
        is_percent: false,
        value: '',
        start_date: '',
        end_date: '',
        usage_limit_per_coupon: '',
        usage_limit_per_customer: '',
        status: true,
        store_id: 1,
        items: [],
      },
    };
  },
  methods: {
  generateNewCode(length) {
    var result           = [];
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
      result.push(characters.charAt(Math.floor(Math.random() * 
 charactersLength)));
   }
   return result.join('');
},
    generateCode() {
      this.addEditObj.code = this.generateNewCode(10);
    },
    saveAddEdit() {
      this.$validator.validateAll("addEditValidation").then((result) => {
        if (result) {
          this.addEditObj.start_date = moment(this.addEditObj.start_date).format("YYYY-MM-DD");
          this.addEditObj.end_date = moment(this.addEditObj.end_date).format("YYYY-MM-DD");
          if (!this.addEditObj.items.length) {
            return this.$notify.error({
              duration: 3000,
              message: this.$t("CouponMustHaveOneItemAtLeast"),
              title: this.$t("Error"),
              customClass: "top-center",
            });
          }
            this.addEditObj.image = null;
            if (this.id) {
              this.$store
                .dispatch("coupons/updateData", this.addEditObj)
                .then(() => {
                  this.$notify.success({
                      duration: 3000,
                      message: this.$t("UpdatedSuccessfully"),
                      title: this.$t("Update"),
                      customClass: "top-center",
                  });
                })
                .catch((error) => {
                  this.$notify.error({
                      duration: 3000,
                      message: error,
                      title: this.$t("Error"),
                      customClass: "top-center",
                  });
                })
            } else {
              this.$store
                .dispatch("coupons/saveData", this.addEditObj)
                .then(() => {
                   this.$notify.success({
                      duration: 3000,
                      message: this.$t("SavedSuccessfully"),
                      title: this.$t("Save"),
                      customClass: "top-center",
                  });
                })
                .catch((error) => {
                    this.$notify.error({
                      duration: 3000,
                      message: error,
                      title: this.$t("Error"),
                      customClass: "top-center",
                  });
                })
            }
            this.$router.push("/coupons");
          } 
      });
    },
    fillData() {
        let id= this.id? this.id: this.idCopy
        this.$store
        .dispatch("coupons/findData", id)
        .then((res) => {
          if(res.data.is_offer == 1) {
            res.data.is_offer= true;
          }else {
             res.data.is_offer= false;
          }
          this.addEditObj = res.data;
        })
        .catch(error => {
          // if(error.response.status == 500) {
          //     localStorage.removeItem("token");
          //     window.location.href = "/";
          // }
          this.$notify.error({
              duration: 3000,
              message: this.$t("GetDataFailed"),
              title: this.$t("GetData"),
              customClass: "top-center",
          }); 
        })
    },
    initData() {
    if(this.id || this.idCopy) {
        this.fillData();
    }

    if(this.$route.path.toString().includes("details/"))  this.viewOnly= true;
    },
  },
  created() {
    this.initData();
  },
};
</script>