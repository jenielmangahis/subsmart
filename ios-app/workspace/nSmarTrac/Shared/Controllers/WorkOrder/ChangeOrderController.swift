//
//  ChangeOrderController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 21/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import RxSwift
import RxCocoa
import SVProgressHUD

class ChangeOrderController: UITableViewController {

    // MARK: - Properties -
    
    @IBOutlet var workOrderNumField: MaterialTextField!
    @IBOutlet var customerField: MaterialTextField!
    @IBOutlet var changeOrderNoteField: MaterialTextField!
    @IBOutlet var saveButton: DesignableButton!
    
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
    @IBOutlet var depositCollected: UILabel!
    @IBOutlet var grandTotal: UILabel!
    
    var selectedCustomer: Customer?
    var selectedItems: [Item] = []
    var groupItems: [[String: [Item]]] = []
    
    var item: WorkOrder!



    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        configureViews()
        loadData()
                
        self.title = "Change Order"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Load data -
    
    func loadData() {
        workOrderNumField.text          = item.work_order_number
        customerField.text              = item.customer_name
        
        selectedCustomer = Helpers.getCustomerById(item.customer_id)
        selectedItems.append(contentsOf: item.items)
        initiateItems()
    }
    
    // MARK: - Actions -
    
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
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        
        // create an alert
        let alertController = UIAlertController(title: "Record Change", message: "Select if you want to send the work order with changes to customer. No approval is required from the customer.", preferredStyle: .alert)
        let yesAction = UIAlertAction(title: "Record Change", style: .default) { (alertAction) -> Void in
            // create params
            let workOrder: Parameters = ["company_id": App.shared.companyId,
                                         "work_order_number": self.workOrderNumField.text!,
                                         "customer_id": self.selectedCustomer?.id ?? 0]
            
            // call api
            SVProgressHUD.setDefaultMaskType(.clear)
            SVProgressHUD.show()
            App.shared.api.putWorkOrder(self.item.id.intValue, params: workOrder) { (success, error) in
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
                // delete all items
                group.enter()
                App.shared.api.deleteInvoiceItems(self.item!.id.intValue) { (success, error) in
                    group.leave()
                }
                
                
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
                    SVProgressHUD.show()
                    App.shared.api.postWorkOrderItem(item) { (success, error) in
                        SVProgressHUD.setDefaultMaskType(.none)
                        SVProgressHUD.dismiss()
                        group.leave()
                    }
                }
                
                group.notify(queue: DispatchQueue.main, execute: {
                    SVProgressHUD.showSuccess(withStatus: "Data has been saved!")
                    self.popViewController()
                })
            }
        }
        alertController.addAction(yesAction)
        
        let noAction = UIAlertAction(title: "Close", style: .cancel) { (alertAction) -> Void in
            self.dismiss(animated: true, completion: nil)
        }
        alertController.addAction(noAction)
        
        self.present(alertController, animated: true, completion: nil)
    }
    
    @IBAction func requestApprovalButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        
    }

    // MARK: - TableView Datasource -
    
    override func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        if indexPath.section == 1 {
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
        } else if indexPath.section == 1 {
            if indexPath.row == 2 {
                return 77
            }
            return 60
        } else if indexPath.section == 4 {
            return 130
        }
        return 60
    }
    
    // MARK: - Functions -
    
    func configureViews() {
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
        
        // init textfield
        workOrderNumField.isEnabled = false
        customerField.isEnabled = false
        
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
