<template>
  <div id="app">
    <NavBar />
    <!--  Main Container Starts  -->
    <div class="main-container" id="container">
        <div class="overlay"></div>
        <div class="search-overlay"></div>
        <div class="rightbar-overlay"></div>
        
        <SideBar />

        <!--  Content Area Starts  -->
        <div id="content" class="main-content">
      
            <!-- Main Body Starts -->
            <router-view/>

            <!-- <ReloadPage /> -->

            <!-- Copyright Footer Starts -->
            <div class="footer-wrapper" style="position:absolute;bottom:0;">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © 2021 <a target="_blank" href="https://xato-web.web.app/">XatoWeb</a>, All rights reserved.</p>
                </div>
                <div class="footer-section f-section-2">
                    <p class="">Crafted with extra <i class="las la-heart text-danger"></i></p>
                </div>
            </div>
            <!-- Copyright Footer Ends -->
            <!-- Arrow Starts -->
            <div class="scroll-top-arrow" style="display: none;">
                <i class="las la-angle-up"></i>
            </div>
            <!-- Arrow Ends -->
        </div>
        <!--  Content Area Ends  -->

   </div>
    <!--  Main Container end  -->
  </div>
</template>

<script>
import NavBar from '@/components/template/NavBar.vue';
import SideBar from '@/components/template/SideBar.vue';
// import ReloadPage from '@/components/template/ReloadPage.vue';
export default {
  name: "app",
  components: { 
    NavBar, 
    SideBar, 
    // ReloadPage,
  },
};
</script>