<template>
  <div class="divisions">
    <div class="sub-header-container">
      <header class="header navbar navbar-expand-sm">
        <a
          href="javascript:void(0);"
          class="sidebarCollapse"
          data-placement="bottom"
        >
          <i class="las la-bars"></i>
        </a>
        <ul class="navbar-nav flex-row">
          <li>
            <div class="page-header">
              <nav class="breadcrumb-one" aria-label="breadcrumb">
                <BreadCrumb title="ثوابت النظام" subTitle="الأقسام" />
              </nav>
            </div>
          </li>
        </ul>
      </header>
    </div>
    <div class="col-lg-12 mt-4">
      <button class="btn btn-primary float-right m-4">إضافة قسم جديد</button>
      <div class="statbox widget box box-shadow">
        <div class="widget-header">
          <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
              <h4 class="m-4">عرض الأقسام</h4>
            </div>
          </div>
        </div>
        <div class="widget-content widget-content-area">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th><div class="th-content">الاسم</div></th>
                  <th><div class="th-content">العمليات</div></th>
                </tr>
              </thead>
              <tbody>
                <tr  v-for="(item, index) in list" :key="index">
                  <td><p>{{item.name}}</p></td>
                  <td>
                    <div class="d-flex">
                      <a
                        href="javascript:void(0);"
                        class="bs-tooltip font-20 text-primary"
                        title=""
                        data-original-title="Edit"
                        ><i class="las la-pen"></i
                      ></a>
                      <a
                        href="javascript:void(0);"
                        class="bs-tooltip font-20 ml-2 text-danger"
                        title=""
                        data-original-title="Delete"
                        ><i class="las la-trash"></i
                      ></a>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

<!--     
        <ul>
          <li v-for="(item, index) in list" :key="index">
            {{ item.name }}
            <a @click="edit(item.id)" style="margin:0 5px">تعديل</a>
            <a @click="remove(item.id)"  style="margin:0 5px">حذف</a>
          </li>
        </ul>
       <h2 class="mt-5">إضافة قسم</h2>
        <button class="btn btn-secondary mt-3" @click="clearData">جديد</button>
        <div class="mt-3">
          <input class="form-control mt-3" placeholder="أدخل الاسم" type="text" v-model="formData.name" />
          <button class="btn btn-primary mt-3" v-if="formData.id>0" @click="update">تحديث</button>
          <button class="btn btn-primary mt-3" v-else @click="save">حفظ</button>
        </div> -->
  </div>
</template>

<script>
import BreadCrumb from "@/components/template/BreadCrumb.vue";
export default {
  name: "Divisions",
  components: { BreadCrumb },
  data() {
    return {
      list: [],
      formData: {
        id: 0,
        name: "",
      },
    };
  },
  methods: {
    save() {
      this.$store.dispatch(`divisions/save`, this.formData).then(() => {
        this.initData();
      });
    },
    update() {
      this.$store.dispatch(`divisions/update`, this.formData).then(() => {
        this.initData();
      });
    },
    edit(id) {
      this.$store.dispatch(`divisions/show`, id).then((res) => {
        this.formData = res.data;
      });
    },
    remove(id) {
      this.$store.dispatch(`divisions/remove`, id).then(() => {
        this.initData();
      });
    },
    clearData() {
      for (let key in this.formData) {
        this.formData[key] = "";
      }
      this.formData.id = 0;
    },
    initData() {
      this.clearData();
      this.$store.dispatch(`divisions/getAll`).then((res) => {
        this.list = res.data;
      });
    },
  },
  created() {
    $(document).ready(function () {
      App.init();
    });
    this.initData();
  },
};
</script>
