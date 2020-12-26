//
//  EditInventoryController.swift
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

class EditInventoryController: UITableViewController {
    
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
    
    var item: Item!
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        configureViews()
        loadData()
            
        self.title = "Edit Item"
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
        priceField.keyboardType     = .numberPad
        quantityField.keyboardType  = .numberPad
    }
    
    // MARK: - Load data -
    
    func loadData() {
        nameField.text          = item.title
        descriptionField.text   = item.descriptionn
        priceField.text         = item.price
        pricePerField.setSelectedOption(option: item.cost_per)
        quantityField.text      = item.units
        vendorField.setSelectedOption(option: Helpers.getVendorById(item.vendor_id)?.vendor_name)
        itemTypeField.setSelectedOption(option: item.type)
        itemCostField.text      = item.COGS
        brandField.text         = item.brand
        modelField.text         = item.model
        urlField.text           = item.url
        notesField.text         = item.notes
    }
    
    // MARK: - Actions -
    
    @IBAction func addLocationButtonTapped(_ sender: Any) {
        let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_ItemLocationsController") as? ItemLocationsController
        viewController?.item = self.item
        self.navigationController?.pushViewController(viewController!, animated: true)
    }
    
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
        
        // save data to remote db
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show(withStatus: "Saving...")
        App.shared.api.putItem(item.id.intValue, params: params) { (success, error) in
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
