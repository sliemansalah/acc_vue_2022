(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[27],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/seller/view/pages/seller/settings/settingsPage.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/seller/view/pages/seller/settings/settingsPage.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************************************************/
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
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
        image: null,
        name: "",
        published: false,
        description: "",
        activities: [],
        setting: {
          email_support: "",
          mobile_support1: "",
          mobile_support2: "",
          facebook: "",
          instagram: "",
          link: "",
          link_android: "",
          link_iphone: "",
          telegram_support: "",
          twitter: "",
          snapchat: ""
        } // youtube: "",
        // phone_support: "",

      },
      activities: []
    };
  },
  methods: {
    initData: function initData() {
      var _this = this;

      this.$store.dispatch("settings/getActivities").then(function (res) {
        _this.activities = res.data;
      })["catch"](function (err) {});
      this.$store.dispatch("settings/findData", 1).then(function (res) {
        _this.inputs = res.data;
      });
    },
    updateStore: function updateStore() {
      var _this2 = this;

      this.inputs.id = 1;
      this.$store.dispatch("settings/updateData", this.inputs).then(function (res) {
        _this2.activities = res.data;
      })["catch"](function (err) {});
    }
  },
  created: function created() {
    this.initData();
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/seller/view/pages/seller/settings/settingsPage.vue?vue&type=template&id=206f6d31&":
/*!**************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/seller/view/pages/seller/settings/settingsPage.vue?vue&type=template&id=206f6d31& ***!
  \**************************************************************************************************************************************************************************************************************************************/
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
            _c(
              "svg",
              {
                staticClass: "feather feather-home",
                attrs: {
                  width: "20",
                  height: "20",
                  viewBox: "0 0 24 24",
                  fill: "none",
                  stroke: "currentColor",
                  "stroke-width": "2",
                  "stroke-linecap": "round",
                  "stroke-linejoin": "round"
                }
              },
              [
                _c("path", {
                  attrs: { d: "M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" }
                }),
                _vm._v(" "),
                _c("polyline", { attrs: { points: "9 22 9 12 15 12 15 22" } })
              ]
            ),
            _vm._v(" "),
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
          _vm._v(_vm._s(_vm.$t("Settings")))
        ])
      ]),
      _vm._v(" "),
      _c("h4", { staticClass: "mt-3" }, [_vm._v(_vm._s(_vm.$t("Settings")))]),
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
                          _vm._s(_vm.$t("StoreInformation")) +
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
              _c("img", {
                staticClass: "cursor",
                attrs: {
                  width: "260px",
                  height: "260px",
                  src: _vm.inputs.image
                    ? _vm.inputs.image
                    : "/assets/images/store.jpg",
                  alt: ""
                }
              }),
              _vm._v(" "),
              _c("div", { staticClass: "row mt-3" }, [
                _c("div", { staticClass: "col-md-2" }),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-2" }, [
                  _vm._v(
                    "\n                 " +
                      _vm._s(_vm.$t("Name")) +
                      "\n             "
                  )
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-md-4" },
                  [
                    _c("b-input", {
                      attrs: { type: "text" },
                      model: {
                        value: _vm.inputs.name,
                        callback: function($$v) {
                          _vm.$set(_vm.inputs, "name", $$v)
                        },
                        expression: "inputs.name"
                      }
                    })
                  ],
                  1
                )
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "row mt-3" }, [
                _c("div", { staticClass: "col-md-2" }),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-2" }, [
                  _vm._v(
                    "\n                 " +
                      _vm._s(_vm.$t("Description")) +
                      "\n             "
                  )
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-md-4" },
                  [
                    _c("b-textarea", {
                      attrs: { rows: "4", type: "text" },
                      model: {
                        value: _vm.inputs.description,
                        callback: function($$v) {
                          _vm.$set(_vm.inputs, "description", $$v)
                        },
                        expression: "inputs.description"
                      }
                    })
                  ],
                  1
                )
              ]),
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
                        on: { click: _vm.updateStore }
                      },
                      [_vm._v(_vm._s(_vm.$t("Save")))]
                    )
                  ],
                  1
                )
              ])
            ])
          ])
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "b-card",
        {
          staticClass: "mt-50",
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
                          _vm._s(_vm.$t("StoreActivity")) +
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
            _c("div", [
              _c(
                "p",
                {
                  staticClass: "text-center",
                  staticStyle: { "font-weight": "bold", color: "#000" }
                },
                [
                  _vm._v(
                    "\n          " +
                      _vm._s(_vm.$t("StoreActivityHeader")) +
                      "\n        "
                  )
                ]
              ),
              _vm._v(" "),
              _c("div", { staticClass: "row mt-3" }, [
                _c(
                  "div",
                  { staticClass: "col-md-4 center-block" },
                  [
                    _c(
                      "el-select",
                      {
                        attrs: { multiple: "", filterable: "", clearable: "" },
                        model: {
                          value: _vm.inputs.activities,
                          callback: function($$v) {
                            _vm.$set(_vm.inputs, "activities", $$v)
                          },
                          expression: "inputs.activities"
                        }
                      },
                      _vm._l(_vm.activities, function(item) {
                        return _c("el-option", {
                          key: item.id,
                          attrs: { label: item.name, value: item.id }
                        })
                      }),
                      1
                    )
                  ],
                  1
                )
              ]),
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
                        on: { click: _vm.updateStore }
                      },
                      [_vm._v(_vm._s(_vm.$t("Save")))]
                    )
                  ],
                  1
                )
              ])
            ])
          ])
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "b-card",
        {
          staticClass: "mt-50",
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
                          _vm._s(_vm.$t("StoreSupport")) +
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
            _c("div", [
              _c(
                "div",
                { staticClass: "alert alert-danger", attrs: { role: "alert" } },
                [
                  _vm._v(
                    "\n          " +
                      _vm._s(_vm.$t("StoreSupportHeader")) +
                      "\n        "
                  )
                ]
              ),
              _vm._v(" "),
              _c("div", { staticClass: "row mt-3" }, [
                _c("div", { staticClass: "col-md-2" }),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-2" }, [
                  _vm._v(
                    "\n                 " +
                      _vm._s(_vm.$t("Mobile")) +
                      "\n             "
                  )
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-md-4" },
                  [
                    _c("b-input", {
                      attrs: { type: "text" },
                      model: {
                        value: _vm.inputs.setting.mobile_support1,
                        callback: function($$v) {
                          _vm.$set(_vm.inputs.setting, "mobile_support1", $$v)
                        },
                        expression: "inputs.setting.mobile_support1"
                      }
                    })
                  ],
                  1
                )
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "row mt-3" }, [
                _c("div", { staticClass: "col-md-2" }),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-2" }, [
                  _vm._v(
                    "\n                 " +
                      _vm._s(_vm.$t("Watsapp")) +
                      "\n             "
                  )
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-md-4" },
                  [
                    _c("b-input", {
                      attrs: { type: "text" },
                      model: {
                        value: _vm.inputs.setting.mobile_support2,
                        callback: function($$v) {
                          _vm.$set(_vm.inputs.setting, "mobile_support2", $$v)
                        },
                        expression: "inputs.setting.mobile_support2"
                      }
                    })
                  ],
                  1
                )
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "row mt-3" }, [
                _c("div", { staticClass: "col-md-2" }),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-2" }, [
                  _vm._v(
                    "\n                 " +
                      _vm._s(_vm.$t("Teligram")) +
                      "\n             "
                  )
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-md-4" },
                  [
                    _c("b-input", {
                      attrs: { type: "text" },
                      model: {
                        value: _vm.inputs.setting.telegram_support,
                        callback: function($$v) {
                          _vm.$set(_vm.inputs.setting, "telegram_support", $$v)
                        },
                        expression: "inputs.setting.telegram_support"
                      }
                    })
                  ],
                  1
                )
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "row mt-3" }, [
                _c("div", { staticClass: "col-md-2" }),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-2" }, [
                  _vm._v(
                    "\n                 " +
                      _vm._s(_vm.$t("Email")) +
                      "\n             "
                  )
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-md-4" },
                  [
                    _c("b-input", {
                      attrs: { type: "text" },
                      model: {
                        value: _vm.inputs.setting.email_support,
                        callback: function($$v) {
                          _vm.$set(_vm.inputs.setting, "email_support", $$v)
                        },
                        expression: "inputs.setting.email_support"
                      }
                    })
                  ],
                  1
                )
              ]),
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
                        on: { click: _vm.updateStore }
                      },
                      [_vm._v(_vm._s(_vm.$t("Save")))]
                    )
                  ],
                  1
                )
              ])
            ])
          ])
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "b-card",
        {
          staticClass: "mt-50",
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
                          _vm._s(_vm.$t("StoreContact")) +
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
            _c("div", [
              _c("div", { staticClass: "row mt-3" }, [
                _c("div", { staticClass: "col-md-2" }),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-2" }, [
                  _vm._v(
                    "\n                 " +
                      _vm._s(_vm.$t("Instigram")) +
                      "\n             "
                  )
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-md-4" },
                  [
                    _c("b-input", {
                      attrs: { type: "text" },
                      model: {
                        value: _vm.inputs.setting.instagram,
                        callback: function($$v) {
                          _vm.$set(_vm.inputs.setting, "instagram", $$v)
                        },
                        expression: "inputs.setting.instagram"
                      }
                    })
                  ],
                  1
                )
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "row mt-3" }, [
                _c("div", { staticClass: "col-md-2" }),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-2" }, [
                  _vm._v(
                    "\n                 " +
                      _vm._s(_vm.$t("Twitter")) +
                      "\n             "
                  )
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-md-4" },
                  [
                    _c("b-input", {
                      attrs: { type: "text" },
                      model: {
                        value: _vm.inputs.setting.twitter,
                        callback: function($$v) {
                          _vm.$set(_vm.inputs.setting, "twitter", $$v)
                        },
                        expression: "inputs.setting.twitter"
                      }
                    })
                  ],
                  1
                )
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "row mt-3" }, [
                _c("div", { staticClass: "col-md-2" }),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-2" }, [
                  _vm._v(
                    "\n                 " +
                      _vm._s(_vm.$t("Facebook")) +
                      "\n             "
                  )
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-md-4" },
                  [
                    _c("b-input", {
                      attrs: { type: "text" },
                      model: {
                        value: _vm.inputs.setting.facebook,
                        callback: function($$v) {
                          _vm.$set(_vm.inputs.setting, "facebook", $$v)
                        },
                        expression: "inputs.setting.facebook"
                      }
                    })
                  ],
                  1
                )
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "row mt-3" }, [
                _c("div", { staticClass: "col-md-2" }),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-2" }, [
                  _vm._v(
                    "\n                 " +
                      _vm._s(_vm.$t("Snapshat")) +
                      "\n             "
                  )
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-md-4" },
                  [
                    _c("b-input", {
                      attrs: { type: "text" },
                      model: {
                        value: _vm.inputs.setting.snapchat,
                        callback: function($$v) {
                          _vm.$set(_vm.inputs.setting, "snapchat", $$v)
                        },
                        expression: "inputs.setting.snapchat"
                      }
                    })
                  ],
                  1
                )
              ]),
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
                        on: { click: _vm.updateStore }
                      },
                      [_vm._v(_vm._s(_vm.$t("Save")))]
                    )
                  ],
                  1
                )
              ])
            ])
          ])
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "b-card",
        {
          staticClass: "mt-50",
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
                          _vm._s(_vm.$t("AnotherLinks")) +
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
            _c("div", [
              _c("div", { staticClass: "row mt-3" }, [
                _c("div", { staticClass: "col-md-2" }),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-2" }, [
                  _vm._v(
                    "\n                 " +
                      _vm._s(_vm.$t("KnownLink")) +
                      "\n             "
                  )
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-md-4" },
                  [
                    _c("b-input", {
                      attrs: { type: "text" },
                      model: {
                        value: _vm.inputs.setting.link,
                        callback: function($$v) {
                          _vm.$set(_vm.inputs.setting, "link", $$v)
                        },
                        expression: "inputs.setting.link"
                      }
                    })
                  ],
                  1
                )
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "row mt-3" }, [
                _c("div", { staticClass: "col-md-2" }),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-2" }, [
                  _vm._v(
                    "\n                 " +
                      _vm._s(_vm.$t("IphoneLink")) +
                      "\n             "
                  )
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-md-4" },
                  [
                    _c("b-input", {
                      attrs: { type: "text" },
                      model: {
                        value: _vm.inputs.setting.link_iphone,
                        callback: function($$v) {
                          _vm.$set(_vm.inputs.setting, "link_iphone", $$v)
                        },
                        expression: "inputs.setting.link_iphone"
                      }
                    })
                  ],
                  1
                )
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "row mt-3" }, [
                _c("div", { staticClass: "col-md-2" }),
                _vm._v(" "),
                _c("div", { staticClass: "col-md-2" }, [
                  _vm._v(
                    "\n                 " +
                      _vm._s(_vm.$t("AndroidLink")) +
                      "\n             "
                  )
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-md-4" },
                  [
                    _c("b-input", {
                      attrs: { type: "text" },
                      model: {
                        value: _vm.inputs.setting.link_android,
                        callback: function($$v) {
                          _vm.$set(_vm.inputs.setting, "link_android", $$v)
                        },
                        expression: "inputs.setting.link_android"
                      }
                    })
                  ],
                  1
                )
              ]),
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
                        on: { click: _vm.updateStore }
                      },
                      [_vm._v(_vm._s(_vm.$t("Save")))]
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

/***/ "./resources/js/seller/view/pages/seller/settings/settingsPage.vue":
/*!*************************************************************************!*\
  !*** ./resources/js/seller/view/pages/seller/settings/settingsPage.vue ***!
  \*************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _settingsPage_vue_vue_type_template_id_206f6d31___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./settingsPage.vue?vue&type=template&id=206f6d31& */ "./resources/js/seller/view/pages/seller/settings/settingsPage.vue?vue&type=template&id=206f6d31&");
/* harmony import */ var _settingsPage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./settingsPage.vue?vue&type=script&lang=js& */ "./resources/js/seller/view/pages/seller/settings/settingsPage.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _settingsPage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _settingsPage_vue_vue_type_template_id_206f6d31___WEBPACK_IMPORTED_MODULE_0__["render"],
  _settingsPage_vue_vue_type_template_id_206f6d31___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/seller/view/pages/seller/settings/settingsPage.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/seller/view/pages/seller/settings/settingsPage.vue?vue&type=script&lang=js&":
/*!**************************************************************************************************!*\
  !*** ./resources/js/seller/view/pages/seller/settings/settingsPage.vue?vue&type=script&lang=js& ***!
  \**************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_settingsPage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./settingsPage.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/seller/view/pages/seller/settings/settingsPage.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_settingsPage_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/seller/view/pages/seller/settings/settingsPage.vue?vue&type=template&id=206f6d31&":
/*!********************************************************************************************************!*\
  !*** ./resources/js/seller/view/pages/seller/settings/settingsPage.vue?vue&type=template&id=206f6d31& ***!
  \********************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_settingsPage_vue_vue_type_template_id_206f6d31___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../../node_modules/vue-loader/lib??vue-loader-options!./settingsPage.vue?vue&type=template&id=206f6d31& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/seller/view/pages/seller/settings/settingsPage.vue?vue&type=template&id=206f6d31&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_settingsPage_vue_vue_type_template_id_206f6d31___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_settingsPage_vue_vue_type_template_id_206f6d31___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);