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
    
    open override func awakeFromNib() {
        navigationItem.backBarButtonItem = UIBarButtonItem(title: "", style: .plain, target: nil, action: nil)
    }
    
    func pushTo(storyBoard: String, identifier: String) {
        let storyboard = UIStoryboard(name: storyBoard, bundle: Bundle.main)
        let viewController = storyboard.instantiateViewController(withIdentifier: identifier)
        navigationController?.pushViewController(viewController, animated: true)
    }
    
    func presentTo(storyBoard: String, identifier: String) {
        let storyboard = UIStoryboard(name: storyBoard, bundle: Bundle.main)
        let viewController = storyboard.instantiateViewController(withIdentifier: identifier)
        let navController = UINavigationController(rootViewController: viewController)
        present(navController, animated: true, completion: nil)
    }
    
    func presentFormSheet(storyBoard: UIStoryboard, identifier: String) {
        let viewController = storyboard!.instantiateViewController(withIdentifier: identifier)
        let navController = UINavigationController(rootViewController: viewController)
        navController.modalPresentationStyle = .formSheet
        present(navController, animated: true, completion: nil)
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
    
    func hideKeyboardWhenTappedAround() {
        let tap: UITapGestureRecognizer = UITapGestureRecognizer(target: self, action:    #selector(UIViewController.dismissKeyboard))
        tap.cancelsTouchesInView = false
        view.addGestureRecognizer(tap)
    }
    
    @objc func dismissKeyboard() {
        view.endEditing(true)
    }
}
