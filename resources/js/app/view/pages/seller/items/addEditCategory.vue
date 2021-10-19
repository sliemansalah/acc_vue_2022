<template>
  <div>
     <div slot="header" class="clearfix">
          <div class="row">
            <div class="col-md-12">
              <div>
                <el-input
                  class="mb-2"
                  placeholder="بحث عن تصنيف"
                  prefix-icon="el-icon-search"
                  v-model="filterCategory"
                >
                </el-input>
              </div>
            </div>
          </div>
        </div>

      <div class="row">
          <div class="col-md-12">
            <el-tree
              :default-expand-all="expanded"
              :filter-node-method="filterNode"
              icon-class="el-icon-caret-left"
              :props="defaultProps"
              :data="categories"
              check-on-click-node
              highlight-current
              node-key="id"
              ref="tree"
              @node-click="nodeClick"
            ></el-tree>
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
 watch: {
    filterCategory(val) {
      this.$refs.tree.filter(val);
    },
  },
data() {
    return {
      categories: [],
      expanded: true,
      defaultProps: {
        children: "children",
        label: "name",
      },
       filterCategory: null,
    }
},
methods: {
    filterNode(value, data) {
      if (!value) return true;
      return data.name.toLowerCase().indexOf(value.toLowerCase()) !== -1;
    },
    nodeClick(data) {
      this.selectedCategory = {
        id: data.id,
        name: data.name,
      };
    },
     saveAddEdit() {
       this.$emit('saveAddEdit', this.selectedCategory);
    },
    initData() {
         this.$store
        .dispatch("categories/getData")
        .then((res) => {
          this.categories = res.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
},
created() {
    this.initData();
}
}
</script>
