//
//  BusinessCredentialsController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 01/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import AnyFormatKit
import DLRadioButton
import SVProgressHUD

class BusinessCredentialsController: UITableViewController {

    // MARK: - Properties -
    
    @IBOutlet var btnInsured: DLRadioButton!
    @IBOutlet var btnBonded: DLRadioButton!
    @IBOutlet var btnLicensed: DLRadioButton!
    @IBOutlet var btnBBBAcredited: DLRadioButton!
    @IBOutlet var insuranceAmountField: MaterialTextField!
    @IBOutlet var insuranceExpiryDateField: MaterialDatePickerField!
    @IBOutlet var bondAmountField: MaterialTextField!
    @IBOutlet var bondExpiryDateField: MaterialDatePickerField!
    @IBOutlet var licenseClassField: MaterialTextField!
    @IBOutlet var licenseNumField: MaterialTextField!
    @IBOutlet var licenseStateField: MaterialDropdownField!
    @IBOutlet var licenseExpiryDateField: MaterialDatePickerField!
    @IBOutlet var bbbLinkField: MaterialTextField!
    
    var isInsured: Bool = false
    var isBonded: Bool = false
    var isLicensed: Bool = false
    var isBBBAccredited: Bool = false
    var item: BusinessProfile?
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
                
        self.title = "Business Credentials"
    }
    
    override func viewWillAppear(_ animated: Bool) {
        loadData()
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func initViews() {
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
        
        btnInsured.configure()
        btnInsured.titleLabel?.font = UIFont.robotoBoldFont(ofSize: 15)
        
        btnBonded.configure()
        btnBonded.titleLabel?.font = UIFont.robotoBoldFont(ofSize: 15)
        
        btnLicensed.configure()
        btnLicensed.titleLabel?.font = UIFont.robotoBoldFont(ofSize: 15)
        
        btnBBBAcredited.configure()
        btnBBBAcredited.titleLabel?.font = UIFont.robotoBoldFont(ofSize: 15)
        
        
        licenseStateField.updateOptions(options: States.getAllStates())
    }
    
    // MARK: - Load data -
    
    func loadData() {
        // call api
        SVProgressHUD.show(withStatus: "Loading...")
        App.shared.api.getBusinessProfile() { (item, error) in
            SVProgressHUD.dismiss()
            if let e = error {
                return SVProgressHUD.showError(withStatus: e.localizedDescription)
            }
            
            self.item                           = item
            self.insuranceAmountField.text      = item?.insured_amount
            self.insuranceExpiryDateField.date  = Date(fromString: item!.insurance_expiry_date, format: DateHelper.dateFormatType) ?? Date()
            self.bondAmountField.text           = item?.bond_amount
            self.bondExpiryDateField.date       = Date(fromString: item!.bond_expiry_date, format: DateHelper.dateFormatType) ?? Date()
            self.licenseClassField.text         = item?.license_class
            self.licenseNumField.text           = item?.license_number
            self.licenseStateField.text         = item?.license_state
            self.licenseExpiryDateField.date    = Date(fromString: item!.license_expiry_date, format: DateHelper.dateFormatType) ?? Date()
            self.bbbLinkField.text              = item?.bbb_link
            
            self.btnInsured.isSelected          = item!.is_business_insured
            self.btnBonded.isSelected           = item!.is_bonded
            self.btnLicensed.isSelected         = item!.is_licensed
            self.btnBBBAcredited.isSelected     = item!.is_bbb_accredited
            
            self.isInsured                      = item!.is_business_insured
            self.isBonded                       = item!.is_bonded
            self.isLicensed                     = item!.is_licensed
            self.isBBBAccredited                = item!.is_bbb_accredited
            
            self.tableView.beginUpdates()
            self.tableView.endUpdates()
        }
    }
    
    // MARK: - TableView Datasource -
    
    override func tableView(_ tableView: UITableView, titleForHeaderInSection section: Int) -> String? {
        if isInsured && section == 1 {
            return "UPLOAD INSURANCE COPY"
        } else if isBonded && section == 3 {
            return "UPLOAD BOND COPY"
        } else if isLicensed && section == 5 {
            return "UPLOAD LICENSE COPY"
        }
        return nil
    }
    
    override func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        let height = [1, 18, 1, 18, 1, 18, 1, 1]
        return CGFloat(height[section])
    }
    
    override func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        let section = indexPath.section
        let row     = indexPath.row
        
        let headerSections = [0, 2, 4, 6]
        // check
        if headerSections.contains(section) && row == 0 {
            return 46
        } else if section == 7 {
            return 130
        } else if !isInsured && (section == 0 || section == 1) {
            return 0
        } else if !isBonded && (section == 2 || section == 3) {
            return 0
        } else if !isLicensed && (section == 4 || section == 5) {
            return 0
        } else if !isBBBAccredited && section == 6 {
            return 0
        }
        return 60
    }
    
    // MARK: - Actions -
    
    @IBAction func insuredButtonTapped(_ sender: Any) {
        self.isInsured = !isInsured
        self.tableView.beginUpdates()
        self.tableView.endUpdates()
    }
    
    @IBAction func bondedButtonTapped(_ sender: Any) {
        self.isBonded = !isBonded
        self.tableView.beginUpdates()
        self.tableView.endUpdates()
    }
    
    @IBAction func licensedButtonTapped(_ sender: Any) {
        self.isLicensed = !isLicensed
        self.tableView.beginUpdates()
        self.tableView.endUpdates()
    }
    
    @IBAction func bbbAccreditedButtonTapped(_ sender: Any) {
        self.isBBBAccredited = !isBBBAccredited
        self.tableView.beginUpdates()
        self.tableView.endUpdates()
    }
    
    @IBAction func addInsuranceButtonTapped(_ sender: Any) {
    }
    
    @IBAction func addBondButtonTapped(_ sender: Any) {
    }
    
    @IBAction func addLicenseButtonTapped(_ sender: Any) {
    }
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        self.popViewController()
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        
        let params: Parameters = ["is_business_insured": btnInsured.isSelected,
                                  "insured_amount": insuranceAmountField.text!,
                                  "insurance_expiry_date": App.shared.dateFormatter.string(from: insuranceExpiryDateField.date),
                                  "is_bonded": btnBonded.isSelected,
                                  "bond_amount": bondAmountField.text!,
                                  "bond_expiry_date": App.shared.dateFormatter.string(from: bondExpiryDateField.date),
                                  "is_licensed": btnLicensed.isSelected,
                                  "license_class": licenseClassField.text!,
                                  "license_number": licenseNumField.text!,
                                  "license_state": States.getStateCode(licenseStateField.text!),
                                  "license_expiry_date": App.shared.dateFormatter.string(from: licenseExpiryDateField.date),
                                  "is_bbb_accredited": btnBBBAcredited.isSelected,
                                  "bbb_link": bbbLinkField.text!]
        
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
    
}
