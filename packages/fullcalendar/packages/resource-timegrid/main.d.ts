
import { createElement, DateComponent, DateMarker, Hit, DateProfile, Duration, EventStore, EventUiHash, DateSpan, EventInteractionState, VNode, CssDimValue, PluginDef } from '@fullcalendar/common';
import '@fullcalendar/premium-common';
import { TimeColsView, TimeSlatMeta, TimeColsSlatsCoords } from '@fullcalendar/timegrid';
import { ResourceViewProps, AbstractResourceDayTableModel } from '@fullcalendar/resource-common';

declare class ResourceDayTimeColsView extends TimeColsView {
    props: ResourceViewProps;
    private flattenResources;
    private buildResourceTimeColsModel;
    private buildSlatMetas;
    render(): createElement.JSX.Element;
}


interface ResourceDayTimeColsProps {
    dateProfile: DateProfile;
    resourceDayTableModel: AbstractResourceDayTableModel;
    axis: boolean;
    slotDuration: Duration;
    slatMetas: TimeSlatMeta[];
    businessHours: EventStore;
    eventStore: EventStore;
    eventUiBases: EventUiHash;
    dateSelection: DateSpan | null;
    eventSelection: string;
    eventDrag: EventInteractionState | null;
    eventResize: EventInteractionState | null;
    tableColGroupNode: VNode;
    tableMinWidth: CssDimValue;
    clientWidth: number | null;
    clientHeight: number | null;
    expandRows: boolean;
    onScrollTopRequest?: (scrollTop: number) => void;
    forPrint: boolean;
    onSlatCoords?: (slatCoords: TimeColsSlatsCoords) => void;
}
declare class ResourceDayTimeCols extends DateComponent<ResourceDayTimeColsProps> {
    allowAcrossResources: boolean;
    private buildDayRanges;
    private dayRanges;
    private splitter;
    private slicers;
    private joiner;
    private timeColsRef;
    render(): createElement.JSX.Element;
    handleRootEl: (rootEl: HTMLElement | null) => void;
    buildNowIndicatorSegs(date: DateMarker): any[];
    queryHit(positionLeft: number, positionTop: number): Hit;
}


declare const _default: PluginDef;

export default _default;
export { ResourceDayTimeCols, ResourceDayTimeColsView };
