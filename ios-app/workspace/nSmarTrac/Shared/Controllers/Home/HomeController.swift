//
//  HomeController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 04/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import AFDateHelper
import Alamofire
import FontAwesome_swift
import Foundation
import ObjectMapper

class HomeController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var collectionView: UICollectionView!
    @IBOutlet var welcomeLabel: UILabel!
    @IBOutlet var doneButton: DesignableButton!
    
    var events: [Event] = []
    var workorders: [WorkOrder] = []
    
    var presets: [Menu] = []
    var objects: [Menu] = []
    var myMenu: [Menu] = []
    var isLongPressedEnabled: Bool = false
    
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initScreenBg()
        initCollectionViewLayout()
        
        // setup welcome label
        welcomeLabel.text = "Welcome " + App.shared.user!.FName + " " + App.shared.user!.LName + ","
        
        // notification observers
        NotificationCenter.default.addObserver(self, selector: #selector(openBulletinLink(_:)), name: Notifications.willOpenBulletinLink, object: nil)
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
            tableView.backgroundView = UIImageView(image: image)
        } else if let selectedImage = UserDefaults.standard.string(forKey: "HOME_SCREEN_BG") {
            tableView.backgroundView = UIImageView(image: UIImage(named: selectedImage))
        } else {
            tableView.backgroundView = UIImageView(image: UIImage(named: "img-bgHome8.jpeg"))
        }
    }
    
    public static func getMenuNames(_ menus: [Menu]) -> [String] {
        let items: [String] = menus.map { (item) -> String in
            return String(format: "%@", item.name)
        }
        return items
    }
    
    public static func getMenu(_ key: String) -> Parameters? {
        
        let calendar = ["name": "Calendar", "icon": FontAwesome.calendarDay.rawValue, "link": LeftMenu.Schedule.rawValue]
        let customer = ["name": "Customers", "icon": FontAwesome.users.rawValue, "link": LeftMenu.Customers.rawValue]
        let workOrder = ["name": "Work Order", "icon": FontAwesome.userClock.rawValue, "link": LeftMenu.WorkOrder.rawValue]
        let estimates = ["name": "Estimates", "icon": FontAwesome.calculatorAlt.rawValue, "link": LeftMenu.Estimates.rawValue]
        let invoices = ["name": "Invoices", "icon": FontAwesome.fileInvoiceDollar.rawValue, "link": LeftMenu.Invoices.rawValue]
        let inventory = ["name": "Inventory", "icon": FontAwesome.clipboardList.rawValue, "link": LeftMenu.Inventory.rawValue]
        let quickLinks = ["name": "Quick Links", "icon": FontAwesome.link.rawValue, "link": LeftMenu.QuickLinks.rawValue]
        let contacts = ["name": "Business Contacts", "icon": FontAwesome.addressBook.rawValue, "link": LeftMenu.BusinessContacts.rawValue]
        let leads = ["name": "Leads", "icon": FontAwesome.clipboardCheck.rawValue, "link": LeftMenu.Leads.rawValue]
        let accounting = ["name": "Accounting", "icon": FontAwesome.fileExcel.rawValue, "link": LeftMenu.Accounting.rawValue]
        let filesVault = ["name": "Files Vault", "icon": FontAwesome.inbox.rawValue, "link": LeftMenu.FileVault.rawValue]
        let reports = ["name": "Reports", "icon": FontAwesome.chartLine.rawValue, "link": LeftMenu.Reports.rawValue]
        let marketing = ["name": "Marketing", "icon": FontAwesome.bullhorn.rawValue, "link": LeftMenu.Marketing.rawValue]
        let eSign = ["name": "eSign", "icon": FontAwesome.signature.rawValue, "link": LeftMenu.eSign.rawValue]
        let employees = ["name": "Employees", "icon": FontAwesome.users.rawValue, "link": LeftMenu.Employees.rawValue]
        let trac360 = ["name": "Trac360", "icon": FontAwesome.mapMarkerAlt.rawValue, "link": LeftMenu.Trac360.rawValue]
        let tasks = ["name": "Tasks", "icon": FontAwesome.tasks.rawValue, "link": LeftMenu.Tasks.rawValue]
        let timeClock = ["name": "Time Clock", "icon": FontAwesome.stopwatch.rawValue, "link": LeftMenu.TimeClock.rawValue]
        let routePlanner = ["name": "Route Planner", "icon": FontAwesome.truckMoving.rawValue, "link": LeftMenu.RoutePlanner.rawValue]
        let bulletin = ["name": "Bulletin", "icon": FontAwesome.newspaper.rawValue, "link": LeftMenu.Bulletin.rawValue]
        let collageMaker = ["name": "Collage Maker", "icon": FontAwesome.cameraRetro.rawValue, "link": LeftMenu.CollageMaker.rawValue]
        let costEstimator = ["name": "Cost Estimator", "icon": FontAwesome.calculator.rawValue, "link": LeftMenu.CostEstimator.rawValue]
        let virtualEstimator = ["name": "Virtual Estimator", "icon": FontAwesome.route.rawValue, "link": LeftMenu.VirtualEstimator.rawValue]
        
        let menus = ["Leads": leads, "Customers": customer, "Estimates": estimates, "Invoices": invoices, "Calendar": calendar, "Work Order": workOrder, "Employees": employees, "Route Planner": routePlanner, "Reports": reports, "Accounting": accounting, "Collage Maker": collageMaker, "Cost Estimator": costEstimator, "Virtual Estimator": virtualEstimator, "Time Clock": timeClock, "Marketing": marketing, "Trac360": trac360, "Inventory": inventory, "Quick Links": quickLinks, "Business Contacts": contacts, "Files Vault": filesVault, "eSign": eSign, "Tasks": tasks, "Bulletin": bulletin]
        
        if let menu = menus[key] {
            return menu
        }
        
        return nil
    }
    
    func initMenu() {
        if let mData = UserDefaults.standard.value(forKey: "HOME_SCREEN_ICON") as? [[String : Any]],
           let mPreset = UserDefaults.standard.value(forKey: "PRESET_HOME_SCREEN_ICON") as? [[String : Any]] {
            objects = Menu.models(from: mData)
            presets = Menu.models(from: mPreset)
            processMenu(objects)
        } else {
            // init dictionary
            var dictionary: [Parameters] = []
            // add menu to dictionary
            dictionary.append(MenuItem.dashboard)
            dictionary.append(MenuItem.weather)
            dictionary.append(MenuItem.calendar)
            dictionary.append(MenuItem.customer)
            dictionary.append(MenuItem.workOrder)
            dictionary.append(MenuItem.estimates)
            dictionary.append(MenuItem.invoices)
            dictionary.append(MenuItem.more)
            
            objects = Menu.models(from: dictionary)
            presets = Menu.models(from: dictionary)
            processMenu(objects)
            
            UserDefaults.standard.set(objects.toJSON(), forKey: "HOME_SCREEN_ICON")
            UserDefaults.standard.set(objects.toJSON(), forKey: "PRESET_HOME_SCREEN_ICON")
            UserDefaults.standard.synchronize()
        }
    }
    
    func processMenu(_ data: [Menu]) {
        // check
        if let menus = App.shared.user?.menus {
            // iterate data
            for item in data {
                // default menu
                let items = ["Dashboard", "Weather Forecast", "More"]
                
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
    
    @IBAction func segmentedControlValueChanged(_ sender: UISegmentedControl) {
        NotificationCenter.default.post(name: Notifications.willUpdateHomeBulletin, object: self, userInfo: ["selectedTab": sender.selectedSegmentIndex])
    }
    
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
    
    // MARK: - Notification -
    
    @objc func openBulletinLink(_ notification: NSNotification) {
        if let type = notification.userInfo?["type"] as? Int,
            let item = notification.userInfo?["item"] as? AnyObject {
            // check
            if type == 0 {
                // check event or block
                if (item as! Event).event_type == "Event" {
                    App.shared.selectedEvent = item as? Event
                    self.pushTo(storyBoard: "Main", identifier: "sb_ScheduleTabController")
                } else if (item as! Event).event_type == "Block" {
                    App.shared.selectedEvent = item as? Event
                    self.pushTo(storyBoard: "Main", identifier: "sb_BlockDetailController")
                }
            } else if type == 1 {
                // check if event
                if item.event_type == "Event" || item.event_type == "Block" {
                    // check event or block
                    if (item as! Event).event_type == "Event" {
                        App.shared.selectedEvent = item as? Event
                        self.pushTo(storyBoard: "Main", identifier: "sb_ScheduleTabController")
                    } else if (item as! Event).event_type == "Block" {
                        App.shared.selectedEvent = item as? Event
                        self.pushTo(storyBoard: "Main", identifier: "sb_BlockDetailController")
                    }
                } else {
                    // work order
                    App.shared.selectedWorkOrder = item as? WorkOrder
                    self.pushTo(storyBoard: "Main", identifier: "sb_WorkOrderTabController")
                }
            } else {
                
            }
        }
    }
}

// MARK: - UICollectionView Delegate & Datasource -

extension HomeController: UICollectionViewDelegate, UICollectionViewDataSource {
    
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
        
        // check if menu is calendar
        if item.name == "Calendar" {
            // customized icon
            // create view
            let view = UIView(frame: CGRect(x: 0, y: 0, width: 48, height: 48))
            view.backgroundColor = .clear
            view.borders(for: [.all])
            view.borderColor = .white
            view.cornerRadius = 5
            
            // create day label
            let dayLabel = UILabel(frame: CGRect(x: 0, y: 4, width: 48, height: 12))
            dayLabel.font = UIFont.robotoFont(ofSize: 8)
            dayLabel.text = Date().toString(format: DateFormatType.custom("EEEE"))
            dayLabel.textAlignment = .center
            dayLabel.textColor = .white
            view.addSubview(dayLabel)
            
            // create date label
            let dateLabel = UILabel(frame: CGRect(x: 0, y: 14, width: 48, height: 34))
            dateLabel.font = UIFont.robotoBoldFont(ofSize: 34)
            dateLabel.text = Date().toString(format: DateFormatType.custom("dd"))
            dateLabel.textAlignment = .center
            dateLabel.textColor = .white
            view.addSubview(dateLabel)
            
            // assign image icon
            cell.icon.image = view.asImage()
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
        if indexPath.row == myMenu.count-1 {
            let parent = self.parent as! UIPageViewController
            parent.setViewControllers([HomeTabController().orderedViewControllers[1]], direction: .forward, animated: true, completion: nil)
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
        
        UserDefaults.standard.set(myMenu.toJSON(), forKey: "HOME_SCREEN_ICON")
        UserDefaults.standard.synchronize()
    }
}

// MARK: - Cells -

class MenuCell: UICollectionViewCell {
    
    // MARK: - Properties -
    
    @IBOutlet var cellView: DesignableView!
    @IBOutlet var icon: UIImageView!
    @IBOutlet var name: UILabel!
    
    var isAnimate: Bool! = true
    
    // MARK: - Functions -
    
    func startAnimate() {
        let shakeAnimation = CABasicAnimation(keyPath: "transform.rotation")
        shakeAnimation.duration = 0.05
        shakeAnimation.repeatCount = 4
        shakeAnimation.autoreverses = true
        shakeAnimation.duration = 0.2
        shakeAnimation.repeatCount = 99999
        
        let startAngle: Float = (-2) * 3.14159/180
        let stopAngle = -startAngle
        
        shakeAnimation.fromValue = NSNumber(value: startAngle as Float)
        shakeAnimation.toValue = NSNumber(value: 3 * stopAngle as Float)
        shakeAnimation.autoreverses = true
        shakeAnimation.timeOffset = 290 * drand48()
        
        let layer: CALayer = self.layer
        layer.add(shakeAnimation, forKey:"animate")
        isAnimate = true
    }
    
    func stopAnimate() {
        let layer: CALayer = self.layer
        layer.removeAnimation(forKey: "animate")
        isAnimate = false
    }
}

// MARK: - Object -

class Menu: Mappable {
    
    var name: String = ""
    var icon: String = ""
    var link: String = ""
    
    required init?(map: Map) {}
    
    // Mappable
    func mapping(map: Map) {
        name    <- map["name"]
        icon    <- map["icon"]
        link    <- map["link"]
    }
}

struct MenuItem {
    static let dashboard = ["name": "Dashboard", "icon": FontAwesome.tachometerAlt.rawValue, "link": LeftMenu.Dashboard.rawValue]
    static let weather = ["name": "Weather Forecast", "icon": FontAwesome.cloudSun.rawValue, "link": LeftMenu.WeatherForecast.rawValue]
    static let calendar = ["name": "Calendar", "icon": FontAwesome.calendarDay.rawValue, "link": LeftMenu.Schedule.rawValue]
    static let customer = ["name": "Customers", "icon": FontAwesome.users.rawValue, "link": LeftMenu.Customers.rawValue]
    static let workOrder = ["name": "Work Order", "icon": FontAwesome.userClock.rawValue, "link": LeftMenu.WorkOrder.rawValue]
    static let estimates = ["name": "Estimates", "icon": FontAwesome.calculatorAlt.rawValue, "link": LeftMenu.Estimates.rawValue]
    static let invoices = ["name": "Invoices", "icon": FontAwesome.fileInvoiceDollar.rawValue, "link": LeftMenu.Invoices.rawValue]
    static let inventory = ["name": "Inventory", "icon": FontAwesome.clipboardList.rawValue, "link": LeftMenu.Inventory.rawValue]
    static let quickLinks = ["name": "Quick Links", "icon": FontAwesome.link.rawValue, "link": LeftMenu.QuickLinks.rawValue]
    static let contacts = ["name": "Business Contacts", "icon": FontAwesome.addressBook.rawValue, "link": LeftMenu.BusinessContacts.rawValue]
    static let leads = ["name": "Leads", "icon": FontAwesome.clipboardCheck.rawValue, "link": LeftMenu.Leads.rawValue]
    static let accounting = ["name": "Accounting", "icon": FontAwesome.fileExcel.rawValue, "link": LeftMenu.Accounting.rawValue]
    static let filesVault = ["name": "Files Vault", "icon": FontAwesome.inbox.rawValue, "link": LeftMenu.FileVault.rawValue]
    static let reports = ["name": "Reports", "icon": FontAwesome.chartLine.rawValue, "link": LeftMenu.Reports.rawValue]
    static let marketing = ["name": "Marketing", "icon": FontAwesome.bullhorn.rawValue, "link": LeftMenu.Marketing.rawValue]
    static let eSign = ["name": "eSign", "icon": FontAwesome.signature.rawValue, "link": LeftMenu.eSign.rawValue]
    static let employees = ["name": "Employees", "icon": FontAwesome.users.rawValue, "link": LeftMenu.Employees.rawValue]
    static let trac360 = ["name": "Trac360", "icon": FontAwesome.mapMarkerAlt.rawValue, "link": LeftMenu.Trac360.rawValue]
    static let tasks = ["name": "Tasks", "icon": FontAwesome.tasks.rawValue, "link": LeftMenu.Tasks.rawValue]
    static let timeClock = ["name": "Time Clock", "icon": FontAwesome.stopwatch.rawValue, "link": LeftMenu.TimeClock.rawValue]
    static let routePlanner = ["name": "Route Planner", "icon": FontAwesome.truckMoving.rawValue, "link": LeftMenu.RoutePlanner.rawValue]
    static let bulletin = ["name": "Bulletin", "icon": FontAwesome.newspaper.rawValue, "link": LeftMenu.Bulletin.rawValue]
    static let collageMaker = ["name": "Collage Maker", "icon": FontAwesome.cameraRetro.rawValue, "link": LeftMenu.CollageMaker.rawValue]
    static let costEstimator = ["name": "Cost Estimator", "icon": FontAwesome.calculator.rawValue, "link": LeftMenu.CostEstimator.rawValue]
    static let virtualEstimator = ["name": "Virtual Estimator", "icon": FontAwesome.route.rawValue, "link": LeftMenu.VirtualEstimator.rawValue]
    static let more = ["name": "More", "icon": FontAwesome.ellipsisH.rawValue, "link": ""]
    static let back = ["name": "Back", "icon": FontAwesome.replyAll.rawValue, "link": ""]
    
    var asDictionary : [String:Any] {
        let mirror = Mirror(reflecting: self)
        let dict = Dictionary(uniqueKeysWithValues: mirror.children.lazy.map({ (label:String?, value:Any) -> (String, Any)? in
            guard let label = label else { return nil }
            return (label, value)
        }).compactMap { $0 })
        return dict
    }
}
