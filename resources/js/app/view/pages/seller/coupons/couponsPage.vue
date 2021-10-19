<template>
  <div>
    <div class="mt-3">
      <label>
        <router-link to="/">{{ $t("Home") }}</router-link>
      </label>
      <span>/</span>
      <label active>{{ $t("Coupons") }}</label>
    </div>
    <h4 class="mt-3">{{ $t("Coupons") }}</h4>
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
                  :fields="couponsExport"
                  :worksheet="$t('Coupons')"
                  name="coupons.xls"
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
            <template v-slot:cell(status)="row">
              <span
                v-if="row.item.status"
                style="color: green; font-weight: bold"
              >
                {{ $t("Active") }}
                <div
                  @click="updateStatus(row.item)"
                  :style="
                    row.item.status ? 'background:red' : 'background:green'
                  "
                  style="
                    display: inline-block;
                    cursor: pointer;
                    width: 10px;
                    height: 10px;
                    border-radius: 50%;
                  "
                ></div>
              </span>
              <span v-else style="color: red; font-weight: bold">
                {{ $t("InActive") }}
                <div
                  @click="updateStatus(row.item)"
                  :style="
                    row.item.status ? 'background:red' : 'background:green'
                  "
                  style="
                    display: inline-block;
                    cursor: pointer;
                    width: 10px;
                    height: 10px;
                    border-radius: 50%;
                  "
                ></div>
              </span>
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
            <label class="control-label">{{ $t("Code") }}</label>
            <input
              type="text"
              name="name"
              class="form-control"
              v-model="filters.code"
            />
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="form-group">
            <label class="control-label">{{ $t("Name") }}</label>
            <input
              type="text"
              name="name"
              class="form-control"
              v-model="filters.name"
            />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5">
          <label class="control-label">{{ $t("Value") }}</label>
          <el-select v-model="filters.operator" clearable filterable>
            <el-option
              v-for="option in operators"
              :value="option.value"
              :label="option.label"
              :key="option.value"
            >
            </el-option>
          </el-select>
        </div>
        <div class="col-md-5">
          <label class="control-label"></label>
          <div class="form-group mt-2">
            <input
              type="text"
              name="price"
              class="form-control"
              v-model="filters.value"
            />
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
        code: null,
        name: null,
        value: null,
        operator: null,
        fromDate: null,
        toDate: null,
        status: null,
        page: null
      },
      filterDrawer: false,
      statuses: [
        {
          label: this.$t("فعال"),
          value: 1,
        },
        {
          label: this.$t("غير فعال"),
          value: 0,
        },
      ],
      operators: [
        {
          label: "أصغر من",
          value: 0,
        },
        {
          label: "يساوي",
          value: 1,
        },
        {
          label: "أكبر من",
          value: 2,
        },
      ],
      couponsExport: {
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
      fields: [
        {
          key: "code",
          label: this.$t("Code"),
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "name",
          label: this.$t("Name"),
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "is_percentTitle",
          label: this.$t("IsPercent"),
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "value",
          label: this.$t("Value"),
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "usage_limit_per_coupon",
          label: this.$t("UsageLimitPerCoupon"),
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "usage_limit_per_customer",
          label: this.$t("UsageLimitPerCustomer"),
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "created_at_view",
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
      sortBy: "id",
      sortDesc: false,
      sortDirection: "asc",
      filter: null,
      filterOn: ["code", "name", "is_percentTitle", "value", "usage_limit_per_coupon", "usage_limit_per_customer", "status"],
      addEditObj: {
        id: 0,
        code: "",
        name: "",
        is_percent: false,
        value: "",
        start_date: "",
        end_date: "",
        usage_limit_per_coupon: "",
        usage_limit_per_customer: "",
        status: true,
        store_id: 1,
        items: [],
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
        page: null
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
      this.pagination.currentPage= 1;
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
          .dispatch("coupons/removeData", idVal)
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
        .dispatch("coupons/getData", filters)
        .then((res) => {
          this.items = res.data.resources.map((item) => {
            if(item.is_percent) {
               item.is_percentTitle= "نعم";
            }else {
               item.is_percentTitle = "لا"
            }
            item.created_at_view = moment(item.created_at_view).format(
              "DD/MM/YYYY"
            );
            return item;
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
      this.$router.push({ name: "couponsAddEdit" });
    },
    detailsRow(item) {
      this.resetInfo();
      this.viewMode = true;
      this.addEditObj = JSON.parse(JSON.stringify(item));
      this.$router.push(`coupons/details/${item.id}`);
    },
    editRow(item) {
      this.resetInfo();
      this.editMode = true;
      this.addEditObj = JSON.parse(JSON.stringify(item));
      this.$router.push({ name: "couponsAddEdit", params: { id: item.id } });
    },
    copyRow(item) {
      this.resetInfo();
      this.addEditObj = JSON.parse(JSON.stringify(item));
      this.addEditObj.id = 0;
      this.$router.push({
        name: "couponsAddEdit",
        params: { idCopy: item.id },
      });
    },
    resetInfo() {
      this.editMode = false;
      this.viewMode = false;
      this.addEditObj = {
        id: 0,
        code: "",
        name: "",
        is_percent: false,
        value: "",
        start_date: "",
        end_date: "",
        usage_limit_per_coupon: "",
        usage_limit_per_customer: "",
        status: true,
        store_id: 1,
        items: [],
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
    updateStatus(data) {
      let status = null;
      if (data.status == 1) status = 0;
      else status = 1;
      let sendData = {
        ids: data.id + "",
        status: status,
      };
      this.$store
        .dispatch("coupons/updateStatus", JSON.stringify(sendData))
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
    this.initData(this.filters);
  },
};
</script>
