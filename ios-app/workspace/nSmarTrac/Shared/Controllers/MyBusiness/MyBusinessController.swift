//
//  MyBusinessController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 28/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import CropViewController
import FontAwesome_swift
import Kingfisher
import SideMenu
import SVProgressHUD

class MyBusinessController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var menuButtonItem: UIBarButtonItem!
    @IBOutlet var homeButtonItem: UIBarButtonItem!
    @IBOutlet var chatButtonItem: UIBarButtonItem!
    @IBOutlet var inboxButtonItem: UIBarButtonItem!
    
    @IBOutlet var businessInfoIcon: UIImageView!
    @IBOutlet var servicesIcon: UIImageView!
    @IBOutlet var credentialsIcon: UIImageView!
    @IBOutlet var verificationsIcon: UIImageView!
    @IBOutlet var aboutIcon: UIImageView!
    @IBOutlet var portfolioIcon: UIImageView!
    @IBOutlet var availabilityIcon: UIImageView!
    @IBOutlet var reviewIcon: UIImageView!
    
    @IBOutlet var btnEditInfo: UIButton!
    @IBOutlet var btnEditService: UIButton!
    @IBOutlet var btnEditCredentials: UIButton!
    @IBOutlet var btnEditAbout: UIButton!
    @IBOutlet var btnEditPortfolio: UIButton!
    @IBOutlet var btnEditAvailability: UIButton!
    
    @IBOutlet var phoneIcon: DesignableButton!
    @IBOutlet var emailIcon: DesignableButton!
    @IBOutlet var facebookIcon: DesignableButton!
    @IBOutlet var goggleIcon: DesignableButton!
    
    @IBOutlet var banner: UIImageView!
    @IBOutlet var logo: UIImageView!
    @IBOutlet var btnEditBanner: UIButton!
    @IBOutlet var collectionView: UICollectionView!
    
    @IBOutlet var contactName: UILabel!
    @IBOutlet var businessPhone: UILabel!
    @IBOutlet var email: UILabel!
    @IBOutlet var address: UILabel!
    @IBOutlet var yearEst: UILabel!
    @IBOutlet var numOfEmployees: UILabel!
    @IBOutlet var emergencySupport: UILabel!
    @IBOutlet var emergencyPhone: UILabel!
    @IBOutlet var allowSubContractor: UILabel!
    @IBOutlet var website: UILabel!
    
    @IBOutlet var serviceCategory: UILabel!
    @IBOutlet var serviceSubcategory: UILabel!
    
    @IBOutlet var phoneVerified: UILabel!
    @IBOutlet var emailVerified: UILabel!
    @IBOutlet var facebookConnected: UILabel!
    @IBOutlet var googleConnected: UILabel!
    
    @IBOutlet var aboutHeader: UILabel!
    @IBOutlet var about: UILabel!
    
    @IBOutlet var workingDays: UILabel!
    @IBOutlet var workingHours: UILabel!
    
    var item: BusinessProfile?
    var items: [Portfolio] = []
    
    var willUploadLogo: Bool = false
    var willUploadBanner: Bool = false
    
    
    
    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initNavBar()
        initCollectionViewLayout()
        loadData()
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Load data -
    
    func loadData() {
        // handle nil
        if let company = App.shared.company {
            self.assignData(company)
            self.items = company.portfolio
            self.collectionView.reloadData()
        } else {
            // call api
            SVProgressHUD.show(withStatus: "Loading...")
            App.shared.api.getBusinessProfile() { (item, error) in
                SVProgressHUD.dismiss()
                if let e = error {
                    return SVProgressHUD.showError(withStatus: e.localizedDescription)
                }
                
                if let company = item {
                    self.assignData(company)
                    self.items = company.portfolio
                    self.collectionView.reloadData()
                }
            }
        }
    }
    
    func assignData(_ data: BusinessProfile?) {
        // logo
        if let logoImage = UserDefaults.standard.imageForKey(key: App.shared.logoKey) {
            logo.image = logoImage
        }
        
        // banner
        if let bannerImage = UserDefaults.standard.imageForKey(key: App.shared.bannerKey) {
            banner.image = bannerImage
        }
        
        // preload
        self.item                       = data
        self.contactName.text           = item?.contact_name
        self.businessPhone.text         = item?.business_phone
        self.email.text                 = item?.business_email
        self.address.text               = "\(item!.street) \(item!.suite_unit), \(item!.city), \(item!.postal_code) \(item!.state)"
        self.yearEst.text               = item?.year_est
        self.numOfEmployees.text        = item?.employee_count
        self.emergencySupport.text      = item!.is_emergency_support ? "Yes" : "No"
        self.emergencyPhone.text        = item?.phone_emergency
        self.allowSubContractor.text    = item!.is_subcontract_allowed ? "Yes" : "No"
        self.website.text               = item?.website
        
        self.serviceCategory.text       = item?.service_category
        self.serviceSubcategory.text    = item?.service_subcategory
        
        self.aboutHeader.text           = "About " + item!.business_name
        self.about.text                 = item?.business_desc
        
        self.workingDays.text           = item?.working_days
        self.workingHours.text          = item!.start_time_of_day + " - " + item!.end_time_of_day
        
        // verifications
        // phone
        if self.item!.is_phone_verified {
            phoneIcon.borderColor   = .black
            phoneIcon.tintColor     = .greenColor
            phoneVerified.text      = "Phone Verified"
        } else {
            phoneIcon.borderColor   = .lightGray
            phoneIcon.tintColor     = .lightGray
            phoneVerified.text      = "Not Verified"
        }
        
        // email
        if self.item!.is_email_verified {
            emailIcon.borderColor   = .black
            emailIcon.tintColor     = .greenColor
            emailVerified.text      = "Email Verified"
        } else {
            emailIcon.borderColor   = .lightGray
            emailIcon.tintColor     = .lightGray
            emailVerified.text      = "Not Verified"
        }
        
        // facebook
        if self.item!.is_facebook_connected {
            facebookIcon.setImage(UIImage.fontAwesomeIcon(name: .facebookF, style: .brands, textColor: .greenColor, size: CGSize(width: 24, height: 24)), for: .normal)
            facebookIcon.borderColor    = .black
            facebookConnected.text      = "Connected"
        } else {
            facebookIcon.setImage(UIImage.fontAwesomeIcon(name: .facebookF, style: .brands, textColor: .lightGray, size: CGSize(width: 24, height: 24)), for: .normal)
            facebookIcon.borderColor    = .lightGray
            facebookConnected.text      = "Not Connected"
        }
        
        // google
        if self.item!.is_google_connected {
            goggleIcon.setImage(UIImage.fontAwesomeIcon(name: .google, style: .brands, textColor: .greenColor, size: CGSize(width: 24, height: 24)), for: .normal)
            goggleIcon.borderColor      = .black
            googleConnected.text        = "Connected"
        } else {
            goggleIcon.setImage(UIImage.fontAwesomeIcon(name: .google, style: .brands, textColor: .lightGray, size: CGSize(width: 24, height: 24)), for: .normal)
            goggleIcon.borderColor      = .lightGray
            googleConnected.text        = "Not Connected"
        }

        
        self.tableView.beginUpdates()
        self.tableView.endUpdates()
    }
    
    // MARK: - Navigation Bar -
    
    func initNavBar() {
        // setup navBar icons
        menuButtonItem.image = UIImage.fontAwesomeIcon(name: .bars, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        homeButtonItem.image = UIImage.fontAwesomeIcon(name: .home, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        chatButtonItem.image = UIImage.fontAwesomeIcon(name: .comments, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        inboxButtonItem.image = UIImage.fontAwesomeIcon(name: .envelope, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        
        businessInfoIcon.image = UIImage.fontAwesomeIcon(name: .infoCircle, style: .regular, textColor: App.shared.iconColor, size: CGSize(width: 24, height: 24))
        servicesIcon.image = UIImage.fontAwesomeIcon(name: .tools, style: .regular, textColor: App.shared.iconColor, size: CGSize(width: 24, height: 24))
        credentialsIcon.image = UIImage.fontAwesomeIcon(name: .award, style: .regular, textColor: App.shared.iconColor, size: CGSize(width: 24, height: 24))
        verificationsIcon.image = UIImage.fontAwesomeIcon(name: .checkCircle, style: .regular, textColor: App.shared.iconColor, size: CGSize(width: 24, height: 24))
        aboutIcon.image = UIImage.fontAwesomeIcon(name: .globe, style: .regular, textColor: App.shared.iconColor, size: CGSize(width: 24, height: 24))
        portfolioIcon.image = UIImage.fontAwesomeIcon(name: .infoCircle, style: .regular, textColor: App.shared.iconColor, size: CGSize(width: 24, height: 24))
        availabilityIcon.image = UIImage.fontAwesomeIcon(name: .calendarAlt, style: .regular, textColor: App.shared.iconColor, size: CGSize(width: 24, height: 24))
        reviewIcon.image = UIImage.fontAwesomeIcon(name: .star, style: .regular, textColor: App.shared.iconColor, size: CGSize(width: 24, height: 24))
        
        btnEditBanner.setImage(UIImage.fontAwesomeIcon(name: .pencilAlt, style: .solid, textColor: .greenColor, size: CGSize(width: 24, height: 24)), for: .normal)
        btnEditInfo.setImage(UIImage.fontAwesomeIcon(name: .edit, style: .solid, textColor: .systemBlue, size: CGSize(width: 18, height: 18)), for: .normal)
        btnEditService.setImage(UIImage.fontAwesomeIcon(name: .edit, style: .solid, textColor: .systemBlue, size: CGSize(width: 18, height: 18)), for: .normal)
        btnEditCredentials.setImage(UIImage.fontAwesomeIcon(name: .edit, style: .solid, textColor: .systemBlue, size: CGSize(width: 18, height: 18)), for: .normal)
        btnEditAbout.setImage(UIImage.fontAwesomeIcon(name: .edit, style: .solid, textColor: .systemBlue, size: CGSize(width: 18, height: 18)), for: .normal)
        btnEditPortfolio.setImage(UIImage.fontAwesomeIcon(name: .edit, style: .solid, textColor: .systemBlue, size: CGSize(width: 18, height: 18)), for: .normal)
        btnEditAvailability.setImage(UIImage.fontAwesomeIcon(name: .edit, style: .solid, textColor: .systemBlue, size: CGSize(width: 18, height: 18)), for: .normal)
        
        // configure banner and logo
        //banner.kf.setImage(with: URL(string: "https://www.markate.com/assets/images/app/public/pros/wallpaper/general_0.jpg"))
        //logo.kf.setImage(with: URL(string: "https://www.markate.com/cdn/20190930/business_logo_13050_a79670b562_md.jpg"))
        
        
        // setup SideMenu
        let storyboard = UIStoryboard(name: "Main", bundle: Bundle.main)
        SideMenuManager.default.leftMenuNavigationController = storyboard.instantiateViewController(withIdentifier: "sb_SideMenu") as? SideMenuNavigationController
        SideMenuManager.default.rightMenuNavigationController = nil
        SideMenuManager.default.addPanGestureToPresent(toView: self.navigationController!.navigationBar)
        SideMenuManager.default.addScreenEdgePanGesturesToPresent(toView: self.navigationController!.view)
        SideMenuManager.default.leftMenuNavigationController?.statusBarEndAlpha = 0
        
        // set title
        self.navigationItem.title = "Business Profile"
        
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
    }
    
    // MARK: - TableView Datasource -
    
    override func tableView(_ tableView: UITableView, titleForHeaderInSection section: Int) -> String? {
        if section == 1 {
            if let info = item {
                return info.business_name
            }
        }
        
        return nil
    }
    
    // MARK: - Action -

    @IBAction func sideMenuTapped(_ sender: Any) {
        self.present(SideMenuManager.default.leftMenuNavigationController!, animated: true, completion: nil)
    }
    
    @IBAction func homeButtonTapped(_ sender: Any) {
        App.shared.selectedMenu = .Home
        NotificationCenter.default.post(name: Notifications.didSwitchLeftMenu, object: self, userInfo: nil)
    }
    
    @IBAction func chatButtonTapped(_ sender: Any) {
        App.shared.selectedMenu = .Chat
        NotificationCenter.default.post(name: Notifications.didSwitchLeftMenu, object: self, userInfo: nil)
    }
    
    @IBAction func messagesButtonTapped(_ sender: Any) {
        App.shared.selectedMenu = .Messages
        NotificationCenter.default.post(name: Notifications.didSwitchLeftMenu, object: self, userInfo: nil)
    }
    
    @IBAction func cameraButtonTapped(_ sender: Any) {
        willUploadLogo = true
        presentImagePicker()
    }
    
    @IBAction func editBannerButtonTapped(_ sender: Any) {
        willUploadBanner = true
        presentImagePicker()
    }
    
}

// MARK: - UICollectionView Datasource -

extension MyBusinessController: UICollectionViewDelegate, UICollectionViewDataSource {
    
    func initCollectionViewLayout() {
        let layout = UICollectionViewFlowLayout()
        layout.scrollDirection = .horizontal
        layout.itemSize = CGSize(width: 100, height: 128)
        layout.sectionInset = UIEdgeInsets(top: 0, left: 10, bottom: 0, right: 10)
        layout.minimumLineSpacing = 0
        layout.minimumInteritemSpacing = 10
        self.collectionView.setCollectionViewLayout(layout, animated: true)
    }
    
    func collectionView(_ collectionView: UICollectionView, numberOfItemsInSection section: Int) -> Int {
        return items.count
    }
    
    func collectionView(_ collectionView: UICollectionView, cellForItemAt indexPath: IndexPath) -> UICollectionViewCell {
        let item = items[indexPath.row]
        // Configure the cell...
        let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "Cell", for: indexPath) as! SimplePortfolioCell
        cell.imageView.kf.setImage(with: URL(string: item.path))
        cell.caption.text = item.caption
        
        return cell
    }
}

// MARK: - UIImagePickerControllerDelegate -

extension MyBusinessController: UIImagePickerControllerDelegate, UINavigationControllerDelegate, CropViewControllerDelegate {
    
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
        
        if willUploadLogo {
            // reinit
            willUploadLogo = false
            // set image
            logo.image = image
            
            // save image to user defaults for now
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
        } else if willUploadBanner {
            // reinit
            willUploadBanner = false
            // set image
            banner.image = image
            
            // save image to user defaults for now
            UserDefaults.standard.setImage(image: image, forKey: App.shared.bannerKey)
            UserDefaults.standard.synchronize()
            
            //upload
            SVProgressHUD.setDefaultMaskType(.clear)
            SVProgressHUD.show(withStatus: "Uploading...")
            App.shared.api.uploadBanner(image) { (success, error) in
                SVProgressHUD.setDefaultMaskType(.none)
                SVProgressHUD.dismiss()
                guard error == nil else {
                    return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                }
                
                SVProgressHUD.showSuccess(withStatus: "File is uploaded!")
            }
        }
    }
}

// MARK: - Cells -

class SimplePortfolioCell: UICollectionViewCell {
    @IBOutlet var imageView: UIImageView!
    @IBOutlet var caption: UILabel!
}
