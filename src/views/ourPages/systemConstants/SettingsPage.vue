<template>
  <div>
    <h4
      style="color: #fff; background: #00c; padding: 15px; border-radius: 10px"
    >
      جدول إعدادات النظام
    </h4>

    <div>
      <vs-table stripe pagination :data="users">
        <template slot="thead">
          <vs-th> # </vs-th>
          <vs-th> الاسم </vs-th>
          <vs-th> البريد الالكتروني</vs-th>
        </template>

        <template slot-scope="{ data }">
          <vs-tr :key="indextr" v-for="(tr, indextr) in data">
            <vs-td :data="data[indextr].id">
              {{ data[indextr].id }}
            </vs-td>

            <vs-td :data="data[indextr].username">
              {{ data[indextr].name }}
            </vs-td>

            <vs-td :data="data[indextr].email">
              {{ data[indextr].email }}
            </vs-td>
          </vs-tr>
        </template>
      </vs-table>
    </div>
  </div>
</template>

<script>
export default {
  data: () => ({
    users: [
      {
        id: 1,
        name: "Leanne Graham",
        username: "Bret",
        email: "Sincere@april.biz",
      },
      {
        id: 2,
        name: "Ervin Howell",
        username: "Antonette",
        email: "Shanna@melissa.tv",
      },
    ],
  }),
};
</script>