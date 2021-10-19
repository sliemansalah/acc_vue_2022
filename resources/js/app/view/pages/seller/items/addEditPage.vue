<template>
  <div>
    <div class="mt-3">
      <label>
        <router-link to="/">{{ $t("Home") }}</router-link>
      </label>
      <span>/</span>
      <router-link to="/items">{{ $t("Items") }}</router-link>
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
              :to="{ name: 'items' }"
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
                :class="{
                  'has-error': errors.has('addEditValidation.item_type_id'),
                }"
              >
                <label class="control-label">{{ $t("ItemTypeName") }}</label>
                <label class="required">*</label>
                <el-select
                  v-model="addEditObj.item_type_id"
                  v-validate="'required'"
                  name="item_type_id"
                  :data-vv-as="$t('ItemTypeName')"
                  data-vv-scope="addEditValidation"
                  :placeholder="$t('Select')"
                  clearable
                  filterable
                  :disabled="viewOnly"
                >
                  <el-option
                    v-for="option in itemTypes"
                    :value="option.value"
                    :label="option.label"
                    :key="option.value"
                  >
                  </el-option>
                </el-select>
                <div
                  class="help-block"
                  v-if="errors.has('addEditValidation.item_type_id')"
                >
                  {{ errors.first("addEditValidation.item_type_id") }}
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div
                class="form-group"
                :class="{ 'has-error': errors.has('addEditValidation.price') }"
              >
                <label class="control-label">{{ $t("Price") }}</label>
                <label class="required">*</label>
                <input
                  type="text"
                  name="price"
                  class="form-control"
                  v-model="addEditObj.price"
                  v-validate="'required|decimal'"
                  data-vv-scope="addEditValidation"
                  :data-vv-as="$t('Price')"
                  :disabled="viewOnly"
                />
                <div
                  class="help-block"
                  v-if="errors.has('addEditValidation.price')"
                >
                  {{ errors.first("addEditValidation.price") }}
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div
                class="form-group"
                :class="{ 'has-error': errors.has('addEditValidation.qty') }"
              >
                <label class="control-label">{{ $t("Quantity") }}</label>
                <!-- <label class="required">*</label> -->
                <input
                  type="text"
                  name="qty"
                  class="form-control"
                  v-model="addEditObj.qty"
                  v-validate="'decimal'"
                  data-vv-scope="addEditValidation"
                  :data-vv-as="$t('Quantity')"
                  :disabled="viewOnly"
                />
                <div
                  class="help-block"
                  v-if="errors.has('addEditValidation.qty')"
                >
                  {{ errors.first("addEditValidation.qty") }}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div
                class="form-group"
                :class="{ 'has-error': errors.has('addEditValidation.is_offer') }"
              >
                <label class="control-label">{{ $t("IsOffer") }}</label>
                <b-checkbox
                  name="qty"
                  class=""
                  v-model="addEditObj.is_offer"
                  v-validate="''"
                  data-vv-scope="addEditValidation"
                  :data-vv-as="$t('IsOffer')"
                  :disabled="viewOnly"
                />
                <div
                  class="help-block"
                  v-if="errors.has('addEditValidation.is_offer')"
                >
                  {{ errors.first("addEditValidation.is_offer") }}
                </div>
              </div>
            </div>
            <template v-if="addEditObj.is_offer">
              <div class="col-md-3">
                <div
                  class="form-group"
                  :class="{ 'has-error': errors.has('addEditValidation.special_price') }"
                >
                  <label class="control-label">{{ $t("SpecialPrice") }}</label>
                  <label class="required">*</label>
                  <input
                    type="text"
                    name="special_price"
                    class="form-control"
                    v-model="addEditObj.special_price"
                    v-validate="'required|decimal'"
                    data-vv-scope="addEditValidation"
                    :data-vv-as="$t('SpecialPrice')"
                    :disabled="viewOnly"
                  />
                  <div
                    class="help-block"
                    v-if="errors.has('addEditValidation.special_price')"
                  >
                    {{ errors.first("addEditValidation.special_price") }}
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div
                  class="form-group"
                  :class="{ 'has-error': errors.has('addEditValidation.special_price_start') }"
                >
                  <label class="control-label">{{ $t("SpecialPriceStart") }}</label>
                  <!-- <label class="required">*</label> -->
                  <el-date-picker
                    type="date"
                    name="special_price_start"
                    class="w-100"
                    v-model="addEditObj.special_price_start"
                    v-validate="''"
                    data-vv-scope="addEditValidation"
                    :data-vv-as="$t('SpecialPriceStart')"
                    :disabled="viewOnly"
                  />
                  <div
                    class="help-block"
                    v-if="errors.has('addEditValidation.special_price_start')"
                  >
                    {{ errors.first("addEditValidation.special_price_start") }}
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div
                  class="form-group"
                  :class="{ 'has-error': errors.has('addEditValidation.special_price_end') }"
                >
                  <label class="control-label">{{ $t("SpecialPriceEnd") }}</label>
                  <!-- <label class="required">*</label> -->
                  <el-date-picker
                    type="date"
                    name="special_price_end"
                    class="w-100"
                    v-model="addEditObj.special_price_end"
                    v-validate="''"
                    data-vv-scope="addEditValidation"
                    :data-vv-as="$t('SpecialPriceEnd')"
                    :disabled="viewOnly"
                  />
                  <div
                    class="help-block"
                    v-if="errors.has('addEditValidation.special_price_end')"
                  >
                    {{ errors.first("addEditValidation.special_price_end") }}
                  </div>
                </div>
              </div>
            </template>
          </div>
          <div class="row"> 
            <div class="col-md-12">
              <div
                class="form-group"
                :class="{
                  'has-error': errors.has('addEditValidation.description'),
                }"
              >
                <label class="control-label">{{ $t("Description") }}</label>
                <label class="required"></label>
                   <ckeditor 
                    v-model="addEditObj.description"
                    :config="editorConfig"
                  >
                    </ckeditor>
                <div
                  class="help-block"
                  v-if="errors.has('addEditValidation.description')"
                >
                  {{ errors.first("addEditValidation.description") }}
                </div>
              </div>
            </div>
          </div>
        </b-card>
        <categoriesList :addEditObj="addEditObj" />
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
import categoriesList from "./categoriesList";
import moment from 'moment';
export default {
  name: "itemsAddEdit",
  components: {
    categoriesList,
  },
  data() {
    return {
      id: this.$route.params.id || 0,
      idCopy: this.$route.params.idCopy || 0,
      editorConfig: {
        removePlugins: ['about', 'resize'],
      },
      itemTypes: [],
      viewOnly: false,
      addEditObj: {
        id: 0,
        image: null,
        name: "",
        item_type_id: "",
        price: "",
        qty: "",
        is_offer: false,
        special_price: "",
        special_price_start: "",
        special_price_end: "",
        selling_price: "",
        qty: "",
        status: true,
        store_id: 1,
        category: [],
      },
    };
  },
  methods: {
    saveAddEdit() {
      this.$validator.validateAll("addEditValidation").then((result) => {
        if (result) {
          if (!this.addEditObj.category.length) {
            return this.$notify.error({
              duration: 3000,
              message: this.$t("ItemMustHaveOneCategoryAtLeast"),
              title: this.$t("Error"),
              customClass: "top-center",
            });
          }
            if (this.addEditObj.special_price_start)
              this.addEditObj.special_price_start = moment(
                this.addEditObj.special_price_start
              ).format("YYYY-MM-DD");
            if (this.addEditObj.special_price_end)
              this.addEditObj.special_price_end = moment(
                this.addEditObj.special_price_end
              ).format("YYYY-MM-DD");
            this.addEditObj.image = null;
            if (this.id) {
              this.$store
                .dispatch("items/updateData", this.addEditObj)
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
                .dispatch("items/saveData", this.addEditObj)
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
            this.$router.push("/items");
          } 
      });
    },
    fillData() {
        let id= this.id? this.id: this.idCopy
        this.$store
        .dispatch("items/findData", id)
        .then((res) => {
          if(res.data.is_offer == 1) {
            res.data.is_offer= true;
          }else {
             res.data.is_offer= false;
          }
          this.addEditObj = res.data;
        })
        .catch((_) => {
          this.$notify.error({
            duration: 3000,
            message: this.$t("GetDataFailed"),
            title: this.$t("GetData"),
            customClass: "top-center",
          });
        });
    },
    initData() {
      this.$store
        .dispatch("items/getItemType")
        .then((res) => {
          this.itemTypes = res.data;
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