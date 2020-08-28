import { PluginDef } from '@fullcalendar/common';

declare const OPTION_REFINERS: {
    schedulerLicenseKey: StringConstructor;
};


declare type ExtraOptionRefiners = typeof OPTION_REFINERS;
declare module '@fullcalendar/common' {
    interface BaseOptionRefiners extends ExtraOptionRefiners {
    }
}

declare const _default: PluginDef;

export default _default;
