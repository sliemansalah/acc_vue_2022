<template>
    <b-card class="mt-3">
        <h5>{{$t('Items')}}</h5>
                <div>
                    <div v-if="!viewOnly" 
                        class="row">
                        <div class="col-md-6">
                            <span id="addWrapper">
                                <button
                                class="btn mb-2 btn-transition btn-outline-primary"  
                                @click='addNewItem()'>
                                    {{$t("AddNew")}}
                                </button>                                
                            </span>
                        </div>
                    </div>
                     <b-table show-empty 
                            :empty-text="$t('emptyTable')"
                            stacked="md"
                            :bordered="true"
                            :striped="true"
                            :items="addEditObj.item"
                            :fields="fields"
                    >
                        <template v-slot:cell(qty)="row" >
                            <b-input :disabled="viewOnly" v-model="row.item.qty" />
                        </template>
                        <template v-slot:cell(actions)="row">
                            <div v-if="!viewOnly">
                                <b-button variant="success" type="button" :id="'editWrapper'+row.index" 
                                    @click='editRow(row.item.id, row.index)'>
                                    {{$t("Edit")}}
                                </b-button>
                                <b-button variant="danger" type="button" :id="'deleteWrapper'+row.index" 
                                    @click='deleteRow(row.index)'>
                                    {{$t("Delete")}}
                                </b-button>
                            </div>
                        </template>
                    </b-table>
                </div>

        <b-modal 
            v-model="infoModalShow" 
            id="info-modal" 
            :title="infoModalTitle"
             ok-only 
             hide-footer 
             size="lg"
        >
            <addEditItem 
                :addEditObj="addEditObj" 
                @saveAddEdit="saveAddEdit"
                :editMode="editMode"
                >
            </addEditItem>
        </b-modal>
    </b-card>
</template>
<script>
    import addEditItem from './addEditItem'

    export default {
        props: ["addEditObj"],
        components: {
            addEditItem
        },
        data() {
            return {
                viewOnly: false,
                infoModalTitle: '',
                selectedIndex: -1,
                fields: [
                    { key: 'name', label: this.$t('Name'), sortable: false },
                    { key: 'qty', label: this.$t('Quantity'), sortable: false },
                    { key: 'actions', label: '','thStyle':'width:30%;','class':'action-column' }
                ],
                editMode: false,
                infoModalShow: false,
            }
        },
        methods: {
            deleteRow(index){
                this.$confirm(this.$t('DeleteConfirmMessage'), this.$t('DeleteConfirmTitle'), {
                    confirmButtonText: this.$t('DeleteConfirmOk'),
                    cancelButtonText: this.$t('DeleteConfirmCancel'),
                    type: 'warning'
                }).then(() => {
                        this.addEditObj.item.splice(index,1);
                        this.$notify.success({
                            duration: 3000,
                            message: this.$t("DeleteSuccessfully"),
                            title: this.$t("Delete"),
                            customClass: "top-center",
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
            addNewItem(){
                this.selectedIndex = -1;
                this.infoModalTitle = this.$t('AddNew');
                this.infoModalShow=true;
            },
            editRow(item, index) {
                this.selectedIndex=index;
                this.editMode= true;
                this.infoModalTitle = this.$t('Edit');
                this.infoModalShow=true;
            },
            saveAddEdit(obj){
                if(this.selectedIndex==-1){
                    this.addEditObj.item.push(obj);
                    this.$notify.success({
                      duration: 3000,
                      message: this.$t("AddedSuccessfully"),
                      title: this.$t("Add"),
                      customClass: "top-center",
                  });
                }else{
                    this.addEditObj.item.splice(this.selectedIndex,1,obj);
                    this.$notify.success({
                      duration: 3000,
                      message: this.$t("UpdatedSuccessfully"),
                      title: this.$t("Update"),
                      customClass: "top-center",
                  });
                }
                this.infoModalShow=false;
            },
    },
    created() {
        if(this.$route.path.toString().includes("details/"))  this.viewOnly= true;
    }
    }
</script>
