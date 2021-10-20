<template>
  <div>
   <div class="mb-3">
        <h4 class="d-inline-block">المناطق</h4>
        <b-button class="float-right" variant="primary" @click="addNew">إضافة جديد</b-button>
   </div>
    <b-table :fields="fields" :items="items" striped> </b-table>
  </div>
</template>

<script>
export default {
  name: "areas",
  data() {
    return {
      fields: [
        {
          key: "name",
          label: "الاسم",
        },
      ],
      items: [{ name: "soso" }],
    };
  },
  methods: {
    addNew() {
      this.$router.push({ name: "addEditArea" });
    },
  },
};
</script>