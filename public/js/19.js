(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[19],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/app/view/pages/seller/categories/categoriesPage.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/app/view/pages/seller/categories/categoriesPage.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var sweetalert2__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! sweetalert2 */ "./node_modules/sweetalert2/dist/sweetalert2.all.js");
/* harmony import */ var sweetalert2__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(sweetalert2__WEBPACK_IMPORTED_MODULE_0__);
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
  watch: {
    filterCategory: function filterCategory(val) {
      this.$refs.tree.filter(val);
    }
  },
  data: function data() {
    return {
      rules: {
        name: [{
          required: true,
          message: "أدخل اسم تصنيف المنتج",
          trigger: "blur"
        }]
      },
      form: {
        name: null,
        status: true,
        parent_id: null
      },
      categories: [],
      expanded: true,
      defaultProps: {
        children: "children",
        label: "name"
      },
      filterCategory: null,
      saveLoading: false,
      childToAddFlag: true
    };
  },
  methods: {
    clearData: function clearData() {
      this.form = {
        name: null,
        status: true,
        parent_id: null
      };
      this.childToAddFlag = true;
    },
    addChild: function addChild() {
      this.form.name = "";
      this.childToAddFlag = true;
    },
    removeData: function removeData() {
      var _this = this;

      sweetalert2__WEBPACK_IMPORTED_MODULE_0___default.a.fire({
        title: "هل أنت متأكد؟",
        text: "هل تريد حقًا حذف هذا التصنيف",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "نعم، احذفه.",
        cancelButtonText: "لا"
      }).then(function (result) {
        if (result.isConfirmed) {
          _this.$store.dispatch("categories/removeData", _this.form.parent_id).then(function () {
            _this.$notify({
              title: 'حذف',
              message: 'تم حذف التصنيف بنجاح',
              type: 'success',
              position: 'top-left',
              showClose: false,
              duration: 1200
            });

            _this.initData();

            _this.clearData();
          })["catch"](function (error) {
            _this.$notify({
              title: 'خطأ',
              message: error,
              type: 'error',
              position: 'top-left'
            });
          });
        }
      });
    },
    saveData: function saveData() {
      var _this2 = this;

      this.$refs["form"].validate(function (valid) {
        if (valid) {
          _this2.saveLoading = true;

          _this2.$store.dispatch("categories/saveData", _this2.form).then(function () {
            _this2.$notify({
              title: 'حفظ',
              message: 'تم إضافة التصنيف بنجاح',
              type: 'success',
              position: 'top-left',
              showClose: false,
              duration: 1200
            });

            _this2.initData();

            _this2.clearData();
          })["catch"](function (error) {
            _this2.$notify({
              title: 'خطأ',
              message: error,
              type: 'error',
              position: 'top-left'
            });
          })["finally"](function () {
            _this2.saveLoading = false;
          });
        }
      });
    },
    updateData: function updateData() {
      var _this3 = this;

      this.$refs["form"].validate(function (valid) {
        if (valid) {
          _this3.saveLoading = true;

          _this3.$store.dispatch("categories/updateData", _this3.form).then(function () {
            _this3.$notify({
              title: 'تحديث',
              message: 'تم تحديث التصنيف بنجاح',
              type: 'success',
              position: 'top-left',
              showClose: false,
              duration: 1200
            });

            _this3.initData();

            _this3.clearData();
          })["catch"](function (error) {
            _this3.$notify({
              title: 'خطأ',
              message: error,
              type: 'error',
              position: 'top-left'
            });
          })["finally"](function () {
            _this3.saveLoading = false;
          });
        }
      });
    },
    nodeClick: function nodeClick(data) {
      var status;
      data.status == 1 ? status = true : status = false;
      this.form = {
        name: data.name,
        status: status,
        parent_id: data.id
      };
      this.childToAddFlag = false;
    },
    filterNode: function filterNode(value, data) {
      if (!value) return true;
      return data.name.toLowerCase().indexOf(value.toLowerCase()) !== -1;
    },
    initData: function initData() {
      var _this4 = this;

      this.$store.dispatch("categories/getData").then(function (res) {
        _this4.categories = res.data;
      })["catch"](function (error) {
        console.log(error);
      });
    }
  },
  created: function created() {
    this.initData();
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/app/view/pages/seller/categories/categoriesPage.vue?vue&type=template&id=b60862b2&":
/*!***************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/app/view/pages/seller/categories/categoriesPage.vue?vue&type=template&id=b60862b2& ***!
  \***************************************************************************************************************************************************************************************************************************************/
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
  return _c("div", { staticClass: "mt-4 ml-4" }, [
    _c("div", { staticClass: "mt-3" }, [
      _c(
        "label",
        [
          _c("router-link", { attrs: { to: "/" } }, [
            _vm._v(_vm._s(_vm.$t("Home")))
          ])
        ],
        1
      ),
      _vm._v(" "),
      _c("span", [_vm._v("/")]),
      _vm._v(" "),
      _c("label", { attrs: { active: "" } }, [
        _vm._v(_vm._s(_vm.$t("Categories")))
      ])
    ]),
    _vm._v(" "),
    _c("h4", { staticClass: "mt-3" }, [_vm._v(_vm._s(_vm.$t("Categories")))]),
    _vm._v(" "),
    _c("div", { staticClass: "row" }, [
      _c(
        "div",
        { staticClass: "col-md-5" },
        [
          _c(
            "el-card",
            { staticClass: "box-card" },
            [
              _c(
                "div",
                { staticClass: "row" },
                [
                  _c(
                    "el-button",
                    {
                      staticClass: "ml-3 mb-4",
                      staticStyle: { width: "25%" },
                      attrs: { disabled: !!_vm.form.parent_id, type: "primary" }
                    },
                    [_vm._v("إضافة أب")]
                  ),
                  _vm._v(" "),
                  _c(
                    "el-button",
                    {
                      staticClass: "ml-3 mb-4",
                      staticStyle: { width: "25%" },
                      attrs: { disabled: !_vm.form.parent_id, type: "info" },
                      on: { click: _vm.addChild }
                    },
                    [_vm._v("إضافة ابن")]
                  )
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "el-form",
                { ref: "form", attrs: { rules: _vm.rules, model: _vm.form } },
                [
                  _c(
                    "el-form-item",
                    { attrs: { prop: "name" } },
                    [
                      _c("el-input", {
                        attrs: { placeholder: "اسم تصنيف المنتج " },
                        model: {
                          value: _vm.form.name,
                          callback: function($$v) {
                            _vm.$set(_vm.form, "name", $$v)
                          },
                          expression: "form.name"
                        }
                      })
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "el-form-item",
                    [
                      _c("span", [_vm._v(" حالة تصنيف المنتج ")]),
                      _vm._v(" "),
                      _c("el-switch", {
                        model: {
                          value: _vm.form.status,
                          callback: function($$v) {
                            _vm.$set(_vm.form, "status", $$v)
                          },
                          expression: "form.status"
                        }
                      })
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "div",
                    { staticClass: "row" },
                    [
                      _c(
                        "el-button",
                        {
                          staticClass: "ml-3 mb-4",
                          staticStyle: { width: "25%" },
                          attrs: { type: "secondary" },
                          on: { click: _vm.clearData }
                        },
                        [_vm._v("تفريغ")]
                      ),
                      _vm._v(" "),
                      _vm.form.parent_id
                        ? _c(
                            "el-button",
                            {
                              staticClass: "ml-3 mb-4",
                              staticStyle: { width: "25%" },
                              attrs: { type: "danger" },
                              on: { click: _vm.removeData }
                            },
                            [_vm._v("حذف")]
                          )
                        : _vm._e(),
                      _vm._v(" "),
                      !!_vm.childToAddFlag
                        ? _c(
                            "el-button",
                            {
                              directives: [
                                {
                                  name: "loading",
                                  rawName: "v-loading",
                                  value: _vm.saveLoading,
                                  expression: "saveLoading"
                                }
                              ],
                              staticClass: "ml-3 mb-4",
                              staticStyle: { width: "25%" },
                              attrs: { type: "success" },
                              on: { click: _vm.saveData }
                            },
                            [_vm._v("حفظ")]
                          )
                        : _vm._e(),
                      _vm._v(" "),
                      !_vm.childToAddFlag
                        ? _c(
                            "el-button",
                            {
                              directives: [
                                {
                                  name: "loading",
                                  rawName: "v-loading",
                                  value: _vm.saveLoading,
                                  expression: "saveLoading"
                                }
                              ],
                              staticClass: "ml-3 mb-4",
                              staticStyle: { width: "25%" },
                              attrs: { type: "success" },
                              on: { click: _vm.updateData }
                            },
                            [_vm._v("تحديث")]
                          )
                        : _vm._e()
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
        "div",
        { staticClass: "col-md-7" },
        [
          _c("el-card", { staticClass: "box-card" }, [
            _c(
              "div",
              {
                staticClass: "clearfix",
                attrs: { slot: "header" },
                slot: "header"
              },
              [
                _c("div", { staticClass: "row" }, [
                  _c("div", { staticClass: "col-md-12" }, [
                    _c(
                      "div",
                      [
                        _c("el-input", {
                          staticClass: "mb-2",
                          attrs: {
                            placeholder: "بحث عن تصنيف",
                            "prefix-icon": "el-icon-search"
                          },
                          model: {
                            value: _vm.filterCategory,
                            callback: function($$v) {
                              _vm.filterCategory = $$v
                            },
                            expression: "filterCategory"
                          }
                        })
                      ],
                      1
                    )
                  ])
                ])
              ]
            ),
            _vm._v(" "),
            _c("div", { staticClass: "row" }, [
              _c(
                "div",
                { staticClass: "col-md-12" },
                [
                  _c("el-tree", {
                    ref: "tree",
                    attrs: {
                      "default-expand-all": _vm.expanded,
                      "filter-node-method": _vm.filterNode,
                      "icon-class": "el-icon-caret-left",
                      props: _vm.defaultProps,
                      data: _vm.categories,
                      "check-on-click-node": "",
                      "highlight-current": "",
                      "node-key": "id"
                    },
                    on: { "node-click": _vm.nodeClick }
                  })
                ],
                1
              )
            ])
          ])
        ],
        1
      )
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/app/view/pages/seller/categories/categoriesPage.vue":
/*!**************************************************************************!*\
  !*** ./resources/js/app/view/pages/seller/categories/categoriesPage.vue ***!
  \**************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _categoriesPage_vue_vue_type_template_id_b60862b2___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./categoriesPage.vue?vue&type=template&id=b60862b2& */ "./resources/js/app/view/pages/seller/categories/categoriesPage.vue?vue&type=template&id=b60862b2&");
/* harmony import */ var _categoriesPage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./categoriesPage.vue?vue&type=script&lang=js& */ "./resources/js/app/view/pages/seller/categories/categoriesPage.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _categoriesPage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _categoriesPage_vue_vue_type_template_id_b60862b2___WEBPACK_IMPORTED_MODULE_0__["render"],
  _categoriesPage_vue_vue_type_template_id_b60862b2___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/app/view/pages/seller/categories/categoriesPage.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/app/view/pages/seller/categories/categoriesPage.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************!*\
  !*** ./resources/js/app/view/pages/seller/categories/categoriesPage.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_categoriesPage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./categoriesPage.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/app/view/pages/seller/categories/categoriesPage.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_categoriesPage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/app/view/pages/seller/categories/categoriesPage.vue?vue&type=template&id=b60862b2&":
/*!*********************************************************************************************************!*\
  !*** ./resources/js/app/view/pages/seller/categories/categoriesPage.vue?vue&type=template&id=b60862b2& ***!
  \*********************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_categoriesPage_vue_vue_type_template_id_b60862b2___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./categoriesPage.vue?vue&type=template&id=b60862b2& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/app/view/pages/seller/categories/categoriesPage.vue?vue&type=template&id=b60862b2&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_categoriesPage_vue_vue_type_template_id_b60862b2___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_categoriesPage_vue_vue_type_template_id_b60862b2___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);