//
//  WorkOrderTabController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 18/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import Floaty
import FontAwesome_swift
import SVProgressHUD
import TLPhotoPicker

class WorkOrderTabController: UITabBarController {
    
    // MARK: - Properties -
    
    @IBOutlet var mEditButtonItem: UIBarButtonItem!
    @IBOutlet var homeButtonItem: UIBarButtonItem!
    @IBOutlet var printButtonItem: UIBarButtonItem!
    
    var floaty = Floaty()
    
    var item: WorkOrder = App.shared.selectedWorkOrder!
    var grandTotal = 0.00
    
    
    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initFAB()
        getGrandTotal()
        configureViews()
        
        
        // notification observers
        NotificationCenter.default.addObserver(self, selector: #selector(editItem(_:)), name: Notifications.willEditWorkOrder, object: nil)
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Notification -
    
    @objc func editItem(_ notification: Notification) {
        let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_EditWorkOrderController") as? EditWorkOrderController
        viewController?.item = self.item
        self.navigationController?.pushViewController(viewController!, animated: true)
    }
    
    // MARK: - Actions -
    
    @IBAction func editButtonTapped(_ sender: Any) {
        let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_EditWorkOrderController") as? EditWorkOrderController
        viewController?.item = self.item
        self.navigationController?.pushViewController(viewController!, animated: true)
    }
    
    @IBAction func homeButtonTapped(_ sender: Any) {
        App.shared.selectedMenu = .Home
        NotificationCenter.default.post(name: Notifications.didSwitchLeftMenu, object: self, userInfo: nil)
    }
    
    @IBAction func printButtonTapped(_ sender: Any) {
        if let document = WorkOrderPreviewController.shared.generatePdfFile() {
            if UIPrintInteractionController.canPrint(document.dataRepresentation()!) {
                let printInfo = UIPrintInfo(dictionary: nil)
                printInfo.jobName = "Work Order #\(self.item.work_order_number)"
                printInfo.outputType = .general

                let printController = UIPrintInteractionController.shared
                printController.printInfo = printInfo
                printController.showsNumberOfCopies = false
                printController.printingItem = document.dataRepresentation()
                printController.present(animated: true, completionHandler: nil)
            }
        }
    }
    
    // MARK: - Functions -
    
    func configureViews() {
        // configure navBar icons
        mEditButtonItem.image = UIImage.fontAwesomeIcon(name: .pencilAlt, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        homeButtonItem.image = UIImage.fontAwesomeIcon(name: .home, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        printButtonItem.image = UIImage.fontAwesomeIcon(name: .print, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        
        // configure tab bar
        let tabs = ["Arrival", "Start", "Pause", "Complete", "More"]
        let icons: [FontAwesome] = [.truckMoving, .stopwatch, .pauseCircle, .clipboardCheck, .ellipsisH]
        var tabBarList: [UIViewController] = []
        
        for (index, value) in tabs.enumerated() {
            let image = UIImage.fontAwesomeIcon(name: icons[index], style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 24, height: 24))
            let tabBarItem  = UITabBarItem(title: value, image: image, tag: index)
            let controller = self.storyboard?.instantiateViewController(withIdentifier: "sb_WorkOrderPreviewController") as! WorkOrderPreviewController
            controller.tabBarItem = tabBarItem
            tabBarList.append(controller)
        }
        
        //self.tabBar.tintColor = AppTheme.defaultColor
        self.viewControllers = tabBarList
        self.tabBar.isHidden = (item.status == "New") ? true : false
    }
    
    func getGrandTotal() {
        // init total
        var subTotal = 0.00
        var taxes = 0.00
        var grandTotal = 0.00
        
        // iterate items
        for item in self.item.items {
            subTotal += item.price.doubleValue
            taxes += (subTotal * 0.075)
            grandTotal = subTotal + taxes
        }
        
        // update
        self.grandTotal = grandTotal.rounded(toPlaces: 2)
    }
    
    func getWorkOrder() {
        // get item
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show()
        App.shared.api.getWorkOrder(self.item.id.intValue) { (result, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            
            // assign
            App.shared.selectedWorkOrder = result!
            
            // reconfigure views
            self.configureViews()
        }
    }
    
    func changeStatus() {
        if let vc = self.storyboard?.instantiateViewController(withIdentifier: "sb_SelectWorkOrderStatusController")  as? SelectWorkOrderStatusController {
            vc.callback = { status in
                // change status
                let params: Parameters = ["status": status]
                
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show()
                App.shared.api.putWorkOrder(self.item.id.intValue, params: params) { (success, error) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.dismiss()
                    guard error == nil else {
                        return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                    }
                    guard success == true else {
                        return SVProgressHUD.showError(withStatus: "Saving data failed!")
                    }
                    
                    // show alert
                    SVProgressHUD.show(withStatus: "Work Order status has been changed!")
                    
                    // reload workorder
                    self.getWorkOrder()
                }
            }
            self.navigationController?.pushViewController(vc, animated: true)
        }
    }
    
    func convertToEstimate() {
        // create an alert
        let alertController = UIAlertController(title: "Create Estimate for the Work Order", message: "You are going to create a new estimate for the Work Order \(self.item.work_order_number). Would you like to proceed?", preferredStyle: .alert)
        let yesAction = UIAlertAction(title: "Yes", style: .default) { (alertAction) -> Void in
            // get estimate number
            App.shared.api.getEstimateSetting() { (data, error) in
                if let e = error {
                    return print(e.localizedDescription)
                }
                
                let estimateNumber = "\(data?.estimate_num_prefix ?? "")\(data?.estimate_num_next.format5DigitNumber ?? "")"
                
                // convert to estimate
                let params: Parameters = ["company_id": App.shared.companyId,
                                          "estimate_number": estimateNumber,
                                          "estimate_type": "Standard",
                                          "customer_id": self.item.customer_id,
                                          "job_location": self.item.job_location,
                                          "job_name": self.item.job_name,
                                          "estimate_date": App.shared.dateFormatter.string(from: Date()),
                                          "expiry_date": App.shared.dateFormatter.string(from: Calendar.current.date(byAdding: .day, value: 29, to: Date())!),
                                          "purchase_order_number": self.item.po_number,
                                          "deposit_request": "",
                                          "status": "Draft",
                                          "estimate_value": self.grandTotal,
                                          "customer_message": data?.message ?? "",
                                          "terms_conditions": data?.terms_and_conditions ?? "",
                                          "instructions": self.item.instructions]
                
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show(withStatus: "Saving...")
                App.shared.api.postEstimate(params) { (result, error) in
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
                        let ungrouped = self.item.items.sorted(by: {$0.id > $1.id})
                        // group
                        let grouped = ungrouped.group(by: {$0.id})
                        // iterate
                        for (key, value) in grouped {
                            // create json
                            let item: Parameters = ["estimates_id": id, "items_id": key, "qty": value.count]
                            // enter group
                            group.enter()
                            
                            SVProgressHUD.setDefaultMaskType(.clear)
                            SVProgressHUD.show()
                            App.shared.api.postEstimateItem(item) { (success, error) in
                                SVProgressHUD.setDefaultMaskType(.none)
                                SVProgressHUD.dismiss()
                                group.leave()
                            }
                        }
                        
                        group.notify(queue: DispatchQueue.main, execute: {
                            // get estimate
                            App.shared.api.getEstimate(id.intValue, completion: { (item, error) in
                                guard error == nil else {
                                    return print(error?.localizedDescription ?? "")
                                }
                                
                                // go to edit estimate screen
                                App.shared.selectedMenu = .Estimates
                                NotificationCenter.default.post(name: Notifications.didSwitchLeftMenu, object: self, userInfo: nil)
                                NotificationCenter.default.post(name: Notifications.willOpenEstimatePreview, object: self, userInfo: ["estimate": item!])
                                /*let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_EditStandardEstimateController") as? EditStandardEstimateController
                                viewController?.item = item
                                self.navigationController?.pushViewController(viewController!, animated: true)*/
                            })
                        })
                    }
                }
            }
        }
        alertController.addAction(yesAction)
        
        let noAction = UIAlertAction(title: "No", style: .cancel) { (alertAction) -> Void in
            self.dismiss(animated: true, completion: nil)
        }
        alertController.addAction(noAction)
        
        self.present(alertController, animated: true, completion: nil)
    }
    
    func convertToInvoice() {
        // create an alert
        let alertController = UIAlertController(title: "Create Invoice for the Work Order", message: "You are going to create a new invoice for the Work Order \(self.item.work_order_number). Would you like to proceed?", preferredStyle: .alert)
        let yesAction = UIAlertAction(title: "Yes", style: .default) { (alertAction) -> Void in
            // soft delete work order
            let params: Parameters = ["is_invoiced": 1,
                                      "invoiced_date": App.shared.dateFormatter.string(from: Date())]
            
            SVProgressHUD.setDefaultMaskType(.clear)
            SVProgressHUD.show()
            App.shared.api.putWorkOrder(self.item.id.intValue, params: params) { (success, error) in
                SVProgressHUD.setDefaultMaskType(.none)
                SVProgressHUD.dismiss()
                guard error == nil else {
                    return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                }
                guard success == true else {
                    return SVProgressHUD.showError(withStatus: "Saving data failed!")
                }
                
                // get invoice number
                App.shared.api.getInvoiceSetting() { (data, error) in
                    if let e = error {
                        return print(e.localizedDescription)
                    }
                    
                    let invoiceNumber = "\(data?.invoice_num_prefix ?? "")\(data?.invoice_num_next.format5DigitNumber ?? "")"
                    
                    // convert to invoice
                    let invoice: Parameters = ["company_id": App.shared.companyId,
                                               "customer_id": self.item.customer_id,
                                               "job_location": self.item.job_location,
                                               "job_name": self.item.job_name,
                                               "invoice_type": "Total Due",
                                               "work_order_number": self.item.work_order_number,
                                               "po_number": self.item.po_number,
                                               "invoice_number": invoiceNumber,
                                               "date_issued": App.shared.dateFormatter.string(from: Date()),
                                               "due_date": App.shared.dateFormatter.string(from: Date()),
                                               "status": "Draft",
                                               "total_due": self.grandTotal,
                                               "balance": "",
                                               "deposit_request": "",
                                               "accept_credit_card": data?.accept_credit_card ?? 1,
                                               "accept_check": data?.accept_check ?? 1,
                                               "accept_cash": data?.accept_cash ?? 1,
                                               "accept_direct_deposit": data?.accept_direct_deposit ?? 1,
                                               "accept_credit": data?.accept_credit ?? 1,
                                               "message_to_customer": data?.message ?? "",
                                               "terms_and_conditions": data?.terms_and_conditions ?? ""]
                    
                    SVProgressHUD.setDefaultMaskType(.clear)
                    SVProgressHUD.show()
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
                            let ungrouped = self.item.items.sorted(by: {$0.id > $1.id})
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
                            
                            group.notify(queue: DispatchQueue.main, execute: {
                                // get invoice
                                App.shared.api.getInvoice(id.intValue, completion: { (item, error) in
                                    guard error == nil else {
                                        return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                                    }
                                    
                                    // go to edit invoice screen
                                    App.shared.selectedMenu = .Invoices
                                    NotificationCenter.default.post(name: Notifications.didSwitchLeftMenu, object: self, userInfo: nil)
                                    NotificationCenter.default.post(name: Notifications.willOpenInvoicePreview, object: self, userInfo: ["invoice": item!])
                                    /*let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_EditInvoiceController") as? EditInvoiceController
                                    viewController?.item = item
                                    self.navigationController?.pushViewController(viewController!, animated: true)*/
                                })
                            })
                        }
                    }
                }
            }
        }
        alertController.addAction(yesAction)
        
        let noAction = UIAlertAction(title: "No", style: .cancel) { (alertAction) -> Void in
            self.dismiss(animated: true, completion: nil)
        }
        alertController.addAction(noAction)
        
        self.present(alertController, animated: true, completion: nil)
    }
    
    func requestSignature() {
        // create an alert
        let alertController = UIAlertController(title: "Authorizer Name", message: nil, preferredStyle: .alert)
        
        alertController.addTextField(configurationHandler: { textField in
            textField.placeholder = "Authorizer name here..."
        })
        
        let yesAction = UIAlertAction(title: "Save", style: .default) { (alertAction) -> Void in
            // get name
            if let name = alertController.textFields?.first?.text {
                // save authorizer_name
                let params = ["authorizer_name": name]
                
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show()
                App.shared.api.putWorkOrder(self.item.id.intValue, params: params) { (success, error) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.dismiss()
                }
                
                // present signature controller
                if let vc = self.storyboard?.instantiateViewController(withIdentifier: "sb_WorkOrderSignController")  as? WorkOrderSignController {
                    vc.authorizer = name
                    vc.callback = { (beforeImage, afterImage, ownerImage) in
                        // save to user defaults
                        //UserDefaults.standard.setImage(image: beforeImage, forKey: "BEFORE-SIGNATURE-\(self.item.work_order_number)")
                        //UserDefaults.standard.setImage(image: afterImage, forKey: "AFTER-SIGNATURE-\(self.item.work_order_number)")
                        //UserDefaults.standard.setImage(image: ownerImage, forKey: "OWNER-SIGNATURE-\(self.item.work_order_number)")
                        
                        // upload signature
                        if let image = beforeImage {
                            // params
                            let params: Parameters = ["company_id": App.shared.companyId,
                                                      "work_order_id": self.item.id,
                                                      "column_name": "before_signature",
                                                      "date_column_name": "before_sign_date"]
                            
                            // upload
                            SVProgressHUD.setDefaultMaskType(.clear)
                            SVProgressHUD.show()
                            App.shared.api.uploadWorkOrderSignature(image, imageName: "\(self.item.work_order_number)_before_\(Date().currentTimeMillis()).jpg", params: params) { (success, error) in
                                SVProgressHUD.setDefaultMaskType(.none)
                                SVProgressHUD.dismiss()
                                guard error == nil else {
                                    return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                                }
                                
                                self.configureViews()
                            }
                        }
                        
                        if let image = afterImage {
                            // params
                            let params: Parameters = ["company_id": App.shared.companyId,
                                                      "work_order_id": self.item.id,
                                                      "column_name": "after_signature",
                                                      "date_column_name": "after_sign_date"]
                            
                            // upload
                            SVProgressHUD.setDefaultMaskType(.clear)
                            SVProgressHUD.show()
                            App.shared.api.uploadWorkOrderSignature(image, imageName: "\(self.item.work_order_number)_after_\(Date().currentTimeMillis()).jpg", params: params) { (success, error) in
                                SVProgressHUD.setDefaultMaskType(.none)
                                SVProgressHUD.dismiss()
                                guard error == nil else {
                                    return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                                }
                                
                                self.configureViews()
                            }
                        }
                        
                        if let image = ownerImage {
                            // params
                            let params: Parameters = ["company_id": App.shared.companyId,
                                                      "work_order_id": self.item.id,
                                                      "column_name": "owner_signature",
                                                      "date_column_name": "owner_sign_date"]
                            
                            // upload
                            SVProgressHUD.setDefaultMaskType(.clear)
                            SVProgressHUD.show()
                            App.shared.api.uploadWorkOrderSignature(image, imageName: "\(self.item.work_order_number)_owner_\(Date().currentTimeMillis()).jpg", params: params) { (success, error) in
                                SVProgressHUD.setDefaultMaskType(.none)
                                SVProgressHUD.dismiss()
                                guard error == nil else {
                                    return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                                }
                                
                                self.configureViews()
                            }
                        }
                    }
                    self.navigationController?.pushViewController(vc, animated: true)
                }
            }
        }
        alertController.addAction(yesAction)
        
        let noAction = UIAlertAction(title: "Cancel", style: .cancel) { (alertAction) -> Void in
            self.dismiss(animated: true, completion: nil)
        }
        alertController.addAction(noAction)
        
        self.present(alertController, animated: true, completion: nil)
    }
    
    func cancelSchedule() {
        // create an alert
        let alertController = UIAlertController(title: "Cancel Schedule", message: "You are about to cancel a schedule for the customer \(self.item.customer_name). Would you like to proceed?", preferredStyle: .alert)
        let yesAction = UIAlertAction(title: "Yes", style: .default) { (alertAction) -> Void in
            // cancel schedule
            let params: Parameters = ["status": "New"]
            
            SVProgressHUD.setDefaultMaskType(.clear)
            SVProgressHUD.show()
            App.shared.api.putWorkOrder(self.item.id.intValue, params: params) { (success, error) in
                SVProgressHUD.setDefaultMaskType(.none)
                SVProgressHUD.dismiss()
                guard error == nil else {
                    return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                }
                guard success == true else {
                    return SVProgressHUD.showError(withStatus: "Saving data failed!")
                }
                
                // show alert
                SVProgressHUD.show(withStatus: "Work Order status has been changed!")
                
                // reload workorder
                self.getWorkOrder()
            }
        }
        alertController.addAction(yesAction)
        
        let noAction = UIAlertAction(title: "No", style: .cancel) { (alertAction) -> Void in
            self.dismiss(animated: true, completion: nil)
        }
        alertController.addAction(noAction)
        
        self.present(alertController, animated: true, completion: nil)
    }
    
    func changeOrder() {
        let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_ChangeOrderController") as? ChangeOrderController
        viewController?.item = self.item
        self.navigationController?.pushViewController(viewController!, animated: true)
    }
    
    func reschedule() {
        if let vc = self.storyboard?.instantiateViewController(withIdentifier: "sb_RescheduleController")  as? RescheduleController {
            vc.item = self.item
            vc.callback = { result in
                // reload views
                self.configureViews()
            }
            self.navigationController?.pushViewController(vc, animated: true)
        }
    }
    
    func updateNote() {
        let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_UpdateWONoteController") as? UpdateWONoteController
        viewController?.item = self.item
        self.navigationController?.pushViewController(viewController!, animated: true)
    }
    
    func logTime() {
        let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_LogWOTimeController") as? LogWOTimeController
        viewController?.item = self.item
        self.navigationController?.pushViewController(viewController!, animated: true)
    }

}

// MARK: - Floaty Delegate -

extension WorkOrderTabController: FloatyDelegate {
    
    func initFAB() {
        
        // init
        floaty.fabDelegate  = self
        floaty.sticky       = true
        floaty.buttonColor  = .clear
        floaty.buttonImage  = UIImage.fontAwesomeIcon(name: .bars, style: .solid, textColor: .clear, size: CGSize(width: 30, height: 30))
        floaty.paddingY     = 0
        
        // check status
        if item.status == "New" {
            // reinit fab
            floaty.buttonColor  = .greenColor
            floaty.buttonImage  = UIImage.fontAwesomeIcon(name: .plus, style: .solid, textColor: .white, size: CGSize(width: 30, height: 30))
            floaty.paddingY     = 20
            
            // init fab items
            floaty.addItem("Notes", icon: UIImage.fontAwesomeIcon(name: .fileAlt, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.updateNote()
            })
            floaty.addItem("Change Status", icon: UIImage.fontAwesomeIcon(name: .flag, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.changeStatus()
            })
            floaty.addItem("Attach Photo", icon: UIImage.fontAwesomeIcon(name: .image, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.presentImagePicker()
            })
            floaty.addItem("Schedule & Assign", icon: UIImage.fontAwesomeIcon(name: .calendarPlus, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.reschedule()
            })
            floaty.addItem("Request Signature", icon: UIImage.fontAwesomeIcon(name: .signature, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.requestSignature()
            })
            floaty.addItem("Convert To Invoice", icon: UIImage.fontAwesomeIcon(name: .fileInvoiceDollar, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.convertToInvoice()
            })
            floaty.addItem("Convert To Estimate", icon: UIImage.fontAwesomeIcon(name: .calculator, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.convertToEstimate()
            })
            self.view.addSubview(floaty)
            
        } else if item.status == "Scheduled" {
            // init fab items
            floaty.addItem("Notes", icon: UIImage.fontAwesomeIcon(name: .fileAlt, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.updateNote()
            })
            floaty.addItem("Log Time", icon: UIImage.fontAwesomeIcon(name: .stopwatch, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.logTime()
            })
            floaty.addItem("Reschedule", icon: UIImage.fontAwesomeIcon(name: .calendarAlt, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.reschedule()
            })
            floaty.addItem("Change Order", icon: UIImage.fontAwesomeIcon(name: .edit, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.changeOrder()
            })
            floaty.addItem("Attach Photo", icon: UIImage.fontAwesomeIcon(name: .image, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.presentImagePicker()
            })
            floaty.addItem("Change Status", icon: UIImage.fontAwesomeIcon(name: .flag, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.changeStatus()
            })
            floaty.addItem("Cancel Schedule", icon: UIImage.fontAwesomeIcon(name: .ban, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.cancelSchedule()
            })
            floaty.addItem("Request Signature", icon: UIImage.fontAwesomeIcon(name: .signature, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.requestSignature()
            })
            floaty.addItem("Convert To Invoice", icon: UIImage.fontAwesomeIcon(name: .fileInvoiceDollar, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.convertToInvoice()
            })
            floaty.addItem("Convert To Estimate", icon: UIImage.fontAwesomeIcon(name: .calculator, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.convertToEstimate()
            })
            self.view.addSubview(floaty)
            
        } else if item.status == "Invoiced" {
            // init fab items
            floaty.addItem("Notes", icon: UIImage.fontAwesomeIcon(name: .fileAlt, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.updateNote()
            })
            floaty.addItem("Log Time", icon: UIImage.fontAwesomeIcon(name: .stopwatch, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.logTime()
            })
            floaty.addItem("Change Order", icon: UIImage.fontAwesomeIcon(name: .edit, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.changeOrder()
            })
            floaty.addItem("Attach Photo", icon: UIImage.fontAwesomeIcon(name: .image, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.presentImagePicker()
            })
            floaty.addItem("Change Status", icon: UIImage.fontAwesomeIcon(name: .flag, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.changeStatus()
            })
            floaty.addItem("Convert To Estimate", icon: UIImage.fontAwesomeIcon(name: .calculator, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.convertToEstimate()
            })
            self.view.addSubview(floaty)
        }
    }
}

// MARK: - TLPhotosPickerViewControllerDelegate -

extension WorkOrderTabController: TLPhotosPickerViewControllerDelegate {
     
    func presentImagePicker() {
        var selectedAssets = [TLPHAsset]()
        
        let viewController = TLPhotosPickerViewController(withTLPHAssets: { assets in
            selectedAssets = assets
            
            // params
            let params = ["company_id": App.shared.companyId]
            
            // create group
            let group = DispatchGroup()
            
            // iterate images
            for asset in assets {
                // enter
                group.enter()
                
                // upload
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show(withStatus: "Uploading...")
                App.shared.api.uploadWorkOrderPhoto(asset.fullResolutionImage!, imageName: "\(self.item.work_order_number)_photo_\(Date().currentTimeMillis()).jpg", params: params) { (success, error) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.dismiss()
                    guard error == nil else {
                        return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                    }
                    
                    group.leave()
                }
            }
            
            // notify
            group.notify(queue: DispatchQueue.main, execute: {
                SVProgressHUD.showSuccess(withStatus: "Files are uploaded!")
            })
            
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
