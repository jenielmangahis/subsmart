/*!
FullCalendar Scheduler v5.2.1
Docs & License: https://fullcalendar.io/scheduler
(c) 2020 Adam Shaw
*/
import { memoize, filterHash, rangesIntersect, isPropsEqual, mapHash, combineEventUis, refineProps, guid, identity, rangesEqual, parseBusinessHours, createEventUi, parseClassNames, EventApi, CalendarApi, Splitter, mergeEventStores, isPropsValid, parseFieldSpecs, unpromisify, requestJson, createElement, ViewContextType, formatDayString, RenderHook, NowTimer, Fragment, TableDateCell, TableDowCell, BaseComponent, computeFallbackHeaderFormat, flexibleCompare, compareByFieldSpecs, createPlugin } from '@fullcalendar/common';
import premiumCommonPlugin from '@fullcalendar/premium-common';
import { __assign, __extends, __spreadArrays } from 'tslib';

function massageEventDragMutation(eventMutation, hit0, hit1) {
    var resource0 = hit0.dateSpan.resourceId;
    var resource1 = hit1.dateSpan.resourceId;
    if (resource0 && resource1 &&
        resource0 !== resource1) {
        eventMutation.resourceMutation = {
            matchResourceId: resource0,
            setResourceId: resource1
        };
    }
}
/*
TODO: all this would be much easier if we were using a hash!
*/
function applyEventDefMutation(eventDef, mutation, context) {
    var resourceMutation = mutation.resourceMutation;
    if (resourceMutation && computeResourceEditable(eventDef, context)) {
        var index = eventDef.resourceIds.indexOf(resourceMutation.matchResourceId);
        if (index !== -1) {
            var resourceIds = eventDef.resourceIds.slice(); // copy
            resourceIds.splice(index, 1); // remove
            if (resourceIds.indexOf(resourceMutation.setResourceId) === -1) { // not already in there
                resourceIds.push(resourceMutation.setResourceId); // add
            }
            eventDef.resourceIds = resourceIds;
        }
    }
}
/*
HACK
TODO: use EventUi system instead of this
*/
function computeResourceEditable(eventDef, context) {
    var resourceEditable = eventDef.resourceEditable;
    if (resourceEditable == null) {
        var source = eventDef.sourceId && context.getCurrentData().eventSources[eventDef.sourceId];
        if (source) {
            resourceEditable = source.extendedProps.resourceEditable; // used the Source::extendedProps hack
        }
        if (resourceEditable == null) {
            resourceEditable = context.options.eventResourceEditable;
            if (resourceEditable == null) {
                resourceEditable = context.options.editable; // TODO: use defaults system instead
            }
        }
    }
    return resourceEditable;
}
function transformEventDrop(mutation, context) {
    var resourceMutation = mutation.resourceMutation;
    if (resourceMutation) {
        var calendarApi = context.calendarApi;
        return {
            oldResource: calendarApi.getResourceById(resourceMutation.matchResourceId),
            newResource: calendarApi.getResourceById(resourceMutation.setResourceId)
        };
    }
    else {
        return {
            oldResource: null,
            newResource: null
        };
    }
}

var ResourceDataAdder = /** @class */ (function () {
    function ResourceDataAdder() {
        this.filterResources = memoize(filterResources);
    }
    ResourceDataAdder.prototype.transform = function (viewProps, calendarProps) {
        if (calendarProps.viewSpec.optionDefaults.needsResourceData) {
            return {
                resourceStore: this.filterResources(calendarProps.resourceStore, calendarProps.options.filterResourcesWithEvents, calendarProps.eventStore, calendarProps.dateProfile.activeRange),
                resourceEntityExpansions: calendarProps.resourceEntityExpansions
            };
        }
    };
    return ResourceDataAdder;
}());
function filterResources(resourceStore, doFilterResourcesWithEvents, eventStore, activeRange) {
    if (doFilterResourcesWithEvents) {
        var instancesInRange = filterEventInstancesInRange(eventStore.instances, activeRange);
        var hasEvents_1 = computeHasEvents(instancesInRange, eventStore.defs);
        __assign(hasEvents_1, computeAncestorHasEvents(hasEvents_1, resourceStore));
        return filterHash(resourceStore, function (resource, resourceId) {
            return hasEvents_1[resourceId];
        });
    }
    else {
        return resourceStore;
    }
}
function filterEventInstancesInRange(eventInstances, activeRange) {
    return filterHash(eventInstances, function (eventInstance) {
        return rangesIntersect(eventInstance.range, activeRange);
    });
}
function computeHasEvents(eventInstances, eventDefs) {
    var hasEvents = {};
    for (var instanceId in eventInstances) {
        var instance = eventInstances[instanceId];
        for (var _i = 0, _a = eventDefs[instance.defId].resourceIds; _i < _a.length; _i++) {
            var resourceId = _a[_i];
            hasEvents[resourceId] = true;
        }
    }
    return hasEvents;
}
/*
mark resources as having events if any of their ancestors have them
NOTE: resourceStore might not have all the resources that hasEvents{} has keyed
*/
function computeAncestorHasEvents(hasEvents, resourceStore) {
    var res = {};
    for (var resourceId in hasEvents) {
        var resource = void 0;
        while ((resource = resourceStore[resourceId])) {
            resourceId = resource.parentId; // now functioning as the parentId
            if (resourceId) {
                res[resourceId] = true;
            }
            else {
                break;
            }
        }
    }
    return res;
}
// for when non-resource view should be given EventUi info (for event coloring/constraints based off of resource data)
var ResourceEventConfigAdder = /** @class */ (function () {
    function ResourceEventConfigAdder() {
        this.buildResourceEventUis = memoize(buildResourceEventUis, isPropsEqual);
        this.injectResourceEventUis = memoize(injectResourceEventUis);
    }
    ResourceEventConfigAdder.prototype.transform = function (viewProps, calendarProps) {
        if (!calendarProps.viewSpec.optionDefaults.needsResourceData) {
            return {
                eventUiBases: this.injectResourceEventUis(viewProps.eventUiBases, viewProps.eventStore.defs, this.buildResourceEventUis(calendarProps.resourceStore))
            };
        }
    };
    return ResourceEventConfigAdder;
}());
function buildResourceEventUis(resourceStore) {
    return mapHash(resourceStore, function (resource) {
        return resource.ui;
    });
}
function injectResourceEventUis(eventUiBases, eventDefs, resourceEventUis) {
    return mapHash(eventUiBases, function (eventUi, defId) {
        if (defId) { // not the '' key
            return injectResourceEventUi(eventUi, eventDefs[defId], resourceEventUis);
        }
        else {
            return eventUi;
        }
    });
}
function injectResourceEventUi(origEventUi, eventDef, resourceEventUis) {
    var parts = [];
    // first resource takes precedence, which fights with the ordering of combineEventUis, thus the unshifts
    for (var _i = 0, _a = eventDef.resourceIds; _i < _a.length; _i++) {
        var resourceId = _a[_i];
        if (resourceEventUis[resourceId]) {
            parts.unshift(resourceEventUis[resourceId]);
        }
    }
    parts.unshift(origEventUi);
    return combineEventUis(parts);
}
// for making sure events that have editable resources are always draggable in resource views
function transformIsDraggable(val, eventDef, eventUi, context) {
    if (!val) {
        var state = context.getCurrentData();
        var viewSpec = state.viewSpecs[state.currentViewType];
        if (viewSpec.optionDefaults.needsResourceData) {
            if (computeResourceEditable(eventDef, context)) {
                return true;
            }
        }
    }
    return val;
}

var defs = []; // TODO: use plugin system
function registerResourceSourceDef(def) {
    defs.push(def);
}
function getResourceSourceDef(id) {
    return defs[id];
}
function getResourceSourceDefs() {
    return defs;
}

// TODO: make this a plugin-able parser
// TODO: success/failure
var RESOURCE_SOURCE_REFINERS = {
    id: String,
    // for array. TODO: move to resource-array
    resources: identity,
    // for json feed. TODO: move to resource-json-feed
    url: String,
    method: String,
    startParam: String,
    endParam: String,
    timeZoneParam: String,
    extraParams: identity
};
function parseResourceSource(input) {
    var inputObj;
    if (typeof input === 'string') {
        inputObj = { url: input };
    }
    else if (typeof input === 'function' || Array.isArray(input)) {
        inputObj = { resources: input };
    }
    else if (typeof input === 'object' && input) { // non-null object
        inputObj = input;
    }
    if (inputObj) {
        var _a = refineProps(inputObj, RESOURCE_SOURCE_REFINERS), refined = _a.refined, extra = _a.extra;
        warnUnknownProps(extra);
        var metaRes = buildResourceSourceMeta(refined);
        if (metaRes) {
            return {
                _raw: input,
                sourceId: guid(),
                sourceDefId: metaRes.sourceDefId,
                meta: metaRes.meta,
                publicId: refined.id || '',
                isFetching: false,
                latestFetchId: '',
                fetchRange: null
            };
        }
    }
    return null;
}
function buildResourceSourceMeta(refined) {
    var defs = getResourceSourceDefs();
    for (var i = defs.length - 1; i >= 0; i--) { // later-added plugins take precedence
        var def = defs[i];
        var meta = def.parseMeta(refined);
        if (meta) {
            return { meta: meta, sourceDefId: i };
        }
    }
}
function warnUnknownProps(props) {
    for (var propName in props) {
        console.warn("Unknown resource prop '" + propName + "'");
    }
}

function reduceResourceSource(source, action, context) {
    var options = context.options, dateProfile = context.dateProfile;
    if (!source || !action) {
        return createSource(options.initialResources || options.resources, dateProfile.activeRange, options.refetchResourcesOnNavigate, context);
    }
    switch (action.type) {
        case 'RESET_RESOURCE_SOURCE':
            return createSource(action.resourceSourceInput, dateProfile.activeRange, options.refetchResourcesOnNavigate, context);
        case 'PREV': // TODO: how do we track all actions that affect dateProfile :(
        case 'NEXT':
        case 'CHANGE_DATE':
        case 'CHANGE_VIEW_TYPE':
            return handleRangeChange(source, dateProfile.activeRange, options.refetchResourcesOnNavigate, context);
        case 'RECEIVE_RESOURCES':
        case 'RECEIVE_RESOURCE_ERROR':
            return receiveResponse(source, action.fetchId, action.fetchRange);
        case 'REFETCH_RESOURCES':
            return fetchSource(source, dateProfile.activeRange, context);
        default:
            return source;
    }
}
function createSource(input, activeRange, refetchResourcesOnNavigate, context) {
    if (input) {
        var source = parseResourceSource(input);
        source = fetchSource(source, refetchResourcesOnNavigate ? activeRange : null, context);
        return source;
    }
    return null;
}
function handleRangeChange(source, activeRange, refetchResourcesOnNavigate, context) {
    if (refetchResourcesOnNavigate &&
        !doesSourceIgnoreRange(source) &&
        (!source.fetchRange || !rangesEqual(source.fetchRange, activeRange))) {
        return fetchSource(source, activeRange, context);
    }
    else {
        return source;
    }
}
function doesSourceIgnoreRange(source) {
    return Boolean(getResourceSourceDef(source.sourceDefId).ignoreRange);
}
function fetchSource(source, fetchRange, context) {
    var sourceDef = getResourceSourceDef(source.sourceDefId);
    var fetchId = guid();
    sourceDef.fetch({
        resourceSource: source,
        range: fetchRange,
        context: context
    }, function (res) {
        context.dispatch({
            type: 'RECEIVE_RESOURCES',
            fetchId: fetchId,
            fetchRange: fetchRange,
            rawResources: res.rawResources
        });
    }, function (error) {
        context.dispatch({
            type: 'RECEIVE_RESOURCE_ERROR',
            fetchId: fetchId,
            fetchRange: fetchRange,
            error: error
        });
    });
    return __assign(__assign({}, source), { isFetching: true, latestFetchId: fetchId });
}
function receiveResponse(source, fetchId, fetchRange) {
    if (fetchId === source.latestFetchId) {
        return __assign(__assign({}, source), { isFetching: false, fetchRange: fetchRange });
    }
    return source;
}

var PRIVATE_ID_PREFIX = '_fc:';
var RESOURCE_REFINERS = {
    id: String,
    parentId: String,
    children: identity,
    title: String,
    businessHours: identity,
    extendedProps: identity,
    // event-ui
    eventEditable: Boolean,
    eventStartEditable: Boolean,
    eventDurationEditable: Boolean,
    eventConstraint: identity,
    eventOverlap: Boolean,
    eventAllow: identity,
    eventClassNames: parseClassNames,
    eventBackgroundColor: String,
    eventBorderColor: String,
    eventTextColor: String,
    eventColor: String
};
/*
needs a full store so that it can populate children too
*/
function parseResource(raw, parentId, store, context) {
    if (parentId === void 0) { parentId = ''; }
    var _a = refineProps(raw, RESOURCE_REFINERS), refined = _a.refined, extra = _a.extra;
    var resource = {
        id: refined.id || (PRIVATE_ID_PREFIX + guid()),
        parentId: refined.parentId || parentId,
        title: refined.title || '',
        businessHours: refined.businessHours ? parseBusinessHours(refined.businessHours, context) : null,
        ui: createEventUi({
            editable: refined.eventEditable,
            startEditable: refined.eventStartEditable,
            durationEditable: refined.eventDurationEditable,
            constraint: refined.eventConstraint,
            overlap: refined.eventOverlap,
            allow: refined.eventAllow,
            classNames: refined.eventClassNames,
            backgroundColor: refined.eventBackgroundColor,
            borderColor: refined.eventBorderColor,
            textColor: refined.eventTextColor,
            color: refined.eventColor
        }, context),
        extendedProps: __assign(__assign({}, extra), refined.extendedProps)
    };
    // help out ResourceApi from having user modify props
    Object.freeze(resource.ui.classNames);
    Object.freeze(resource.extendedProps);
    if (store[resource.id]) ;
    else {
        store[resource.id] = resource;
        if (refined.children) {
            for (var _i = 0, _b = refined.children; _i < _b.length; _i++) {
                var childInput = _b[_i];
                parseResource(childInput, resource.id, store, context);
            }
        }
    }
    return resource;
}
/*
TODO: use this in more places
*/
function getPublicId(id) {
    if (id.indexOf(PRIVATE_ID_PREFIX) === 0) {
        return '';
    }
    return id;
}

function reduceResourceStore(store, action, source, context) {
    if (!store || !action) {
        return {};
    }
    switch (action.type) {
        case 'RECEIVE_RESOURCES':
            return receiveRawResources(store, action.rawResources, action.fetchId, source, context);
        case 'ADD_RESOURCE':
            return addResource(store, action.resourceHash);
        case 'REMOVE_RESOURCE':
            return removeResource(store, action.resourceId);
        case 'SET_RESOURCE_PROP':
            return setResourceProp(store, action.resourceId, action.propName, action.propValue);
        case 'SET_RESOURCE_EXTENDED_PROP':
            return setResourceExtendedProp(store, action.resourceId, action.propName, action.propValue);
        default:
            return store;
    }
}
function receiveRawResources(existingStore, inputs, fetchId, source, context) {
    if (source.latestFetchId === fetchId) {
        var nextStore = {};
        for (var _i = 0, inputs_1 = inputs; _i < inputs_1.length; _i++) {
            var input = inputs_1[_i];
            parseResource(input, '', nextStore, context);
        }
        return nextStore;
    }
    else {
        return existingStore;
    }
}
function addResource(existingStore, additions) {
    // TODO: warn about duplicate IDs
    return __assign(__assign({}, existingStore), additions);
}
function removeResource(existingStore, resourceId) {
    var newStore = __assign({}, existingStore);
    delete newStore[resourceId];
    // promote children
    for (var childResourceId in newStore) { // a child, *maybe* but probably not
        if (newStore[childResourceId].parentId === resourceId) {
            newStore[childResourceId] = __assign(__assign({}, newStore[childResourceId]), { parentId: '' });
        }
    }
    return newStore;
}
function setResourceProp(existingStore, resourceId, name, value) {
    var _a, _b;
    var existingResource = existingStore[resourceId];
    // TODO: sanitization
    if (existingResource) {
        return __assign(__assign({}, existingStore), (_a = {}, _a[resourceId] = __assign(__assign({}, existingResource), (_b = {}, _b[name] = value, _b)), _a));
    }
    else {
        return existingStore;
    }
}
function setResourceExtendedProp(existingStore, resourceId, name, value) {
    var _a, _b;
    var existingResource = existingStore[resourceId];
    if (existingResource) {
        return __assign(__assign({}, existingStore), (_a = {}, _a[resourceId] = __assign(__assign({}, existingResource), { extendedProps: __assign(__assign({}, existingResource.extendedProps), (_b = {}, _b[name] = value, _b)) }), _a));
    }
    else {
        return existingStore;
    }
}

function reduceResourceEntityExpansions(expansions, action) {
    var _a;
    if (!expansions || !action) {
        return {};
    }
    switch (action.type) {
        case 'SET_RESOURCE_ENTITY_EXPANDED':
            return __assign(__assign({}, expansions), (_a = {}, _a[action.id] = action.isExpanded, _a));
        default:
            return expansions;
    }
}

function reduceResources(state, action, context) {
    var resourceSource = reduceResourceSource(state && state.resourceSource, action, context);
    var resourceStore = reduceResourceStore(state && state.resourceStore, action, resourceSource, context);
    var resourceEntityExpansions = reduceResourceEntityExpansions(state && state.resourceEntityExpansions, action);
    return {
        resourceSource: resourceSource,
        resourceStore: resourceStore,
        resourceEntityExpansions: resourceEntityExpansions,
        loadingLevel: context.loadingLevel + ((resourceSource && resourceSource.isFetching) ? 1 : 0)
    };
}

var EVENT_REFINERS = {
    resourceId: String,
    resourceIds: identity,
    resourceEditable: Boolean
};
function generateEventDefResourceMembers(refined) {
    return {
        resourceIds: ensureStringArray(refined.resourceIds)
            .concat(refined.resourceId ? [refined.resourceId] : []),
        resourceEditable: refined.resourceEditable
    };
}
function ensureStringArray(items) {
    return (items || []).map(function (item) {
        return String(item);
    });
}

function transformDateSelectionJoin(hit0, hit1) {
    var resourceId0 = hit0.dateSpan.resourceId;
    var resourceId1 = hit1.dateSpan.resourceId;
    if (resourceId0 && resourceId1) {
        if (hit0.component.allowAcrossResources === false &&
            resourceId0 !== resourceId1) {
            return false;
        }
        else {
            return { resourceId: resourceId0 };
        }
    }
}

var ResourceApi = /** @class */ (function () {
    function ResourceApi(_context, _resource) {
        this._context = _context;
        this._resource = _resource;
    }
    ResourceApi.prototype.setProp = function (name, value) {
        var oldResource = this._resource;
        this._context.dispatch({
            type: 'SET_RESOURCE_PROP',
            resourceId: oldResource.id,
            propName: name,
            propValue: value
        });
        this.sync(oldResource);
    };
    ResourceApi.prototype.setExtendedProp = function (name, value) {
        var oldResource = this._resource;
        this._context.dispatch({
            type: 'SET_RESOURCE_EXTENDED_PROP',
            resourceId: oldResource.id,
            propName: name,
            propValue: value
        });
        this.sync(oldResource);
    };
    ResourceApi.prototype.sync = function (oldResource) {
        var context = this._context;
        var resourceId = oldResource.id;
        // TODO: what if dispatch didn't complete synchronously?
        this._resource = context.getCurrentData().resourceStore[resourceId];
        context.emitter.trigger('resourceChange', {
            oldResource: new ResourceApi(context, oldResource),
            resource: this,
            revert: function () {
                var _a;
                context.dispatch({
                    type: 'ADD_RESOURCE',
                    resourceHash: (_a = {},
                        _a[resourceId] = oldResource,
                        _a)
                });
            }
        });
    };
    ResourceApi.prototype.remove = function () {
        var context = this._context;
        var internalResource = this._resource;
        var resourceId = internalResource.id;
        context.dispatch({
            type: 'REMOVE_RESOURCE',
            resourceId: resourceId
        });
        context.emitter.trigger('resourceRemove', {
            resource: this,
            revert: function () {
                var _a;
                context.dispatch({
                    type: 'ADD_RESOURCE',
                    resourceHash: (_a = {},
                        _a[resourceId] = internalResource,
                        _a)
                });
            }
        });
    };
    ResourceApi.prototype.getParent = function () {
        var context = this._context;
        var parentId = this._resource.parentId;
        if (parentId) {
            return new ResourceApi(context, context.getCurrentData().resourceSource[parentId]);
        }
        else {
            return null;
        }
    };
    ResourceApi.prototype.getChildren = function () {
        var thisResourceId = this._resource.id;
        var context = this._context;
        var resourceStore = context.getCurrentData().resourceStore;
        var childApis = [];
        for (var resourceId in resourceStore) {
            if (resourceStore[resourceId].parentId === thisResourceId) {
                childApis.push(new ResourceApi(context, resourceStore[resourceId]));
            }
        }
        return childApis;
    };
    /*
    this is really inefficient!
    TODO: make EventApi::resourceIds a hash or keep an index in the Calendar's state
    */
    ResourceApi.prototype.getEvents = function () {
        var thisResourceId = this._resource.id;
        var context = this._context;
        var _a = context.getCurrentData().eventStore, defs = _a.defs, instances = _a.instances;
        var eventApis = [];
        for (var instanceId in instances) {
            var instance = instances[instanceId];
            var def = defs[instance.defId];
            if (def.resourceIds.indexOf(thisResourceId) !== -1) { // inefficient!!!
                eventApis.push(new EventApi(context, def, instance));
            }
        }
        return eventApis;
    };
    Object.defineProperty(ResourceApi.prototype, "id", {
        get: function () { return getPublicId(this._resource.id); },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(ResourceApi.prototype, "title", {
        get: function () { return this._resource.title; },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(ResourceApi.prototype, "eventConstraint", {
        get: function () { return this._resource.ui.constraints[0] || null; },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(ResourceApi.prototype, "eventOverlap", {
        get: function () { return this._resource.ui.overlap; },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(ResourceApi.prototype, "eventAllow", {
        get: function () { return this._resource.ui.allows[0] || null; },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(ResourceApi.prototype, "eventBackgroundColor", {
        get: function () { return this._resource.ui.backgroundColor; },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(ResourceApi.prototype, "eventBorderColor", {
        get: function () { return this._resource.ui.borderColor; },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(ResourceApi.prototype, "eventTextColor", {
        get: function () { return this._resource.ui.textColor; },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(ResourceApi.prototype, "eventClassNames", {
        // NOTE: user can't modify these because Object.freeze was called in event-def parsing
        get: function () { return this._resource.ui.classNames; },
        enumerable: false,
        configurable: true
    });
    Object.defineProperty(ResourceApi.prototype, "extendedProps", {
        get: function () { return this._resource.extendedProps; },
        enumerable: false,
        configurable: true
    });
    ResourceApi.prototype.toPlainObject = function (settings) {
        if (settings === void 0) { settings = {}; }
        var internal = this._resource;
        var ui = internal.ui;
        var publicId = this.id;
        var res = {};
        if (publicId) {
            res.id = publicId;
        }
        if (internal.title) {
            res.title = internal.title;
        }
        if (settings.collapseEventColor && ui.backgroundColor && ui.backgroundColor === ui.borderColor) {
            res.eventColor = ui.backgroundColor;
        }
        else {
            if (ui.backgroundColor) {
                res.eventBackgroundColor = ui.backgroundColor;
            }
            if (ui.borderColor) {
                res.eventBorderColor = ui.borderColor;
            }
        }
        if (ui.textColor) {
            res.eventTextColor = ui.textColor;
        }
        if (ui.classNames.length) {
            res.eventClassNames = ui.classNames;
        }
        if (Object.keys(internal.extendedProps).length) {
            if (settings.collapseExtendedProps) {
                __assign(res, internal.extendedProps);
            }
            else {
                res.extendedProps = internal.extendedProps;
            }
        }
        return res;
    };
    ResourceApi.prototype.toJSON = function () {
        return this.toPlainObject();
    };
    return ResourceApi;
}());
function buildResourceApis(resourceStore, context) {
    var resourceApis = [];
    for (var resourceId in resourceStore) {
        resourceApis.push(new ResourceApi(context, resourceStore[resourceId]));
    }
    return resourceApis;
}

CalendarApi.prototype.addResource = function (input, scrollTo) {
    var _a;
    var _this = this;
    if (scrollTo === void 0) { scrollTo = true; }
    var currentState = this.getCurrentData();
    var resourceHash;
    var resource;
    if (input instanceof ResourceApi) {
        resource = input._resource;
        resourceHash = (_a = {}, _a[resource.id] = resource, _a);
    }
    else {
        resourceHash = {};
        resource = parseResource(input, '', resourceHash, currentState);
    }
    this.dispatch({
        type: 'ADD_RESOURCE',
        resourceHash: resourceHash
    });
    if (scrollTo) {
        // TODO: wait til dispatch completes somehow
        this.trigger('_scrollRequest', { resourceId: resource.id });
    }
    var resourceApi = new ResourceApi(currentState, resource);
    currentState.emitter.trigger('resourceAdd', {
        resource: resourceApi,
        revert: function () {
            _this.dispatch({
                type: 'REMOVE_RESOURCE',
                resourceId: resource.id
            });
        }
    });
    return resourceApi;
};
CalendarApi.prototype.getResourceById = function (id) {
    id = String(id);
    var currentState = this.getCurrentData();
    if (currentState.resourceStore) { // guard against calendar with no resource functionality
        var rawResource = currentState.resourceStore[id];
        if (rawResource) {
            return new ResourceApi(currentState, rawResource);
        }
    }
    return null;
};
CalendarApi.prototype.getResources = function () {
    var currentState = this.getCurrentData();
    var resourceStore = currentState.resourceStore;
    var resourceApis = [];
    if (resourceStore) { // guard against calendar with no resource functionality
        for (var resourceId in resourceStore) {
            resourceApis.push(new ResourceApi(currentState, resourceStore[resourceId]));
        }
    }
    return resourceApis;
};
CalendarApi.prototype.getTopLevelResources = function () {
    var currentState = this.getCurrentData();
    var resourceStore = currentState.resourceStore;
    var resourceApis = [];
    if (resourceStore) { // guard against calendar with no resource functionality
        for (var resourceId in resourceStore) {
            if (!resourceStore[resourceId].parentId) {
                resourceApis.push(new ResourceApi(currentState, resourceStore[resourceId]));
            }
        }
    }
    return resourceApis;
};
CalendarApi.prototype.refetchResources = function () {
    this.dispatch({
        type: 'REFETCH_RESOURCES'
    });
};
function transformDatePoint(dateSpan, context) {
    return dateSpan.resourceId ?
        { resource: context.calendarApi.getResourceById(dateSpan.resourceId) } :
        {};
}
function transformDateSpan(dateSpan, context) {
    return dateSpan.resourceId ?
        { resource: context.calendarApi.getResourceById(dateSpan.resourceId) } :
        {};
}

/*
splits things BASED OFF OF which resources they are associated with.
creates a '' entry which is when something has NO resource.
*/
var ResourceSplitter = /** @class */ (function (_super) {
    __extends(ResourceSplitter, _super);
    function ResourceSplitter() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    ResourceSplitter.prototype.getKeyInfo = function (props) {
        return __assign({ '': {} }, props.resourceStore // already has `ui` and `businessHours` keys!
        );
    };
    ResourceSplitter.prototype.getKeysForDateSpan = function (dateSpan) {
        return [dateSpan.resourceId || ''];
    };
    ResourceSplitter.prototype.getKeysForEventDef = function (eventDef) {
        var resourceIds = eventDef.resourceIds;
        if (!resourceIds.length) {
            return [''];
        }
        return resourceIds;
    };
    return ResourceSplitter;
}(Splitter));

function isPropsValidWithResources(props, context) {
    var splitter = new ResourceSplitter();
    var sets = splitter.splitProps(__assign(__assign({}, props), { resourceStore: context.getCurrentData().resourceStore }));
    for (var resourceId in sets) {
        var props_1 = sets[resourceId];
        // merge in event data from the non-resource segment
        if (resourceId && sets['']) { // current segment is not the non-resource one, and there IS a non-resource one
            props_1 = __assign(__assign({}, props_1), { eventStore: mergeEventStores(sets[''].eventStore, props_1.eventStore), eventUiBases: __assign(__assign({}, sets[''].eventUiBases), props_1.eventUiBases) });
        }
        if (!isPropsValid(props_1, context, { resourceId: resourceId }, filterConfig.bind(null, resourceId))) {
            return false;
        }
    }
    return true;
}
function filterConfig(resourceId, config) {
    return __assign(__assign({}, config), { constraints: filterConstraints(resourceId, config.constraints) });
}
function filterConstraints(resourceId, constraints) {
    return constraints.map(function (constraint) {
        var defs = constraint.defs;
        if (defs) { // we are dealing with an EventStore
            // if any of the events define constraints to resources that are NOT this resource,
            // then this resource is unconditionally prohibited, which is what a `false` value does.
            for (var defId in defs) {
                var resourceIds = defs[defId].resourceIds;
                if (resourceIds.length && resourceIds.indexOf(resourceId) === -1) { // TODO: use a hash?!!! (for other reasons too)
                    return false;
                }
            }
        }
        return constraint;
    });
}

function transformExternalDef(dateSpan) {
    return dateSpan.resourceId ?
        { resourceId: dateSpan.resourceId } :
        {};
}

function transformEventResizeJoin(hit0, hit1) {
    var component = hit0.component;
    if (component.allowAcrossResources === false &&
        hit0.dateSpan.resourceId !== hit1.dateSpan.resourceId) {
        return false;
    }
}

EventApi.prototype.getResources = function () {
    var calendarApi = this._context.calendarApi;
    return this._def.resourceIds.map(function (resourceId) {
        return calendarApi.getResourceById(resourceId);
    });
};
EventApi.prototype.setResources = function (resources) {
    var resourceIds = [];
    // massage resources -> resourceIds
    for (var _i = 0, resources_1 = resources; _i < resources_1.length; _i++) {
        var resource = resources_1[_i];
        var resourceId = null;
        if (typeof resource === 'string') {
            resourceId = resource;
        }
        else if (typeof resource === 'number') {
            resourceId = String(resource);
        }
        else if (resource instanceof ResourceApi) {
            resourceId = resource.id; // guaranteed to always have an ID. hmmm
        }
        else {
            console.warn('unknown resource type: ' + resource);
        }
        if (resourceId) {
            resourceIds.push(resourceId);
        }
    }
    this.mutate({
        standardProps: {
            resourceIds: resourceIds
        }
    });
};

var optionChangeHandlers = {
    resources: handleResources
};
function handleResources(newSourceInput, context) {
    var oldSourceInput = context.getCurrentData().resourceSource._raw;
    if (oldSourceInput !== newSourceInput) {
        context.dispatch({
            type: 'RESET_RESOURCE_SOURCE',
            resourceSourceInput: newSourceInput
        });
    }
}

var DEFAULT_RESOURCE_ORDER = parseFieldSpecs('id,title');
function handleResourceStore(resourceStore, calendarData) {
    var emitter = calendarData.emitter;
    if (emitter.hasHandlers('resourcesSet')) {
        emitter.trigger('resourcesSet', buildResourceApis(resourceStore, calendarData));
    }
}

var OPTION_REFINERS = {
    initialResources: identity,
    resources: identity,
    eventResourceEditable: Boolean,
    refetchResourcesOnNavigate: Boolean,
    resourceOrder: parseFieldSpecs,
    filterResourcesWithEvents: Boolean,
    resourceGroupField: String,
    resourceAreaWidth: identity,
    resourceAreaColumns: identity,
    resourcesInitiallyExpanded: Boolean,
    datesAboveResources: Boolean,
    needsResourceData: Boolean,
    resourceAreaHeaderClassNames: identity,
    resourceAreaHeaderContent: identity,
    resourceAreaHeaderDidMount: identity,
    resourceAreaHeaderWillUnmount: identity,
    resourceGroupLabelClassNames: identity,
    resourceGroupLabelContent: identity,
    resourceGroupLabelDidMount: identity,
    resourceGroupLabelWillUnmount: identity,
    resourceLabelClassNames: identity,
    resourceLabelContent: identity,
    resourceLabelDidMount: identity,
    resourceLabelWillUnmount: identity,
    resourceLaneClassNames: identity,
    resourceLaneContent: identity,
    resourceLaneDidMount: identity,
    resourceLaneWillUnmount: identity,
    resourceGroupLaneClassNames: identity,
    resourceGroupLaneContent: identity,
    resourceGroupLaneDidMount: identity,
    resourceGroupLaneWillUnmount: identity
};
var LISTENER_REFINERS = {
    resourcesSet: identity,
    resourceAdd: identity,
    resourceChange: identity,
    resourceRemove: identity
};

registerResourceSourceDef({
    ignoreRange: true,
    parseMeta: function (refined) {
        if (Array.isArray(refined.resources)) {
            return refined.resources;
        }
        return null;
    },
    fetch: function (arg, successCallback) {
        successCallback({
            rawResources: arg.resourceSource.meta
        });
    }
});

registerResourceSourceDef({
    parseMeta: function (refined) {
        if (typeof refined.resources === 'function') {
            return refined.resources;
        }
        return null;
    },
    fetch: function (arg, success, failure) {
        var dateEnv = arg.context.dateEnv;
        var func = arg.resourceSource.meta;
        var publicArg = arg.range ? {
            start: dateEnv.toDate(arg.range.start),
            end: dateEnv.toDate(arg.range.end),
            startStr: dateEnv.formatIso(arg.range.start),
            endStr: dateEnv.formatIso(arg.range.end),
            timeZone: dateEnv.timeZone
        } : {};
        // TODO: make more dry with EventSourceFunc
        // TODO: accept a response?
        unpromisify(func.bind(null, publicArg), function (rawResources) {
            success({ rawResources: rawResources }); // needs an object response
        }, failure // send errorObj directly to failure callback
        );
    }
});

registerResourceSourceDef({
    parseMeta: function (refined) {
        if (refined.url) {
            return {
                url: refined.url,
                method: (refined.method || 'GET').toUpperCase(),
                extraParams: refined.extraParams
            };
        }
        return null;
    },
    fetch: function (arg, successCallback, failureCallback) {
        var meta = arg.resourceSource.meta;
        var requestParams = buildRequestParams(meta, arg.range, arg.context);
        requestJson(meta.method, meta.url, requestParams, function (rawResources, xhr) {
            successCallback({ rawResources: rawResources, xhr: xhr });
        }, function (message, xhr) {
            failureCallback({ message: message, xhr: xhr });
        });
    }
});
// TODO: somehow consolidate with event json feed
function buildRequestParams(meta, range, context) {
    var dateEnv = context.dateEnv, options = context.options;
    var startParam;
    var endParam;
    var timeZoneParam;
    var customRequestParams;
    var params = {};
    if (range) {
        startParam = meta.startParam;
        if (startParam == null) {
            startParam = options.startParam;
        }
        endParam = meta.endParam;
        if (endParam == null) {
            endParam = options.endParam;
        }
        timeZoneParam = meta.timeZoneParam;
        if (timeZoneParam == null) {
            timeZoneParam = options.timeZoneParam;
        }
        params[startParam] = dateEnv.formatIso(range.start);
        params[endParam] = dateEnv.formatIso(range.end);
        if (dateEnv.timeZone !== 'local') {
            params[timeZoneParam] = dateEnv.timeZone;
        }
    }
    // retrieve any outbound GET/POST data from the options
    if (typeof meta.extraParams === 'function') {
        // supplied as a function that returns a key/value object
        customRequestParams = meta.extraParams();
    }
    else {
        // probably supplied as a straight key/value object
        customRequestParams = meta.extraParams || {};
    }
    __assign(params, customRequestParams);
    return params;
}

// TODO: not used for Spreadsheet. START USING. difficult because of col-specific rendering props
function ResourceLabelRoot(props) {
    return (createElement(ViewContextType.Consumer, null, function (context) {
        var options = context.options;
        var hookProps = {
            resource: new ResourceApi(context, props.resource),
            date: props.date ? context.dateEnv.toDate(props.date) : null,
            view: context.viewApi
        };
        var dataAttrs = {
            'data-resource-id': props.resource.id,
            'data-date': props.date ? formatDayString(props.date) : undefined
        };
        return (createElement(RenderHook, { hookProps: hookProps, classNames: options.resourceLabelClassNames, content: options.resourceLabelContent, defaultContent: renderInnerContent, didMount: options.resourceLabelDidMount, willUnmount: options.resourceLabelWillUnmount }, function (rootElRef, classNames, innerElRef, innerContent) { return props.children(rootElRef, classNames, // TODO: pass in 'fc-resource' ?
        dataAttrs, innerElRef, innerContent); }));
    }));
}
function renderInnerContent(props) {
    return props.resource.title || props.resource.id;
}

var ResourceDayHeader = /** @class */ (function (_super) {
    __extends(ResourceDayHeader, _super);
    function ResourceDayHeader() {
        var _this = _super !== null && _super.apply(this, arguments) || this;
        _this.buildDateFormat = memoize(buildDateFormat);
        return _this;
    }
    ResourceDayHeader.prototype.render = function () {
        var _this = this;
        var _a = this, props = _a.props, context = _a.context;
        var dateFormat = this.buildDateFormat(context.options.dayHeaderFormat, props.datesRepDistinctDays, props.dates.length);
        return (createElement(NowTimer, { unit: 'day' }, function (nowDate, todayRange) {
            if (props.dates.length === 1) {
                return _this.renderResourceRow(props.resources, props.dates[0]);
            }
            else {
                if (context.options.datesAboveResources) {
                    return _this.renderDayAndResourceRows(props.dates, dateFormat, todayRange, props.resources);
                }
                else {
                    return _this.renderResourceAndDayRows(props.resources, props.dates, dateFormat, todayRange);
                }
            }
        }));
    };
    ResourceDayHeader.prototype.renderResourceRow = function (resources, date) {
        var resourceCells = resources.map(function (resource) {
            return (createElement(ResourceCell, { key: resource.id, resource: resource, colSpan: 1, date: date }));
        });
        return this.buildTr(resourceCells, 'resources');
    };
    ResourceDayHeader.prototype.renderDayAndResourceRows = function (dates, dateFormat, todayRange, resources) {
        var dateCells = [];
        var resourceCells = [];
        for (var _i = 0, dates_1 = dates; _i < dates_1.length; _i++) {
            var date = dates_1[_i];
            dateCells.push(this.renderDateCell(date, dateFormat, todayRange, resources.length, null, true));
            for (var _a = 0, resources_1 = resources; _a < resources_1.length; _a++) {
                var resource = resources_1[_a];
                resourceCells.push(createElement(ResourceCell, { key: resource.id + ':' + date.toISOString(), resource: resource, colSpan: 1, date: date }));
            }
        }
        return (createElement(Fragment, null,
            this.buildTr(dateCells, 'day'),
            this.buildTr(resourceCells, 'resources')));
    };
    ResourceDayHeader.prototype.renderResourceAndDayRows = function (resources, dates, dateFormat, todayRange) {
        var resourceCells = [];
        var dateCells = [];
        for (var _i = 0, resources_2 = resources; _i < resources_2.length; _i++) {
            var resource = resources_2[_i];
            resourceCells.push(createElement(ResourceCell, { key: resource.id, resource: resource, colSpan: dates.length, isSticky: true }));
            for (var _a = 0, dates_2 = dates; _a < dates_2.length; _a++) {
                var date = dates_2[_a];
                dateCells.push(this.renderDateCell(date, dateFormat, todayRange, 1, resource));
            }
        }
        return (createElement(Fragment, null,
            this.buildTr(resourceCells, 'day'),
            this.buildTr(dateCells, 'resources')));
    };
    // a cell with date text. might have a resource associated with it
    ResourceDayHeader.prototype.renderDateCell = function (date, dateFormat, todayRange, colSpan, resource, isSticky) {
        var props = this.props;
        var keyPostfix = resource ? ":" + resource.id : '';
        var extraHookProps = resource ? { resource: new ResourceApi(this.context, resource) } : {};
        var extraDataAttrs = resource ? { 'data-resource-id': resource.id } : {};
        return props.datesRepDistinctDays ?
            createElement(TableDateCell, { key: date.toISOString() + keyPostfix, date: date, dateProfile: props.dateProfile, todayRange: todayRange, colCnt: props.dates.length * props.resources.length, dayHeaderFormat: dateFormat, colSpan: colSpan, isSticky: isSticky, extraHookProps: extraHookProps, extraDataAttrs: extraDataAttrs }) :
            createElement(TableDowCell // we can't leverage the pure-componentness becausae the extra* props are new every time :(
            , { key: date.getUTCDay() + keyPostfix, dow: date.getUTCDay(), dayHeaderFormat: dateFormat, colSpan: colSpan, isSticky: isSticky, extraHookProps: extraHookProps, extraDataAttrs: extraDataAttrs });
    };
    ResourceDayHeader.prototype.buildTr = function (cells, key) {
        var renderIntro = this.props.renderIntro;
        if (!cells.length) {
            cells = [createElement("td", { key: 0 }, "\u00A0")];
        }
        return (createElement("tr", { key: key },
            renderIntro && renderIntro(),
            cells));
    };
    return ResourceDayHeader;
}(BaseComponent));
function buildDateFormat(dayHeaderFormat, datesRepDistinctDays, dayCnt) {
    return dayHeaderFormat || computeFallbackHeaderFormat(datesRepDistinctDays, dayCnt);
}
var ResourceCell = /** @class */ (function (_super) {
    __extends(ResourceCell, _super);
    function ResourceCell() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    ResourceCell.prototype.render = function () {
        var props = this.props;
        return (createElement(ResourceLabelRoot, { resource: props.resource, date: props.date }, function (elRef, customClassNames, dataAttrs, innerElRef, innerContent) { return (createElement("th", __assign({ ref: elRef, className: ['fc-col-header-cell', 'fc-resource'].concat(customClassNames).join(' '), colSpan: props.colSpan }, dataAttrs),
            createElement("div", { className: 'fc-scrollgrid-sync-inner' },
                createElement("span", { className: [
                        'fc-col-header-cell-cushion',
                        props.isSticky ? 'fc-sticky' : ''
                    ].join(' '), ref: innerElRef }, innerContent)))); }));
    };
    return ResourceCell;
}(BaseComponent));

var AbstractResourceDayTableModel = /** @class */ (function () {
    function AbstractResourceDayTableModel(dayTableModel, resources, context) {
        this.dayTableModel = dayTableModel;
        this.resources = resources;
        this.context = context;
        this.resourceIndex = new ResourceIndex(resources);
        this.rowCnt = dayTableModel.rowCnt;
        this.colCnt = dayTableModel.colCnt * resources.length;
        this.cells = this.buildCells();
    }
    AbstractResourceDayTableModel.prototype.buildCells = function () {
        var _a = this, rowCnt = _a.rowCnt, dayTableModel = _a.dayTableModel, resources = _a.resources;
        var rows = [];
        for (var row = 0; row < rowCnt; row++) {
            var rowCells = [];
            for (var dateCol = 0; dateCol < dayTableModel.colCnt; dateCol++) {
                for (var resourceCol = 0; resourceCol < resources.length; resourceCol++) {
                    var resource = resources[resourceCol];
                    var extraHookProps = { resource: new ResourceApi(this.context, resource) };
                    var extraDataAttrs = { 'data-resource-id': resource.id };
                    var extraClassNames = ['fc-resource'];
                    var date = dayTableModel.cells[row][dateCol].date;
                    rowCells[this.computeCol(dateCol, resourceCol)] = {
                        key: resource.id + ':' + date.toISOString(),
                        date: date,
                        resource: resource,
                        extraHookProps: extraHookProps,
                        extraDataAttrs: extraDataAttrs,
                        extraClassNames: extraClassNames
                    };
                }
            }
            rows.push(rowCells);
        }
        return rows;
    };
    return AbstractResourceDayTableModel;
}());
/*
resources over dates
*/
var ResourceDayTableModel = /** @class */ (function (_super) {
    __extends(ResourceDayTableModel, _super);
    function ResourceDayTableModel() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    ResourceDayTableModel.prototype.computeCol = function (dateI, resourceI) {
        return resourceI * this.dayTableModel.colCnt + dateI;
    };
    /*
    all date ranges are intact
    */
    ResourceDayTableModel.prototype.computeColRanges = function (dateStartI, dateEndI, resourceI) {
        return [
            {
                firstCol: this.computeCol(dateStartI, resourceI),
                lastCol: this.computeCol(dateEndI, resourceI),
                isStart: true,
                isEnd: true
            }
        ];
    };
    return ResourceDayTableModel;
}(AbstractResourceDayTableModel));
/*
dates over resources
*/
var DayResourceTableModel = /** @class */ (function (_super) {
    __extends(DayResourceTableModel, _super);
    function DayResourceTableModel() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    DayResourceTableModel.prototype.computeCol = function (dateI, resourceI) {
        return dateI * this.resources.length + resourceI;
    };
    /*
    every single day is broken up
    */
    DayResourceTableModel.prototype.computeColRanges = function (dateStartI, dateEndI, resourceI) {
        var segs = [];
        for (var i = dateStartI; i <= dateEndI; i++) {
            var col = this.computeCol(i, resourceI);
            segs.push({
                firstCol: col,
                lastCol: col,
                isStart: i === dateStartI,
                isEnd: i === dateEndI
            });
        }
        return segs;
    };
    return DayResourceTableModel;
}(AbstractResourceDayTableModel));
var ResourceIndex = /** @class */ (function () {
    function ResourceIndex(resources) {
        var indicesById = {};
        var ids = [];
        for (var i = 0; i < resources.length; i++) {
            var id = resources[i].id;
            ids.push(id);
            indicesById[id] = i;
        }
        this.ids = ids;
        this.indicesById = indicesById;
        this.length = resources.length;
    }
    return ResourceIndex;
}());
/*
TODO: just use ResourceHash somehow? could then use the generic ResourceSplitter
*/
var VResourceSplitter = /** @class */ (function (_super) {
    __extends(VResourceSplitter, _super);
    function VResourceSplitter() {
        return _super !== null && _super.apply(this, arguments) || this;
    }
    VResourceSplitter.prototype.getKeyInfo = function (props) {
        var resourceDayTableModel = props.resourceDayTableModel;
        var hash = mapHash(resourceDayTableModel.resourceIndex.indicesById, function (i) {
            return resourceDayTableModel.resources[i]; // has `ui` AND `businessHours` keys!
        }); // :(
        hash[''] = {};
        return hash;
    };
    VResourceSplitter.prototype.getKeysForDateSpan = function (dateSpan) {
        return [dateSpan.resourceId || ''];
    };
    VResourceSplitter.prototype.getKeysForEventDef = function (eventDef) {
        var resourceIds = eventDef.resourceIds;
        if (!resourceIds.length) {
            return [''];
        }
        return resourceIds;
    };
    return VResourceSplitter;
}(Splitter));
// joiner
var NO_SEGS = []; // for memoizing
var VResourceJoiner = /** @class */ (function () {
    function VResourceJoiner() {
        this.joinDateSelection = memoize(this.joinSegs);
        this.joinBusinessHours = memoize(this.joinSegs);
        this.joinFgEvents = memoize(this.joinSegs);
        this.joinBgEvents = memoize(this.joinSegs);
        this.joinEventDrags = memoize(this.joinInteractions);
        this.joinEventResizes = memoize(this.joinInteractions);
    }
    /*
    propSets also has a '' key for things with no resource
    */
    VResourceJoiner.prototype.joinProps = function (propSets, resourceDayTable) {
        var dateSelectionSets = [];
        var businessHoursSets = [];
        var fgEventSets = [];
        var bgEventSets = [];
        var eventDrags = [];
        var eventResizes = [];
        var eventSelection = '';
        var keys = resourceDayTable.resourceIndex.ids.concat(['']); // add in the all-resource key
        for (var _i = 0, keys_1 = keys; _i < keys_1.length; _i++) {
            var key = keys_1[_i];
            var props = propSets[key];
            dateSelectionSets.push(props.dateSelectionSegs);
            businessHoursSets.push(key ? props.businessHourSegs : NO_SEGS); // don't include redundant all-resource businesshours
            fgEventSets.push(key ? props.fgEventSegs : NO_SEGS); // don't include fg all-resource segs
            bgEventSets.push(props.bgEventSegs);
            eventDrags.push(props.eventDrag);
            eventResizes.push(props.eventResize);
            eventSelection = eventSelection || props.eventSelection;
        }
        return {
            dateSelectionSegs: this.joinDateSelection.apply(this, __spreadArrays([resourceDayTable], dateSelectionSets)),
            businessHourSegs: this.joinBusinessHours.apply(this, __spreadArrays([resourceDayTable], businessHoursSets)),
            fgEventSegs: this.joinFgEvents.apply(this, __spreadArrays([resourceDayTable], fgEventSets)),
            bgEventSegs: this.joinBgEvents.apply(this, __spreadArrays([resourceDayTable], bgEventSets)),
            eventDrag: this.joinEventDrags.apply(this, __spreadArrays([resourceDayTable], eventDrags)),
            eventResize: this.joinEventResizes.apply(this, __spreadArrays([resourceDayTable], eventResizes)),
            eventSelection: eventSelection
        };
    };
    VResourceJoiner.prototype.joinSegs = function (resourceDayTable) {
        var segGroups = [];
        for (var _i = 1; _i < arguments.length; _i++) {
            segGroups[_i - 1] = arguments[_i];
        }
        var resourceCnt = resourceDayTable.resources.length;
        var transformedSegs = [];
        for (var i = 0; i < resourceCnt; i++) {
            for (var _a = 0, _b = segGroups[i]; _a < _b.length; _a++) {
                var seg = _b[_a];
                transformedSegs.push.apply(transformedSegs, this.transformSeg(seg, resourceDayTable, i));
            }
            for (var _c = 0, _d = segGroups[resourceCnt]; _c < _d.length; _c++) { // one beyond. the all-resource
                var seg = _d[_c];
                transformedSegs.push.apply(// one beyond. the all-resource
                transformedSegs, this.transformSeg(seg, resourceDayTable, i));
            }
        }
        return transformedSegs;
    };
    /*
    for expanding non-resource segs to all resources.
    only for public use.
    no memoizing.
    */
    VResourceJoiner.prototype.expandSegs = function (resourceDayTable, segs) {
        var resourceCnt = resourceDayTable.resources.length;
        var transformedSegs = [];
        for (var i = 0; i < resourceCnt; i++) {
            for (var _i = 0, segs_1 = segs; _i < segs_1.length; _i++) {
                var seg = segs_1[_i];
                transformedSegs.push.apply(transformedSegs, this.transformSeg(seg, resourceDayTable, i));
            }
        }
        return transformedSegs;
    };
    VResourceJoiner.prototype.joinInteractions = function (resourceDayTable) {
        var interactions = [];
        for (var _i = 1; _i < arguments.length; _i++) {
            interactions[_i - 1] = arguments[_i];
        }
        var resourceCnt = resourceDayTable.resources.length;
        var affectedInstances = {};
        var transformedSegs = [];
        var anyInteractions = false;
        var isEvent = false;
        for (var i = 0; i < resourceCnt; i++) {
            var interaction = interactions[i];
            if (interaction) {
                anyInteractions = true;
                for (var _a = 0, _b = interaction.segs; _a < _b.length; _a++) {
                    var seg = _b[_a];
                    transformedSegs.push.apply(transformedSegs, this.transformSeg(seg, resourceDayTable, i) // TODO: templateify Interaction::segs
                    );
                }
                __assign(affectedInstances, interaction.affectedInstances);
                isEvent = isEvent || interaction.isEvent;
            }
            if (interactions[resourceCnt]) { // one beyond. the all-resource
                for (var _c = 0, _d = interactions[resourceCnt].segs; _c < _d.length; _c++) {
                    var seg = _d[_c];
                    transformedSegs.push.apply(transformedSegs, this.transformSeg(seg, resourceDayTable, i) // TODO: templateify Interaction::segs
                    );
                }
            }
        }
        if (anyInteractions) {
            return {
                affectedInstances: affectedInstances,
                segs: transformedSegs,
                isEvent: isEvent
            };
        }
        else {
            return null;
        }
    };
    return VResourceJoiner;
}());

/*
doesn't accept grouping
*/
function flattenResources(resourceStore, orderSpecs) {
    return buildRowNodes(resourceStore, [], orderSpecs, false, {}, true)
        .map(function (node) {
        return node.resource;
    });
}
function buildRowNodes(resourceStore, groupSpecs, orderSpecs, isVGrouping, expansions, expansionDefault) {
    var complexNodes = buildHierarchy(resourceStore, isVGrouping ? -1 : 1, groupSpecs, orderSpecs);
    var flatNodes = [];
    flattenNodes(complexNodes, flatNodes, isVGrouping, [], 0, expansions, expansionDefault);
    return flatNodes;
}
function flattenNodes(complexNodes, res, isVGrouping, rowSpans, depth, expansions, expansionDefault) {
    for (var i = 0; i < complexNodes.length; i++) {
        var complexNode = complexNodes[i];
        var group = complexNode.group;
        if (group) {
            if (isVGrouping) {
                var firstRowIndex = res.length;
                var rowSpanIndex = rowSpans.length;
                flattenNodes(complexNode.children, res, isVGrouping, rowSpans.concat(0), depth, expansions, expansionDefault);
                if (firstRowIndex < res.length) {
                    var firstRow = res[firstRowIndex];
                    var firstRowSpans = firstRow.rowSpans = firstRow.rowSpans.slice();
                    firstRowSpans[rowSpanIndex] = res.length - firstRowIndex;
                }
            }
            else {
                var id = group.spec.field + ':' + group.value;
                var isExpanded = expansions[id] != null ? expansions[id] : expansionDefault;
                res.push({ id: id, group: group, isExpanded: isExpanded });
                if (isExpanded) {
                    flattenNodes(complexNode.children, res, isVGrouping, rowSpans, depth + 1, expansions, expansionDefault);
                }
            }
        }
        else if (complexNode.resource) {
            var id = complexNode.resource.id;
            var isExpanded = expansions[id] != null ? expansions[id] : expansionDefault;
            res.push({
                id: id,
                rowSpans: rowSpans,
                depth: depth,
                isExpanded: isExpanded,
                hasChildren: Boolean(complexNode.children.length),
                resource: complexNode.resource,
                resourceFields: complexNode.resourceFields
            });
            if (isExpanded) {
                flattenNodes(complexNode.children, res, isVGrouping, rowSpans, depth + 1, expansions, expansionDefault);
            }
        }
    }
}
function buildHierarchy(resourceStore, maxDepth, groupSpecs, orderSpecs) {
    var resourceNodes = buildResourceNodes(resourceStore, orderSpecs);
    var builtNodes = [];
    for (var resourceId in resourceNodes) {
        var resourceNode = resourceNodes[resourceId];
        if (!resourceNode.resource.parentId) {
            insertResourceNode(resourceNode, builtNodes, groupSpecs, 0, maxDepth, orderSpecs);
        }
    }
    return builtNodes;
}
function buildResourceNodes(resourceStore, orderSpecs) {
    var nodeHash = {};
    for (var resourceId in resourceStore) {
        var resource = resourceStore[resourceId];
        nodeHash[resourceId] = {
            resource: resource,
            resourceFields: buildResourceFields(resource),
            children: []
        };
    }
    for (var resourceId in resourceStore) {
        var resource = resourceStore[resourceId];
        if (resource.parentId) {
            var parentNode = nodeHash[resource.parentId];
            if (parentNode) {
                insertResourceNodeInSiblings(nodeHash[resourceId], parentNode.children, orderSpecs);
            }
        }
    }
    return nodeHash;
}
function insertResourceNode(resourceNode, nodes, groupSpecs, depth, maxDepth, orderSpecs) {
    if (groupSpecs.length && (maxDepth === -1 || depth <= maxDepth)) {
        var groupNode = ensureGroupNodes(resourceNode, nodes, groupSpecs[0]);
        insertResourceNode(resourceNode, groupNode.children, groupSpecs.slice(1), depth + 1, maxDepth, orderSpecs);
    }
    else {
        insertResourceNodeInSiblings(resourceNode, nodes, orderSpecs);
    }
}
function ensureGroupNodes(resourceNode, nodes, groupSpec) {
    var groupValue = resourceNode.resourceFields[groupSpec.field];
    var groupNode;
    var newGroupIndex;
    // find an existing group that matches, or determine the position for a new group
    if (groupSpec.order) {
        for (newGroupIndex = 0; newGroupIndex < nodes.length; newGroupIndex++) {
            var node = nodes[newGroupIndex];
            if (node.group) {
                var cmp = flexibleCompare(groupValue, node.group.value) * groupSpec.order;
                if (cmp === 0) {
                    groupNode = node;
                    break;
                }
                else if (cmp < 0) {
                    break;
                }
            }
        }
    }
    else { // the groups are unordered
        for (newGroupIndex = 0; newGroupIndex < nodes.length; newGroupIndex++) {
            var node = nodes[newGroupIndex];
            if (node.group && groupValue === node.group.value) {
                groupNode = node;
                break;
            }
        }
    }
    if (!groupNode) {
        groupNode = {
            group: {
                value: groupValue,
                spec: groupSpec
            },
            children: []
        };
        nodes.splice(newGroupIndex, 0, groupNode);
    }
    return groupNode;
}
function insertResourceNodeInSiblings(resourceNode, siblings, orderSpecs) {
    var i;
    for (i = 0; i < siblings.length; i++) {
        var cmp = compareByFieldSpecs(siblings[i].resourceFields, resourceNode.resourceFields, orderSpecs); // TODO: pass in ResourceApi?
        if (cmp > 0) { // went 1 past. insert at i
            break;
        }
    }
    siblings.splice(i, 0, resourceNode);
}
function buildResourceFields(resource) {
    var obj = __assign(__assign(__assign({}, resource.extendedProps), resource.ui), resource);
    delete obj.ui;
    delete obj.extendedProps;
    return obj;
}
function isGroupsEqual(group0, group1) {
    return group0.spec === group1.spec && group0.value === group1.value;
}

var main = createPlugin({
    deps: [
        premiumCommonPlugin
    ],
    reducers: [reduceResources],
    eventRefiners: EVENT_REFINERS,
    eventDefMemberAdders: [generateEventDefResourceMembers],
    isDraggableTransformers: [transformIsDraggable],
    eventDragMutationMassagers: [massageEventDragMutation],
    eventDefMutationAppliers: [applyEventDefMutation],
    dateSelectionTransformers: [transformDateSelectionJoin],
    datePointTransforms: [transformDatePoint],
    dateSpanTransforms: [transformDateSpan],
    viewPropsTransformers: [ResourceDataAdder, ResourceEventConfigAdder],
    isPropsValid: isPropsValidWithResources,
    externalDefTransforms: [transformExternalDef],
    eventResizeJoinTransforms: [transformEventResizeJoin],
    eventDropTransformers: [transformEventDrop],
    optionChangeHandlers: optionChangeHandlers,
    optionRefiners: OPTION_REFINERS,
    listenerRefiners: LISTENER_REFINERS,
    propSetHandlers: { resourceStore: handleResourceStore }
});

export default main;
export { AbstractResourceDayTableModel, DEFAULT_RESOURCE_ORDER, DayResourceTableModel, ResourceApi, ResourceDayHeader, ResourceDayTableModel, ResourceLabelRoot, ResourceSplitter, VResourceJoiner, VResourceSplitter, buildResourceFields, buildRowNodes, flattenResources, getPublicId, isGroupsEqual };
//# sourceMappingURL=main.js.map
