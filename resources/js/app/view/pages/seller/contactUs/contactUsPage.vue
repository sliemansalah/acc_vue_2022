<template>
  <div>
    <div class="mt-3">
      <label>
        <router-link to="/">{{ $t("Home") }}</router-link>
      </label>
      <span>/</span>
      <label active>{{ $t("ContactUs") }}</label>
    </div>
    <h4 class="mt-3">{{ $t("ContactUs") }}</h4>

    <b-card class="mt-3">
      <template #header>
        <h5 style="font-weight: bold; color: #000">
          {{ $t("ContactUsInformation") }}
        </h5>
      </template>
      <b-card-text class="text-center">
        <div class="text-center">
          <div class="row mt-3">
            <b-col md="2"></b-col>
            <b-col md="4">
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
                  v-model="inputs.name"
                  v-validate="'required'"
                  data-vv-scope="addEditValidation"
                  :data-vv-as="$t('Name')"
                />
                <div
                  class="help-block"
                  v-if="errors.has('addEditValidation.name')"
                >
                  {{ errors.first("addEditValidation.name") }}
                </div>
              </div>
            </b-col>
            <b-col md="4">
              <div
                class="form-group"
                :class="{ 'has-error': errors.has('addEditValidation.email') }"
              >
                <label class="control-label">{{ $t("Email") }}</label>
                <label class="required">*</label>
                <input
                  type="text"
                  name="email"
                  class="form-control"
                  v-model="inputs.email"
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
            </b-col>
          </div>

          <div class="row mt-3">
            <b-col md="2"></b-col>
            <b-col md="8">
              <div
                class="form-group"
                :class="{
                  'has-error': errors.has('addEditValidation.message'),
                }"
              >
                <label class="control-label">{{ $t("Message") }}</label>
                <label class="required">*</label>
                <ckeditor
                  name="message"
                  v-model="inputs.message"
                  :config="editorConfig"
                  v-validate="'required'"
                  data-vv-scope="addEditValidation"
                  :data-vv-as="$t('Message')"
                >
                </ckeditor>
                <div
                  class="help-block"
                  v-if="errors.has('addEditValidation.message')"
                >
                  {{ errors.first("addEditValidation.message") }}
                </div>
              </div>
            </b-col>
          </div>

          <div class="row mt-3">
            <b-col md="2"></b-col>
            <b-col md="8">
              <div
                class="form-group"
                :class="{
                  'has-error': errors.has('addEditValidation.attachments'),
                }"
              >
                <label class="control-label">{{ $t("Attachments") }}</label>
                <label class="required">*</label>
                <b-form-file
                  multiple
                  name="attachments"
                  class="form-control"
                  v-model="inputs.attachments"
                  v-validate="'required'"
                  data-vv-scope="addEditValidation"
                  :data-vv-as="$t('Attachments')"
                >
                </b-form-file>
                <div
                  class="help-block"
                  v-if="errors.has('addEditValidation.attachments')"
                >
                  {{ errors.first("addEditValidation.attachments") }}
                </div>
              </div>
            </b-col>
          </div>

          <div class="row mt-3">
            <div class="col-md-4 center-block">
              <b-button @click="sendMessage" class="btn btn-info custom-btn1">{{
                $t("Send")
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
        name: "",
        email: "",
        attachments: [],
        message: "",
      },
      editorConfig: {
        removePlugins: ["about", "resize"],
      },
    };
  },
  methods: {
    clearData() {
      this.inputs = {
        id: 0,
        name: "",
        email: "",
        attachments: [],
        message: "",
      };
      this.$validator.reset();
    },
    sendMessage() {
      this.$validator.validateAll("addEditValidation").then((result) => {
        if (result) {
          this.$store
            .dispatch("contact_us/saveData", this.inputs)
            .then((res) => {
              this.activities = res.data;
              this.$notify.success({
                duration: 3000,
                message: this.$t("SendSuccessfully"),
                title: this.$t("ContactUs"),
                customClass: "top-center",
              });
              this.clearData();
            })
            .catch((err) => {});
        }
      });
    },
  },
};
</script>

<style>
.form-file-text {
  position: relative;
  right: 80px;
}
</style>