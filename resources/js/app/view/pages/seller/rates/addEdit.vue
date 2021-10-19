<template>
    <form ref="form" @submit.stop.prevent="saveAddEdit">
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" 
                    :class="{'has-error':errors.has('addEditValidation.customer')}"
                >
                    <label class="control-label">{{$t("Customer")}}</label>
                    <label class="required">*</label>
                    <input type="text" name="customer" 
                        class="form-control" 
                        v-model="addEditObj.customer.name"
                        v-validate="'required'" 
                        data-vv-scope="addEditValidation" 
                        :data-vv-as="$t('Customer')"
                        disabled
                    >
                    <div 
                        class="help-block" 
                        v-if="errors.has('addEditValidation.customer')">
                        {{ errors.first('addEditValidation.customer') }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group" 
                    :class="{'has-error':errors.has('addEditValidation.item')}"
                >
                    <label class="control-label">{{$t("Item")}}</label>
                    <label class="required">*</label>
                    <input type="text" name="item" 
                        class="form-control" 
                        v-model="addEditObj.item.name"
                        v-validate="'required'" 
                        data-vv-scope="addEditValidation" 
                        :data-vv-as="$t('Item')"
                        disabled
                    >
                    <div 
                        class="help-block" 
                        v-if="errors.has('addEditValidation.item')">
                        {{ errors.first('addEditValidation.item') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group" 
                    :class="{'has-error':errors.has('addEditValidation.rating')}"
                >
                    <label class="control-label">{{$t("Rating")}}</label>
                    <label class="required">*</label>
                    <el-rate type="text" name="rating" 
                        v-model="addEditObj.rating"
                        v-validate="'required'" 
                        data-vv-scope="addEditValidation" 
                        :data-vv-as="$t('Rating')"
                        :disabled="viewMode"
                    />
                    <div 
                        class="help-block" 
                        v-if="errors.has('addEditValidation.rating')">
                        {{ errors.first('addEditValidation.rating') }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group" 
                    :class="{'has-error':errors.has('addEditValidation.comment')}"
                >
                    <label class="control-label">{{$t("Comment")}}</label>
                    <label class="required">*</label>
                    <input type="text" name="comment" 
                        class="form-control" 
                        v-model="addEditObj.comment"
                        v-validate="''" 
                        data-vv-scope="addEditValidation" 
                        :data-vv-as="$t('Comment')"
                        :disabled="viewMode"
                    >
                    <div 
                        class="help-block" 
                        v-if="errors.has('addEditValidation.comment')">
                        {{ errors.first('addEditValidation.comment') }}
                    </div>
                </div>
            </div>
        </div>
        
        <button type="button" class="btn c-ml-2 mb-2 btn-icon btn-secondary float-left"  
        @click="$emit('closeAddEdit')">
            {{$t("Close")}}
        </button>
        <b-button type="primary" variant="primary" class="float-left ml-2">
            {{$t("Save")}} 
        </b-button>
   
    </form>
</template>

<script>

export default {
    name: 'itemsAddEdit',
    props:['addEditObj','items', 'countries', 'viewMode', 'editMode'],
    data() {
        return {
            button: {
                loading: false,
                'dataStyle': 'zoom-out',
                progress: 0,
            },
        }
    },
    methods: {
        saveAddEdit(){
            this.$validator.validateAll("addEditValidation").then((result) => {
                if (result) {
                    this.button.loading=true;
                    if(this.addEditObj.id>0){
                        this.addEditObj.image= null;
                        this.$store.dispatch("rates/updateData", this.addEditObj)
                        .then(res => {
                             res.data.status = res.data.isActive? this.$t('Active'):this.$t('InActive');
                             this.$emit("saveAddEdit", res.data); 
                        })
                        .catch(_ => {
                            this.$notify.error({
                                duration: 3000,
                                message: this.$t("UpdatedFailed"),
                                title: this.$t("Updated"),
                                customClass: "top-center",
                            });
                        })
                    }
                    else{
                        this.addEditObj.image= null;
                        this.$store.dispatch("rates/saveData", this.addEditObj)
                        .then(res => {
                             res.data.status = res.data.isActive? this.$t('Active'):this.$t('InActive');
                             this.$emit("saveAddEdit", res.data); 
                        })
                        .catch(_ => {
                            this.$notify.error({
                                duration: 3000,
                                message: this.$t("AddedFailed"),
                                title: this.$t("Added"),
                                customClass: "top-center",
                            });
                        })
                    } 
                }
            });
        },
    },
}
</script>