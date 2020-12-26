//
//  BusinessDetailsController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 01/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import AnyFormatKit
import CropViewController
import DLRadioButton
import Kingfisher
import SVProgressHUD

class BusinessDetailsController: UITableViewController {

    // MARK: - Properties -
    
    @IBOutlet var logo: UIImageView!
    @IBOutlet var contactNameField: MaterialTextField!
    @IBOutlet var businessNameField: MaterialTextField!
    @IBOutlet var addressField: MaterialTextField!
    @IBOutlet var suiteUnitField: MaterialTextField!
    @IBOutlet var cityField: MaterialTextField!
    @IBOutlet var postalCodeField: MaterialTextField!
    @IBOutlet var stateField: MaterialDropdownField!
    @IBOutlet var businessPhoneField: MaterialTextField!
    @IBOutlet var officePhoneField: MaterialTextField!
    @IBOutlet var businessEmailField: MaterialTextField!
    @IBOutlet var businessWebsiteField: MaterialTextField!
    @IBOutlet var btnProvideEmergencyServiceYes: DLRadioButton!
    @IBOutlet var btnProvideEmergencyServiceNo: DLRadioButton!
    @IBOutlet var emergencyNumField: MaterialTextField!
    @IBOutlet var yearEstField: MaterialTextField!
    @IBOutlet var numOfEmployeesField: MaterialTextField!
    @IBOutlet var btnAllowSubContractYes: DLRadioButton!
    @IBOutlet var btnAllowSubContractNo: DLRadioButton!
    @IBOutlet var descriptionField: MaterialTextField!
    
    var item: BusinessProfile?
    
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
        loadData()
                
        self.title = "Business Details"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
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
            
            self.item                       = item
            self.contactNameField.text      = item?.contact_name
            self.businessNameField.text     = item?.business_name
            self.addressField.text          = item?.street
            self.suiteUnitField.text        = item?.suite_unit
            self.cityField.text             = item?.city
            self.postalCodeField.text       = item?.postal_code
            self.businessPhoneField.text    = item?.business_phone
            self.officePhoneField.text      = item?.office_phone
            self.businessEmailField.text    = item?.business_email
            self.businessWebsiteField.text  = item?.website
            self.emergencyNumField.text     = item?.phone_emergency
            self.yearEstField.text          = item?.year_est
            self.numOfEmployeesField.text   = item?.employee_count
            self.descriptionField.text      = item?.business_desc
            
            self.stateField.setSelectedOption(option: States.getStateName(item?.state))
            
            if item!.is_emergency_support {
                self.btnProvideEmergencyServiceYes.isSelected = true
            } else {
                self.btnProvideEmergencyServiceNo.isSelected = true
            }
            
            if item!.is_subcontract_allowed {
                self.btnAllowSubContractYes.isSelected = true
            } else {
                self.btnAllowSubContractNo.isSelected = true
            }
        }
    }
    
    // MARK: - Functions -
    
    func initViews() {
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
        
        // configure logo
        if let image = UserDefaults.standard.imageForKey(key: App.shared.logoKey) {
            logo.image = image
        }
        //logo.kf.setImage(with: URL(string: "https://markate.blob.core.windows.net/cdn/20190930/business_logo_13050_a79670b562_md.jpg"))
        
        // init checkboxes
        btnProvideEmergencyServiceYes.otherButtons = [btnProvideEmergencyServiceNo]
        btnProvideEmergencyServiceYes.configureRadio()
        btnProvideEmergencyServiceNo.configureRadio()
        
        btnAllowSubContractYes.otherButtons = [btnAllowSubContractNo]
        btnAllowSubContractYes.configureRadio()
        btnAllowSubContractNo.configureRadio()
        
        // configure state
        stateField.updateOptions(options: States.getAllStates())
        
        // configure textfields
        businessPhoneField.delegate = self
        businessPhoneField.keyboardType = .numberPad
        officePhoneField.delegate = self
        officePhoneField.keyboardType = .numberPad
        emergencyNumField.delegate = self
        emergencyNumField.keyboardType = .numberPad
    }
    
    // MARK: - Actions -

    @IBAction func uploadButtonTapped(_ sender: Any) {
        presentImagePicker()
    }
    
    @IBAction func deleteButtonTapped(_ sender: Any) {
        // remove image
        logo.image = nil
        
        // remove image from user defaults
        UserDefaults.standard.setImage(image: nil, forKey: App.shared.logoKey)
        UserDefaults.standard.synchronize()
    }
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        self.popViewController()
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        
        let params: Parameters = ["contact_name": contactNameField.text!,
                                  "business_name": businessNameField.text!,
                                  "street": addressField.text!,
                                  "suite_unit": suiteUnitField.text!,
                                  "city": cityField.text!,
                                  "postal_code": postalCodeField.text!,
                                  "state": States.getStateCode(stateField.text!),
                                  "business_phone": businessPhoneField.text!,
                                  "office_phone": officePhoneField.text!,
                                  "business_email": businessEmailField.text!,
                                  "website": businessWebsiteField.text!,
                                  "is_emergency_support": btnProvideEmergencyServiceYes.isSelected,
                                  "phone_emergency": emergencyNumField.text!,
                                  "year_est": yearEstField.text!,
                                  "employee_count": numOfEmployeesField.text!,
                                  "is_subcontract_allowed": btnAllowSubContractYes.isSelected,
                                  "business_desc": descriptionField.text!]
        
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

// MARK: - UIImagePickerControllerDelegate -

extension BusinessDetailsController: UIImagePickerControllerDelegate, UINavigationControllerDelegate, CropViewControllerDelegate {
    
    func presentImagePicker() {
        if UIImagePickerController.isSourceTypeAvailable(.photoLibrary) {
            let imagePicker = UIImagePickerController()
            imagePicker.delegate = self
            imagePicker.sourceType = .photoLibrary;
            imagePicker.allowsEditing = false
            present(imagePicker, animated: true, completion: nil)
        }
    }
    
    func imagePickerController(_ picker: UIImagePickerController, didFinishPickingMediaWithInfo info: [UIImagePickerController.InfoKey : Any]) {
        // close picker
        dismiss(animated:true, completion: nil)
        
        // show cropper
        guard let image = info[.originalImage] as? UIImage else { return }
        let cropViewController = CropViewController(image: image)
        cropViewController.delegate = self
        present(cropViewController, animated: true, completion: nil)
    }
    
    func imagePickerControllerDidCancel(_ picker: UIImagePickerController) {
        // close picker
        dismiss(animated:true, completion: nil)
    }
    
    func cropViewController(_ cropViewController: CropViewController, didCropToImage image: UIImage, withRect cropRect: CGRect, angle: Int) {
        // close picker
        dismiss(animated:true, completion: nil)
        
        // set image
        logo.image = image
        
        // save image to user defaults
        UserDefaults.standard.setImage(image: image, forKey: App.shared.logoKey)
        UserDefaults.standard.synchronize()
        
        //upload
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show(withStatus: "Uploading...")
        App.shared.api.uploadLogo(image) { (success, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            
            SVProgressHUD.showSuccess(withStatus: "File is uploaded!")
        }
    }
}

// MARK: - UITextFieldDelegate -

extension BusinessDetailsController: UITextFieldDelegate {
    
    func textField(_ textField: UITextField, shouldChangeCharactersIn range: NSRange, replacementString string: String) -> Bool {
        // check
        if textField == businessPhoneField || textField == officePhoneField || textField == emergencyNumField {
            // formatter
            let formatter = DefaultTextInputFormatter(textPattern: "(###) ###-####")
            let result = formatter.formatInput(currentText: textField.text!, range: range, replacementString: string)
            textField.text = result.formattedText
            
            return false
        }
        
        return true
    }
}
