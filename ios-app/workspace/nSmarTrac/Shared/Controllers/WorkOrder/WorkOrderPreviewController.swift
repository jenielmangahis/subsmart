//
//  WorkOrderPreviewController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 21/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import FontAwesome_swift
import MessageUI
import PDFKit

class WorkOrderPreviewController: UIViewController {
    
    // MARK: - Properties -

    static let shared = WorkOrderPreviewController()
    
    @IBOutlet var tableView: UITableView!
    
    @IBOutlet var badgeView: UIImageView!
    @IBOutlet var header: UILabel!
    @IBOutlet var workOrderNumber: UILabel!
    @IBOutlet var dateIssued: UILabel!
    @IBOutlet var workOrderType: UILabel!
    @IBOutlet var priority: UILabel!
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
    
    var item: WorkOrder = App.shared.selectedWorkOrder!
    var items: [[Item]] = []
    var companyRepSignature: UIImage?
    var primaryAccountHolder: UIImage?
    var secondaryAccountHolder: UIImage?
    var logoImage: UIImage?
    
    var agreement = ""
    var termsAndConditions = ""
    var termsOfUse = ""
    
    
    // MARK: - Lifecycle -
    
    override func viewDidLoad() {
        super.viewDidLoad()
        downloadSignatureImage()
        initViews()
        
        // set title
        self.parent?.navigationItem.title = "#\(item.work_order_number)"
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Actions -
    
    @IBAction func shareButtonTapped(_ sender: Any) {
        self.sendWorkOrder()
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
        if !item.company_representative_signature.isEmpty {
            // download image
            App.shared.api.downloadImage(item.company_representative_signature, completion: { image in
                self.companyRepSignature = image
                self.initViews()
            })
        }
        
        // check
        if !item.primary_account_holder_signature.isEmpty {
            // download image
            App.shared.api.downloadImage(item.primary_account_holder_signature, completion: { image in
                self.primaryAccountHolder = image
                self.initViews()
            })
        }
        
        // check
        if !item.secondary_account_holder_signature.isEmpty {
            // download image
            App.shared.api.downloadImage(item.secondary_account_holder_signature, completion: { image in
                self.secondaryAccountHolder = image
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
        
        // header
        self.agreement = item.header.isEmpty ? "This workorder agreement (the “agreement “) is made as of \(App.shared.dateFormatter.string(from: Date())), by and between \(App.shared.company!.business_name), (the \"Company\") and the (\"Customer\") as the address shown below (the \"Premise/Monitored Location\")." : item.header
        
        // terms and conditions
        self.termsAndConditions = item.terms_and_conditions.isEmpty ? "2. Install of the system. Company agrees to schedule and install an alarm system and/or devices in connection with a Monitoring Agreement which customer will receive at the time of installation. Customer hereby agrees to buy the system/devices described below and incorporated herein for all purposes by this reference (the “System /Services”), in accordance with the terms and conditions set forth. IF CUSTOMER FAIL TO FULLFILL THE MONITORING AGREEMENT, Customer agrees to pay the consultation fee, the cost of the system and recovering fees.\n\n3. Customer agrees to have system maintained for an initial term of 60 months at the above monthly rate in exchange for a reduced cost of the system. Upon the execution of this agreement shall automatically start the billing process. Customer understands that the monthly payments must be paid through “Direct Billing” through their banking institution or credit card. Customers acknowledge that they authorize Company to obtain a Security System. Residential Clients: CUSTOMER HAS THE RIGHT TO CANCEL THIS TRANSACTION at any time prior to midnight on the 3rd business day after the above date of this work order in writing. Customer agrees that no verbal method is valid, and must be submitted only in writing. The date on this agreement is the agreed upon date for both the Company and the Customer\n\n4. Client verifies that they are owners of the property listed above. In the event the system has to be removed, Client agrees and understands that there will be an additional $299.00 restocking/removal fee and early termination fees will apply.\n\n5. Client understands that this is a new Monitoring Agreement through our central station. Alarm.com or .net is not affiliated nor has any bearing on the current monitoring services currently or previously initiated by Client with other alarm companies. By signing this work order, Client agrees and understands that they have read the above requirements and would like to take advantage of our services. Client understand that is a binding agreement for both party.\n\n6. Customer agrees that the system is preprogramed for each specific location. accordance with the terms and conditions set forth. IF CUSTOMER FAIL TO FULLFILL THE MONITORING AGREEMENT, Customer agrees to pay the consultation fee, the cost of the system and recovering fees. Customer agrees that this is a customized order. By signing this workorder, customer agrees that customized order can not be cancelled after three day of this signed document." : item.terms_and_conditions
        
        // terms of use
        self.termsOfUse = item.terms_of_use.isEmpty ? "**This isn\'t everything... just a summary** You may CANCEL this transaction, within THREE BUSINESS DAYS from the above date. If You cancel, You must make available to US in substantially as good condition as when received, any goods delivered to You under this contract or sale, You may, if You wish, comply with Our instructions regarding the return shipment of the goods at Your expense and risk. To cancel this transaction, mail deliver a signed and postmarket, dated copy of this Notice of Cancellation or any other written notice to ALarm Direct, Inc., 6866 Pine Forest Road, Suite B, Pensacola, FL 32526. NOT LATER THAN MIDNIGHT OF {Date plus 3 business days}" : item.terms_of_use
        
        // 1
        header.text             = self.agreement
        workOrderNumber.text    = "#" + item.work_order_number
        dateIssued.text         = item.date_issued
        workOrderType.text      = item.job_type
        priority.text           = item.priority
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
            self.containerView.addSubview(pdfView)
            pdfView.document = pdfDocument
        }
    }*/
    
    public func generatePdfFile() -> PDFDocument? {
        // header
        let agreement = item.header.isEmpty ? "This workorder agreement (the “agreement “) is made as of \(App.shared.dateFormatter.string(from: Date())), by and between \(App.shared.company!.business_name), (the \"Company\") and the (\"Customer\") as the address shown below (the \"Premise/Monitored Location\")." : item.header
        
        // terms and conditions
        let termsAndConditions = item.terms_and_conditions.isEmpty ? "2. Install of the system. Company agrees to schedule and install an alarm system and/or devices in connection with a Monitoring Agreement which customer will receive at the time of installation. Customer hereby agrees to buy the system/devices described below and incorporated herein for all purposes by this reference (the “System /Services”), in accordance with the terms and conditions set forth. IF CUSTOMER FAIL TO FULLFILL THE MONITORING AGREEMENT, Customer agrees to pay the consultation fee, the cost of the system and recovering fees.\n\n3. Customer agrees to have system maintained for an initial term of 60 months at the above monthly rate in exchange for a reduced cost of the system. Upon the execution of this agreement shall automatically start the billing process. Customer understands that the monthly payments must be paid through “Direct Billing” through their banking institution or credit card. Customers acknowledge that they authorize Company to obtain a Security System. Residential Clients: CUSTOMER HAS THE RIGHT TO CANCEL THIS TRANSACTION at any time prior to midnight on the 3rd business day after the above date of this work order in writing. Customer agrees that no verbal method is valid, and must be submitted only in writing. The date on this agreement is the agreed upon date for both the Company and the Customer\n\n4. Client verifies that they are owners of the property listed above. In the event the system has to be removed, Client agrees and understands that there will be an additional $299.00 restocking/removal fee and early termination fees will apply.\n\n5. Client understands that this is a new Monitoring Agreement through our central station. Alarm.com or .net is not affiliated nor has any bearing on the current monitoring services currently or previously initiated by Client with other alarm companies. By signing this work order, Client agrees and understands that they have read the above requirements and would like to take advantage of our services. Client understand that is a binding agreement for both party.\n\n6. Customer agrees that the system is preprogramed for each specific location. accordance with the terms and conditions set forth. IF CUSTOMER FAIL TO FULLFILL THE MONITORING AGREEMENT, Customer agrees to pay the consultation fee, the cost of the system and recovering fees. Customer agrees that this is a customized order. By signing this workorder, customer agrees that customized order can not be cancelled after three day of this signed document." : item.terms_and_conditions
        
        // terms of use
        let termsOfUse = item.terms_of_use.isEmpty ? "**This isn\'t everything... just a summary** You may CANCEL this transaction, within THREE BUSINESS DAYS from the above date. If You cancel, You must make available to US in substantially as good condition as when received, any goods delivered to You under this contract or sale, You may, if You wish, comply with Our instructions regarding the return shipment of the goods at Your expense and risk. To cancel this transaction, mail deliver a signed and postmarket, dated copy of this Notice of Cancellation or any other written notice to ALarm Direct, Inc., 6866 Pine Forest Road, Suite B, Pensacola, FL 32526. NOT LATER THAN MIDNIGHT OF {Date plus 3 business days}" : item.terms_of_use
        
        // 1
        let pdfMetaData = [
          kCGPDFContextCreator: "nSmarTrac",
          kCGPDFContextAuthor: "nsmartrac.com"
        ]
        let format = UIGraphicsPDFRendererFormat()
        format.documentInfo = pdfMetaData as [String: Any]

        // 2
        let pageWidth = 8.5 * 72.0
        let pageHeight = 50 * 72.0
        let pageRect = CGRect(x: 0, y: 0, width: pageWidth, height: pageHeight)
        let row = CGFloat(pageWidth/3)
        let row2 = CGFloat(pageWidth/2)

        // 3
        let renderer = UIGraphicsPDFRenderer(bounds: pageRect, format: format)
        
        // 4
        let data = renderer.pdfData { (context) in
            // icons
            let phoneIcon = UIImage.fontAwesomeIcon(name: .phone, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 22, height: 22))
            // logo
            if let logo = UserDefaults.standard.imageForKey(key: App.shared.logoKey) {
                logoImage = logo
            }
            
            var startDate = item.start_date.getDay + ", " + item.start_date.toReadableDate
            // check start and end date
            if item.start_date == item.end_date {
                startDate += ", " + item.start_time + " - " + item.end_time
            } else {
                startDate += ", " + item.start_time + " - " + item.end_date.getDay + ", " + item.end_date.toReadableDate  + ", " + item.end_time
            }
            
            // 5
            context.beginPage()
            // 6
            let headerBottom = PdfHelper.addBodyText(pageRect: pageRect, textTop: 6, text: agreement, height: 80)
            // 7
            let titleBottom = PdfHelper.addTitle(pageRect: pageRect, title: "WORK ORDER", textTop: headerBottom)
            // 8
            let imageBottom = PdfHelper.addImage(pageRect: pageRect, imageTop: titleBottom+40, image: logoImage!)
            // 9
            let woNumBottom = PdfHelper.addText(pageRect: pageRect, textTop: titleBottom, text: "# \(item.work_order_number)")
            PdfHelper.drawLine(context.cgContext, pageRect: pageRect, lineTop: woNumBottom+5, x2: nil)
            // 10
            let woDateBottom = PdfHelper.addText(pageRect: pageRect, xCoor: row, mWidth: row, textTop: woNumBottom+15, text: "Date:")
            _ = PdfHelper.addText(pageRect: pageRect, textTop: woNumBottom+15, text: item.date_issued.toReadableDate)
            // 11
            let woTypeBottom = PdfHelper.addText(pageRect: pageRect, xCoor: row, mWidth: row, textTop: woDateBottom+10, text: "Type:")
            _ = PdfHelper.addText(pageRect: pageRect, textTop: woDateBottom+10, text: item.job_type)
            // 12
            _ = PdfHelper.addText(pageRect: pageRect, xCoor: row, mWidth: row, textTop: woTypeBottom+10, text: "Priority:")
            _ = PdfHelper.addText(pageRect: pageRect, textTop: woTypeBottom+10, text: item.priority)
            // 13
            let fromBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: imageBottom+20, text: "FROM:", textFont: UIFont.robotoBoldFont(ofSize: 18))
            PdfHelper.drawLine(context.cgContext, pageRect: pageRect, lineTop: fromBottom+5, x2: nil)
            // 14
            let companyNameBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: fromBottom, text: "ADi", textFont: UIFont.robotoBoldFont(ofSize: 18))
            let companyLicenseBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: companyNameBottom-20, text: "License: EF, AL, MS")
            let companyAddressBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: companyLicenseBottom-20, text: "6866 Pine Forest Road")
            let companyStateBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: companyAddressBottom-20, text: "Pensacola, FL 32526")
            _ = PdfHelper.addIcon(pageRect: pageRect, xCoor: 30, imageTop: companyStateBottom+10, image: phoneIcon)
            let companyPhoneBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 60, textTop: companyStateBottom-20, text: "Phone: (850) 478-0530")
            // 15
            let customerBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: companyPhoneBottom+40, text: "CUSTOMER:", textFont: UIFont.robotoBoldFont(ofSize: 18))
            PdfHelper.drawLine(context.cgContext, pageRect: pageRect, lineTop: customerBottom+5, x2: nil)
            // 16
            let customerNameBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: customerBottom, text: item.customer_name, textFont: UIFont.robotoBoldFont(ofSize: 18))
            let customerAddressBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: customerNameBottom-20, text: item.job_location)
            // 17
            let tocLabelBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: customerAddressBottom+40, text: "TERMS & CONDITIONS", textFont: UIFont.robotoBoldFont(ofSize: 18))
            PdfHelper.drawLine(context.cgContext, pageRect: pageRect, lineTop: tocLabelBottom+5, x2: nil)
            let tocBottom = PdfHelper.addBodyText(pageRect: pageRect, textTop: tocLabelBottom, text: termsAndConditions, height: 960)
            // 18
            let jobBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: tocBottom+40, text: "JOB DETAILS", textFont: UIFont.robotoBoldFont(ofSize: 18))
            PdfHelper.drawLine(context.cgContext, pageRect: pageRect, lineTop: jobBottom+5, x2: nil)
            // 19
            let jobNameBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: jobBottom, text: item.job_name)
            // 20
            let grandTotalBottom = PdfHelper.drawItems(context.cgContext, pageRect: pageRect, lineTop: jobNameBottom+40, items: item.items)
            // 21
            let touLabelBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: grandTotalBottom+40, text: "TERMS OF USE", textFont: UIFont.robotoBoldFont(ofSize: 18))
            PdfHelper.drawLine(context.cgContext, pageRect: pageRect, lineTop: touLabelBottom+5, x2: nil)
            let touBottom = PdfHelper.addBodyText(pageRect: pageRect, textTop: touLabelBottom, text: termsOfUse, height: 220)
            // 22
            let instructionsBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: touBottom+40, text: "Instructions", textFont: UIFont.robotoBoldFont(ofSize: 18))
            PdfHelper.drawLine(context.cgContext, pageRect: pageRect, lineTop: instructionsBottom+5, x2: nil)
            // 23
            let messageBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: instructionsBottom, text: item.instructions)
            // 24
            let assignBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: messageBottom+40, text: "Assigned To", textFont: UIFont.robotoBoldFont(ofSize: 18))
            PdfHelper.drawLine(context.cgContext, pageRect: pageRect, lineTop: assignBottom+5, x2: nil)
            // 25
            let employeeNameBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: assignBottom, text: (item.employee_id.intValue == 0) ? "All Employees" : item.employee_name)
            
            
            var signedBottom: CGFloat = 0
            
            // 26
            if let image = companyRepSignature {
                // add signature
                let beforeBottom = PdfHelper.addSignature(pageRect: pageRect, imageTop: employeeNameBottom+30, image: image)
                PdfHelper.drawLine(context.cgContext, pageRect: pageRect, lineTop: beforeBottom+5, x2: row2-15)
                
                signedBottom = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: beforeBottom, text: "Company Representative - Signed on \(item.company_representative_sign_date.toReadableDate)")
                _ = PdfHelper.addText(pageRect: pageRect, xCoor: 30, textTop: signedBottom-10, text: "by \(item.company_representative_name)")
            }
            
            // 27
            if let image = primaryAccountHolder {
                // add signature
                let afterBottom = PdfHelper.addSignature(pageRect: pageRect, imageTop: employeeNameBottom+34, image: image, xCoor: row2+15)
                PdfHelper.drawLine(context.cgContext, pageRect: pageRect, lineTop: afterBottom+9, x1: row2+15, x2: nil)
                
                _ = PdfHelper.addText(pageRect: pageRect, xCoor: row2+15, textTop: afterBottom+4, text: "Primary Account Holder - Signed on \(item.primary_account_holder_sign_date.toReadableDate)")
                _ = PdfHelper.addText(pageRect: pageRect, xCoor: row2+15, textTop: signedBottom-10, text: "by \(item.primary_account_holder_name)")
            }
            
            // 28
            if let image = secondaryAccountHolder {
                // add signature
                let ownerBottom = PdfHelper.addSignature(pageRect: pageRect, imageTop: signedBottom+80, image: image, xCoor: row2+15)
                PdfHelper.drawLine(context.cgContext, pageRect: pageRect, lineTop: ownerBottom+5, x1: row2+15, x2: nil)
                
                signedBottom = PdfHelper.addText(pageRect: pageRect, xCoor: row2+15, textTop: ownerBottom, text: "Secondary Account Holder - Signed on \(item.secondary_account_holder_sign_date.toReadableDate)")
                _ = PdfHelper.addText(pageRect: pageRect, xCoor: row2+15, textTop: signedBottom-10, text: "by \(item.secondary_account_holder_name)")
            }
            
        }
        
        // return
        return PDFDocument(data: data)
    }

}

// MARK: - TableView Datasource -

extension WorkOrderPreviewController: UITableViewDelegate, UITableViewDataSource {
    
    func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return 7 + items.count
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
            return 140
        } else if row == 1 {
            return 72
        } else if row == itemCount + 3 {
            return 67
        } else if row == itemCount + 4 {
            return 140
        } else if row == itemCount + 5 {
            return 90
        } else if row == itemCount + 6 {
            return 90
        } else if row == itemCount + 7 {
            if companyRepSignature != nil || primaryAccountHolder != nil || secondaryAccountHolder != nil {
                return 330
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
            let cell = tableView.dequeueReusableCell(withIdentifier: "TermsCell", for: indexPath) as! TermsCell
            cell.label.text = "Terms &  Conditions"
            cell.terms.text = termsAndConditions
            return cell
        } else if row == 1 {
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "ItemHeaderCell", for: indexPath)
            return cell
        } else if row == itemCount + 3 {
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
        } else if row == itemCount + 4 {
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "TermsCell", for: indexPath) as! TermsCell
            cell.label.text = "Terms of Use"
            cell.terms.text = termsOfUse
            return cell
        } else if row == itemCount + 5 {
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "InstructionCell", for: indexPath) as! InstructionCell
            cell.message.text = item.instructions
            return cell
        } else if row == itemCount + 6 {
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "AssignedCell", for: indexPath) as! AssignedCell
            cell.employee.text = item.employee_name
            return cell
        } else if row == itemCount + 7 {
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "SignatureCell", for: indexPath) as! Signature2Cell
            if let image = companyRepSignature {
                cell.beforeSignature.image  = image
                cell.beforeSignedBy.text    = "Company Representative - Signed on \(item.company_representative_sign_date.toReadableDate) by \(item.company_representative_name)"
            }
            if let image = primaryAccountHolder {
                cell.afterSignature.image   = image
                cell.afterSignedBy.text     = "Primary Account Holder - Signed on \(item.primary_account_holder_sign_date.toReadableDate) by \(item.primary_account_holder_name)"
            }
            if let image = secondaryAccountHolder {
                cell.ownerSignature.image   = image
                cell.ownerSignedBy.text     = "Secondary Account - Signed on \(item.secondary_account_holder_sign_date.toReadableDate) by \(item.secondary_account_holder_name)"
            }
            return cell
        }
        
        let mItem   = items[row-2]
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

class TermsCell: UITableViewCell {
    @IBOutlet var label: UILabel!
    @IBOutlet var terms: UITextView!
}

class InstructionCell: UITableViewCell {
    @IBOutlet var message: UILabel!
}

class AssignedCell: UITableViewCell {
    @IBOutlet var employee: UILabel!
}

class Signature2Cell: UITableViewCell {
    @IBOutlet var beforeSignature: UIImageView!
    @IBOutlet var beforeSignedBy: UILabel!
    @IBOutlet var afterSignature: UIImageView!
    @IBOutlet var afterSignedBy: UILabel!
    @IBOutlet var ownerSignature: UIImageView!
    @IBOutlet var ownerSignedBy: UILabel!
}

// MARK: - MFMailComposeViewControllerDelegate -

extension WorkOrderPreviewController: MFMailComposeViewControllerDelegate {
    
    func sendWorkOrder() {
        // init
        let subject = "Work Order from \(App.shared.company!.business_name) Work Order #\(self.item.work_order_number)"
        let recipient = self.item.customer_email
        
        var message = "\(subject)<br><br>"
        message += "Dear \(item.customer_name), <br><br>"
        message += "Please find the attached work order #\(item.work_order_number) with this email. <br><br>"
        message += "View Work Order Online <br><br>"
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
                Utils.shared.showAlertWithMessage(title: "Confirmation", message: "The Work Order has been sent to \(self.item.customer_name) \(self.item.customer_email) successfully.")
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

extension WorkOrderPreviewController: MFMessageComposeViewControllerDelegate {
    
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
