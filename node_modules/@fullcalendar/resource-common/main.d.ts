
import { EventStore, EventUi, RawOptionsFromRefiners, Identity, BusinessHoursInput, ConstraintInput, AllowFunc, parseClassNames, CalendarContext, EventApi, DateRange, Action, MountArg, Dictionary, Ref, ComponentChildren, ViewApi, createElement, ClassNamesGenerator, CustomContentGenerator, DidMountHandler, WillUnmountHandler, OrderSpec, parseFieldSpecs, BaseComponent, DateMarker, DateFormatter, VNode, DateProfile, DayTableModel, Splitter, DateSpan, EventDef, Seg, SlicedProps, EventSegUiInteractionState, DayTableCell, SplittableProps, ViewProps, Constraint, PluginDef } from '@fullcalendar/common';
import '@fullcalendar/premium-common';

declare const RESOURCE_REFINERS: {
    id: StringConstructor;
    parentId: StringConstructor;
    children: Identity<ResourceInput[]>;
    title: StringConstructor;
    businessHours: Identity<BusinessHoursInput>;
    extendedProps: Identity<Record<string, any>>;
    eventEditable: BooleanConstructor;
    eventStartEditable: BooleanConstructor;
    eventDurationEditable: BooleanConstructor;
    eventConstraint: Identity<ConstraintInput>;
    eventOverlap: BooleanConstructor;
    eventAllow: Identity<AllowFunc>;
    eventClassNames: typeof parseClassNames;
    eventBackgroundColor: StringConstructor;
    eventBorderColor: StringConstructor;
    eventTextColor: StringConstructor;
    eventColor: StringConstructor;
};
declare type BuiltInResourceRefiners = typeof RESOURCE_REFINERS;
interface ResourceRefiners extends BuiltInResourceRefiners {
}
declare type ResourceInput = RawOptionsFromRefiners<Required<ResourceRefiners>> & 
{
    [extendedProps: string]: any;
};
interface Resource {
    id: string;
    parentId: string;
    title: string;
    businessHours: EventStore | null;
    ui: EventUi;
    extendedProps: {
        [extendedProp: string]: any;
    };
}
declare type ResourceHash = {
    [resourceId: string]: Resource;
};
declare function getPublicId(id: string): string;

declare class ResourceApi {
    private _context;
    _resource: Resource;
    constructor(_context: CalendarContext, _resource: Resource);
    setProp(name: string, value: any): void;
    setExtendedProp(name: string, value: any): void;
    private sync;
    remove(): void;
    getParent(): ResourceApi | null;
    getChildren(): ResourceApi[];
    getEvents(): EventApi[];
    get id(): string;
    get title(): string;
    get eventConstraint(): string | EventStore;
    get eventOverlap(): boolean;
    get eventAllow(): AllowFunc;
    get eventBackgroundColor(): string;
    get eventBorderColor(): string;
    get eventTextColor(): string;
    get eventClassNames(): string[];
    get extendedProps(): {
        [extendedProp: string]: any;
    };
    toPlainObject(settings?: {
        collapseExtendedProps?: boolean;
        collapseEventColor?: boolean;
    }): Record<string, any>;
    toJSON(): Record<string, any>;
}

interface ResourceSource<ResourceSourceMeta> {
    _raw: any;
    sourceId: string;
    sourceDefId: number;
    meta: ResourceSourceMeta;
    publicId: string;
    isFetching: boolean;
    latestFetchId: string;
    fetchRange: DateRange | null;
}
declare type ResourceSourceError = {
    message: string;
    xhr?: XMLHttpRequest;
    [otherProp: string]: any;
};

declare type ResourceAction = Action | {
    type: 'FETCH_RESOURCE';
} | {
    type: 'RECEIVE_RESOURCES';
    rawResources: ResourceInput[];
    fetchId: string;
    fetchRange: DateRange | null;
} | {
    type: 'RECEIVE_RESOURCE_ERROR';
    error: ResourceSourceError;
    fetchId: string;
    fetchRange: DateRange | null;
} | {
    type: 'ADD_RESOURCE';
    resourceHash: ResourceHash;
} | 
{
    type: 'REMOVE_RESOURCE';
    resourceId: string;
} | {
    type: 'SET_RESOURCE_PROP';
    resourceId: string;
    propName: string;
    propValue: any;
} | {
    type: 'SET_RESOURCE_EXTENDED_PROP';
    resourceId: string;
    propName: string;
    propValue: any;
} | {
    type: 'SET_RESOURCE_ENTITY_EXPANDED';
    id: string;
    isExpanded: boolean;
} | {
    type: 'RESET_RESOURCE_SOURCE';
    resourceSourceInput: any;
} | {
    type: 'REFETCH_RESOURCES';
};


declare type ResourceEntityExpansions = {
    [id: string]: boolean;
};

declare module '@fullcalendar/common' {
    interface CalendarContext {
        dispatch(action: ResourceAction): void;
    }
    interface CalendarData {
        resourceSource?: ResourceSource<any>;
        resourceStore?: ResourceHash;
        resourceEntityExpansions?: ResourceEntityExpansions;
    }
    interface DatePointApi {
        resource?: ResourceApi;
    }
    interface DateSpanApi {
        resource?: ResourceApi;
    }
    interface EventMutation {
        resourceMutation?: {
            matchResourceId: string;
            setResourceId: string;
        };
    }
    interface EventDef {
        resourceIds?: string[];
        resourceEditable?: boolean;
    }
}


declare const EVENT_REFINERS: {
    resourceId: StringConstructor;
    resourceIds: Identity<string[]>;
    resourceEditable: BooleanConstructor;
};

declare type ExtraEventRefiners = typeof EVENT_REFINERS;
declare module '@fullcalendar/common' {
    interface EventRefiners extends ExtraEventRefiners {
    }
}

declare module '@fullcalendar/common' {
    interface CalendarApi {
        dispatch(action: ResourceAction): any;
        addResource(input: ResourceInput, scrollTo?: boolean): ResourceApi;
        getResourceById(id: string): ResourceApi | null;
        getResources(): ResourceApi[];
        getTopLevelResources(): ResourceApi[];
        refetchResources(): void;
    }
}


declare module '@fullcalendar/common' {
    interface EventApi {
        getResources: () => ResourceApi[];
        setResources: (resources: (string | ResourceApi)[]) => void;
    }
}


interface ResourceLaneHookPropsInput {
    resource: Resource;
    context: CalendarContext;
}
interface ResourceLaneContentArg {
    resource: ResourceApi;
}
declare type ResourceLaneMountArg = MountArg<ResourceLaneContentArg>;


interface ResourceFuncArg {
    start?: Date;
    end?: Date;
    startStr?: string;
    endStr?: string;
    timeZone?: string;
}
declare type ResourceFunc = (arg: ResourceFuncArg, successCallback: (events: ResourceInput[]) => void, failureCallback: (errorObj: ResourceSourceError) => void) => any;


declare const RESOURCE_SOURCE_REFINERS: {
    id: StringConstructor;
    resources: Identity<ResourceFunc | ResourceInput[]>;
    url: StringConstructor;
    method: StringConstructor;
    startParam: StringConstructor;
    endParam: StringConstructor;
    timeZoneParam: StringConstructor;
    extraParams: Identity<Record<string, any> | (() => Dictionary)>;
};
declare type ResourceSourceInputObject = RawOptionsFromRefiners<typeof RESOURCE_SOURCE_REFINERS>;
declare type ResourceSourceInput = ResourceSourceInputObject | ResourceInput[] | ResourceFunc | string;

interface ResourceLabelRootProps {
    resource: Resource;
    date?: Date;
    children: (rootElRef: Ref<HTMLElement>, classNames: string[], dataAttrs: Dictionary, innerElRef: Ref<HTMLElement>, innerContent: ComponentChildren) => ComponentChildren;
}
interface ResourceLabelContentArg {
    resource: ResourceApi;
    date?: Date;
    view: ViewApi;
}
declare type ResourceLabelMountArg = MountArg<ResourceLabelContentArg>;
declare function ResourceLabelRoot(props: ResourceLabelRootProps): createElement.JSX.Element;


interface ColHeaderContentArg {
    view: ViewApi;
}
declare type ColHeaderMountArg = MountArg<ColHeaderContentArg>;
interface ColCellContentArg {
    resource?: ResourceApi;
    groupValue?: any;
    view: ViewApi;
}
declare type ColCellMountArg = MountArg<ColCellContentArg>;
interface ColHeaderRenderHooks {
    headerClassNames?: ClassNamesGenerator<ColHeaderContentArg>;
    headerContent?: CustomContentGenerator<ColHeaderContentArg>;
    headerDidMount?: DidMountHandler<ColHeaderMountArg>;
    headerWillUnmount?: WillUnmountHandler<ColHeaderMountArg>;
}
interface ColSpec extends ColHeaderRenderHooks {
    group?: boolean;
    isMain?: boolean;
    width?: number;
    field?: string;
    cellClassNames?: ClassNamesGenerator<ColCellContentArg>;
    cellContent?: CustomContentGenerator<ColCellContentArg>;
    cellDidMount?: DidMountHandler<ColCellMountArg>;
    cellWillUnmount?: WillUnmountHandler<ColCellMountArg>;
}
interface GroupLaneRenderHooks {
    laneClassNames?: ClassNamesGenerator<ColCellContentArg>;
    laneContent?: CustomContentGenerator<ColCellContentArg>;
    laneDidMount?: DidMountHandler<ColCellMountArg>;
    laneWillUnmount?: WillUnmountHandler<ColCellMountArg>;
}
interface GroupSpec extends GroupLaneRenderHooks {
    field?: string;
    order?: number;
    labelClassNames?: ClassNamesGenerator<ColCellContentArg>;
    labelContent?: CustomContentGenerator<ColCellContentArg>;
    labelDidMount?: DidMountHandler<ColCellMountArg>;
    labelWillUnmount?: WillUnmountHandler<ColCellMountArg>;
}


declare const DEFAULT_RESOURCE_ORDER: OrderSpec<unknown>[];
interface ResourceAddArg {
    resource: ResourceApi;
    revert: () => void;
}
interface ResourceChangeArg {
    oldResource: ResourceApi;
    resource: ResourceApi;
    revert: () => void;
}
interface ResourceRemoveArg {
    resource: ResourceApi;
    revert: () => void;
}

declare const OPTION_REFINERS: {
    initialResources: Identity<ResourceSourceInput>;
    resources: Identity<ResourceSourceInput>;
    eventResourceEditable: BooleanConstructor;
    refetchResourcesOnNavigate: BooleanConstructor;
    resourceOrder: typeof parseFieldSpecs;
    filterResourcesWithEvents: BooleanConstructor;
    resourceGroupField: StringConstructor;
    resourceAreaWidth: Identity<string | number>;
    resourceAreaColumns: Identity<ColSpec[]>;
    resourcesInitiallyExpanded: BooleanConstructor;
    datesAboveResources: BooleanConstructor;
    needsResourceData: BooleanConstructor;
    resourceAreaHeaderClassNames: Identity<ClassNamesGenerator<ColHeaderContentArg>>;
    resourceAreaHeaderContent: Identity<CustomContentGenerator<ColHeaderContentArg>>;
    resourceAreaHeaderDidMount: Identity<DidMountHandler<MountArg<ColHeaderContentArg>>>;
    resourceAreaHeaderWillUnmount: Identity<WillUnmountHandler<MountArg<ColHeaderContentArg>>>;
    resourceGroupLabelClassNames: Identity<ClassNamesGenerator<ColCellContentArg>>;
    resourceGroupLabelContent: Identity<CustomContentGenerator<ColCellContentArg>>;
    resourceGroupLabelDidMount: Identity<DidMountHandler<MountArg<ColCellContentArg>>>;
    resourceGroupLabelWillUnmount: Identity<WillUnmountHandler<MountArg<ColCellContentArg>>>;
    resourceLabelClassNames: Identity<ClassNamesGenerator<ResourceLabelContentArg>>;
    resourceLabelContent: Identity<CustomContentGenerator<ResourceLabelContentArg>>;
    resourceLabelDidMount: Identity<DidMountHandler<MountArg<ResourceLabelContentArg>>>;
    resourceLabelWillUnmount: Identity<WillUnmountHandler<MountArg<ResourceLabelContentArg>>>;
    resourceLaneClassNames: Identity<ClassNamesGenerator<ResourceLaneContentArg>>;
    resourceLaneContent: Identity<CustomContentGenerator<ResourceLaneContentArg>>;
    resourceLaneDidMount: Identity<DidMountHandler<MountArg<ResourceLaneContentArg>>>;
    resourceLaneWillUnmount: Identity<WillUnmountHandler<MountArg<ResourceLaneContentArg>>>;
    resourceGroupLaneClassNames: Identity<ClassNamesGenerator<ColCellContentArg>>;
    resourceGroupLaneContent: Identity<CustomContentGenerator<ColCellContentArg>>;
    resourceGroupLaneDidMount: Identity<DidMountHandler<MountArg<ColCellContentArg>>>;
    resourceGroupLaneWillUnmount: Identity<WillUnmountHandler<MountArg<ColCellContentArg>>>;
};
declare const LISTENER_REFINERS: {
    resourcesSet: Identity<(resources: ResourceApi[]) => void>;
    resourceAdd: Identity<(arg: ResourceAddArg) => void>;
    resourceChange: Identity<(arg: ResourceChangeArg) => void>;
    resourceRemove: Identity<(arg: ResourceRemoveArg) => void>;
};


declare type ExtraOptionRefiners = typeof OPTION_REFINERS;
declare type ExtraListenerRefiners = typeof LISTENER_REFINERS;
declare module '@fullcalendar/common' {
    interface BaseOptionRefiners extends ExtraOptionRefiners {
    }
    interface CalendarListenerRefiners extends ExtraListenerRefiners {
    }
}

interface ResourceDayHeaderProps {
    dates: DateMarker[];
    dateProfile: DateProfile;
    datesRepDistinctDays: boolean;
    resources: Resource[];
    renderIntro?: () => VNode;
}
declare class ResourceDayHeader extends BaseComponent<ResourceDayHeaderProps> {
    private buildDateFormat;
    render(): createElement.JSX.Element;
    renderResourceRow(resources: Resource[], date: DateMarker): createElement.JSX.Element;
    renderDayAndResourceRows(dates: DateMarker[], dateFormat: DateFormatter, todayRange: DateRange, resources: Resource[]): createElement.JSX.Element;
    renderResourceAndDayRows(resources: Resource[], dates: DateMarker[], dateFormat: DateFormatter, todayRange: DateRange): createElement.JSX.Element;
    renderDateCell(date: DateMarker, dateFormat: DateFormatter, todayRange: DateRange, colSpan: number, resource?: Resource, isSticky?: boolean): createElement.JSX.Element;
    buildTr(cells: VNode[], key: string): createElement.JSX.Element;
}


interface ResourceDayTableCell extends DayTableCell {
    resource: Resource;
}
declare abstract class AbstractResourceDayTableModel {
    dayTableModel: DayTableModel;
    resources: Resource[];
    private context;
    cells: ResourceDayTableCell[][];
    rowCnt: number;
    colCnt: number;
    resourceIndex: ResourceIndex;
    constructor(dayTableModel: DayTableModel, resources: Resource[], context: CalendarContext);
    abstract computeCol(dateI: any, resourceI: any): number;
    abstract computeColRanges(dateStartI: any, dateEndI: any, resourceI: any): {
        firstCol: number;
        lastCol: number;
        isStart: boolean;
        isEnd: boolean;
    }[];
    buildCells(): ResourceDayTableCell[][];
}
declare class ResourceDayTableModel extends AbstractResourceDayTableModel {
    computeCol(dateI: any, resourceI: any): any;
    computeColRanges(dateStartI: any, dateEndI: any, resourceI: any): {
        firstCol: any;
        lastCol: any;
        isStart: boolean;
        isEnd: boolean;
    }[];
}
declare class DayResourceTableModel extends AbstractResourceDayTableModel {
    computeCol(dateI: any, resourceI: any): any;
    computeColRanges(dateStartI: any, dateEndI: any, resourceI: any): any[];
}
declare class ResourceIndex {
    indicesById: {
        [resourceId: string]: number;
    };
    ids: string[];
    length: number;
    constructor(resources: Resource[]);
}
interface VResourceProps extends SplittableProps {
    resourceDayTableModel: AbstractResourceDayTableModel;
}
declare class VResourceSplitter extends Splitter<VResourceProps> {
    getKeyInfo(props: VResourceProps): any;
    getKeysForDateSpan(dateSpan: DateSpan): string[];
    getKeysForEventDef(eventDef: EventDef): string[];
}
declare abstract class VResourceJoiner<SegType extends Seg> {
    private joinDateSelection;
    private joinBusinessHours;
    private joinFgEvents;
    private joinBgEvents;
    private joinEventDrags;
    private joinEventResizes;
    joinProps(propSets: {
        [resourceId: string]: SlicedProps<SegType>;
    }, resourceDayTable: AbstractResourceDayTableModel): SlicedProps<SegType>;
    joinSegs(resourceDayTable: AbstractResourceDayTableModel, ...segGroups: SegType[][]): SegType[];
    expandSegs(resourceDayTable: AbstractResourceDayTableModel, segs: SegType[]): any[];
    joinInteractions(resourceDayTable: AbstractResourceDayTableModel, ...interactions: EventSegUiInteractionState[]): EventSegUiInteractionState | null;
    abstract transformSeg(seg: SegType, resourceDayTable: AbstractResourceDayTableModel, resourceI: number): SegType[];
}


interface ResourceViewProps extends ViewProps {
    resourceStore: ResourceHash;
    resourceEntityExpansions: ResourceEntityExpansions;
}

interface Group {
    value: any;
    spec: GroupSpec;
}
interface GroupNode {
    id: string;
    isExpanded: boolean;
    group: Group;
}
interface ResourceNode {
    id: string;
    rowSpans: number[];
    depth: number;
    isExpanded: boolean;
    hasChildren: boolean;
    resource: Resource;
    resourceFields: any;
}
declare function flattenResources(resourceStore: ResourceHash, orderSpecs: OrderSpec<ResourceApi>[]): Resource[];
declare function buildRowNodes(resourceStore: ResourceHash, groupSpecs: GroupSpec[], orderSpecs: OrderSpec<ResourceApi>[], isVGrouping: boolean, expansions: ResourceEntityExpansions, expansionDefault: boolean): (GroupNode | ResourceNode)[];
declare function buildResourceFields(resource: Resource): {
    id: string;
    parentId: string;
    title: string;
    businessHours: EventStore;
    ui: EventUi;
    extendedProps: {
        [extendedProp: string]: any;
    };
    display: string;
    startEditable: boolean;
    durationEditable: boolean;
    constraints: Constraint[];
    overlap: boolean;
    allows: AllowFunc[];
    backgroundColor: string;
    borderColor: string;
    textColor: string;
    classNames: string[];
};
declare function isGroupsEqual(group0: Group, group1: Group): boolean;


interface SplittableResourceProps extends SplittableProps {
    resourceStore: ResourceHash;
}
declare class ResourceSplitter extends Splitter<SplittableResourceProps> {
    getKeyInfo(props: SplittableResourceProps): {
        '': {};
    };
    getKeysForDateSpan(dateSpan: DateSpan): string[];
    getKeysForEventDef(eventDef: EventDef): string[];
}


declare const _default: PluginDef;

export default _default;
export { AbstractResourceDayTableModel, ColCellContentArg, ColCellMountArg, ColHeaderContentArg, ColHeaderMountArg, ColHeaderRenderHooks, ColSpec, DEFAULT_RESOURCE_ORDER, DayResourceTableModel, Group, GroupLaneRenderHooks, GroupNode, GroupSpec, Resource, ResourceAddArg, ResourceApi, ResourceChangeArg, ResourceDayHeader, ResourceDayTableModel, ResourceHash, ResourceLabelContentArg, ResourceLabelMountArg, ResourceLabelRoot, ResourceLabelRootProps, ResourceLaneContentArg, ResourceLaneHookPropsInput, ResourceLaneMountArg, ResourceNode, ResourceRemoveArg, ResourceSourceInput, ResourceSplitter, ResourceViewProps, VResourceJoiner, VResourceSplitter, buildResourceFields, buildRowNodes, flattenResources, getPublicId, isGroupsEqual };
