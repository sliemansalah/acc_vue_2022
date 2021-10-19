<template>
    <form ref="form" @submit.stop.prevent="saveAddEdit">
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" 
                    :class="{'has-error':errors.has('addEditValidation.firstName')}"
                >
                    <label class="control-label">{{$t("FirstName")}}</label>
                    <label class="required">*</label>
                    <input type="text" name="firstName" 
                        class="form-control" 
                        v-model="addEditObj.first_name"
                        v-validate="'required'" 
                        data-vv-scope="addEditValidation" 
                        :data-vv-as="$t('FirstName')"
                        :disabled="viewMode"
                    >
                    <div 
                        class="help-block" 
                        v-if="errors.has('addEditValidation.firstName')">
                        {{ errors.first('addEditValidation.firstName') }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group" 
                    :class="{'has-error':errors.has('addEditValidation.lastName')}"
                >
                    <label class="control-label">{{$t("LastName")}}</label>
                    <label class="required">*</label>
                    <input type="text" name="lastName" 
                        class="form-control" 
                        v-model="addEditObj.last_name"
                        v-validate="'required'" 
                        data-vv-scope="addEditValidation" 
                        :data-vv-as="$t('LastName')"
                        :disabled="viewMode"
                    >
                    <div 
                        class="help-block" 
                        v-if="errors.has('addEditValidation.lastName')">
                        {{ errors.first('addEditValidation.lastName') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group" 
                    :class="{'has-error':errors.has('addEditValidation.email')}"
                >
                    <label class="control-label">{{$t("Email")}}</label>
                    <label class="required">*</label>
                    <input type="text" name="email" 
                        class="form-control" 
                        v-model="addEditObj.email"
                        v-validate="'required'" 
                        data-vv-scope="addEditValidation" 
                        :data-vv-as="$t('Email')"
                        :disabled="viewMode"
                    >
                    <div 
                        class="help-block" 
                        v-if="errors.has('addEditValidation.email')">
                        {{ errors.first('addEditValidation.email') }}
                    </div>
                </div>
            </div>
            <div class="col-md-6" v-if="!editMode && !viewMode">
                <div class="form-group" 
                    :class="{'has-error':errors.has('addEditValidation.password')}"
                >
                    <label class="control-label">{{$t("Password")}}</label>
                    <label class="required">*</label>
                    <input type="password" name="password" 
                        class="form-control" 
                        v-model="addEditObj.password"
                        v-validate="'required'" 
                        data-vv-scope="addEditValidation" 
                        :data-vv-as="$t('Password')"
                        :disabled="viewMode"
                    >
                    <div 
                        class="help-block" 
                        v-if="errors.has('addEditValidation.password')">
                        {{ errors.first('addEditValidation.password') }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group" 
                    :class="{'has-error':errors.has('addEditValidation.mobile')}"
                >
                    <label class="control-label">{{$t("Mobile")}}</label>
                    <label class="required">*</label>
                    <input type="text" name="mobile" 
                        class="form-control" 
                        v-model="addEditObj.mobile"
                        v-validate="'required'" 
                        data-vv-scope="addEditValidation" 
                        :data-vv-as="$t('Mobile')"
                        :disabled="viewMode"
                    >
                    <div 
                        class="help-block" 
                        v-if="errors.has('addEditValidation.mobile')">
                        {{ errors.first('addEditValidation.mobile') }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group" 
                    :class="{'has-error':errors.has('addEditValidation.countryID')}"
                >
                    <label class="control-label">{{$t("Country")}}</label>
                    <label class="required">*</label>
                    <el-select 
                        v-model="addEditObj.country_id"   
                        v-validate="'required'"
                        name="countryID" 
                        :data-vv-as="$t('Country')"
                        data-vv-scope="addEditValidation"  
                        :placeholder="$t('Select')" 
                        clearable 
                        filterable
                        :disabled="viewMode"
                    >
                        <el-option v-for="option in countries" 
                            :value="option.value" 
                            :label="option.label" 
                            :key="option.value"
                        >
                        </el-option>
                    </el-select>
                    <div 
                        class="help-block" 
                        v-if="errors.has('addEditValidation.countryID')">
                        {{ errors.first('addEditValidation.countryID') }}
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
                        this.$store.dispatch("customers/updateData", this.addEditObj)
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
                        this.$store.dispatch("customers/saveData", this.addEditObj)
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