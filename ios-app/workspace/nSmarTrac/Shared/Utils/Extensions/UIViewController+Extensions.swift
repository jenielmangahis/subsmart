//
//  UIViewController+Extensions.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 04/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Foundation

extension UIViewController {
    
    static func initFromNib() -> Self {
        func instanceFromNib<T: UIViewController>() -> T {
            return T(nibName: String(describing: self), bundle: nil)
        }
        return instanceFromNib()
    }
    
    func pushTo(storyBoard: String, identifier: String) {
        let storyboard = UIStoryboard(name: storyBoard, bundle: Bundle.main)
        let viewController = storyboard.instantiateViewController(withIdentifier: identifier)
        navigationController?.pushViewController(viewController, animated: true)
    }
    
    func popViewController() {
        navigationController?.popViewController(animated: true)
    }
    
    func popViewController(storyBoard: String, identifier: String) {
        let storyboard = UIStoryboard(name: storyBoard, bundle: Bundle.main)
        let viewController = storyboard.instantiateViewController(withIdentifier: identifier)
        navigationController?.popToViewController(viewController, animated: true)
    }
    
    func popToRootController() {
        navigationController?.popToRootViewController(animated: true)
    }
    
    func topMostViewController() -> UIViewController {
        if self.presentedViewController == nil {
            return self
        }
        if let navigation = self.presentedViewController as? UINavigationController {
            return navigation.visibleViewController!.topMostViewController()
        }
        if let tab = self.presentedViewController as? UITabBarController {
            if let selectedTab = tab.selectedViewController {
                return selectedTab.topMostViewController()
            }
            return tab.topMostViewController()
        }
        return self.presentedViewController!.topMostViewController()
    }
    
    func hideKeyboardWhenTappedAround() {
        let tap: UITapGestureRecognizer = UITapGestureRecognizer(target: self, action:    #selector(UIViewController.dismissKeyboard))
        tap.cancelsTouchesInView = false
        view.addGestureRecognizer(tap)
    }
    
    @objc func dismissKeyboard() {
        view.endEditing(true)
    }
}
