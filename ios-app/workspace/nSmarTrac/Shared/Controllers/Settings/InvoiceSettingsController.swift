//
//  InvoiceSettingsController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 03/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import DLRadioButton
import SVProgressHUD

class InvoiceSettingsController: UITableViewController {

    // MARK: - Properties -
    
    @IBOutlet var prefixField: MaterialTextField!
    @IBOutlet var nextNumField: MaterialTextField!
    @IBOutlet var checksPayableToField: MaterialTextField!
    @IBOutlet var dueTermsField: MaterialDropdownField!
    @IBOutlet var btnCreditCard: DLRadioButton!
    @IBOutlet var btnCheck: DLRadioButton!
    @IBOutlet var btnCash: DLRadioButton!
    @IBOutlet var btnDirectDeposit: DLRadioButton!
    @IBOutlet var btnCredit: DLRadioButton!
    @IBOutlet var btnHideItemPrice: DLRadioButton!
    @IBOutlet var btnHideItemQty: DLRadioButton!
    @IBOutlet var btnHideItemTax: DLRadioButton!
    @IBOutlet var btnHideItemDiscount: DLRadioButton!
    @IBOutlet var btnHideItemTotal: DLRadioButton!
    @IBOutlet var btnAcceptTip: DLRadioButton!
    @IBOutlet var btnCaptureESignature: DLRadioButton!
    @IBOutlet var btnAutoConvertToInvoice: DLRadioButton!
    @IBOutlet var defaultMessageField: MaterialTextField!
    @IBOutlet var termField: MaterialTextField!
    
    var item: InvoiceSetting?
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
                
        self.title = "Invoice Settings"
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
        App.shared.api.getInvoiceSetting() { (item, error) in
            SVProgressHUD.dismiss()
            if let e = error {
                return SVProgressHUD.showError(withStatus: e.localizedDescription)
            }
            
            self.item                               = item
            self.prefixField.text                   = item?.invoice_num_prefix
            self.nextNumField.text                  = item?.invoice_num_next.format5DigitNumber
            self.checksPayableToField.text          = item?.check_payable_to
            self.btnCreditCard.isSelected           = item?.accept_credit_card ?? true
            self.btnCheck.isSelected                = item?.accept_check ?? true
            self.btnCash.isSelected                 = item?.accept_cash ?? true
            self.btnDirectDeposit.isSelected        = item?.accept_direct_deposit ?? true
            self.btnCredit.isSelected               = item?.accept_credit ?? false
            self.btnHideItemPrice.isSelected        = item?.hide_item_price ?? true
            self.btnHideItemQty.isSelected          = item?.hide_item_qty ?? true
            self.btnHideItemTax.isSelected          = item?.hide_item_tax ?? true
            self.btnHideItemDiscount.isSelected     = item?.hide_item_discount ?? true
            self.btnHideItemTotal.isSelected        = item?.hide_item_total ?? true
            self.btnAcceptTip.isSelected            = item?.accept_tip ?? true
            self.btnCaptureESignature.isSelected    = item?.capture_customer_signature ?? true
            self.btnAutoConvertToInvoice.isSelected = item?.auto_convert_completed_work_order ?? true
            self.defaultMessageField.text           = item?.message
            self.termField.text                     = item?.terms_and_conditions
            
            self.dueTermsField.setSelectedOption(option: item?.due_terms)
        }
    }
    
    // MARK: - Functions -
    
    func initViews() {
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
        
        dueTermsField.updateOptions(options: ["", "Due on Receipt", "Net 7", "Net 15", "Net 30", "Net 45"])
        
        btnCreditCard.otherButtons = [btnCheck, btnCash, btnDirectDeposit, btnCredit]
        btnCreditCard.configure()
        
        // iterate otherButtons
        for checkbox in btnCreditCard.otherButtons {
            checkbox.configure()
        }
        
        btnHideItemPrice.otherButtons = [btnHideItemQty, btnHideItemTax, btnHideItemDiscount, btnHideItemTotal]
        btnHideItemPrice.configure()
        
        // iterate otherButtons
        for checkbox in btnHideItemPrice.otherButtons {
            checkbox.configure()
        }
        
        btnAcceptTip.configure()
        btnCaptureESignature.configure()
        btnAutoConvertToInvoice.configure()
        
    }
    
    // MARK: - Actions -
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        self.popViewController()
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        
        let params: Parameters = ["company_id": App.shared.companyId,
                                  "invoice_num_prefix": prefixField.text!,
                                  "invoice_num_next": nextNumField.text!,
                                  "check_payable_to": checksPayableToField.text!,
                                  "accept_credit_card": btnCreditCard.isSelected,
                                  "accept_check": btnCheck.isSelected,
                                  "accept_cash": btnCash.isSelected,
                                  "accept_direct_deposit": btnDirectDeposit.isSelected,
                                  "accept_credit": btnCredit.isSelected,
                                  "hide_item_price": btnHideItemPrice.isSelected,
                                  "hide_item_qty": btnHideItemQty.isSelected,
                                  "hide_item_tax": btnHideItemTax.isSelected,
                                  "hide_item_discount": btnHideItemDiscount.isSelected,
                                  "hide_item_total": btnHideItemTotal.isSelected,
                                  "accept_tip": btnAcceptTip.isSelected,
                                  "due_terms": dueTermsField.text!,
                                  "capture_customer_signature": btnCaptureESignature.isSelected,
                                  "auto_convert_completed_work_order": btnAutoConvertToInvoice.isSelected,
                                  "message": defaultMessageField.text!,
                                  "terms_and_conditions": termField.text!]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show()
        App.shared.api.putInvoiceSetting(params) { (success, error) in
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
