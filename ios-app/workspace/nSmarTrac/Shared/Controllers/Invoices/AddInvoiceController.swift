//
//  AddInvoiceController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 20/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import AFDateHelper
import Alamofire
import DLRadioButton
import FSPagerView
import SVProgressHUD
import TLPhotoPicker

class AddInvoiceController: UITableViewController {

    // MARK: - Properties -
    
    @IBOutlet var customerField: MaterialTextField!
    @IBOutlet var jobLocationField: MaterialDropdownField!
    @IBOutlet var jobNameField: MaterialTextField!
    @IBOutlet var invoiceTypeField: MaterialDropdownField!
    @IBOutlet var workOrderNumField: MaterialTextField!
    @IBOutlet var invoiceNumField: MaterialTextField!
    @IBOutlet var poNumField: MaterialTextField!
    @IBOutlet var dateIssuedField: MaterialDatePickerField!
    @IBOutlet var dueDateField: MaterialDatePickerField!
    @IBOutlet var depositRequestField: MaterialTextField!
    @IBOutlet var messageToCustomerField: MaterialTextField!
    @IBOutlet var termsField: MaterialTextField!
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
    
    @IBOutlet var btnCreditCard: DLRadioButton!
    @IBOutlet var btnCheck: DLRadioButton!
    @IBOutlet var btnCash: DLRadioButton!
    @IBOutlet var btnDirectDeposit: DLRadioButton!
    @IBOutlet var btnCredit: DLRadioButton!
    
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
    @IBOutlet var grandTotal: UILabel!
    
    var selectedCustomer: Customer?
    var selectedItems: [Item] = []
    var selectedImages: [UIImage] = []
    var groupItems: [[String: [Item]]] = []
    var mGrandTotal = 0.00



    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
                
        self.title = "Create Invoice"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
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
        
        let invoice: Parameters = ["company_id": App.shared.companyId,
                                   "customer_id": selectedCustomer?.id ?? 0,
                                   "job_location": jobLocationField.text!,
                                   "job_name": jobNameField.text!,
                                   "invoice_type": invoiceTypeField.text!,
                                   "work_order_number": workOrderNumField.text!,
                                   "po_number": poNumField.text!,
                                   "invoice_number": invoiceTypeField.text!,
                                   "date_issued": App.shared.dateFormatter.string(from: dateIssuedField.date),
                                   "due_date": App.shared.dateFormatter.string(from: dueDateField.date),
                                   "status": "Draft",
                                   "total_due": mGrandTotal,
                                   "balance": "",
                                   "deposit_request": depositRequestField.text!,
                                   "accept_credit_card": btnCreditCard.isSelected,
                                   "accept_check": btnCheck.isSelected,
                                   "accept_cash": btnCash.isSelected,
                                   "accept_direct_deposit": btnDirectDeposit.isSelected,
                                   "accept_credit": btnCredit.isSelected,
                                   "message_to_customer": messageToCustomerField.text!,
                                   "terms_and_conditions": termsField.text!]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show(withStatus: "Saving...")
        App.shared.api.postInvoice(invoice) { (result, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard result?.Code == 200 else {
                return SVProgressHUD.showError(withStatus: result!.Message)
            }
            
            // id
            if let id = result?.Data {
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
                    let item: Parameters = ["invoice_id": id, "items_id": key, "qty": value.count]
                    // enter group
                    group.enter()
                    
                    SVProgressHUD.setDefaultMaskType(.clear)
                    SVProgressHUD.show(withStatus: "Saving...")
                    App.shared.api.postInvoiceItem(item) { (success, error) in
                        SVProgressHUD.setDefaultMaskType(.none)
                        SVProgressHUD.dismiss()
                        group.leave()
                    }
                }
                
                // get invoice_number
                App.shared.api.getInvoice(id.intValue, completion: { (item, error) in
                    guard error == nil else {
                        return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                    }
                    
                    // photos
                    for image in self.selectedImages {
                        // enter group
                        group.enter()
                        
                        // params
                        let params: Parameters = ["company_id": App.shared.companyId,
                                                  "invoice_id": id]
                        
                        // upload
                        SVProgressHUD.setDefaultMaskType(.clear)
                        SVProgressHUD.show(withStatus: "Uploading...")
                        App.shared.api.uploadInvoicePhoto(image, imageName: "\(item!.invoice_number)_photo_\(Date().currentTimeMillis()).jpg", params: params) { (success, error) in
                            SVProgressHUD.setDefaultMaskType(.none)
                            SVProgressHUD.dismiss()
                            guard error == nil else {
                                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                            }
                            
                            group.leave()
                        }
                    }
                })
                
                group.notify(queue: DispatchQueue.main, execute: {
                    SVProgressHUD.showSuccess(withStatus: "Data has been saved!")
                    self.popViewController()
                })
            }
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
        } else if indexPath.section == 4 {
            if indexPath.row == 0 {
                return 60
            }
            return 46
        } else if indexPath.section == 6 && indexPath.row == 0 {
            if selectedImages.count > 0 {
                return 200
            }
            return 0
        } else if indexPath.section == 7 {
            return 130
        }
        return 60
    }
    
    // MARK: - Functions -
    
    func initViews() {
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
        
        // init if customer not nil
        if let customer = selectedCustomer {
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
        
        // init payment methods
        btnCreditCard.otherButtons = [btnCheck, btnCash, btnDirectDeposit, btnCredit]
        btnCreditCard.configure()
        
        // iterate otherButtons
        for checkbox in btnCreditCard.otherButtons {
            checkbox.configure()
        }
        
        // init invoice type
        invoiceTypeField.updateOptions(options: ["Deposit", "Partial Payment", "Final Payment", "Total Due"])
        invoiceTypeField.setSelectedOption(option: "Total Due")
        
        // init due date
        dueDateField.minimumDate = dateIssuedField.date
        
        // init deposit requests
        depositRequestField.keyboardType = .numberPad
            
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
        
        // get invoice number
        App.shared.api.getInvoiceSetting() { (data, error) in
            if let e = error {
                return print(e.localizedDescription)
            }
            
            self.invoiceNumField.text = "\(data?.invoice_num_prefix ?? "")\(data?.invoice_num_next.format5DigitNumber ?? "")"
            self.messageToCustomerField.text = data?.message
            self.termsField.text = data?.terms_and_conditions
        }
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

extension AddInvoiceController: TLPhotosPickerViewControllerDelegate {
     
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
        configure.maxSelectedAssets = 10
        viewController.configure = configure
        
        self.present(viewController, animated: true, completion: nil)
    }
}

// MARK: - FSPagerViewDataSource & FSPagerViewDelegate -

extension AddInvoiceController: FSPagerViewDataSource, FSPagerViewDelegate {
    
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
