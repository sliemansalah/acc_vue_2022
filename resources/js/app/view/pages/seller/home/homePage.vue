<template>
  <div>
    <div class="mt-3">
      <label>
        <router-link to="/">{{ $t("Home") }}</router-link>
      </label>
    </div>
    <h4 class="mt-3">{{ $t("Home") }}</h4>

    <b-row class="mt-3">
      <b-col md="3">
        <b-card-group deck>
          <b-card
            bg-variant="primary"
            text-variant="white"
            header="التصنيفات"
            class="text-center"
          >
            <b-card-text class="text-white text-bold">{{
              dashboard.totalCategories
            }}</b-card-text>
          </b-card>
        </b-card-group>
      </b-col>

      <b-col md="3">
        <b-card-group deck>
          <b-card
            bg-variant="success"
            text-variant="white"
            header="المنتجات"
            class="text-center"
          >
            <b-card-text class="text-white text-bold">{{
              dashboard.totalItems
            }}</b-card-text>
          </b-card>
        </b-card-group>
      </b-col>

      <b-col md="3">
        <b-card-group deck>
          <b-card
            bg-variant="info"
            text-variant="white"
            header="الزبائن"
            class="text-center"
          >
            <b-card-text class="text-white text-bold">{{
              dashboard.totalCustomers
            }}</b-card-text>
          </b-card>
        </b-card-group>
      </b-col>

      <b-col md="3">
        <b-card-group deck>
          <b-card
            bg-variant="dark"
            text-variant="white"
            header="الكوبونات"
            class="text-center"
          >
            <b-card-text class="text-white text-bold">{{
              dashboard.totalCoupons
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
            header="التقييمات"
            class="text-center"
          >
            <b-card-text class="text-white text-bold">{{
              dashboard.totalRates
            }}</b-card-text>
          </b-card>
        </b-card-group>
      </b-col>
      <b-col md="3">
        <b-card-group deck>
          <b-card
            bg-variant="primary"
            text-variant="white"
            header="الطلبات"
            class="text-center"
          >
            <b-card-text class="text-white text-bold">{{
              dashboard.totalOrders
            }}</b-card-text>
          </b-card>
        </b-card-group>
      </b-col>
      <b-col md="3">
        <b-card-group deck>
          <b-card
            bg-variant="success"
            text-variant="white"
            header="الطلبات اليومية"
            class="text-center"
          >
            <b-card-text class="text-white text-bold">{{
              dashboard.orderDays
            }}</b-card-text>
          </b-card>
        </b-card-group>
      </b-col>
      <b-col md="3">
        <b-card-group deck>
          <b-card
            bg-variant="info"
            text-variant="white"
            header="إجمالي الدخل"
            class="text-center"
          >
            <b-card-text class="text-white text-bold">{{
              dashboard.totalSales
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
        totalCategories: 0,
        totalItems: 0,
        totalCustomers: 0,
        totalCoupons: 0,
        totalRates: 0,
        totalOrders: 0,
        orderDays: 0,
        totalSales: 0,
      },
    };
  },
  created() {
    this.$store.dispatch("seller_dashboard/getData").then((res) => {
      this.dashboard = res.data;
    });
  },
};
</script>

<style>
.card-header,
.card-text {
  text-align: center !important;
}
</style>