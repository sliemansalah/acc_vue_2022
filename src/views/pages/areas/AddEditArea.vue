<template>
  <div>
    <div class="mb-3">
        <h4 class="d-inline-block">إضافة منطقة</h4>
        <b-button class="float-right" variant="danger" @click="goBack">رجوع للخلف</b-button>
   </div>
    <b-input type="text" v-model="inputs.name"></b-input>
     <b-button variant="success" @click="save">حفظ</b-button>
  </div>
</template>

<script>
export default {
  name: "areas",
  data() {
    return {
      inputs: {
          name: ''
      }
    };
  },
  methods: {
      goBack() {
          this.$router.push({name: 'listAreas'});
      },
      save() {

      }
  }
};
</script>