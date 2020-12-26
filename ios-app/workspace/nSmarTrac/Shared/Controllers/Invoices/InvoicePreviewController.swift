//
//  InvoicePreviewController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 31/07/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import Floaty
import FontAwesome_swift
import MessageUI
import PDFKit
import SVProgressHUD

class InvoicePreviewController: UIViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var homeButtonItem: UIBarButtonItem!
    @IBOutlet var printButtonItem: UIBarButtonItem!
    @IBOutlet var tableView: UITableView!
    @IBOutlet var buttonView: UIView!
    
    @IBOutlet var buttonTop: NSLayoutConstraint!
    
    @IBOutlet var badgeView: UIImageView!
    @IBOutlet var invoiceNumber: UILabel!
    @IBOutlet var dateIssued: UILabel!
    @IBOutlet var dateDue: UILabel!
    @IBOutlet var invoiceType: UILabel!
    @IBOutlet var balanceDue: UILabel!
    @IBOutlet var companyLogo: UIImageView!
    @IBOutlet var companyName: UILabel!
    @IBOutlet var companyLicense: UILabel!
    @IBOutlet var companyAddress: UILabel!
    @IBOutlet var companyState: UILabel!
    @IBOutlet var companyPhoneIcon: UIImageView!
    @IBOutlet var companyPhone: UILabel!
    @IBOutlet var customerName: UILabel!
    @IBOutlet var customerAddress: UILabel!
    @IBOutlet var customerState: UILabel!
    @IBOutlet var customerEmailIcon: UIImageView!
    @IBOutlet var customerEmail: UILabel!
    @IBOutlet var customerPhoneIcon: UIImageView!
    @IBOutlet var customerPhone: UILabel!
    @IBOutlet var customerMobileIcon: UIImageView!
    @IBOutlet var customerMobile: UILabel!
    
    var floaty = Floaty()
    
    var item: Invoice = App.shared.selectedInvoice!
    var items: [[Item]] = []
    var signatureImage: UIImage?
    var logoImage: UIImage?
    
    
    // MARK: - Lifecycle -
    
    override func viewDidLoad() {
        super.viewDidLoad()
        downloadSignatureImage()
        initNavBar()
        initFAB()
        
        
        // notification observers
        NotificationCenter.default.addObserver(self, selector: #selector(editItem(_:)), name: Notifications.willEditInvoice, object: nil)
    }
    
    override func viewDidAppear(_ animated: Bool) {
        initViews()
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Navigation Bar -
    
    func initNavBar() {
        // setup navBar icons
        homeButtonItem.image = UIImage.fontAwesomeIcon(name: .home, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        printButtonItem.image = UIImage.fontAwesomeIcon(name: .print, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        
        // set title
        self.navigationItem.title = "#\(item.invoice_number)"
    }
    
    // MARK: - Notification -
    
    @objc func editItem(_ notification: Notification) {
        let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_EditInvoiceController") as? EditInvoiceController
        viewController?.item = self.item
        self.navigationController?.pushViewController(viewController!, animated: true)
    }
    
    // MARK: - Actions -
    
    @IBAction func homeButtonTapped(_ sender: Any) {
        App.shared.selectedMenu = .Home
        NotificationCenter.default.post(name: Notifications.didSwitchLeftMenu, object: self, userInfo: nil)
    }
    
    @IBAction func printButtonTapped(_ sender: Any) {
        if let document = self.generatePdfFile() {
            if UIPrintInteractionController.canPrint(document.dataRepresentation()!) {
                let printInfo = UIPrintInfo(dictionary: nil)
                printInfo.jobName = "Invoice #\(self.item.invoice_number)"
                printInfo.outputType = .general

                let printController = UIPrintInteractionController.shared
                printController.printInfo = printInfo
                printController.showsNumberOfCopies = false
                printController.printingItem = document.dataRepresentation()
                printController.present(animated: true, completionHandler: nil)
            }
        }
    }
    
    @IBAction func payNowButtonTapped(_ sender: Any) {
        // check
        if item.status == "Paid" {
            self.pushTo(storyBoard: "Main", identifier: "sb_RecordPaymentController")
        } else {
            self.pushTo(storyBoard: "Main", identifier: "sb_PaymentController")
        }
    }
    
    @IBAction func sendButtonTapped(_ sender: Any) {
        self.sendInvoice()
    }
    
    @IBAction func callPhoneButtonTapped(_ sender: Any) {
        if let url = URL(string: "tel://" + item.customer_phone.unformatContactNumber!) {
            if UIApplication.shared.canOpenURL(url) {
                UIApplication.shared.open(url, options: [:], completionHandler: nil)
            }
        }
    }
    
    @IBAction func smsPhoneButtonTapped(_ sender: Any) {
        if (MFMessageComposeViewController.canSendText()) {
            let controller = MFMessageComposeViewController()
            controller.body = ""
            controller.recipients = [item.customer_phone]
            controller.messageComposeDelegate = self
            self.present(controller, animated: true, completion: nil)
        }
    }
    
    @IBAction func callMobileButtonTapped(_ sender: Any) {
        if let url = URL(string: "tel://" + item.customer_mobile.unformatContactNumber!) {
            if UIApplication.shared.canOpenURL(url) {
                UIApplication.shared.open(url, options: [:], completionHandler: nil)
            }
        }
    }
    
    @IBAction func smsMobileButtonTapped(_ sender: Any) {
        if (MFMessageComposeViewController.canSendText()) {
            let controller = MFMessageComposeViewController()
            controller.body = ""
            controller.recipients = [item.customer_mobile]
            controller.messageComposeDelegate = self
            self.present(controller, animated: true, completion: nil)
        }
    }
    
    // MARK: - Functions -
    
    func downloadSignatureImage() {
        // check
        if !item.signature.isEmpty {
            // download image
            App.shared.api.downloadImage(item.signature, completion: { image in
                self.signatureImage = image
                self.initViews()
            })
        }
    }
    
    func initViews() {
        // icons
        let phoneIcon = UIImage.fontAwesomeIcon(name: .phone, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
        let mobileIcon = UIImage.fontAwesomeIcon(name: .mobileAlt, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
        let emailIcon = UIImage.fontAwesomeIcon(name: .envelope, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
        // logo
        if let logo = UserDefaults.standard.imageForKey(key: App.shared.logoKey) {
            logoImage = logo
        }
        // badge
        self.badgeView.image = PdfHelper.addBadge(status: item.status)
        
        // 1
        invoiceNumber.text      = "#" + item.invoice_number
        dateIssued.text         = item.date_issued
        dateDue.text            = item.due_date
        invoiceType.text        = item.invoice_type
        balanceDue.text         = "$" + item.balance
        // 2
        companyLogo.image       = logoImage
        //companyName.text      = App.shared.company!.business_name
        //companyLicense.text   = App.shared.company!.license_state
        //companyAddress.text   = App.shared.company!.street
        //companyState.text     = "\(App.shared.company!.city), \(App.shared.company!.state) \(App.shared.company!.postal_code)"
        companyPhoneIcon.image  = phoneIcon
        //companyPhone.text     = "Phone: \(App.shared.company!.business_phone)"
        // 3
        let address                 = item.customer_address.components(separatedBy: "::")
        customerName.text           = item.customer_name
        customerAddress.text        = address.first!
        customerState.text          = address.last!
        customerEmailIcon.image     = emailIcon
        customerEmail.text          = "Email: " + item.customer_email
        customerPhoneIcon.image     = phoneIcon
        customerPhone.text          = "Phone: " + item.customer_phone
        customerMobileIcon.image    = mobileIcon
        customerMobile.text         = "Mobile: " + item.customer_mobile
        // 4
        // sort ungrouped
        let ungrouped = item.items.sorted(by: {$0.id > $1.id})
        // group
        let grouped = ungrouped.group(by: {$0.id})
        // clear items
        items.removeAll()
        // iterate
        for (_, value) in grouped {
            items.append(value)
        }
        self.tableView.reloadData()
        
    }
    
    /*func initPDF() {
        let pdfView = PDFView(frame: view.bounds)
        pdfView.autoScales          = true
        pdfView.displayDirection    = .vertical
        pdfView.displayMode         = .singlePageContinuous
        
        if let pdfDocument = self.generatePdfFile() {
            containerView.addSubview(pdfView)
            pdfView.document = pdfDocument
        }
    }*/
    
    private func generatePdfFile() -> PDFDocument? {
        // 1
        let pdfMetaData = [
          kCGPDFContextCreator: "nSmarTrac",
          kCGPDFContextAuthor: "nsmartrac.com"
        ]
        let format = UIGraphicsPDFRendererFormat()
        format.documentInfo = pdfMetaData as [String: Any]

        // 2
        let pageWidth = 8.5 * 72.0
        let pageHeight = 30 * 72.0
        let pageRect = CGRect(x: 0, y: 0, width: pageWidth, height: pageHeight)
        let row = CGFloat(pageWidth/3)
        let row2 = CGFloat(pageWidth/2)

        // 3
        let renderer = UIGraphicsPDFRenderer(bounds: pageRect, format: format)
        
        // 4
        let data = renderer.pdfData { (context) in
            // icons
            let phoneIcon = UIImage.fontAwesomeIcon(name: .phone, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
            let mobileIcon = UIImage.fontAwesomeIcon(name: .mobileAlt, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
            let emailIcon = UIImage.fontAwesomeIcon(name: .envelope, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
            // logo
            if let logo = UserDefaults.standard.imageForKey(key: App.shared.logoKey) {
                logoImage = logo
            }
            
            // 5
            context.beginPage()
            // 6
            let titleBottom = PdfHelper.addTitle(pageRect: pageRect, title: "INVOICE")
            // 7
            let imageBottom = PdfHelper.addImage(pageRect: pageRect, imageTop: titleBottom+40, image: logoImage!)
            // 8
            let invNumBottom = PdfHelper.addText(pageRect: pageRect, textTop: titleBottom, text: "# \(item.invoice_number)")
            PdfHelper.drawLine(context.cgContext, pageRect: pageRect, lineTop: invNumBottom+5, x2: nil)
            // 9
            let invDateBottom = PdfHelper.addText(pageRect: pageRect, xCoor: row, mWidth: row, textTop: invNumBottom+15, text: "Date Issued:")
            _ = PdfHelper.addText(pageRect: pageRect, textTop: invNumBottom+15, text: item.date_issued.toReadableDate)
            // 10
            let invDueDateBottom = PdfHelper.addText(pageRect: pageRect, xCoor: row, mWidth: row, textTop: invDateBottom+10, text: "Date Due:")
            _ = PdfHelper.addText(pageRect: pageRect, textTop: invDateBottom+10, text: item.due_date.toReadableDate)
            // 11
            let invTypeBottom = PdfHelper.addText(pageRect: pageRect, xCoor: row, mWidth: row, textTop: invDueDateBottom+10, text: "Type")
            _ = PdfHelper.addText(pageRect: pageRect, textTop: invDueDateBottom+10, text: item.invoice_type)
            // 12
            _ = PdfHelper.addText(pageRect: pageRect, xCoor: row, mWidth: row, textTop: invTypeBottom+10, text: "Balance Due", textFont: UIFont.robotoBoldFont(ofSize: 18))
            _ = PdfHelper.addText(pageRect: pageRect, textTop: invTypeBottom+10, text: "$\(item.balance)", textFont: UIFont.robotoBoldFont(ofSize: 18))
            // 12
            let fromBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: imageBottom+20, text: "FROM:", textFont: UIFont.robotoBoldFont(ofSize: 18))
            PdfHelper.drawLine(context.cgContext, pageRect: pageRect, lineTop: fromBottom+5, x2: nil)
            // 13
            let companyNameBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: fromBottom, text: "ADi")
            let companyLicenseBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: companyNameBottom-20, text: "License: EF, AL, MS")
            let companyAddressBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: companyLicenseBottom-20, text: "6866 Pine Forest Road")
            let companyStateBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: companyAddressBottom-20, text: "Pensacola, FL 32526")
            _ = PdfHelper.addIcon(pageRect: pageRect, xCoor: 30, imageTop: companyStateBottom+10, image: phoneIcon)
            let companyPhoneBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 60, textTop: companyStateBottom-20, text: "Phone: (850) 478-0530")
            // 14
            let toBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: companyPhoneBottom+40, text: "TO:", textFont: UIFont.robotoBoldFont(ofSize: 18))
            PdfHelper.drawLine(context.cgContext, pageRect: pageRect, lineTop: toBottom+5, x2: nil)
            // 15
            let customerAddress = item.customer_address.components(separatedBy: "::")
            let customerNameBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: toBottom, text: item.customer_name)
            let customerAddressBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: customerNameBottom-20, text: customerAddress.first!)
            let customerStateBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: customerAddressBottom-20, text: customerAddress.last!)
            _ = PdfHelper.addIcon(pageRect: pageRect, xCoor: 30, imageTop: customerStateBottom+10, image: emailIcon)
            let customerEmailBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 60, textTop: customerStateBottom-20, text: "Email: \(item.customer_email)")
            _ = PdfHelper.addIcon(pageRect: pageRect, xCoor: 30, imageTop: customerEmailBottom+10, image: phoneIcon)
            let customerPhoneBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 60, textTop: customerEmailBottom-20, text: "Phone: \(item.customer_phone)")
            _ = PdfHelper.addIcon(pageRect: pageRect, xCoor: 30, imageTop: customerPhoneBottom+10, image: mobileIcon)
            let customerMobileBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 60, textTop: customerPhoneBottom-20, text: "Mobile: \(item.customer_mobile)")
            //16
            let jobBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: customerMobileBottom+40, text: "JOB DETAILS:", textFont: UIFont.robotoBoldFont(ofSize: 18))
            PdfHelper.drawLine(context.cgContext, pageRect: pageRect, lineTop: jobBottom+5, x2: nil)
            
            var itemTop = jobBottom + 50
            if !item.job_name.isEmpty {
                // 17
                let address = item.job_location.components(separatedBy: ", ")
                let jobNameBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: jobBottom, text: item.job_name)
                let jobAddressBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: jobNameBottom-20, text: address.first!)
                let jobStateBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: jobAddressBottom-20, text: "\(address[1]), \(address[2])")
                
                itemTop = jobStateBottom + 40
            }
            
            // 18
            let grandTotalBottom = PdfHelper.drawItems(context.cgContext, pageRect: pageRect, lineTop: itemTop, items: item.items)
            
            // 19
            var depositTop = grandTotalBottom
            if !item.deposit_request.isEmpty {
                let width = (pageRect.width-30)/8
                let depositBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: depositTop, text: "Payment Schedule", textFont: UIFont.robotoBoldFont(ofSize: 18))
                _ = PdfHelper.addItemLabel(pageRect: pageRect, xCoor: width*6, width: width*2, textTop: depositTop, text: "$\(item.deposit_request)")
                
                depositTop = depositBottom
            }
            
            // 20
            let methodBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: depositTop+40, text: "Accepted Payment Methods", textFont: UIFont.robotoBoldFont(ofSize: 18))
            PdfHelper.drawLine(context.cgContext, pageRect: pageRect, lineTop: methodBottom+5, x2: nil)
            // 21
            let paymentBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: methodBottom, text: "Credit Card, Check, Cash, Direct Deposit")
            let mobilePaymentBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: paymentBottom, text: "Accepting Mobile Payments")
            // 22
            let messageBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: mobilePaymentBottom+40, text: "Message", textFont: UIFont.robotoBoldFont(ofSize: 18))
            PdfHelper.drawLine(context.cgContext, pageRect: pageRect, lineTop: messageBottom+5, x2: nil)
            // 23
            let customerMsgBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: messageBottom, text: item.message_to_customer)
            
            // 24
            if let image = signatureImage {
                // add signature
                let signatureBottom = PdfHelper.addSignature(pageRect: pageRect, imageTop: customerMsgBottom+20, image: image)
                PdfHelper.drawLine(context.cgContext, pageRect: pageRect, lineTop: signatureBottom+5, x2: row2)
                
                let signedBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: signatureBottom, text: "signed on \(item.sign_date.toReadableDate)")
                _ = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: signedBottom-10, text: "by \(App.shared.company?.business_name ?? "Company Name")")
            }
            
        }
        
        // return
        return PDFDocument(data: data)
    }
    
    func convertToWorkOrder() {
        // create an alert
        let alertController = UIAlertController(title: "Convert Invoice to Work Order", message: "You are going to create a new work order based on Invoice \(self.item.invoice_number). Would you like to proceed?", preferredStyle: .alert)
        let yesAction = UIAlertAction(title: "Yes", style: .default) { (alertAction) -> Void in
            // get work_order_number
            App.shared.api.getWorkOrderSetting() { (data, error) in
                if let e = error {
                    return print(e.localizedDescription)
                }
                
                let workOrderNumber = "\(data?.work_order_num_prefix ?? "")\(data?.work_order_num_next.format5DigitNumber ?? "")"
                
                // convert to work order
                let workOrder: Parameters = ["company_id": App.shared.companyId,
                                             "work_order_number": workOrderNumber,
                                             "customer_id": self.item.customer_id,
                                             "employee_id": 0,
                                             "job_location": self.item.job_location,
                                             "start_date": App.shared.dateFormatter.string(from: Date()),
                                             "start_time": "8:00 am",
                                             "end_date": App.shared.dateFormatter.string(from: Date()),
                                             "end_time": "9:00 am",
                                             "event_color": "",
                                             "customer_reminder_notification": "1 day before",
                                             "date_issued": App.shared.dateFormatter.string(from: Date()),
                                             "job_type": "Service",
                                             "job_name": self.item.job_name,
                                             "job_description": "",
                                             "status": "New",
                                             "priority": "Standard",
                                             "po_number": self.item.po_number,
                                             "instructions": ""]
                
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show()
                App.shared.api.postWorkOrder(workOrder) { (result, error) in
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
                            let item: Parameters = ["work_order_id": id, "items_id": key, "qty": value.count]
                            // enter group
                            group.enter()
                            
                            SVProgressHUD.setDefaultMaskType(.clear)
                            SVProgressHUD.show(withStatus: "Saving...")
                            App.shared.api.postWorkOrderItem(item) { (success, error) in
                                SVProgressHUD.setDefaultMaskType(.none)
                                SVProgressHUD.dismiss()
                                group.leave()
                            }
                        }
                        
                        group.notify(queue: DispatchQueue.main, execute: {
                            // get work order
                            App.shared.api.getWorkOrder(id.intValue, completion: { (item, error) in
                                guard error == nil else {
                                    return print(error?.localizedDescription ?? "")
                                }
                                
                                // go to work order screen
                                App.shared.selectedMenu = .WorkOrder
                                NotificationCenter.default.post(name: Notifications.didSwitchLeftMenu, object: self, userInfo: nil)
                                NotificationCenter.default.post(name: Notifications.willOpenWorkOrderPreview, object: self, userInfo: ["workorder": item!])
                                /*let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_EditWorkOrderController") as? EditWorkOrderController
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
    
    func cloneInvoice() {
        // create an alert
        let alertController = UIAlertController(title: "Clone Invoice", message: "You are going to create a new invoice based on Invoice \(self.item.invoice_number). The new invoice will contain the same items (e.g. materials, labour) and you will be able to edit and remove invoice items as you need. Would you like to proceed?", preferredStyle: .alert)
        let yesAction = UIAlertAction(title: "Yes", style: .default) { (alertAction) -> Void in
            // get invoice number
            App.shared.api.getInvoiceSetting() { (data, error) in
                if let e = error {
                    return print(e.localizedDescription)
                }
                
                let invoiceNumber = "\(data?.invoice_num_prefix ?? "")\(data?.invoice_num_next.format5DigitNumber ?? "")"
                
                // clone
                let invoice: Parameters = ["company_id": App.shared.companyId,
                                           "customer_id": self.item.customer_id,
                                           "job_location": self.item.job_location,
                                           "job_name": self.item.job_name,
                                           "invoice_type": self.item.invoice_type,
                                           "work_order_number": self.item.work_order_number,
                                           "po_number": self.item.po_number,
                                           "invoice_number": invoiceNumber,
                                           "date_issued": App.shared.dateFormatter.string(from: Date()),
                                           "due_date": App.shared.dateFormatter.string(from: Date()),
                                           "status": self.item.status,
                                           "total_due": self.item.total_due,
                                           "balance": self.item.balance,
                                           "deposit_request": self.item.deposit_request,
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
        alertController.addAction(yesAction)
        
        let noAction = UIAlertAction(title: "No", style: .cancel) { (alertAction) -> Void in
            self.dismiss(animated: true, completion: nil)
        }
        alertController.addAction(noAction)
        
        self.present(alertController, animated: true, completion: nil)
    }
    
    func editInvoice() {
        // edit
        let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_EditInvoiceController") as? EditInvoiceController
        viewController?.item = self.item
        self.navigationController?.pushViewController(viewController!, animated: true)
    }
    
    func resendInvoice() {
        // create an alert
        let alertController = UIAlertController(title: "Resend Invoice", message: "Re-send Invoice \(self.item.invoice_number) to customer \(self.item.customer_name), would you like to proceed?", preferredStyle: .alert)
        let yesAction = UIAlertAction(title: "Yes", style: .default) { (alertAction) -> Void in
            self.sendInvoice()
        }
        alertController.addAction(yesAction)
        
        let noAction = UIAlertAction(title: "No", style: .cancel) { (alertAction) -> Void in
            self.dismiss(animated: true, completion: nil)
        }
        alertController.addAction(noAction)
        
        self.present(alertController, animated: true, completion: nil)
    }
    
    func reminder() {
        // create an alert
        let alertController = UIAlertController(title: "Send reminder", message: "Send a reminder email to \(self.item.customer_name), would you like to proceed?", preferredStyle: .alert)
        let yesAction = UIAlertAction(title: "Yes", style: .default) { (alertAction) -> Void in
            
        }
        alertController.addAction(yesAction)
        
        let noAction = UIAlertAction(title: "No", style: .cancel) { (alertAction) -> Void in
            self.dismiss(animated: true, completion: nil)
        }
        alertController.addAction(noAction)
        
        self.present(alertController, animated: true, completion: nil)
    }
    
    func requestSignature() {
        if let vc = self.storyboard?.instantiateViewController(withIdentifier: "sb_SignInvoiceController")  as? SignInvoiceController {
            vc.callback = { image in
                // add signature
                self.signatureImage = image
                
                // upload signature
                // params
                let params: Parameters = ["company_id": App.shared.companyId,
                                          "invoice_id": self.item.id]
                
                // upload
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show()
                App.shared.api.uploadInvoiceSignature(image, imageName: "\(self.item.invoice_number)_\(Date().currentTimeMillis()).jpg", params: params) { (success, error) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.dismiss()
                    guard error == nil else {
                        return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                    }
                    
                    // submit
                    self.sendInvoice()
                }
            }
            self.navigationController?.pushViewController(vc, animated: true)
        }
    }

}

// MARK: - TableView Datasource -

extension InvoicePreviewController: UITableViewDelegate, UITableViewDataSource {
    
    func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return 5 + items.count
    }
    
    func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 0.0001
    }
    
    func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        return 0.0001
    }
    
    func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        let row = indexPath.row
        let itemCount = items.count-1
        
        // check
        if row == 0 {
            return 72
        } else if row == itemCount + 2 {
            return 67
        } else if row == itemCount + 3 {
            return 90
        } else if row == itemCount + 4 {
            return 90
        } else if row == itemCount + 5 {
            if signatureImage != nil {
                return 180
            }
            return 0
        }
        return 34
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let row = indexPath.row
        let itemCount = items.count-1
        
        // check
        if row == 0 {
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "ItemHeaderCell", for: indexPath)
            return cell
        } else if row == itemCount + 2 {
            // init total
            var grandTotal = 0.00
            
            // sort ungrouped
            let ungrouped = item.items.sorted(by: {$0.id > $1.id})
            // group
            let grouped = ungrouped.group(by: {$0.id})
            // iterate
            for (_, value) in grouped {
                let qty     = value.count
                let price   = value.first?.price.doubleValue ?? 0.00
                let tax     = price * 0.075
                let total   = (price + tax) * qty.doubleValue
                grandTotal += total
            }
            
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "ItemTotalCell", for: indexPath) as! ItemTotalCell
            cell.grandTotal.text = "$\(grandTotal.stringValue)"
            return cell
        } else if row == itemCount + 3 {
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "PaymentCell", for: indexPath)
            return cell
        } else if row == itemCount + 4 {
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "MessageCell", for: indexPath) as! MessageCell
            cell.message.text = item.message_to_customer
            return cell
        } else if row == itemCount + 5 {
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "SignatureCell", for: indexPath) as! SignatureCell
            if let image = signatureImage {
                cell.signature.image     = image
                //cell.signedBy.text       = "signed on \(item.sign_date.toReadableDate) by \(App.shared.company?.business_name ?? "Company Name")"
            }
            return cell
        }
        
        let mItem   = items[row-1]
        let qty     = mItem.count
        let price   = mItem.first?.price.doubleValue ?? 0.00
        let tax     = price * 0.075
        let total   = (price + tax) * qty.doubleValue
        
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "ItemCell", for: indexPath) as! ItemCell
        cell.name.text      = mItem.first?.title
        cell.qty.text       = qty.stringValue
        cell.price.text     = "$\(price.stringValue)"
        cell.discount.text  = "$0.00"
        cell.tax.text       = "$\(tax.stringValue)"
        cell.total.text     = "$\(total.stringValue)"
        return cell
    }
}

// MARK: - MFMailComposeViewControllerDelegate -

extension InvoicePreviewController: MFMailComposeViewControllerDelegate {
    
    func sendInvoice() {
        // init
        let subject = "Invoice from \(App.shared.company!.business_name) Invoice #\(self.item.invoice_number)"
        let recipient = self.item.customer_email
        
        var message = "\(subject)<br><br>"
        message += "Dear \(item.customer_name), <br><br>"
        message += "Please find the attached invoice #\(item.invoice_number) with this email. <br><br>"
        message += "View Invoice Online <br><br>"
        message += "If you have any questions or need more information, feel free to contact us at \(App.shared.company!.business_phone). <br><br>"
        message += "Thanks, <br>\(App.shared.company!.business_name)"
        
        // send email
        if MFMailComposeViewController.canSendMail() {
            let mail = MFMailComposeViewController()
            mail.setToRecipients([recipient])
            mail.setSubject(subject)
            mail.setMessageBody(message, isHTML: true)
            mail.mailComposeDelegate = self
            // add attachment
            if let attachment = self.generatePdfFile()?.dataRepresentation() {
                mail.addAttachmentData(attachment, mimeType: "application/pdf" , fileName: "Estimate #\(item.work_order_number).pdf")
            }
            self.present(mail, animated: true)
        } else {
            Utils.shared.showAlertWithMessage(title: "Error", message: "Sending email failed!")
        }
    }
    
    func mailComposeController(_ controller: MFMailComposeViewController, didFinishWith result: MFMailComposeResult, error: Error?) {
        controller.dismiss(animated: true, completion: nil)
        
        switch result {
            case .cancelled:
                break
            case .sent:
                Utils.shared.showAlertWithMessage(title: "Confirmation", message: "The Invoice has been sent to \(self.item.customer_name) \(self.item.customer_email) successfully.")
                break
            case .failed:
                Utils.shared.showAlertWithMessage(title: "Error", message: "Sending email failed!")
                break
            default:
                break
       }
    }
}

// MARK: - MFMessageComposeViewControllerDelegate -

extension InvoicePreviewController: MFMessageComposeViewControllerDelegate {
    
    func messageComposeViewController(_ controller: MFMessageComposeViewController, didFinishWith result: MessageComposeResult) {
        switch (result) {
            case .cancelled:
                print("Message was cancelled")
                dismiss(animated: true, completion: nil)
            case .failed:
                print("Message failed")
                dismiss(animated: true, completion: nil)
            case .sent:
                print("Message was sent")
                dismiss(animated: true, completion: nil)
            default:
                break
        }
    }
}

// MARK: - Floaty Delegate -

extension InvoicePreviewController: FloatyDelegate {
    
    func initFAB() {
        
        // init
        floaty.fabDelegate  = self
        floaty.sticky       = true
        floaty.buttonColor  = .greenColor
        floaty.buttonImage  = UIImage.fontAwesomeIcon(name: .bars, style: .solid, textColor: .white, size: CGSize(width: 30, height: 30))
        
        // check status
        if item.status == "Draft" {
            // add padding to fab
            floaty.paddingY = 60
            // init fab items
            floaty.addItem("Edit", icon: UIImage.fontAwesomeIcon(name: .edit, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.editInvoice()
            })
            floaty.addItem("Signature", icon: UIImage.fontAwesomeIcon(name: .signature, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.requestSignature()
            })
            floaty.addItem("Convert to Work Order", icon: UIImage.fontAwesomeIcon(name: .userClock, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.convertToWorkOrder()
            })
            self.view.addSubview(floaty)
            
        } else if item.status == "Due" || item.status == "Overdue" {
            // init fab items
            floaty.addItem("Edit", icon: UIImage.fontAwesomeIcon(name: .edit, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.editInvoice()
            })
            floaty.addItem("Clone Invoice", icon: UIImage.fontAwesomeIcon(name: .copy, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.cloneInvoice()
            })
            floaty.addItem("Re-Send", icon: UIImage.fontAwesomeIcon(name: .paperPlane, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.resendInvoice()
            })
            floaty.addItem("Reminder", icon: UIImage.fontAwesomeIcon(name: .envelope, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.reminder()
            })
            floaty.addItem("Convert to Work Order", icon: UIImage.fontAwesomeIcon(name: .userClock, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.convertToWorkOrder()
            })
            
        }  else {
            // init fab items
            floaty.addItem("Clone Invoice", icon: UIImage.fontAwesomeIcon(name: .copy, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.cloneInvoice()
            })
            floaty.addItem("Re-Send", icon: UIImage.fontAwesomeIcon(name: .paperPlane, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.resendInvoice()
            })
            floaty.addItem("Convert to Work Order", icon: UIImage.fontAwesomeIcon(name: .userClock, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                self.convertToWorkOrder()
            })
            self.view.addSubview(floaty)
        }
    }
}
