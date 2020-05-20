//
//  AppUser.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 06/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import ObjectMapper

class AppUser: AppService {
    
    //private(set) var token: OAuthToken?
    //private(set) var user: User?
    
    /// Keys associated with UserDefaults values.
    private enum UDKeys: String {
        case token = "token"
        case user = "user"
        
        var envPrefixed: String {
            return "\(App.shared.environment):\(self.rawValue)"
        }
    }
    
    override init() {
        super.init()
        
        /*if let userData = UserDefaults.standard.value(forKey: UDKeys.user.envPrefixed) as? NSData {
            user = NSKeyedUnarchiver.unarchiveObject(with: userData as Data) as? User
            updateUser(user)
        }
        if let tokenData = UserDefaults.standard.value(forKey: UDKeys.token.envPrefixed) as? NSData {
            token = NSKeyedUnarchiver.unarchiveObject(with: tokenData as Data) as? OAuthToken
            updateToken(token)
        }*/
    }
    
    /*private func deleteCachedData() {
        let domain = Bundle.main.bundleIdentifier!
        UserDefaults.standard.removePersistentDomain(forName: domain)
        UserDefaults.standard.synchronize()
    }
    
    private func updateToken(_ token: OAuthToken?) {
        // update cached token
        self.token = token!
        let data = NSKeyedArchiver.archivedData(withRootObject: token!)
        UserDefaults.standard.set(data, forKey: UDKeys.token.envPrefixed)
        UserDefaults.standard.synchronize()
    }
    
    private func updateUser(_ user: User?) {
        // update cache user
        self.user = user
        let data = NSKeyedArchiver.archivedData(withRootObject: user!)
        UserDefaults.standard.set(data, forKey: UDKeys.user.envPrefixed)
        UserDefaults.standard.synchronize()
    }
    
    func isGuest() -> Bool {
        return user == nil
    }
    
    func getUser() -> User {
        return self.user!
    }
    
    func getCompany() -> Company {
        return (self.user!.company)!
    }
    
    func getToken() -> OAuthToken {
        return self.token!
    }
    
    func login(email: String, password: String, completion: @escaping (_ success: Bool, _ error: NSError?) -> Void) {
        
        NotificationCenter.default.post(name: Notifications.willLogin, object: self, userInfo: nil)
        
        app.api.postLogin(email: email, password: password) { (response, error) in
            guard error == nil else {
                return completion(false, error)
            }
            
            self.updateToken(response?.OAuth!)
            self.updateUser(response?.Data!)
            
            App.shared.currencyCode     = self.getCompany().currency_code
            App.shared.currencySymbol   = Utils.getCurrencySymbol(self.getCompany().currency_code)
            App.shared.taxRate          = self.getCompany().tax_rate.doubleValue
            
            // look data to cache
            App.shared.cache.loadLookupCaches()
            
            completion(true, nil)
            
            NotificationCenter.default.post(name: Notifications.didLogin, object: self, userInfo: nil)
        }
    }
    
    func logout() {
        NotificationCenter.default.post(name: Notifications.willLogout, object: self, userInfo: nil)
        
        self.user = nil
        deleteCachedData()
        
        NotificationCenter.default.post(name: Notifications.didLogout, object: self, userInfo: nil)
    }
    
    func updateFCMToken(_ token: String?) {
        // check if user is not nil
        guard self.user != nil else {
            return print("Must login to use this service...")
        }
        
        // check if fcmToken is not nil
        guard token != nil else {
            return Utils.shared.showAlertWithMessage(message: "You must enable the push Notification to use this service...")
        }
        
        let params: Parameters = ["fcm_token": token!,
                                  "device_type": "iOS"]
        
        App.shared.api.putUser(self.user!.user_id, params: params) { (success, error) in
            guard error == nil else {
                return print(error?.localizedDescription as Any)
            }
            
            print("UPDATING TOKEN: \(success)")
        }
    }
    
    func refreshToken() {
        // refresh token
        App.shared.api.refreshToken() { (token, error) in
            guard error == nil else {
                return print(error?.localizedDescription as Any)
            }
            
            self.updateToken(token!)
            
            // look data to cache
            App.shared.cache.loadLookupCaches()
        }
    }
    
    func refreshUser() {
        // call api
        App.shared.api.getUser(self.user!.user_id) { (user, error) in
            guard error == nil else {
                return print(error?.localizedDescription as Any)
            }
            
            self.updateUser(user)
            
            App.shared.currencyCode     = self.getCompany().currency_code
            App.shared.currencySymbol   = Utils.getCurrencySymbol(self.getCompany().currency_code)
            App.shared.taxRate          = self.getCompany().tax_rate.doubleValue
        }
    }*/

}
