<template>
  <div>
    <!-- Auth -->
    <div v-if="isLogin">
    <!--  BEGIN NAVBAR  -->
    <navbar />
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">
      <div class="overlay"></div>
      <div class="search-overlay"></div>

      <!--  BEGIN SIDEBAR  -->
      <div class="sidebar-wrapper sidebar-theme">
        <nav id="sidebar">
          <ul class="navbar-nav theme-brand flex-row text-center">
            <li class="nav-item theme-logo">
              <router-link to="/">
                <img
                  src="/assets/images/logo/white.png"
                  class="navbar-logo"
                  alt="logo"
                />
              </router-link>
            </li>
          </ul>
          <!-- <div class="shadow-bottom"></div> -->

          <!-- SideBar -->

          <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu" :class="$route.name == 'seller' ? 'active' : ''">
              <router-link to="/" aria-expanded="false" class="dropdown-toggle">
                <div class="">
                  <HomeIcon/>
                  <span>{{$t('Home')}}</span>
                </div>
              </router-link>
            </li>
            <li
              class="menu"
              :class="$route.name == 'categories' ? 'active' : ''"
            >
              <router-link
                to="/categories"
                aria-expanded="false"
                class="dropdown-toggle"
              >
                <div class="">
                  <CategoriesIcon/>
                  <span>{{$t('Categories')}}</span>
                </div>
              </router-link>
            </li>
            <li class="menu" :class="$route.name == 'items' ? 'active' : ''">
              <router-link
                to="/items"
                aria-expanded="false"
                class="dropdown-toggle"
              >
                <div class="">
                  <ItemsIcon />
                  <span>{{$t('Items')}}</span>
                </div>
              </router-link>
            </li>

            <li
              class="menu"
              :class="$route.name == 'customers' ? 'active' : ''"
            >
              <router-link
                to="/customers"
                aria-expanded="false"
                class="dropdown-toggle"
              >
                <div class="">
                  <CustomersIcon />
                  <span>{{$t('Customers')}}</span>
                </div>
              </router-link>
            </li>

            <li
              class="menu"
              :class="$route.name == 'coupons' ? 'active' : ''"
            >
              <router-link
                to="/coupons"
                aria-expanded="false"
                class="dropdown-toggle"
              >
                <div class="">
                  <CouponsIcon />
                  <span>{{$t('Coupons')}}</span>
                </div>
              </router-link>
            </li>

            <li class="menu" :class="$route.name == 'rates' ? 'active' : ''">
              <router-link
                to="/rates"
                aria-expanded="false"
                class="dropdown-toggle"
              >
                <div class="">
                  <RatesIcon />
                  <span>{{$t('Rates')}}</span>
                </div>
              </router-link>
            </li>

            <li class="menu" :class="$route.name == 'orders' ? 'active' : ''">
              <router-link
                to="/orders"
                aria-expanded="false"
                class="dropdown-toggle"
              >
                <div class="">
                  <OrdersIcon />
                  <span>{{$t('Orders')}}</span>
                </div>
              </router-link>
            </li>

            <li class="menu" :class="$route.name == 'pages' ? 'active' : ''">
              <router-link
                to="/pages"
                aria-expanded="false"
                class="dropdown-toggle"
              >
                <div class="">
                  <PagesIcon/>
                  <span>{{$t('Pages')}}</span>
                </div>
              </router-link>
            </li>

            <li class="menu" :class="$route.name == 'contact-us' ? 'active' : ''">
              <router-link
                to="/contact-us"
                aria-expanded="false"
                class="dropdown-toggle"
              >
                <div class="">
                  <ContactUsIcon/>
                  <span>{{$t('ContactUs')}}</span>
                </div>
              </router-link>
            </li>

             <li class="menu" :class="$route.name == 'settings' ? 'active' : ''">
              <router-link
                to="/settings"
                aria-expanded="false"
                class="dropdown-toggle"
              >
                <div class="">
                  <SettingsIcon/>
                  <span>{{$t('Settings')}}</span>
                </div>
              </router-link>
            </li>

          </ul>
        </nav>
      </div>
      <!--  END SIDEBAR  -->

      <!--  BEGIN CONTENT AREA  -->
      <div id="content" class="main-content">
        <div class="layout-px-spacing">
          <router-view />
        </div>
        <!--  End CONTENT AREA  -->

        <!-- footer -->
        <div class="footer-wrapper">
          <div class="footer-section f-section-1">
            <p class="">Copyright © 2021 , All rights reserved.</p>
          </div>
          <div class="footer-section f-section-2">
            <p class="">
              Coded with S2M
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="feather feather-heart"
              >
                <path
                  d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"
                ></path>
              </svg>
            </p>
          </div>
        </div>
      </div>
      <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->
  </div>

  <div v-else>
       <section class="col-md-6 my-5 offset-md-3">

      <div class="card shadow p-5"
      style="position: relative;
    right: 50%;"
      >
        <div>
          <div style="text-align:center;" class="mb-4">
            <img  width="400" height="150" src="/assets/images/logo/blue.png" alt="">
          </div>
          <h3 class="text-center text-uppercase mb-4">تسجيل دخول</h3>
          <hr>

          <div class="form-group">
            <label>الإيميل أو الموبايل</label>
            <input v-model="loginObj.username" type="text"  class="form-control">
          </div>

          <label for="Password">كلمة المرور</label>
          <div class="input-group mb-3">
            <input v-model="loginObj.password" type="password" name="password" id="password" class="form-control" >
          </div>

          <button
           class="btn btn-block btn-primary rounded-pill mt-3"
           @click="login"
          >
            دخول
          </button>
        </div>
      </div>
    </section>
  </div>

  </div>
</template>

<script>
import navbar from "./navbar";
import HomeIcon from "../../icons/home";
import CategoriesIcon from "../../icons/categories";
import CustomersIcon from "../../icons/customers";
import ItemsIcon from "../../icons/items";
import CouponsIcon from "../../icons/coupons";
import RatesIcon from "../../icons/rates";
import PagesIcon from "../../icons/pages";
import OrdersIcon from "../../icons/orders";
import SettingsIcon from "../../icons/settings";
import ContactUsIcon from "../../icons/contactUs";
export default {
   components: {
    HomeIcon,
    CategoriesIcon,
    CustomersIcon,
    ItemsIcon,
    CouponsIcon,
    RatesIcon,
    PagesIcon,
    OrdersIcon,
    SettingsIcon,
    ContactUsIcon,
    navbar,
  },
  data() {
    return {
      isLogin: localStorage.getItem('token') || false,
      loginObj: {
        username: '',
        password: ''
      }
    }
  },
  methods: {
    login() {
       this.$store
              .dispatch("auth/login", this.loginObj)
              .then(res => {
                this.$notify.success({
                  duration: 3000,
                  message: this.$t("LoginSuccessfully"),
                  title: this.$t("Login"),
                  customClass: "top-center",
                });
                localStorage.setItem('user',JSON.stringify(res.data.user));
                localStorage.setItem('token',res.data.token);
                window.location.href= "/";
              })
              .catch((error) => {
                this.$notify.error({
                  duration: 3000,
                  message: this.$t("LoginFailed"),
                  title: this.$t("Login"),
                  customClass: "top-center",
                });
              })
              .finally(() => {
              });
    },
  }
};
</script>

<style>
#sidebar .theme-brand li.theme-logo img {
  width: 200px;
  height: 80px;
  margin-top: 20px;
  border-radius: 5px;
}
</style>