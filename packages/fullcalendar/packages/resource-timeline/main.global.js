/*!
FullCalendar Scheduler v5.2.1
Docs & License: https://fullcalendar.io/scheduler
(c) 2020 Adam Shaw
*/
var FullCalendarResourceTimeline = (function (exports, common, premiumCommonPlugin, timelinePlugin, resourceCommonPlugin, scrollgrid) {
    'use strict';

    premiumCommonPlugin = premiumCommonPlugin && Object.prototype.hasOwnProperty.call(premiumCommonPlugin, 'default') ? premiumCommonPlugin['default'] : premiumCommonPlugin;
    var timelinePlugin__default = 'default' in timelinePlugin ? timelinePlugin['default'] : timelinePlugin;
    var resourceCommonPlugin__default = 'default' in resourceCommonPlugin ? resourceCommonPlugin['default'] : resourceCommonPlugin;

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

    function __spreadArrays() {
        for (var s = 0, i = 0, il = arguments.length; i < il; i++) s += arguments[i].length;
        for (var r = Array(s), k = 0, i = 0; i < il; i++)
            for (var a = arguments[i], j = 0, jl = a.length; j < jl; j++, k++)
                r[k] = a[j];
        return r;
    }

    /*
    Renders the DOM responsible for the subrow expander area,
    as well as the space before it (used to align expanders of similar depths)
    */
    function ExpanderIcon(_a) {
        var depth = _a.depth, hasChildren = _a.hasChildren, isExpanded = _a.isExpanded, onExpanderClick = _a.onExpanderClick;
        var nodes = [];
        for (var i = 0; i < depth; i++) {
            nodes.push(common.createElement("span", { className: 'fc-icon' }));
        }
        var iconClassNames = ['fc-icon'];
        if (hasChildren) {
            if (isExpanded) {
                iconClassNames.push('fc-icon-minus-square');
            }
            else {
                iconClassNames.push('fc-icon-plus-square');
            }
        }
        nodes.push(common.createElement("span", { className: 'fc-datagrid-expander' + (hasChildren ? '' : ' fc-datagrid-expander-placeholder'), onClick: onExpanderClick },
            common.createElement("span", { className: iconClassNames.join(' ') })));
        return common.createElement.apply(void 0, __spreadArrays([common.Fragment, {}], nodes));
    }

    var SpreadsheetIndividualCell = /** @class */ (function (_super) {
        __extends(SpreadsheetIndividualCell, _super);
        function SpreadsheetIndividualCell() {
            var _this = _super !== null && _super.apply(this, arguments) || this;
            _this.refineHookProps = common.memoizeObjArg(refineHookProps);
            _this.normalizeClassNames = common.buildClassNameNormalizer();
            _this.onExpanderClick = function (ev) {
                var props = _this.props;
                if (props.hasChildren) {
                    _this.context.dispatch({
                        type: 'SET_RESOURCE_ENTITY_EXPANDED',
                        id: props.resource.id,
                        isExpanded: !props.isExpanded
                    });
                }
            };
            return _this;
        }
        SpreadsheetIndividualCell.prototype.render = function () {
            var _this = this;
            var _a = this, props = _a.props, context = _a.context;
            var colSpec = props.colSpec;
            var hookProps = this.refineHookProps({
                resource: props.resource,
                fieldValue: props.fieldValue,
                context: context
            });
            var customClassNames = this.normalizeClassNames(colSpec.cellClassNames, hookProps);
            return (common.createElement(common.MountHook, { hookProps: hookProps, didMount: colSpec.cellDidMount, willUnmount: colSpec.cellWillUnmount }, function (rootElRef) { return (common.createElement("td", { className: ['fc-datagrid-cell', 'fc-resource'].concat(customClassNames).join(' '), "data-resource-id": props.resource.id, ref: rootElRef },
                common.createElement("div", { className: 'fc-datagrid-cell-frame', style: { height: props.innerHeight } },
                    common.createElement("div", { className: 'fc-datagrid-cell-cushion fc-scrollgrid-sync-inner' },
                        colSpec.isMain &&
                            common.createElement(ExpanderIcon, { depth: props.depth, hasChildren: props.hasChildren, isExpanded: props.isExpanded, onExpanderClick: _this.onExpanderClick }),
                        common.createElement(SpreadsheetIndividualCellInner, { hookProps: hookProps, colSpec: colSpec }))))); }));
        };
        return SpreadsheetIndividualCell;
    }(common.BaseComponent));
    var SpreadsheetIndividualCellInner = /** @class */ (function (_super) {
        __extends(SpreadsheetIndividualCellInner, _super);
        function SpreadsheetIndividualCellInner() {
            return _super !== null && _super.apply(this, arguments) || this;
        }
        SpreadsheetIndividualCellInner.prototype.render = function () {
            var props = this.props;
            return (common.createElement(common.ContentHook, { hookProps: props.hookProps, content: props.colSpec.cellContent, defaultContent: renderResourceInner }, function (innerElRef, innerContent) { return (common.createElement("span", { className: 'fc-datagrid-cell-main', ref: innerElRef }, innerContent)); }));
        };
        return SpreadsheetIndividualCellInner;
    }(common.BaseComponent));
    function renderResourceInner(hookProps) {
        return hookProps.fieldValue || common.createElement(common.Fragment, null, "\u00A0");
    }
    function refineHookProps(raw) {
        return {
            resource: new resourceCommonPlugin.ResourceApi(raw.context, raw.resource),
            fieldValue: raw.fieldValue,
            view: raw.context.viewApi
        };
    }

    // for VERTICAL cell grouping, in spreadsheet area
    var SpreadsheetGroupCell = /** @class */ (function (_super) {
        __extends(SpreadsheetGroupCell, _super);
        function SpreadsheetGroupCell() {
            return _super !== null && _super.apply(this, arguments) || this;
        }
        SpreadsheetGroupCell.prototype.render = function () {
            var _a = this, props = _a.props, context = _a.context;
            var colSpec = props.colSpec;
            var hookProps = {
                groupValue: props.fieldValue,
                view: context.viewApi
            };
            // a grouped cell. no data that is specific to this specific resource
            // `colSpec` is for the group. a GroupSpec :(
            return (common.createElement(common.RenderHook, { hookProps: hookProps, classNames: colSpec.cellClassNames, content: colSpec.cellContent, defaultContent: renderGroupInner, didMount: colSpec.cellDidMount, willUnmount: colSpec.cellWillUnmount }, function (rootElRef, classNames, innerElRef, innerContent) { return (
            // TODO: make data-attr with group value?
            common.createElement("td", { className: ['fc-datagrid-cell', 'fc-resource-group'].concat(classNames).join(' '), rowSpan: props.rowSpan, ref: rootElRef },
                common.createElement("div", { className: 'fc-datagrid-cell-frame fc-datagrid-cell-frame-liquid' },
                    " ",
                    common.createElement("div", { className: 'fc-datagrid-cell-cushion fc-sticky', ref: innerElRef }, innerContent)))); }));
        };
        return SpreadsheetGroupCell;
    }(common.BaseComponent));
    function renderGroupInner(hookProps) {
        return hookProps.groupValue || common.createElement(common.Fragment, null, "\u00A0");
    }

    var SpreadsheetRow = /** @class */ (function (_super) {
        __extends(SpreadsheetRow, _super);
        function SpreadsheetRow() {
            return _super !== null && _super.apply(this, arguments) || this;
        }
        SpreadsheetRow.prototype.render = function () {
            var props = this.props;
            var resource = props.resource, rowSpans = props.rowSpans, depth = props.depth;
            var resourceFields = resourceCommonPlugin.buildResourceFields(resource); // slightly inefficient. already done up the call stack
            return (common.createElement("tr", null, props.colSpecs.map(function (colSpec, i) {
                var rowSpan = rowSpans[i];
                if (rowSpan === 0) { // not responsible for group-based rows. VRowGroup is
                    return;
                }
                else if (rowSpan == null) {
                    rowSpan = 1;
                }
                var fieldValue = colSpec.field ? resourceFields[colSpec.field] :
                    (resource.title || resourceCommonPlugin.getPublicId(resource.id));
                if (rowSpan > 1) {
                    return (common.createElement(SpreadsheetGroupCell, { key: i, colSpec: colSpec, fieldValue: fieldValue, rowSpan: rowSpan }));
                }
                else {
                    return (common.createElement(SpreadsheetIndividualCell, { key: i, colSpec: colSpec, resource: resource, fieldValue: fieldValue, depth: depth, hasChildren: props.hasChildren, isExpanded: props.isExpanded, innerHeight: props.innerHeight }));
                }
            })));
        };
        return SpreadsheetRow;
    }(common.BaseComponent));
    SpreadsheetRow.addPropsEquality({
        rowSpans: common.isArraysEqual
    });

    // for HORIZONTAL cell grouping, in spreadsheet area
    var SpreadsheetGroupRow = /** @class */ (function (_super) {
        __extends(SpreadsheetGroupRow, _super);
        function SpreadsheetGroupRow() {
            var _this = _super !== null && _super.apply(this, arguments) || this;
            _this.innerInnerRef = common.createRef();
            _this.onExpanderClick = function () {
                var props = _this.props;
                _this.context.dispatch({
                    type: 'SET_RESOURCE_ENTITY_EXPANDED',
                    id: props.id,
                    isExpanded: !props.isExpanded
                });
            };
            return _this;
        }
        SpreadsheetGroupRow.prototype.render = function () {
            var _this = this;
            var _a = this, props = _a.props, context = _a.context;
            var hookProps = { groupValue: props.group.value, view: context.viewApi };
            var spec = props.group.spec;
            return (common.createElement("tr", null,
                common.createElement(common.RenderHook, { hookProps: hookProps, classNames: spec.labelClassNames, content: spec.labelContent, defaultContent: renderCellInner, didMount: spec.labelDidMount, willUnmount: spec.labelWillUnmount }, function (rootElRef, classNames, innerElRef, innerContent) { return (common.createElement("td", { className: ['fc-datagrid-cell', 'fc-resource-group', context.theme.getClass('tableCellShaded')].concat(classNames).join(' '), colSpan: props.spreadsheetColCnt, ref: rootElRef },
                    common.createElement("div", { className: 'fc-datagrid-cell-frame', style: { height: props.innerHeight } },
                        common.createElement("div", { className: 'fc-datagrid-cell-cushion fc-scrollgrid-sync-inner', ref: _this.innerInnerRef },
                            common.createElement(ExpanderIcon, { depth: 0, hasChildren: true, isExpanded: props.isExpanded, onExpanderClick: _this.onExpanderClick }),
                            common.createElement("span", { className: 'fc-datagrid-cell-main', ref: innerElRef }, innerContent))))); })));
        };
        return SpreadsheetGroupRow;
    }(common.BaseComponent));
    SpreadsheetGroupRow.addPropsEquality({
        group: resourceCommonPlugin.isGroupsEqual
    });
    function renderCellInner(hookProps) {
        return hookProps.groupValue || common.createElement(common.Fragment, null, "\u00A0");
    }

    var SPREADSHEET_COL_MIN_WIDTH = 20;
    var SpreadsheetHeader = /** @class */ (function (_super) {
        __extends(SpreadsheetHeader, _super);
        function SpreadsheetHeader() {
            var _this = _super !== null && _super.apply(this, arguments) || this;
            _this.resizerElRefs = new common.RefMap(_this._handleColResizerEl.bind(_this));
            _this.colDraggings = {};
            return _this;
        }
        SpreadsheetHeader.prototype.render = function () {
            var _this = this;
            var _a = this.props, colSpecs = _a.colSpecs, superHeaderRendering = _a.superHeaderRendering, rowInnerHeights = _a.rowInnerHeights;
            var hookProps = { view: this.context.viewApi };
            var rowNodes = [];
            rowInnerHeights = rowInnerHeights.slice(); // copy, because we're gonna pop
            if (superHeaderRendering) {
                var rowInnerHeight_1 = rowInnerHeights.shift();
                rowNodes.push(common.createElement("tr", { key: 'row-super' },
                    common.createElement(common.RenderHook, { hookProps: hookProps, classNames: superHeaderRendering.headerClassNames, content: superHeaderRendering.headerContent, didMount: superHeaderRendering.headerDidMount, willUnmount: superHeaderRendering.headerWillUnmount }, function (rootElRef, classNames, innerElRef, innerContent) { return (common.createElement("th", { colSpan: colSpecs.length, className: ['fc-datagrid-cell', 'fc-datagrid-cell-super'].concat(classNames).join(' '), ref: rootElRef },
                        common.createElement("div", { className: 'fc-datagrid-cell-frame', style: { height: rowInnerHeight_1 } },
                            common.createElement("div", { className: 'fc-datagrid-cell-cushion fc-scrollgrid-sync-inner', ref: innerElRef }, innerContent)))); })));
            }
            var rowInnerHeight = rowInnerHeights.shift();
            rowNodes.push(common.createElement("tr", { key: 'row' }, colSpecs.map(function (colSpec, i) {
                var isLastCol = i === (colSpecs.length - 1);
                // need empty inner div for abs positioning for resizer
                return (common.createElement(common.RenderHook, { key: i, hookProps: hookProps, classNames: colSpec.headerClassNames, content: colSpec.headerContent, didMount: colSpec.headerDidMount, willUnmount: colSpec.headerWillUnmount }, function (rootElRef, classNames, innerElRef, innerContent) { return (common.createElement("th", { ref: rootElRef, className: ['fc-datagrid-cell'].concat(classNames).join(' ') },
                    common.createElement("div", { className: 'fc-datagrid-cell-frame', style: { height: rowInnerHeight } },
                        common.createElement("div", { className: 'fc-datagrid-cell-cushion fc-scrollgrid-sync-inner' },
                            colSpec.isMain &&
                                common.createElement("span", { className: 'fc-datagrid-expander fc-datagrid-expander-placeholder' },
                                    common.createElement("span", { className: 'fc-icon' })),
                            common.createElement("span", { className: 'fc-datagrid-cell-main', ref: innerElRef }, innerContent)),
                        !isLastCol &&
                            common.createElement("div", { className: 'fc-datagrid-cell-resizer', ref: _this.resizerElRefs.createRef(i) })))); }));
            })));
            return (common.createElement(common.Fragment, null, rowNodes));
        };
        SpreadsheetHeader.prototype._handleColResizerEl = function (resizerEl, index) {
            var colDraggings = this.colDraggings;
            if (!resizerEl) {
                var dragging = colDraggings[index];
                if (dragging) {
                    dragging.destroy();
                    delete colDraggings[index];
                }
            }
            else {
                var dragging = this.initColResizing(resizerEl, parseInt(index, 10));
                if (dragging) {
                    colDraggings[index] = dragging;
                }
            }
        };
        SpreadsheetHeader.prototype.initColResizing = function (resizerEl, index) {
            var _a = this.context, pluginHooks = _a.pluginHooks, isRtl = _a.isRtl;
            var onColWidthChange = this.props.onColWidthChange;
            var ElementDraggingImpl = pluginHooks.elementDraggingImpl;
            if (ElementDraggingImpl) {
                var dragging = new ElementDraggingImpl(resizerEl);
                var startWidth_1; // of just the single column
                var currentWidths_1; // of all columns
                dragging.emitter.on('dragstart', function () {
                    var allCells = common.findElements(common.elementClosest(resizerEl, 'tr'), 'th');
                    currentWidths_1 = allCells.map(function (resizerEl) { return (common.elementClosest(resizerEl, 'th').getBoundingClientRect().width); });
                    startWidth_1 = currentWidths_1[index];
                });
                dragging.emitter.on('dragmove', function (pev) {
                    currentWidths_1[index] = Math.max(startWidth_1 + pev.deltaX * (isRtl ? -1 : 1), SPREADSHEET_COL_MIN_WIDTH);
                    if (onColWidthChange) {
                        onColWidthChange(currentWidths_1.slice()); // send a copy since currentWidths continues to be mutated
                    }
                });
                dragging.setAutoScrollEnabled(false); // because gets weird with auto-scrolling time area
                return dragging;
            }
        };
        return SpreadsheetHeader;
    }(common.BaseComponent));

    var ResourceTimelineLane = /** @class */ (function (_super) {
        __extends(ResourceTimelineLane, _super);
        function ResourceTimelineLane() {
            var _this = _super !== null && _super.apply(this, arguments) || this;
            _this.refineHookProps = common.memoizeObjArg(refineHookProps$1);
            _this.normalizeClassNames = common.buildClassNameNormalizer();
            _this.handleHeightChange = function (innerEl, isStable) {
                if (_this.props.onHeightChange) {
                    _this.props.onHeightChange(common.elementClosest(innerEl, 'tr'), // would want to use own <tr> ref, but not guaranteed to be ready when this fires
                    isStable);
                }
            };
            return _this;
        }
        ResourceTimelineLane.prototype.render = function () {
            var _this = this;
            var _a = this, props = _a.props, context = _a.context;
            var options = context.options;
            var hookProps = this.refineHookProps({ resource: props.resource, context: context });
            var customClassNames = this.normalizeClassNames(options.resourceLaneClassNames, hookProps);
            return (common.createElement("tr", { ref: props.elRef },
                common.createElement(common.MountHook, { hookProps: hookProps, didMount: options.resourceLaneDidMount, willUnmount: options.resourceLaneWillUnmount }, function (rootElRef) { return (common.createElement("td", { ref: rootElRef, className: ['fc-timeline-lane', 'fc-resource'].concat(customClassNames).join(' '), "data-resource-id": props.resource.id },
                    common.createElement("div", { className: 'fc-timeline-lane-frame', style: { height: props.innerHeight } },
                        common.createElement(ResourceTimelineLaneMisc, { resource: props.resource }),
                        common.createElement(timelinePlugin.TimelineLane, { dateProfile: props.dateProfile, tDateProfile: props.tDateProfile, nowDate: props.nowDate, todayRange: props.todayRange, nextDayThreshold: props.nextDayThreshold, businessHours: props.businessHours, eventStore: props.eventStore, eventUiBases: props.eventUiBases, dateSelection: props.dateSelection, eventSelection: props.eventSelection, eventDrag: props.eventDrag, eventResize: props.eventResize, timelineCoords: props.timelineCoords, onHeightChange: _this.handleHeightChange })))); }))); // important NOT to do liquid-height. dont want to shrink height smaller than content
        };
        return ResourceTimelineLane;
    }(common.BaseComponent));
    var ResourceTimelineLaneMisc = /** @class */ (function (_super) {
        __extends(ResourceTimelineLaneMisc, _super);
        function ResourceTimelineLaneMisc() {
            return _super !== null && _super.apply(this, arguments) || this;
        }
        ResourceTimelineLaneMisc.prototype.render = function () {
            var _a = this, props = _a.props, context = _a.context;
            var hookProps = { resource: new resourceCommonPlugin.ResourceApi(context, props.resource) }; // just easier to make directly
            return (common.createElement(common.ContentHook, { hookProps: hookProps, content: context.options.resourceLaneContent }, function (innerElRef, innerContent) { return (innerContent && // TODO: test how this would interfere with height
                common.createElement("div", { className: 'fc-timeline-lane-misc', ref: innerElRef }, innerContent)); }));
        };
        return ResourceTimelineLaneMisc;
    }(common.BaseComponent));
    function refineHookProps$1(raw) {
        return {
            resource: new resourceCommonPlugin.ResourceApi(raw.context, raw.resource)
        };
    }

    /*
    parallels the SpreadsheetGroupRow
    */
    var DividerRow = /** @class */ (function (_super) {
        __extends(DividerRow, _super);
        function DividerRow() {
            return _super !== null && _super.apply(this, arguments) || this;
        }
        DividerRow.prototype.render = function () {
            var _this = this;
            var props = this.props;
            var renderingHooks = this.props.renderingHooks;
            var hookProps = { groupValue: props.groupValue, view: this.context.viewApi };
            return (common.createElement("tr", { ref: props.elRef },
                common.createElement(common.RenderHook, { hookProps: hookProps, classNames: renderingHooks.laneClassNames, content: renderingHooks.laneContent, didMount: renderingHooks.laneDidMount, willUnmount: renderingHooks.laneWillUnmount }, function (rootElRef, classNames, innerElRef, innerContent) { return (common.createElement("td", { className: ['fc-timeline-lane', 'fc-resource-group', _this.context.theme.getClass('tableCellShaded')].concat(classNames).join(' '), ref: rootElRef },
                    common.createElement("div", { style: { height: props.innerHeight }, ref: innerElRef }, innerContent))); })));
        };
        return DividerRow;
    }(common.BaseComponent));

    var ResourceTimelineLanes = /** @class */ (function (_super) {
        __extends(ResourceTimelineLanes, _super);
        function ResourceTimelineLanes() {
            var _this = _super !== null && _super.apply(this, arguments) || this;
            _this.rootElRef = common.createRef();
            _this.rowElRefs = new common.RefMap();
            return _this;
        }
        ResourceTimelineLanes.prototype.render = function () {
            var _a = this, props = _a.props, context = _a.context;
            return (common.createElement("table", { ref: this.rootElRef, className: 'fc-scrollgrid-sync-table ' + context.theme.getClass('table'), style: {
                    minWidth: props.tableMinWidth,
                    width: props.clientWidth,
                    height: props.minHeight
                } },
                common.createElement(ResourceTimelineLanesBody, { rowElRefs: this.rowElRefs, rowNodes: props.rowNodes, dateProfile: props.dateProfile, tDateProfile: props.tDateProfile, nowDate: props.nowDate, todayRange: props.todayRange, splitProps: props.splitProps, fallbackBusinessHours: props.fallbackBusinessHours, slatCoords: props.slatCoords, innerHeights: props.innerHeights, onRowHeightChange: props.onRowHeightChange })));
        };
        ResourceTimelineLanes.prototype.componentDidMount = function () {
            this.updateCoords();
        };
        ResourceTimelineLanes.prototype.componentDidUpdate = function () {
            this.updateCoords();
        };
        ResourceTimelineLanes.prototype.componentWillUnmount = function () {
            if (this.props.onRowCoords) {
                this.props.onRowCoords(null);
            }
        };
        ResourceTimelineLanes.prototype.updateCoords = function () {
            var props = this.props;
            if (props.onRowCoords && props.clientWidth !== null) { // a populated clientWidth means sizing has stabilized
                this.props.onRowCoords(new common.PositionCache(this.rootElRef.current, collectRowEls(this.rowElRefs.currentMap, props.rowNodes), false, true // isVertical
                ));
            }
        };
        return ResourceTimelineLanes;
    }(common.BaseComponent));
    function collectRowEls(elMap, rowNodes) {
        return rowNodes.map(function (rowNode) { return elMap[rowNode.id]; });
    }
    var ResourceTimelineLanesBody = /** @class */ (function (_super) {
        __extends(ResourceTimelineLanesBody, _super);
        function ResourceTimelineLanesBody() {
            return _super !== null && _super.apply(this, arguments) || this;
        }
        ResourceTimelineLanesBody.prototype.render = function () {
            var _a = this, props = _a.props, context = _a.context;
            var rowElRefs = props.rowElRefs, innerHeights = props.innerHeights;
            return (common.createElement("tbody", null, props.rowNodes.map(function (node, index) {
                if (node.group) {
                    return (common.createElement(DividerRow, { key: node.id, elRef: rowElRefs.createRef(node.id), groupValue: node.group.value, renderingHooks: node.group.spec, innerHeight: innerHeights[index] || '' }));
                }
                else if (node.resource) {
                    var resource = node.resource;
                    return (common.createElement(ResourceTimelineLane, __assign({ key: node.id, elRef: rowElRefs.createRef(node.id) }, props.splitProps[resource.id], { resource: resource, dateProfile: props.dateProfile, tDateProfile: props.tDateProfile, nowDate: props.nowDate, todayRange: props.todayRange, nextDayThreshold: context.options.nextDayThreshold, businessHours: resource.businessHours || props.fallbackBusinessHours, innerHeight: innerHeights[index] || '', timelineCoords: props.slatCoords, onHeightChange: props.onRowHeightChange })));
                }
            })));
        };
        return ResourceTimelineLanesBody;
    }(common.BaseComponent));

    var ResourceTimelineGrid = /** @class */ (function (_super) {
        __extends(ResourceTimelineGrid, _super);
        function ResourceTimelineGrid() {
            var _this = _super !== null && _super.apply(this, arguments) || this;
            _this.computeHasResourceBusinessHours = common.memoize(computeHasResourceBusinessHours);
            _this.resourceSplitter = new resourceCommonPlugin.ResourceSplitter(); // doesn't let it do businessHours tho
            _this.bgSlicer = new timelinePlugin.TimelineLaneSlicer();
            _this.slatsRef = common.createRef(); // needed for Hit creation :(
            _this.state = {
                slatCoords: null
            };
            _this.handleEl = function (el) {
                if (el) {
                    _this.context.registerInteractiveComponent(_this, { el: el });
                }
                else {
                    _this.context.unregisterInteractiveComponent(_this);
                }
            };
            _this.handleSlatCoords = function (slatCoords) {
                _this.setState({ slatCoords: slatCoords });
                if (_this.props.onSlatCoords) {
                    _this.props.onSlatCoords(slatCoords);
                }
            };
            _this.handleRowCoords = function (rowCoords) {
                _this.rowCoords = rowCoords;
                if (_this.props.onRowCoords) {
                    _this.props.onRowCoords(rowCoords);
                }
            };
            return _this;
        }
        ResourceTimelineGrid.prototype.render = function () {
            var _this = this;
            var _a = this, props = _a.props, state = _a.state, context = _a.context;
            var dateProfile = props.dateProfile, tDateProfile = props.tDateProfile;
            var timerUnit = common.greatestDurationDenominator(tDateProfile.slotDuration).unit;
            var hasResourceBusinessHours = this.computeHasResourceBusinessHours(props.rowNodes);
            var splitProps = this.resourceSplitter.splitProps(props);
            var bgLaneProps = splitProps[''];
            var bgSlicedProps = this.bgSlicer.sliceProps(bgLaneProps, dateProfile, tDateProfile.isTimeScale ? null : props.nextDayThreshold, context, // wish we didn't need to pass in the rest of these args...
            dateProfile, context.dateProfileGenerator, tDateProfile, context.dateEnv);
            // WORKAROUND: make ignore slatCoords when out of sync with dateProfile
            var slatCoords = state.slatCoords && state.slatCoords.dateProfile === props.dateProfile ? state.slatCoords : null;
            return (common.createElement("div", { ref: this.handleEl, className: 'fc-timeline-body', style: { minWidth: props.tableMinWidth } },
                common.createElement(common.NowTimer, { unit: timerUnit }, function (nowDate, todayRange) { return (common.createElement(common.Fragment, null,
                    common.createElement(timelinePlugin.TimelineSlats, { ref: _this.slatsRef, dateProfile: dateProfile, tDateProfile: tDateProfile, nowDate: nowDate, todayRange: todayRange, clientWidth: props.clientWidth, tableColGroupNode: props.tableColGroupNode, tableMinWidth: props.tableMinWidth, onCoords: _this.handleSlatCoords, onScrollLeftRequest: props.onScrollLeftRequest }),
                    common.createElement(timelinePlugin.TimelineLaneBg, { businessHourSegs: hasResourceBusinessHours ? null : bgSlicedProps.businessHourSegs, bgEventSegs: bgSlicedProps.bgEventSegs, timelineCoords: slatCoords, eventResizeSegs: (bgSlicedProps.eventResize ? bgSlicedProps.eventResize.segs : []) /* empty array will result in unnecessary rerenders? */, dateSelectionSegs: bgSlicedProps.dateSelectionSegs, nowDate: nowDate, todayRange: todayRange }),
                    common.createElement(ResourceTimelineLanes, { rowNodes: props.rowNodes, dateProfile: dateProfile, tDateProfile: props.tDateProfile, nowDate: nowDate, todayRange: todayRange, splitProps: splitProps, fallbackBusinessHours: hasResourceBusinessHours ? props.businessHours : null, clientWidth: props.clientWidth, minHeight: props.expandRows ? props.clientHeight : '', tableMinWidth: props.tableMinWidth, innerHeights: props.rowInnerHeights, slatCoords: slatCoords, onRowCoords: _this.handleRowCoords, onRowHeightChange: props.onRowHeightChange }),
                    (context.options.nowIndicator && slatCoords && slatCoords.isDateInRange(nowDate)) &&
                        common.createElement("div", { className: 'fc-timeline-now-indicator-container' },
                            common.createElement(common.NowIndicatorRoot, { isAxis: false, date: nowDate }, function (rootElRef, classNames, innerElRef, innerContent) {
                                return (common.createElement("div", { ref: rootElRef, className: ['fc-timeline-now-indicator-line'].concat(classNames).join(' '), style: { left: slatCoords.dateToCoord(nowDate) } }, innerContent));
                            })))); })));
        };
        // Hit System
        // ------------------------------------------------------------------------------------------
        ResourceTimelineGrid.prototype.queryHit = function (positionLeft, positionTop) {
            var rowCoords = this.rowCoords;
            var rowIndex = rowCoords.topToIndex(positionTop);
            if (rowIndex != null) {
                var resource = this.props.rowNodes[rowIndex].resource;
                if (resource) { // not a group
                    var slatHit = this.slatsRef.current.positionToHit(positionLeft);
                    if (slatHit) {
                        return {
                            component: this,
                            dateSpan: {
                                range: slatHit.dateSpan.range,
                                allDay: slatHit.dateSpan.allDay,
                                resourceId: resource.id
                            },
                            rect: {
                                left: slatHit.left,
                                right: slatHit.right,
                                top: rowCoords.tops[rowIndex],
                                bottom: rowCoords.bottoms[rowIndex]
                            },
                            dayEl: slatHit.dayEl,
                            layer: 0
                        };
                    }
                }
            }
        };
        return ResourceTimelineGrid;
    }(common.DateComponent));
    function computeHasResourceBusinessHours(rowNodes) {
        for (var _i = 0, rowNodes_1 = rowNodes; _i < rowNodes_1.length; _i++) {
            var node = rowNodes_1[_i];
            var resource = node.resource;
            if (resource && resource.businessHours) {
                return true;
            }
        }
        return false;
    }

    var MIN_RESOURCE_AREA_WIDTH = 30; // definitely bigger than scrollbars
    var ResourceTimelineViewLayout = /** @class */ (function (_super) {
        __extends(ResourceTimelineViewLayout, _super);
        function ResourceTimelineViewLayout() {
            var _this = _super !== null && _super.apply(this, arguments) || this;
            _this.scrollGridRef = common.createRef();
            _this.timeBodyScrollerElRef = common.createRef();
            _this.spreadsheetHeaderChunkElRef = common.createRef();
            _this.rootElRef = common.createRef();
            _this.state = {
                resourceAreaWidthOverride: null
            };
            return _this;
        }
        ResourceTimelineViewLayout.prototype.render = function () {
            var _a = this, props = _a.props, state = _a.state, context = _a.context;
            var options = context.options;
            var stickyHeaderDates = !props.forPrint && common.getStickyHeaderDates(options);
            var stickyFooterScrollbar = !props.forPrint && common.getStickyFooterScrollbar(options);
            var sections = [
                {
                    type: 'header',
                    key: 'header',
                    syncRowHeights: true,
                    isSticky: stickyHeaderDates,
                    chunks: [
                        {
                            key: 'datagrid',
                            elRef: this.spreadsheetHeaderChunkElRef,
                            tableClassName: 'fc-datagrid-header',
                            rowContent: props.spreadsheetHeaderRows
                        },
                        {
                            key: 'divider',
                            outerContent: (common.createElement("td", { className: 'fc-resource-timeline-divider ' + context.theme.getClass('tableCellShaded') }))
                        },
                        {
                            key: 'timeline',
                            content: props.timeHeaderContent
                        }
                    ]
                },
                {
                    type: 'body',
                    key: 'body',
                    syncRowHeights: true,
                    liquid: true,
                    expandRows: Boolean(options.expandRows),
                    chunks: [
                        {
                            key: 'datagrid',
                            tableClassName: 'fc-datagrid-body',
                            rowContent: props.spreadsheetBodyRows
                        },
                        {
                            key: 'divider',
                            outerContent: (common.createElement("td", { className: 'fc-resource-timeline-divider ' + context.theme.getClass('tableCellShaded') }))
                        },
                        {
                            key: 'timeline',
                            scrollerElRef: this.timeBodyScrollerElRef,
                            content: props.timeBodyContent
                        }
                    ]
                }
            ];
            if (stickyFooterScrollbar) {
                sections.push({
                    type: 'footer',
                    key: 'footer',
                    isSticky: true,
                    chunks: [
                        {
                            key: 'datagrid',
                            content: common.renderScrollShim
                        },
                        {
                            key: 'divider',
                            outerContent: (common.createElement("td", { className: 'fc-resource-timeline-divider ' + context.theme.getClass('tableCellShaded') }))
                        },
                        {
                            key: 'timeline',
                            content: common.renderScrollShim
                        }
                    ]
                });
            }
            var resourceAreaWidth = state.resourceAreaWidthOverride != null
                ? state.resourceAreaWidthOverride
                : options.resourceAreaWidth;
            return (common.createElement(scrollgrid.ScrollGrid, { ref: this.scrollGridRef, elRef: this.rootElRef, liquid: !props.isHeightAuto && !props.forPrint, colGroups: [
                    { cols: props.spreadsheetCols, width: resourceAreaWidth },
                    { cols: [] },
                    { cols: props.timeCols }
                ], sections: sections }));
        };
        ResourceTimelineViewLayout.prototype.forceTimeScroll = function (left) {
            var scrollGrid = this.scrollGridRef.current;
            scrollGrid.forceScrollLeft(2, left); // 2 = the time area
        };
        ResourceTimelineViewLayout.prototype.forceResourceScroll = function (top) {
            var scrollGrid = this.scrollGridRef.current;
            scrollGrid.forceScrollTop(1, top); // 1 = the body
        };
        ResourceTimelineViewLayout.prototype.getResourceScroll = function () {
            var timeBodyScrollerEl = this.timeBodyScrollerElRef.current;
            return timeBodyScrollerEl.scrollTop;
        };
        // Resource Area Resizing
        // ------------------------------------------------------------------------------------------
        // NOTE: a callback Ref for the resizer was firing multiple times with same elements (Preact)
        // that's why we use spreadsheetResizerElRef instead
        ResourceTimelineViewLayout.prototype.componentDidMount = function () {
            this.initSpreadsheetResizing();
        };
        ResourceTimelineViewLayout.prototype.componentWillUnmount = function () {
            this.destroySpreadsheetResizing();
        };
        ResourceTimelineViewLayout.prototype.initSpreadsheetResizing = function () {
            var _this = this;
            var _a = this.context, isRtl = _a.isRtl, pluginHooks = _a.pluginHooks;
            var ElementDraggingImpl = pluginHooks.elementDraggingImpl;
            var spreadsheetHeadEl = this.spreadsheetHeaderChunkElRef.current;
            if (ElementDraggingImpl) {
                var rootEl_1 = this.rootElRef.current;
                var dragging = this.spreadsheetResizerDragging = new ElementDraggingImpl(rootEl_1, '.fc-resource-timeline-divider');
                var dragStartWidth_1;
                var viewWidth_1;
                dragging.emitter.on('dragstart', function () {
                    dragStartWidth_1 = spreadsheetHeadEl.getBoundingClientRect().width;
                    viewWidth_1 = rootEl_1.getBoundingClientRect().width;
                });
                dragging.emitter.on('dragmove', function (pev) {
                    var newWidth = dragStartWidth_1 + pev.deltaX * (isRtl ? -1 : 1);
                    newWidth = Math.max(newWidth, MIN_RESOURCE_AREA_WIDTH);
                    newWidth = Math.min(newWidth, viewWidth_1 - MIN_RESOURCE_AREA_WIDTH);
                    _this.setState({
                        resourceAreaWidthOverride: newWidth
                    });
                });
                dragging.setAutoScrollEnabled(false); // because gets weird with auto-scrolling time area
            }
        };
        ResourceTimelineViewLayout.prototype.destroySpreadsheetResizing = function () {
            if (this.spreadsheetResizerDragging) {
                this.spreadsheetResizerDragging.destroy();
            }
        };
        return ResourceTimelineViewLayout;
    }(common.BaseComponent));

    var ResourceTimelineView = /** @class */ (function (_super) {
        __extends(ResourceTimelineView, _super);
        function ResourceTimelineView(props, context) {
            var _this = _super.call(this, props, context) || this;
            _this.processColOptions = common.memoize(processColOptions);
            _this.buildTimelineDateProfile = common.memoize(timelinePlugin.buildTimelineDateProfile);
            _this.hasNesting = common.memoize(hasNesting);
            _this.buildRowNodes = common.memoize(resourceCommonPlugin.buildRowNodes);
            _this.layoutRef = common.createRef();
            _this.rowNodes = [];
            _this.renderedRowNodes = [];
            _this.buildRowIndex = common.memoize(buildRowIndex);
            _this.handleSlatCoords = function (slatCoords) {
                _this.setState({ slatCoords: slatCoords });
            };
            _this.handleRowCoords = function (rowCoords) {
                _this.rowCoords = rowCoords;
                _this.scrollResponder.update(false); // TODO: could eliminate this if rowCoords lived in state
            };
            _this.handleMaxCushionWidth = function (slotCushionMaxWidth) {
                _this.setState({
                    slotCushionMaxWidth: Math.ceil(slotCushionMaxWidth) // for less rerendering TODO: DRY
                });
            };
            // Scrolling
            // ------------------------------------------------------------------------------------------------------------------
            // this is useful for scrolling prev/next dates while resource is scrolled down
            _this.handleScrollLeftRequest = function (scrollLeft) {
                var layout = _this.layoutRef.current;
                layout.forceTimeScroll(scrollLeft);
            };
            _this.handleScrollRequest = function (request) {
                var rowCoords = _this.rowCoords;
                var layout = _this.layoutRef.current;
                var rowId = request.rowId || request.resourceId;
                if (rowCoords) {
                    if (rowId) {
                        var rowIdToIndex = _this.buildRowIndex(_this.renderedRowNodes);
                        var index = rowIdToIndex[rowId];
                        if (index != null) {
                            var scrollTop = (request.fromBottom != null ?
                                rowCoords.bottoms[index] - request.fromBottom : // pixels from bottom edge
                                rowCoords.tops[index] // just use top edge
                            );
                            layout.forceResourceScroll(scrollTop);
                        }
                    }
                    return true;
                }
            };
            // Resource INDIVIDUAL-Column Area Resizing
            // ------------------------------------------------------------------------------------------
            _this.handleColWidthChange = function (colWidths) {
                _this.setState({
                    spreadsheetColWidths: colWidths
                });
            };
            _this.state = {
                resourceAreaWidth: context.options.resourceAreaWidth,
                spreadsheetColWidths: []
            };
            return _this;
        }
        ResourceTimelineView.prototype.render = function () {
            var _this = this;
            var _a = this, props = _a.props, state = _a.state, context = _a.context;
            var options = context.options, viewSpec = context.viewSpec;
            var _b = this.processColOptions(context.options), superHeaderRendering = _b.superHeaderRendering, groupSpecs = _b.groupSpecs, orderSpecs = _b.orderSpecs, isVGrouping = _b.isVGrouping, colSpecs = _b.colSpecs;
            var tDateProfile = this.buildTimelineDateProfile(props.dateProfile, context.dateEnv, options, context.dateProfileGenerator);
            var rowNodes = this.rowNodes = this.buildRowNodes(props.resourceStore, groupSpecs, orderSpecs, isVGrouping, props.resourceEntityExpansions, options.resourcesInitiallyExpanded);
            var extraClassNames = [
                'fc-resource-timeline',
                this.hasNesting(rowNodes) ? '' : 'fc-resource-timeline-flat',
                'fc-timeline',
                options.eventOverlap === false ? 'fc-timeline-overlap-disabled' : 'fc-timeline-overlap-enabled'
            ];
            var slotMinWidth = options.slotMinWidth;
            var slatCols = timelinePlugin.buildSlatCols(tDateProfile, slotMinWidth || this.computeFallbackSlotMinWidth(tDateProfile));
            return (common.createElement(common.ViewRoot, { viewSpec: viewSpec }, function (rootElRef, classNames) { return (common.createElement("div", { ref: rootElRef, className: extraClassNames.concat(classNames).join(' ') },
                common.createElement(ResourceTimelineViewLayout, { ref: _this.layoutRef, forPrint: props.forPrint, isHeightAuto: props.isHeightAuto, spreadsheetCols: buildSpreadsheetCols(colSpecs, state.spreadsheetColWidths, ''), spreadsheetHeaderRows: function (contentArg) { return (common.createElement(SpreadsheetHeader // TODO: rename to SpreadsheetHeaderRows
                    , { superHeaderRendering: superHeaderRendering, colSpecs: colSpecs, onColWidthChange: _this.handleColWidthChange, rowInnerHeights: contentArg.rowSyncHeights })); }, spreadsheetBodyRows: function (contentArg) { return (common.createElement(common.Fragment, null, _this.renderSpreadsheetRows(rowNodes, colSpecs, contentArg.rowSyncHeights))); }, timeCols: slatCols, timeHeaderContent: function (contentArg) { return (common.createElement(timelinePlugin.TimelineHeader, { clientWidth: contentArg.clientWidth, clientHeight: contentArg.clientHeight, tableMinWidth: contentArg.tableMinWidth, tableColGroupNode: contentArg.tableColGroupNode, dateProfile: props.dateProfile, tDateProfile: tDateProfile, slatCoords: state.slatCoords, rowInnerHeights: contentArg.rowSyncHeights, onMaxCushionWidth: slotMinWidth ? null : _this.handleMaxCushionWidth })); }, timeBodyContent: function (contentArg) { return (common.createElement(ResourceTimelineGrid, { dateProfile: props.dateProfile, clientWidth: contentArg.clientWidth, clientHeight: contentArg.clientHeight, tableMinWidth: contentArg.tableMinWidth, tableColGroupNode: contentArg.tableColGroupNode, expandRows: contentArg.expandRows, tDateProfile: tDateProfile, rowNodes: rowNodes, businessHours: props.businessHours, dateSelection: props.dateSelection, eventStore: props.eventStore, eventUiBases: props.eventUiBases, eventSelection: props.eventSelection, eventDrag: props.eventDrag, eventResize: props.eventResize, resourceStore: props.resourceStore, nextDayThreshold: context.options.nextDayThreshold, rowInnerHeights: contentArg.rowSyncHeights, onSlatCoords: _this.handleSlatCoords, onRowCoords: _this.handleRowCoords, onScrollLeftRequest: _this.handleScrollLeftRequest, onRowHeightChange: contentArg.reportRowHeightChange })); } }))); }));
        };
        ResourceTimelineView.prototype.renderSpreadsheetRows = function (nodes, colSpecs, rowSyncHeights) {
            return nodes.map(function (node, index) {
                if (node.group) {
                    return (common.createElement(SpreadsheetGroupRow, { key: node.id, id: node.id, spreadsheetColCnt: colSpecs.length, isExpanded: node.isExpanded, group: node.group, innerHeight: rowSyncHeights[index] || '' }));
                }
                else if (node.resource) {
                    return (common.createElement(SpreadsheetRow, { key: node.id, colSpecs: colSpecs, rowSpans: node.rowSpans, depth: node.depth, isExpanded: node.isExpanded, hasChildren: node.hasChildren, resource: node.resource, innerHeight: rowSyncHeights[index] || '' }));
                }
            });
        };
        ResourceTimelineView.prototype.componentDidMount = function () {
            this.renderedRowNodes = this.rowNodes;
            this.scrollResponder = this.context.createScrollResponder(this.handleScrollRequest);
        };
        ResourceTimelineView.prototype.getSnapshotBeforeUpdate = function () {
            if (!this.props.forPrint) { // because print-view is always zero?
                return { resourceScroll: this.queryResourceScroll() };
            }
            else {
                return {};
            }
        };
        ResourceTimelineView.prototype.componentDidUpdate = function (prevProps, prevState, snapshot) {
            this.renderedRowNodes = this.rowNodes;
            this.scrollResponder.update(prevProps.dateProfile !== this.props.dateProfile);
            if (snapshot.resourceScroll) {
                this.handleScrollRequest(snapshot.resourceScroll); // TODO: this gets triggered too often
            }
        };
        ResourceTimelineView.prototype.componentWillUnmount = function () {
            this.scrollResponder.detach();
        };
        ResourceTimelineView.prototype.computeFallbackSlotMinWidth = function (tDateProfile) {
            return Math.max(30, ((this.state.slotCushionMaxWidth || 0) / tDateProfile.slotsPerLabel));
        };
        ResourceTimelineView.prototype.queryResourceScroll = function () {
            var _a = this, rowCoords = _a.rowCoords, renderedRowNodes = _a.renderedRowNodes;
            if (rowCoords) {
                var layout = this.layoutRef.current;
                var trBottoms = rowCoords.bottoms;
                var scrollTop = layout.getResourceScroll();
                var scroll_1 = {};
                for (var i = 0; i < trBottoms.length; i++) {
                    var rowNode = renderedRowNodes[i];
                    var elBottom = trBottoms[i] - scrollTop; // from the top of the scroller
                    if (elBottom > 0) {
                        scroll_1.rowId = rowNode.id;
                        scroll_1.fromBottom = elBottom;
                        break;
                    }
                }
                return scroll_1;
            }
        };
        return ResourceTimelineView;
    }(common.BaseComponent));
    ResourceTimelineView.addStateEquality({
        spreadsheetColWidths: common.isArraysEqual
    });
    function buildRowIndex(rowNodes) {
        var rowIdToIndex = {};
        for (var i = 0; i < rowNodes.length; i++) {
            rowIdToIndex[rowNodes[i].id] = i;
        }
        return rowIdToIndex;
    }
    function buildSpreadsheetCols(colSpecs, forcedWidths, fallbackWidth) {
        if (fallbackWidth === void 0) { fallbackWidth = ''; }
        return colSpecs.map(function (colSpec, i) {
            return {
                className: colSpec.isMain ? 'fc-main-col' : '',
                width: forcedWidths[i] || colSpec.width || fallbackWidth
            };
        });
    }
    function hasNesting(nodes) {
        for (var _i = 0, nodes_1 = nodes; _i < nodes_1.length; _i++) {
            var node = nodes_1[_i];
            if (node.group) {
                return true;
            }
            else if (node.resource) {
                if (node.hasChildren) {
                    return true;
                }
            }
        }
        return false;
    }
    function processColOptions(options) {
        var allColSpecs = options.resourceAreaColumns || [];
        var superHeaderRendering = null;
        if (!allColSpecs.length) {
            allColSpecs.push({
                headerClassNames: options.resourceAreaHeaderClassNames,
                headerContent: options.resourceAreaHeaderContent || 'Resources',
                headerDidMount: options.resourceAreaHeaderDidMount,
                headerWillUnmount: options.resourceAreaHeaderWillUnmount
            });
        }
        else if (options.resourceAreaHeaderContent) { // weird way to determine if content
            superHeaderRendering = {
                headerClassNames: options.resourceAreaHeaderClassNames,
                headerContent: options.resourceAreaHeaderContent,
                headerDidMount: options.resourceAreaHeaderDidMount,
                headerWillUnmount: options.resourceAreaHeaderWillUnmount
            };
        }
        var plainColSpecs = [];
        var groupColSpecs = []; // part of the colSpecs, but filtered out in order to put first
        var groupSpecs = [];
        var isVGrouping = false;
        for (var _i = 0, allColSpecs_1 = allColSpecs; _i < allColSpecs_1.length; _i++) {
            var colSpec = allColSpecs_1[_i];
            if (colSpec.group) {
                groupColSpecs.push(__assign(__assign({}, colSpec), { cellClassNames: colSpec.cellClassNames || options.resourceGroupLabelClassNames, cellContent: colSpec.cellContent || options.resourceGroupLabelContent, cellDidMount: colSpec.cellDidMount || options.resourceGroupLabelDidMount, cellWillUnmount: colSpec.cellWillUnmount || options.resourceGroupLaneWillUnmount }));
            }
            else {
                plainColSpecs.push(colSpec);
            }
        }
        // BAD: mutates a user-supplied option
        var mainColSpec = plainColSpecs[0];
        mainColSpec.isMain = true;
        mainColSpec.cellClassNames = mainColSpec.cellClassNames || options.resourceLabelClassNames;
        mainColSpec.cellContent = mainColSpec.cellContent || options.resourceLabelContent;
        mainColSpec.cellDidMount = mainColSpec.cellDidMount || options.resourceLabelDidMount;
        mainColSpec.cellWillUnmount = mainColSpec.cellWillUnmount || options.resourceLabelWillUnmount;
        if (groupColSpecs.length) {
            groupSpecs = groupColSpecs;
            isVGrouping = true;
        }
        else {
            var hGroupField = options.resourceGroupField;
            if (hGroupField) {
                groupSpecs.push({
                    field: hGroupField,
                    labelClassNames: options.resourceGroupLabelClassNames,
                    labelContent: options.resourceGroupLabelContent,
                    labelDidMount: options.resourceGroupLabelDidMount,
                    labelWillUnmount: options.resourceGroupLabelWillUnmount,
                    laneClassNames: options.resourceGroupLaneClassNames,
                    laneContent: options.resourceGroupLaneContent,
                    laneDidMount: options.resourceGroupLaneDidMount,
                    laneWillUnmount: options.resourceGroupLaneWillUnmount
                });
            }
        }
        var allOrderSpecs = options.resourceOrder || resourceCommonPlugin.DEFAULT_RESOURCE_ORDER;
        var plainOrderSpecs = [];
        for (var _a = 0, allOrderSpecs_1 = allOrderSpecs; _a < allOrderSpecs_1.length; _a++) {
            var orderSpec = allOrderSpecs_1[_a];
            var isGroup = false;
            for (var _b = 0, groupSpecs_1 = groupSpecs; _b < groupSpecs_1.length; _b++) {
                var groupSpec = groupSpecs_1[_b];
                if (groupSpec.field === orderSpec.field) {
                    groupSpec.order = orderSpec.order; // -1, 0, 1
                    isGroup = true;
                    break;
                }
            }
            if (!isGroup) {
                plainOrderSpecs.push(orderSpec);
            }
        }
        return {
            superHeaderRendering: superHeaderRendering,
            isVGrouping: isVGrouping,
            groupSpecs: groupSpecs,
            colSpecs: groupColSpecs.concat(plainColSpecs),
            orderSpecs: plainOrderSpecs
        };
    }

    var plugin = common.createPlugin({
        deps: [
            premiumCommonPlugin,
            resourceCommonPlugin__default,
            timelinePlugin__default
        ],
        initialView: 'resourceTimelineDay',
        views: {
            resourceTimeline: {
                type: 'timeline',
                component: ResourceTimelineView,
                needsResourceData: true,
                resourceAreaWidth: '30%',
                resourcesInitiallyExpanded: true,
                eventResizableFromStart: true // TODO: not DRY with this same setting in the main timeline config
            },
            resourceTimelineDay: {
                type: 'resourceTimeline',
                duration: { days: 1 }
            },
            resourceTimelineWeek: {
                type: 'resourceTimeline',
                duration: { weeks: 1 }
            },
            resourceTimelineMonth: {
                type: 'resourceTimeline',
                duration: { months: 1 }
            },
            resourceTimelineYear: {
                type: 'resourceTimeline',
                duration: { years: 1 }
            }
        }
    });

    common.globalPlugins.push(plugin);

    exports.ResourceTimelineLane = ResourceTimelineLane;
    exports.ResourceTimelineView = ResourceTimelineView;
    exports.SpreadsheetRow = SpreadsheetRow;
    exports.default = plugin;

    return exports;

}({}, FullCalendar, FullCalendarPremiumCommon, FullCalendarTimeline, FullCalendarResourceCommon, FullCalendarScrollGrid));
