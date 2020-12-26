//
//  ScheduleTabController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 18/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import EventKit
import Floaty
import FontAwesome_swift
import SVProgressHUD

class ScheduleTabController: UITabBarController, UITabBarControllerDelegate {
    
    // MARK: - Properties -
    
    @IBOutlet var editBarButton: UIBarButtonItem!
    @IBOutlet var deleteBarButton: UIBarButtonItem!
    
    var floaty = Floaty()
    
    let item = App.shared.selectedEvent!
    
    
    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initFAB()
        
        // set title
        self.navigationItem.title = "Schedule Details"
        
        // configure navBar icons
        editBarButton.image = UIImage.fontAwesomeIcon(name: .edit, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        deleteBarButton.image = UIImage.fontAwesomeIcon(name: .trashAlt, style: .regular, textColor: .white, size: CGSize(width: 24, height: 24))
        
        // configure tab bar
        let tabs = ["Arrival", "Start", "Pause", "Complete", "More"]
        let icons: [FontAwesome] = [.truckMoving, .stopwatch, .pauseCircle, .clipboardCheck, .ellipsisH]
        var tabBarList: [UIViewController] = []
        
        for (index, value) in tabs.enumerated() {
            let image = UIImage.fontAwesomeIcon(name: icons[index], style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 24, height: 24))
            let tabBarItem  = UITabBarItem(title: value, image: image, tag: index)
            let controller = self.storyboard?.instantiateViewController(withIdentifier: "sb_EventDetailController") as! EventDetailController
            controller.tabBarItem = tabBarItem
            tabBarList.append(controller)
        }
        
        //self.tabBar.tintColor = AppTheme.defaultColor
        self.viewControllers = tabBarList
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - UITabBarControllerDelegate -
    
    override func tabBar(_ tabBar: UITabBar, didSelect item: UITabBarItem) {
        
    }
    
    // MARK: - Functions -
    
    func initCalendar() {
        // 1
        let eventStore = EKEventStore()
        // 2
        switch EKEventStore.authorizationStatus(for: .event) {
            case .authorized:
                insertEvent(eventStore)
            case .denied:
                print("Access denied")
            case .notDetermined:
            // 3
                eventStore.requestAccess(to: .event, completion:
                  {[weak self] (granted: Bool, error: Error?) -> Void in
                      if granted {
                        self?.insertEvent(eventStore)
                      } else {
                            print("Access denied")
                      }
                })
            default:
                print("Case default")
        }
    }
    
    func insertEvent(_ store: EKEventStore) {
        let event: EKEvent = EKEvent(eventStore: store)
        event.title = item.customer_name
        event.startDate = Date(fromString: "\(item.start_date) \(item.start_time)", format: DateHelper.dateTime2FormatType)!
        event.endDate = Date(fromString: "\(item.end_date) \(item.end_time)", format: DateHelper.dateTime2FormatType)!
        event.notes = item.event_description
        event.calendar = store.defaultCalendarForNewEvents
          
        do {
            try store.save(event, span: .thisEvent)
        } catch let error as NSError {
            print("failed to save event with error : \(error)")
        }
        
        SVProgressHUD.showSuccess(withStatus: "Event was saved successfully!")
    }
    
    // MARK: - Actions -
    
    @IBAction func editButtonTapped(_ sender: Any) {
        let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_EditEventController") as? EditEventController
        viewController?.item = item
        self.navigationController?.pushViewController(viewController!, animated: true)
    }
    
    @IBAction func deleteButtonTapped(_ sender: Any) {
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show(withStatus: "Deleting...")
        App.shared.api.deleteEvent(item.id.intValue) { (success, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard success == true else {
                return SVProgressHUD.showError(withStatus: "Deleting item failed!")
            }
            
            self.popViewController()
        }
    }

}

// MARK: - Floaty Delegate -

extension ScheduleTabController: FloatyDelegate {
    
    func initFAB() {
        
        // init
        floaty.fabDelegate  = self
        floaty.sticky       = true
        floaty.buttonColor  = .clear
        floaty.buttonImage  = UIImage.fontAwesomeIcon(name: .plus, style: .solid, textColor: .clear, size: CGSize(width: 30, height: 30))
        floaty.paddingY     = 0
        
        floaty.addItem("Add to iCloud Calendar", icon: UIImage.fontAwesomeIcon(name: .calendarPlus, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            self.floaty.close()
            // add to icloud calendar
            self.initCalendar()
        })
        floaty.addItem("Create Estimate", icon: UIImage.fontAwesomeIcon(name: .calculator, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            self.floaty.close()
            // create estimate
            let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_AddStandardEstimateController") as? AddStandardEstimateController
            viewController?.selectedCustomer = Helpers.getCustomerById(self.item.customer_id)
            self.navigationController?.pushViewController(viewController!, animated: true)
        })
        floaty.addItem("Create Invoice", icon: UIImage.fontAwesomeIcon(name: .fileInvoiceDollar, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            self.floaty.close()
            // create invoice
            let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_AddInvoiceController") as? AddInvoiceController
            viewController?.selectedCustomer = Helpers.getCustomerById(self.item.customer_id)
            self.navigationController?.pushViewController(viewController!, animated: true)
        })
        floaty.addItem("Create Work Order", icon: UIImage.fontAwesomeIcon(name: .userClock, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            self.floaty.close()
            // create estimate
            let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_AddWorkOrderController") as? AddWorkOrderController
            viewController?.selectedCustomer = Helpers.getCustomerById(self.item.customer_id)
            self.navigationController?.pushViewController(viewController!, animated: true)
        })
        self.view.addSubview(floaty)
    }
}
