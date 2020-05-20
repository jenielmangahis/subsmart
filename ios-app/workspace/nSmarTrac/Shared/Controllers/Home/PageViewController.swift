//
//  PageViewController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 07/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import FontAwesome_swift
import SideMenu

class PageViewController: UIPageViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var menuButtonItem: UIBarButtonItem!
    @IBOutlet var stopwatchButtonItem: UIBarButtonItem!
    @IBOutlet var chatButtonItem: UIBarButtonItem!
    @IBOutlet var inboxButtonItem: UIBarButtonItem!
    
    weak var pageDelegate: PageViewControllerDelegate?
    
    private(set) lazy var orderedViewControllers: [UIViewController] = {
        return [homeController(),
                otherPageController()]
    }()
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        self.initNavBar()
        
        dataSource = self
        delegate = self
        
        if let initialViewController = orderedViewControllers.first {
            scrollToViewController(viewController: initialViewController)
        }
        
        pageDelegate?.pageViewController(tutorialPageViewController: self, didUpdatePageCount: orderedViewControllers.count)
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Navigation Bar -
    
    func initNavBar() {
        // setup navBar icons
        menuButtonItem.image = UIImage.fontAwesomeIcon(name: .bars
            , style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        stopwatchButtonItem.image = UIImage.fontAwesomeIcon(name: .stopwatch, style: .regular, textColor: .white, size: CGSize(width: 24, height: 24))
        chatButtonItem.image = UIImage.fontAwesomeIcon(name: .comments, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        inboxButtonItem.image = UIImage.fontAwesomeIcon(name: .envelope, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        
        // setup SideMenu
        SideMenuManager.default.leftMenuNavigationController = storyboard?.instantiateViewController(withIdentifier: "sb_SideMenu") as? SideMenuNavigationController
        SideMenuManager.default.rightMenuNavigationController = nil
        SideMenuManager.default.addPanGestureToPresent(toView: self.navigationController!.navigationBar)
        SideMenuManager.default.addScreenEdgePanGesturesToPresent(toView: self.navigationController!.view)
        SideMenuManager.default.leftMenuNavigationController?.statusBarEndAlpha = 0
        
        // setup company logo
        //self.navigationItem.titleView = Utils.shared.getAppLogo()
    }
    
    // MARK: - Action -

    @IBAction func sideMenuTapped(_ sender: Any) {
        self.present(SideMenuManager.default.leftMenuNavigationController!, animated: true, completion: nil)
    }
    
    // MARK: - Functions -
    
    private func homeController() -> UIViewController {
        return (self.storyboard?.instantiateViewController(withIdentifier: "sb_HomeController"))!
    }
    
    private func otherPageController() -> UIViewController {
        return (self.storyboard?.instantiateViewController(withIdentifier: "sb_OtherPageController"))!
    }
    
    /**
     Scrolls to the next view controller.
     */
    func scrollToNextViewController() {
        if let visibleViewController = viewControllers?.first,
            let nextViewController = pageViewController(self, viewControllerAfter: visibleViewController) {
                    scrollToViewController(viewController: nextViewController)
        }
    }
    
    /**
     Scrolls to the view controller at the given index. Automatically calculates
     the direction.
     
     - parameter newIndex: the new index to scroll to
     */
    func scrollToViewController(index newIndex: Int) {
        if let firstViewController = viewControllers?.first,
            let currentIndex = orderedViewControllers.firstIndex(of: firstViewController) {
            let direction: UIPageViewController.NavigationDirection = newIndex >= currentIndex ? .forward : .reverse
                let nextViewController = orderedViewControllers[newIndex]
                scrollToViewController(viewController: nextViewController, direction: direction)
        }
    }
    
    private func scrollToViewController(viewController: UIViewController,
                                        direction: UIPageViewController.NavigationDirection = .forward) {
        setViewControllers([viewController],
            direction: direction,
            animated: true,
            completion: { (finished) -> Void in
                // Setting the view controller programmatically does not fire
                // any delegate methods, so we have to manually notify the
                // 'tutorialDelegate' of the new index.
                self.notifyTutorialDelegateOfNewIndex()
        })
    }
    
    /**
     Notifies '_tutorialDelegate' that the current page index was updated.
     */
    private func notifyTutorialDelegateOfNewIndex() {
        if let firstViewController = viewControllers?.first,
            let index = orderedViewControllers.firstIndex(of: firstViewController) {
                pageDelegate?.pageViewController(tutorialPageViewController: self, didUpdatePageIndex: index)
        }
    }

}

// MARK: - UIPageViewControllerDataSource -

extension PageViewController: UIPageViewControllerDataSource, UIPageViewControllerDelegate {
    
    func pageViewController(_ pageViewController: UIPageViewController, viewControllerBefore viewController: UIViewController) -> UIViewController? {
        
            guard let viewControllerIndex = orderedViewControllers.firstIndex(of: viewController) else {
                return nil
            }
            
            let previousIndex = viewControllerIndex - 1
            
            // User is on the first view controller and swiped left to loop to
            // the last view controller.
            guard previousIndex >= 0 else {
                //return orderedViewControllers.last
                return nil
            }
            
            guard orderedViewControllers.count > previousIndex else {
                return nil
            }
            
            return orderedViewControllers[previousIndex]
    }

    func pageViewController(_ pageViewController: UIPageViewController, viewControllerAfter viewController: UIViewController) -> UIViewController? {
        
            guard let viewControllerIndex = orderedViewControllers.firstIndex(of: viewController) else {
                return nil
            }
            
            let nextIndex = viewControllerIndex + 1
            let orderedViewControllersCount = orderedViewControllers.count
            
            // User is on the last view controller and swiped right to loop to
            // the first view controller.
            guard orderedViewControllersCount != nextIndex else {
                //return orderedViewControllers.first
                return nil
            }
            
            guard orderedViewControllersCount > nextIndex else {
                return nil
            }
            
            return orderedViewControllers[nextIndex]
    }
    
    func pageViewController(_ pageViewController: UIPageViewController, didFinishAnimating finished: Bool, previousViewControllers: [UIViewController], transitionCompleted completed: Bool) {
        if let firstViewController = viewControllers?.first,
            let index = orderedViewControllers.firstIndex(of: firstViewController) {
            pageDelegate?.pageViewController(tutorialPageViewController: self, didUpdatePageIndex: index)
        }
    }
    
    func presentationCountForPageViewController(pageViewController: UIPageViewController) -> Int {
        return orderedViewControllers.count
    }

    func presentationIndexForPageViewController(pageViewController: UIPageViewController) -> Int {
        guard let firstViewController = viewControllers?.first,
            let firstViewControllerIndex = orderedViewControllers.firstIndex(of: firstViewController) else {
                return 0
        }
        
        return firstViewControllerIndex
    }
    
    func pageViewController(pageViewController: UIPageViewController, didFinishAnimating finished: Bool, previousViewControllers: [UIViewController], transitionCompleted completed: Bool) {
        notifyTutorialDelegateOfNewIndex()
    }
}

protocol PageViewControllerDelegate: class {
    /**
     Called when the number of pages is updated.
     
     - parameter tutorialPageViewController: the TutorialPageViewController instance
     - parameter count: the total number of pages.
     */
    func pageViewController(tutorialPageViewController: PageViewController, didUpdatePageCount count: Int)
    
    /**
     Called when the current index is updated.
     
     - parameter tutorialPageViewController: the TutorialPageViewController instance
     - parameter index: the index of the currently visible page.
     */
    func pageViewController(tutorialPageViewController: PageViewController, didUpdatePageIndex index: Int)
    
}
