//
//  AppDelegate.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 04/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

// do this before working in a day
// cd /Users/jonah/GIT/ADi/nsmartrac
// git checkout jonah_staging
// git pull origin staging

import UIKit
import Alamofire
import CoreLocation
import Firebase
import FirebaseInstanceID
import FirebaseMessaging
import GooglePlaces
import GoogleSignIn
import MapKit
import SVProgressHUD
import SwiftyDropbox

@UIApplicationMain
class AppDelegate: UIResponder, UIApplicationDelegate, UNUserNotificationCenterDelegate, MessagingDelegate {

    var window: UIWindow?
    var myOrientation: UIInterfaceOrientationMask = .portrait
    
    let locationManager = CLLocationManager()


    func application(_ application: UIApplication, didFinishLaunchingWithOptions launchOptions: [UIApplication.LaunchOptionsKey: Any]?) -> Bool {
        // Override point for customization after application launch.
        
        // check
        if let appearance = UserDefaults.standard.string(forKey: "APPEARANCE"), appearance == "DARK" {
            UIApplication.shared.windows.forEach { window in
                window.overrideUserInterfaceStyle = .dark
                App.shared.appearance = "Dark"
                App.shared.iconColor = .white
                App.shared.headerColor = .white
                App.shared.headerBgColor = .whiteLightOpaque
            }
        } else {
            UIApplication.shared.windows.forEach { window in
                window.overrideUserInterfaceStyle = .light
                App.shared.appearance = "Light"
            }
        }
        
        // customized
        UINavigationBar.appearance().backgroundColor        = AppTheme.defaultColor
        UINavigationBar.appearance().barTintColor           = AppTheme.defaultColor
        UINavigationBar.appearance().isTranslucent          = false
        UINavigationBar.appearance().tintColor              = UIColor.white
        UINavigationBar.appearance().titleTextAttributes    = [NSAttributedString.Key.foregroundColor: UIColor.white, NSAttributedString.Key.font: UIFont.robotoBoldFont(ofSize: 20)]
        UIBarButtonItem.appearance().setTitleTextAttributes([NSAttributedString.Key.font: UIFont.robotoFont(ofSize: 14)], for: .normal)
        UIBarButtonItem.appearance().setTitleTextAttributes([NSAttributedString.Key.foregroundColor: UIColor.white], for: .normal)
        UIToolbar.appearance().tintColor                    = App.shared.iconColor
        UIToolbar.appearance().backgroundColor              = AppTheme.defaultColor
        UITabBar.appearance().tintColor                     = App.shared.iconColor
        
        SVProgressHUD.setBackgroundColor(.lightGray)
        
        
        App.shared.bootstrap(with: application, launchOptions: launchOptions)
        App.shared.reachability.startListening()
        
        // Firebase
        FirebaseApp.configure()
        Messaging.messaging().delegate = self
        
        if #available(iOS 10.0, *) {
          // For iOS 10 display notification (sent via APNS)
          UNUserNotificationCenter.current().delegate = self

          let authOptions: UNAuthorizationOptions = [.alert, .badge, .sound]
          UNUserNotificationCenter.current().requestAuthorization(options: authOptions, completionHandler: {_, _ in })
        } else {
          let settings: UIUserNotificationSettings = UIUserNotificationSettings(types: [.alert, .badge, .sound], categories: nil)
          application.registerUserNotificationSettings(settings)
        }

        application.registerForRemoteNotifications()
        
        // Google Places
        GMSPlacesClient.provideAPIKey("AIzaSyBK803I2sEIkUtnUPJqmyClYQy5OVV7-E4")
        
        // Google Sign-in
        GIDSignIn.sharedInstance().clientID = "906795567105-29dpbl16ikqompu4ddflmeobl255ul1r.apps.googleusercontent.com"
        
        // Dropbox
        DropboxClientsManager.setupWithAppKey("yr72ccr2b8243i8") // s4qcxem741pyihj (personal)
        
        // Sample chat
        if UserDefaults.isFirstLaunch() {
            // Enable Text Messages
            UserDefaults.standard.set(true, forKey: "Text Messages")
        }
        
        
        initiateLocation()
        updateRootViewController()
        setupNotificationObservers()
        
        return true
    }
    
    // Deal the push when the application in the background
    func messaging(_ messaging: Messaging, didReceiveRegistrationToken fcmToken: String) {
        print("Firebase registration token: \(fcmToken)")
        
        let UUID = UIDevice.current.identifierForVendor!.uuidString
        print("UUID: \(UUID)")
        
        // handle nil
        if let user = App.shared.user {
            // params
            let params: Parameters = ["device_token": fcmToken,
                                      "device_uuid": UUID,
                                      "device_type": "iOS"]
            
            // update users table to save uuid
            App.shared.api.putUser(user.id.intValue, params: params) { (success, error) in
                guard error == nil else {
                    return print(error?.localizedDescription as Any)
                }
                guard success == true else {
                    return print("Saving data failed!")
                }
                print("FCM details saved...")
            }
        }
        
    }
    
    // Push notification received
    func application(_ application: UIApplication, didReceiveRemoteNotification userInfo: [AnyHashable : Any]) {
        // Print notification payload data
        print("Push notification received: \(userInfo)")
        
        let aps = userInfo["aps"] as! [String: Any]
        let alert = aps["alert"] as! [String: Any]
        
        // display in alert
        Utils.shared.showAlertWithMessage(title: alert["title"] as! String, message: alert["body"] as! String)
    }
    
    // Swizzling disabled: mapping your APNs token and registration token
    func application(_ application: UIApplication, didRegisterForRemoteNotificationsWithDeviceToken deviceToken: Data) {
        Messaging.messaging().apnsToken = deviceToken
    }
    
    // The callback to handle data message received via FCM for devices running iOS 10 or above.
    func application(received remoteMessage: MessagingRemoteMessage) {
        print(remoteMessage)
    }

    func applicationWillResignActive(_ application: UIApplication) {
        App.shared.reachability.stopListening()
    }
    
    func applicationDidEnterBackground(_ application: UIApplication) {
        App.shared.reachability.stopListening()
    }

    func applicationWillEnterForeground(_ application: UIApplication) {
        App.shared.reachability.startListening()
        initiateLocation()
    }

    func applicationDidBecomeActive(_ application: UIApplication) {
        // reset badge
        UIApplication.shared.applicationIconBadgeNumber = 0
        
        App.shared.reachability.startListening()
        initiateLocation()
    }

    func applicationWillTerminate(_ application: UIApplication) {}
    
    func application(_ application: UIApplication, supportedInterfaceOrientationsFor window: UIWindow?) -> UIInterfaceOrientationMask {
        return myOrientation
    }
    
    func application(_ app: UIApplication, open url: URL, options: [UIApplication.OpenURLOptionsKey : Any]) -> Bool {
        // Dropbox
        if let authResult = DropboxClientsManager.handleRedirectURL(url) {
            switch authResult {
            case .success(let token):
                NotificationCenter.default.post(name: Notifications.willUpdateDropboxFiles, object: self, userInfo: nil)
                break
            case .cancel:
                print("The process has been cancelled!")
                break
            case .error(let error, let description):
                print(error, description)
                break
            }
            
            return false
        }
        
        // GIDSignIn
        return GIDSignIn.sharedInstance().handle(url) ?? false
    }


}

// MARK: - CLLocation -

extension AppDelegate: CLLocationManagerDelegate {
    
    func initiateLocation() {
        // initiate the map
        if CLLocationManager.locationServicesEnabled() == true {
            if CLLocationManager.authorizationStatus() != .authorizedAlways {
                locationManager.requestAlwaysAuthorization()
            }
            
            locationManager.desiredAccuracy = kCLLocationAccuracyBest
            locationManager.delegate = self
            locationManager.startUpdatingLocation()
        } else {
            print("Please turn on location services or GPS")
            
            // check if not nil
            if UserDefaults.standard.object(forKey: "LOCATION_PERMISSION_OFF") == nil ||
                UserDefaults.standard.object(forKey: "LOCATION_PERMISSION_OFF") as! Bool == false {
                
                // handle nil
                if let user = App.shared.user {
                    // update db that user's location permission is disabled
                    let params: Parameters = ["is_location_off": 1,
                                              "last_tracked_location_date": App.shared.dateTimeFormatter.string(from: Date())]
                    
                    App.shared.api.putTrac360People(user.id.intValue, params: params) { (success, error) in
                        guard error == nil else {
                            return print(error?.localizedDescription as Any)
                        }
                        print("Location permission was disabled...")
                        
                        // save to user defaults
                        UserDefaults.standard.set(true, forKey: "LOCATION_PERMISSION_OFF")
                        UserDefaults.standard.synchronize()
                    }
                }
            }
        }
    }
    
    func locationManager(_ manager: CLLocationManager, didUpdateLocations locations: [CLLocation]) {
        self.locationManager.stopUpdatingLocation()
        
        // check
        if let location = locations.first {
            // set location
            App.shared.userLocation = location
            
            // geocode location
            CLGeocoder().reverseGeocodeLocation(location) { (placemarks, error) in
                if let placemark = placemarks?.first {
                    let address = [(placemark.name != placemark.postalCode) ? (placemark.name ?? "") :( placemark.subLocality ?? ""), placemark.locality ?? "", placemark.administrativeArea ?? "", placemark.postalCode ?? "", placemark.country ?? ""]
                    
                    // set address
                    App.shared.userLocationAddress = address.filter { !$0.isEmpty }.joined(separator: ", ")
                    
                    // send notification to screen that has maps
                    NotificationCenter.default.post(name: Notifications.didLocationEnabled, object: self, userInfo: nil)
                    
                    
                    // init address
                    let coordinates = "\(location.coordinate.latitude),\(location.coordinate.longitude)"
                    var locationAddress = ""
                    
                    // get address
                    if let name = placemark.name,
                       let postalCode = placemark.postalCode,
                       name != postalCode {
                        locationAddress = name
                    } else if let subLocality = placemark.subLocality {
                        locationAddress = subLocality
                    } else {
                        locationAddress = placemark.administrativeArea!
                    }
                    
                    // handle nil
                    if let user = App.shared.user {
                        // update track location
                        let params: Parameters = ["is_location_off": 0,
                                                  "last_tracked_location": coordinates,
                                                  "last_tracked_location_address": locationAddress,
                                                  "last_tracked_location_date": App.shared.dateTimeFormatter.string(from: Date())]
                        
                        App.shared.api.putTrac360People(user.id.intValue, params: params) { (success, error) in
                            guard error == nil else {
                                return print(error?.localizedDescription as Any)
                            }
                            print("Location is saved...")
                            
                            // save to user defaults
                            UserDefaults.standard.set(false, forKey: "LOCATION_PERMISSION_OFF")
                            UserDefaults.standard.synchronize()
                        }
                    }
                }
            }
        }
    }
    
    func locationManager(_ manager: CLLocationManager, didFailWithError error: Error) {
        print("Unable to access your current location")
    }
}

extension UIWindow {
    /// Fix for http://stackoverflow.com/a/27153956/849645
    func set(rootViewController newRootViewController: UIViewController, withTransition transition: CATransition? = nil) {
        
        let previousViewController = rootViewController
        
        if let transition = transition {
            // Add the transition
            layer.add(transition, forKey: kCATransition)
        }
        
        rootViewController = newRootViewController
        
        // Update status bar appearance using the new view controllers appearance - animate if needed
        if UIView.areAnimationsEnabled {
            UIView.animate(withDuration: CATransaction.animationDuration()) {
                newRootViewController.setNeedsStatusBarAppearanceUpdate()
            }
        } else {
            newRootViewController.setNeedsStatusBarAppearanceUpdate()
        }
        
        if #available(iOS 13.0, *) {
            // In iOS 13 we don't want to remove the transition view as it'll create a blank screen
        } else {
            // The presenting view controllers view doesn't get removed from the window as its currently transistioning and presenting a view controller
            if let transitionViewClass = NSClassFromString("UITransitionView") {
                for subview in subviews where subview.isKind(of: transitionViewClass) {
                    subview.removeFromSuperview()
                }
            }
        }
        
        if let previousViewController = previousViewController {
            // Allow the view controller to be deallocated
            previousViewController.dismiss(animated: false) {
                // Remove the root view in case its still showing
                previousViewController.view.removeFromSuperview()
            }
        }
    }
}

// fileprivate
extension AppDelegate {
    
    func updateRootViewController() {
        
        if App.shared.selectedMenu == .Home {
            switchToHome()
        } else if App.shared.selectedMenu == .Customers {
            switchToCustomers()
        } else if App.shared.selectedMenu == .QuickLinks {
            switchToQuickLinks()
        } else if App.shared.selectedMenu == .BusinessContacts {
            switchToContacts()
        } else if App.shared.selectedMenu == .Leads {
            switchToLeads()
        } else if App.shared.selectedMenu == .Inventory {
            switchToInventory()
        } else if App.shared.selectedMenu == .Notification {
            switchToNotifications()
        } else if App.shared.selectedMenu == .MyBusiness {
            switchToMyBusiness()
        } else if App.shared.selectedMenu == .MyAccount {
            switchToMyAccount()
        } else if App.shared.selectedMenu == .Settings {
            switchToSettings()
        } else if App.shared.selectedMenu == .Login {
            switchToLogin()
        } else if App.shared.selectedMenu == .Dashboard {
            switchToDashboard()
        } else if App.shared.selectedMenu == .WeatherForecast {
            switchToWeatherForecast()
        } else if App.shared.selectedMenu == .Schedule {
            switchToCalendar()
        } else if App.shared.selectedMenu == .WorkOrder {
            switchToWorkOrder()
        } else if App.shared.selectedMenu == .Tasks {
            switchToTasks()
        } else if App.shared.selectedMenu == .FileVault {
            switchToFileVault()
        } else if App.shared.selectedMenu == .eSign {
            switchToESign()
        } else if App.shared.selectedMenu == .Invoices {
            switchToInvoices()
        } else if App.shared.selectedMenu == .Marketing {
            
        } else if App.shared.selectedMenu == .Calculator {
            
        } else if App.shared.selectedMenu == .Estimator {
            
        } else if App.shared.selectedMenu == .Estimates {
            switchToEstimates()
        } else if App.shared.selectedMenu == .Reports {
            switchToReports()
        } else if App.shared.selectedMenu == .Employees {
            switchToEmployees()
        } else if App.shared.selectedMenu == .CollageMaker {
                   
        } else if App.shared.selectedMenu == .Chat {
            switchToChat()
        } else if App.shared.selectedMenu == .Messages {
            switchToMailbox()
        } else if App.shared.selectedMenu == .TimeClock {
            switchToTimeClock()
        } else if App.shared.selectedMenu == .Trac360 {
            switchToTrac360()
        } else if App.shared.selectedMenu == .Accounting {
            
        } else if App.shared.selectedMenu == .Expenses {
            //switchToExpenses()
        } else {
            if !App.shared.appUser.isGuest() {
                App.shared.selectedMenu = .Home
                switchToHome()
            } else {
                switchToLogin()
            }
        }
        
        window?.makeKeyAndVisible()
    }
    
    public func switchToLogin() {
        let sb = UIStoryboard(name: "Main", bundle: Bundle.main)
        let controller = sb.instantiateViewController(withIdentifier: "sb_LoginController")
        window?.set(rootViewController: controller)
    }
    
    public func switchToHome() {
        let sb = UIStoryboard(name: "Main", bundle: Bundle.main)
        let navController = UINavigationController(rootViewController: sb.instantiateViewController(withIdentifier: "sb_HomeTabController"))
        let transition = CATransition()
        transition.type = CATransitionType.fade
        window!.set(rootViewController: navController, withTransition: transition)
        //let controller = sb.instantiateViewController(withIdentifier: "sb_HomeTabController")
        //window?.set(rootViewController: controller)
    }
    
    public func switchToDashboard() {
        let sb = UIStoryboard(name: "Dashboard", bundle: Bundle.main)
        let navController = UINavigationController(rootViewController: sb.instantiateViewController(withIdentifier: "sb_DashboardTabController"))
        let transition = CATransition()
        transition.type = CATransitionType.fade
        window!.set(rootViewController: navController, withTransition: transition)
    }
    
    public func switchToCustomers() {
        let sb = UIStoryboard(name: "Main", bundle: Bundle.main)
        let navController = UINavigationController(rootViewController: sb.instantiateViewController(withIdentifier: "sb_CustomersController"))
        let transition = CATransition()
        transition.type = CATransitionType.fade
        window!.set(rootViewController: navController, withTransition: transition)
    }
    
    public func switchToQuickLinks() {
        let sb = UIStoryboard(name: "Main", bundle: Bundle.main)
        let navController = UINavigationController(rootViewController: sb.instantiateViewController(withIdentifier: "sb_QuickLinksController"))
        let transition = CATransition()
        transition.type = CATransitionType.fade
        window!.set(rootViewController: navController, withTransition: transition)
    }
    
    public func switchToContacts() {
        let sb = UIStoryboard(name: "Main", bundle: Bundle.main)
        let navController = UINavigationController(rootViewController: sb.instantiateViewController(withIdentifier: "sb_ContactsController"))
        let transition = CATransition()
        transition.type = CATransitionType.fade
        window!.set(rootViewController: navController, withTransition: transition)
    }
    
    public func switchToLeads() {
        let sb = UIStoryboard(name: "Main", bundle: Bundle.main)
        let navController = UINavigationController(rootViewController: sb.instantiateViewController(withIdentifier: "sb_LeadsController"))
        let transition = CATransition()
        transition.type = CATransitionType.fade
        window!.set(rootViewController: navController, withTransition: transition)
    }
    
    public func switchToCalendar() {
        let sb = UIStoryboard(name: "Main", bundle: Bundle.main)
        let navController = UINavigationController(rootViewController: sb.instantiateViewController(withIdentifier: "sb_ScheduleController"))
        let transition = CATransition()
        transition.type = CATransitionType.fade
        window!.set(rootViewController: navController, withTransition: transition)
    }
    
    public func switchToWorkOrder() {
        let sb = UIStoryboard(name: "Main", bundle: Bundle.main)
        let navController = UINavigationController(rootViewController: sb.instantiateViewController(withIdentifier: "sb_WorkOrderController"))
        let transition = CATransition()
        transition.type = CATransitionType.fade
        window!.set(rootViewController: navController, withTransition: transition)
    }
    
    public func switchToInvoices() {
        let sb = UIStoryboard(name: "Main", bundle: Bundle.main)
        let navController = UINavigationController(rootViewController: sb.instantiateViewController(withIdentifier: "sb_InvoicesController"))
        let transition = CATransition()
        transition.type = CATransitionType.fade
        window!.set(rootViewController: navController, withTransition: transition)
    }
    
    public func switchToInventory() {
        let sb = UIStoryboard(name: "Main", bundle: Bundle.main)
        let navController = UINavigationController(rootViewController: sb.instantiateViewController(withIdentifier: "sb_InventoryController"))
        let transition = CATransition()
        transition.type = CATransitionType.fade
        window!.set(rootViewController: navController, withTransition: transition)
    }
    
    public func switchToEstimates() {
        let sb = UIStoryboard(name: "Main", bundle: Bundle.main)
        let navController = UINavigationController(rootViewController: sb.instantiateViewController(withIdentifier: "sb_EstimatesController"))
        let transition = CATransition()
        transition.type = CATransitionType.fade
        window!.set(rootViewController: navController, withTransition: transition)
    }
    
    public func switchToReports() {
        let sb = UIStoryboard(name: "Reports", bundle: Bundle.main)
        let navController = UINavigationController(rootViewController: sb.instantiateViewController(withIdentifier: "sb_ReportsController"))
        let transition = CATransition()
        transition.type = CATransitionType.fade
        window!.set(rootViewController: navController, withTransition: transition)
    }
    
    public func switchToEmployees() {
        let sb = UIStoryboard(name: "Others", bundle: Bundle.main)
        let navController = UINavigationController(rootViewController: sb.instantiateViewController(withIdentifier: "sb_EmployeesController"))
        let transition = CATransition()
        transition.type = CATransitionType.fade
        window!.set(rootViewController: navController, withTransition: transition)
    }
    
    public func switchToAccounting() {
        let sb = UIStoryboard(name: "Others", bundle: Bundle.main)
        let navController = UINavigationController(rootViewController: sb.instantiateViewController(withIdentifier: "sb_AccountingController"))
        let transition = CATransition()
        transition.type = CATransitionType.fade
        window!.set(rootViewController: navController, withTransition: transition)
    }
    
    public func switchToTasks() {
        let sb = UIStoryboard(name: "Others", bundle: Bundle.main)
        let navController = UINavigationController(rootViewController: sb.instantiateViewController(withIdentifier: "sb_TasksController"))
        let transition = CATransition()
        transition.type = CATransitionType.fade
        window!.set(rootViewController: navController, withTransition: transition)
    }
    
    public func switchToFileVault() {
        let sb = UIStoryboard(name: "Others", bundle: Bundle.main)
        let navController = UINavigationController(rootViewController: sb.instantiateViewController(withIdentifier: "sb_FilesVaultController"))
        let transition = CATransition()
        transition.type = CATransitionType.fade
        window!.set(rootViewController: navController, withTransition: transition)
    }
    
    public func switchToESign() {
        let sb = UIStoryboard(name: "Others", bundle: Bundle.main)
        let navController = UINavigationController(rootViewController: sb.instantiateViewController(withIdentifier: "sb_ESignTabController"))
        let transition = CATransition()
        transition.type = CATransitionType.fade
        window!.set(rootViewController: navController, withTransition: transition)
    }
    
    public func switchToNotifications() {
        let sb = UIStoryboard(name: "Others", bundle: Bundle.main)
        let navController = UINavigationController(rootViewController: sb.instantiateViewController(withIdentifier: "sb_NotificationsController"))
        let transition = CATransition()
        transition.type = CATransitionType.fade
        window!.set(rootViewController: navController, withTransition: transition)
    }
    
    public func switchToMyBusiness() {
        let sb = UIStoryboard(name: "Others", bundle: Bundle.main)
        let navController = UINavigationController(rootViewController: sb.instantiateViewController(withIdentifier: "sb_MyBusinessController"))
        let transition = CATransition()
        transition.type = CATransitionType.fade
        window!.set(rootViewController: navController, withTransition: transition)
    }
    
    public func switchToMyAccount() {
        let sb = UIStoryboard(name: "Others", bundle: Bundle.main)
        let navController = UINavigationController(rootViewController: sb.instantiateViewController(withIdentifier: "sb_MyAccountTabController"))
        let transition = CATransition()
        transition.type = CATransitionType.fade
        window!.set(rootViewController: navController, withTransition: transition)
    }
    
    public func switchToSettings() {
        let sb = UIStoryboard(name: "Settings", bundle: Bundle.main)
        let navController = UINavigationController(rootViewController: sb.instantiateViewController(withIdentifier: "sb_SettingsController"))
        let transition = CATransition()
        transition.type = CATransitionType.fade
        window!.set(rootViewController: navController, withTransition: transition)
    }
    
    public func switchToChat() {
        let sb = UIStoryboard(name: "Others", bundle: Bundle.main)
        let navController = UINavigationController(rootViewController: sb.instantiateViewController(withIdentifier: "sb_MessagesController"))
        let transition = CATransition()
        transition.type = CATransitionType.fade
        window!.set(rootViewController: navController, withTransition: transition)
    }
    
    public func switchToMailbox() {
        let sb = UIStoryboard(name: "Others", bundle: Bundle.main)
        let navController = UINavigationController(rootViewController: sb.instantiateViewController(withIdentifier: "sb_MailboxController"))
        let transition = CATransition()
        transition.type = CATransitionType.fade
        window!.set(rootViewController: navController, withTransition: transition)
    }
    
    public func switchToWeatherForecast() {
        let sb = UIStoryboard(name: "Others", bundle: Bundle.main)
        let navController = UINavigationController(rootViewController: sb.instantiateViewController(withIdentifier: "sb_WeatherForecastController"))
        let transition = CATransition()
        transition.type = CATransitionType.fade
        window!.set(rootViewController: navController, withTransition: transition)
    }
    
    public func switchToTimeClock() {
        let sb = UIStoryboard(name: "Others", bundle: Bundle.main)
        let navController = UINavigationController(rootViewController: sb.instantiateViewController(withIdentifier: "sb_AttoTabController"))
        let transition = CATransition()
        transition.type = CATransitionType.fade
        window!.set(rootViewController: navController, withTransition: transition)
    }
    
    public func switchToTrac360() {
        let sb = UIStoryboard(name: "Others2", bundle: Bundle.main)
        let navController = UINavigationController(rootViewController: sb.instantiateViewController(withIdentifier: "sb_Trac360TabController"))
        let transition = CATransition()
        transition.type = CATransitionType.fade
        window!.set(rootViewController: navController, withTransition: transition)
    }
    
    public func switchToExpenses() {
        let sb = UIStoryboard(name: "Accounting", bundle: Bundle.main)
        let navController = UINavigationController(rootViewController: sb.instantiateViewController(withIdentifier: "sb_ExpensesController"))
        let transition = CATransition()
        transition.type = CATransitionType.fade
        window!.set(rootViewController: navController, withTransition: transition)
    }
    
    func removeView() {
        let keyWindow = UIApplication.shared.windows.filter {$0.isKeyWindow}.first
        if var topController = keyWindow?.rootViewController {
            while let presentedViewController = topController.presentedViewController {
                topController = presentedViewController
            }
            
            if let viewWithTag = topController.view.viewWithTag(999) {
                viewWithTag.removeFromSuperview()
            }
        }
    }
    
    func setupNotificationObservers() {
        let nc = NotificationCenter.default
        let opQueue = OperationQueue.main
        
        _ = nc.addObserver(
            forName: Notifications.didLogin, object: nil,
            queue: opQueue, using: { [weak self] _ in
                self?.switchToHome()
        })
        _ = nc.addObserver(
            forName: Notifications.didLogout, object: nil,
            queue: opQueue, using: { [weak self] _ in
                self?.switchToLogin()
        })
        _ = nc.addObserver(
            forName: Notifications.didSwitchLeftMenu, object: nil,
            queue: opQueue, using: { [weak self] _ in
                self?.updateRootViewController()
        })
    }
    
}

// MARK: - Local Notification -
