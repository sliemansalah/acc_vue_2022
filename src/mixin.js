var mixin = {
    methods: {
      notifyError(title, result) {
        this.$notify.error({
          title: this.$t(title),
          message: result.response.data.errors,
          duration: 3000,
          customClass: "top-center",
        });
      },
      notifySuccess(title, result) {
        this.$notify.success({
          title: this.$t(title),
          message: result.message,
          duration: 3000,
          customClass: "top-center",
        });
      },
      loginSuccess(result) {
        localStorage.setItem("user", JSON.stringify(result.data.user));
        localStorage.setItem("token", result.data.token);
        window.location.href = "/";
      },
      logoutSuccess() {
        localStorage.removeItem('user');
        localStorage.removeItem('token');
        window.location.href = "/";
      }
    }
  }
export default mixin;