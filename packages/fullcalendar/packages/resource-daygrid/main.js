/*!
FullCalendar Scheduler v5.2.1
Docs & License: https://fullcalendar.io/scheduler
(c) 2020 Adam Shaw
*/
import { createRef, mapHash, createElement, DateComponent, memoize, createPlugin } from '@fullcalendar/common';
import premiumCommonPlugin from '@fullcalendar/premium-common';
import resourceCommonPlugin, { VResourceSplitter, VResourceJoiner, flattenResources, DEFAULT_RESOURCE_ORDER, ResourceDayHeader, DayResourceTableModel, ResourceDayTableModel } from '@fullcalendar/resource-common';
import dayGridPlugin, { DayTableSlicer, Table, TableView, buildDayTableModel } from '@fullcalendar/daygrid';
import { __extends, __assign } from 'tslib';

var ResourceDayTable = /** @class */ (function (_super) {
    __extends(ResourceDayTable, _super);
    function ResourceDayTable() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.allowAcrossResources = false;
        _this.splitter = new VResourceSplitter();
        _this.slicers = {};
        _this.joiner = new ResourceDayTableJoiner();
        _this.tableRef = createRef();
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
    ResourceDayTable.prototype.render = function () {
        var _this = this;
        var _a = this, props = _a.props, context = _a.context;
        var resourceDayTableModel = props.resourceDayTableModel, nextDayThreshold = props.nextDayThreshold, dateProfile = props.dateProfile;
        var splitProps = this.splitter.splitProps(props);
        this.slicers = mapHash(splitProps, function (split, resourceId) {
            return _this.slicers[resourceId] || new DayTableSlicer();
        });
        var slicedProps = mapHash(this.slicers, function (slicer, resourceId) {
            return slicer.sliceProps(splitProps[resourceId], dateProfile, nextDayThreshold, context, resourceDayTableModel.dayTableModel);
        });
        this.allowAcrossResources = resourceDayTableModel.dayTableModel.colCnt === 1; // hack for EventResizing
        return (createElement(Table, __assign({ forPrint: props.forPrint, ref: this.tableRef, elRef: this.handleRootEl }, this.joiner.joinProps(slicedProps, resourceDayTableModel), { cells: resourceDayTableModel.cells, dateProfile: dateProfile, colGroupNode: props.colGroupNode, tableMinWidth: props.tableMinWidth, renderRowIntro: props.renderRowIntro, dayMaxEvents: props.dayMaxEvents, dayMaxEventRows: props.dayMaxEventRows, showWeekNumbers: props.showWeekNumbers, expandRows: props.expandRows, headerAlignElRef: props.headerAlignElRef, clientWidth: props.clientWidth, clientHeight: props.clientHeight })));
    };
    ResourceDayTable.prototype.prepareHits = function () {
        this.tableRef.current.prepareHits();
    };
    ResourceDayTable.prototype.queryHit = function (positionLeft, positionTop) {
        var rawHit = this.tableRef.current.positionToHit(positionLeft, positionTop);
        if (rawHit) {
            return {
                component: this,
                dateSpan: {
                    range: rawHit.dateSpan.range,
                    allDay: rawHit.dateSpan.allDay,
                    resourceId: this.props.resourceDayTableModel.cells[rawHit.row][rawHit.col].resource.id
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
    return ResourceDayTable;
}(DateComponent));
var ResourceDayTableJoiner = /** @class */ (function (_super) {
    __extends(ResourceDayTableJoiner, _super);
    function ResourceDayTableJoiner() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    ResourceDayTableJoiner.prototype.transformSeg = function (seg, resourceDayTableModel, resourceI) {
        var colRanges = resourceDayTableModel.computeColRanges(seg.firstCol, seg.lastCol, resourceI);
        return colRanges.map(function (colRange) {
            return __assign(__assign(__assign({}, seg), colRange), { isStart: seg.isStart && colRange.isStart, isEnd: seg.isEnd && colRange.isEnd });
        });
    };
    return ResourceDayTableJoiner;
}(VResourceJoiner));

var ResourceDayTableView = /** @class */ (function (_super) {
    __extends(ResourceDayTableView, _super);
    function ResourceDayTableView() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.flattenResources = memoize(flattenResources);
        _this.buildResourceDayTableModel = memoize(buildResourceDayTableModel);
        _this.headerRef = createRef();
        _this.tableRef = createRef();
        return _this;
    }
    ResourceDayTableView.prototype.render = function () {
        var _this = this;
        var _a = this, props = _a.props, context = _a.context;
        var options = context.options;
        var resourceOrderSpecs = options.resourceOrder || DEFAULT_RESOURCE_ORDER;
        var resources = this.flattenResources(props.resourceStore, resourceOrderSpecs);
        var resourceDayTableModel = this.buildResourceDayTableModel(props.dateProfile, context.dateProfileGenerator, resources, options.datesAboveResources, context);
        var headerContent = options.dayHeaders &&
            createElement(ResourceDayHeader, { ref: this.headerRef, resources: resources, dateProfile: props.dateProfile, dates: resourceDayTableModel.dayTableModel.headerDates, datesRepDistinctDays: true });
        var bodyContent = function (contentArg) { return (createElement(ResourceDayTable, { ref: _this.tableRef, dateProfile: props.dateProfile, resourceDayTableModel: resourceDayTableModel, businessHours: props.businessHours, eventStore: props.eventStore, eventUiBases: props.eventUiBases, dateSelection: props.dateSelection, eventSelection: props.eventSelection, eventDrag: props.eventDrag, eventResize: props.eventResize, nextDayThreshold: options.nextDayThreshold, tableMinWidth: contentArg.tableMinWidth, colGroupNode: contentArg.tableColGroupNode, dayMaxEvents: options.dayMaxEvents, dayMaxEventRows: options.dayMaxEventRows, showWeekNumbers: options.weekNumbers, expandRows: !props.isHeightAuto, headerAlignElRef: _this.headerElRef, clientWidth: contentArg.clientWidth, clientHeight: contentArg.clientHeight, forPrint: props.forPrint })); };
        return options.dayMinWidth
            ? this.renderHScrollLayout(headerContent, bodyContent, resourceDayTableModel.colCnt, options.dayMinWidth)
            : this.renderSimpleLayout(headerContent, bodyContent);
    };
    return ResourceDayTableView;
}(TableView));
function buildResourceDayTableModel(dateProfile, dateProfileGenerator, resources, datesAboveResources, context) {
    var dayTable = buildDayTableModel(dateProfile, dateProfileGenerator);
    return datesAboveResources ?
        new DayResourceTableModel(dayTable, resources, context) :
        new ResourceDayTableModel(dayTable, resources, context);
}

var main = createPlugin({
    deps: [
        premiumCommonPlugin,
        resourceCommonPlugin,
        dayGridPlugin
    ],
    initialView: 'resourceDayGridDay',
    views: {
        resourceDayGrid: {
            type: 'dayGrid',
            component: ResourceDayTableView,
            needsResourceData: true
        },
        resourceDayGridDay: {
            type: 'resourceDayGrid',
            duration: { days: 1 }
        },
        resourceDayGridWeek: {
            type: 'resourceDayGrid',
            duration: { weeks: 1 }
        },
        resourceDayGridMonth: {
            type: 'resourceDayGrid',
            duration: { months: 1 },
            // TODO: wish we didn't have to C&P from dayGrid's file
            monthMode: true,
            fixedWeekCount: true
        }
    }
});

export default main;
export { ResourceDayTable, ResourceDayTableView };
//# sourceMappingURL=main.js.map
