//
//  OtherPageController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 07/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import FontAwesome_swift
import Foundation
import ObjectMapper

class OtherPageController: UIViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var backgroundView: UIImageView!
    @IBOutlet var collectionView: UICollectionView!
    @IBOutlet var doneButton: DesignableButton!
    
    var presets: [Menu] = []
    var objects: [Menu] = []
    var myMenu: [Menu] = []
    var isLongPressedEnabled: Bool = false
    
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initScreenBg()
        initCollectionViewLayout()
    }
    
    override func viewWillAppear(_ animated: Bool) {
        initMenu()
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func initScreenBg() {
        // check first
        if let image = UserDefaults.standard.imageForKey(key: "CUSTOM_HOME_SCREEN_BG") {
            backgroundView.image = image
        } else if let selectedImage = UserDefaults.standard.string(forKey: "HOME_SCREEN_BG") {
            backgroundView.image = UIImage(named: selectedImage)
        } else {
            backgroundView.image = UIImage(named: "img-bgHome8.jpeg")
        }
    }
    
    func initMenu() {
        if let mData = UserDefaults.standard.value(forKey: "HOME_SCREEN2_ICON") as? [[String : Any]],
           let mPreset = UserDefaults.standard.value(forKey: "PRESET_HOME_SCREEN2_ICON") as? [[String : Any]] {
            objects = Menu.models(from: mData)
            presets = Menu.models(from: mPreset)
            processMenu(objects)
        } else {
            // init dictionary
            var dictionary: [Parameters] = []
            // add menu to dictionary
            dictionary.append(MenuItem.back)
            dictionary.append(MenuItem.inventory)
            dictionary.append(MenuItem.employees)
            dictionary.append(MenuItem.quickLinks)
            dictionary.append(MenuItem.contacts)
            dictionary.append(MenuItem.leads)
            dictionary.append(MenuItem.filesVault)
            dictionary.append(MenuItem.eSign)
            dictionary.append(MenuItem.accounting)
            dictionary.append(MenuItem.reports)
            dictionary.append(MenuItem.marketing)
            dictionary.append(MenuItem.more)
            
            objects = Menu.models(from: dictionary)
            presets = Menu.models(from: dictionary)
            processMenu(objects)
            
            UserDefaults.standard.set(objects.toJSON(), forKey: "HOME_SCREEN2_ICON")
            UserDefaults.standard.set(objects.toJSON(), forKey: "PRESET_HOME_SCREEN2_ICON")
            UserDefaults.standard.synchronize()
        }
    }
    
    func processMenu(_ data: [Menu]) {
        // check
        if let menus = App.shared.user?.menus {
            // iterate data
            for item in data {
                // default menu
                let items = ["Back", "More"]
                
                // check
                if items.contains(item.name) {
                    myMenu.append(item)
                } else if menus.contains(item.name) {
                    myMenu.append(item)
                }
            }
            
            // iterate objects
            let mPresets = HomeController.getMenuNames(presets)
            let mMenu = HomeController.getMenuNames(myMenu)
            let diff = mPresets.difference(from: mMenu)
            
            // iterate diff
            for item in diff {
                // check
                if menus.contains(item) {
                    if let dict = HomeController.getMenu(item) {
                        myMenu.insert(Menu.models(from: [dict]).first!, at: myMenu.count-1)
                    }
                }
            }
        }
    }
    
    // MARK: - Action -
    
    @IBAction func doneButtonTapped(_ sender: Any) {
        self.isLongPressedEnabled = false
        self.collectionView.reloadData()
        self.doneButton.isHidden = true
    }
     
     @objc func longTap(_ gesture: UIGestureRecognizer) {
         switch(gesture.state) {
         case .began:
             guard let selectedIndexPath = self.collectionView.indexPathForItem(at: gesture.location(in: self.collectionView)) else {
                 return
             }
             self.collectionView.beginInteractiveMovementForItem(at: selectedIndexPath)
         case .changed:
             self.collectionView.updateInteractiveMovementTargetPosition(gesture.location(in: gesture.view!))
         case .ended:
             self.collectionView.endInteractiveMovement()
             self.isLongPressedEnabled = true
             self.doneButton.isHidden = false
             self.collectionView.reloadData()
         default:
             self.collectionView.cancelInteractiveMovement()
         }
     }

}

// MARK: - UICollectionView Datasource -

extension OtherPageController: UICollectionViewDelegate, UICollectionViewDataSource {
    
    func initCollectionViewLayout() {
        let layout = UICollectionViewFlowLayout()
        layout.scrollDirection = .vertical
        layout.itemSize = CGSize(width: (Device.width-50)/2, height: 100)
        layout.sectionInset = UIEdgeInsets(top: 0, left: 0, bottom: 10, right: 0)
        layout.minimumLineSpacing = 10
        layout.minimumInteritemSpacing = 10
        self.collectionView.setCollectionViewLayout(layout, animated: true)
        
        let longPressGesture = UILongPressGestureRecognizer(target: self, action: #selector(longTap(_:)))
        self.collectionView.addGestureRecognizer(longPressGesture)
        
        self.doneButton.isHidden = true
    }
    
    func collectionView(_ collectionView: UICollectionView, numberOfItemsInSection section: Int) -> Int {
        return myMenu.count
    }
    
    func collectionView(_ collectionView: UICollectionView, cellForItemAt indexPath: IndexPath) -> UICollectionViewCell {
        let item = myMenu[indexPath.row]
        // Configure the cell...
        let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "Cell", for: indexPath) as! MenuCell
        cell.cellView.backgroundColor = (App.shared.appearance == "Dark") ? UIColor(rgb: 0x000000, alpha: 0.3) : UIColor(rgb: 0xFFFFFF, alpha: 0.3)
        cell.name.text = item.name
        
        // check
        if let icon = String.fontAwesome(code: item.icon) {
            cell.icon.image = UIImage.fontAwesomeIcon(name: icon, style: .regular, textColor: .white, size: CGSize(width: 48, height: 48))
        }
        
        // animate cell
        if isLongPressedEnabled {
            cell.startAnimate()
        } else {
            cell.stopAnimate()
        }
        
        return cell
    }
    
    func collectionView(_ collectionView: UICollectionView, didSelectItemAt indexPath: IndexPath) {
        if indexPath.row == 0 {
            let parent = self.parent as! UIPageViewController
            parent.setViewControllers([HomeTabController().orderedViewControllers[0]], direction: .reverse, animated: true, completion: nil)
        } else if indexPath.row == 11 {
            let parent = self.parent as! UIPageViewController
            parent.setViewControllers([HomeTabController().orderedViewControllers[2]], direction: .forward, animated: true, completion: nil)
        } else {
            let item = myMenu[indexPath.row]
            App.shared.selectedMenu = LeftMenu(rawValue: item.link)
            
            NotificationCenter.default.post(name: Notifications.didSwitchLeftMenu, object: self, userInfo: nil)
        }
    }
    
    func collectionView(_ collectionView: UICollectionView, canMoveItemAt indexPath: IndexPath) -> Bool {
        return true
    }
        
    func collectionView(_ collectionView: UICollectionView, moveItemAt sourceIndexPath: IndexPath, to destinationIndexPath: IndexPath) {
        let tmp = myMenu[sourceIndexPath.item]
        myMenu[sourceIndexPath.item] = myMenu[destinationIndexPath.item]
        myMenu[destinationIndexPath.item] = tmp
        collectionView.reloadData()
        
        UserDefaults.standard.set(myMenu.toJSON(), forKey: "HOME_SCREEN2_ICON")
        UserDefaults.standard.synchronize()
    }
}
