//
//  EditCustomEstimateController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 21/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import AnyFormatKit
import FSPagerView
import SVProgressHUD
import TLPhotoPicker

class EditCustomEstimateController: UITableViewController {

    // MARK: - Properties -
    
    @IBOutlet var customerField: MaterialTextField!
    @IBOutlet var jobLocationField: MaterialDropdownField!
    @IBOutlet var jobNameField: MaterialTextField!
    @IBOutlet var estimateNumField: MaterialTextField!
    @IBOutlet var poNumField: MaterialTextField!
    @IBOutlet var estimateDateField: MaterialDatePickerField!
    @IBOutlet var expiryDateField: MaterialDatePickerField!
    @IBOutlet var depositRequestField: MaterialTextField!
    @IBOutlet var messageToCustomerField: MaterialTextField!
    @IBOutlet var termsField: MaterialTextField!
    @IBOutlet var instructionField: MaterialTextField!
    @IBOutlet var saveButton: DesignableButton!
    
    @IBOutlet var pagerView: FSPagerView! {
        didSet {
            self.pagerView.register(FSPagerViewCell.self, forCellWithReuseIdentifier: "cell")
        }
    }
    @IBOutlet var pageControl: FSPageControl! {
        didSet {
            self.pageControl.numberOfPages = self.selectedImages.count
            self.pageControl.contentHorizontalAlignment = .right
            self.pageControl.contentInsets = UIEdgeInsets(top: 0, left: 20, bottom: 0, right: 20)
            self.pageControl.hidesForSinglePage = true
        }
    }
    
    @IBOutlet var itemField: UILabel!
    @IBOutlet var qtyField: UILabel!
    @IBOutlet var priceField: UILabel!
    @IBOutlet var removeButton: UIButton!
    @IBOutlet var item2Field: UILabel!
    @IBOutlet var qty2Field: UILabel!
    @IBOutlet var price2Field: UILabel!
    @IBOutlet var remove2Button: UIButton!
    @IBOutlet var item3Field: UILabel!
    @IBOutlet var qty3Field: UILabel!
    @IBOutlet var price3Field: UILabel!
    @IBOutlet var remove3Button: UIButton!
    @IBOutlet var item4Field: UILabel!
    @IBOutlet var qty4Field: UILabel!
    @IBOutlet var price4Field: UILabel!
    @IBOutlet var remove4Button: UIButton!
    @IBOutlet var item5Field: UILabel!
    @IBOutlet var qty5Field: UILabel!
    @IBOutlet var price5Field: UILabel!
    @IBOutlet var remove5Button: UIButton!
    @IBOutlet var item6Field: UILabel!
    @IBOutlet var qty6Field: UILabel!
    @IBOutlet var price6Field: UILabel!
    @IBOutlet var remove6Button: UIButton!
    @IBOutlet var item7Field: UILabel!
    @IBOutlet var qty7Field: UILabel!
    @IBOutlet var price7Field: UILabel!
    @IBOutlet var remove7Button: UIButton!
    @IBOutlet var item8Field: UILabel!
    @IBOutlet var qty8Field: UILabel!
    @IBOutlet var price8Field: UILabel!
    @IBOutlet var remove8Button: UIButton!
    @IBOutlet var item9Field: UILabel!
    @IBOutlet var qty9Field: UILabel!
    @IBOutlet var price9Field: UILabel!
    @IBOutlet var remove9Button: UIButton!
    
    @IBOutlet var subTotal: UILabel!
    @IBOutlet var taxes: UILabel!
    @IBOutlet var adjustments: UILabel!
    @IBOutlet var markup: UILabel!
    @IBOutlet var grandTotal: UILabel!
    
    var selectedCustomer: Customer?
    var selectedItems: [Item] = []
    var selectedImages: [UIImage] = []
    var groupItems: [[String: [Item]]] = []
    var mGrandTotal = 0.00
    
    var item: Estimate!
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        configureViews()
        loadData()
                
        self.title = "Edit Options Estimate"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Load data -
    
    func loadData() {
        customerField.text              = item.customer_name
        jobLocationField.text           = item.job_location
        jobNameField.text               = item.job_name
        estimateNumField.text           = item.estimate_number
        poNumField.text                 = item.purchase_order_number
        estimateDateField.date          = Date(fromString: item.estimate_date, format: DateHelper.dateFormatType)!
        expiryDateField.date            = Date(fromString: item.expiry_date, format: DateHelper.dateFormatType)!
        depositRequestField.text        = item.deposit_request
        messageToCustomerField.text     = item.customer_message
        termsField.text                 = item.terms_conditions
        instructionField.text           = item.instructions
        
        selectedCustomer = Helpers.getCustomerById(item.customer_id)
        selectedItems.append(contentsOf: item.items)
        initiateItems()
    }
    
    // MARK: - Actions -
    
    @IBAction func selectCustomerButtonTapped(_ sender: Any) {
        if let vc = self.storyboard?.instantiateViewController(withIdentifier: "sb_SelectCustomerController")  as? SelectCustomerController {
            vc.callback = { customer in
                self.selectedCustomer = customer
                self.customerField.text = customer.contact_name
                
                var customerAddress: [String] = []
                // iterate address
                for address in customer.address {
                    customerAddress.append("\(address.address1) \(address.address2), \(address.city), \(address.state) \(address.postal_code)")
                }
                // assign
                self.jobLocationField.updateOptions(options: customerAddress)
                self.jobLocationField.setSelectedOption(option: customerAddress.first)
            }
            self.navigationController?.pushViewController(vc, animated: true)
        }
    }
    
    @IBAction func addCustomerButtonTapped(_ sender: Any) {
        self.pushTo(storyBoard: "Main", identifier: "sb_AddCustomerController")
    }
    
    @IBAction func addJobLocationButtonTapped(_ sender: Any) {
        guard selectedCustomer != nil else {
            return
        }
        
        self.pushTo(storyBoard: "Main", identifier: "sb_AddOtherAddressController")
    }
    
    @IBAction func addItemButtonTapped(_ sender: Any) {
        guard selectedItems.count < 9 else {
            return
        }
        
        if let vc = self.storyboard?.instantiateViewController(withIdentifier: "sb_SelectItemController")  as? SelectItemController {
            vc.callback = { item in
                self.selectedItems.append(item)
                self.initiateItems()
            }
            self.navigationController?.pushViewController(vc, animated: true)
        }
    }
    
    @IBAction func removeItemButtonTapped(_ sender: Any) {
        let tag = (sender as! UIButton).tag
        self.selectedItems.remove(at: tag)
        self.initiateItems()
    }
    
    @IBAction func uploadButtonTapped(_ sender: Any) {
        self.presentImagePicker()
    }
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        self.popViewController()
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        
        let estimates: Parameters = ["company_id": App.shared.companyId,
                                     "estimate_number": estimateNumField.text!,
                                     "estimate_type": "Option",
                                     "customer_id": selectedCustomer?.id ?? 0,
                                     "job_location": jobLocationField.text!,
                                     "job_name": jobNameField.text!,
                                     "estimate_date": App.shared.dateFormatter.string(from: estimateDateField.date),
                                     "expiry_date": App.shared.dateFormatter.string(from: expiryDateField.date),
                                     "purchase_order_number": poNumField.text!,
                                     "deposit_request": depositRequestField.text!,
                                     "status": (item.status == "Accepted") ? "Submitted" : item.status,
                                     "estimate_value": mGrandTotal,
                                     "customer_message": messageToCustomerField.text!,
                                     "terms_conditions": termsField.text!,
                                     "instructions": instructionField.text!]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show(withStatus: "Saving...")
        App.shared.api.putEstimate(item.id.intValue, params: estimates, flag: "DELETE_ITEMS") { (success, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard success == true else {
                return SVProgressHUD.showError(withStatus: "Saving data failed!")
            }
            
            // items
            // create group
            let group = DispatchGroup()
            // sort ungrouped
            let ungrouped = self.selectedItems.sorted(by: {$0.id > $1.id})
            // group
            let grouped = ungrouped.group(by: {$0.id})
            // iterate
            for (key, value) in grouped {
                // create json
                let item: Parameters = ["estimates_id": self.item.id, "items_id": key, "qty": value.count]
                // enter group
                group.enter()
                
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show(withStatus: "Saving...")
                App.shared.api.postEstimateItem(item) { (success, error) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.dismiss()
                    group.leave()
                }
            }
            
            // photos
            for image in self.selectedImages {
                // enter group
                group.enter()
                
                // params
                let params: Parameters = ["company_id": App.shared.companyId,
                                          "estimate_id": self.item.id]
                
                // upload
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show(withStatus: "Uploading...")
                App.shared.api.uploadEstimatePhoto(image, imageName: "\(self.item.estimate_number)_photo_\(Date().currentTimeMillis()).jpg", params: params) { (success, error) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.dismiss()
                    guard error == nil else {
                        return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                    }
                    
                    group.leave()
                }
            }
            
            group.notify(queue: DispatchQueue.main, execute: {
                SVProgressHUD.showSuccess(withStatus: "Data has been saved!")
                self.popViewController()
            })
        }
    }

    // MARK: - TableView Datasource -
    
    override func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        if indexPath.section == 2 {
            if indexPath.row == 0 {
                return 44
            }
            if indexPath.row == 10 {
                return 190
            }
            if self.groupItems.count >= indexPath.row {
                return 44
            }
            return 0
        } else if indexPath.section == 4 && indexPath.row == 0 {
            if selectedImages.count > 0 {
                return 200
            }
            return 0
        } else if indexPath.section == 5 {
            return 130
        }
        return 60
    }
    
    // MARK: - Functions -
    
    func configureViews() {
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
        
        // init expiry date
        expiryDateField.minimumDate = estimateDateField.date
        expiryDateField.date = Calendar.current.date(byAdding: .day, value: 29, to: Date())!
            
        // init remove buttons
        removeButton.tag = 0
        remove2Button.tag = 1
        remove3Button.tag = 2
        remove4Button.tag = 3
        remove5Button.tag = 4
        remove6Button.tag = 5
        remove7Button.tag = 6
        remove8Button.tag = 7
        remove9Button.tag = 8
        
        // init deposit requests
        depositRequestField.keyboardType = .numberPad
    }
    
    func initiateItems() {
        // init labels
        let itemFields = [itemField, item2Field, item3Field, item4Field, item5Field, item6Field, item7Field, item8Field, item9Field]
        let qtyFields = [qtyField, qty2Field, qty3Field, qty4Field, qty5Field, qty6Field, qty7Field, qty8Field, qty9Field]
        let priceFields = [priceField, price2Field, price3Field, price4Field, price5Field, price6Field, price7Field, price8Field, price9Field]
        
        // init total
        var subTotal = 0.00
        var taxes = 0.00
        var grandTotal = 0.00
        
        // items
        // clear items
        self.groupItems.removeAll()
        // sort ungrouped
        let ungrouped = self.selectedItems.sorted(by: {$0.id > $1.id})
        // group
        let grouped = ungrouped.group(by: {$0.id})
        // iterate
        var i = 0
        for (key, value) in grouped {
            if let mItem = value.first {
                let qty     = value.count
                let price   = mItem.price.doubleValue
                let tax     = price * 0.075
                let total   = price * qty.doubleValue
                
                itemFields[i]?.text     = mItem.title
                qtyFields[i]?.text      = qty.stringValue
                priceFields[i]?.text    = "$\(price)"
                
                subTotal += total
                taxes += (tax * qty.doubleValue)
                grandTotal = subTotal + taxes
                
                self.groupItems.append([key: value])
                
                i+=1
            }
        }
        
        // update labels
        self.subTotal.text      = "$\(subTotal.rounded(toPlaces: 2))"
        self.taxes.text         = "$\(taxes.rounded(toPlaces: 2))"
        self.grandTotal.text    = "$\(grandTotal.rounded(toPlaces: 2))"

        // update tableView
        self.tableView.beginUpdates()
        self.tableView.endUpdates()
    }

}

// MARK: - TLPhotosPickerViewControllerDelegate -

extension EditCustomEstimateController: TLPhotosPickerViewControllerDelegate {
     
    func presentImagePicker() {
        var selectedAssets = [TLPHAsset]()
        
        let viewController = TLPhotosPickerViewController(withTLPHAssets: { assets in
            selectedAssets = assets
            
            // iterate images
            for asset in assets {
                if let image = asset.fullResolutionImage {
                    self.selectedImages.append(image)
                    self.pagerView.reloadData()
                    self.pageControl.numberOfPages = self.selectedImages.count
                    
                    self.tableView.beginUpdates()
                    self.tableView.endUpdates()
                }
            }
            
        }, didCancel: nil)
        viewController.didExceedMaximumNumberOfSelection = { picker in
            //exceed max selection
            SVProgressHUD.showError(withStatus: "You can only upload up to 10 photos.")
        }
        viewController.selectedAssets = selectedAssets
        
        var configure = TLPhotosPickerConfigure()
        configure.numberOfColumn = 2
        configure.maxSelectedAssets = 10 - self.item.photos.count
        viewController.configure = configure
        
        self.present(viewController, animated: true, completion: nil)
    }
}

// MARK: - FSPagerViewDataSource & FSPagerViewDelegate -

extension EditCustomEstimateController: FSPagerViewDataSource, FSPagerViewDelegate {
    
    // MARK:- FSPagerViewDataSource -
    
    func numberOfItems(in pagerView: FSPagerView) -> Int {
        return self.selectedImages.count
    }
    
    public func pagerView(_ pagerView: FSPagerView, cellForItemAt index: Int) -> FSPagerViewCell {
        let cell = pagerView.dequeueReusableCell(withReuseIdentifier: "cell", at: index)
        cell.imageView?.image = self.selectedImages[index]
        cell.imageView?.contentMode = .scaleAspectFill
        return cell
    }
    
    func pagerView(_ pagerView: FSPagerView, didSelectItemAt index: Int) {
        pagerView.deselectItem(at: index, animated: true)
    }
    
    // MARK:- FSPagerViewDelegate -
    
    func pagerViewWillEndDragging(_ pagerView: FSPagerView, targetIndex: Int) {
        self.pageControl.currentPage = targetIndex
    }
}
