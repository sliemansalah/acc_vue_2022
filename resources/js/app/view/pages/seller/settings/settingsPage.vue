<template>
  <div>
    <div class="mt-3">
      <label>
        <router-link to="/">{{ $t("Home") }}</router-link>
      </label>
      <span>/</span>
      <label active>{{ $t("Settings") }}</label>
    </div>
    <h4 class="mt-3">{{ $t("Settings") }}</h4>

    <b-card class="mt-3">
      <template #header>
        <h5 style="font-weight: bold; color: #000">
          {{ $t("StoreInformation") }}
        </h5>
      </template>
      <b-card-text class="text-center">
        <div class="text-center">

          <div class="image-block2">
            <img
              v-if="inputs.image"
              width="200"
              height="200"
              style="border: 1px solid #ccc"
              :src="inputs.image"
              alt=""
            />
            <img
              v-else
              src="/assets/images/store.jpg"
              width="200"
              height="200"
              style="border: 1px solid #ccc"
              alt=""
            />
            <input
              type="file"
              class="chooseImage2"
              @change="changeImage($event)"
            />
          </div>

          <div class="row mt-3">
            <div class="col-md-2"></div>
            <div class="col-md-2">
              {{ $t("Name") }}
            </div>
            <div class="col-md-4">
              <b-input type="text" v-model="inputs.name"></b-input>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-2"></div>
            <div class="col-md-2">
              {{ $t("Description") }}
            </div>
            <div class="col-md-4">
              <b-textarea
                rows="4"
                type="text"
                v-model="inputs.description"
              ></b-textarea>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-4 center-block">
              <b-button @click="updateStore" class="btn btn-info custom-btn1">{{
                $t("Save")
              }}</b-button>
            </div>
          </div>
        </div>
      </b-card-text>
    </b-card>

    <b-card class="mt-50">
      <template #header>
        <h5 style="font-weight: bold; color: #000">
          {{ $t("StoreActivity") }}
        </h5>
      </template>
      <b-card-text class="text-center">
        <div>
          <p class="text-center" style="font-weight: bold; color: #000">
            {{ $t("StoreActivityHeader") }}
          </p>
          <div class="row mt-3">
            <div class="col-md-4 center-block">
              <el-select
                v-model="inputs.activities"
                multiple
                filterable
                clearable
              >
                <el-option-group
                  v-for="group in activities"
                  :key="group.name"
                  :label="group.name"
                >
                  <el-option
                    v-for="item in group.activities"
                    :key="item.id"
                    :label="item.name"
                    :value="item.id"
                  >
                  </el-option>
                </el-option-group>
              </el-select>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-4 center-block">
              <b-button @click="updateStore" class="btn btn-info custom-btn1">{{
                $t("Save")
              }}</b-button>
            </div>
          </div>
        </div>
      </b-card-text>
    </b-card>

    <b-card class="mt-50">
      <template #header>
        <h5 style="font-weight: bold; color: #000">
          {{ $t("StoreSupport") }}
        </h5>
      </template>
      <b-card-text class="text-center">
        <div>
          <div class="alert alert-danger" role="alert">
            {{ $t("StoreSupportHeader") }}
          </div>

          <div class="row mt-3">
            <div class="col-md-2"></div>
            <div class="col-md-2">
              {{ $t("Mobile") }}
            </div>
            <div class="col-md-4">
              <b-input type="text" v-model="inputs.mobile_support1"></b-input>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-2"></div>
            <div class="col-md-2">
              {{ $t("Watsapp") }}
            </div>
            <div class="col-md-4">
              <b-input type="text" v-model="inputs.mobile_support2"></b-input>
            </div>
          </div>

          <!-- <div class="row mt-3">
              <div class="col-md-2"></div>
               <div class="col-md-2">
                   {{$t('Phone')}}
               </div>
            <div class="col-md-4">
              <b-input
                type="text"
                v-model="inputs.phone_support"
              ></b-input>
            </div>
          </div> -->

          <div class="row mt-3">
            <div class="col-md-2"></div>
            <div class="col-md-2">
              {{ $t("Teligram") }}
            </div>
            <div class="col-md-4">
              <b-input type="text" v-model="inputs.telegram_support"></b-input>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-2"></div>
            <div class="col-md-2">
              {{ $t("Email") }}
            </div>
            <div class="col-md-4">
              <b-input type="text" v-model="inputs.email_support"></b-input>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-4 center-block">
              <b-button @click="updateStore" class="btn btn-info custom-btn1">{{
                $t("Save")
              }}</b-button>
            </div>
          </div>
        </div>
      </b-card-text>
    </b-card>

    <b-card class="mt-50">
      <template #header>
        <h5 style="font-weight: bold; color: #000">
          {{ $t("StoreContact") }}
        </h5>
      </template>
      <b-card-text class="text-center">
        <div>
          <div class="row mt-3">
            <div class="col-md-2"></div>
            <div class="col-md-2">
              {{ $t("Instigram") }}
            </div>
            <div class="col-md-4">
              <b-input type="text" v-model="inputs.instagram"></b-input>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-2"></div>
            <div class="col-md-2">
              {{ $t("Twitter") }}
            </div>
            <div class="col-md-4">
              <b-input type="text" v-model="inputs.twitter"></b-input>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-2"></div>
            <div class="col-md-2">
              {{ $t("Facebook") }}
            </div>
            <div class="col-md-4">
              <b-input type="text" v-model="inputs.facebook"></b-input>
            </div>
          </div>

          <!-- <div class="row mt-3">
              <div class="col-md-2"></div>
               <div class="col-md-2">
                   {{$t('Youtube')}}
               </div>
            <div class="col-md-4">
              <b-input
                type="text"
                v-model="inputs.youtube"
              ></b-input>
            </div>
          </div> -->

          <div class="row mt-3">
            <div class="col-md-2"></div>
            <div class="col-md-2">
              {{ $t("Snapshat") }}
            </div>
            <div class="col-md-4">
              <b-input type="text" v-model="inputs.snapchat"></b-input>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-4 center-block">
              <b-button @click="updateStore" class="btn btn-info custom-btn1">{{
                $t("Save")
              }}</b-button>
            </div>
          </div>
        </div>
      </b-card-text>
    </b-card>

    <b-card class="mt-50">
      <template #header>
        <h5 style="font-weight: bold; color: #000">
          {{ $t("AnotherLinks") }}
        </h5>
      </template>
      <b-card-text class="text-center">
        <div>
          <div class="row mt-3">
            <div class="col-md-2"></div>
            <div class="col-md-2">
              {{ $t("KnownLink") }}
            </div>
            <div class="col-md-4">
              <b-input type="text" v-model="inputs.link"></b-input>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-2"></div>
            <div class="col-md-2">
              {{ $t("IphoneLink") }}
            </div>
            <div class="col-md-4">
              <b-input type="text" v-model="inputs.link_iphone"></b-input>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-2"></div>
            <div class="col-md-2">
              {{ $t("AndroidLink") }}
            </div>
            <div class="col-md-4">
              <b-input type="text" v-model="inputs.link_android"></b-input>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-4 center-block">
              <b-button @click="updateStore" class="btn btn-info custom-btn1">{{
                $t("Save")
              }}</b-button>
            </div>
          </div>
        </div>
      </b-card-text>
    </b-card>
  </div>
</template>
<script>
export default {
  data() {
    return {
      inputs: {
        id: 0,
        image: null,
        name: "",
        description: "",
        activities: [],
        email_support: "",
        mobile_support1: "",
        mobile_support2: "",
        facebook: "",
        instagram: "",
        link: "",
        link_android: "",
        link_iphone: "",
        telegram_support: "",
        twitter: "",
        snapchat: "",
        // youtube: "",
        // phone_support: "",
      },
      activities: [],
    };
  },
  methods: {
    changeImage(event) {
      if (event.target.files.length) {
        this.inputs.image = event.target.files[0];
        this.$store
          .dispatch("settings/updateImage", this.inputs)
          .then((_) => {
            this.$notify.success({
              duration: 3000,
              message: this.$t("ImageUpdatedSuccessfully"),
              title: this.$t("ImageUpdated"),
              customClass: "top-center",
            });
            this.initData(this.filters);
          })
          .catch((_) => {
            this.$notify.error({
              duration: 3000,
              message: this.$t("ImageUpdatedFailed"),
              title: this.$t("ImageUpdated"),
              customClass: "top-center",
            });
          });
      }
    },
    initData() {
      this.$store
        .dispatch("settings/getActivities")
        .then((res) => {
          this.activities = res.data;
        })
        .catch((err) => {});

      this.$store.dispatch("settings/findData", 1).then((res) => {
        this.inputs = res.data;
      });
    },
    updateStore() {
      this.inputs.id = 1;
      this.$store
        .dispatch("settings/updateData", this.inputs)
        .then((res) => {
          this.activities = res.data;
          this.$notify.success({
            duration: 3000,
            message: this.$t("UpdatedSuccessfully"),
            title: this.$t("Updated"),
            customClass: "top-center",
          });
        })
        .catch((err) => {});
    },
  },
  created() {
    this.initData();
  },
};
</script>
