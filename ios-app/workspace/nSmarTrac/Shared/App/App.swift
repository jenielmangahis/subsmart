//
//  App.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 06/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import Alamofire
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
    case Map
    case Calculator
    case Estimator
    case Expenses
    case Notification
    case MyInfo
    case Settings
    case CompanyProfile
    
    case Schedule
    case WorkOrder
    case Bulletin
    case Invoices
    case Reports
    case RoutePlanner
    case Marketing
}

class App {
    
    enum Environment {
        case production
        case staging
    }
    
    /// Our one and only Singleton object.
    static let shared = App()
    
    fileprivate(set) var api: APIClient!
    fileprivate(set) var user: AppUser!
    fileprivate(set) var cache: CacheManager!
    fileprivate(set) var reachability: NetworkReachabilityManager!
    
    private(set) var environment: Environment = .staging
    
    var selectedMenu: LeftMenu? = nil
    
    
    init(){
        reachability = NetworkReachabilityManager(host: "www.apple.com")!
    }

    func bootstrap(with application: UIApplication, launchOptions: [UIApplication.LaunchOptionsKey : Any]?) {
        
        api = APIClient()
        user = AppUser()
        cache = CacheManager()
        
        FontAwesomeConfig.usesProFonts = true
        
        /*if !user.isGuest() {
            user.refreshUser()
        }*/
    }
}

extension AppService {
    
    var app: App {
        return App.shared
    }
    
}
