//
//  DisplayFeatureSettingsController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 03/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import DLRadioButton
import SVProgressHUD

class DisplayFeatureSettingsController: UITableViewController {

    // MARK: - Properties -
    
    @IBOutlet var btnLeads: DLRadioButton!
    @IBOutlet var btnCustomers: DLRadioButton!
    @IBOutlet var btnEstimates: DLRadioButton!
    @IBOutlet var btnInvoices: DLRadioButton!
    @IBOutlet var btnCalendar: DLRadioButton!
    @IBOutlet var btnWorkOrder: DLRadioButton!
    @IBOutlet var btnEmployees: DLRadioButton!
    @IBOutlet var btnRoutePlanner: DLRadioButton!
    @IBOutlet var btnReports: DLRadioButton!
    @IBOutlet var btnAccounting: DLRadioButton!
    @IBOutlet var btnCollageMaker: DLRadioButton!
    @IBOutlet var btnCostEstimator: DLRadioButton!
    @IBOutlet var btnVirtualEstimator: DLRadioButton!
    @IBOutlet var btnClockInOut: DLRadioButton!
    @IBOutlet var btnMarketing: DLRadioButton!
    @IBOutlet var btnTrac360: DLRadioButton!
    @IBOutlet var btnInventory: DLRadioButton!
    @IBOutlet var btnQuickLinks: DLRadioButton!
    @IBOutlet var btnContacts: DLRadioButton!
    @IBOutlet var btnFilesVault: DLRadioButton!
    @IBOutlet var btnESign: DLRadioButton!
    @IBOutlet var btnTasks: DLRadioButton!
    @IBOutlet var btnBulletin: DLRadioButton!
    @IBOutlet var btnWizard: DLRadioButton!
    
    var dict: [String: DLRadioButton] = [:]
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
                
        self.title = "Customize Display Feature"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func initViews() {
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
        
        // init
        dict = ["Leads": btnLeads, "Customers": btnCustomers, "Estimates": btnEstimates, "Invoices": btnInvoices, "Calendar": btnCalendar, "Work Order": btnWorkOrder, "Employees": btnEmployees, "Route Planner": btnRoutePlanner, "Reports": btnReports, "Accounting": btnAccounting, "Collage Maker": btnCollageMaker, "Cost Estimator": btnCostEstimator, "Virtual Estimator": btnVirtualEstimator, "Time Clock": btnClockInOut, "Marketing": btnMarketing, "Trac360": btnTrac360, "Inventory": btnInventory, "Quick Links": btnQuickLinks, "Business Contacts": btnContacts, "Files Vault": btnFilesVault, "eSign": btnESign, "Tasks": btnTasks, "Bulletin": btnBulletin, "Wizard": btnWizard]
        
        
        // check
        if let menus = App.shared.user?.menus {
            btnLeads.configure(menus.contains("Leads"))
            btnCustomers.configure(menus.contains("Customers"))
            
            btnEstimates.configure(menus.contains("Estimates"))
            btnInvoices.configure(menus.contains("Invoices"))
            
            btnCalendar.configure(menus.contains("Calendar"))
            btnWorkOrder.configure(menus.contains("Work Order"))
            btnEmployees.configure(menus.contains("Employees"))
            btnRoutePlanner.configure(menus.contains("Route Planner"))
            
            btnReports.configure(menus.contains("Reports"))
            
            btnAccounting.configure(menus.contains("Accounting"))
            btnCollageMaker.configure(menus.contains("Collage Maker"))
            btnCostEstimator.configure(menus.contains("Cost Estimator"))
            btnVirtualEstimator.configure(menus.contains("Virtual Estimator"))
            btnClockInOut.configure(menus.contains("Time Clock"))
            btnMarketing.configure(menus.contains("Marketing"))
            btnTrac360.configure(menus.contains("Trac360"))
            btnInventory.configure(menus.contains("Inventory"))
            btnQuickLinks.configure(menus.contains("Quick Links"))
            btnContacts.configure(menus.contains("Business Contacts"))
            btnFilesVault.configure(menus.contains("Files Vault"))
            btnESign.configure(menus.contains("eSign"))
            btnTasks.configure(menus.contains("Tasks"))
            btnBulletin.configure(menus.contains("Bulletin"))
            btnWizard.configure(menus.contains("Wizard"))
        }
    }
    
    // MARK: - Functions -
    
    func getAllCheckboxes() -> [DLRadioButton] {
        let array = (Array(dict.values))
        return array
    }
    
    func getMenu(_ object: DLRadioButton) -> String {
        if let key = dict.key(from: object) {
            return key
        }
        return ""
    }
    
    // MARK: Actions -
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.popViewController()
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        
        var menus: [String] = []
        let checkboxes = getAllCheckboxes()
        // iterate
        for item in checkboxes {
            // check
            if item.isSelected {
                let menu = getMenu(item)
                menus.append(menu)
            }
        }
        
        let params: Parameters = ["menus": menus.joined(separator: ", ")]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show(withStatus: "Saving...")
        App.shared.api.putUser((App.shared.user?.id.intValue)!, params: params) { (success, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard success == true else {
                return SVProgressHUD.showError(withStatus: "Saving data failed!")
            }
            
            App.shared.appUser.refreshUser()
            SVProgressHUD.showSuccess(withStatus: "Data has been saved!")
        }
    }

}
