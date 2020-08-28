/*!
FullCalendar Scheduler v5.2.1
Docs & License: https://fullcalendar.io/scheduler
(c) 2020 Adam Shaw
*/
var FullCalendarResourceTimeGrid = (function (exports, common, premiumCommonPlugin, resourceCommonPlugin, timeGridPlugin, resourceDaygrid) {
    'use strict';

    premiumCommonPlugin = premiumCommonPlugin && Object.prototype.hasOwnProperty.call(premiumCommonPlugin, 'default') ? premiumCommonPlugin['default'] : premiumCommonPlugin;
    var resourceCommonPlugin__default = 'default' in resourceCommonPlugin ? resourceCommonPlugin['default'] : resourceCommonPlugin;
    var timeGridPlugin__default = 'default' in timeGridPlugin ? timeGridPlugin['default'] : timeGridPlugin;

    /*! *****************************************************************************
    Copyright (c) Microsoft Corporation.

    Permission to use, copy, modify, and/or distribute this software for any
    purpose with or without fee is hereby granted.

    THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES WITH
    REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF MERCHANTABILITY
    AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY SPECIAL, DIRECT,
    INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES WHATSOEVER RESULTING FROM
    LOSS OF USE, DATA OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR
    OTHER TORTIOUS ACTION, ARISING OUT OF OR IN CONNECTION WITH THE USE OR
    PERFORMANCE OF THIS SOFTWARE.
    ***************************************************************************** */
    /* global Reflect, Promise */

    var extendStatics = function(d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };

    function __extends(d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    }

    var __assign = function() {
        __assign = Object.assign || function __assign(t) {
            for (var s, i = 1, n = arguments.length; i < n; i++) {
                s = arguments[i];
                for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p)) t[p] = s[p];
            }
            return t;
        };
        return __assign.apply(this, arguments);
    };

    var ResourceDayTimeCols = /** @class */ (function (_super) {
        __extends(ResourceDayTimeCols, _super);
        function ResourceDayTimeCols() {
            var _this = _super !== null && _super.apply(this, arguments) || this;
            _this.allowAcrossResources = false;
            _this.buildDayRanges = common.memoize(timeGridPlugin.buildDayRanges);
            _this.splitter = new resourceCommonPlugin.VResourceSplitter();
            _this.slicers = {};
            _this.joiner = new ResourceDayTimeColsJoiner();
            _this.timeColsRef = common.createRef();
            _this.handleRootEl = function (rootEl) {
                if (rootEl) {
                    _this.context.registerInteractiveComponent(_this, { el: rootEl });
                }
                else {
                    _this.context.unregisterInteractiveComponent(_this);
                }
            };
            return _this;
        }
        ResourceDayTimeCols.prototype.render = function () {
            var _this = this;
            var _a = this, props = _a.props, context = _a.context;
            var dateEnv = context.dateEnv, options = context.options;
            var dateProfile = props.dateProfile, resourceDayTableModel = props.resourceDayTableModel;
            var dayRanges = this.dayRanges = this.buildDayRanges(resourceDayTableModel.dayTableModel, dateProfile, dateEnv);
            var splitProps = this.splitter.splitProps(props);
            this.slicers = common.mapHash(splitProps, function (split, resourceId) {
                return _this.slicers[resourceId] || new timeGridPlugin.DayTimeColsSlicer();
            });
            var slicedProps = common.mapHash(this.slicers, function (slicer, resourceId) {
                return slicer.sliceProps(splitProps[resourceId], dateProfile, null, context, dayRanges);
            });
            this.allowAcrossResources = dayRanges.length === 1;
            return ( // TODO: would move this further down hierarchy, but sliceNowDate needs it
            common.createElement(common.NowTimer, { unit: options.nowIndicator ? 'minute' : 'day' }, function (nowDate, todayRange) { return (common.createElement(timeGridPlugin.TimeCols, __assign({ ref: _this.timeColsRef, rootElRef: _this.handleRootEl }, _this.joiner.joinProps(slicedProps, resourceDayTableModel), { dateProfile: dateProfile, axis: props.axis, slotDuration: props.slotDuration, slatMetas: props.slatMetas, cells: resourceDayTableModel.cells[0], tableColGroupNode: props.tableColGroupNode, tableMinWidth: props.tableMinWidth, clientWidth: props.clientWidth, clientHeight: props.clientHeight, expandRows: props.expandRows, nowDate: nowDate, nowIndicatorSegs: options.nowIndicator && _this.buildNowIndicatorSegs(nowDate), todayRange: todayRange, onScrollTopRequest: props.onScrollTopRequest, forPrint: props.forPrint, onSlatCoords: props.onSlatCoords }))); }));
        };
        ResourceDayTimeCols.prototype.buildNowIndicatorSegs = function (date) {
            var nonResourceSegs = this.slicers[''].sliceNowDate(date, this.context, this.dayRanges);
            return this.joiner.expandSegs(this.props.resourceDayTableModel, nonResourceSegs);
        };
        ResourceDayTimeCols.prototype.queryHit = function (positionLeft, positionTop) {
            var rawHit = this.timeColsRef.current.positionToHit(positionLeft, positionTop);
            if (rawHit) {
                return {
                    component: this,
                    dateSpan: {
                        range: rawHit.dateSpan.range,
                        allDay: rawHit.dateSpan.allDay,
                        resourceId: this.props.resourceDayTableModel.cells[0][rawHit.col].resource.id
                    },
                    dayEl: rawHit.dayEl,
                    rect: {
                        left: rawHit.relativeRect.left,
                        right: rawHit.relativeRect.right,
                        top: rawHit.relativeRect.top,
                        bottom: rawHit.relativeRect.bottom
                    },
                    layer: 0
                };
            }
        };
        return ResourceDayTimeCols;
    }(common.DateComponent));
    var ResourceDayTimeColsJoiner = /** @class */ (function (_super) {
        __extends(ResourceDayTimeColsJoiner, _super);
        function ResourceDayTimeColsJoiner() {
            return _super !== null && _super.apply(this, arguments) || this;
        }
        ResourceDayTimeColsJoiner.prototype.transformSeg = function (seg, resourceDayTable, resourceI) {
            return [
                __assign(__assign({}, seg), { col: resourceDayTable.computeCol(seg.col, resourceI) })
            ];
        };
        return ResourceDayTimeColsJoiner;
    }(resourceCommonPlugin.VResourceJoiner));

    var ResourceDayTimeColsView = /** @class */ (function (_super) {
        __extends(ResourceDayTimeColsView, _super);
        function ResourceDayTimeColsView() {
            var _this = _super !== null && _super.apply(this, arguments) || this;
            _this.flattenResources = common.memoize(resourceCommonPlugin.flattenResources);
            _this.buildResourceTimeColsModel = common.memoize(buildResourceTimeColsModel);
            _this.buildSlatMetas = common.memoize(timeGridPlugin.buildSlatMetas);
            return _this;
        }
        ResourceDayTimeColsView.prototype.render = function () {
            var _this = this;
            var _a = this, props = _a.props, context = _a.context;
            var options = context.options, dateEnv = context.dateEnv;
            var dateProfile = props.dateProfile;
            var splitProps = this.allDaySplitter.splitProps(props);
            var resourceOrderSpecs = options.resourceOrder || resourceCommonPlugin.DEFAULT_RESOURCE_ORDER;
            var resources = this.flattenResources(props.resourceStore, resourceOrderSpecs);
            var resourceDayTableModel = this.buildResourceTimeColsModel(dateProfile, context.dateProfileGenerator, resources, options.datesAboveResources, context);
            var slatMetas = this.buildSlatMetas(dateProfile.slotMinTime, dateProfile.slotMaxTime, options.slotLabelInterval, options.slotDuration, dateEnv);
            var dayMinWidth = options.dayMinWidth;
            var hasAttachedAxis = !dayMinWidth;
            var hasDetachedAxis = dayMinWidth;
            var headerContent = options.dayHeaders &&
                common.createElement(resourceCommonPlugin.ResourceDayHeader, { resources: resources, dates: resourceDayTableModel.dayTableModel.headerDates, dateProfile: dateProfile, datesRepDistinctDays: true, renderIntro: hasAttachedAxis ? this.renderHeadAxis : null });
            var allDayContent = (options.allDaySlot !== false) && (function (contentArg) { return (common.createElement(resourceDaygrid.ResourceDayTable, __assign({}, splitProps['allDay'], { dateProfile: dateProfile, resourceDayTableModel: resourceDayTableModel, nextDayThreshold: options.nextDayThreshold, tableMinWidth: contentArg.tableMinWidth, colGroupNode: contentArg.tableColGroupNode, renderRowIntro: hasAttachedAxis ? _this.renderTableRowAxis : null, showWeekNumbers: false, expandRows: false, headerAlignElRef: _this.headerElRef, clientWidth: contentArg.clientWidth, clientHeight: contentArg.clientHeight, forPrint: props.forPrint }, _this.getAllDayMaxEventProps()))); });
            var timeGridContent = function (contentArg) { return (common.createElement(ResourceDayTimeCols, __assign({}, splitProps['timed'], { dateProfile: dateProfile, axis: hasAttachedAxis, slotDuration: options.slotDuration, slatMetas: slatMetas, resourceDayTableModel: resourceDayTableModel, tableColGroupNode: contentArg.tableColGroupNode, tableMinWidth: contentArg.tableMinWidth, clientWidth: contentArg.clientWidth, clientHeight: contentArg.clientHeight, onSlatCoords: _this.handleSlatCoords, expandRows: contentArg.expandRows, forPrint: props.forPrint, onScrollTopRequest: _this.handleScrollTopRequest }))); };
            return hasDetachedAxis
                ? this.renderHScrollLayout(headerContent, allDayContent, timeGridContent, resourceDayTableModel.colCnt, dayMinWidth, slatMetas, this.state.slatCoords)
                : this.renderSimpleLayout(headerContent, allDayContent, timeGridContent);
        };
        return ResourceDayTimeColsView;
    }(timeGridPlugin.TimeColsView));
    function buildResourceTimeColsModel(dateProfile, dateProfileGenerator, resources, datesAboveResources, context) {
        var dayTable = timeGridPlugin.buildTimeColsModel(dateProfile, dateProfileGenerator);
        return datesAboveResources ?
            new resourceCommonPlugin.DayResourceTableModel(dayTable, resources, context) :
            new resourceCommonPlugin.ResourceDayTableModel(dayTable, resources, context);
    }

    var plugin = common.createPlugin({
        deps: [
            premiumCommonPlugin,
            resourceCommonPlugin__default,
            timeGridPlugin__default
        ],
        initialView: 'resourceTimeGridDay',
        views: {
            resourceTimeGrid: {
                type: 'timeGrid',
                component: ResourceDayTimeColsView,
                needsResourceData: true
            },
            resourceTimeGridDay: {
                type: 'resourceTimeGrid',
                duration: { days: 1 }
            },
            resourceTimeGridWeek: {
                type: 'resourceTimeGrid',
                duration: { weeks: 1 }
            }
        }
    });

    common.globalPlugins.push(plugin);

    exports.ResourceDayTimeCols = ResourceDayTimeCols;
    exports.ResourceDayTimeColsView = ResourceDayTimeColsView;
    exports.default = plugin;

    return exports;

}({}, FullCalendar, FullCalendarPremiumCommon, FullCalendarResourceCommon, FullCalendarTimeGrid, FullCalendarResourceDayGrid));
