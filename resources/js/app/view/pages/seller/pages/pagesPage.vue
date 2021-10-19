<template>
  <div>
    <div class="mt-3">
      <label>
        <router-link to="/">{{ $t("Home") }}</router-link>
      </label>
      <span>/</span>
      <label active>{{ $t("Pages") }}</label>
    </div>
    <h4 class="mt-3">{{ $t("Pages") }}</h4>
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
                  :worksheet="$t('Pages')"
                  name="pages.xls"
                >
                  {{ $t("ExportExcel") }}
                </download-excel>
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
        :editMode="editMode"
        :viewMode="viewMode"
      >
      </addEdit>
    </b-modal>
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
      itemsExport: {
        العنوان: "title",
        // الوصف: "description",
      },
      items: [],
      filters: {
        page: null,
      },
      fields: [
        {
          key: "title",
          label: this.$t("Title"),
          sortable: true,
          sortDirection: "desc",
        },
        // {
        //   key: "description",
        //   label: this.$t("Description"),
        //   sortable: true,
        //   sortDirection: "desc",
        // },
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
      filters: {
        page: 1,
      },
      filterOn: ["title"],
      addEditObj: {
        id: 0,
        title: "",
        description: "",
        store_id: 1,
      },
      filteredItems: [],
      infoModalTitle: "",
      infoModalShow: false,
      editMode: false,
      viewMode: false,
      filter: ""
    };
  },
  methods: {
    onFiltered(filteredItems) {
      this.pagination.currentPage = 1;
      this.filteredItems = filteredItems;
    },
    initData() {
      this.$store
        .dispatch("pages/getData", null)
        .then((res) => {
          this.items = res.data.resources;
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
    updatePage(data) {
      this.$store
        .dispatch("pages/updateData", data)
        .then(() => {
          this.$notify.success({
            duration: 3000,
            message: this.$t("UpdatedSuccessfully"),
            title: this.$t("Update"),
            customClass: "top-center",
          });
          this.initData(null);
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
