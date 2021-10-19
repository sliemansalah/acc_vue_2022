(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[18],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/app/view/pages/admin/home/homePage.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/app/view/pages/admin/home/homePage.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      dashboard: {
        totalActivities: 0,
        totalCountries: 0,
        totalGroups: 0,
        totalItemTypes: 0,
        totalStores: 0
      }
    };
  },
  created: function created() {
    var _this = this;

    this.$store.dispatch("admin_dashboard/getData").then(function (res) {
      _this.dashboard = res.data;
    });
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/app/view/pages/admin/home/homePage.vue?vue&type=template&id=02a7e016&":
/*!**************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/app/view/pages/admin/home/homePage.vue?vue&type=template&id=02a7e016& ***!
  \**************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c("div", { staticClass: "mt-3" }, [
        _c(
          "label",
          [
            _c("router-link", { attrs: { to: "/admin" } }, [
              _vm._v(_vm._s(_vm.$t("Home")))
            ])
          ],
          1
        )
      ]),
      _vm._v(" "),
      _c("h4", { staticClass: "mt-3" }, [_vm._v(_vm._s(_vm.$t("Home")))]),
      _vm._v(" "),
      _c(
        "b-row",
        { staticClass: "mt-3" },
        [
          _c(
            "b-col",
            { attrs: { md: "3" } },
            [
              _c(
                "b-card-group",
                { attrs: { deck: "" } },
                [
                  _c(
                    "b-card",
                    {
                      staticClass: "text-center",
                      attrs: {
                        "bg-variant": "primary",
                        "text-variant": "white",
                        header: "الدول"
                      }
                    },
                    [
                      _c(
                        "b-card-text",
                        { staticClass: "text-white text-bold" },
                        [_vm._v(_vm._s(_vm.dashboard.totalCountries))]
                      )
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "b-col",
            { attrs: { md: "3" } },
            [
              _c(
                "b-card-group",
                { attrs: { deck: "" } },
                [
                  _c(
                    "b-card",
                    {
                      staticClass: "text-center",
                      attrs: {
                        "bg-variant": "success",
                        "text-variant": "white",
                        header: "أنشطة المتجر"
                      }
                    },
                    [
                      _c(
                        "b-card-text",
                        { staticClass: "text-white text-bold" },
                        [_vm._v(_vm._s(_vm.dashboard.totalActivities))]
                      )
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "b-col",
            { attrs: { md: "3" } },
            [
              _c(
                "b-card-group",
                { attrs: { deck: "" } },
                [
                  _c(
                    "b-card",
                    {
                      staticClass: "text-center",
                      attrs: {
                        "bg-variant": "info",
                        "text-variant": "white",
                        header: "المجموعات"
                      }
                    },
                    [
                      _c(
                        "b-card-text",
                        { staticClass: "text-white text-bold" },
                        [_vm._v(_vm._s(_vm.dashboard.totalGroups))]
                      )
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "b-col",
            { attrs: { md: "3" } },
            [
              _c(
                "b-card-group",
                { attrs: { deck: "" } },
                [
                  _c(
                    "b-card",
                    {
                      staticClass: "text-center",
                      attrs: {
                        "bg-variant": "dark",
                        "text-variant": "white",
                        header: "أنواع المنتجات"
                      }
                    },
                    [
                      _c(
                        "b-card-text",
                        { staticClass: "text-white text-bold" },
                        [_vm._v(_vm._s(_vm.dashboard.totalItemTypes))]
                      )
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "b-row",
        { staticClass: "mt-3" },
        [
          _c(
            "b-col",
            { attrs: { md: "3" } },
            [
              _c(
                "b-card-group",
                { attrs: { deck: "" } },
                [
                  _c(
                    "b-card",
                    {
                      staticClass: "text-center",
                      attrs: {
                        "bg-variant": "dark",
                        "text-variant": "white",
                        header: "المتاجر"
                      }
                    },
                    [
                      _c(
                        "b-card-text",
                        { staticClass: "text-white text-bold" },
                        [_vm._v(_vm._s(_vm.dashboard.totalStores))]
                      )
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          )
        ],
        1
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/app/view/pages/admin/home/homePage.vue":
/*!*************************************************************!*\
  !*** ./resources/js/app/view/pages/admin/home/homePage.vue ***!
  \*************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _homePage_vue_vue_type_template_id_02a7e016___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./homePage.vue?vue&type=template&id=02a7e016& */ "./resources/js/app/view/pages/admin/home/homePage.vue?vue&type=template&id=02a7e016&");
/* harmony import */ var _homePage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./homePage.vue?vue&type=script&lang=js& */ "./resources/js/app/view/pages/admin/home/homePage.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _homePage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _homePage_vue_vue_type_template_id_02a7e016___WEBPACK_IMPORTED_MODULE_0__["render"],
  _homePage_vue_vue_type_template_id_02a7e016___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/app/view/pages/admin/home/homePage.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/app/view/pages/admin/home/homePage.vue?vue&type=script&lang=js&":
/*!**************************************************************************************!*\
  !*** ./resources/js/app/view/pages/admin/home/homePage.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_homePage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./homePage.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/app/view/pages/admin/home/homePage.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_homePage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/app/view/pages/admin/home/homePage.vue?vue&type=template&id=02a7e016&":
/*!********************************************************************************************!*\
  !*** ./resources/js/app/view/pages/admin/home/homePage.vue?vue&type=template&id=02a7e016& ***!
  \********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_homePage_vue_vue_type_template_id_02a7e016___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./homePage.vue?vue&type=template&id=02a7e016& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/app/view/pages/admin/home/homePage.vue?vue&type=template&id=02a7e016&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_homePage_vue_vue_type_template_id_02a7e016___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_homePage_vue_vue_type_template_id_02a7e016___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);