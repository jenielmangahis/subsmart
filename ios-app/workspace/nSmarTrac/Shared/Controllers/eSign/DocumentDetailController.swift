//
//  DocumentDetailController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 18/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import FontAwesome_swift
import PDFKit
import SVProgressHUD

class DocumentDetailController: UITableViewController {

    // MARK: - Properties -
    
    @IBOutlet var nextButtonItem: UIBarButtonItem!
    
    var item: ESign!
    
    var dateFormatter: DateFormatter = {
        let formatter = DateFormatter()
        formatter.dateFormat = "MMM dd, yyyy at hh:mm a"
        return formatter
    }()
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
                
        self.title = "Details"
        
        // check
        if item.status == "Draft" {
            nextButtonItem.title = "Resume"
        } else if item.status == "Action Required" {
            nextButtonItem.title = "Sign"
        } else if item.status == "Completed" {
            nextButtonItem.title = "Share"
        } else if item.status == "Waiting for Others" {
            nextButtonItem.title = "Remind"
        } else {
            nextButtonItem.title = "Delete"
        }
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }

    // MARK: - TableView Datasource -
    
    override func numberOfSections(in tableView: UITableView) -> Int {
        return 3
    }
    
    override func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        // check
        if section == 0 {
            if item.status == "Cancelled" {
                return 2
            }
            return 1
        } else if section == 1 && !item.message.isEmpty {
            return 1
        }
        return item.recipients.count
    }
    
    override func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        let section = indexPath.section
        let row = indexPath.row
        
        // check
        if section == 0 {
            if row == 0 {
                return 100
            } else if item.status == "Cancelled" && row == 1 {
                return 59
            }
            return 0
        } else if section == 1 {
            if !item.message.isEmpty {
                return 44
            }
            return 0
        }
        return 80
    }
    
    override func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        // check
        if section == 0 {
            return 0.0001
        } else if section == 1 {
            if !item.message.isEmpty {
                return 30
            }
            return 0.0001
        }
        return 30
    }
    
    override func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        return 0.0001
    }
    
    override func tableView(_ tableView: UITableView, titleForHeaderInSection section: Int) -> String? {
        // check
        if section == 2 {
            return "Recipients"
        } else if section == 1 {
            if !item.message.isEmpty {
                return "Message"
            }
            return nil
        }
        return nil
    }
    
    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let section = indexPath.section
        let row = indexPath.row
        
        // check
        if section == 0 {
            if row == 0 {
                // Configure the cell...
                let cell = tableView.dequeueReusableCell(withIdentifier: "DetailCell", for: indexPath) as! DetailCell
                cell.documentName.text = (item.status == "Action Required") ? "Please eSign: \(item.name)" : item.name
                cell.sender.text = "Sender: \(item.full_name)"
                
                // get date
                if let date = Date(fromString: item.created_at, format: DateHelper.dateTimeFormatType) {
                    // check status
                    if item.status == "Draft" {
                        cell.date.text = "Created at: \(dateFormatter.string(from: date))"
                    } else {
                        cell.date.text = "Received at: \(dateFormatter.string(from: date))"
                    }
                }
                
                return cell
            } else if item.status == "Cancelled" && row == 1 {
                // Configure the cell...
                let cell = tableView.dequeueReusableCell(withIdentifier: "ReasonCell", for: indexPath) as! ReasonCell
                cell.reason.text = "Reason: \(item.reason)"
                return cell
            }
        } else if section == 1 && !item.message.isEmpty {
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "MessageCell", for: indexPath)
            cell.textLabel?.text = item.message
            return cell
        }
        
        // get data
        let data = item.recipients[indexPath.row]
        
        // get initials
        var initials = ""
        let name = data.name.components(separatedBy: " ")
        if let firstLetter = name.first?.first,
           let secondLetter = name.last?.first {
            initials = "\(firstLetter)\(secondLetter)"
        }
        
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath) as! SignerCell
        cell.thumbnail.backgroundColor  = .white
        cell.thumbnail.borderColor      = UIColor(hex: data.color)
        cell.thumbnail.borderWidth      = 2
        cell.thumbnail.text             = initials.uppercased()
        cell.name.text                  = data.name
        cell.email.text                 = data.email
        cell.action.text                = data.role
        
        // check role
        if data.role == "Signs in Person" {
            // get host name and email
            cell.email.text = "Hosted By: \(data.host_name)"
        }
        
        return cell
    }
    
    // MARK: - Actions -
    
    @IBAction func moreButtonTapped(_ sender: Any) {
        // create actionSheet
        let actionSheet = UIAlertController(title: nil, message: nil, preferredStyle: .actionSheet)
        // add action
        actionSheet.addAction(UIAlertAction(title: "Preview", style: .default) { action -> Void in
            // go to preview screen
            let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_PreviewController") as? PreviewController
            viewController?.item = self.item
            let navController = UINavigationController(rootViewController: viewController!)
            navController.modalPresentationStyle = .formSheet
            self.present(navController, animated: true, completion: nil)
        })
        actionSheet.addAction(UIAlertAction(title: "Void", style: .destructive)  { action -> Void in
            // params
            let params: Parameters = ["status": "Cancelled"]
            
            // update esign status to Cancelled
            SVProgressHUD.setDefaultMaskType(.clear)
            SVProgressHUD.show()
            App.shared.api.putESign(self.item.id.intValue, params: params) { (result, error) in
                SVProgressHUD.setDefaultMaskType(.none)
                SVProgressHUD.dismiss()
                guard error == nil else {
                    return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                }
                
                self.popToRootController()
            }
        })
        // add cancel
        actionSheet.addAction(UIAlertAction(title: "Cancel", style: .cancel)  { action -> Void in
            actionSheet.dismiss(animated: true, completion: nil)
        })
        // present actionSheet
        self.present(actionSheet, animated: true, completion: nil)
    }
    
    @IBAction func nextButtonTapped(_ sender: Any) {
        // check
        if item.status == "Draft" {
            // go to documents screen
            let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_ScannedDocumentController") as? ScannedDocumentController
            viewController?.item = self.item
            self.navigationController?.pushViewController(viewController!, animated: true)
            
        } else if item.status == "Action Required" {
            SVProgressHUD.show()
            DispatchQueue.global(qos: .background).async {
                // init documents
                var documents: [PDFDocument] = []
                // create group
                let group = DispatchGroup()
                
                // get documents
                for file in self.item.files {
                    // enter group
                    group.enter()
                    
                    // create a PDFDocument
                    if let document = PdfHelper.createPdfDocument(forURL: file.path) {
                        // append
                        documents.append(document)
                        
                        // leave group
                        group.leave()
                    }
                }
                
                // notify group
                group.notify(queue: DispatchQueue.main, execute: {
                    DispatchQueue.main.async {
                        SVProgressHUD.dismiss()
                        
                        if self.item.type == "Single" {
                            // go to sign page
                            let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_SignMeController") as? SignMeController
                            viewController?.item = self.item
                            viewController?.documents = documents
                            self.navigationController?.pushViewController(viewController!, animated: true)
                        } else {
                            // go to multiple signer screen
                            let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_SignOtherController") as? SignOtherController
                            viewController?.item = self.item
                            viewController?.documents = documents
                            self.navigationController?.pushViewController(viewController!, animated: true)
                        }
                    }
                })
            }
        } else if item.status == "Completed" {
            // share
        } else if item.status == "Waiting for Others" {
            // go to multiple signer screen
            let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_SignOtherController") as? SignOtherController
            viewController?.item = self.item
            self.navigationController?.pushViewController(viewController!, animated: true)
        } else {
            // delete
        }
    }
    
}

// MARK: - Cells -

class DetailCell: UITableViewCell {
    @IBOutlet var documentName: UILabel!
    @IBOutlet var sender: UILabel!
    @IBOutlet var date: UILabel!
}

class ReasonCell: UITableViewCell {
    @IBOutlet var reason: UILabel!
}

class SignerCell: UITableViewCell {
    @IBOutlet var thumbnail: UILabel!
    @IBOutlet var name: UILabel!
    @IBOutlet var email: UILabel!
    @IBOutlet var action: UILabel!
}
