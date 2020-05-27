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
    
    static let willAddStandardEstimates = Notification.Name("com.nsmartrac.notification.name.willAddStandardEstimates")
    static let willAddOptionsEstimates = Notification.Name("com.nsmartrac.notification.name.willAddOptionsEstimates")
}

struct Device {
    static let width = UIScreen.main.bounds.width
    static let height = UIScreen.main.bounds.height
}

struct DateHelper {
    static let dateFormatType = DateFormatType.custom("MM.dd.yyyy")
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
}
