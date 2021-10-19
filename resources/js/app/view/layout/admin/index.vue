<template>
  <div>
    <!-- Auth -->
    <div v-if="isAdminLogin" id="sidebar-theme">
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
                <router-link to="/admin">
                  <img
                    v-if="adminTheme == 'dark'"
                    src="/assets/images/logo/white.png"
                    class="navbar-logo"
                    alt="logo"
                  />
                  <img
                    v-else
                    src="/assets/images/logo/black.png"
                    class="navbar-logo"
                    alt="logo"
                  />
                </router-link>
              </li>
            </ul>
            <!-- <div class="shadow-bottom"></div> -->

            <!-- SideBar -->

            <ul class="list-unstyled menu-categories" id="accordionExample">
              <li class="menu" :class="$route.name == 'admin' ? 'active' : ''">
                <router-link
                  to="/admin"
                  aria-expanded="false"
                  class="dropdown-toggle"
                >
                  <div class="">
                    <HomeIcon />
                    <span>{{ $t("Home") }}</span>
                  </div>
                </router-link>
              </li>
              <li
                class="menu"
                :class="$route.name == 'countries' ? 'active' : ''"
              >
                <router-link
                  to="/admin/countries"
                  aria-expanded="false"
                  class="dropdown-toggle"
                >
                  <div class="">
                    <CountriesIcon/>
                    <span>{{ $t("Countries") }}</span>
                  </div>
                </router-link>
              </li>

              <li class="menu" :class="$route.name == 'groups' ? 'active' : ''">
                <router-link
                  to="/admin/groups"
                  aria-expanded="false"
                  class="dropdown-toggle"
                >
                  <div class="">
                    <GroupsIcon/>
                    <span>{{ $t("Groups") }}</span>
                  </div>
                </router-link>
              </li>
              <li
                class="menu"
                :class="$route.name == 'itemTypes' ? 'active' : ''"
              >
                <router-link
                  to="/admin/itemTypes"
                  aria-expanded="false"
                  class="dropdown-toggle"
                >
                  <div class="">
                    <ItemTypesIcon />
                    <span>{{ $t("ItemTypes") }}</span>
                  </div>
                </router-link>
              </li>

              <li class="menu" :class="$route.name == 'stores' ? 'active' : ''">
                <router-link
                  to="/admin/stores"
                  aria-expanded="false"
                  class="dropdown-toggle"
                >
                  <div class="">
                    <StoresIcon />
                    <span>{{ $t("Stores") }}</span>
                  </div>
                </router-link>
              </li>

              <li
                class="menu"
                :class="$route.name == 'storeActivities' ? 'active' : ''"
              >
                <router-link
                  to="/admin/storeActivities"
                  aria-expanded="false"
                  class="dropdown-toggle"
                >
                  <div class="">
                    <ActivitiesIcon />
                    <span>{{ $t("StoreActivities") }}</span>
                  </div>
                </router-link>
              </li>

               <li
                class="menu"
                :class="$route.name == 'contactUsAdmin' ? 'active' : ''"
              >
                <router-link
                  to="/admin/contact-us"
                  aria-expanded="false"
                  class="dropdown-toggle"
                >
                  <div class="">
                    <ContactUsIcon />
                    <span>{{ $t("ContactMessages") }}</span>
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
        <div class="card shadow p-5" style="position: relative; right: 50%">
          <div>
            <div style="text-align: center" class="mb-4">
              <img
                width="400"
                height="150"
                src="/assets/images/logo/blue.png"
                alt=""
              />
            </div>
            <h3 class="text-center text-uppercase mb-4">تسجيل دخول كأدمن</h3>
            <hr />

            <div class="form-group">
              <label>الإيميل</label>
              <input
                v-model="loginObj.email"
                type="text"
                class="form-control"
              />
            </div>

            <label for="Password">كلمة المرور</label>
            <div class="input-group mb-3">
              <input
                v-model="loginObj.password"
                type="password"
                name="password"
                id="password"
                class="form-control"
              />
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
import HomeIcon from "../../icons/home";
import CountriesIcon from "../../icons/countries";
import GroupsIcon from "../../icons/groups";
import ItemTypesIcon from "../../icons/item_types";
import StoresIcon from "../../icons/stores";
import ActivitiesIcon from "../../icons/activities";
import ContactUsIcon from "../../icons/contactUs";
import navbar from "./navbar";
export default {
  components: {
    HomeIcon,
    CountriesIcon,
    GroupsIcon,
    ItemTypesIcon,
    StoresIcon,
    ActivitiesIcon,
    ContactUsIcon,
    navbar,
  },
  data() {
    return {
      isAdminLogin: localStorage.getItem("admin_token") || false,
      adminTheme: localStorage.getItem("adminTheme") || "dark",
      loginObj: {
        email: "",
        password: "",
      },
    };
  },
  methods: {
    login() {
      this.$store
        .dispatch("auth/login2", this.loginObj)
        .then((res) => {
          this.$notify.success({
            duration: 3000,
            message: this.$t("LoginSuccessfully"),
            title: this.$t("Login"),
            customClass: "top-center",
          });
          localStorage.setItem("admin", JSON.stringify(res.data.admin));
          localStorage.setItem("admin_token", res.data.token);
          window.location.href = "/admin";
        })
        .catch((error) => {
          this.$notify.error({
            duration: 3000,
            message: this.$t("LoginFailed"),
            title: this.$t("Login"),
            customClass: "top-center",
          });
        })
        .finally(() => {});
    },
  },
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