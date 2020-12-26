//
//  EditFileController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 30/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import SVProgressHUD

class EditFileController: UITableViewController {

    // MARK: - Properties -
    
    @IBOutlet var uploadedFileLabel: UILabel!
    @IBOutlet var nameField: MaterialTextField!
    @IBOutlet var attachToEstimateField: MaterialDropdownField!
    @IBOutlet var attachToInvoiceField: MaterialDropdownField!
    
    var item: File!
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
        loadData()
                
        self.title = "Edit File"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func initViews() {
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
        
        // configure dropdown
        attachToEstimateField.updateOptions(options: ["-select-", "Residential and Commercial Estimates", "Residential Estimates", "Commercial Estimates"])
        attachToInvoiceField.updateOptions(options: ["-select-", "Residential and Commercial Invoices", "Residential Invoices", "Commercial Invoices"])
    }
    
    // MARK: - Load data -
    
    func loadData() {
        uploadedFileLabel.text  = item.title
        nameField.text          = item.name
        
        attachToEstimateField.setSelectedOption(option: item.attach_to_estimates)
        attachToInvoiceField.setSelectedOption(option: item.attach_to_invoices)
    }
    
    // MARK: - Actions -
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        self.popViewController()
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        
        let params: Parameters = ["name": nameField.text!,
                                  "attach_to_estimates": attachToEstimateField.text!,
                                  "attach_to_invoices": attachToInvoiceField.text!,
                                  "company_id": App.shared.companyId]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show(withStatus: "Saving...")
        App.shared.api.putFile(item.file_id.intValue, params: params) { (success, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard success == true else {
                return SVProgressHUD.showError(withStatus: "Saving data failed!")
            }
                
            SVProgressHUD.showSuccess(withStatus: "Data has been saved!")
            self.popViewController()
        }
    }

}
