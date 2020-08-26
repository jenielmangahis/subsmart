import { BaseComponent, ViewContext, createElement, PositionCache, ScrollRequest, CssDimValue, ClassNamesGenerator, Ref, PluginDef } from '@fullcalendar/common';
import '@fullcalendar/premium-common';
import { TimelineCoords, TimelineDateProfile, TimelineLaneCoreProps } from '@fullcalendar/timeline';
import { ResourceViewProps, ResourceNode, GroupNode, ColSpec, ResourceLaneHookPropsInput, ResourceLaneContentArg, Resource } from '@fullcalendar/resource-common';

interface ResourceTimelineViewState {
    resourceAreaWidth: CssDimValue;
    spreadsheetColWidths: number[];
    slatCoords?: TimelineCoords;
    slotCushionMaxWidth?: number;
}
interface ResourceTimelineViewSnapshot {
    resourceScroll?: ResourceScrollState;
}
interface ResourceScrollState {
    rowId: string;
    fromBottom: number;
}
declare class ResourceTimelineView extends BaseComponent<ResourceViewProps, ResourceTimelineViewState> {
    private processColOptions;
    private buildTimelineDateProfile;
    private hasNesting;
    private buildRowNodes;
    private layoutRef;
    private rowNodes;
    private renderedRowNodes;
    private buildRowIndex;
    private rowCoords;
    private scrollResponder;
    constructor(props: ResourceViewProps, context: ViewContext);
    render(): createElement.JSX.Element;
    renderSpreadsheetRows(nodes: (ResourceNode | GroupNode)[], colSpecs: ColSpec[], rowSyncHeights: number[]): createElement.JSX.Element[];
    componentDidMount(): void;
    getSnapshotBeforeUpdate(): ResourceTimelineViewSnapshot;
    componentDidUpdate(prevProps: ResourceViewProps, prevState: ResourceTimelineViewState, snapshot: ResourceTimelineViewSnapshot): void;
    componentWillUnmount(): void;
    handleSlatCoords: (slatCoords: TimelineCoords) => void;
    handleRowCoords: (rowCoords: PositionCache) => void;
    handleMaxCushionWidth: (slotCushionMaxWidth: any) => void;
    computeFallbackSlotMinWidth(tDateProfile: TimelineDateProfile): number;
    handleScrollLeftRequest: (scrollLeft: number) => void;
    handleScrollRequest: (request: ScrollRequest & ResourceScrollState) => boolean;
    queryResourceScroll(): ResourceScrollState;
    handleColWidthChange: (colWidths: number[]) => void;
}

interface ResourceTimelineLaneProps extends TimelineLaneCoreProps {
    elRef: Ref<HTMLTableRowElement>;
    resource: Resource;
    innerHeight: CssDimValue;
    onHeightChange?: (rowEl: HTMLTableRowElement, isStable: boolean) => void;
}
declare class ResourceTimelineLane extends BaseComponent<ResourceTimelineLaneProps> {
    refineHookProps: (arg: ResourceLaneHookPropsInput) => ResourceLaneContentArg;
    normalizeClassNames: (generator: ClassNamesGenerator<ResourceLaneContentArg>, hookProps: ResourceLaneContentArg) => string[];
    render(): createElement.JSX.Element;
    handleHeightChange: (innerEl: HTMLElement, isStable: boolean) => void;
}


interface SpreadsheetRowProps {
    colSpecs: ColSpec[];
    rowSpans: number[];
    depth: number;
    isExpanded: boolean;
    hasChildren: boolean;
    resource: Resource;
    innerHeight: CssDimValue;
}
declare class SpreadsheetRow extends BaseComponent<SpreadsheetRowProps, ViewContext> {
    render(): createElement.JSX.Element;
}


declare const _default: PluginDef;

export default _default;
export { ResourceTimelineLane, ResourceTimelineView, SpreadsheetRow };
