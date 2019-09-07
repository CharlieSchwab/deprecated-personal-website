(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[0],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/HomePage/PortfolioUnit.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/HomePage/PortfolioUnit.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _json_portfolio_json__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../json/portfolio.json */ "./resources/js/components/json/portfolio.json");
var _json_portfolio_json__WEBPACK_IMPORTED_MODULE_0___namespace = /*#__PURE__*/__webpack_require__.t(/*! ../json/portfolio.json */ "./resources/js/components/json/portfolio.json", 1);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
    //preprocess the full description to split into lines (separate by commas and periods)
    _json_portfolio_json__WEBPACK_IMPORTED_MODULE_0__.data.map(function (el) {
      return el.full_description = el.full_description.split(/[,.]/);
    });
    return {
      projects: _json_portfolio_json__WEBPACK_IMPORTED_MODULE_0__.data
    };
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/HomePage/PortfolioUnit.vue?vue&type=template&id=157ca136&":
/*!*************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/HomePage/PortfolioUnit.vue?vue&type=template&id=157ca136& ***!
  \*************************************************************************************************************************************************************************************************************************/
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
  return _c("div", { attrs: { id: "portfolio-unit" } }, [
    _c("div", { staticClass: "space-y" }),
    _vm._v(" "),
    _c("br"),
    _vm._v(" "),
    _vm._m(0),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "d-flex flex-md-row flex-column justify-content-center" },
      _vm._l(_vm.projects, function(project) {
        return _c("div", { staticClass: "card shadow spaced" }, [
          _c(
            "div",
            { staticClass: "card-body" },
            [
              _c(
                "div",
                { staticClass: "text-center" },
                [
                  _c("h4", [_c("b", [_vm._v(_vm._s(project.project_name))])]),
                  _vm._v(" "),
                  _vm._l(project.skills_used, function(skill) {
                    return _c(
                      "span",
                      {
                        staticClass:
                          "badge badge-pill alt-bg tag-font spaced-min"
                      },
                      [
                        _vm._v(
                          "\n                " +
                            _vm._s(skill) +
                            "\n            "
                        )
                      ]
                    )
                  })
                ],
                2
              ),
              _vm._v(" "),
              _c("hr"),
              _vm._v(" "),
              _c("p", [_c("b", [_vm._v(_vm._s(project.brief_description))])]),
              _vm._l(project.full_description, function(line) {
                return _c("div", [
                  _c("p", { staticClass: "no-margins" }, [_vm._v(_vm._s(line))])
                ])
              }),
              _vm._v(" "),
              _c("p")
            ],
            2
          )
        ])
      }),
      0
    ),
    _vm._v(" "),
    _c("div", { staticClass: "space-y" }),
    _vm._v(" "),
    _c("div", { staticClass: "space-y" })
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "container" }, [
      _c("h3", [
        _c("i", { staticClass: "far fa-star" }),
        _vm._v(" "),
        _c("b", [_vm._v("Featured Projects")])
      ])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js":
/*!********************************************************************!*\
  !*** ./node_modules/vue-loader/lib/runtime/componentNormalizer.js ***!
  \********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return normalizeComponent; });
/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file (except for modules).
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

function normalizeComponent (
  scriptExports,
  render,
  staticRenderFns,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier, /* server only */
  shadowMode /* vue-cli only */
) {
  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (render) {
    options.render = render
    options.staticRenderFns = staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = 'data-v-' + scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = shadowMode
      ? function () { injectStyles.call(this, this.$root.$options.shadowRoot) }
      : injectStyles
  }

  if (hook) {
    if (options.functional) {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functioal component in vue file
      var originalRender = options.render
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return originalRender(h, context)
      }
    } else {
      // inject component registration as beforeCreate hook
      var existing = options.beforeCreate
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    }
  }

  return {
    exports: scriptExports,
    options: options
  }
}


/***/ }),

/***/ "./resources/js/components/HomePage/PortfolioUnit.vue":
/*!************************************************************!*\
  !*** ./resources/js/components/HomePage/PortfolioUnit.vue ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _PortfolioUnit_vue_vue_type_template_id_157ca136___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./PortfolioUnit.vue?vue&type=template&id=157ca136& */ "./resources/js/components/HomePage/PortfolioUnit.vue?vue&type=template&id=157ca136&");
/* harmony import */ var _PortfolioUnit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./PortfolioUnit.vue?vue&type=script&lang=js& */ "./resources/js/components/HomePage/PortfolioUnit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _PortfolioUnit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _PortfolioUnit_vue_vue_type_template_id_157ca136___WEBPACK_IMPORTED_MODULE_0__["render"],
  _PortfolioUnit_vue_vue_type_template_id_157ca136___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/HomePage/PortfolioUnit.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/HomePage/PortfolioUnit.vue?vue&type=script&lang=js&":
/*!*************************************************************************************!*\
  !*** ./resources/js/components/HomePage/PortfolioUnit.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PortfolioUnit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./PortfolioUnit.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/HomePage/PortfolioUnit.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PortfolioUnit_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/HomePage/PortfolioUnit.vue?vue&type=template&id=157ca136&":
/*!*******************************************************************************************!*\
  !*** ./resources/js/components/HomePage/PortfolioUnit.vue?vue&type=template&id=157ca136& ***!
  \*******************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PortfolioUnit_vue_vue_type_template_id_157ca136___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./PortfolioUnit.vue?vue&type=template&id=157ca136& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/HomePage/PortfolioUnit.vue?vue&type=template&id=157ca136&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PortfolioUnit_vue_vue_type_template_id_157ca136___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PortfolioUnit_vue_vue_type_template_id_157ca136___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/json/portfolio.json":
/*!*****************************************************!*\
  !*** ./resources/js/components/json/portfolio.json ***!
  \*****************************************************/
/*! exports provided: data, default */
/***/ (function(module) {

module.exports = JSON.parse("{\"data\":[{\"project_name\":\"Tradepaper.ca\",\"brief_description\":\"Enterprise-level web application\",\"full_description\":\"Paper-trading website that allows users to register/login, and mock the act of exchanging stocks/tracking their portfolio. Uses a free api to retreive market data\",\"skills_used\":[\"ASP.Net Core\",\"MongoDB\",\"React Native\"]},{\"project_name\":\"WebGL Online Game\",\"brief_description\":\"Multiplayer game designed for fast performance\",\"full_description\":\"A game hosted on a Python website (Tornado framework), allows multiple users to play from different machines. Renders 3d models and animations using WebGL\",\"skills_used\":[\"Python\",\"Nginx\",\"WebGL\"]},{\"project_name\":\"Analytics Website\",\"brief_description\":\"Javascript SPA used to display analytics data\",\"full_description\":\"A single page application made of Angular components. Displays charts of data collected from my websites. Uses DCjs to render charts that can be filtered\",\"skills_used\":[\"Angular\",\"NodeJS\",\"DC.js\"]}]}");

/***/ })

}]);