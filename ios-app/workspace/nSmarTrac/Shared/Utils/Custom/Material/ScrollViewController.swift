//
//  ScrollViewController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 04/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import PureLayout

open class ScrollViewController: UIViewController {
    
    @IBOutlet open weak var scrollView: UIScrollView!
    
    deinit {
        
        // Don't have to do this on iOS 9+, but it still works
        NotificationCenter.default.removeObserver(self)
    }
    
    open override func viewDidLoad() {
        super.viewDidLoad()
        
        if view.backgroundColor == nil {
            view.backgroundColor = .white
        }
        if scrollView.superview == nil {
            view.addSubview(scrollView)
            scrollView.autoPinEdgesToSuperviewEdges()
        }
        
        scrollView.alwaysBounceVertical = true
        scrollView.keyboardDismissMode = .interactive
        addKeyboardVisibilityEventObservers()
    }
    
    // MARK: - Interactive Keyboard Dismissal For UIScrollView
    // Ref: https://realm.io/news/tmi-scrollview-for-keyboards/
    
    /// Register to be notified if the keyboard is changing size
    open func addKeyboardVisibilityEventObservers() {
        NotificationCenter.default
            .addObserver(self,
                         selector: #selector(keyboardWillShowOrHideHandler(_:)),
                         name: UIResponder.keyboardDidShowNotification, object: nil)
        NotificationCenter.default
            .addObserver(self,
                         selector: #selector(keyboardWillShowOrHideHandler(_:)),
                         name: UIResponder.keyboardWillHideNotification, object: nil)
    }
    
    @objc open func keyboardWillShowOrHideHandler(_ notification: NSNotification) {
        
        // Pull a bunch of info out of the notification
        if let scrollView = scrollView,
            let userInfo = notification.userInfo,
            let endValue = userInfo[UIResponder.keyboardFrameEndUserInfoKey],
            let durationValue = userInfo[UIResponder.keyboardAnimationDurationUserInfoKey] {
            
            // Transform the keyboard's frame into our view's coordinate system
            let endRect = view.convert((endValue as AnyObject).cgRectValue, from: view.window)
            
            // Find out how much the keyboard overlaps the scroll view
            // We can do this because our scroll view's frame is already in our view's coordinate system
            let keyboardOverlap = scrollView.frame.maxY - endRect.origin.y
            
            // Set the scroll view's content inset to avoid the keyboard
            // Don't forget the scroll indicator too!
            scrollView.contentInset.bottom = keyboardOverlap
            scrollView.scrollIndicatorInsets.bottom = keyboardOverlap
            
            let duration = (durationValue as AnyObject).doubleValue
            UIView.animate(withDuration: duration!, delay: 0, options: .beginFromCurrentState, animations: {
                self.view.layoutIfNeeded()
            }, completion: nil)
        }
    }
}
