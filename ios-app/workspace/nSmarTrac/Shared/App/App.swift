//
//  App.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 06/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import Alamofire
import CoreLocation
import FontAwesome_swift

enum LeftMenu: String {
    case Login
    case Home
    case Customers
    case QuickLinks
    case BusinessContacts
    case Leads
    case Tasks
    case Inventory
    case Calculator
    case Estimator
    case Expenses
    case Notification
    case MyBusiness
    case MyAccount
    case Settings
    
    case Dashboard
    case WeatherForecast
    case Schedule
    case Accounting
    case WorkOrder
    case FileVault
    case eSign
    case Bulletin
    case Invoices
    case Reports
    case RoutePlanner
    case Marketing
    case Employees
    case Trac360
    case CollageMaker
    case Estimates
    case CostEstimator
    case VirtualEstimator
    case TimeClock
    
    case Chat
    case Messages
}

class App {
    
    enum Environment {
        case production
        case staging
    }
    
    /// Our one and only Singleton object.
    static let shared = App()
    
    fileprivate(set) var api: APIClient!
    fileprivate(set) var appUser: AppUser!
    fileprivate(set) var cache: CacheManager!
    fileprivate(set) var reachability: NetworkReachabilityManager!
    
    private(set) var environment: Environment = .staging
    
    var appearance: String = "Light"
    var iconColor: UIColor = UIColor.purple
    var headerColor: UIColor = UIColor.purple
    var headerBgColor: UIColor = UIColor.purpleLightOpaque
    
    var userLocation: CLLocation? = nil
    var userLocationAddress: String? = nil
    var selectedMenu: LeftMenu? = nil
    var user: User? = nil
    var companyId: Int = 0
    var company: BusinessProfile? = nil
    var logoKey: String = ""
    var bannerKey: String = ""
    
    var selectedCustomer: Customer? = nil
    var selectedLead: Lead? = nil
    var selectedEstimate: Estimate? = nil
    var selectedWorkOrder: WorkOrder? = nil
    var selectedInvoice: Invoice? = nil
    var selectedEvent: Event? = nil
    var userTimesheet: TimesheetTeamMember? = nil
    var timesheetNotificationSettings: TimesheetNotificationSetting? = nil
    var timesheetSettings: TimesheetSetting? = nil
    var myTrac360Circle: [Trac360Circle] = []
    var selectedTrac360Circle: Trac360Circle? = nil
    var selectedTrac360People: Trac360People? = nil
    
    var dateFormatter: DateFormatter = {
        let formatter = DateFormatter()
        formatter.dateFormat = "yyyy-MM-dd"
        return formatter
    }()
    
    var dateTimeFormatter: DateFormatter = {
        let formatter = DateFormatter()
        formatter.dateFormat = "yyyy-MM-dd HH:mm:ss"
        return formatter
    }()
    
    var timeFormatter: DateFormatter = {
        let formatter = DateFormatter()
        formatter.dateFormat = "h:mm a"
        return formatter
    }()
    
    var time24Formatter: DateFormatter = {
        let formatter = DateFormatter()
        formatter.dateFormat = "HH:mm:ss"
        return formatter
    }()
    
    var documentDateFormatter: DateFormatter = {
        let formatter = DateFormatter()
        formatter.dateFormat = "M/d/yyyy"
        return formatter
    }()
    
    var scanDateFormatter: DateFormatter = {
        let formatter = DateFormatter()
        formatter.dateFormat = "MMM dd yyyy hh:mm:ss a"
        return formatter
    }()
    
    var signedDateFormatter: DateFormatter = {
        let formatter = DateFormatter()
        formatter.dateFormat = "MMM dd, yyyy"
        return formatter
    }()
    
    var timesheetDateTimeFormatter: DateFormatter = {
        let formatter = DateFormatter()
        formatter.dateFormat = "yyyy-MM-dd hh:mm a"
        return formatter
    }()
    
    var monthDateFormatter: DateFormatter = {
        let formatter = DateFormatter()
        formatter.dateFormat = "MMM d"
        return formatter
    }()
    
    var toHourFormatter: DateComponentsFormatter = {
        let formatter = DateComponentsFormatter()
        formatter.unitsStyle = .positional
        formatter.allowedUnits = [.hour, .minute, .second]
        return formatter
    }()
    
    var toAbbreviatedHourFormatter: DateComponentsFormatter = {
        let formatter = DateComponentsFormatter()
        formatter.unitsStyle = .abbreviated
        formatter.allowedUnits = [.hour, .minute]
        return formatter
    }()
    
    var breakHourFormatter: DateComponentsFormatter = {
        let formatter = DateComponentsFormatter()
        formatter.unitsStyle = .abbreviated
        formatter.allowedUnits = [.hour, .minute, .second]
        return formatter
    }()
    
    
    init(){
        reachability = NetworkReachabilityManager(host: "www.apple.com")!
    }

    func bootstrap(with application: UIApplication, launchOptions: [UIApplication.LaunchOptionsKey : Any]?) {
        
        api = APIClient()
        appUser = AppUser()
        cache = CacheManager()
        
        FontAwesomeConfig.usesProFonts = true
        
        if !appUser.isGuest() {
            appUser.refreshUser()
            cache.loadLookupCaches()
        }
    }
}

extension AppService {
    
    var app: App {
        return App.shared
    }
    
}
