//
//  CacheManager.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 06/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import AFDateHelper

enum UDKeys: String {
    case cachedCustomers            = "cachedCustomers"
    case cachedCustomerGroup        = "cachedCustomerGroup"
    case cachedCustomerSource       = "cachedCustomerSource"
    case cachedEmployees            = "cachedEmployees"
    case cachedItems                = "cachedItems"
    case cachedVendors              = "cachedVendors"
    case cachedRoles                = "cachedRoles"
    case cachedTrac360Circles       = "cachedTrac360Circles"
    case cachedWorkOrderTypes       = "cachedWorkOrderTypes"
    
    var envPrefixed: String {
        return "\(App.shared.environment):\(self.rawValue)"
    }
}

class CacheManager: AppService {

    func loadLookupCaches() {
        // init group
        let group = DispatchGroup()
        
        // get myTrac360
        group.enter()
        App.shared.api.getTrac360Circles() { (list, error) in
            if let e = error {
                group.leave()
                return print(e.localizedDescription)
            }
            
            if list.count > 0 {
                App.shared.myTrac360Circle = list
                App.shared.selectedTrac360Circle = (list.count > 0) ? list.first! : nil
                
                // save to cache
                UserDefaults.standard.set(NSKeyedArchiver.archivedData(withRootObject: list), forKey: UDKeys.cachedTrac360Circles.envPrefixed)
                UserDefaults.standard.synchronize()
            }

            group.leave()
        }
        
        // get current attendance
        group.enter()
        App.shared.api.getUserTimesheet() { (result, error) in
            if let e = error {
                group.leave()
                return print(e.localizedDescription)
            }
            
            App.shared.userTimesheet = result
            
            NotificationCenter.default.post(name: Notifications.willUpdateTimesheetIcon, object: self, userInfo: nil)

            group.leave()
        }
        
        // get timesheet notification settings
        group.enter()
        App.shared.api.getTimesheetNotificationSetting() { (item, error) in
            if let e = error {
                group.leave()
                return print(e.localizedDescription)
            }
            
            // check
            if item != nil {
                App.shared.timesheetNotificationSettings = item
            }
            
            group.leave()
        }
        
        // get timesheet settings
        group.enter()
        App.shared.api.getTimesheetSetting() { (item, error) in
            if let e = error {
                group.leave()
                return print(e.localizedDescription)
            }
            
            // check
            if item != nil {
                App.shared.timesheetSettings = item
            }
            
            group.leave()
        }
        
        // get list of customers
        group.enter()
        App.shared.api.getCustomers() { (list, error) in
            if let e = error {
                group.leave()
                return print(e.localizedDescription)
            }
            
            // save to cache
            let data = NSKeyedArchiver.archivedData(withRootObject: list)
            UserDefaults.standard.set(data, forKey: UDKeys.cachedCustomers.envPrefixed)
            UserDefaults.standard.synchronize()
            
            group.leave()
        }
        
        // get list of customer groups
        group.enter()
        App.shared.api.getCustomerGroups() { (list, error) in
            if let e = error {
                group.leave()
                return print(e.localizedDescription)
            }
            
            // save to cache
            let data = NSKeyedArchiver.archivedData(withRootObject: list)
            UserDefaults.standard.set(data, forKey: UDKeys.cachedCustomerGroup.envPrefixed)
            UserDefaults.standard.synchronize()
            
            group.leave()
        }
        
        // get list of customer sources
        group.enter()
        App.shared.api.getCustomerSources() { (list, error) in
            if let e = error {
                group.leave()
                return print(e.localizedDescription)
            }
            
            // save to cache
            let data = NSKeyedArchiver.archivedData(withRootObject: list)
            UserDefaults.standard.set(data, forKey: UDKeys.cachedCustomerSource.envPrefixed)
            UserDefaults.standard.synchronize()
            
            group.leave()
        }
        
        // get list of items
        group.enter()
        App.shared.api.getItems() { (list, error) in
            if let e = error {
                group.leave()
                return print(e.localizedDescription)
            }
            
            // save to cache
            let data = NSKeyedArchiver.archivedData(withRootObject: list)
            UserDefaults.standard.set(data, forKey: UDKeys.cachedItems.envPrefixed)
            UserDefaults.standard.synchronize()
            
            group.leave()
        }
        
        // get list of vendors
        group.enter()
        App.shared.api.getVendors() { (list, error) in
            if let e = error {
                group.leave()
                return print(e.localizedDescription)
            }
            
            // save to cache
            let data = NSKeyedArchiver.archivedData(withRootObject: list)
            UserDefaults.standard.set(data, forKey: UDKeys.cachedVendors.envPrefixed)
            UserDefaults.standard.synchronize()
            
            group.leave()
        }
        
        // get list of employees
        group.enter()
        App.shared.api.getUsers() { (list, error) in
            if let e = error {
                group.leave()
                return print(e.localizedDescription)
            }
            
            // save to cache
            let data = NSKeyedArchiver.archivedData(withRootObject: list)
            UserDefaults.standard.set(data, forKey: UDKeys.cachedEmployees.envPrefixed)
            UserDefaults.standard.synchronize()
            
            group.leave()
        }
        
        // get list of roles
        group.enter()
        App.shared.api.getRoles() { (list, error) in
            if let e = error {
                group.leave()
                return print(e.localizedDescription)
            }
            
            // save to cache
            let data = NSKeyedArchiver.archivedData(withRootObject: list)
            UserDefaults.standard.set(data, forKey: UDKeys.cachedRoles.envPrefixed)
            UserDefaults.standard.synchronize()
            
            group.leave()
        }
        
        // get list of work order types
        group.enter()
        App.shared.api.getWorkOrderTypes() { (list, error) in
            if let e = error {
                group.leave()
                return print(e.localizedDescription)
            }
            
            // save to cache
            let data = NSKeyedArchiver.archivedData(withRootObject: list)
            UserDefaults.standard.set(data, forKey: UDKeys.cachedWorkOrderTypes.envPrefixed)
            UserDefaults.standard.synchronize()
            
            group.leave()
        }
    }
    
    func loadCachedItems() -> [Item] {
        if let data = UserDefaults.standard.value(forKey: UDKeys.cachedItems.envPrefixed) as? Data {
            let json = NSKeyedUnarchiver.unarchiveObject(with: data) as? [Item]
            return json!
        }
        return []
    }
    
    func loadCachedVendors() -> [Vendor] {
        if let data = UserDefaults.standard.value(forKey: UDKeys.cachedVendors.envPrefixed) as? Data {
            let json = NSKeyedUnarchiver.unarchiveObject(with: data) as? [Vendor]
            return json!
        }
        return []
    }
    
    func loadCachedCustomers() -> [Customer] {
        if let data = UserDefaults.standard.value(forKey: UDKeys.cachedCustomers.envPrefixed) as? Data {
            let json = NSKeyedUnarchiver.unarchiveObject(with: data) as? [Customer]
            return json!
        }
        return []
    }
    
    func loadCachedCustomerGroups() -> [CustomerGroup] {
        if let data = UserDefaults.standard.value(forKey: UDKeys.cachedCustomerGroup.envPrefixed) as? Data {
            let json = NSKeyedUnarchiver.unarchiveObject(with: data) as? [CustomerGroup]
            return json!
        }
        return []
    }
    
    func loadCachedCustomerSources() -> [CustomerSource] {
        if let data = UserDefaults.standard.value(forKey: UDKeys.cachedCustomerSource.envPrefixed) as? Data {
            let json = NSKeyedUnarchiver.unarchiveObject(with: data) as? [CustomerSource]
            return json!
        }
        return []
    }
    
    func loadCachedEmployees() -> [User] {
        if let data = UserDefaults.standard.value(forKey: UDKeys.cachedEmployees.envPrefixed) as? Data {
            let json = NSKeyedUnarchiver.unarchiveObject(with: data) as? [User]
            return json!
        }
        return []
    }
    
    func loadCachedRoles() -> [Role] {
        if let data = UserDefaults.standard.value(forKey: UDKeys.cachedRoles.envPrefixed) as? Data {
            let json = NSKeyedUnarchiver.unarchiveObject(with: data) as? [Role]
            return json!
        }
        return []
    }
    
    func loadCachedTrac360Circles() -> [Trac360Circle] {
        if let data = UserDefaults.standard.value(forKey: UDKeys.cachedTrac360Circles.envPrefixed) as? Data {
            let json = NSKeyedUnarchiver.unarchiveObject(with: data) as? [Trac360Circle]
            return json!
        }
        return []
    }
    
    func loadCachedWorkOrderTypes() -> [WorkOrderType] {
        if let data = UserDefaults.standard.value(forKey: UDKeys.cachedWorkOrderTypes.envPrefixed) as? Data {
            let json = NSKeyedUnarchiver.unarchiveObject(with: data) as? [WorkOrderType]
            return json!
        }
        return []
    }
}
