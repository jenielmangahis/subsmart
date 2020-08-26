
import { createElement, DateComponent, Hit, DateProfile, EventStore, EventUiHash, DateSpan, EventInteractionState, Duration, CssDimValue, VNode, RefObject, PluginDef } from '@fullcalendar/common';
import '@fullcalendar/premium-common';
import { TableView } from '@fullcalendar/daygrid';
import { ResourceViewProps, AbstractResourceDayTableModel } from '@fullcalendar/resource-common';

declare class ResourceDayTableView extends TableView {
    props: ResourceViewProps;
    private flattenResources;
    private buildResourceDayTableModel;
    private headerRef;
    private tableRef;
    render(): createElement.JSX.Element;
}


interface ResourceDayTableProps {
    dateProfile: DateProfile;
    resourceDayTableModel: AbstractResourceDayTableModel;
    businessHours: EventStore;
    eventStore: EventStore;
    eventUiBases: EventUiHash;
    dateSelection: DateSpan | null;
    eventSelection: string;
    eventDrag: EventInteractionState | null;
    eventResize: EventInteractionState | null;
    nextDayThreshold: Duration;
    tableMinWidth: CssDimValue;
    colGroupNode: VNode;
    renderRowIntro?: () => VNode;
    dayMaxEvents: boolean | number;
    dayMaxEventRows: boolean | number;
    expandRows: boolean;
    showWeekNumbers: boolean;
    headerAlignElRef?: RefObject<HTMLElement>;
    clientWidth: number | null;
    clientHeight: number | null;
    forPrint: boolean;
}
declare class ResourceDayTable extends DateComponent<ResourceDayTableProps> {
    allowAcrossResources: boolean;
    private splitter;
    private slicers;
    private joiner;
    private tableRef;
    render(): createElement.JSX.Element;
    handleRootEl: (rootEl: HTMLElement | null) => void;
    prepareHits(): void;
    queryHit(positionLeft: number, positionTop: number): Hit;
}


declare const _default: PluginDef;

export default _default;
export { ResourceDayTable, ResourceDayTableView };
