/*!
FullCalendar Scheduler v5.2.1
Docs & License: https://fullcalendar.io/scheduler
(c) 2020 Adam Shaw
*/
var FullCalendarPremiumCommon = (function (exports, common) {
    'use strict';

    var RELEASE_DATE = '2020-08-12'; // for Scheduler
    var UPGRADE_WINDOW = 365 + 7; // days. 1 week leeway, for tz shift reasons too
    var LICENSE_INFO_URL = 'http://fullcalendar.io/scheduler/license/';
    var PRESET_LICENSE_KEYS = [
        'GPL-My-Project-Is-Open-Source',
        'CC-Attribution-NonCommercial-NoDerivatives'
    ];
    var CSS = {
        position: 'absolute',
        zIndex: 99999,
        bottom: '1px',
        left: '1px',
        background: '#eee',
        borderColor: '#ddd',
        borderStyle: 'solid',
        borderWidth: '1px 1px 0 0',
        padding: '2px 4px',
        fontSize: '12px',
        borderTopRightRadius: '3px'
    };
    function buildLicenseWarning(context) {
        var key = context.options.schedulerLicenseKey;
        if (!isImmuneUrl(window.location.href) && !isValidKey(key)) {
            return (common.createElement("div", { className: 'fc-license-message', style: CSS },
                "Please use a valid license key. ",
                common.createElement("a", { href: LICENSE_INFO_URL }, "More Info")));
        }
    }
    /*
    This decryption is not meant to be bulletproof. Just a way to remind about an upgrade.
    */
    function isValidKey(key) {
        if (PRESET_LICENSE_KEYS.indexOf(key) !== -1) {
            return true;
        }
        var parts = (key || '').match(/^(\d+)-fcs-(\d+)$/);
        if (parts && (parts[1].length === 10)) {
            var purchaseDate = new Date(parseInt(parts[2], 10) * 1000);
            var releaseDate = new Date(common.config.mockSchedulerReleaseDate || RELEASE_DATE);
            if (common.isValidDate(releaseDate)) { // token won't be replaced in dev mode
                var minPurchaseDate = common.addDays(releaseDate, -UPGRADE_WINDOW);
                if (minPurchaseDate < purchaseDate) {
                    return true;
                }
            }
        }
        return false;
    }
    function isImmuneUrl(url) {
        return /\w+:\/\/fullcalendar\.io\/|\/examples\/[\w-]+\.html$/.test(url);
    }

    var OPTION_REFINERS = {
        schedulerLicenseKey: String
    };

    var plugin = common.createPlugin({
        optionRefiners: OPTION_REFINERS,
        viewContainerAppends: [buildLicenseWarning]
    });

    common.globalPlugins.push(plugin);

    exports.default = plugin;

    return exports;

}({}, FullCalendar));
