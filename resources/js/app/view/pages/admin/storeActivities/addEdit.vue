<template>
  <form ref="form" @submit.stop.prevent="saveAddEdit">
    <div class="row">
      <div class="col-md-6">
        <div
          class="form-group"
          :class="{ 'has-error': errors.has('addEditValidation.group') }"
        >
          <label class="control-label">{{ $t("Group") }}</label>
          <label class="required">*</label>
          <el-select
            v-model="addEditObj.group_id"
            v-validate="'required'"
            name="group_id"
            :data-vv-as="$t('Group')"
            data-vv-scope="addEditValidation"
            :placeholder="$t('Select')"
            clearable
            filterable
            :disabled="viewMode"
          >
            <el-option
              v-for="option in groups"
              :value="option.id"
              :label="option.name"
              :key="option.id"
            >
            </el-option>
          </el-select>
          <div class="help-block" v-if="errors.has('addEditValidation.group')">
            {{ errors.first("addEditValidation.group") }}
          </div>
        </div>
      </div>
      <div class="col-md-6">
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
            v-model="addEditObj.name"
            v-validate="'required'"
            data-vv-scope="addEditValidation"
            :data-vv-as="$t('Name')"
            :disabled="viewMode"
          />
          <div class="help-block" v-if="errors.has('addEditValidation.name')">
            {{ errors.first("addEditValidation.name") }}
          </div>
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
      groups: [],
      button: {
        loading: false,
        dataStyle: "zoom-out",
        progress: 0,
      },
      type: "text",
    };
  },
  methods: {
    saveAddEdit() {
      this.$validator.validateAll("addEditValidation").then((result) => {
        if (result) {
          this.button.loading = true;
          if (this.addEditObj.id > 0) {
            this.$store
              .dispatch("activities/updateData", this.addEditObj)
              .then((res) => {
                let newData = JSON.parse(JSON.stringify(res.data));
                newData.groupName = newData.group.name;
                this.$emit("saveAddEdit", newData);
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
            this.$store
              .dispatch("activities/saveData", this.addEditObj)
              .then((res) => {
                let newData = JSON.parse(JSON.stringify(res.data));
                newData.groupName = newData.group.name;
                this.$emit("saveAddEdit", newData);
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
  created() {
    this.$store.dispatch("activities/listGroups").then((res) => {
      this.groups = res.data;
    });
  },
};
</script>