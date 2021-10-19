<template>
  <div>
    <div class="mt-3">
      <label>
        <router-link to="/">{{ $t("Home") }}</router-link>
      </label>
      <span>/</span>
      <label active>{{ $t("Rates") }}</label>
    </div>
    <h4 class="mt-3">{{ $t("Rates") }}</h4>
    <div class="main-card mt-3 card">
      <div class="card-body">
        <div>
          <div class="row">
            <div class="col-md-6">
              <span id="addWrapper">
                <download-excel
                  class="btn mb-2 mr-2 btn-transition btn-outline-success"
                  :data="items"
                  :fields="itemsExport"
                  :worksheet="$t('Rates')"
                  name="rates.xls"
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
            <template v-slot:cell(rating)="row">
              <el-rate
                v-model.number="row.item.rating"
                @change="updateRate(row.item)"
              />
            </template>
            <template v-slot:cell(approved)="row">
              <span
                v-if="row.item.approved"
                style="color: green; font-weight: bold"
              >
                {{ $t("Approved") }}
                <div
                  @click="updateStatus(row.item)"
                  :style="
                    row.item.approved
                      ? 'background:#F1A102'
                      : 'background:green'
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
              <span v-else style="color: #f1a102; font-weight: bold">
                {{ $t("InProgress") }}
                <div
                  @click="updateStatus(row.item)"
                  :style="
                    row.item.approved
                      ? 'background:#F1A102'
                      : 'background:green'
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
    <b-modal
      v-model="infoModalShow"
      id="info-modal"
      :title="infoModalTitle"
      ok-only
      hide-footer
      size="lg"
    >
      <addEdit
        :addEditObj="addEditObj"
        :items="items"
        @saveAddEdit="saveAddEdit"
        @closeAddEdit="infoModalShow = false"
        :countries="countries"
        :editMode="editMode"
        :viewMode="viewMode"
      >
      </addEdit>
    </b-modal>

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
            <label class="control-label">{{ $t("Item") }}</label>
            <el-select v-model="filters.item" clearable filterable multiple>
              <el-option
                v-for="option in itemsData"
                :value="option.id"
                :label="option.name"
                :key="option.id"
              >
              </el-option>
            </el-select>
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
              v-model="filters.rating"
            />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="form-group">
            <label class="control-label">{{ $t("Status") }}</label>
            <el-select v-model="filters.approved" clearable filterable>
              <el-option
                v-for="option in approvedStatuses"
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
import addEdit from "./addEdit";

export default {
  components: {
    addEdit,
  },
  data() {
    return {
      filters: {
        customer: null,
        item: null,
        rating: null,
        operator: null,
        fromDate: null,
        toDate: null,
        approved: null,
        page: null,
      },
      filterDrawer: false,
      customers: [],
      itemsData: [],
      approvedStatuses: [
        {
          label: this.$t("تمت الموافقة"),
          value: 1,
        },
        {
          label: this.$t("قيد الانتظار"),
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
      itemsExport: {
        الزبون: "customer.name",
        المنتج: "item.name",
        التقييم: "rating",
        الحالة: {
          field: "approved",
          callback: (value) => {
            if (value) return "تمت الموافقة";
            else return "قيد الانتظار";
          },
        },
      },
      items: [],
      fields: [
        {
          key: "customerName",
          label: this.$t("Customer"),
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "itemName",
          label: this.$t("Item"),
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "rating",
          label: this.$t("Rating"),
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "approved",
          label: this.$t("Status"),
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
      filterOn: ["customerName", "itemName", "rating", "approved"],
      addEditObj: {
        id: 0,
        customer: {
          id: "",
          name: "",
        },
        customer_id: "",
        item: {
          id: "",
          name: "",
        },
        item_id: "",
        rating: "",
        approved: "",
        comment: "",
      },
      filteredItems: [],
      countries: [],
      infoModalTitle: "",
      infoModalShow: false,
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
          .dispatch("rates/removeData", idVal)
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
        .dispatch("rates/getData", filters)
        .then((res) => {
          this.items = res.data.resources.map((data) => {
            data.customerName = data.customer.name;
            data.itemName = data.item.name;
            data.created_at = moment(data.created_at).format("DD/MM/YYYY");
            return data;
          });
          this.pagination.from = res.data.pagination.from;
          this.pagination.to = res.data.pagination.to;
          this.pagination.total = res.data.pagination.total;
        })
        .catch((error) => {
          this.$notify.error({
            duration: 3000,
            message: this.$t("GetDataFailed"),
            title: this.$t("GetData"),
            customClass: "top-center",
          });
        });
    },
    detailsRow(item) {
      this.resetInfoModal();
      this.viewMode = true;
      this.infoModalTitle = this.$t("Details");
      this.addEditObj = JSON.parse(JSON.stringify(item));
      this.infoModalShow = true;
    },
    editRow(item) {
      this.resetInfoModal();
      this.editMode = true;
      this.infoModalTitle = this.$t("Edit");
      this.addEditObj = JSON.parse(JSON.stringify(item));
      this.infoModalShow = true;
    },
    resetInfoModal() {
      this.editMode = false;
      this.viewMode = false;
      this.infoModalTitle = "";
      this.addEditObj = {
        id: 0,
        customer: {
          id: "",
          name: "",
        },
        customer_id: "",
        item: {
          id: "",
          name: "",
        },
        item_id: "",
        rating: "",
        approved: "",
        comment: "",
      };
    },
    saveAddEdit(obj) {
      obj.customerName = obj.customer.name;
      obj.itemName = obj.item.name;
      var index = this.items.findIndex((x) => x.id == obj.id);
      if (index == -1) {
        this.items.push(obj);
        this.$notify.success({
          duration: 3000,
          message: this.$t("AddedSuccessfully"),
          title: this.$t("Added"),
          customClass: "top-center",
        });
      } else {
        this.items.splice(index, 1, obj);
        this.$notify.success({
          duration: 3000,
          message: this.$t("UpdatedSuccessfully"),
          title: this.$t("Update"),
          customClass: "top-center",
        });
      }
      this.infoModalShow = false;
    },
    updateRate(data) {
      this.$store
        .dispatch("rates/updateData", data)
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
    updateStatus(data) {
      let approved = null;
      if (data.approved == 1) approved = 0;
      else approved = 1;
      let sendData = {
        ids: data.id + "",
        approved: approved,
      };
      this.$store
        .dispatch("rates/updateStatus", JSON.stringify(sendData))
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
    paginationChange() {
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
    this.$store
      .dispatch("rates/getItems")
      .then((res) => {
        this.itemsData = res.data;
      })
      .catch((error) => {});
    this.initData(this.filters);
  },
};
</script>
