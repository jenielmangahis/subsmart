//
//  ScannedDocumentController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 09/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import FontAwesome_swift
import PDFKit
import SVProgressHUD

class ScannedDocumentController: UIViewController {

    // MARK: - Properties -
    
    @IBOutlet var tableView: UITableView!
    
    var documents: [PDFDocument] = []
    var filenames: [String] = []
    
    var item: ESign?
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        loadData()
        
        self.title = "Documents"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Load data -
    
    func loadData() {
        SVProgressHUD.show()
        DispatchQueue.global(qos: .background).async {
            // create group
            let group = DispatchGroup()
            
            // get documents
            for file in self.item!.files {
                // enter group
                group.enter()
                
                // create a PDFDocument
                if let document = PdfHelper.createPdfDocument(forURL: file.path) {
                    // append
                    self.documents.append(document)
                    self.filenames.append(file.name)
                    
                    // leave group
                    group.leave()
                }
            }
            
            // notify group
            group.notify(queue: DispatchQueue.main, execute: {
                DispatchQueue.main.async {
                    SVProgressHUD.dismiss()
                    // reload table
                    self.tableView.reloadData()
                }
            })
        }
    }
    
    // MARK: - Actions -
    
    @IBAction func moreButtonTapped(_ sender: Any) {
        // create actionSheet
        let actionSheet = UIAlertController(title: nil, message: nil, preferredStyle: .actionSheet)
        // add action
        actionSheet.addAction(UIAlertAction(title: "Save Draft", style: .default) { action -> Void in
            if self.item != nil {
                
            } else {
                self.saveDraft(completion: { _ in
                    self.popToRootController()
                })
            }
        })
        actionSheet.addAction(UIAlertAction(title: "Discard Draft", style: .destructive)  { action -> Void in
            if let item = self.item {
                // show alert
                let alertController = UIAlertController(title: "Discard Envelope", message: "Are you sure you want to delete this envelope?", preferredStyle: .alert)
                let yesAction = UIAlertAction(title: "Discard", style: .default) { (alertAction) -> Void in
                    // delete from database
                    SVProgressHUD.setDefaultMaskType(.clear)
                    SVProgressHUD.show()
                    App.shared.api.deleteESign(item.id.intValue) { (result, error) in
                        SVProgressHUD.setDefaultMaskType(.none)
                        SVProgressHUD.dismiss()
                        guard error == nil else {
                            return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                        }
                        
                        self.popToRootController()
                    }
                }
                alertController.addAction(yesAction)
                
                let noAction = UIAlertAction(title: "Cancel", style: .cancel) { (alertAction) -> Void in
                    self.dismiss(animated: true, completion: nil)
                }
                alertController.addAction(noAction)
                
                self.present(alertController, animated: true, completion: nil)
                
            } else {
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
        if let item = self.item {
            // check
            if item.recipients.count > 0 {
                if item.type == "Single" {
                    // go to signer page
                    let controller = self.storyboard?.instantiateViewController(withIdentifier: "sb_SignMeController")  as? SignMeController
                    controller?.item = item
                    self.navigationController?.pushViewController(controller!, animated: true)
                } else {
                    // go to recipient page
                    let controller = self.storyboard?.instantiateViewController(withIdentifier: "sb_RecipientsController")  as? RecipientsController
                    controller?.item = item
                    self.navigationController?.pushViewController(controller!, animated: true)
                }
            } else {
                // go to signer page
                let controller = self.storyboard?.instantiateViewController(withIdentifier: "sb_SignerController")  as? SignerController
                controller?.item = item
                self.navigationController?.pushViewController(controller!, animated: true)
            }
        } else {
            self.saveDraft(completion: { result in
                // handle nil
                if let item = result {
                    // go to signer page
                    let controller = self.storyboard?.instantiateViewController(withIdentifier: "sb_SignerController")  as? SignerController
                    controller?.item = item
                    self.navigationController?.pushViewController(controller!, animated: true)
                }
            })
        }
    }
    
    // MARK: - Functions -
    
    func saveDraft(completion: @escaping (_ result: ESign?) -> Void) {
        var x = 0
        
        // params
        let params: Parameters = ["name": self.filenames.first!,
                                  "user_id": App.shared.user!.id,
                                  "status": "Draft",
                                  "company_id": App.shared.companyId]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show()
        App.shared.api.postESign(params) { (result, error) in
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
                // create group
                let group = DispatchGroup()
                
                // iterate pdf
                for pdf in self.documents {
                    // enter group
                    group.enter()
                    
                    // params
                    let params: Parameters = ["company_id": App.shared.companyId,
                                              "name": self.filenames[x],
                                              "docfile_id": id]
                    
                    // upload pdf
                    SVProgressHUD.setDefaultMaskType(.clear)
                    SVProgressHUD.show()
                    App.shared.api.uploadESignFile(pdf.dataRepresentation()!, filename: self.filenames[x], params: params) { (result, error) in
                        // increment
                        x+=1
                        
                        SVProgressHUD.setDefaultMaskType(.none)
                        SVProgressHUD.dismiss()
                        guard error == nil else {
                            group.leave()
                            return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                        }
                        
                        // leave group
                        group.leave()
                    }
                }
                
                group.notify(queue: DispatchQueue.main, execute: {
                    // get item
                    SVProgressHUD.setDefaultMaskType(.clear)
                    SVProgressHUD.show()
                    App.shared.api.getESign(id.intValue) { (result, error) in
                        SVProgressHUD.setDefaultMaskType(.none)
                        SVProgressHUD.dismiss()
                        guard error == nil else {
                            return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                        }
                        
                        return completion(result)
                    }
                })
            }
        }
    }

}

// MARK: - TableView Datasource -

extension ScannedDocumentController: UITableViewDelegate, UITableViewDataSource {
    
    func numberOfSections(in tableView: UITableView) -> Int {
        return documents.count + 1
    }
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return 1
    }
    
    func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 10
    }
    
    func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        return 1
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        // get row
        let row = indexPath.section
        // check row
        if documents.count > 0 && row >= 0 && row <= documents.count-1 {
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
            cell.imageView?.image       = UIImage.fontAwesomeIcon(name: .filePdf, style: .regular, textColor: App.shared.iconColor, size: CGSize(width: 30, height: 30))
            cell.textLabel?.text        = filenames[row]
            cell.detailTextLabel?.text  = "\(documents[row].pageCount) Pages"
            
            // add more button
            let moreButton = UIButton(frame: CGRect(x: Device.width-50, y: 15, width: 30, height: 30))
            moreButton.setImage(UIImage.fontAwesomeIcon(name: .ellipsisV, style: .regular, textColor: App.shared.iconColor, size: CGSize(width: 30, height: 30)), for: .normal)
            moreButton.tag = row
            moreButton.addTarget(self, action: #selector(removeFile(_:)), for: .touchUpInside)
            cell.contentView.addSubview(moreButton)
            
            return cell
            
        } else {
            let color: UIColor = (App.shared.appearance == "Dark") ? .lightGray : .darkGray
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "AddCell", for: indexPath) as! AddCell
            cell.addButton.borderColor = color
            cell.addButton.setTitleColor(color, for: .normal)
            cell.addButton.setImage(UIImage.fontAwesomeIcon(name: .plus, style: .solid, textColor: color, size: CGSize(width: 20, height: 20)), for: .normal)
            cell.addButton.addTarget(self, action: #selector(addMore(_:)), for: .touchUpInside)
            return cell
        }
    }
    
    // MARK: - Protocol -
    
    @objc func removeFile(_ sender: UIButton) {
        // create actionSheet
        let actionSheet = UIAlertController(title: nil, message: nil, preferredStyle: .actionSheet)
        // add action
        actionSheet.addAction(UIAlertAction(title: "Rename File", style: .default) { action -> Void in
            
        })
        actionSheet.addAction(UIAlertAction(title: "Delete File", style: .destructive)  { action -> Void in
            let index = sender.tag
            self.documents.remove(at: index)
            self.filenames.remove(at: index)
            self.tableView.reloadData()
        })
        // add cancel
        actionSheet.addAction(UIAlertAction(title: "Cancel", style: .cancel)  { action -> Void in
            actionSheet.dismiss(animated: true, completion: nil)
        })
        // present actionSheet
        self.present(actionSheet, animated: true, completion: nil)
    }
    
    @objc func addMore(_ sender: Any) {
        // present vc
        if let mVC = self.storyboard?.instantiateViewController(withIdentifier: "sb_AddDocToSignController")  as? AddDocToSignController {
            mVC.callback = { (document, filename) in
                self.dismiss(animated: true, completion: {
                    // append document
                    self.documents.append(document)
                    self.filenames.append(filename)
                    self.tableView.reloadData()
                })
            }
            let navController = UINavigationController(rootViewController: mVC)
            present(navController, animated: true, completion: nil)
        }
    }
}

// MARK: - Cells -

class AddCell: UITableViewCell {
    @IBOutlet var addButton: UIButton!
}
