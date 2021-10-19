<template>
  <div>
    <div class="row">
      <div class="col-md-6"></div>
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
      selectable
      @row-selected="onRowSelected"
      :select-mode="selectMode"
      class="mt-3"
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
      <template #cell(selected)="{ rowSelected }">
        <template v-if="rowSelected">
          <span aria-hidden="true">&check;</span>
          <span class="sr-only">Selected</span>
        </template>
        <template v-else>
          <span aria-hidden="true">&nbsp;</span>
          <span class="sr-only">Not selected</span>
        </template>
      </template>
      <template v-slot:cell(status)="row">
        <b-checkbox v-model="row.item.status" />
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
    <div class="row mt-3 mb-3 mr-3">
        <el-button @click="saveAddEdit" type="success">{{$t('Save')}}</el-button>
    </div>
  </div>
</template>

<script>
export default {
  props: ["addEditObj", "editMode"],

  data() {
    return {
      selectMode: "single",
      selected: {},
      items: [],
      fields: [
        {
          key: 'selected',
          label: this.$t('Choose'),
        },
        {
          key: "name",
          label: this.$t("Name"),
          sortable: true,
          sortDirection: "desc",
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
      filterOn: ["name", "status"],
      filteredItems: [],
      search: "",
    };
  },
  methods: {
    onFiltered(filteredItems) {
      this.pagination.currentPage = 1;
      this.filteredItems = filteredItems;
    },
    paginationChange(page) {
      let params = {
        page: parseInt(page),
      };
      this.initData(params);
    },
    saveAddEdit() {

      let obj = {
        item_id: this.selected[0].id,
        exclude: 0,
        name: this.selected[0].name
      }
      this.$emit("saveAddEdit", obj);
    },
    initData(page) {
      this.$store
        .dispatch("items/getData", page)
        .then((res) => {
          this.items = res.data.resources;
          this.pagination.from = res.data.pagination.from;
          this.pagination.to = res.data.pagination.to;
          this.pagination.total = res.data.pagination.total;
        })
        .catch(_ => {
          this.$notify.error({
            duration: 3000,
            message: this.$t("GetDataFailed"),
            title: this.$t("GetData"),
            customClass: "top-center",
          });
        });
    },
     onRowSelected(items) {
        this.selected = items
      },
  },
  created() {
    this.initData(1);
  },
};
</script>
