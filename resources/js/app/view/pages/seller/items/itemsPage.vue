<template>
  <div>
    <div class="mt-3">
      <label>
        <router-link to="/">{{ $t("Home") }}</router-link>
      </label>
      <span>/</span>
      <label active>{{ $t("Items") }}</label>
    </div>
    <h4 class="mt-3">{{ $t("Items") }}</h4>
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
                  :fields="itemsExport"
                  :worksheet="$t('Items')"
                  name="items.xls"
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
            <template v-slot:cell(image)="row">
              <div class="image-block">
                <img
                  v-if="row.item.image"
                  width="80"
                  height="80"
                  style="border-radius: 50%; border: 1px solid #ccc"
                  :src="row.item.image"
                  alt=""
                />
                <img
                  v-else
                  src="/assets/images/default.png"
                  width="80"
                  height="80"
                  style="border-radius: 50%; border: 1px solid #ccc"
                  alt=""
                />
                <input
                  type="file"
                  class="chooseImage"
                  @change="changeImage($event, row.item)"
                />
              </div>
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
        <div class="col-md-10">
          <div class="form-group">
            <label class="control-label">{{ $t("ItemTypeName") }}</label>
            <el-select
              v-model="filters.item_type_id"
              clearable
              filterable
              multiple
            >
              <el-option
                v-for="option in itemTypes"
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
            <label class="control-label">{{ $t("Categories") }}</label>
            <el-select v-model="filters.category" clearable filterable multiple>
              <el-option
                v-for="option in categories"
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
        <div class="col-md-5">
          <label class="control-label">{{ $t("Price") }}</label>
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
              v-model="filters.price"
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
      categories: [],
      filters: {
        name: null,
        item_type_id: null,
        category: null,
        operator: null,
        price: null,
        fromDate: null,
        toDate: null,
        status: null,
        page: null,
      },
      filterDrawer: false,
      itemsExport: {
        الاسم: "name",
        "نوع المنتج": "item_type.label",
        السعر: "price",
        الكمية: "qty",
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
        { key: "image", label: this.$t("Image"), sortable: false },
        {
          key: "name",
          label: this.$t("Name"),
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "itemTypeName",
          label: this.$t("ItemTypeName"),
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "price",
          label: this.$t("Price"),
          sortable: true,
          sortDirection: "desc",
        },
        {
          key: "qty",
          label: this.$t("Quantity"),
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
      filterOn: ["name", "itemTypeName", "price", "qty", "status"],
      addEditObj: {
        id: 0,
        image: null,
        name: "",
        item_type_id: "",
        price: "",
        qty: "",
        is_offer: false,
        special_price: "",
        special_price_start: "",
        special_price_end: "",
        selling_price: "",
        qty: "",
        status: true,
        store_id: 1,
        category: [],
      },
      itemTypes: [],
      filteredItems: [],
      countries: [],
      editMode: false,
      viewMode: false,
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
          .dispatch("items/removeData", idVal)
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
        .dispatch("items/getData", filters)
        .then((res) => {
          this.items = res.data.resources.map((item) => {
            item.itemTypeName= item.item_type.label;
            item.created_at = moment(item.created_at).format("DD/MM/YYYY");
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
      this.$router.push({ name: "itemsAddEdit" });
    },
    detailsRow(item) {
      this.resetInfo();
      this.viewMode = true;
      this.addEditObj = JSON.parse(JSON.stringify(item));
      this.$router.push(`items/details/${item.id}`);
    },
    editRow(item) {
      this.resetInfo();
      this.editMode = true;
      this.addEditObj = JSON.parse(JSON.stringify(item));
      this.$router.push({ name: "itemsAddEdit", params: { id: item.id } });
    },
    copyRow(item) {
      this.resetInfo();
      this.addEditObj = JSON.parse(JSON.stringify(item));
      this.addEditObj.id = 0;
      this.$router.push({ name: "itemsAddEdit", params: { idCopy: item.id } });
    },
    resetInfo() {
      this.editMode = false;
      this.viewMode = false;
      this.addEditObj = {
        id: 0,
        image: null,
        name: "",
        item_type_id: "",
        price: "",
        qty: "",
        is_offer: false,
        special_price: "",
        special_price_start: "",
        special_price_end: "",
        selling_price: "",
        qty: "",
        status: true,
        store_id: 1,
        category: [],
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
    changeImage(event, item) {
      if (event.target.files.length) {
        this.addEditObj = item;
        this.addEditObj.image = event.target.files[0];
        this.$store
          .dispatch("items/updateData", this.addEditObj)
          .then((_) => {
            this.$notify.success({
              duration: 3000,
              message: this.$t("ImageUpdatedSuccessfully"),
              title: this.$t("ImageUpdated"),
              customClass: "top-center",
            });
            this.initData(this.filters);
          })
          .catch((_) => {
            this.$notify.error({
              duration: 3000,
              message: this.$t("ImageUpdatedFailed"),
              title: this.$t("ImageUpdated"),
              customClass: "top-center",
            });
          });
      }
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
        .dispatch("items/updateStatus", JSON.stringify(sendData))
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
      .dispatch("items/getItemType")
      .then((res) => {
        this.itemTypes = res.data;
      })
      .catch((error) => {});

    this.$store
      .dispatch("items/getCategory")
      .then((res) => {
        this.categories = res.data;
      })
      .catch((error) => {});

    this.initData(this.filters);
  },
};
</script>
