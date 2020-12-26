//
//  AddInventoryController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 20/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import AnyFormatKit
import RxSwift
import RxCocoa
import SVProgressHUD

class AddInventoryController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var nameField: MaterialTextField!
    @IBOutlet var descriptionField: MaterialTextField!
    @IBOutlet var priceField: MaterialTextField!
    @IBOutlet var pricePerField: MaterialDropdownField!
    @IBOutlet var quantityField: MaterialTextField!
    @IBOutlet var vendorField: MaterialDropdownField!
    @IBOutlet var itemTypeField: MaterialDropdownField!
    @IBOutlet var itemCostField: MaterialTextField!
    @IBOutlet var brandField: MaterialTextField!
    @IBOutlet var modelField: MaterialTextField!
    @IBOutlet var urlField: MaterialTextField!
    @IBOutlet var notesField: MaterialTextField!
    @IBOutlet var submitButton: DesignableButton!
    
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        configureViews()
            
        self.title = "Add Item"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func configureViews() {
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
        
        // configure dropdown
        pricePerField.updateOptions(options: ["Each", "Weight", "Length", "Area", "Volume", "Other"])
        vendorField.updateOptions(options: Helpers.getVendors())
        itemTypeField.updateOptions(options: ["Service", "Material", "Product", "Fee"])
        
        // configure textfields
        priceField.keyboardType = .numberPad
    }
    
    // MARK: - Actions -
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        self.popViewController()
    }
    
    @IBAction func submitButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        
        let params: Parameters = ["company_id": App.shared.companyId,
                                  "title": nameField.text!,
                                  "description": descriptionField.text!,
                                  "price": priceField.text!,
                                  "units": quantityField.text!,
                                  "vendor_id": Helpers.getVendorId(vendorField.text!),
                                  "type": itemTypeField.text!,
                                  "COGS": itemCostField.text!,
                                  "brand": brandField.text!,
                                  "model": modelField.text!,
                                  "url": urlField.text!,
                                  "notes": notesField.text!,
                                  "is_active": 1]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show(withStatus: "Saving...")
        App.shared.api.postItem(params) { (result, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard result?.Code == 200 else {
                return SVProgressHUD.showError(withStatus: result!.Message)
            }
            
            SVProgressHUD.showSuccess(withStatus: "Data has been saved!")
            self.popViewController()
        }
    }
    
}
