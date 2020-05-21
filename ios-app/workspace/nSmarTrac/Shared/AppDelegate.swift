//
//  AppDelegate.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 04/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

@UIApplicationMain
class AppDelegate: UIResponder, UIApplicationDelegate {

    var window: UIWindow?


    func application(_ application: UIApplication, didFinishLaunchingWithOptions launchOptions: [UIApplication.LaunchOptionsKey: Any]?) -> Bool {
        // Override point for customization after application launch.
        
        // customized
        UINavigationBar.appearance().backgroundColor        = AppTheme.defaultColor
        UINavigationBar.appearance().barTintColor           = AppTheme.defaultColor
        UINavigationBar.appearance().isTranslucent          = false
        UINavigationBar.appearance().tintColor              = UIColor.white
        UINavigationBar.appearance().titleTextAttributes    = [NSAttributedString.Key.foregroundColor: UIColor.white, NSAttributedString.Key.font: UIFont.robotoBoldFont(ofSize: 20)]
        UIBarButtonItem.appearance().setTitleTextAttributes([NSAttributedString.Key.font: UIFont.robotoFont(ofSize: 14)], for: .normal)
        UIBarButtonItem.appearance().setTitleTextAttributes([NSAttributedString.Key.foregroundColor: AppTheme.defaultColor], for: .normal)
        
        //let view = UIView()
        //view.backgroundColor        = UIColor(rgb: 0x1C0B3B, alpha: 0.25)
        //UITableViewCell.appearance().selectedBackgroundView = view
        
        
        App.shared.bootstrap(with: application, launchOptions: launchOptions)
        App.shared.reachability.startListening()
        
        
        updateRootViewController()
        setupNotificationObservers()
        
        return true
    }

    func applicationWillResignActive(_ application: UIApplication) {
        App.shared.reachability.stopListening()
    }
    
    func applicationDidEnterBackground(_ application: UIApplication) {
        App.shared.reachability.stopListening()
    }

    func applicationWillEnterForeground(_ application: UIApplication) {
        App.shared.reachability.startListening()
    }

    func applicationDidBecomeActive(_ application: UIApplication) {}

    func applicationWillTerminate(_ application: UIApplication) {}


}

extension UIApplication {
    class func topViewController(controller: UIViewController? = UIApplication.shared.keyWindow?.rootViewController) -> UIViewController? {
        if let navigationController = controller as? UINavigationController {
            return topViewController(controller: navigationController.visibleViewController)
        }
        if let tabController = controller as? UITabBarController {
            if let selected = tabController.selectedViewController {
                return topViewController(controller: selected)
            }
        }
        if let presented = controller?.presentedViewController {
            return topViewController(controller: presented)
        }
        return controller
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
            switchToDashboard()
        } else if App.shared.selectedMenu == .Customers {
            switchToCustomers()
        } else if App.shared.selectedMenu == .QuickLinks {
            switchToQuickLinks()
        } else if App.shared.selectedMenu == .BusinessContacts {
            switchToContacts()
        } else if App.shared.selectedMenu == .Leads {
            switchToLeads()
        } else if App.shared.selectedMenu == .Tasks {
            
        } else if App.shared.selectedMenu == .Inventory {
            switchToInventory()
        } else if App.shared.selectedMenu == .Map {
            
        } else if App.shared.selectedMenu == .Calculator {
            
        } else if App.shared.selectedMenu == .Estimator {
            
        } else if App.shared.selectedMenu == .Expenses {
            switchToExpenses()
        } else if App.shared.selectedMenu == .Notification {
            
        } else if App.shared.selectedMenu == .MyInfo {
            
        } else if App.shared.selectedMenu == .Settings {
            
        } else if App.shared.selectedMenu == .CompanyProfile {
            
        } else if App.shared.selectedMenu == .Login {
            switchToLogin()
        } else if App.shared.selectedMenu == .Schedule {
            switchToSchedule()
        } else if App.shared.selectedMenu == .WorkOrder {
            switchToWorkOrder()
        } else if App.shared.selectedMenu == .Tasks {
            
        } else if App.shared.selectedMenu == .Bulletin {
            
        } else if App.shared.selectedMenu == .Invoices {
            switchToInvoices()
        } else if App.shared.selectedMenu == .Reports {
            
        } else if App.shared.selectedMenu == .Marketing {
            
        } else {
            /*if !App.shared.user.isGuest() {
                App.shared.selectedMenu = .Home
                switchToDashboard()
            } else {
                switchToLogin()
            }*/
            
            switchToLogin()
        }
        
        window?.makeKeyAndVisible()
    }
    
    public func switchToLogin() {
        let sb = UIStoryboard(name: "Main", bundle: Bundle.main)
        let controller = sb.instantiateViewController(withIdentifier: "sb_LoginController")
        window?.set(rootViewController: controller)
    }
    
    public func switchToDashboard() {
        let sb = UIStoryboard(name: "Main", bundle: Bundle.main)
        let navController = UINavigationController(rootViewController: sb.instantiateViewController(withIdentifier: "sb_PageViewController"))
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
    
    public func switchToSchedule() {
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
    
    public func switchToExpenses() {
        let sb = UIStoryboard(name: "Main", bundle: Bundle.main)
        let navController = UINavigationController(rootViewController: sb.instantiateViewController(withIdentifier: "sb_ExpensesController"))
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
    
    func removeView() {
        if let topMostController = UIApplication.topViewController() {
            if let viewWithTag = topMostController.view.viewWithTag(999) {
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
                self?.switchToDashboard()
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

// do this before working in a day
// cd /Users/jonah/GIT/nSmarTrac/nsmartrac
// git checkout jonah_staging
// git pull origin staging
