//
//  WorkOrderSettingsController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 03/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import DLRadioButton
import SVProgressHUD

class WorkOrderSettingsController: UITableViewController {

    // MARK: - Properties -
    
    @IBOutlet var prefixField: MaterialTextField!
    @IBOutlet var nextNumField: MaterialTextField!
    @IBOutlet var btnCaptureESignature: DLRadioButton!
    
    var item: WorkOrderSetting?
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
                
        self.title = "Work Order Settings"
    }
    
    override func viewWillAppear(_ animated: Bool) {
        loadData()
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Load data -
    
    func loadData() {
        // call api
        SVProgressHUD.show(withStatus: "Loading...")
        App.shared.api.getWorkOrderSetting() { (item, error) in
            SVProgressHUD.dismiss()
            if let e = error {
                return SVProgressHUD.showError(withStatus: e.localizedDescription)
            }
            
            self.item                               = item
            self.prefixField.text                   = item?.work_order_num_prefix
            self.nextNumField.text                  = item?.work_order_num_next.format5DigitNumber
            self.btnCaptureESignature.isSelected    = item?.capture_customer_signature ?? true
        }
    }
    
    // MARK: - Functions -
    
    func initViews() {
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
        
        btnCaptureESignature.configure()
    }
    
    // MARK: - Actions -
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        self.popViewController()
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        
        let params: Parameters = ["company_id": App.shared.companyId,
                                  "work_order_num_prefix": prefixField.text!,
                                  "work_order_num_next": nextNumField.text!,
                                  "capture_customer_signature": btnCaptureESignature.isSelected]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show()
        App.shared.api.putWorkOrderSetting(params) { (success, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard success == true else {
                return SVProgressHUD.showError(withStatus: "Saving data failed!")
            }
            
            SVProgressHUD.showSuccess(withStatus: "Settings has been saved!")
        }
    }

}
