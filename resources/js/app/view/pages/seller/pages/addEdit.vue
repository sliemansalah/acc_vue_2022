<template>
  <form ref="form" @submit.stop.prevent="saveAddEdit">
    <div class="row">
      <div class="col-md-12">
        <div
          class="form-group"
          :class="{ 'has-error': errors.has('addEditValidation.title') }"
        >
          <label class="control-label">{{ $t("Title") }}</label>
          <label class="required">*</label>
          <input
            type="text"
            name="title"
            class="form-control"
            v-model="addEditObj.title"
            v-validate="'required'"
            data-vv-scope="addEditValidation"
            :data-vv-as="$t('Title')"
            :disabled="viewMode"
          />
          <div class="help-block" v-if="errors.has('addEditValidation.title')">
            {{ errors.first("addEditValidation.title") }}
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
          <div
            class="form-group"
          >
            <label class="control-label">{{ $t("Description") }}</label>
            <ckeditor v-model="addEditObj.description" :config="editorConfig">
            </ckeditor>
          </div>
      </div>
    </div>

    <button
      type="button"
      class="btn c-ml-2 mb-2 btn-icon btn-secondary float-left"
      @click="$emit('closeAddEdit')"
    >
      {{ $t("Close") }}
    </button>
    <b-button type="primary" variant="primary" class="float-left ml-2">
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
      editorConfig: {
        removePlugins: ["about", "resize"],
        readOnly: false,
      },
      button: {
        loading: false,
        dataStyle: "zoom-out",
        progress: 0,
      },
    };
  },
  methods: {
    saveAddEdit() {
      this.$validator.validateAll("addEditValidation").then((result) => {
        if (result) {
          this.button.loading = true;
          if (this.addEditObj.id > 0) {
            this.$store
              .dispatch("pages/updateData", this.addEditObj)
              .then((res) => {
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
          }
        }
      });
    },
  },
  created() {
      if(this.viewMode) this.editorConfig.readOnly = true;
      else this.editorConfig.readOnly = false;
  }
};
</script>