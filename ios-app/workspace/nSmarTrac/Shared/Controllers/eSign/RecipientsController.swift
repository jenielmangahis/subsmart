//
//  RecipientsController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 19/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import SVProgressHUD

class RecipientsController: UIViewController {

    // MARK: - Properties -
    
    @IBOutlet var tableView: UITableView!
    
    var item: ESign!
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
                
        self.title = "Recipients"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Actions -
    
    @IBAction func moreButtonTapped(_ sender: Any) {
        // create actionSheet
        let actionSheet = UIAlertController(title: nil, message: nil, preferredStyle: .actionSheet)
        // add action
        actionSheet.addAction(UIAlertAction(title: "Save Draft", style: .default) { action -> Void in
            
        })
        actionSheet.addAction(UIAlertAction(title: "Discard Draft", style: .destructive)  { action -> Void in
            // delete from database
            SVProgressHUD.setDefaultMaskType(.clear)
            SVProgressHUD.show()
            App.shared.api.deleteESign(self.item.id.intValue) { (result, error) in
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
        // go to multiple signer screen
        let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_SignOtherController") as? SignOtherController
        viewController?.item = self.item
        self.navigationController?.pushViewController(viewController!, animated: true)
    }
    
}

// MARK: - TableView Datasource -

extension RecipientsController: UITableViewDelegate, UITableViewDataSource {
    
    func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return (item?.recipients.count)! + 1
    }
    
    func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 1
    }
    
    func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        return 1
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        // get row
        let row = indexPath.row
        // check row
        if (item?.recipients.count)! > 0 && row >= 0 && row <= (item?.recipients.count)!-1 {
            let data = item?.recipients[row]
            
            // get initials
            var initials = ""
            let name = data?.name.components(separatedBy: " ")
            if let firstLetter = name?.first?.first,
                let secondLetter = name?.last?.first {
                initials = "\(firstLetter)\(secondLetter)"
            }
            
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath) as! SignerCell
            cell.thumbnail.backgroundColor  = UIColor(hex: data!.color)
            cell.thumbnail.text             = initials.uppercased()
            cell.name.text                  = data?.name
            cell.email.text                 = data?.email
            cell.action.text                = data?.role
            
            // check role
            if data?.role == "Signs in Person" {
                // get host name and email
                cell.email.text = "Hosted By: \(data?.host_name ?? "-")"
            }
            
            // add more button
            let moreButton = UIButton(frame: CGRect(x: Device.width-50, y: 15, width: 30, height: 30))
            moreButton.setImage(UIImage.fontAwesomeIcon(name: .ellipsisV, style: .regular, textColor: App.shared.iconColor, size: CGSize(width: 30, height: 30)), for: .normal)
            moreButton.tag = row
            moreButton.addTarget(self, action: #selector(removeSigner(_:)), for: .touchUpInside)
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
    
    func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        // get row
        let row = indexPath.row
        // check row
        if (item?.recipients.count)! > 0 && row >= 0 && row <= (item?.recipients.count)!-1 {
            let data = item?.recipients[row]
            // present edit vc
            if let mVC = self.storyboard?.instantiateViewController(withIdentifier: "sb_EditRecipientController")  as? EditRecipientController {
                mVC.item = data
                mVC.callback = { result in
                    self.dismiss(animated: true, completion: {
                        // append document
                        self.item = result
                        self.tableView.reloadData()
                    })
                }
                let navController = UINavigationController(rootViewController: mVC)
                self.present(navController, animated: true, completion: nil)
            }
        }
    }
    
    // MARK: - Protocol -
    
    @objc func removeSigner(_ sender: UIButton) {
        // create actionSheet
        let actionSheet = UIAlertController(title: nil, message: nil, preferredStyle: .actionSheet)
        // add action
        actionSheet.addAction(UIAlertAction(title: "Remove Recipient", style: .destructive)  { action -> Void in
            // remove recipient
            SVProgressHUD.setDefaultMaskType(.clear)
            SVProgressHUD.show()
            App.shared.api.deleteESignRecipient(sender.tag, completion: { (result, error) in
                SVProgressHUD.setDefaultMaskType(.none)
                SVProgressHUD.dismiss()
                guard error == nil else {
                    return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                }
                
                // update item
                // get item
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show()
                App.shared.api.getESign(self.item.id.intValue) { (result2, error2) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.dismiss()
                    guard error == nil else {
                        return SVProgressHUD.showError(withStatus: error2?.localizedDescription ?? "")
                    }
                    
                    // update
                    self.item = result2
                    self.tableView.reloadData()
                }
            })
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
        if let mVC = self.storyboard?.instantiateViewController(withIdentifier: "sb_AddRecipientController")  as? AddRecipientController {
            mVC.esignId = (self.item?.id.intValue)!
            mVC.callback = { result in
                self.dismiss(animated: true, completion: {
                    // append document
                    self.item = result
                    self.tableView.reloadData()
                })
            }
            let navController = UINavigationController(rootViewController: mVC)
            self.present(navController, animated: true, completion: nil)
        }
    }
}
