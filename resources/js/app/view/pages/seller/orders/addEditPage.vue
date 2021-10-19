<template>
  <div>
    <div class="mt-3">
      <label>
        <router-link to="/">{{ $t("Home") }}</router-link>
      </label>
      <span>/</span>
      <router-link to="/orders">{{ $t("Orders") }}</router-link>
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
              :to="{ name: 'orders' }"
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
            <div class="col-md-4">
              <div
                class="form-group"
                :class="{ 'has-error': errors.has('addEditValidation.customer_id') }"
              >
                <label class="control-label">{{ $t("Customer") }}</label>
                <label class="required">*</label>
                 <el-select
                  v-model="addEditObj.customer_id"
                  v-validate="'required'"
                  name="customer_id"
                  :data-vv-as="$t('Customer')"
                  data-vv-scope="addEditValidation"
                  :placeholder="$t('Select')"
                  clearable
                  filterable
                  :disabled="viewOnly"
                >
                  <el-option
                    v-for="option in customers"
                    :value="option.id"
                    :label="option.first_name + ' ' + option.last_name "
                    :key="option.id"
                  >
                  </el-option>
                </el-select>
                <div
                  class="help-block"
                  v-if="errors.has('addEditValidation.customer_id')"
                >
                  {{ errors.first("addEditValidation.customer_id") }}
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div
                class="form-group"
                :class="{ 'has-error': errors.has('addEditValidation.payment_method_id') }"
              >
                <label class="control-label">{{ $t("PaymentMethod") }}</label>
                <label class="required">*</label>
                 <el-select
                  v-model="addEditObj.payment_method_id"
                  v-validate="'required'"
                  name="payment_method_id"
                  :data-vv-as="$t('PaymentMethod')"
                  data-vv-scope="addEditValidation"
                  :placeholder="$t('Select')"
                  clearable
                  filterable
                  :disabled="viewOnly"
                >
                  <el-option
                    v-for="option in paymentMethods"
                    :value="option.id"
                    :label="option.name"
                    :key="option.id"
                  >
                  </el-option>
                </el-select>
                <div
                  class="help-block"
                  v-if="errors.has('addEditValidation.payment_method_id')"
                >
                  {{ errors.first("addEditValidation.payment_method_id") }}
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div
                class="form-group"
                :class="{ 'has-error': errors.has('addEditValidation.coupon_code') }"
              >
                <label class="control-label">{{ $t("CouponCode") }}</label>
                <input
                  type="text"
                  name="coupon_code"
                  class="form-control"
                  v-validate="''"
                  data-vv-scope="addEditValidation"
                  :data-vv-as="$t('CouponCode')"
                  v-model="addEditObj.coupon_code"
                  :disabled="viewOnly"
                />
                <div
                  class="help-block"
                  v-if="errors.has('addEditValidation.coupon_code')"
                >
                  {{ errors.first("addEditValidation.coupon_code") }}
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

export default {
  name: "ordersAddEdit",
  components: {
    itemsList,
  },
  data() {
    return {
      customers: [],
      id: this.$route.params.id || 0,
      idCopy: this.$route.params.idCopy || 0,
      viewOnly: false,
      paymentMethods: [],
      addEditObj:{
        id:0,
        customer_id: '',
        payment_method_id: '',
        coupon_code: '',
        status: 0,
        store_id: 1,
        item: [],
      },
    };
  },
  methods: {
    saveAddEdit() {
      this.$validator.validateAll("addEditValidation").then((result) => {
        if (result) {
          if (!this.addEditObj.item.length) {
            return this.$notify.error({
              duration: 3000,
              message: this.$t("OrderMustHaveOneItemAtLeast"),
              title: this.$t("Error"),
              customClass: "top-center",
            });
          }
            if (this.id) {
              this.$store
                .dispatch("orders/updateData", this.addEditObj)
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
                .dispatch("orders/saveData", this.addEditObj)
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
            this.$router.push("/orders");
          } 
      });
    },
    fillData() {
        let id= this.id? this.id: this.idCopy
        this.$store
        .dispatch("orders/findData", id)
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

    this.$store.dispatch('customers/getData').then(res => {
      this.customers= res.data.resources;
    });

    this.paymentMethods = [
      {
        id: 1,
        name: 'نقدي'
      },
      {
        id: 2,
        name: 'بايبال'
      },
      {
        id: 3,
        name: 'بيونير'
      }
    ]
    },
  },
  created() {
    this.initData();
  },
};
</script>