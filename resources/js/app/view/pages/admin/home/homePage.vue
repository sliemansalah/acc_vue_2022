<template>
  <div>
    <div class="mt-3">
        <label>
            <router-link to="/admin">{{$t('Home')}}</router-link>
        </label>
    </div>
        <h4 class="mt-3">{{$t('Home')}}</h4>

          <b-row class="mt-3">
      <b-col md="3">
        <b-card-group deck>
          <b-card
            bg-variant="primary"
            text-variant="white"
            header="الدول"
            class="text-center"
          >
            <b-card-text class="text-white text-bold">{{
              dashboard.totalCountries
            }}</b-card-text>
          </b-card>
        </b-card-group>
      </b-col>

      <b-col md="3">
        <b-card-group deck>
          <b-card
            bg-variant="success"
            text-variant="white"
            header="أنشطة المتجر"
            class="text-center"
          >
            <b-card-text class="text-white text-bold">{{
              dashboard.totalActivities
            }}</b-card-text>
          </b-card>
        </b-card-group>
      </b-col>

      <b-col md="3">
        <b-card-group deck>
          <b-card
            bg-variant="info"
            text-variant="white"
            header="المجموعات"
            class="text-center"
          >
            <b-card-text class="text-white text-bold">{{
              dashboard.totalGroups
            }}</b-card-text>
          </b-card>
        </b-card-group>
      </b-col>

      <b-col md="3">
        <b-card-group deck>
          <b-card
            bg-variant="dark"
            text-variant="white"
            header="أنواع المنتجات"
            class="text-center"
          >
            <b-card-text class="text-white text-bold">{{
              dashboard.totalItemTypes
            }}</b-card-text>
          </b-card>
        </b-card-group>
      </b-col>
    </b-row>
    <b-row class="mt-3">
      <b-col md="3">
        <b-card-group deck>
          <b-card
            bg-variant="dark"
            text-variant="white"
            header="المتاجر"
            class="text-center"
          >
            <b-card-text class="text-white text-bold">{{
              dashboard.totalStores
            }}</b-card-text>
          </b-card>
        </b-card-group>
      </b-col>
    </b-row>

  </div>
</template>

<script>
export default {
  data() {
    return {
      dashboard: {
        totalActivities: 0,
        totalCountries: 0,
        totalGroups: 0,
        totalItemTypes: 0,
        totalStores: 0,
      },
    };
  },
  created() {
    this.$store.dispatch("admin_dashboard/getData").then((res) => {
      this.dashboard = res.data;
    });
  },
};
</script>

<style>
</style>