<template>
  <div class="mt-4 ml-4">
    <div class="mt-3">
        <label>
            <router-link to="/">{{$t('Home')}}</router-link>
        </label>
        <span>/</span>
        <label active>{{$t('Categories')}}</label>
    </div>
        <h4 class="mt-3">{{$t('Categories')}}</h4>
    <div class="row">
      <div class="col-md-5">
        <el-card class="box-card">
          <div class="row">
            <el-button
              :disabled="!!form.parent_id"
              class="ml-3 mb-4"
              style="width: 25%"
              type="primary"
              >إضافة أب</el-button
            >
            <el-button
              @click="addChild"
              :disabled="!form.parent_id"
              class="ml-3 mb-4"
              style="width: 25%"
              type="info"
              >إضافة ابن</el-button
            >
          </div>

          <el-form :rules="rules" ref="form" :model="form">
            <el-form-item prop="name">
              <el-input
                placeholder="اسم تصنيف المنتج "
                v-model="form.name"
              ></el-input>
            </el-form-item>
            <el-form-item>
              <span> حالة تصنيف المنتج </span>
              <el-switch v-model="form.status"></el-switch>
            </el-form-item>
            <div class="row">
              <el-button
                class="ml-3 mb-4"
                @click="clearData"
                style="width: 25%"
                type="secondary"
                >تفريغ</el-button
              >
              <el-button
                v-if="form.parent_id"
                class="ml-3 mb-4"
                @click="removeData"
                style="width: 25%"
                type="danger"
                >حذف</el-button
              >
              <el-button
                v-if="!!childToAddFlag"
                v-loading="saveLoading"
                class="ml-3 mb-4"
                @click="saveData"
                style="width: 25%"
                type="success"
                >حفظ</el-button
              >
              <el-button
                v-if="!childToAddFlag"
                v-loading="saveLoading"
                class="ml-3 mb-4"
                @click="updateData"
                style="width: 25%"
                type="success"
                >تحديث</el-button
              >
            </div>
          </el-form>
        </el-card>
      </div>

      <div class="col-md-7">
        <el-card class="box-card">
          <div slot="header" class="clearfix">
            <div class="row">
              <div class="col-md-12">
                <div>
                  <el-input
                    class="mb-2"
                    placeholder="بحث عن تصنيف"
                    prefix-icon="el-icon-search"
                    v-model="filterCategory"
                  >
                  </el-input>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <el-tree
                :default-expand-all="expanded"	
                :filter-node-method="filterNode"
                icon-class="el-icon-caret-left"
                :props="defaultProps"
                :data="categories"
                check-on-click-node
                highlight-current
                node-key="id"
                ref="tree"
                @node-click="nodeClick"
              ></el-tree>
            </div>
          </div>
        </el-card>
      </div>
    </div>
  </div>
</template>

<script>
import Swal from "sweetalert2";
export default {
  watch: {
    filterCategory(val) {
      this.$refs.tree.filter(val);
    },
  },
  data() {
    return {
      rules: {
        name: [
          { required: true, message: "أدخل اسم تصنيف المنتج", trigger: "blur" },
        ],
      },
      form: {
        name: null,
        status: true,
        parent_id: null,
      },
      categories: [],

      expanded:true,
      defaultProps: {
        children: "children",
        label: "name",
      },
      filterCategory: null,
      saveLoading: false,
      childToAddFlag: true,
    };
  },
  methods: {
    clearData() {
      this.form = {
        name: null,
        status: true,
        parent_id: null,
      };
      this.childToAddFlag = true;
    },
    addChild() {
      this.form.name = "";
      this.childToAddFlag = true;
    },
    removeData() {
      Swal.fire({
        title: "هل أنت متأكد؟",
        text: "هل تريد حقًا حذف هذا التصنيف",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "نعم، احذفه.",
        cancelButtonText: "لا",
      }).then((result) => {
        if (result.isConfirmed) {
          this.$store
            .dispatch("categories/removeData", this.form.parent_id)
            .then(() => {
               this.$notify({
                title: 'حذف',
                message: 'تم حذف التصنيف بنجاح',
                type: 'success',
                 position: 'top-left',
                 showClose: false,
                 duration:1200,
              });
              this.initData();
              this.clearData();
            })
            .catch((error) => {
              this.$notify({
                title: 'خطأ',
                message: error,
                type: 'error',
                 position: 'top-left'
              });
            });
        }
      });
    },
    saveData() {
      this.$refs["form"].validate((valid) => {
        if (valid) {
          this.saveLoading = true;
          this.$store
            .dispatch("categories/saveData", this.form)
            .then(() => {
               this.$notify({
                title: 'حفظ',
                message: 'تم إضافة التصنيف بنجاح',
                type: 'success',
                position: 'top-left',
                showClose: false,
                 duration:1200,
              });
              this.initData();
              this.clearData();
            })
            .catch((error) => {
               this.$notify({
                title: 'خطأ',
                message: error,
                type: 'error',
                 position: 'top-left'
              });
            })
            .finally(() => {
              this.saveLoading = false;
            });
        }
      });
    },
    updateData() {
      this.$refs["form"].validate((valid) => {
        if (valid) {
          this.saveLoading = true;
          this.$store
            .dispatch("categories/updateData", this.form)
            .then(() => {
               this.$notify({
                title: 'تحديث',
                message: 'تم تحديث التصنيف بنجاح',
                type: 'success',
                 position: 'top-left',
                 showClose: false,
                  duration:1200,
              });
              this.initData();
              this.clearData();
            })
            .catch((error) => {
              this.$notify({
                title: 'خطأ',
                message: error,
                type: 'error',
                 position: 'top-left'
              });
            })
            .finally(() => {
              this.saveLoading = false;
            });
        }
      });
    },
    nodeClick(data) {
      let status;
      data.status == 1 ? (status = true) : (status = false);
      this.form = {
        name: data.name,
        status: status,
        parent_id: data.id,
      };
      this.childToAddFlag = false;
    },
    filterNode(value, data) {
      if (!value) return true;
      return data.name.toLowerCase().indexOf(value.toLowerCase()) !== -1;
    },
    initData() {
      this.$store
        .dispatch("categories/getData")
        .then((res) => {
          this.categories = res.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  created() {
    this.initData();
  },
};
</script>
