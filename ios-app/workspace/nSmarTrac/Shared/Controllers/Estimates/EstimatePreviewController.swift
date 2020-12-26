//
//  EstimatePreviewController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 09/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import Floaty
import FontAwesome_swift
import ImagePicker
import MessageUI
import PDFKit
import SVProgressHUD

class EstimatePreviewController: UIViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var homeButtonItem: UIBarButtonItem!
    @IBOutlet var printButtonItem: UIBarButtonItem!
    @IBOutlet var tableView: UITableView!
    @IBOutlet var buttonView: UIView!
    
    @IBOutlet var buttonHeight: NSLayoutConstraint!
    
    @IBOutlet var badgeView: UIImageView!
    @IBOutlet var estimateNumber: UILabel!
    @IBOutlet var estimateDate: UILabel!
    @IBOutlet var expiryDate: UILabel!
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
    
    var item: Estimate = App.shared.selectedEstimate!
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
        NotificationCenter.default.addObserver(self, selector: #selector(editItem(_:)), name: Notifications.willEditEstimate, object: nil)
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
        self.navigationItem.title = "Estimate Preview"
    }
    
    // MARK: - Notification -
    
    @objc func editItem(_ notification: Notification) {
        // check type
        if item.estimate_type == "Standard" {
            // edit item at indexPath
            let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_EditStandardEstimateController") as? EditStandardEstimateController
            viewController?.item = item
            self.navigationController?.pushViewController(viewController!, animated: true)
        } else if item.estimate_type == "Option" {
            // edit item at indexPath
            let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_EditCustomEstimateController") as? EditCustomEstimateController
            viewController?.item = item
            self.navigationController?.pushViewController(viewController!, animated: true)
        }
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
                printInfo.jobName = "Estimate #\(self.item.estimate_number)"
                printInfo.outputType = .general

                let printController = UIPrintInteractionController.shared
                printController.printInfo = printInfo
                printController.showsNumberOfCopies = false
                printController.printingItem = document.dataRepresentation()
                printController.present(animated: true, completionHandler: nil)
            }
        }
    }
    
    @IBAction func signatureButtonTapped(_ sender: Any) {
        if let vc = self.storyboard?.instantiateViewController(withIdentifier: "sb_SignController")  as? SignController {
            vc.callback = { image in
                // add signature
                self.signatureImage = image
                
                // upload signature
                // params
                let params: Parameters = ["company_id": App.shared.companyId,
                                          "estimate_id": self.item.id]
                
                // upload
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show()
                App.shared.api.uploadEstimateSignature(image, imageName: "\(self.item.estimate_number)_\(Date().currentTimeMillis()).jpg", params: params) { (success, error) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.dismiss()
                    guard error == nil else {
                        return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                    }
                    
                    // submit
                    self.submitEstimate()
                }
            }
            self.navigationController?.pushViewController(vc, animated: true)
        }
    }
    
    @IBAction func sendButtonTapped(_ sender: Any) {
        submitEstimate()
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
        estimateNumber.text     = "#" + item.estimate_number
        estimateDate.text       = item.estimate_date
        expiryDate.text         = item.expiry_date
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
            let titleBottom = PdfHelper.addTitle(pageRect: pageRect, title: "ESTIMATE")
            // 7
            let imageBottom = PdfHelper.addImage(pageRect: pageRect, imageTop: titleBottom+40, image: logoImage!)
            // 8
            let estimateNumBottom = PdfHelper.addText(pageRect: pageRect, textTop: titleBottom, text: "# \(item.estimate_number)")
            PdfHelper.drawLine(context.cgContext, pageRect: pageRect, lineTop: estimateNumBottom+5, x2: nil)
            // 9
            let estimateDateBottom = PdfHelper.addText(pageRect: pageRect, textTop: estimateNumBottom+15, text: "Estimate Date:     \(item.estimate_date.toReadableDate)")
            // 10
            _ = PdfHelper.addText(pageRect: pageRect, textTop: estimateDateBottom+10, text: "Expiry Date:     \(item.expiry_date.toReadableDate)")
            // 11
            let fromBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: imageBottom+20, text: "FROM:", textFont: UIFont.robotoBoldFont(ofSize: 18))
            PdfHelper.drawLine(context.cgContext, pageRect: pageRect, lineTop: fromBottom+5, x2: nil)
            // 12
            let companyNameBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: fromBottom, text: "ADi", textFont: UIFont.robotoBoldFont(ofSize: 18))
            let companyLicenseBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: companyNameBottom-20, text: "License: EF, AL, MS")
            let companyAddressBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: companyLicenseBottom-20, text: "6866 Pine Forest Road")
            let companyStateBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: companyAddressBottom-20, text: "Pensacola, FL 32526")
            _ = PdfHelper.addIcon(pageRect: pageRect, xCoor: 30, imageTop: companyStateBottom+10, image: phoneIcon)
            let companyPhoneBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 60, textTop: companyStateBottom-20, text: "Phone: (850) 478-0530")
            // 13
            let toBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: companyPhoneBottom+40, text: "TO:", textFont: UIFont.robotoBoldFont(ofSize: 18))
            PdfHelper.drawLine(context.cgContext, pageRect: pageRect, lineTop: toBottom+5, x2: nil)
            // 14
            let customerAddress = item.customer_address.components(separatedBy: "::")
            let customerNameBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: toBottom, text: item.customer_name, textFont: UIFont.robotoBoldFont(ofSize: 18))
            let customerAddressBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: customerNameBottom-20, text: customerAddress.first!)
            let customerStateBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: customerAddressBottom-20, text: customerAddress.last!)
            _ = PdfHelper.addIcon(pageRect: pageRect, xCoor: 30, imageTop: customerStateBottom+10, image: emailIcon)
            let customerEmailBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 60, textTop: customerStateBottom-20, text: "Email: \(item.customer_email)")
            _ = PdfHelper.addIcon(pageRect: pageRect, xCoor: 30, imageTop: customerEmailBottom+10, image: phoneIcon)
            let customerPhoneBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 60, textTop: customerEmailBottom-20, text: "Phone: \(item.customer_phone)")
            _ = PdfHelper.addIcon(pageRect: pageRect, xCoor: 30, imageTop: customerPhoneBottom+10, image: mobileIcon)
            let customerMobileBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 60, textTop: customerPhoneBottom-20, text: "Mobile: \(item.customer_mobile)")
            //15
            let jobBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: customerMobileBottom+40, text: "JOB DETAILS:", textFont: UIFont.robotoBoldFont(ofSize: 18))
            PdfHelper.drawLine(context.cgContext, pageRect: pageRect, lineTop: jobBottom+5, x2: nil)
            
            var itemTop = jobBottom + 50
            if !item.job_name.isEmpty {
                // 16
                let address = item.job_location.components(separatedBy: ", ")
                let jobNameBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: jobBottom, text: item.job_name)
                let jobAddressBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: jobNameBottom-20, text: address.first!)
                let jobStateBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: jobAddressBottom-20, text: "\(address[1]), \(address[2])")
                
                itemTop = jobStateBottom + 40
            }
            
            // 17
            let grandTotalBottom = PdfHelper.drawItems(context.cgContext, pageRect: pageRect, lineTop: itemTop, items: item.items)
            
            // 18
            var depositTop = grandTotalBottom
            if !item.deposit_request.isEmpty {
                let width = (pageRect.width-30)/8
                let depositBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: depositTop, text: "Deposit Due", textFont: UIFont.robotoBoldFont(ofSize: 18))
                _ = PdfHelper.addItemLabel(pageRect: pageRect, xCoor: width*6, width: width*2, textTop: depositTop, text: "$\(item.deposit_request)")
                
                depositTop = depositBottom
            }
            
            // 19
            let methodBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: depositTop+40, text: "Accepted Payment Methods", textFont: UIFont.robotoBoldFont(ofSize: 18))
            PdfHelper.drawLine(context.cgContext, pageRect: pageRect, lineTop: methodBottom+5, x2: nil)
            // 20
            let paymentBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: methodBottom, text: "Credit Card, Check, Cash, Direct Deposit")
            // 21
            let messageBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: paymentBottom+40, text: "Message", textFont: UIFont.robotoBoldFont(ofSize: 18))
            PdfHelper.drawLine(context.cgContext, pageRect: pageRect, lineTop: messageBottom+5, x2: nil)
            // 22
            let messageToCustomerBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: messageBottom, text: item.customer_message)
            
            var termsTop = messageToCustomerBottom
            if !item.terms_conditions.isEmpty {
                // 23
                let termsBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: messageToCustomerBottom+40, text: "Terms", textFont: UIFont.robotoBoldFont(ofSize: 18))
                PdfHelper.drawLine(context.cgContext, pageRect: pageRect, lineTop: termsBottom+5, x2: nil)
                // 24
                let tocBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: termsBottom, text: item.terms_conditions)
                
                termsTop = tocBottom
            }
            
            // 25
            if let image = signatureImage {
                // add signature
                let signatureBottom = PdfHelper.addSignature(pageRect: pageRect, imageTop: termsTop+20, image: image)
                PdfHelper.drawLine(context.cgContext, pageRect: pageRect, lineTop: signatureBottom+5, x2: row2)
                
                let signedBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: signatureBottom, text: "signed on \(item.sign_date.toReadableDate)")
                _ = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: signedBottom-10, text: "by \(App.shared.company?.business_name ?? "Company Name")")
            }
            
        }
        
        // return
        return PDFDocument(data: data)
    }
    
    func submitEstimate() {
        // mark as submitted
        let params = ["Status": "Submitted"]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show()
        App.shared.api.putEstimate(self.item.id.intValue, params: params) { (success, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard success == true else {
                return SVProgressHUD.showError(withStatus: "Saving data failed!")
            }
            
            self.sendEstimate()
        }
    }
    
    func getEstimate() {
        // get item
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show()
        App.shared.api.getEstimate(self.item.id.intValue) { (estimate, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            
            // assign
            self.item = estimate!
            
            // reinit views
            self.initViews()
            // reinit fab
            self.floaty.removeFromSuperview()
            self.floaty = Floaty()
            self.initFAB()
            // hide buttons
            self.buttonView.isHidden = true
            self.buttonHeight.constant = 0.0
        }
    }

}

// MARK: - TableView Datasource -

extension EstimatePreviewController: UITableViewDelegate, UITableViewDataSource {
    
    func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return 6 + items.count
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
            if item.terms_conditions.isEmpty {
                return 0
            }
            return 130
        } else if row == itemCount + 6 {
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
            cell.message.text = item.customer_message
            return cell
        } else if row == itemCount + 5 {
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "TermCell", for: indexPath) as! TermCell
            cell.term.text = item.terms_conditions
            return cell
        } else if row == itemCount + 6 {
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "SignatureCell", for: indexPath) as! SignatureCell
            if let image = signatureImage {
                cell.signature.image     = image
                cell.signedBy.text       = "signed on \(item.sign_date.toReadableDate) by \(App.shared.company?.business_name ?? "Company Name")"
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

// MARK: - TableView Cell -

class ItemCell: UITableViewCell {
    @IBOutlet var name: UILabel!
    @IBOutlet var qty: UILabel!
    @IBOutlet var price: UILabel!
    @IBOutlet var discount: UILabel!
    @IBOutlet var tax: UILabel!
    @IBOutlet var total: UILabel!
}

class ItemTotalCell: UITableViewCell {
    @IBOutlet var grandTotal: UILabel!
    @IBOutlet var paymentSchedule: UILabel!
}

class MessageCell: UITableViewCell {
    @IBOutlet var message: UILabel!
}

class SignatureCell: UITableViewCell {
    @IBOutlet var signature: UIImageView!
    @IBOutlet var signedBy: UILabel!
}

class TermCell: UITableViewCell {
    @IBOutlet var term: UITextView!
}

// MARK: - MFMailComposeViewControllerDelegate -

extension EstimatePreviewController: MFMailComposeViewControllerDelegate {
    
    func sendEstimate() {
        // init
        let subject = "Estimate from \(App.shared.company!.business_name) Estimate #\(self.item.estimate_number)"
        let recipient = self.item.customer_email
        
        var message = "\(subject)<br><br>"
        message += "Dear \(item.customer_name), <br><br>"
        message += "Please find the attached estimate #\(item.estimate_number) with this email. <br><br>"
        message += "View Estimate Online <br><br>"
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
                mail.addAttachmentData(attachment, mimeType: "application/pdf" , fileName: "Estimate #\(item.estimate_number).pdf")
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
                Utils.shared.showAlertWithMessage(title: "Confirmation", message: "The Estimate has been sent to \(self.item.customer_name) \(self.item.customer_email) successfully.")
                break
            case .failed:
                Utils.shared.showAlertWithMessage(title: "Error", message: "Sending email failed!")
                break
            default:
                break
       }
    }
    
    // MARK: - Functions -
}

// MARK: - MFMessageComposeViewControllerDelegate -

extension EstimatePreviewController: MFMessageComposeViewControllerDelegate {
    
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

extension EstimatePreviewController: FloatyDelegate {
    
    func initFAB() {
        
        // init
        floaty.fabDelegate  = self
        floaty.sticky       = true
        floaty.buttonColor  = .greenColor
        floaty.buttonImage  = UIImage.fontAwesomeIcon(name: .bars, style: .solid, textColor: .white, size: CGSize(width: 30, height: 30))
        
        // check status
        if item.status == "Draft" {
            // add padding to fab
            floaty.paddingY = (item.status == "Draft") ? 60 : 0
            // init fab items
            floaty.addItem("Accept", icon: UIImage.fontAwesomeIcon(name: .check, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                
                // create an alert
                let alertController = UIAlertController(title: "Accept Estimate", message: "You are going to mark the Estimate \(self.item.estimate_number) as Accepted, would you like to proceed?", preferredStyle: .alert)
                let yesAction = UIAlertAction(title: "Yes", style: .default) { (alertAction) -> Void in
                    // mark as accepted
                    let params: Parameters = ["Status": "Accepted"]
                    
                    SVProgressHUD.setDefaultMaskType(.clear)
                    SVProgressHUD.show()
                    App.shared.api.putEstimate(self.item.id.intValue, params: params) { (success, error) in
                        SVProgressHUD.setDefaultMaskType(.none)
                        SVProgressHUD.dismiss()
                        guard error == nil else {
                            return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                        }
                        guard success == true else {
                            return SVProgressHUD.showError(withStatus: "Saving data failed!")
                        }
                        
                        // show alert
                        SVProgressHUD.show(withStatus: "Estimate has been accepted!")
                        
                        // reload estimate
                        self.getEstimate()
                    }
                }
                alertController.addAction(yesAction)
                
                let noAction = UIAlertAction(title: "No", style: .cancel) { (alertAction) -> Void in
                    self.dismiss(animated: true, completion: nil)
                }
                alertController.addAction(noAction)
                
                self.present(alertController, animated: true, completion: nil)
            })
            floaty.addItem("Edit", icon: UIImage.fontAwesomeIcon(name: .edit, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                // check type
                if self.item.estimate_type == "Standard" {
                    // edit item at indexPath
                    let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_EditStandardEstimateController") as? EditStandardEstimateController
                    viewController?.item = self.item
                    self.navigationController?.pushViewController(viewController!, animated: true)
                } else if self.item.estimate_type == "Option" {
                    // edit item at indexPath
                    let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_EditCustomEstimateController") as? EditCustomEstimateController
                    viewController?.item = self.item
                    self.navigationController?.pushViewController(viewController!, animated: true)
                }
                self.floaty.close()
            })
            self.view.addSubview(floaty)
            
        } else {
            // hide buttons
            buttonView.isHidden = true
            buttonHeight.constant = 0.0
            
            // init fab items
            floaty.addItem("Edit", icon: UIImage.fontAwesomeIcon(name: .edit, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                // check type
                if self.item.estimate_type == "Standard" {
                    // edit item at indexPath
                    let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_EditStandardEstimateController") as? EditStandardEstimateController
                    viewController?.item = self.item
                    self.navigationController?.pushViewController(viewController!, animated: true)
                } else if self.item.estimate_type == "Option" {
                    // edit item at indexPath
                    let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_EditCustomEstimateController") as? EditCustomEstimateController
                    viewController?.item = self.item
                    self.navigationController?.pushViewController(viewController!, animated: true)
                }
                self.floaty.close()
            })
            floaty.addItem("Cancel", icon: UIImage.fontAwesomeIcon(name: .trashAlt, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                
                // create an alert
                let alertController = UIAlertController(title: "Cancel Estimate?", message: "You are about to cancel your Estimate \(self.item.estimate_number) for job order, would you like to proceed?", preferredStyle: .alert)
                let yesAction = UIAlertAction(title: "Yes", style: .default) { (alertAction) -> Void in
                    // check role
                    if App.shared.user!.role.intValue <= 3 {
                        // delete
                        SVProgressHUD.setDefaultMaskType(.clear)
                        SVProgressHUD.show()
                        App.shared.api.deleteEstimate(self.item.id.intValue) { (success, error) in
                            SVProgressHUD.dismiss()
                            guard error == nil else {
                                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                            }
                            guard success == true else {
                                return SVProgressHUD.showError(withStatus: "Deleting item failed!")
                            }
                            
                            SVProgressHUD.show(withStatus: "Estimate has been deleted!")
                            self.popViewController()
                        }
                    }
                }
                alertController.addAction(yesAction)
                
                let noAction = UIAlertAction(title: "No", style: .cancel) { (alertAction) -> Void in
                    self.dismiss(animated: true, completion: nil)
                }
                alertController.addAction(noAction)
                
                self.present(alertController, animated: true, completion: nil)
                
            })
            floaty.addItem("Re-Send", icon: UIImage.fontAwesomeIcon(name: .paperPlane, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                
                // create an alert
                let alertController = UIAlertController(title: "Re-send Estimate", message: "Re-send Estimate \(self.item.estimate_number) to customer \(self.item.customer_name), would you like to proceed?", preferredStyle: .alert)
                let yesAction = UIAlertAction(title: "Yes", style: .default) { (alertAction) -> Void in
                    self.sendEstimate()
                }
                alertController.addAction(yesAction)
                
                let noAction = UIAlertAction(title: "No", style: .cancel) { (alertAction) -> Void in
                    self.dismiss(animated: true, completion: nil)
                }
                alertController.addAction(noAction)
                
                self.present(alertController, animated: true, completion: nil)
            })
            floaty.addItem("Mark as Lost", icon: UIImage.fontAwesomeIcon(name: .ban, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                
                // create an alert
                let alertController = UIAlertController(title: "Mark Estimate as Lost", message: "Are you sure you want to mark as lost the Estimate \(self.item.estimate_number)?", preferredStyle: .alert)
                let yesAction = UIAlertAction(title: "Yes", style: .default) { (alertAction) -> Void in
                    // mark as lost
                    let params: Parameters = ["Status": "Lost"]
                    
                    SVProgressHUD.setDefaultMaskType(.clear)
                    SVProgressHUD.show()
                    App.shared.api.putEstimate(self.item.id.intValue, params: params) { (success, error) in
                        SVProgressHUD.setDefaultMaskType(.none)
                        SVProgressHUD.dismiss()
                        guard error == nil else {
                            return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                        }
                        guard success == true else {
                            return SVProgressHUD.showError(withStatus: "Saving data failed!")
                        }
                        
                        // show alert
                        SVProgressHUD.show(withStatus: "Estimate has been mark as lost!")
                        
                        // reload estimate
                        self.getEstimate()
                    }
                }
                alertController.addAction(yesAction)
                
                let noAction = UIAlertAction(title: "No", style: .cancel) { (alertAction) -> Void in
                    self.dismiss(animated: true, completion: nil)
                }
                alertController.addAction(noAction)
                
                self.present(alertController, animated: true, completion: nil)
                
            })
            floaty.addItem("Clone Estimate", icon: UIImage.fontAwesomeIcon(name: .copy, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                
                // create an alert
                let alertController = UIAlertController(title: "Clone Estimate", message: "You are going to create a new estimate based on Estimate \(self.item.estimate_number). The new estimate will contain the same items (e.g. materials, labour) and you will be able to edit and remove estimate items as you need. Would you like to proceed?", preferredStyle: .alert)
                let yesAction = UIAlertAction(title: "Yes", style: .default) { (alertAction) -> Void in
                    // get estimate number
                    App.shared.api.getEstimateSetting() { (data, error) in
                        if let e = error {
                            return print(e.localizedDescription)
                        }
                        
                        let estimateNumber = "\(data?.estimate_num_prefix ?? "")\(data?.estimate_num_next.format5DigitNumber ?? "")"
                        
                        // clone
                        let params: Parameters = ["company_id": App.shared.companyId,
                                                  "estimate_number": estimateNumber,
                                                  "estimate_type": self.item.estimate_type,
                                                  "customer_id": self.item.customer_id,
                                                  "job_location": self.item.job_location,
                                                  "job_name": self.item.job_name,
                                                  "estimate_date": self.item.estimate_date,
                                                  "expiry_date": self.item.expiry_date,
                                                  "purchase_order_number": self.item.purchase_order_number,
                                                  "deposit_request": self.item.deposit_request,
                                                  "status": self.item.status,
                                                  "estimate_value": self.item.estimate_value,
                                                  "customer_message": self.item.customer_message,
                                                  "terms_conditions": self.item.terms_conditions,
                                                  "instructions": self.item.instructions]
                        
                        SVProgressHUD.setDefaultMaskType(.clear)
                        SVProgressHUD.show()
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
                                    SVProgressHUD.show(withStatus: "Saving...")
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
                                        // check type
                                        /*if self.item.estimate_type == "Standard" {
                                            // edit item at indexPath
                                            let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_EditStandardEstimateController") as? EditStandardEstimateController
                                            viewController?.item = item
                                            self.navigationController?.pushViewController(viewController!, animated: true)
                                        } else if self.item.estimate_type == "Option" {
                                            // edit item at indexPath
                                            let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_EditCustomEstimateController") as? EditCustomEstimateController
                                            viewController?.item = item
                                            self.navigationController?.pushViewController(viewController!, animated: true)
                                        }*/
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
                
            })
            // check
            if item.status != "Accepted" {
                floaty.addItem("Mark as Accepted", icon: UIImage.fontAwesomeIcon(name: .check, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                    self.floaty.close()
                    
                    // create an alert
                    let alertController = UIAlertController(title: "Accept Estimate", message: "You are going to mark the Estimate \(self.item.estimate_number) as Accepted, would you like to proceed?", preferredStyle: .alert)
                    let yesAction = UIAlertAction(title: "Yes", style: .default) { (alertAction) -> Void in
                        // mark as accepted
                        let params: Parameters = ["status": "Accepted",
                                                  "is_accepted": 1,
                                                  "accepted_date": App.shared.dateFormatter.string(from: Date())]
                        
                        SVProgressHUD.setDefaultMaskType(.clear)
                        SVProgressHUD.show()
                        App.shared.api.putEstimate(self.item.id.intValue, params: params) { (success, error) in
                            SVProgressHUD.setDefaultMaskType(.none)
                            SVProgressHUD.dismiss()
                            guard error == nil else {
                                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                            }
                            guard success == true else {
                                return SVProgressHUD.showError(withStatus: "Saving data failed!")
                            }
                            
                            // show alert
                            SVProgressHUD.show(withStatus: "Estimate has been accepted!")
                            
                            // reload estimate
                            self.getEstimate()
                        }
                    }
                    alertController.addAction(yesAction)
                    
                    let noAction = UIAlertAction(title: "No", style: .cancel) { (alertAction) -> Void in
                        self.dismiss(animated: true, completion: nil)
                    }
                    alertController.addAction(noAction)
                    
                    self.present(alertController, animated: true, completion: nil)
                })
            }
            
            floaty.addItem("Convert to Invoice", icon: UIImage.fontAwesomeIcon(name: .fileInvoiceDollar, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                
                // create an alert
                let alertController = UIAlertController(title: "Convert Estimate to Invoice", message: "You are going to create a new invoice based on Estimate \(self.item.estimate_number). Would you like to proceed?", preferredStyle: .alert)
                let yesAction = UIAlertAction(title: "Yes", style: .default) { (alertAction) -> Void in
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
                                                   "work_order_number": "",
                                                   "po_number": self.item.purchase_order_number,
                                                   "invoice_number": invoiceNumber,
                                                   "date_issued": App.shared.dateFormatter.string(from: Date()),
                                                   "due_date": App.shared.dateFormatter.string(from: Date()),
                                                   "status": "Draft",
                                                   "total_due": self.item.estimate_value,
                                                   "balance": "",
                                                   "deposit_request": self.item.deposit_request,
                                                   "accept_credit_card": data?.accept_credit_card ?? 1,
                                                   "accept_check": data?.accept_check ?? 1,
                                                   "accept_cash": data?.accept_cash ?? 1,
                                                   "accept_direct_deposit": data?.accept_direct_deposit ?? 1,
                                                   "accept_credit": data?.accept_credit ?? 1,
                                                   "message_to_customer": self.item.customer_message,
                                                   "terms_and_conditions": self.item.terms_conditions]
                        
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
                
            })
            floaty.addItem("Convert to Work Order", icon: UIImage.fontAwesomeIcon(name: .userClock, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                
                // create an alert
                let alertController = UIAlertController(title: "Convert Estimate to Work Order", message: "You are going to create a new work order based on Estimate \(self.item.estimate_number). Would you like to proceed?", preferredStyle: .alert)
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
                                                     "job_name": "Job for Estimate \(self.item.estimate_number)",
                                                     "job_description": "Estimate \(self.item.estimate_number)",
                                                     "status": "Scheduled",
                                                     "priority": "Standard",
                                                     "po_number": self.item.purchase_order_number,
                                                     "instructions": self.item.instructions]
                        
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
                                    SVProgressHUD.setDefaultMaskType(.clear)
                                    SVProgressHUD.show()
                                    App.shared.api.getWorkOrder(id.intValue, completion: { (item, error) in
                                        SVProgressHUD.setDefaultMaskType(.none)
                                        SVProgressHUD.dismiss()
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
                
            })
            // add if accepted
            if item.status == "Accepted" {
                floaty.addItem("Schedule Appointment", icon: UIImage.fontAwesomeIcon(name: .calendarPlus, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                    self.floaty.close()
                    
                    // get customer first
                    SVProgressHUD.setDefaultMaskType(.clear)
                    SVProgressHUD.show()
                    App.shared.api.getCustomer(self.item.customer_id.intValue) { (customer, error) in
                        SVProgressHUD.setDefaultMaskType(.none)
                        SVProgressHUD.dismiss()
                        guard error == nil else {
                            return print(error?.localizedDescription ?? "")
                        }
                        
                        // go to create event screen
                        let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_AddEventController") as? AddEventController
                        viewController?.selectedCustomer = customer
                        self.navigationController?.pushViewController(viewController!, animated: true)
                    }
                })
            }
            self.view.addSubview(floaty)
        }
    }
}
