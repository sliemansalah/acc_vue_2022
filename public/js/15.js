(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[15],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/app/view/pages/seller/contactUs/contactUsPage.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/app/view/pages/seller/contactUs/contactUsPage.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************************/
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
      inputs: {
        id: 0,
        name: "",
        email: "",
        attachments: [],
        message: ""
      },
      editorConfig: {
        removePlugins: ["about", "resize"]
      }
    };
  },
  methods: {
    clearData: function clearData() {
      this.inputs = {
        id: 0,
        name: "",
        email: "",
        attachments: [],
        message: ""
      };
      this.$validator.reset();
    },
    sendMessage: function sendMessage() {
      var _this = this;

      this.$validator.validateAll("addEditValidation").then(function (result) {
        if (result) {
          _this.$store.dispatch("contact_us/saveData", _this.inputs).then(function (res) {
            _this.activities = res.data;

            _this.$notify.success({
              duration: 3000,
              message: _this.$t("SendSuccessfully"),
              title: _this.$t("ContactUs"),
              customClass: "top-center"
            });

            _this.clearData();
          })["catch"](function (err) {});
        }
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/app/view/pages/seller/contactUs/contactUsPage.vue?vue&type=style&index=0&lang=css&":
/*!****************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--5-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--5-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/app/view/pages/seller/contactUs/contactUsPage.vue?vue&type=style&index=0&lang=css& ***!
  \****************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.form-file-text {\r\n  position: relative;\r\n  right: 80px;\n}\r\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/app/view/pages/seller/contactUs/contactUsPage.vue?vue&type=style&index=0&lang=css&":
/*!********************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--5-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--5-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/app/view/pages/seller/contactUs/contactUsPage.vue?vue&type=style&index=0&lang=css& ***!
  \********************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../../../../node_modules/css-loader??ref--5-1!../../../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../../../node_modules/postcss-loader/src??ref--5-2!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./contactUsPage.vue?vue&type=style&index=0&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/app/view/pages/seller/contactUs/contactUsPage.vue?vue&type=style&index=0&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/app/view/pages/seller/contactUs/contactUsPage.vue?vue&type=template&id=27f8b436&":
/*!*************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/app/view/pages/seller/contactUs/contactUsPage.vue?vue&type=template&id=27f8b436& ***!
  \*************************************************************************************************************************************************************************************************************************************/
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
          _vm._v(_vm._s(_vm.$t("ContactUs")))
        ])
      ]),
      _vm._v(" "),
      _c("h4", { staticClass: "mt-3" }, [_vm._v(_vm._s(_vm.$t("ContactUs")))]),
      _vm._v(" "),
      _c(
        "b-card",
        {
          staticClass: "mt-3",
          scopedSlots: _vm._u([
            {
              key: "header",
              fn: function() {
                return [
                  _c(
                    "h5",
                    { staticStyle: { "font-weight": "bold", color: "#000" } },
                    [
                      _vm._v(
                        "\n        " +
                          _vm._s(_vm.$t("ContactUsInformation")) +
                          "\n      "
                      )
                    ]
                  )
                ]
              },
              proxy: true
            }
          ])
        },
        [
          _vm._v(" "),
          _c("b-card-text", { staticClass: "text-center" }, [
            _c("div", { staticClass: "text-center" }, [
              _c(
                "div",
                { staticClass: "row mt-3" },
                [
                  _c("b-col", { attrs: { md: "2" } }),
                  _vm._v(" "),
                  _c("b-col", { attrs: { md: "4" } }, [
                    _c(
                      "div",
                      {
                        staticClass: "form-group",
                        class: {
                          "has-error": _vm.errors.has("addEditValidation.name")
                        }
                      },
                      [
                        _c("label", { staticClass: "control-label" }, [
                          _vm._v(_vm._s(_vm.$t("Name")))
                        ]),
                        _vm._v(" "),
                        _c("label", { staticClass: "required" }, [_vm._v("*")]),
                        _vm._v(" "),
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.inputs.name,
                              expression: "inputs.name"
                            },
                            {
                              name: "validate",
                              rawName: "v-validate",
                              value: "required",
                              expression: "'required'"
                            }
                          ],
                          staticClass: "form-control",
                          attrs: {
                            type: "text",
                            name: "name",
                            "data-vv-scope": "addEditValidation",
                            "data-vv-as": _vm.$t("Name")
                          },
                          domProps: { value: _vm.inputs.name },
                          on: {
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.$set(_vm.inputs, "name", $event.target.value)
                            }
                          }
                        }),
                        _vm._v(" "),
                        _vm.errors.has("addEditValidation.name")
                          ? _c("div", { staticClass: "help-block" }, [
                              _vm._v(
                                "\n                " +
                                  _vm._s(
                                    _vm.errors.first("addEditValidation.name")
                                  ) +
                                  "\n              "
                              )
                            ])
                          : _vm._e()
                      ]
                    )
                  ]),
                  _vm._v(" "),
                  _c("b-col", { attrs: { md: "4" } }, [
                    _c(
                      "div",
                      {
                        staticClass: "form-group",
                        class: {
                          "has-error": _vm.errors.has("addEditValidation.email")
                        }
                      },
                      [
                        _c("label", { staticClass: "control-label" }, [
                          _vm._v(_vm._s(_vm.$t("Email")))
                        ]),
                        _vm._v(" "),
                        _c("label", { staticClass: "required" }, [_vm._v("*")]),
                        _vm._v(" "),
                        _c("input", {
                          directives: [
                            {
                              name: "model",
                              rawName: "v-model",
                              value: _vm.inputs.email,
                              expression: "inputs.email"
                            },
                            {
                              name: "validate",
                              rawName: "v-validate",
                              value: "required|email",
                              expression: "'required|email'"
                            }
                          ],
                          staticClass: "form-control",
                          attrs: {
                            type: "text",
                            name: "email",
                            "data-vv-scope": "addEditValidation",
                            "data-vv-as": _vm.$t("Email")
                          },
                          domProps: { value: _vm.inputs.email },
                          on: {
                            input: function($event) {
                              if ($event.target.composing) {
                                return
                              }
                              _vm.$set(_vm.inputs, "email", $event.target.value)
                            }
                          }
                        }),
                        _vm._v(" "),
                        _vm.errors.has("addEditValidation.email")
                          ? _c("div", { staticClass: "help-block" }, [
                              _vm._v(
                                "\n                " +
                                  _vm._s(
                                    _vm.errors.first("addEditValidation.email")
                                  ) +
                                  "\n              "
                              )
                            ])
                          : _vm._e()
                      ]
                    )
                  ])
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "div",
                { staticClass: "row mt-3" },
                [
                  _c("b-col", { attrs: { md: "2" } }),
                  _vm._v(" "),
                  _c("b-col", { attrs: { md: "8" } }, [
                    _c(
                      "div",
                      {
                        staticClass: "form-group",
                        class: {
                          "has-error": _vm.errors.has(
                            "addEditValidation.message"
                          )
                        }
                      },
                      [
                        _c("label", { staticClass: "control-label" }, [
                          _vm._v(_vm._s(_vm.$t("Message")))
                        ]),
                        _vm._v(" "),
                        _c("label", { staticClass: "required" }, [_vm._v("*")]),
                        _vm._v(" "),
                        _c("ckeditor", {
                          directives: [
                            {
                              name: "validate",
                              rawName: "v-validate",
                              value: "required",
                              expression: "'required'"
                            }
                          ],
                          attrs: {
                            name: "message",
                            config: _vm.editorConfig,
                            "data-vv-scope": "addEditValidation",
                            "data-vv-as": _vm.$t("Message")
                          },
                          model: {
                            value: _vm.inputs.message,
                            callback: function($$v) {
                              _vm.$set(_vm.inputs, "message", $$v)
                            },
                            expression: "inputs.message"
                          }
                        }),
                        _vm._v(" "),
                        _vm.errors.has("addEditValidation.message")
                          ? _c("div", { staticClass: "help-block" }, [
                              _vm._v(
                                "\n                " +
                                  _vm._s(
                                    _vm.errors.first(
                                      "addEditValidation.message"
                                    )
                                  ) +
                                  "\n              "
                              )
                            ])
                          : _vm._e()
                      ],
                      1
                    )
                  ])
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "div",
                { staticClass: "row mt-3" },
                [
                  _c("b-col", { attrs: { md: "2" } }),
                  _vm._v(" "),
                  _c("b-col", { attrs: { md: "8" } }, [
                    _c(
                      "div",
                      {
                        staticClass: "form-group",
                        class: {
                          "has-error": _vm.errors.has(
                            "addEditValidation.attachments"
                          )
                        }
                      },
                      [
                        _c("label", { staticClass: "control-label" }, [
                          _vm._v(_vm._s(_vm.$t("Attachments")))
                        ]),
                        _vm._v(" "),
                        _c("label", { staticClass: "required" }, [_vm._v("*")]),
                        _vm._v(" "),
                        _c("b-form-file", {
                          directives: [
                            {
                              name: "validate",
                              rawName: "v-validate",
                              value: "required",
                              expression: "'required'"
                            }
                          ],
                          staticClass: "form-control",
                          attrs: {
                            multiple: "",
                            name: "attachments",
                            "data-vv-scope": "addEditValidation",
                            "data-vv-as": _vm.$t("Attachments")
                          },
                          model: {
                            value: _vm.inputs.attachments,
                            callback: function($$v) {
                              _vm.$set(_vm.inputs, "attachments", $$v)
                            },
                            expression: "inputs.attachments"
                          }
                        }),
                        _vm._v(" "),
                        _vm.errors.has("addEditValidation.attachments")
                          ? _c("div", { staticClass: "help-block" }, [
                              _vm._v(
                                "\n                " +
                                  _vm._s(
                                    _vm.errors.first(
                                      "addEditValidation.attachments"
                                    )
                                  ) +
                                  "\n              "
                              )
                            ])
                          : _vm._e()
                      ],
                      1
                    )
                  ])
                ],
                1
              ),
              _vm._v(" "),
              _c("div", { staticClass: "row mt-3" }, [
                _c(
                  "div",
                  { staticClass: "col-md-4 center-block" },
                  [
                    _c(
                      "b-button",
                      {
                        staticClass: "btn btn-info custom-btn1",
                        on: { click: _vm.sendMessage }
                      },
                      [_vm._v(_vm._s(_vm.$t("Send")))]
                    )
                  ],
                  1
                )
              ])
            ])
          ])
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

/***/ "./resources/js/app/view/pages/seller/contactUs/contactUsPage.vue":
/*!************************************************************************!*\
  !*** ./resources/js/app/view/pages/seller/contactUs/contactUsPage.vue ***!
  \************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _contactUsPage_vue_vue_type_template_id_27f8b436___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./contactUsPage.vue?vue&type=template&id=27f8b436& */ "./resources/js/app/view/pages/seller/contactUs/contactUsPage.vue?vue&type=template&id=27f8b436&");
/* harmony import */ var _contactUsPage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./contactUsPage.vue?vue&type=script&lang=js& */ "./resources/js/app/view/pages/seller/contactUs/contactUsPage.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _contactUsPage_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./contactUsPage.vue?vue&type=style&index=0&lang=css& */ "./resources/js/app/view/pages/seller/contactUs/contactUsPage.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _contactUsPage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _contactUsPage_vue_vue_type_template_id_27f8b436___WEBPACK_IMPORTED_MODULE_0__["render"],
  _contactUsPage_vue_vue_type_template_id_27f8b436___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/app/view/pages/seller/contactUs/contactUsPage.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/app/view/pages/seller/contactUs/contactUsPage.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************!*\
  !*** ./resources/js/app/view/pages/seller/contactUs/contactUsPage.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_contactUsPage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./contactUsPage.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/app/view/pages/seller/contactUs/contactUsPage.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_contactUsPage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/app/view/pages/seller/contactUs/contactUsPage.vue?vue&type=style&index=0&lang=css&":
/*!*********************************************************************************************************!*\
  !*** ./resources/js/app/view/pages/seller/contactUs/contactUsPage.vue?vue&type=style&index=0&lang=css& ***!
  \*********************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_5_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_5_2_node_modules_vue_loader_lib_index_js_vue_loader_options_contactUsPage_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/style-loader!../../../../../../../node_modules/css-loader??ref--5-1!../../../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../../../node_modules/postcss-loader/src??ref--5-2!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./contactUsPage.vue?vue&type=style&index=0&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/app/view/pages/seller/contactUs/contactUsPage.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_5_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_5_2_node_modules_vue_loader_lib_index_js_vue_loader_options_contactUsPage_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_5_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_5_2_node_modules_vue_loader_lib_index_js_vue_loader_options_contactUsPage_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_5_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_5_2_node_modules_vue_loader_lib_index_js_vue_loader_options_contactUsPage_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_5_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_5_2_node_modules_vue_loader_lib_index_js_vue_loader_options_contactUsPage_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));


/***/ }),

/***/ "./resources/js/app/view/pages/seller/contactUs/contactUsPage.vue?vue&type=template&id=27f8b436&":
/*!*******************************************************************************************************!*\
  !*** ./resources/js/app/view/pages/seller/contactUs/contactUsPage.vue?vue&type=template&id=27f8b436& ***!
  \*******************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_contactUsPage_vue_vue_type_template_id_27f8b436___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./contactUsPage.vue?vue&type=template&id=27f8b436& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/app/view/pages/seller/contactUs/contactUsPage.vue?vue&type=template&id=27f8b436&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_contactUsPage_vue_vue_type_template_id_27f8b436___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_contactUsPage_vue_vue_type_template_id_27f8b436___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);