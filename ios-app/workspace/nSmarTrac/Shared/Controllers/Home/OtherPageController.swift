//
//  OtherPageController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 07/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import FontAwesome_swift

class OtherPageController: UIViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var collectionView: UICollectionView!
    @IBOutlet var pageControl: UIPageControl!
    
    var pageViewController: PageViewController? {
        didSet {
            pageViewController?.pageDelegate = self
        }
    }
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        
        pageControl.addTarget(self, action: #selector(didChangePageControlValue), for: .valueChanged)
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        if let pageViewController = segue.destination as? PageViewController {
            self.pageViewController = pageViewController
        }
    }
    
    // MARK: - Action -
    /**
     Fired when the user taps on the pageControl to change its current page.
     */
    @objc func didChangePageControlValue() {
        pageViewController?.scrollToViewController(index: pageControl.currentPage)
    }

}

// MARK: - UICollectionView Datasource -

extension OtherPageController: UICollectionViewDelegate, UICollectionViewDataSource {
    
    func collectionView(_ collectionView: UICollectionView, numberOfItemsInSection section: Int) -> Int {
        return 11
    }
    
    func collectionView(_ collectionView: UICollectionView, cellForItemAt indexPath: IndexPath) -> UICollectionViewCell {
        let titles = ["Back", "Estimates", "Marketing", "Inventory", "Reports", "Bulletin", "Employees", "Collage Maker", "Cost Estimator", "Virtual Estimator", "Clock Out"]
        let icons: [FontAwesome] = [.replyAll, .calculatorAlt, .bullhorn, .dollyFlatbed, .chartLine, .newspaper, .users, .cameraRetro, .calculator, .route, .stopwatch]
        let image = UIImage.fontAwesomeIcon(name: icons[indexPath.row], style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 48, height: 48))
        
        // Configure the cell...
        let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "Cell", for: indexPath) as! MenuCell
        cell.icon.image = image
        cell.name.text = titles[indexPath.row]
        
        return cell
    }
    
    func collectionView(_ collectionView: UICollectionView, layout collectionViewLayout: UICollectionViewLayout, sizeForItemAt indexPath: IndexPath) -> CGSize {
        return CGSize(width: (Device.width-30)/2, height: 100)
    }
    
    func collectionView(_ collectionView: UICollectionView, layout collectionViewLayout: UICollectionViewLayout, insetForSectionAt section: Int) -> UIEdgeInsets {
        return UIEdgeInsets(top: 0, left: 10, bottom: 10, right: 0)
    }
    
    func collectionView(_ collectionView: UICollectionView, didSelectItemAt indexPath: IndexPath) {
        if indexPath.row == 0 {
            pageViewController?.scrollToViewController(index: 0)
        } else {
            let shortcuts: [LeftMenu] = [.Estimates, .Marketing, .Inventory, .Reports, .Employees, .CollageMaker, .CostEstimator, .VirtualEstimator, .ClockOut]
            App.shared.selectedMenu = shortcuts[indexPath.row-1]
            
            NotificationCenter.default.post(name: Notifications.didSwitchLeftMenu, object: self, userInfo: nil)
        }
    }
}

// MARK: - PageViewControllerDelegate -

extension OtherPageController: PageViewControllerDelegate {
    
    func pageViewController(tutorialPageViewController: PageViewController,
        didUpdatePageCount count: Int) {
        pageControl.numberOfPages = count
    }
    
    func pageViewController(tutorialPageViewController: PageViewController,
        didUpdatePageIndex index: Int) {
        pageControl.currentPage = index
    }
    
}
