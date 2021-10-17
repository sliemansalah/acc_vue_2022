<template>
  <div class="divisions">
      <h1>الأقسام</h1>
      <ul>
        <li v-for="(item, index) in list" :key="index">
          {{ item.name }}

          <a @click="edit(item.id)" style="margin:0 5px">تعديل</a>
          <a @click="remove(item.id)"  style="margin:0 5px">حذف</a>


        </li>
      </ul>

      <h2>إضافة قسم</h2>
       <button @click="clearData">جديد</button>
       <br>
       <br>
      <div>
        <input placeholder="أدخل الاسم" type="text" v-model="formData.name" />
        <br><br>
        <button v-if="formData.id>0" @click="update">تحديث</button>
        <button v-else @click="save">حفظ</button>
      </div>

  </div>
</template>

<script>
export default {
  name: 'Divisions',
  data() {
    return {
      list: [],
      formData: {
        id:0,
        name: ''
      }
    }
  },
  methods: {
    save() {
      this.$store.dispatch(`divisions/save`, this.formData).then(() => {
        this.initData();
      })
    },
    update() {
      this.$store.dispatch(`divisions/update`, this.formData).then(() => {
        this.initData();
      })
    },
    edit(id) {
      this.$store.dispatch(`divisions/show`, id).then(res => {
          this.formData= res.data;
      })
    },
    remove(id) {
      this.$store.dispatch(`divisions/remove`, id).then(() => {
        this.initData();
      })
    },
    clearData() {
      for(let key in this.formData) {
       this.formData[key] = '';
      }
      this.formData.id= 0;
    },
    initData() {
      this.clearData();
      this.$store.dispatch(`divisions/getAll`).then(res => {
        this.list= res.data;
      })
    }
  },
  created() {
    this.initData();
  }
}
</script>
