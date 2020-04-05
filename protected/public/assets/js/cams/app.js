/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/axios/index.js":
/*!*************************************!*\
  !*** ./node_modules/axios/index.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

throw new Error("Module build failed: Error: ENOENT: no such file or directory, open '/Users/onkomanya/brew/var/www/cams/protected/node_modules/axios/index.js'");

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/assessments/vulnerabilities/VulnerabilityAssessmentComponent.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/assessments/vulnerabilities/VulnerabilityAssessmentComponent.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  name: 'vulnerability-assessment-component',
  computed: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapGetters"])(['vulnerabilityAssessments', 'vulnerabilityAssessment', 'authRole', 'isLoading', 'pagination']), {
    mLoading: {
      get: function get() {
        return this.isLoading;
      },
      set: function set(value) {
        this.$store.commit('setLoading', value);
      }
    }
  }),
  data: function data() {
    return {
      columns: [{
        label: 'Date of Interview',
        field: 'dateOfInterview',
        thClass: 'text-center',
        tdClass: 'text-center'
      }, {
        label: 'Camp',
        field: 'camp_name',
        thClass: 'text-center',
        tdClass: 'text-center'
      }, {
        label: 'District',
        field: 'district_name'
      }, {
        label: 'Assessors\' Name',
        field: 'assessorName',
        thClass: 'text-center',
        tdClass: 'text-center'
      }, {
        label: 'HAI Reg #',
        field: 'hai_reg_number',
        thClass: 'text-center',
        tdClass: 'text-center'
      }, {
        label: 'Client No',
        field: 'client_number',
        thClass: 'text-center',
        tdClass: 'text-center'
      }, {
        label: 'Individual ID',
        field: 'individual_id',
        thClass: 'text-center',
        tdClass: 'text-center'
      }, {
        label: 'Full Name',
        field: 'full_name',
        thClass: 'text-center',
        tdClass: 'text-center'
      }, {
        label: 'Sex',
        field: 'sex',
        thClass: 'text-center',
        tdClass: 'text-center'
      }, {
        label: 'Age',
        field: 'age',
        thClass: 'text-center',
        tdClass: 'text-center'
      }, {
        label: 'Auth Status',
        field: 'auth_status'
      }, {
        label: 'Action',
        field: 'action',
        thClass: 'text-center',
        tdClass: 'text-center',
        sortable: false
      }]
    };
  },
  methods: {
    onPageChange: function onPageChange(params) {
      //console.log('onPageChange', params);
      this.updateParams(params);
    },
    onSortChange: function onSortChange(params) {
      var pagination = this.pagination;
      pagination.sortType = params[0].type;
      pagination.sortField = params[0].field;
      this.$store.commit('setPagination', pagination);
      this.loadVulnerabilityAssessments();
    },
    onColumnFilter: function onColumnFilter(params) {
      console.log('onColumnFilter', params[0]); //this.updateParams(params[]);
    },
    onPerPageChange: function onPerPageChange(params) {
      //console.log('onPerPageChange', params);
      this.updateParams(params);
    },
    updateParams: function updateParams(params) {
      var pagination = this.pagination;
      pagination.currentPage = params.currentPage;
      pagination.perPage = params.currentPerPage;
      pagination.prevPage = params.prevPage;
      this.$store.commit('setPagination', pagination);
      this.loadVulnerabilityAssessments();
    },
    onSearch: function onSearch(params) {
      var pagination = this.pagination;
      pagination.searchTerm = params.searchTerm;
      this.$store.commit('setPagination', pagination);
      this.$store.dispatch('searchVulnerabilityAssessmentWithPagination', this.pagination);
    },
    performAction: function performAction(actionType, vulnerabilityAssessment) {
      switch (actionType) {
        case 'view':
          this.$modal.loadPageInAModal('/assessments/vulnerability/' + vulnerabilityAssessment.assessment_id, 'View Vulnerabiltiy Assessment', 'fa-eye');
          break;

        case 'edit':
          this.$modal.loadPageInAModal('/assessments/vulnerability/' + vulnerabilityAssessment.assessment_id + '/edit', 'Update Vulnerabiltiy Assessment', 'fa-edit');
          break;

        case 'delete':
          this.$modal.deleteRecord('/assessments/vulnerability/' + vulnerabilityAssessment.assessment_id);
          break;

        case 'authorize':
          this.$modal.authorizeRecord('/assessments/vulnerability/' + vulnerabilityAssessment.assessment_id);
          break;
      }
    },
    loadVulnerabilityAssessments: function loadVulnerabilityAssessments() {
      this.$store.dispatch('getVulnerabilityAssessments', this.pagination);
    }
  },
  created: function created() {
    this.loadVulnerabilityAssessments();
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/clients/ClientListComponent.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/clients/ClientListComponent.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  name: 'client-list-component',
  computed: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_0__["mapGetters"])(['clients', 'client', 'authRole', 'isLoading', 'pagination']), {
    mLoading: {
      get: function get() {
        return this.isLoading;
      },
      set: function set(value) {
        this.$store.commit('setLoading', value);
      }
    }
  }),
  data: function data() {
    return {
      columns: [{
        label: 'Full Name',
        field: 'full_name',
        thClass: 'text-center',
        tdClass: 'text-center'
      }, {
        label: 'HAI Reg #',
        field: 'hai_reg_number',
        thClass: 'text-center',
        tdClass: 'text-center'
      }, {
        label: 'Individual ID',
        field: 'individual_id',
        thClass: 'text-center',
        tdClass: 'text-center'
      }, {
        label: 'Sex',
        field: 'sex',
        thClass: 'text-center',
        tdClass: 'text-center'
      }, {
        label: 'Age',
        field: 'age',
        type: 'number',
        thClass: 'text-center',
        tdClass: 'text-center'
      }, {
        label: 'Address',
        field: 'present_address',
        thClass: 'text-center',
        tdClass: 'text-center'
      }, {
        label: 'Date of Arrival',
        field: 'date_arrival',
        thClass: 'text-center',
        tdClass: 'text-center'
      }, {
        label: 'Camp',
        field: 'camp',
        type: Object,
        thClass: 'text-center',
        tdClass: 'text-center'
      }, {
        label: 'Auth Status',
        field: 'auth_status'
      }, {
        label: 'Action',
        field: 'action',
        thClass: 'text-center',
        tdClass: 'text-center',
        sortable: false
      }]
    };
  },
  methods: {
    onPageChange: function onPageChange(params) {
      //console.log('onPageChange', params);
      this.updateParams(params);
    },
    onSortChange: function onSortChange(params) {
      var pagination = this.pagination;
      pagination.sortType = params[0].type;
      pagination.sortField = params[0].field;
      this.$store.commit('setPagination', pagination);
      this.loadClients();
    },
    onColumnFilter: function onColumnFilter(params) {
      console.log('onColumnFilter', params[0]); //this.updateParams(params[]);
    },
    onPerPageChange: function onPerPageChange(params) {
      //console.log('onPerPageChange', params);
      this.updateParams(params);
    },
    updateParams: function updateParams(params) {
      var pagination = this.pagination;
      pagination.currentPage = params.currentPage;
      pagination.perPage = params.currentPerPage;
      pagination.prevPage = params.prevPage;
      this.$store.commit('setPagination', pagination);
      this.loadClients();
    },
    onSearch: function onSearch(params) {
      var pagination = this.pagination;
      pagination.searchTerm = params.searchTerm;
      this.$store.commit('setPagination', pagination);
      this.$store.dispatch('searchClientWithPagination', this.pagination);
    },
    performAction: function performAction(actionType, client) {
      switch (actionType) {
        case 'view':
          this.$modal.loadPageInAModal('/clients/' + client.id, 'Client Details', 'fa-eye');
          break;

        case 'edit':
          this.$modal.loadPageInAModal('/clients/' + client.id + '/edit', 'Update Client Details', 'fa-edit');
          break;

        case 'delete':
          this.$modal.deleteRecord('/clients/' + client.id);
          break;

        case 'authorize':
          this.$modal.authorizeRecord('/authorize/' + client.id);
          break;
      }
    },
    loadClients: function loadClients() {
      this.$store.dispatch('getClients', this.pagination);
    }
  },
  created: function created() {
    this.loadClients();
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-good-table/dist/vue-good-table.css":
/*!*********************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-good-table/dist/vue-good-table.css ***!
  \*********************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

throw new Error("Module build failed (from ./node_modules/postcss-loader/src/index.js):\nError: ENOENT: no such file or directory, open '/Users/onkomanya/brew/var/www/cams/protected/node_modules/vue-good-table/dist/vue-good-table.css'");

/***/ }),

/***/ "./node_modules/style-loader/lib/addStyles.js":
/*!****************************************************!*\
  !*** ./node_modules/style-loader/lib/addStyles.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

throw new Error("Module build failed: Error: ENOENT: no such file or directory, open '/Users/onkomanya/brew/var/www/cams/protected/node_modules/style-loader/lib/addStyles.js'");

/***/ }),

/***/ "./node_modules/vue-good-table/dist/vue-good-table.css":
/*!*************************************************************!*\
  !*** ./node_modules/vue-good-table/dist/vue-good-table.css ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../css-loader??ref--6-1!../../postcss-loader/src??ref--6-2!./vue-good-table.css */ "./node_modules/css-loader/index.js?!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-good-table/dist/vue-good-table.css");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-good-table/dist/vue-good-table.esm.js":
/*!****************************************************************!*\
  !*** ./node_modules/vue-good-table/dist/vue-good-table.esm.js ***!
  \****************************************************************/
/*! exports provided: default, VueGoodTable */
/***/ (function(module, exports) {

throw new Error("Module build failed: Error: ENOENT: no such file or directory, open '/Users/onkomanya/brew/var/www/cams/protected/node_modules/vue-good-table/dist/vue-good-table.esm.js'");

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/assessments/vulnerabilities/VulnerabilityAssessmentComponent.vue?vue&type=template&id=1cfff6fb&":
/*!**********************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/assessments/vulnerabilities/VulnerabilityAssessmentComponent.vue?vue&type=template&id=1cfff6fb& ***!
  \**********************************************************************************************************************************************************************************************************************************************************/
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
      _c("vue-good-table", {
        attrs: {
          mode: "remote",
          "line-numbers": true,
          totalRows: _vm.pagination.total,
          isLoading: _vm.mLoading,
          columns: _vm.columns,
          rows: _vm.vulnerabilityAssessments,
          "search-options": {
            enabled: true,
            placeholder: "Search for a Vulnerability Assessments"
          },
          "pagination-options": {
            enabled: true,
            mode: "records",
            setCurrentPage: _vm.pagination.currentPage,
            perPage: _vm.pagination.perPage,
            perPageDropdown: _vm.pagination.perPageDropdown
          }
        },
        on: {
          "on-page-change": _vm.onPageChange,
          "on-sort-change": _vm.onSortChange,
          "on-per-page-change": _vm.onPerPageChange,
          "on-search": _vm.onSearch,
          "update:isLoading": function($event) {
            _vm.mLoading = $event
          },
          "update:is-loading": function($event) {
            _vm.mLoading = $event
          }
        },
        scopedSlots: _vm._u([
          {
            key: "table-row",
            fn: function(props) {
              return [
                props.column.field == "dateOfInterview"
                  ? _c("span", [
                      _c("span", { staticClass: "text-primary" }, [
                        _vm._v(
                          _vm._s(
                            _vm._f("moment")(
                              props.row.dateOfInterview,
                              "MMMM Do, YYYY"
                            )
                          )
                        )
                      ])
                    ])
                  : props.column.field == "action"
                  ? _c("span", [
                      _c("ul", { staticClass: "icons-list text-center" }, [
                        _c("li", { staticClass: "dropdown" }, [
                          _c(
                            "a",
                            {
                              staticClass: "dropdown-toggle",
                              attrs: { href: "#", "data-toggle": "dropdown" }
                            },
                            [_c("i", { staticClass: "icon-menu9" })]
                          ),
                          _vm._v(" "),
                          _c(
                            "ul",
                            {
                              staticClass: "dropdown-menu dropdown-menu-right"
                            },
                            [
                              _c(
                                "li",
                                { attrs: { id: props.row.id + "-view" } },
                                [
                                  _c(
                                    "a",
                                    {
                                      staticClass: "showRecord label ",
                                      attrs: { href: "#" },
                                      on: {
                                        click: function($event) {
                                          return _vm.performAction(
                                            "view",
                                            props.row
                                          )
                                        }
                                      }
                                    },
                                    [
                                      _c("i", { staticClass: "fa fa-eye " }),
                                      _vm._v(" View ")
                                    ]
                                  )
                                ]
                              ),
                              _vm._v(" "),
                              _vm.authRole === "authorize"
                                ? [
                                    _c(
                                      "li",
                                      {
                                        attrs: {
                                          id: props.row.id + "-authorize"
                                        }
                                      },
                                      [
                                        _c(
                                          "a",
                                          {
                                            staticClass:
                                              "authorizeRecord label ",
                                            attrs: { href: "#" },
                                            on: {
                                              click: function($event) {
                                                return _vm.performAction(
                                                  "authorize",
                                                  props.row
                                                )
                                              }
                                            }
                                          },
                                          [
                                            _c("i", {
                                              staticClass: "fa fa-check "
                                            }),
                                            _vm._v(" Authorize ")
                                          ]
                                        )
                                      ]
                                    )
                                  ]
                                : _vm._e(),
                              _vm._v(" "),
                              _vm.authRole === "admin" ||
                              _vm.authRole === "authorize" ||
                              _vm.authRole === "inputer"
                                ? [
                                    _c(
                                      "li",
                                      {
                                        attrs: { id: props.row.id + "-print" }
                                      },
                                      [
                                        _c(
                                          "a",
                                          {
                                            staticClass: "editRecord label ",
                                            attrs: {
                                              href: "#",
                                              onclick:
                                                "printPage('/assessments/vulnerability/" +
                                                props.row.assessment_id +
                                                "');"
                                            }
                                          },
                                          [
                                            _c("i", {
                                              staticClass: "fa fa-print "
                                            }),
                                            _vm._v(" Print ")
                                          ]
                                        )
                                      ]
                                    ),
                                    _vm._v(" "),
                                    _c(
                                      "li",
                                      {
                                        attrs: {
                                          id: props.row.id + "-download"
                                        }
                                      },
                                      [
                                        _c(
                                          "a",
                                          {
                                            staticClass: "label",
                                            attrs: {
                                              href:
                                                "/assessments/vulnerability/download/" +
                                                props.row.assessment_id,
                                              target: "_blank"
                                            }
                                          },
                                          [
                                            _c("i", {
                                              staticClass: "fa fa-download"
                                            }),
                                            _vm._v(" Download ")
                                          ]
                                        )
                                      ]
                                    ),
                                    _vm._v(" "),
                                    _c(
                                      "li",
                                      { attrs: { id: props.row.id + "-edit" } },
                                      [
                                        _c(
                                          "a",
                                          {
                                            staticClass: "editRecord label ",
                                            attrs: { href: "#" },
                                            on: {
                                              click: function($event) {
                                                return _vm.performAction(
                                                  "edit",
                                                  props.row
                                                )
                                              }
                                            }
                                          },
                                          [
                                            _c("i", {
                                              staticClass: "fa fa-pencil "
                                            }),
                                            _vm._v(" Edit ")
                                          ]
                                        )
                                      ]
                                    ),
                                    _vm._v(" "),
                                    _c(
                                      "li",
                                      {
                                        attrs: { id: props.row.id + "-delete" }
                                      },
                                      [
                                        _c(
                                          "a",
                                          {
                                            staticClass: "deleteRecord label",
                                            attrs: { href: "#" },
                                            on: {
                                              click: function($event) {
                                                return _vm.performAction(
                                                  "delete",
                                                  props.row
                                                )
                                              }
                                            }
                                          },
                                          [
                                            _c("i", {
                                              staticClass:
                                                "fa fa-trash text-danger "
                                            }),
                                            _vm._v(" Delete ")
                                          ]
                                        )
                                      ]
                                    )
                                  ]
                                : _vm._e()
                            ],
                            2
                          )
                        ])
                      ])
                    ])
                  : _c("span", [
                      _vm._v(
                        "\n              " +
                          _vm._s(props.formattedRow[props.column.field]) +
                          "\n              "
                      )
                    ])
              ]
            }
          }
        ])
      })
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/clients/ClientListComponent.vue?vue&type=template&id=2d5dd418&":
/*!*************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/pages/clients/ClientListComponent.vue?vue&type=template&id=2d5dd418& ***!
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
  return _c(
    "div",
    [
      _c("vue-good-table", {
        attrs: {
          mode: "remote",
          "line-numbers": true,
          totalRows: _vm.pagination.total,
          isLoading: _vm.mLoading,
          columns: _vm.columns,
          rows: _vm.clients,
          "search-options": {
            enabled: true,
            placeholder: "Search for a client"
          },
          "pagination-options": {
            enabled: true,
            mode: "records",
            setCurrentPage: _vm.pagination.currentPage,
            perPage: _vm.pagination.perPage,
            perPageDropdown: _vm.pagination.perPageDropdown
          }
        },
        on: {
          "on-page-change": _vm.onPageChange,
          "on-sort-change": _vm.onSortChange,
          "on-per-page-change": _vm.onPerPageChange,
          "on-search": _vm.onSearch,
          "update:isLoading": function($event) {
            _vm.mLoading = $event
          },
          "update:is-loading": function($event) {
            _vm.mLoading = $event
          }
        },
        scopedSlots: _vm._u([
          {
            key: "table-row",
            fn: function(props) {
              return [
                props.column.field == "date_arrival"
                  ? _c("span", [
                      _c("span", { staticClass: "text-primary" }, [
                        _vm._v(
                          _vm._s(
                            _vm._f("moment")(
                              props.row.date_arrival,
                              "MMMM Do, YYYY"
                            )
                          )
                        )
                      ])
                    ])
                  : props.column.field == "camp"
                  ? _c("span", [
                      _c("span", { staticClass: "text-primary" }, [
                        _vm._v(
                          _vm._s(
                            props.row.camp && props.row.camp.camp_name
                              ? props.row.camp.camp_name
                              : props.row.camp_name
                          )
                        )
                      ])
                    ])
                  : props.column.field == "action"
                  ? _c("span", [
                      _c("ul", { staticClass: "icons-list text-center" }, [
                        _c("li", { staticClass: "dropdown" }, [
                          _c(
                            "a",
                            {
                              staticClass: "dropdown-toggle",
                              attrs: { href: "#", "data-toggle": "dropdown" }
                            },
                            [_c("i", { staticClass: "icon-menu9" })]
                          ),
                          _vm._v(" "),
                          _c(
                            "ul",
                            {
                              staticClass: "dropdown-menu dropdown-menu-right"
                            },
                            [
                              _c(
                                "li",
                                { attrs: { id: props.row.id + "-view" } },
                                [
                                  _c(
                                    "a",
                                    {
                                      staticClass: "showRecord label ",
                                      attrs: { href: "#" },
                                      on: {
                                        click: function($event) {
                                          return _vm.performAction(
                                            "view",
                                            props.row
                                          )
                                        }
                                      }
                                    },
                                    [
                                      _c("i", { staticClass: "fa fa-eye " }),
                                      _vm._v(" View ")
                                    ]
                                  )
                                ]
                              ),
                              _vm._v(" "),
                              _vm.authRole === "authorize"
                                ? [
                                    _c(
                                      "li",
                                      {
                                        attrs: {
                                          id: props.row.id + "-authorize"
                                        }
                                      },
                                      [
                                        _c(
                                          "a",
                                          {
                                            staticClass:
                                              "authorizeRecord label ",
                                            attrs: { href: "#" },
                                            on: {
                                              click: function($event) {
                                                return _vm.performAction(
                                                  "authorize",
                                                  props.row
                                                )
                                              }
                                            }
                                          },
                                          [
                                            _c("i", {
                                              staticClass: "fa fa-check "
                                            }),
                                            _vm._v(" Authorize ")
                                          ]
                                        )
                                      ]
                                    )
                                  ]
                                : _vm._e(),
                              _vm._v(" "),
                              _vm.authRole === "admin" ||
                              _vm.authRole === "authorize" ||
                              _vm.authRole === "inputer"
                                ? [
                                    _c(
                                      "li",
                                      { attrs: { id: props.row.id + "-edit" } },
                                      [
                                        _c(
                                          "a",
                                          {
                                            staticClass: "editRecord label ",
                                            attrs: { href: "#" },
                                            on: {
                                              click: function($event) {
                                                return _vm.performAction(
                                                  "edit",
                                                  props.row
                                                )
                                              }
                                            }
                                          },
                                          [
                                            _c("i", {
                                              staticClass: "fa fa-pencil "
                                            }),
                                            _vm._v(" Edit ")
                                          ]
                                        )
                                      ]
                                    ),
                                    _vm._v(" "),
                                    _c(
                                      "li",
                                      {
                                        attrs: { id: props.row.id + "-delete" }
                                      },
                                      [
                                        _c(
                                          "a",
                                          {
                                            staticClass: "deleteRecord label",
                                            attrs: { href: "#" },
                                            on: {
                                              click: function($event) {
                                                return _vm.performAction(
                                                  "delete",
                                                  props.row
                                                )
                                              }
                                            }
                                          },
                                          [
                                            _c("i", {
                                              staticClass:
                                                "fa fa-trash text-danger "
                                            }),
                                            _vm._v(" Delete ")
                                          ]
                                        )
                                      ]
                                    )
                                  ]
                                : _vm._e()
                            ],
                            2
                          )
                        ])
                      ])
                    ])
                  : _c("span", [
                      _vm._v(
                        "\n              " +
                          _vm._s(props.formattedRow[props.column.field]) +
                          "\n              "
                      )
                    ])
              ]
            }
          }
        ])
      })
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js":
/*!********************************************************************!*\
  !*** ./node_modules/vue-loader/lib/runtime/componentNormalizer.js ***!
  \********************************************************************/
/*! exports provided: default */
/***/ (function(module, exports) {

throw new Error("Module build failed: Error: ENOENT: no such file or directory, open '/Users/onkomanya/brew/var/www/cams/protected/node_modules/vue-loader/lib/runtime/componentNormalizer.js'");

/***/ }),

/***/ "./node_modules/vue-moment/dist/vue-moment.js":
/*!****************************************************!*\
  !*** ./node_modules/vue-moment/dist/vue-moment.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

throw new Error("Module build failed: Error: ENOENT: no such file or directory, open '/Users/onkomanya/brew/var/www/cams/protected/node_modules/vue-moment/dist/vue-moment.js'");

/***/ }),

/***/ "./node_modules/vue/dist/vue.common.js":
/*!*********************************************!*\
  !*** ./node_modules/vue/dist/vue.common.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

throw new Error("Module build failed: Error: ENOENT: no such file or directory, open '/Users/onkomanya/brew/var/www/cams/protected/node_modules/vue/dist/vue.common.js'");

/***/ }),

/***/ "./node_modules/vuex/dist/vuex.esm.js":
/*!********************************************!*\
  !*** ./node_modules/vuex/dist/vuex.esm.js ***!
  \********************************************/
/*! exports provided: default, Store, install, mapState, mapMutations, mapGetters, mapActions, createNamespacedHelpers */
/***/ (function(module, exports) {

throw new Error("Module build failed: Error: ENOENT: no such file or directory, open '/Users/onkomanya/brew/var/www/cams/protected/node_modules/vuex/dist/vuex.esm.js'");

/***/ }),

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _store_store__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./store/store */ "./resources/js/store/store.js");
/* harmony import */ var _shared_modals_modal_loader__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./shared/modals/modal-loader */ "./resources/js/shared/modals/modal-loader.js");
/* harmony import */ var vue_good_table__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! vue-good-table */ "./node_modules/vue-good-table/dist/vue-good-table.esm.js");
/* harmony import */ var vue_good_table_dist_vue_good_table_css__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! vue-good-table/dist/vue-good-table.css */ "./node_modules/vue-good-table/dist/vue-good-table.css");
/* harmony import */ var vue_good_table_dist_vue_good_table_css__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(vue_good_table_dist_vue_good_table_css__WEBPACK_IMPORTED_MODULE_3__);
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
__webpack_require__(/*! ./bootstrap */ "./resources/js/bootstrap.js");

window.Vue = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.common.js");

var moment = __webpack_require__(/*! vue-moment */ "./node_modules/vue-moment/dist/vue-moment.js");




 //Plugins

Vue.use(moment);
Vue.use(_shared_modals_modal_loader__WEBPACK_IMPORTED_MODULE_1__["default"]);
Vue.use(vue_good_table__WEBPACK_IMPORTED_MODULE_2__["default"]); //Components

Vue.component('client-list-component', __webpack_require__(/*! ./pages/clients/ClientListComponent.vue */ "./resources/js/pages/clients/ClientListComponent.vue")["default"]);
Vue.component('vulnerability-assessment-component', __webpack_require__(/*! ./pages/assessments/vulnerabilities/VulnerabilityAssessmentComponent.vue */ "./resources/js/pages/assessments/vulnerabilities/VulnerabilityAssessmentComponent.vue")["default"]);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

var app = new Vue({
  el: '#campsn-app',
  store: _store_store__WEBPACK_IMPORTED_MODULE_0__["default"]
});

/***/ }),

/***/ "./resources/js/bootstrap.js":
/*!***********************************!*\
  !*** ./resources/js/bootstrap.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */
window.axios = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
// import Echo from 'laravel-echo';
// window.Pusher = require('pusher-js');
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });

/***/ }),

/***/ "./resources/js/pages/assessments/vulnerabilities/VulnerabilityAssessmentComponent.vue":
/*!*********************************************************************************************!*\
  !*** ./resources/js/pages/assessments/vulnerabilities/VulnerabilityAssessmentComponent.vue ***!
  \*********************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _VulnerabilityAssessmentComponent_vue_vue_type_template_id_1cfff6fb___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./VulnerabilityAssessmentComponent.vue?vue&type=template&id=1cfff6fb& */ "./resources/js/pages/assessments/vulnerabilities/VulnerabilityAssessmentComponent.vue?vue&type=template&id=1cfff6fb&");
/* harmony import */ var _VulnerabilityAssessmentComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./VulnerabilityAssessmentComponent.vue?vue&type=script&lang=js& */ "./resources/js/pages/assessments/vulnerabilities/VulnerabilityAssessmentComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _VulnerabilityAssessmentComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _VulnerabilityAssessmentComponent_vue_vue_type_template_id_1cfff6fb___WEBPACK_IMPORTED_MODULE_0__["render"],
  _VulnerabilityAssessmentComponent_vue_vue_type_template_id_1cfff6fb___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/pages/assessments/vulnerabilities/VulnerabilityAssessmentComponent.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/pages/assessments/vulnerabilities/VulnerabilityAssessmentComponent.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************!*\
  !*** ./resources/js/pages/assessments/vulnerabilities/VulnerabilityAssessmentComponent.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_VulnerabilityAssessmentComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./VulnerabilityAssessmentComponent.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/assessments/vulnerabilities/VulnerabilityAssessmentComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_VulnerabilityAssessmentComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/pages/assessments/vulnerabilities/VulnerabilityAssessmentComponent.vue?vue&type=template&id=1cfff6fb&":
/*!****************************************************************************************************************************!*\
  !*** ./resources/js/pages/assessments/vulnerabilities/VulnerabilityAssessmentComponent.vue?vue&type=template&id=1cfff6fb& ***!
  \****************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_VulnerabilityAssessmentComponent_vue_vue_type_template_id_1cfff6fb___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./VulnerabilityAssessmentComponent.vue?vue&type=template&id=1cfff6fb& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/assessments/vulnerabilities/VulnerabilityAssessmentComponent.vue?vue&type=template&id=1cfff6fb&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_VulnerabilityAssessmentComponent_vue_vue_type_template_id_1cfff6fb___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_VulnerabilityAssessmentComponent_vue_vue_type_template_id_1cfff6fb___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/pages/clients/ClientListComponent.vue":
/*!************************************************************!*\
  !*** ./resources/js/pages/clients/ClientListComponent.vue ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ClientListComponent_vue_vue_type_template_id_2d5dd418___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ClientListComponent.vue?vue&type=template&id=2d5dd418& */ "./resources/js/pages/clients/ClientListComponent.vue?vue&type=template&id=2d5dd418&");
/* harmony import */ var _ClientListComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ClientListComponent.vue?vue&type=script&lang=js& */ "./resources/js/pages/clients/ClientListComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ClientListComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ClientListComponent_vue_vue_type_template_id_2d5dd418___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ClientListComponent_vue_vue_type_template_id_2d5dd418___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/pages/clients/ClientListComponent.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/pages/clients/ClientListComponent.vue?vue&type=script&lang=js&":
/*!*************************************************************************************!*\
  !*** ./resources/js/pages/clients/ClientListComponent.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ClientListComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./ClientListComponent.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/clients/ClientListComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ClientListComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/pages/clients/ClientListComponent.vue?vue&type=template&id=2d5dd418&":
/*!*******************************************************************************************!*\
  !*** ./resources/js/pages/clients/ClientListComponent.vue?vue&type=template&id=2d5dd418& ***!
  \*******************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ClientListComponent_vue_vue_type_template_id_2d5dd418___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./ClientListComponent.vue?vue&type=template&id=2d5dd418& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/pages/clients/ClientListComponent.vue?vue&type=template&id=2d5dd418&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ClientListComponent_vue_vue_type_template_id_2d5dd418___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ClientListComponent_vue_vue_type_template_id_2d5dd418___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/shared/modals/modal-loader.js":
/*!****************************************************!*\
  !*** ./resources/js/shared/modals/modal-loader.js ***!
  \****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var ModalPlugin = {
  install: function install(Vue) {
    Vue.mixin({
      data: function data() {
        return {};
      },
      methods: {
        loadPageInAModal: function loadPageInAModal(url) {
          var title = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'View';
          var iconClass = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'fa-eye';
          var modaldis = '<div class="modal fade" data-backdrop="false" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
          modaldis += '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
          modaldis += '<div class="modal-content">';
          modaldis += '<div class="modal-header bg-indigo">';
          modaldis += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
          modaldis += '<span id="myModalLabel" class="caption caption-subject font-blue-sharp bold uppercase" style="text-align: center">' + '<i class="fa ' + iconClass + ' ' + ' font-blue-sharp"></i>' + ' ' + title + '</span>';
          modaldis += '</div>';
          modaldis += '<div class="modal-body">';
          modaldis += ' </div>';
          modaldis += '</div>';
          modaldis += '</div>';
          $('body').css('overflow-y', 'scroll');
          $("body").append(modaldis);
          $("#myModal").modal("show");
          $(".modal-body").html("<h3><i class='fa fa-spin fa-spinner '></i><span>loading...</span><h3>");
          $(".modal-body").load(url);
          $("#myModal").on('hidden.bs.modal', function () {
            $("#myModal").remove();
          });
        },
        // Confirmation dialog
        deleteRecord: function deleteRecord(url) {
          bootbox.confirm("Are You Sure to delete record?", function (result) {
            if (result) {
              axios({
                method: 'DELETE',
                url: url
              }).then(function (response) {
                location.reload();
              });
            }
          });
        },
        // Confirmation dialog
        authorizeRecord: function authorizeRecord(url) {
          bootbox.confirm("Are You Sure to athorize record?", function (result) {
            if (result) {
              axios({
                method: 'POST',
                url: url
              }).then(function (response) {
                location.reload();
              });
            }
          });
        },
        // Confirmation dialog
        downloadRecord: function downloadRecord(url) {
          bootbox.confirm("Are You Sure to athorize record?", function (result) {
            if (result) {
              axios({
                method: 'POST',
                url: url
              }).then(function (response) {
                location.reload();
              });
            }
          });
        }
      }
    });
    Object.defineProperty(Vue.prototype, "$modal", {
      get: function get() {
        return this.$root;
      }
    });
  }
};
/* harmony default export */ __webpack_exports__["default"] = (ModalPlugin);

/***/ }),

/***/ "./resources/js/store/actions.js":
/*!***************************************!*\
  !*** ./resources/js/store/actions.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {



/***/ }),

/***/ "./resources/js/store/getters.js":
/*!***************************************!*\
  !*** ./resources/js/store/getters.js ***!
  \***************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var getters = {
  isLoading: function isLoading(state) {
    return state.isLoading;
  },
  isSending: function isSending(state) {
    return state.isSending;
  },
  pagination: function pagination(state) {
    return state.pagination;
  },
  authRole: function authRole(state) {
    return state.authRole;
  }
};
/* harmony default export */ __webpack_exports__["default"] = (getters);

/***/ }),

/***/ "./resources/js/store/modules/client.js":
/*!**********************************************!*\
  !*** ./resources/js/store/modules/client.js ***!
  \**********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
// initial state
var state = {
  client: {},
  clients: []
}; // getters

var getters = {
  clients: function clients(state) {
    return state.clients;
  },
  client: function client(state) {
    return state.client;
  },
  clientsCount: function clientsCount(state) {
    return state.clientsCount;
  }
}; // actions

var actions = {
  getClients: function getClients(_ref, data) {
    var commit = _ref.commit;
    axios({
      method: 'GET',
      url: '/rest/secured/clients?page=' + data.currentPage + '&perPage=' + data.perPage + '&sortType=' + data.sortType + '&sortField=' + data.sortField
    }).then(function (response) {
      var data = response.data;
      commit('setClients', data.clients.data);
      commit('setPagination', data.pagination);
      commit('setAuthRole', data.authRole);
    })["catch"](function (error) {
      console.log(error);
    });
  },
  postClient: function postClient(_ref2, client) {
    var commit = _ref2.commit;
    return new Promise(function (resolve, reject) {
      axios({
        method: 'POST',
        url: '/rest/secured/clients',
        data: client
      }).then(function (response) {
        var data = response.data;
        resolve(data);
      })["catch"](function (error) {
        var resp = error.response;
        reject(resp);
      });
    });
  },
  updateClient: function updateClient(_ref3, client) {
    var commit = _ref3.commit;
    return new Promise(function (resolve, reject) {
      axios({
        method: 'PUT',
        url: '/rest/secured/clients',
        data: client
      }).then(function (response) {
        var data = response.data;
        resolve(data);
      })["catch"](function (error) {
        var resp = error.response;
        reject(resp);
      });
    });
  },
  deleteClient: function deleteClient(_ref4, client) {
    var commit = _ref4.commit;
    return new Promise(function (resolve, reject) {
      axios({
        method: 'DELETE',
        url: '/rest/secured/clients/' + client.id,
        data: {}
      }).then(function (response) {
        var data = response.data;
        resolve(data);
      })["catch"](function (error) {
        var resp = error.response;
        reject(resp);
      });
    });
  },
  searchClientWithPagination: function searchClientWithPagination(_ref5, data) {
    var commit = _ref5.commit,
        dispatch = _ref5.dispatch;

    if (data.searchTerm) {
      axios({
        method: 'GET',
        url: '/rest/secured/clients/search-paginated?searchTerm=' + data.searchTerm + '&page=' + data.currentPage + '&perPage=' + data.perPage + '&sortType=' + data.sortType + '&sortField=' + data.sortField
      }).then(function (response) {
        var data = response.data;
        commit('setClients', data.clients.data);
        commit('setPagination', data.pagination);
        commit('setAuthRole', data.authRole);
      })["catch"](function (error) {
        var resp = error.response;
      });
    } else {
      dispatch('getClients', data);
    }
  },
  searchClient: function searchClient(_ref6, data) {
    var commit = _ref6.commit;
    return new Promise(function (resolve, reject) {
      axios({
        method: 'GET',
        url: '/rest/secured/clients/search?searchTerm=' + data.searchTerm
      }).then(function (response) {
        var data = response.data;
        resolve(data);
      })["catch"](function (error) {
        var resp = error.response;
        reject(resp);
      });
    });
  }
}; // mutations

var mutations = {
  setClient: function setClient(state, client) {
    state.client = client;
  },
  setClients: function setClients(state, clients) {
    state.clients = clients;
  },
  setClientsCount: function setClientsCount(state, count) {
    state.clientsCount = count;
  }
};
/* harmony default export */ __webpack_exports__["default"] = ({
  state: state,
  getters: getters,
  actions: actions,
  mutations: mutations
});

/***/ }),

/***/ "./resources/js/store/modules/vulnerability-assessment.js":
/*!****************************************************************!*\
  !*** ./resources/js/store/modules/vulnerability-assessment.js ***!
  \****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
// initial state
var state = {
  vulnerabilityAssessment: {},
  vulnerabilityAssessments: []
}; // getters

var getters = {
  vulnerabilityAssessments: function vulnerabilityAssessments(state) {
    return state.vulnerabilityAssessments;
  },
  vulnerabilityAssessment: function vulnerabilityAssessment(state) {
    return state.vulnerabilityAssessment;
  },
  vulnerabilityAssessmentsCount: function vulnerabilityAssessmentsCount(state) {
    return state.vulnerabilityAssessmentsCount;
  }
}; // actions

var actions = {
  getVulnerabilityAssessments: function getVulnerabilityAssessments(_ref, data) {
    var commit = _ref.commit;
    axios({
      method: 'GET',
      url: '/rest/secured/assessments/vulnerabilities?page=' + data.currentPage + '&perPage=' + data.perPage + '&sortType=' + data.sortType + '&sortField=' + data.sortField
    }).then(function (response) {
      var data = response.data;
      commit('setVulnerabilityAssessments', data.vulnerabilityAssessments.data);
      commit('setPagination', data.pagination);
      commit('setAuthRole', data.authRole);
    })["catch"](function (error) {
      console.log(error);
    });
  },
  postVulnerabilityAssessment: function postVulnerabilityAssessment(_ref2, vulnerabilityAssessment) {
    var commit = _ref2.commit;
    return new Promise(function (resolve, reject) {
      axios({
        method: 'POST',
        url: '/rest/secured/assessments/vulnerabilities',
        data: vulnerabilityAssessment
      }).then(function (response) {
        var data = response.data;
        resolve(data);
      })["catch"](function (error) {
        var resp = error.response;
        reject(resp);
      });
    });
  },
  updateVulnerabilityAssessment: function updateVulnerabilityAssessment(_ref3, vulnerabilityAssessment) {
    var commit = _ref3.commit;
    return new Promise(function (resolve, reject) {
      axios({
        method: 'PUT',
        url: '/rest/secured/assessments/vulnerabilities',
        data: vulnerabilityAssessment
      }).then(function (response) {
        var data = response.data;
        resolve(data);
      })["catch"](function (error) {
        var resp = error.response;
        reject(resp);
      });
    });
  },
  deleteVulnerabilityAssessment: function deleteVulnerabilityAssessment(_ref4, vulnerabilityAssessment) {
    var commit = _ref4.commit;
    return new Promise(function (resolve, reject) {
      axios({
        method: 'DELETE',
        url: '/rest/secured/assessments/vulnerabilities/' + vulnerabilityAssessment.id,
        data: {}
      }).then(function (response) {
        var data = response.data;
        resolve(data);
      })["catch"](function (error) {
        var resp = error.response;
        reject(resp);
      });
    });
  },
  searchVulnerabilityAssessmentWithPagination: function searchVulnerabilityAssessmentWithPagination(_ref5, data) {
    var commit = _ref5.commit,
        dispatch = _ref5.dispatch;

    if (data.searchTerm) {
      axios({
        method: 'GET',
        url: '/rest/secured/assessments/vulnerabilities/search-paginated?searchTerm=' + data.searchTerm + '&page=' + data.currentPage + '&perPage=' + data.perPage + '&sortType=' + data.sortType + '&sortField=' + data.sortField
      }).then(function (response) {
        var data = response.data;
        commit('setVulnerabilityAssessments', data.vulnerabilityAssessments.data);
        commit('setPagination', data.pagination);
        commit('setAuthRole', data.authRole);
      })["catch"](function (error) {
        var resp = error.response;
      });
    } else {
      dispatch('getVulnerabilityAssessments', data);
    }
  },
  searchVulnerabilityAssessment: function searchVulnerabilityAssessment(_ref6, data) {
    var commit = _ref6.commit;
    return new Promise(function (resolve, reject) {
      axios({
        method: 'GET',
        url: '/rest/secured/assessments/vulnerabilities/search?searchTerm=' + data.searchTerm
      }).then(function (response) {
        var data = response.data;
        resolve(data);
      })["catch"](function (error) {
        var resp = error.response;
        reject(resp);
      });
    });
  }
}; // mutations

var mutations = {
  setVulnerabilityAssessment: function setVulnerabilityAssessment(state, vulnerabilityAssessment) {
    state.vulnerabilityAssessment = vulnerabilityAssessment;
  },
  setVulnerabilityAssessments: function setVulnerabilityAssessments(state, vulnerabilityAssessments) {
    state.vulnerabilityAssessments = vulnerabilityAssessments;
  },
  setVulnerabilityAssessmentsCount: function setVulnerabilityAssessmentsCount(state, count) {
    state.vulnerabilityAssessmentsCount = count;
  }
};
/* harmony default export */ __webpack_exports__["default"] = ({
  state: state,
  getters: getters,
  actions: actions,
  mutations: mutations
});

/***/ }),

/***/ "./resources/js/store/mutations.js":
/*!*****************************************!*\
  !*** ./resources/js/store/mutations.js ***!
  \*****************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var mutations = {
  setLoading: function setLoading(state, isLoading) {
    state.isLoading = isLoading;
  },
  setSending: function setSending(state, isSending) {
    state.isSending = isSending;
  },
  setPagination: function setPagination(state, pagination) {
    state.pagination = pagination;
  },
  setAuthRole: function setAuthRole(state, authRole) {
    state.authRole = authRole;
  }
};
/* harmony default export */ __webpack_exports__["default"] = (mutations);

/***/ }),

/***/ "./resources/js/store/state.js":
/*!*************************************!*\
  !*** ./resources/js/store/state.js ***!
  \*************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var state = {
  isLoading: false,
  isSending: false,
  authRole: 'view',
  pagination: {
    currentPage: 1,
    firstPageUrl: '',
    from: '',
    lastPage: '',
    lastPageUrl: '',
    nextPageUrl: '',
    path: '',
    perPage: 15,
    prevPageUrl: '',
    to: '',
    total: 0,
    sortType: 'desc',
    sortField: 'created_at',
    perPageDropdown: [15, 30, 45, 60],
    searchTerm: ''
  }
};
/* harmony default export */ __webpack_exports__["default"] = (state);

/***/ }),

/***/ "./resources/js/store/store.js":
/*!*************************************!*\
  !*** ./resources/js/store/store.js ***!
  \*************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.common.js");
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vue__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
/* harmony import */ var _state__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./state */ "./resources/js/store/state.js");
/* harmony import */ var _mutations__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./mutations */ "./resources/js/store/mutations.js");
/* harmony import */ var _getters__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./getters */ "./resources/js/store/getters.js");
/* harmony import */ var _actions__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./actions */ "./resources/js/store/actions.js");
/* harmony import */ var _actions__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_actions__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _modules_client__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./modules/client */ "./resources/js/store/modules/client.js");
/* harmony import */ var _modules_vulnerability_assessment__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./modules/vulnerability-assessment */ "./resources/js/store/modules/vulnerability-assessment.js");








vue__WEBPACK_IMPORTED_MODULE_0___default.a.use(vuex__WEBPACK_IMPORTED_MODULE_1__["default"]);
/* harmony default export */ __webpack_exports__["default"] = (new vuex__WEBPACK_IMPORTED_MODULE_1__["default"].Store({
  modules: {
    client: _modules_client__WEBPACK_IMPORTED_MODULE_6__["default"],
    vulnerabilityAssessment: _modules_vulnerability_assessment__WEBPACK_IMPORTED_MODULE_7__["default"]
  },
  state: _state__WEBPACK_IMPORTED_MODULE_2__["default"],
  getters: _getters__WEBPACK_IMPORTED_MODULE_4__["default"],
  mutations: _mutations__WEBPACK_IMPORTED_MODULE_3__["default"],
  actions: _actions__WEBPACK_IMPORTED_MODULE_5___default.a
}));

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/onkomanya/brew/var/www/cams/protected/resources/js/app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! /Users/onkomanya/brew/var/www/cams/protected/resources/sass/app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });