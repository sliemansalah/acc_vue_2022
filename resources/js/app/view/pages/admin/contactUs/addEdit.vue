<template>
  <form ref="form" @submit.stop.prevent="saveAddEdit">
    <b-row>
      <b-col md="12">
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
            v-model="addEditObj.message"
            :config="editorConfig"
            v-validate="'required'"
            data-vv-scope="addEditValidation"
            :data-vv-as="$t('Message')"
            :disabled="viewMode"
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
    </b-row>

    <b-row>
        <h4 class="mr-3">{{$t('Attachments')}}</h4>
        <b-button @click="open(attachment)" class="mr-2 ml-2" variant="primary" v-for="(attachment, index) in addEditObj.attachments" :key="index">
            {{index+1}}
        </b-button>
    </b-row>

    <button
      type="button"
      class="btn c-ml-2 mb-2 btn-icon btn-secondary float-left"
      @click="$emit('closeAddEdit')"
    >
      {{ $t("Close") }}
    </button>
    <b-button
      v-if="editMode"
      type="primary"
      variant="primary"
      class="float-left ml-2"
    >
      {{ $t("Save") }}
    </b-button>
  </form>
</template>

<script>
export default {
  name: "itemsAddEdit",
  props: ["addEditObj", "items", "viewMode", "editMode"],
  data() {
    return {
      button: {
        loading: false,
        dataStyle: "zoom-out",
        progress: 0,
      },
      type: "text",
      editorConfig: {
        removePlugins: ["about", "resize"],
      },
    };
  },
  methods: {
    open(file) {
        window.open(file);
    },
    saveAddEdit() {
      this.$validator.validateAll("addEditValidation").then((result) => {
        if (result) {
          this.button.loading = true;
          if (this.addEditObj.id > 0) {
            this.addEditObj.image = null;
            this.$store
              .dispatch("countries/updateData", this.addEditObj)
              .then((res) => {
                res.data.status = res.data.isActive
                  ? this.$t("Active")
                  : this.$t("InActive");
                this.$emit("saveAddEdit", res.data);
              })
              .catch((_) => {
                this.$notify.error({
                  duration: 3000,
                  message: this.$t("UpdatedFailed"),
                  title: this.$t("Updated"),
                  customClass: "top-center",
                });
              });
          } else {
            this.addEditObj.image = null;
            this.$store
              .dispatch("countries/saveData", this.addEditObj)
              .then((res) => {
                res.data.status = res.data.isActive
                  ? this.$t("Active")
                  : this.$t("InActive");
                this.$emit("saveAddEdit", res.data);
              })
              .catch((_) => {
                this.$notify.error({
                  duration: 3000,
                  message: this.$t("AddedFailed"),
                  title: this.$t("Added"),
                  customClass: "top-center",
                });
              });
          }
        }
      });
    },
  },
};
</script>