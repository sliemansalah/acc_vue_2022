<template>
    <form ref="form" @submit.stop.prevent="saveAddEdit">
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" 
                    :class="{'has-error':errors.has('addEditValidation.name')}"
                >
                    <label class="control-label">{{$t("Name")}}</label>
                    <label class="required">*</label>
                    <input type="text" name="name" 
                        class="form-control" 
                        v-model="addEditObj.name"
                        v-validate="'required'" 
                        data-vv-scope="addEditValidation" 
                        :data-vv-as="$t('Name')"
                        :disabled="viewMode"
                    >
                    <div 
                        class="help-block" 
                        v-if="errors.has('addEditValidation.name')">
                        {{ errors.first('addEditValidation.name') }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group" 
                    :class="{'has-error':errors.has('addEditValidation.zip_code')}"
                >
                    <label class="control-label">{{$t("ZipCode")}}</label>
                    <label class="required">*</label>
                    <input type="text" name="zip_code" 
                        class="form-control" 
                        v-model="addEditObj.zip_code"
                        v-validate="'required'" 
                        data-vv-scope="addEditValidation" 
                        :data-vv-as="$t('ZipCode')"
                        :disabled="viewMode"
                    >
                    <div 
                        class="help-block" 
                        v-if="errors.has('addEditValidation.zip_code')">
                        {{ errors.first('addEditValidation.zip_code') }}
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
    props:['addEditObj','items', 'viewMode', 'editMode'],
    data() {
        return {
            button: {
                loading: false,
                'dataStyle': 'zoom-out',
                progress: 0,
            },
            type:"text"
        }
    },
    methods: {
        saveAddEdit(){
            this.$validator.validateAll("addEditValidation").then((result) => {
                if (result) {
                    this.button.loading=true;
                    if(this.addEditObj.id>0){
                        this.addEditObj.image= null;
                        this.$store.dispatch("countries/updateData", this.addEditObj)
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
                        this.$store.dispatch("countries/saveData", this.addEditObj)
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