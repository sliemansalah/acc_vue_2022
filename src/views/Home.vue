<template>
  <div class="home">
      <h1>الأقسام</h1>
      <ul>
        <li v-for="(item, index) in list" :key="index">
          {{ item.name }}

          <a @click="edit(item)" style="margin:0 5px">تعديل</a>
          <a @click="remove(item.id)"  style="margin:0 5px">حذف</a>


        </li>
      </ul>

      <h2>إضافة قسم</h2>
       <button @click="save">جديد</button>
       <br>
       <br>
      <div>
        <input placeholder="أدخل الاسم" type="text" v-model="formData.name" />
        <br><br>
        <button @click="save">حفظ</button>
      </div>

  </div>
</template>

<script>
export default {
  name: 'Home',
  data() {
    return {
      list: [],
      formData: {
        name: ''
      }
    }
  },
  methods: {
    save() {

    },
    edit(item) {
      this.formData= item;
    },
    remove(item) {

    }
  },
  created() {
    this.$store.dispatch(`divisions/getAll`).then(res => {
      this.list= res.data;
    })
  }
}
</script>
