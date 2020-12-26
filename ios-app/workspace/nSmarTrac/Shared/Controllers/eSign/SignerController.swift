//
//  SignerController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 09/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import PDFKit
import SVProgressHUD

class SignerController: UIViewController {

    // MARK: - Properties -
    
    var item: ESign!
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
                
        self.title = "Select Signers"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func updateESign(for type: String) {
        // params
        let params: Parameters = ["type": type,
                                  "status": (type == "Single") ? "Action Required" : "Draft"]
        
        // update esign status from Draft to Needs to Sign
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show()
        App.shared.api.putESign(item.id.intValue, params: params) { (result, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            
            let signer: Parameters = ["user_id": App.shared.user!.id,
                                      "docfile_id": self.item.id,
                                      "name": App.shared.user!.full_name,
                                      "email": App.shared.user!.email,
                                      "role": "Needs to Sign",
                                      "color": EventColor.colors.first!]
            
            // add signer
            SVProgressHUD.setDefaultMaskType(.clear)
            SVProgressHUD.show()
            App.shared.api.postESignRecipient(signer) { (result2, error2) in
                SVProgressHUD.setDefaultMaskType(.none)
                SVProgressHUD.dismiss()
                guard error2 == nil else {
                    return SVProgressHUD.showError(withStatus: error2?.localizedDescription ?? "")
                }
                guard result2?.Code == 200 else {
                    return SVProgressHUD.showError(withStatus: result2!.Message)
                }
                
                // get the item first
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show()
                App.shared.api.getESign(self.item!.id.intValue) { (result3, error3) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.dismiss()
                    guard error == nil else {
                        return SVProgressHUD.showError(withStatus: error3?.localizedDescription ?? "")
                    }
                    
                    // check type
                    if type == "Single" {
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
                                    
                                    // go to sign page
                                    let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_SignMeController") as? SignMeController
                                    viewController?.item = result3
                                    viewController?.documents = documents
                                    self.navigationController?.pushViewController(viewController!, animated: true)
                                }
                            })
                        }
                    } else {
                        // go to recipient screen
                        let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_RecipientsController") as? RecipientsController
                        viewController?.item = result3
                        self.navigationController?.pushViewController(viewController!, animated: true)
                    }
                }
            }
        }
    }
    
    // MARK: - Actions -
    
    @IBAction func signMeButtonTapped(_ sender: Any) {
        self.updateESign(for: "Single")
    }
    
    @IBAction func signOthersButtonTapped(_ sender: Any) {
        self.updateESign(for: "Multiple")
    }
    
}
