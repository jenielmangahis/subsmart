//
//  RecordPaymentController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 14/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import DLRadioButton
import SVProgressHUD

class RecordPaymentController: UITableViewController {
    
    // MARK: - Properties -

    @IBOutlet var invoiceNumber: UILabel!
    @IBOutlet var paidField: MaterialTextField!
    @IBOutlet var amountReceivedField: MaterialTextField!
    @IBOutlet var paymentDateField: MaterialDatePickerField!
    @IBOutlet var checkButton: DLRadioButton!
    @IBOutlet var cashButton: DLRadioButton!
    @IBOutlet var creditCardButton: DLRadioButton!
    @IBOutlet var directDepositButton: DLRadioButton!
    @IBOutlet var creditButton: DLRadioButton!
    @IBOutlet var saveButton: DesignableButton!
    
    let item: Invoice = App.shared.selectedInvoice!
    var payment: Payment?
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
        loadData()
                
        self.title = "Record Payment"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Load data -
    
    func loadData() {
        // call api
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show()
        App.shared.api.getPayment(item.id.intValue) { (result, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            if let e = error {
                return print(e.localizedDescription)
            }
            
            self.payment = result
        }
    }
    
    // MARK: - Functions -
    
    func initViews() {
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
        
        checkButton.otherButtons = [cashButton, creditCardButton, directDepositButton, creditButton]
        checkButton.configureRadio(true)
        cashButton.configureRadio()
        creditCardButton.configureRadio()
        directDepositButton.configureRadio()
        creditButton.configureRadio()
        
        invoiceNumber.text          = item.invoice_number
        paidField.text              = "$0 of $" + item.total_due
        amountReceivedField.text    = item.total_due
    }
    
    func markAsPaid() {
        // params
        let params: Parameters = ["status": "Paid"]
        
        // update
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show()
        App.shared.api.putInvoice(item.id.intValue, params: params) { (success, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            
            SVProgressHUD.show(withStatus: "Payment Successful...")
            self.popViewController()
        }
    }
    
    // MARK: - Actions -
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        self.popViewController()
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        
        // get payment method
        var method = "Check"
        // check
        if checkButton.isSelected {
            method = "Check"
        } else if cashButton.isSelected {
            method = "Cash"
        } else if creditCardButton.isSelected {
            method = "Credit Card"
        } else if directDepositButton.isSelected {
            method = "Direct Deposit"
        } else if creditButton.isSelected {
            method = "Credit"
        }
        
        let params: Parameters = ["company_id": App.shared.companyId,
                                   "invoice_id": item.id,
                                   "amount": amountReceivedField.text!,
                                   "payment_date": App.shared.dateFormatter.string(from: paymentDateField.date),
                                   "payment_method": method]
        
        // check
        if let payment = self.payment {
            // update
            SVProgressHUD.setDefaultMaskType(.clear)
            SVProgressHUD.show(withStatus: "Saving...")
            App.shared.api.putPayment(payment.id.intValue, params: params) { (success, error) in
                SVProgressHUD.setDefaultMaskType(.none)
                SVProgressHUD.dismiss()
                guard error == nil else {
                    return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                }
                
                self.markAsPaid()
            }
        } else {
            // add
            SVProgressHUD.setDefaultMaskType(.clear)
            SVProgressHUD.show(withStatus: "Saving...")
            App.shared.api.postPayment(params) { (result, error) in
                SVProgressHUD.setDefaultMaskType(.none)
                SVProgressHUD.dismiss()
                guard error == nil else {
                    return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                }
                guard result?.Code == 200 else {
                    return SVProgressHUD.showError(withStatus: result!.Message)
                }
                
                self.markAsPaid()
            }
        }
    }
    
}
