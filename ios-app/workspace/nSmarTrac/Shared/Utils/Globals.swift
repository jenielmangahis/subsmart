//
//  Globals.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 04/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import AFDateHelper

struct Global {
    static let brandingText = "Powered by nSmarTrac.com"
}

struct AppTheme {
    static let defaultColor = UIColor.purple
    static let defaultLinkColor = UIColor.lightPurple
    static let defaultLightOpaque = UIColor.purpleLightOpaque
    static let defaultMidOpaque = UIColor.purpleMidOpaque
}

struct Notifications {
    static let didSwitchLeftMenu = Notification.Name("com.nsmartrac.notification.name.didSwitchLeftMenu")
    static let willLogin = Notification.Name("com.nsmartrac.notification.name.willLogin")
    static let didLogin = Notification.Name("com.nsmartrac.notification.name.didLogin")
    static let willLogout = Notification.Name("com.nsmartrac.notification.name.willLogout")
    static let didLogout = Notification.Name("com.nsmartrac.notification.name.didLogout")
    
    static let didLocationEnabled = Notification.Name("com.nsmartrac.notification.name.didLocationEnabled")
    
    static let willUpdateDropboxFiles = Notification.Name("com.nsmartrac.notification.name.willUpdateDropboxFiles")
    
    static let willAddStandardEstimates = Notification.Name("com.nsmartrac.notification.name.willAddStandardEstimates")
    static let willAddOptionsEstimates = Notification.Name("com.nsmartrac.notification.name.willAddOptionsEstimates")
    
    static let willOpenEstimatePreview = Notification.Name("com.nsmartrac.notification.name.willOpenEstimatePreview")
    static let willOpenWorkOrderPreview = Notification.Name("com.nsmartrac.notification.name.willOpenWorkOrderPreview")
    static let willOpenInvoicePreview = Notification.Name("com.nsmartrac.notification.name.willOpenInvoicePreview")
    static let willEditEstimate = Notification.Name("com.nsmartrac.notification.name.willEditEstimate")
    static let willEditWorkOrder = Notification.Name("com.nsmartrac.notification.name.willEditWorkOrder")
    static let willEditInvoice = Notification.Name("com.nsmartrac.notification.name.willEditInvoice")
    
    static let willUpdateHomeBulletin = Notification.Name("com.nsmartrac.notification.name.willUpdateHomeBulletin")
    static let willOpenBulletinLink = Notification.Name("com.nsmartrac.notification.name.willOpenBulletinLink")
    
    static let willAddSignature = Notification.Name("com.nsmartrac.notification.name.willAddSignature")
    static let willAddInitials = Notification.Name("com.nsmartrac.notification.name.willAddInitials")
    static let willAddDate = Notification.Name("com.nsmartrac.notification.name.willAddDate")
    static let willAddName = Notification.Name("com.nsmartrac.notification.name.willAddName")
    static let willAddFirstName = Notification.Name("com.nsmartrac.notification.name.willAddFirstName")
    static let willAddLastName = Notification.Name("com.nsmartrac.notification.name.willAddLastName")
    static let willAddEmail = Notification.Name("com.nsmartrac.notification.name.willAddEmail")
    static let willAddCompany = Notification.Name("com.nsmartrac.notification.name.willAddCompany")
    static let willAddTitle = Notification.Name("com.nsmartrac.notification.name.willAddTitle")
    static let willAddText = Notification.Name("com.nsmartrac.notification.name.willAddText")
    static let willAddCheckbox = Notification.Name("com.nsmartrac.notification.name.willAddCheckbox")
    
    static let willUpdateTimesheet = Notification.Name("com.nsmartrac.notification.name.willUpdateTimesheet")
    static let willUpdateTimesheetIcon = Notification.Name("com.nsmartrac.notification.name.willUpdateTimesheetIcon")
}

struct Device {
    static let width = UIScreen.main.bounds.width
    static let height = UIScreen.main.bounds.height
}

struct DateHelper {
    static let dateFormatType = DateFormatType.custom("yyyy-MM-dd")
    static let dateTimeFormatType = DateFormatType.custom("yyyy-MM-dd hh:mm:ss")
    static let dateTime2FormatType = DateFormatType.custom("yyyy-MM-dd hh:mm a")
    static let dateReadableFormatType = DateFormatType.custom("dd MMM yyyy")
    static let dateTimeReadableFormatType = DateFormatType.custom("dd MMM yyyy, hh:mm a")
}

struct EventColor {
    static let defaultColor = UIColor(hex: "#4cb052")
    static let redColor = UIColor(hex: "#d96666")
    static let pinkColor = UIColor(hex: "#e67399")
    static let magentaColor = UIColor(hex: "#b373b3")
    static let purpleColor = UIColor(hex: "#8c66d9")
    static let blueColor = UIColor(hex: "#668cd9")
    static let tealColor = UIColor(hex: "#59bfb3")
    static let greenColor = UIColor(hex: "#65ad89")
    static let goldColor = UIColor(hex: "#f2a640")
    static let colors = ["#4cb052", "#d96666", "#e67399", "#b373b3", "#8c66d9", "#668cd9", "#59bfb3", "#65ad89", "#f2a640"]
}
