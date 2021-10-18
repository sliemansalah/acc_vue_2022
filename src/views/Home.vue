<template>
  <div>

    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
                <i class="las la-bars"></i>
            </a>
            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">
                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <BreadCrumb title="الرئيسية"  subTitle="الرئيسية"/>
                        </nav>
                    </div>
                </li>
            </ul>
        </header>
      </div>
      
    <h2 class="mt-4 mr-4 ml-4">أنت في الصفحة الرئيسية</h2>
  </div>
</template>

<script>
import BreadCrumb from '@/components/template/BreadCrumb.vue';
export default {
  name: "Home",
  components: {BreadCrumb},
  created() {
    $(document).ready(function() {
      App.init();
    });
  }
};
</script>


