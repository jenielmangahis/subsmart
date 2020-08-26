
import { BaseComponent, ScrollGridProps, VNode, ScrollGridSectionConfig, ScrollGridChunkConfig, CssDimValue, ColProps, PluginDef } from '@fullcalendar/common';
import '@fullcalendar/premium-common';

interface ScrollGridState {
    shrinkWidths: number[];
    forceYScrollbars: boolean;
    forceXScrollbars: boolean;
    scrollerClientWidths: {
        [index: string]: number;
    };
    scrollerClientHeights: {
        [index: string]: number;
    };
    sectionRowMaxHeights: number[][][];
}
interface ColGroupStat {
    hasShrinkCol: boolean;
    totalColWidth: number;
    totalColMinWidth: number;
    allowXScrolling: boolean;
    width?: CssDimValue;
    cols: ColProps[];
}
declare class ScrollGrid extends BaseComponent<ScrollGridProps, ScrollGridState> {
    private compileColGroupStats;
    private renderMicroColGroups;
    private clippedScrollerRefs;
    private scrollerElRefs;
    private chunkElRefs;
    private getStickyScrolling;
    private getScrollSyncersBySection;
    private getScrollSyncersByColumn;
    private stickyScrollings;
    private scrollSyncersBySection;
    private scrollSyncersByColumn;
    private rowUnstableMap;
    private rowInnerMaxHeightMap;
    private anyRowHeightsChanged;
    state: ScrollGridState;
    render(): VNode;
    renderSection(sectionConfig: ScrollGridSectionConfig, sectionIndex: number, colGroupStats: ColGroupStat[], microColGroupNodes: VNode[], sectionRowMaxHeights: number[][][]): VNode;
    renderChunk(sectionConfig: ScrollGridSectionConfig, sectionIndex: number, colGroupStat: ColGroupStat | undefined, microColGroupNode: VNode | undefined, chunkConfig: ScrollGridChunkConfig, chunkIndex: number, rowHeights: number[]): VNode;
    componentDidMount(): void;
    componentDidUpdate(prevProps: ScrollGridProps, prevState: ScrollGridState): void;
    componentWillUnmount(): void;
    handleSizing: (isForcedResize: boolean, sectionRowMaxHeightsChanged?: boolean) => void;
    handleRowHeightChange: (rowEl: HTMLTableRowElement, isStable: boolean) => void;
    computeShrinkWidths(): number[];
    private computeSectionRowMaxHeights;
    computeScrollerDims(): {
        forceYScrollbars: boolean;
        forceXScrollbars: boolean;
        scrollerClientWidths: {
            [index: string]: number;
        };
        scrollerClientHeights: {
            [index: string]: number;
        };
    };
    updateStickyScrolling(): void;
    destroyStickyScrolling(): void;
    updateScrollSyncers(): void;
    destroyScrollSyncers(): void;
    getChunkConfigByIndex(index: number): ScrollGridChunkConfig;
    forceScrollLeft(col: number, scrollLeft: number): void;
    forceScrollTop(sectionI: number, scrollTop: number): void;
    _handleChunkEl(chunkEl: HTMLTableCellElement | null, key: string): void;
    _handleScrollerEl(scrollerEl: HTMLElement | null, key: string): void;
    getDims(): number[];
}

declare function setScrollFromStartingEdge(el: HTMLElement, val: number): void;


declare const _default: PluginDef;

export default _default;
export { ScrollGrid, setScrollFromStartingEdge };
