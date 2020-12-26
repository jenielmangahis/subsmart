//
//  EstimateSettingsController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 03/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import DLRadioButton
import SVProgressHUD

class EstimateSettingsController: UITableViewController {

    // MARK: - Properties -
    
    @IBOutlet var prefixField: MaterialTextField!
    @IBOutlet var nextNumField: MaterialTextField!
    @IBOutlet var expireField: MaterialDropdownField!
    @IBOutlet var btnCaptureESignature: DLRadioButton!
    @IBOutlet var btnHideItemPrice: DLRadioButton!
    @IBOutlet var btnHideItemQty: DLRadioButton!
    @IBOutlet var btnHideItemTax: DLRadioButton!
    @IBOutlet var btnHideItemDiscount: DLRadioButton!
    @IBOutlet var btnHideItemTotal: DLRadioButton!
    @IBOutlet var btnHideGrandTotal: DLRadioButton!
    @IBOutlet var defaultMessageField: MaterialTextField!
    @IBOutlet var termField: MaterialTextField!
    
    var item: EstimateSetting?
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
                
        self.title = "Estimate Settings"
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
        App.shared.api.getEstimateSetting() { (item, error) in
            SVProgressHUD.dismiss()
            if let e = error {
                return SVProgressHUD.showError(withStatus: e.localizedDescription)
            }
            
            self.item                               = item
            self.prefixField.text                   = item?.estimate_num_prefix
            self.nextNumField.text                  = item?.estimate_num_next.format5DigitNumber
            self.btnCaptureESignature.isSelected    = item?.capture_customer_signature ?? true
            self.btnHideItemPrice.isSelected        = item?.hide_item_price ?? true
            self.btnHideItemQty.isSelected          = item?.hide_item_qty ?? true
            self.btnHideItemTax.isSelected          = item?.hide_item_tax ?? true
            self.btnHideItemDiscount.isSelected     = item?.hide_item_discount ?? true
            self.btnHideItemTotal.isSelected        = item?.hide_item_total ?? true
            self.btnHideGrandTotal.isSelected       = item?.hide_grand_total ?? true
            self.defaultMessageField.text           = item?.message
            self.termField.text                     = item?.terms_and_conditions
            
            self.expireField.setSelectedOption(option: item?.default_expire_period)
        }
    }
    
    // MARK: - Functions -
    
    func initViews() {
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
        
        expireField.updateOptions(options: ["2 weeks", "3 weeks", "4 weeks", "5 weeks", "6 weeks"])
        
        btnHideItemPrice.otherButtons = [btnHideItemQty, btnHideItemTax, btnHideItemDiscount, btnHideItemTotal, btnHideGrandTotal]
        btnHideItemPrice.configure()
        
        // iterate otherButtons
        for checkbox in btnHideItemPrice.otherButtons {
            checkbox.configure()
        }
        
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
                                  "estimate_num_prefix": prefixField.text!,
                                  "estimate_num_next": nextNumField.text!,
                                  "default_expire_period": expireField.text!,
                                  "capture_customer_signature": btnCaptureESignature.isSelected,
                                  "hide_item_price": btnHideItemPrice.isSelected,
                                  "hide_item_qty": btnHideItemQty.isSelected,
                                  "hide_item_tax": btnHideItemTax.isSelected,
                                  "hide_item_discount": btnHideItemDiscount.isSelected,
                                  "hide_item_total": btnHideItemTotal.isSelected,
                                  "hide_grand_total": btnHideGrandTotal.isSelected,
                                  "message": defaultMessageField.text!,
                                  "terms_and_conditions": termField.text!]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show()
        App.shared.api.putEstimateSetting(params) { (success, error) in
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
