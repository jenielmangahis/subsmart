//
//  MembershipController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 02/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import Kingfisher
import SVProgressHUD

class MembershipController: UITableViewController {

    // MARK: - Properties -
    
    @IBOutlet var logo: UIImageView!
    @IBOutlet var businessName: UILabel!
    @IBOutlet var numOfEmployees: UILabel!
    @IBOutlet var subscriptionType: UILabel!
    @IBOutlet var validFrom: UILabel!
    @IBOutlet var validTo: UILabel!
    @IBOutlet var nextBillingDate: UILabel!
    @IBOutlet var nextPayment: UILabel!
    @IBOutlet var autoRenewalSwitch: UISwitch!
    
    var item: BusinessProfile?
    let logoKey = "BUSINESS_LOGO_\(App.shared.companyId)"
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        loadData()
        
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
    }
    
    override func viewWillAppear(_ animated: Bool) {
        self.parent?.navigationItem.title = "Membership"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Load data -
    
    func loadData() {
        // configure logo
        if let image = UserDefaults.standard.imageForKey(key: logoKey) {
            logo.image = image
        }
        
        // call api
        SVProgressHUD.show(withStatus: "Loading...")
        App.shared.api.getBusinessProfile() { (item, error) in
            SVProgressHUD.dismiss()
            if let e = error {
                return SVProgressHUD.showError(withStatus: e.localizedDescription)
            }
            
            self.item                       = item
            self.businessName.text          = item?.business_name
            self.numOfEmployees.text        = item?.employee_count
            self.subscriptionType.text      = "\(item!.nsmart_plans_name) Plan"
            self.validFrom.text             = item?.nsmart_plans_valid_from.toReadableDate
            self.validTo.text               = item?.nsmart_plans_valid_to.toReadableDate
            self.nextBillingDate.text       = item?.nsmart_plans_next_billing_date.toReadableDate
            self.nextPayment.text           = "$\(item!.nsmart_plans_price)"
            self.autoRenewalSwitch.isOn     = item!.nsmart_plans_is_auto_renew
        }
    }
    
    // MARK: - Actions -
    
    @IBAction func autoRenewalSwitchValueChanged(_ sender: Any) {
        self.view.endEditing(true)
        
        let params: Parameters = ["nsmart_plans_is_auto_renew": autoRenewalSwitch.isOn]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show()
        App.shared.api.putBusinessProfile(params) { (success, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard success == true else {
                return SVProgressHUD.showError(withStatus: "Saving data failed!")
            }
            
            SVProgressHUD.showSuccess(withStatus: "Data has been saved!")
        }
    }
    
    @IBAction func addEmployeeButtonTapped(_ sender: Any) {
    }
    
}
