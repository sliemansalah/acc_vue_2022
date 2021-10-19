<template>
  <div class="header-container fixed-top">
        <header class="header navbar navbar-expand-sm">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>
            <ul class="navbar-item flex-row search-ul">
                <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                    <a class="nav-link dropdown-toggle user cursor" 
                    id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" 
                    aria-expanded="false">
                       <span style="font-size:16px;font-weight:bold;">
                           {{$t('Hi')}}{{admin.name}}
                        </span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-item flex-row">
                <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                    <b-button
                    @click="changeTheme"
                    :style="adminTheme=='light'?'background:#000;color:#fff;': 'background:#fff;color:#000;'"
                    >
                    <span v-if="adminTheme=='dark'">{{$t('ConvertToLightTheme')}}</span>
                    <span v-else>{{$t('ConvertToDarkTheme')}}</span>
                    </b-button>
                </li>
                
            </ul>
            <ul class="navbar-item flex-row">
                <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                    <b-button @click="logout" variant="danger">{{$t('Logout')}}</b-button>
                </li>
            </ul>
        </header>
    </div>
</template>

<script>
export default {
    data() {
      return {
            adminTheme: localStorage.getItem("adminTheme")|| 'dark',
            admin: localStorage.getItem('admin')? JSON.parse(localStorage.getItem('admin')): null,
      }
    },
    methods: {
        changeTheme() {
            if(this.adminTheme == 'dark') {
                localStorage.setItem("adminTheme", 'light');
                this.$router.go(0)
            }else {
                localStorage.setItem("adminTheme", 'dark');
                this.$router.go(0)
            }
        },
        logout() {
        this.$notify.success({
            duration: 3000,
            message: this.$t("LogoutSuccessfully"),
            title: this.$t("Logout"),
            customClass: "top-center",
        });
        localStorage.removeItem('admin');
        localStorage.removeItem('admin_token');
        this.$store
                .dispatch("auth/logout2")
                .then(_ => {
                    window.location.href= "/admin";
                })
                .catch((error) => {
                    window.location.href= "/admin";
                })
        },
    },
    mounted() {
    let adminTheme= localStorage.getItem("adminTheme") || 'dark';
     let theme= document.getElementById("ourapp");
        if(adminTheme == 'dark') {
            theme.classList.add('themeDark');
            theme.classList.remove('themeLight');
        }
         else if (adminTheme == 'light') {
            theme.classList.remove('themeDark');
            theme.classList.add('themeLight');
        }
    }
}
</script>

<style lang="scss">

.themeDark{
    .navbar {
        background: #000 !important;
        border-bottom: 1px solid #575757 !important;
        a {
            color:#fff !important;
        }
    }
    input, select {
        background: #000;
        border: 1px solid #424242;
    }
    .page-item .page-link {
        background: #000 !important;
        border: 1px solid #575757 !important;
        color: #fff !important;
    }
    .page-item.active .page-link {
        background: #fff !important;
        border: 1px solid #575757 !important;
        color: #000 !important;
    }
    .el-select-dropdown__empty {
        background: #000;
        color: #fff;
    }
    #content {
        background: rgba(0, 0, 0, 0.897) !important;
        .card {
            background-color: rgba(7, 7, 10, 0.952) !important;
        }
        color: #fff !important;
        .table, h4 {
            color: #fff !important;
        }
    }
    label a {
        color: #fff !important;
        text-decoration: none !important;
    }
    label a.router-link-active {
        color: #7e7480 !important;
        text-decoration: none !important;
    }
    .form-control,
    .form-control:focus,
    .el-input__inner {
        color: #fff !important;
        background-color: #000 !important;
        border-color: #575757 !important;
    }
    .sidebar-theme {
        background: #000 !important;
        color: #fff !important;
        ul.menu-categories li.menu > .dropdown-toggle svg {
            color: #888ea8 !important;
            fill: rgba(0, 23, 55, 0.08);;
        }
        ul.menu-categories li.menu > .dropdown-toggle:hover span {
            color: #888ea8 !important;
        }
        ul.menu-categories li.menu.active {
            background: rgba(24, 26, 37, 0.35) !important;
            border: 1px solid rgba(85, 85, 85, 0.211765) !important;
        }
        ul.menu-categories li.menu a {
            color: #fff !important;
        }
        #sidebar .theme-brand {
            background-color: #060818;
            border-bottom: 1px solid #060818;
        }
    }
    .el-drawer.ltr {
        background: #000 !important;
        color: #fff !important;
    }
    .el-notification.right {
        background: #000 !important;
         .el-notification__title{
             color: #fff !important;
         }
        .el-notification__content p{
            color: #fff !important;
        }
    }
    
}
.themeLight  {

    
     .navbar {
        background: #fff !important;
        border-bottom: 1px solid #fafafa !important;
        a {
            color:#000 !important;
        }
    }
     #content {
        background: #f7f8ff !important;
    }

    input, select {
        background: #fff;
        border: 1px solid #fafafa;
    }
    .page-item .page-link {
        background: #fff !important;
        border: 1px solid #fafafa !important;
        color: #000 !important;
    }
    .page-item.active .page-link {
        background: #000 !important;
        border: 1px solid #fafafa !important;
        color: #fff !important;
    }
    .el-select-dropdown__empty {
        background: #fff;
        color: #000;
    }
    #content {
        color: #000 !important;
        .table, h4 {
            color: #000 !important;
        }
    }
    label a {
        color: #000 !important;
        text-decoration: none !important;
    }
    label a.router-link-active {
        color: rgb(25, 65, 197) !important;
        text-decoration: none !important;
    }
    .form-control,
    .form-control:focus,
    .el-input__inner {
        color: #000 !important;
        background-color: #fff !important;
        border-color: #cacaca !important;
    }
    .sidebar-theme {
            background: #fff !important;
            color: #000 !important;
        ul.menu-categories li.menu > .dropdown-toggle svg {
            color: #000 !important;
            fill: rgba(0, 0, 0, 0.08);;
        }
        ul.menu-categories li.menu > .dropdown-toggle:hover span {
            color: #888ea8 !important;
        }
        ul.menu-categories li.menu.active {
            background: rgba(161, 161, 161, 0.35) !important;
            border: 1px solid rgba(138, 137, 137, 0.212) !important;
        }
        ul.menu-categories li.menu a {
            color: #000 !important;
        }
        #sidebar .theme-brand {
            background-color: #ffffff;
            border-bottom: 1px solid #fdfdfd;
        }
    }
    .el-drawer.ltr {
        background: #fff !important;
        color: #000 !important;
    }
  
}
</style>