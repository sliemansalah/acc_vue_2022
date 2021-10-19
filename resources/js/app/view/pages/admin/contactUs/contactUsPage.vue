<template>
    <div>
    <div class="mt-3">
        <label>
            <router-link to="/admin">{{$t('Home')}}</router-link>
        </label>
        <span>/</span>
        <label active>{{$t('ContactMessages')}}</label>
    </div>
        <h4 class="mt-3">{{$t('ContactMessages')}}</h4>
        <div class="main-card mt-3 card">
            <div class="card-body">
                <div>
                    <div class="row">
                        <div class="col-md-6">
                            <span id="addWrapper">

                                <download-excel
                                    class = "btn mb-2 mr-2 btn-transition btn-outline-success"
                                    :data   = "items"
                                    :fields = "itemsExport"
                                    :worksheet = "$t('ItemTypes')"
                                    name= "itemTypes.xls"
                                    >
                                    {{$t('ExportExcel')}}
                                </download-excel>

                                
                                <button  class="btn mb-2 btn-transition btn-outline-info"  
                                @click='openFilters()'>
                                    {{$t("Filters")}}
                                </button>

                                <button  class="btn mb-2 btn-transition btn-outline-danger"  
                                @click='clearFilters()'>
                                    {{$t("ClearFilters")}}
                                </button>

                                
                            </span>
                        </div>
                        <div class="col-md-6">
                            <div  class="input-group input-group">
                                <input type="text" name="name" class="form-control" v-model="filter" :placeholder="$t('TypeToSearch')">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-icon btn-secondary" @click="filter = ''">
                                    {{$t("Clear")}}
                                </button>
                            </div>
                            </div>
                        </div>
                    </div>
                     <b-table show-empty 
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
                            @filtered="onFiltered">
                        <template v-slot:cell(status)="row">
                            <span v-if="row.item.status" style="color: green; font-weight: bold">
                                {{$t('Active')}} 
                                <div @click="updateStatus(row.item)" 
                                    :style="row.item.status?'background:red': 'background:green'"
                                    style="display:inline-block;cursor:pointer;width:10px;height:10px;border-radius:50%;">
                                </div>
                            </span>
                            <span v-else style="color: red; font-weight: bold">
                                {{$t('InActive')}}
                                 <div @click="updateStatus(row.item)" 
                                    :style="row.item.status?'background:red': 'background:green'"
                                    style="display:inline-block;cursor:pointer;width:10px;height:10px;border-radius:50%;">
                                </div>
                                </span>
                        </template>
                        <template v-slot:cell(actions)="row" >
                            <b-dropdown no-flip :text='$t("Actions")' class="" variant="primary">
                                <span :id="'deleteWrapper'+row.index">
                                    <button type="button"  class="dropdown-item text-danger" 
                                        @click='deleteRow(row.item.id)'>
                                        {{$t("Delete")}}
                                    </button>
                                </span>
                                <span :id="'detailsWrapper'+row.index">
                                    <button type="button"  class="dropdown-item text-success" 
                                        @click='detailsRow(row.item)'>
                                        {{$t("Details")}}
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
                @closeAddEdit="infoModalShow=false;"
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
                <div class="form-group" 
                >
                    <label class="control-label">{{$t("Name")}}</label>
                    <input type="text" name="name" 
                        class="form-control" 
                        v-model="filters.name"
                    >
                </div>
            </div>
            </div>
            <div class="row">
                 <div class="col-md-1"></div>
                  <div class="col-md-10">
                      <b-button @click="filterData" variant="success">{{$t('Filter')}}</b-button>
                      <b-button @click="closeFilters" variant="secondary">{{$t('Close')}}</b-button>
                  </div>
            </div>
        </el-drawer>
    </div>
</template>
<script>
    import addEdit from './addEdit'

    export default {
        components: {
            addEdit
        },
        data() {
            return {
                filters: {
                    name: null, 
                    page: null
                },
                filterDrawer: false,
                itemsExport: {
                    'الاسم': 'name',
                    'البريد الإلكتروني': 'email',
                    'المتجر': 'store.name',
                },
                filterDrawer: false,
                items: [],
                fields: [
                    { key: 'name', label: this.$t('Name'), sortable: true, sortDirection: 'desc' },
                    { key: 'email', label: this.$t('Email'), sortable: true, sortDirection: 'desc' },
                    { key: 'storeName', label: this.$t('Store'), sortable: true, sortDirection: 'desc' },
                    { key: 'actions', label: '','thStyle':'width:10%;','class':'action-column' }
                ],
                pagination:{
                    currentPage: 1,
                    perPage:  10,
                },
                sortBy: 'id',
                sortDesc: false,
                sortDirection: 'asc',
                filter: null,
                filterOn: ['name', 'email', 'storeName'],
                addEditObj:{
                    id:0,
                    name: '',
                    description: null,
                },
                filteredItems: [],
                infoModalTitle: '',
                infoModalShow: false,
                editMode: false,
                viewMode: false,
            }
        },
        methods: {
             clearFilters() {
                this.filters = {
                    name: null, 
                    status: null,
                    page: null,
                }
                this.initData(this.filters);
            },
            openFilters() {
                this.filterDrawer= true;
            },
            closeFilters() {
                this.filterDrawer= false;
            },
            filterData() {
                this.pagination.currentPage= 1;
                this.filters.page = 1;
                this.initData(this.filters);
                this.closeFilters();
            },
            deleteRow(idVal){
                this.$confirm(this.$t('DeleteConfirmMessage'), this.$t('DeleteConfirmTitle'), {
                    confirmButtonText: this.$t('DeleteConfirmOk'),
                    cancelButtonText: this.$t('DeleteConfirmCancel'),
                    type: 'warning'
                }).then(() => {
                    this.$store.dispatch("contact_us/removeData", idVal)
                    .then(_ => {
                        let index=this.items.findIndex(x=>x.id==idVal);
                        this.items.splice(index,1);
                        this.$notify.success({
                            duration: 3000,
                            message: this.$t("DeleteSuccessfully"),
                            title: this.$t("Delete"),
                            customClass: "top-center",
                        }); 
                    })
                    .catch(_=>{
                       this.$notify.error({
                            duration: 3000,
                            message: this.$t("DeleteFailed"),
                            title: this.$t("Delete"),
                            customClass: "top-center",
                        }); 
                    })
                    
                })
            },
            onFiltered(filteredItems) {
                this.pagination.currentPage = 1;
                this.filteredItems = filteredItems;
            },
            initData(filters) {
                this.$store
                .dispatch("contact_us/getData", filters)
                .then(res => {
                    this.items = res.data.resources.map(item => {
                        item.storeName= item.store.name;
                        return item;
                    })
                    this.pagination.from = res.data.pagination.from;
                    this.pagination.to = res.data.pagination.to;
                    this.pagination.total = res.data.pagination.total;
                })
                .catch(error => {
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
                })               
            },
            detailsRow(item) {
                this.resetInfoModal()
                this.viewMode= true;
                this.infoModalTitle = this.$t('Details');
                this.addEditObj=JSON.parse(JSON.stringify(item));
                this.infoModalShow=true;
            },
            resetInfoModal() {
                this.editMode= false;
                this.viewMode= false;
                this.infoModalTitle = '';
                this.addEditObj={
                    id:0,
                    image: null,
                    name: '',
                }
            },
            saveAddEdit(obj){
                var index=this.items.findIndex(x=>x.id==obj.id);
                if(index==-1){
                    this.items.push(obj);
                    this.$notify.success({
                        duration: 3000,
                        message: this.$t("AddedSuccessfully"),
                        title: this.$t("Added"),
                        customClass: "top-center",
                    });
                }else{
                    this.items.splice(index,1,obj);
                    this.$notify.success({
                        duration: 3000,
                        message: this.$t("UpdatedSuccessfully"),
                        title: this.$t("Updated"),
                        customClass: "top-center",
                    });
                }
                this.infoModalShow=false;
            },
        paginationChange(page) {
            this.filters.page = page;
            this.initData(this.filters);
        },
    },
        created() {
            this.initData(this.filters);
        }
    }
</script>
