//
//  Helpers.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 18/07/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation

class Helpers {

    // VENDOR
    public static func getVendorId(_ name: String) -> Int {
        if let selected = App.shared.cache.loadCachedVendors().first(where: { $0.vendor_name == name }) {
            return selected.vendor_id.intValue
        }
        return 0
    }
    public static func getVendorById(_ id: String) -> Vendor? {
        if let selected = App.shared.cache.loadCachedVendors().first(where: { $0.vendor_id == id }) {
            return selected
        }
        return nil
    }
    public static func getVendors() -> [String] {
        let items: [String] = App.shared.cache.loadCachedVendors().map { (item) -> String in
            return String(format: "%@", item.vendor_name)
        }
        
        var newOptions: [String] = ["-select-"]
        newOptions.append(contentsOf: items)
        
        return newOptions
    }
    
    // CUSTOMER
    public static func getCustomerId(_ name: String) -> Int {
        if let selected = App.shared.cache.loadCachedCustomers().first(where: { $0.contact_name == name }) {
            return selected.id.intValue
        }
        return 0
    }
    public static func getCustomerById(_ id: String) -> Customer? {
        if let selected = App.shared.cache.loadCachedCustomers().first(where: { $0.id == id }) {
            return selected
        }
        return nil
    }
    
    // CUSTOMER GROUP
    public static func getCustomerGroupId(_ name: String) -> Int {
        if let selected = App.shared.cache.loadCachedCustomerGroups().first(where: { $0.name == name }) {
            return selected.id.intValue
        }
        return 0
    }
    public static func getCustomerGroupById(_ id: String) -> CustomerGroup? {
        if let selected = App.shared.cache.loadCachedCustomerGroups().first(where: { $0.id == id }) {
            return selected
        }
        return nil
    }
    
    // CUSTOMER SOURCE
    public static func getCustomerSourceId(_ name: String) -> Int {
        if let selected = App.shared.cache.loadCachedCustomerSources().first(where: { $0.name == name }) {
            return selected.id.intValue
        }
        return 0
    }
    public static func getCustomerSourceById(_ id: String) -> CustomerSource? {
        if let selected = App.shared.cache.loadCachedCustomerSources().first(where: { $0.id == id }) {
            return selected
        }
        return nil
    }
    

    // EMPLOYEE
    public static func getEmployeeId(_ name: String) -> Int {
        if let selected = App.shared.cache.loadCachedEmployees().first(where: { $0.full_name == name }) {
            return selected.id.intValue
        }
        return 0
    }
    public static func getEmployeeById(_ id: String) -> User? {
        if let selected = App.shared.cache.loadCachedEmployees().first(where: { $0.id == id }) {
            return selected
        }
        return nil
    }
    public static func getEmployees() -> [String] {
        let items: [String] = App.shared.cache.loadCachedEmployees().map { (item) -> String in
            return String(format: "%@", item.full_name)
        }
        
        var newOptions: [String] = ["All Employees"]
        newOptions.append(contentsOf: items)
        
        return newOptions
    }
    
    // ROLE
    public static func getRoleId(_ name: String) -> Int {
        if let selected = App.shared.cache.loadCachedRoles().first(where: { $0.title == name }) {
            return selected.id.intValue
        }
        return 0
    }
    public static func getRoleById(_ id: String) -> Role? {
        if let selected = App.shared.cache.loadCachedRoles().first(where: { $0.id == id }) {
            return selected
        }
        return nil
    }
    public static func getRoles() -> [String] {
        let items: [String] = App.shared.cache.loadCachedRoles().map { (item) -> String in
            return String(format: "%@", item.title)
        }
        
        var newOptions: [String] = ["-select-"]
        newOptions.append(contentsOf: items)
        
        return newOptions
    }
    
    // WORK ORDER TYPES
    public static func getWorkOrderTypeId(_ name: String) -> Int {
        if let selected = App.shared.cache.loadCachedWorkOrderTypes().first(where: { $0.name == name }) {
            return selected.id.intValue
        }
        return 0
    }
    public static func getWorkOrderTypeById(_ id: String) -> WorkOrderType? {
        if let selected = App.shared.cache.loadCachedWorkOrderTypes().first(where: { $0.id == id }) {
            return selected
        }
        return nil
    }
    public static func getWorkOrderTypes() -> [String] {
        let items: [String] = App.shared.cache.loadCachedWorkOrderTypes().map { (item) -> String in
            return String(format: "%@", item.name)
        }
        
        var newOptions: [String] = ["-select-"]
        newOptions.append(contentsOf: items)
        
        return newOptions
    }

}
