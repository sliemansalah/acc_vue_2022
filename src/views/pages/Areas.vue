<template>
  <div>
    <b-table 
      :fields="fields"
      :items="items"
      striped 
    >
    </b-table>
  </div>
</template>

<script>
export default {
  name: "areas",
  data() {
    return {
      fields: [
        {
          key: 'name',
          label: 'الاسم'
        }
      ],
      items: [
        { name: 'soso' },
      ]
    };
  },
};
</script>