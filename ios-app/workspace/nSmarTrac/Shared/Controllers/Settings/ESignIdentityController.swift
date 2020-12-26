//
//  ESignIdentityController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 17/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import SVProgressHUD

class ESignIdentityController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var nameLabel: UILabel!
    @IBOutlet var emailLabel: UILabel!
    @IBOutlet var titleLabel: UILabel!
    @IBOutlet var companyNameLabel: UILabel!
    @IBOutlet var addressLabel: UILabel!
    @IBOutlet var address2Label: UILabel!
    @IBOutlet var countryLabel: UILabel!
    @IBOutlet var stateLabel: UILabel!
    @IBOutlet var cityLabel: UILabel!
    @IBOutlet var zipcodeLabel: UILabel!
    @IBOutlet var phoneLabel: UILabel!
    @IBOutlet var signatureView: UIImageView!
    @IBOutlet var initialsView: UIImageView!
    @IBOutlet var showIdentitySwitch: UISwitch!
    @IBOutlet var displayCompanySwitch: UISwitch!
    @IBOutlet var displayAddressSwitch: UISwitch!
    @IBOutlet var displayUsageSwitch: UISwitch!
    
    let user = App.shared.user!
    var item: UserSign?
    
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        loadData()
        
        self.title = "Identity"
        
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Load data -
    
    func loadData() {
        // imageView
        self.signatureView.backgroundColor  = .white
        self.initialsView.backgroundColor   = .white
        
        // user data
        nameLabel.text         = user.FName + " " + user.LName
        emailLabel.text             = user.email
        titleLabel.text             = ""
        companyNameLabel.text       = user.company?.business_name
        addressLabel.text           = user.address.first?.address1
        address2Label.text          = user.address.first?.address2
        countryLabel.text           = "United States"
        stateLabel.text             = user.address.first?.state
        cityLabel.text              = user.address.first?.city
        zipcodeLabel.text           = user.address.first?.postal_code
        phoneLabel.text             = user.phone.first?.number
        
        if let signatureImage = UserDefaults.standard.imageForKey(key: "ESIGN-SIGNATURE-" + App.shared.user!.id) {
            self.signatureView.image            = signatureImage
        }
        
        if let initialsImage = UserDefaults.standard.imageForKey(key: "ESIGN-INITIALS-" + App.shared.user!.id) {
            self.initialsView.image             = initialsImage
        }
        
        
        // call api
        SVProgressHUD.show(withStatus: "Loading...")
        App.shared.api.getUserSign() { (item, error) in
            SVProgressHUD.dismiss()
            if let e = error {
                return SVProgressHUD.showError(withStatus: e.localizedDescription)
            }
            
            self.item                        = item
            //self.signatureView.image         = nil
            //self.initialsView.image          = nil
            self.showIdentitySwitch.isOn     = item!.show_identity
            self.displayCompanySwitch.isOn   = item!.display_company_title
            self.displayAddressSwitch.isOn   = item!.display_address_phone
            self.displayUsageSwitch.isOn     = item!.display_usage_history
            
            // update signature
            if let signature = item?.signature_image, !signature.isEmpty {
                App.shared.api.downloadImage(signature, completion: { image in
                    UserDefaults.standard.setImage(image: image, forKey: "ESIGN-SIGNATURE-" + App.shared.user!.id)
                    UserDefaults.standard.synchronize()
                    
                    self.signatureView.image = image
                })
            }
            
            // update initials
            if let initials = item?.initial_image, !initials.isEmpty {
                App.shared.api.downloadImage(initials, completion: { image in
                    UserDefaults.standard.setImage(image: image, forKey: "ESIGN-INITIALS-" + App.shared.user!.id)
                    UserDefaults.standard.synchronize()
                    
                    self.initialsView.image = image
                })
            }
        }
    }
    
    // MARK: - Actions -
    
    @IBAction func signatureButtonTapped(_ sender: Any) {
        // create actionSheet
        let alertController = UIAlertController(title: nil, message: nil, preferredStyle: .actionSheet)
        let drawAction = UIAlertAction(title: "Draw your Signature", style: .default) { (alertAction) -> Void in
            if let vc = self.storyboard?.instantiateViewController(withIdentifier: "sb_DrawSignatureController")  as? DrawSignatureController {
                vc.callback = { image in
                    // display signature
                    self.signatureView.image = image
                    
                    // save to user defaults
                    UserDefaults.standard.setImage(image: image, forKey: "ESIGN-SIGNATURE-" + App.shared.user!.id)
                    
                    // upload signature
                    SVProgressHUD.setDefaultMaskType(.clear)
                    SVProgressHUD.show()
                    App.shared.api.uploadUserSignature(image, completion: { (success, error) in
                        SVProgressHUD.setDefaultMaskType(.none)
                        SVProgressHUD.dismiss()
                        guard error == nil else {
                            return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                        }
                        
                    })
                }
                self.navigationController?.pushViewController(vc, animated: true)
            }
        }
        alertController.addAction(drawAction)
        
        let captureAction = UIAlertAction(title: "Take Photo of Signature", style: .default) { (alertAction) -> Void in
            if let vc = self.storyboard?.instantiateViewController(withIdentifier: "sb_CaptureSignatureController")  as? CaptureSignatureController {
                vc.callback = { image in
                    // display signature
                    self.signatureView.image = image
                    
                    // save to user defaults
                    UserDefaults.standard.setImage(image: image, forKey: "ESIGN-SIGNATURE-" + App.shared.user!.id)
                    
                    // upload signature
                    SVProgressHUD.setDefaultMaskType(.clear)
                    SVProgressHUD.show()
                    App.shared.api.uploadUserSignature(image, completion: { (success, error) in
                        SVProgressHUD.setDefaultMaskType(.none)
                        SVProgressHUD.dismiss()
                        guard error == nil else {
                            return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                        }
                        
                    })
                }
                self.navigationController?.pushViewController(vc, animated: true)
            }
        }
        alertController.addAction(captureAction)
        
        let deleteAction = UIAlertAction(title: "Delete Signature", style: .destructive) { (alertAction) -> Void in
            // remove from user defaults
            UserDefaults.standard.setImage(image: nil, forKey: "ESIGN-SIGNATURE-" + App.shared.user!.id)
            // remove from view
            self.signatureView.image = nil
        }
        alertController.addAction(deleteAction)
        
        let cancelAction = UIAlertAction(title: "Cancel", style: .cancel) { (alertAction) -> Void in
            self.dismiss(animated: true, completion: nil)
        }
        alertController.addAction(cancelAction)
        
        self.present(alertController, animated: true, completion: nil)
    }
    
    @IBAction func initialButtonTapped(_ sender: Any) {
        // create actionSheet
        let alertController = UIAlertController(title: nil, message: nil, preferredStyle: .actionSheet)
        let drawAction = UIAlertAction(title: "Draw your Initials", style: .default) { (alertAction) -> Void in
            if let vc = self.storyboard?.instantiateViewController(withIdentifier: "sb_DrawInitialsController")  as? DrawInitialsController {
                vc.callback = { image in
                    // display initial
                    self.initialsView.image = image
                    
                    // save to user defaults
                    UserDefaults.standard.setImage(image: image, forKey: "ESIGN-INITIALS-" + App.shared.user!.id)
                    
                    // upload signature
                    SVProgressHUD.setDefaultMaskType(.clear)
                    SVProgressHUD.show()
                    App.shared.api.uploadUserInitials(image, completion: { (success, error) in
                        SVProgressHUD.setDefaultMaskType(.none)
                        SVProgressHUD.dismiss()
                        guard error == nil else {
                            return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                        }
                        
                    })
                }
                self.navigationController?.pushViewController(vc, animated: true)
            }
        }
        alertController.addAction(drawAction)
        
        let captureAction = UIAlertAction(title: "Take Photo of Initials", style: .default) { (alertAction) -> Void in
            if let vc = self.storyboard?.instantiateViewController(withIdentifier: "sb_CaptureInitialsController")  as? CaptureInitialsController {
                vc.callback = { image in
                    // display initial
                    self.initialsView.image = image
                    
                    // save to user defaults
                    UserDefaults.standard.setImage(image: image, forKey: "ESIGN-INITIALS-" + App.shared.user!.id)
                    
                    // upload signature
                    SVProgressHUD.setDefaultMaskType(.clear)
                    SVProgressHUD.show()
                    App.shared.api.uploadUserInitials(image, completion: { (success, error) in
                        SVProgressHUD.setDefaultMaskType(.none)
                        SVProgressHUD.dismiss()
                        guard error == nil else {
                            return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                        }
                        
                    })
                }
                self.navigationController?.pushViewController(vc, animated: true)
            }
        }
        alertController.addAction(captureAction)
        
        let deleteAction = UIAlertAction(title: "Delete Initials", style: .destructive) { (alertAction) -> Void in
            // remove from user defaults
            UserDefaults.standard.setImage(image: nil, forKey: "ESIGN-INITIALS-" + App.shared.user!.id)
            // remove from view
            self.initialsView.image = nil
        }
        alertController.addAction(deleteAction)
        
        let cancelAction = UIAlertAction(title: "Cancel", style: .cancel) { (alertAction) -> Void in
            self.dismiss(animated: true, completion: nil)
        }
        alertController.addAction(cancelAction)
        
        self.present(alertController, animated: true, completion: nil)
    }
    
    @IBAction func showIdentitySwitchValueChange(_ sender: Any) {
        // update db
        let params: Parameters = ["show_identity": showIdentitySwitch.isOn]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show()
        App.shared.api.putUserSign(params) { (success, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard success == true else {
                return SVProgressHUD.showError(withStatus: "Saving data failed!")
            }
            
            SVProgressHUD.showSuccess(withStatus: "Changes has been saved!")
        }
    }
    
    @IBAction func displayCompanySwitchValueChange(_ sender: Any) {
        // update db
        let params: Parameters = ["display_company_title": displayCompanySwitch.isOn]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show()
        App.shared.api.putUserSign(params) { (success, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard success == true else {
                return SVProgressHUD.showError(withStatus: "Saving data failed!")
            }
            
            SVProgressHUD.showSuccess(withStatus: "Changes has been saved!")
        }
    }
    
    @IBAction func displayAddressSwitchValueChange(_ sender: Any) {
        // update db
        let params: Parameters = ["display_address_phone": displayAddressSwitch.isOn]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show()
        App.shared.api.putUserSign(params) { (success, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard success == true else {
                return SVProgressHUD.showError(withStatus: "Saving data failed!")
            }
            
            SVProgressHUD.showSuccess(withStatus: "Changes has been saved!")
        }
    }
    
    @IBAction func displayUsageSwitchValueChange(_ sender: Any) {
        // update db
        let params: Parameters = ["display_usage_history": displayUsageSwitch.isOn]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show()
        App.shared.api.putUserSign(params) { (success, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard success == true else {
                return SVProgressHUD.showError(withStatus: "Saving data failed!")
            }
            
            SVProgressHUD.showSuccess(withStatus: "Changes has been saved!")
        }
    }
    
}
