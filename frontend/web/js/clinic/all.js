"use strict";

function _typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

var Calendar =
/*#__PURE__*/
function (_React$Component) {
  _inherits(Calendar, _React$Component);

  function Calendar(prop) {
    var _this;

    _classCallCheck(this, Calendar);

    _this = _possibleConstructorReturn(this, _getPrototypeOf(Calendar).call(this, prop));
    _this.state = {
      days: ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'],
      months: ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'],
      date: new Date(),
      initialWeekDay: 0,
      initialDay: 0,
      finalDay: 0
    };
    return _this;
  }

  _createClass(Calendar, [{
    key: "componentDidMount",
    value: function componentDidMount() {
      this.setState({
        initialWeekDay: this.state.date.getDay(),
        initialDay: this.state.date.getDate(),
        finalDay: this.daysInMonth(this.state.date.getMonth(), this.state.date.getFullYear())
      });
    }
  }, {
    key: "renderDays",
    value: function renderDays() {
      var _this2 = this;

      return this.state.days.map(function (day) {
        return React.createElement("div", {
          key: "weekday-".concat(day),
          className: "calendar-day"
        }, _this2.capitalizeFirstLetter(day));
      });
    }
  }, {
    key: "renderDate",
    value: function renderDate() {
      var _this$state = this.state,
          date = _this$state.date,
          initialWeekDay = _this$state.initialWeekDay,
          initialDay = _this$state.initialDay,
          finalDay = _this$state.finalDay;
      var calendar = [];

      for (var i = 0; i <= initialWeekDay; i++) {
        calendar.push(React.createElement("div", {
          key: "blank-".concat(i),
          className: "calendar-day calendar-day-blank"
        }, " "));
      }

      for (var _i = 1; _i <= finalDay; _i++) {
        if (_i < initialDay) {
          calendar.push(React.createElement("div", {
            key: "day-".concat(_i),
            className: "calendar-day calendar-day-disabled"
          }, _i));
        } else {
          calendar.push(React.createElement("div", {
            key: "day-".concat(_i),
            className: "calendar-day calendar-day-available"
          }, _i));
        }
      }

      return calendar;
    }
  }, {
    key: "renderMonth",
    value: function renderMonth() {
      return this.capitalizeFirstLetter(this.state.months[this.state.date.getMonth()]);
    }
  }, {
    key: "daysInMonth",
    value: function daysInMonth(month, year) {
      return 32 - new Date(year, month, 32).getDate();
    }
  }, {
    key: "capitalizeFirstLetter",
    value: function capitalizeFirstLetter(string) {
      return string.charAt(0).toUpperCase() + string.slice(1);
    }
  }, {
    key: "render",
    value: function render() {
      return React.createElement("div", {
        className: "calendar"
      }, React.createElement("div", {
        className: "row text-center"
      }, React.createElement("h2", null, this.renderMonth())), React.createElement("div", {
        className: "row"
      }, this.renderDays(), this.renderDate()));
    }
  }]);

  return Calendar;
}(React.Component); // export default Clinic;
"use strict";

// import Clinic from './components/Clinic.js';
ReactDOM.render(React.createElement(Calendar, null), document.getElementById('app-root'));