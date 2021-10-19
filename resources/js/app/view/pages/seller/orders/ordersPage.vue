<template>
  <div>
    <div class="mt-3">
      <label>
        <router-link to="/">{{ $t("Home") }}</router-link>
      </label>
      <span>/</span>
      <label active>{{ $t("Orders") }}</label>
    </div>
    <h4 class="mt-3">{{ $t("Orders") }}</h4>
    <div class="main-card mt-3 card">
      <div class="card-body">
        <div>
          <div class="row">
            <div class="col-md-6">
              <span id="addWrapper">
                <button
                  class="btn mb-2 btn-transition btn-outline-primary"
                  @click="addNewItem()"
                >
                  {{ $t("AddNew") }}
                </button>

                <download-excel
                  class="btn mb-2 mr-2 btn-transition btn-outline-success"
                  :data="items"
                  :fields="ordersExport"
                  :worksheet="$t('Orders')"
                  name="orders.xls"
                >
                  {{ $t("ExportExcel") }}
                </download-excel>

                <button
                  class="btn mb-2 btn-transition btn-outline-info"
                  @click="openFilters()"
                >
                  {{ $t("Filters") }}
                </button>

                <button
                  class="btn mb-2 btn-transition btn-outline-danger"
                  @click="clearFilters()"
                >
                  {{ $t("ClearFilters") }}
                </button>
              </span>
            </div>
            <div class="col-md-6">
              <div class="input-group input-group">
                <input
                  type="text"
                  name="name"
                  class="form-control"
                  v-model="filter"
                  :placeholder="$t('TypeToSearch')"
                />
                <div class="input-group-append">
                  <button
                    type="button"
                    class="btn btn-icon btn-secondary"
                    @click="filter = ''"
                  >
                    <!-- <i class="fa fa-times"></i> -->
                    {{ $t("Clear") }}
                  </button>
                </div>
              </div>
            </div>
          </div>
          <b-table
            show-empty
            :empty-filtered-text="$t('emptyTable')"
            :empty-text="$t('emptyTable')"
            stacked="md"
            :bordered="true"
            :striped="true"
            :items="items"
            :fields="fields"
            :per-page="pagination.perPage"
            :filter="filter"
            :filterIncludedFields="filterOn"
            :sort-by.sync="sortBy"
            :sort-desc.sync="sortDesc"
            :sort-direction="sortDirection"
            @filtered="onFiltered"
          >
            <template v-slot:cell(itemTypeName)="row">
              {{ row.item.item_type.label }}
            </template>
            <template v-slot:cell(is_percent)="row">
              <span v-if="row.item.is_percent == 1">نعم</span>
              <span v-else>لا</span>
            </template>
            <template v-slot:cell(status)="row">
              <span
                v-if="row.item.status == 0"
                style="color: red; font-weight: bold"
              >
                {{ $t("BillingWait") }}
              </span>
              <span
                v-else-if="row.item.status == 1"
                style="color: black; font-weight: bold"
              >
                {{ $t("ReviewingWait") }}
              </span>
              <span
                v-else-if="row.item.status == 2"
                style="color: blue; font-weight: bold"
              >
                {{ $t("Inprogress") }}
              </span>
              <span
                v-else-if="row.item.status == 3"
                style="color: green; font-weight: bold"
              >
                {{ $t("Done") }}
              </span>
              <span
                v-else-if="row.item.status == 4"
                style="color: orange; font-weight: bold"
              >
                {{ $t("ShippingInprogress") }}
              </span>
              <span
                v-else-if="row.item.status == 5"
                style="color: #007c00; font-weight: bold"
              >
                {{ $t("ShippingDone") }}
              </span>

              <el-dropdown
                @command="updateStatus(row.item, $event)"
                trigger="click"
              >
                <span class="el-dropdown-link">
                  <i class="el-icon-arrow-down el-icon--right"></i>
                </span>
                <el-dropdown-menu slot="dropdown">
                  <el-dropdown-item
                    :style="row.item.status == 0 ? 'background:yellow' : ''"
                    style="color: red; font-weight: bold"
                    command="0"
                    >{{ $t("BillingWait") }}</el-dropdown-item
                  >
                  <el-dropdown-item
                    :style="row.item.status == 1 ? 'background:yellow' : ''"
                    style="color: black; font-weight: bold"
                    command="1"
                    >{{ $t("ReviewingWait") }}</el-dropdown-item
                  >
                  <el-dropdown-item
                    :style="row.item.status == 2 ? 'background:yellow' : ''"
                    style="color: blue; font-weight: bold"
                    command="2"
                    >{{ $t("Inprogress") }}</el-dropdown-item
                  >
                  <el-dropdown-item
                    :style="row.item.status == 3 ? 'background:yellow' : ''"
                    style="color: green; font-weight: bold"
                    command="3"
                    >{{ $t("Done") }}</el-dropdown-item
                  >
                  <el-dropdown-item
                    :style="row.item.status == 4 ? 'background:yellow' : ''"
                    style="color: orange; font-weight: bold"
                    command="4"
                    >{{ $t("ShippingInprogress") }}</el-dropdown-item
                  >
                  <el-dropdown-item
                    :style="row.item.status == 5 ? 'background:yellow' : ''"
                    style="color: #007c00; font-weight: bold"
                    command="5"
                    >{{ $t("ShippingDone") }}</el-dropdown-item
                  >
                </el-dropdown-menu>
              </el-dropdown>
            </template>
            <template v-slot:cell(actions)="row">
              <b-dropdown
                no-flip
                :text="$t('Actions')"
                class=""
                variant="primary"
              >
                <span :id="'editWrapper' + row.index">
                  <button
                    type="button"
                    class="dropdown-item text-primary"
                    @click="editRow(row.item)"
                  >
                    {{ $t("Edit") }}
                  </button>
                </span>
                <span :id="'copyWrapper' + row.index">
                  <button
                    type="button"
                    class="dropdown-item text-info"
                    @click="copyRow(row.item)"
                  >
                    {{ $t("Copy") }}
                  </button>
                </span>
                <span :id="'deleteWrapper' + row.index">
                  <button
                    type="button"
                    class="dropdown-item text-danger"
                    @click="deleteRow(row.item.id)"
                  >
                    {{ $t("Delete") }}
                  </button>
                </span>
                <span :id="'detailsWrapper' + row.index">
                  <button
                    type="button"
                    class="dropdown-item text-success"
                    @click="detailsRow(row.item)"
                  >
                    {{ $t("Details") }}
                  </button>
                </span>
              </b-dropdown>
            </template>
          </b-table>
          <div class="row">
            <div class="col-md-6">
              <b-pagination
                v-model="pagination.currentPage"
                :total-rows="pagination.total"
                :per-page="pagination.perPage"
                @change="paginationChange"
                class="my-0"
              >
              </b-pagination>
            </div>
          </div>
        </div>
      </div>
    </div>
    <el-drawer
      :title="$t('Filters')"
      :visible.sync="filterDrawer"
      :direction="'ltr'"
      :size="'20%'"
    >
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="form-group">
            <label class="control-label">{{ $t("Customer") }}</label>
            <el-select v-model="filters.customer" clearable filterable multiple>
              <el-option
                v-for="option in customers"
                :value="option.id"
                :label="option.full_name"
                :key="option.id"
              >
              </el-option>
            </el-select>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="form-group">
            <label class="control-label">{{ $t("Status") }}</label>
            <el-select v-model="filters.status" clearable filterable>
              <el-option
                v-for="option in statuses"
                :value="option.value"
                :label="option.label"
                :key="option.value"
              >
              </el-option>
            </el-select>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="form-group">
            <label class="control-label">{{ $t("FromDate") }}</label>
            <el-date-picker
              type="date"
              name="fromDate"
              class="w-100"
              v-model="filters.fromDate"
            />
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="form-group">
            <label class="control-label">{{ $t("ToDate") }}</label>
            <el-date-picker
              type="date"
              name="toDate"
              class="w-100"
              v-model="filters.toDate"
            />
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <b-button @click="filterData" variant="success">{{
            $t("Filter")
          }}</b-button>
          <b-button @click="closeFilters" variant="secondary">{{
            $t("Close")
          }}</b-button>
        </div>
      </div>
    </el-drawer>
  </div>
</template>
<script>
import moment from "moment";
import addEdit from "./addEditPage";

export default {
  components: {
    addEdit,
  },
  data() {
    return {
      filters: {
        customer: null,
        fromDate: null,
        toDate: null,
        status: null,
        page: null
      },
      filterDrawer: false,
      customers: [],
      statuses: [
        {
          label: this.$t("BillingWait"),
          value: 0,
        },
        {
          label: this.$t("ReviewingWait"),
          value: 1,
        },
        {
          label: this.$t("Inprogress"),
          value: 2,
        },
        {
          label: this.$t("Done"),
          value: 3,
        },
        {
          label: this.$t("ShippingInprogress"),
          value: 4,
        },
        {
          label: this.$t("ShippingDone"),
          value: 5,
        },
      ],
      ordersExport: {
        الكود: "code",
        الاسم: "name",
        "نسبة مئوية؟": {
          field: "is_percent",
          callback: (value) => {
            if (value) return "نعم";
            else return "لا";
          },
        },
        "حد الاستخدام لكل كوبون": "usage_limit_per_coupon",
        "حد الاستخدام لكل زبون": "usage_limit_per_customer",
        الحالة: {
          field: "status",
          callback: (value) => {
            if (value) return "فعال";
            else return "معطل";
          },
        },
      },
      items: [],
      paymentMethods: [
        {
          id: 1,
          name: "نقدي",
        },
        {
          id: 2,
          name: "فيزا كارد",
        },
        {
          id: 3,
          name: "بيونير",
        },
      ],
      fields: [
        {
          key: "customerName",
          label: this.$t("Customer"),
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "paymentMethodName",
          label: this.$t("PaymentMethod"),
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "total",
          label: this.$t("TotalBeforeDiscount"),
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "discount",
          label: this.$t("Discount"),
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "sub_total",
          label: this.$t("TotalAfterDiscount"),
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "created_at",
          label: this.$t("CreatedAt"),
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "status",
          label: this.$t("Status"),
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "actions",
          label: "",
          thStyle: "width:10%;",
          class: "action-column",
        },
      ],
      pagination: {
        currentPage: 1,
        perPage: 10,
      },
      sortBy: "",
      sortDesc: false,
      sortDirection: "asc",
      filter: null,
      filterOn: ["customerName", "paymentMethodName", "total", "discount", "sub_total"],
      addEditObj: {
        id: 0,
        customer_id: "",
        payment_method_id: "",
        coupon_code: "",
        status: 0,
        store_id: 1,
        item: [],
      },
      filteredItems: [],
      countries: [],
      editMode: false,
      viewMode: false,
    };
  },
  methods: {
    clearFilters() {
      this.filters = {
        first_name: null,
        last_name: null,
        email: null,
        mobile: null,
        status: null,
        category: null,
        page: null,
      };
      this.initData(this.filters);
    },
    openFilters() {
      this.filterDrawer = true;
    },
    closeFilters() {
      this.filterDrawer = false;
    },
    filterData() {
      this.pagination.currentPage = 1;
      this.filters.page = 1;
      this.initData(this.filters);
      this.closeFilters();
    },
    deleteRow(idVal) {
      this.$confirm(
        this.$t("DeleteConfirmMessage"),
        this.$t("DeleteConfirmTitle"),
        {
          confirmButtonText: this.$t("DeleteConfirmOk"),
          cancelButtonText: this.$t("DeleteConfirmCancel"),
          type: "warning",
        }
      ).then(() => {
        this.$store
          .dispatch("orders/removeData", idVal)
          .then((_) => {
            let index = this.items.findIndex((x) => x.id == idVal);
            this.items.splice(index, 1);
            this.$notify.success({
              duration: 3000,
              message: this.$t("DeleteSuccessfully"),
              title: this.$t("Delete"),
              customClass: "top-center",
            });
          })
          .catch((_) => {
            this.$notify.error({
              duration: 3000,
              message: this.$t("DeleteFailed"),
              title: this.$t("Delete"),
              customClass: "top-center",
            });
          });
      });
    },
    onFiltered(filteredItems) {
      this.pagination.currentPage = 1;
      this.filteredItems = filteredItems;
    },
    initData(filters) {
      if (this.filters.fromDate)
        this.filters.fromDate = moment(this.filters.fromDate).format(
          "YYYY-MM-DD"
        );
      if (this.filters.toDate)
        this.filters.toDate = moment(this.filters.toDate).format("YYYY-MM-DD");
      this.$store
        .dispatch("orders/getData", filters)
        .then((res) => {
          this.items = res.data.resources.map((data) => {
            data.customerName = data.customer ? data.customer.name : "";
            data.created_at = moment(data.created_at).format("DD/MM/YYYY");
            data.discount = parseFloat(data.total - data.sub_total).toFixed(2);
            data.paymentMethodName = "نقدي"; //this.paymentMethods.find(p=>p.id == data.payment_method_id).name;
            return data;
          });
          this.pagination.from = res.data.pagination.from;
          this.pagination.to = res.data.pagination.to;
          this.pagination.total = res.data.pagination.total;
        })
        .catch((error) => {
          // if(error.response.status == 500) {
          //     localStorage.removeItem("token");
          //     window.location.href = "/";
          // }
          this.$notify.error({
            duration: 3000,
            message: this.$t("GetDataFailed"),
            title: this.$t("GetData"),
            customClass: "top-center",
          });
        });
    },
    addNewItem: function () {
      this.resetInfo();
      this.$router.push({ name: "ordersAddEdit" });
    },
    detailsRow(item) {
      this.resetInfo();
      this.viewMode = true;
      this.addEditObj = JSON.parse(JSON.stringify(item));
      this.$router.push(`orders/details/${item.id}`);
    },
    editRow(item) {
      this.resetInfo();
      this.editMode = true;
      this.addEditObj = JSON.parse(JSON.stringify(item));
      this.$router.push({ name: "ordersAddEdit", params: { id: item.id } });
    },
    copyRow(item) {
      this.resetInfo();
      this.addEditObj = JSON.parse(JSON.stringify(item));
      this.addEditObj.id = 0;
      this.$router.push({ name: "ordersAddEdit", params: { idCopy: item.id } });
    },
    resetInfo() {
      this.editMode = false;
      this.viewMode = false;
      this.addEditObj = {
        id: 0,
        customer_id: "",
        payment_method_id: "",
        coupon_code: "",
        status: 0,
        store_id: 1,
        item: [],
      };
    },
    saveAddEdit(obj) {
      var index = this.items.findIndex((x) => x.id == obj.id);
      if (index == -1) {
        this.items.push(obj);
      } else {
        this.items.splice(index, 1, obj);
      }
      this.initData(this.filters);
    },
    updateStatus(data, status) {
      let sendData = {
        ids: data.id + "",
        status: status,
      };
      this.$store
        .dispatch("orders/updateStatus", JSON.stringify(sendData))
        .then(() => {
          this.$notify.success({
            duration: 3000,
            message: this.$t("UpdatedSuccessfully"),
            title: this.$t("Update"),
            customClass: "top-center",
          });
          this.initData(this.filters);
        })

        .catch((error) => {
          this.$notify.error({
            duration: 3000,
            message: error,
            title: this.$t("Error"),
            customClass: "top-center",
          });
        });
    },
    paginationChange(page) {
      this.filters.page = page;
      this.initData(this.filters);
    },
  },
  created() {
    this.$store
      .dispatch("rates/getCustomers")
      .then((res) => {
        this.customers = res.data;
      })
      .catch((error) => {});
    this.initData(this.filters);
  },
};
</script>
