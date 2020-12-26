//
//  EditRecipientController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 01/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import SVProgressHUD

class EditRecipientController: UITableViewController {

    // MARK: - Properties -
    
    @IBOutlet var nameField: MaterialTextField!
    @IBOutlet var emailField: MaterialTextField!
    @IBOutlet var hostNameField: MaterialTextField!
    @IBOutlet var hostEmailField: MaterialTextField!
    @IBOutlet var someoneWillHostSwitch: UISwitch!
    
    var selectedRole = 0
    var isSomeoneWillHost: Bool = false
    
    var item: ESignRecipient!
    var callback: ((ESign) -> Void)?
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
                
        self.title = "Edit Recipient"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Load data -
    
    func loadData() {
        nameField.text      = item.name
        emailField.text     = item.email
        hostNameField.text  = item.host_name
        hostEmailField.text = item.host_email
        
        someoneWillHostSwitch.isOn = item.host_name.contains("(me)") ? true : false
    }
    
    // MARK: - TableView Datasource -
    
    override func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        let section = indexPath.section
        let row = indexPath.row
        
        // check
        if selectedRole == 0 || selectedRole == 2 {
            if section == 1 {
                return 0
            }
            return 60
        } else if selectedRole == 1 {
            if section == 1 {
                if row == 0 {
                    return 60
                } else if isSomeoneWillHost && (row == 1 || row == 2) {
                    return 60
                }
                return 0
            } else if section == 2 {
                if row == 0 {
                    return 60
                }
                return 0
            }
        }
        
        return 60
    }
    
    override func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        // check
        if selectedRole == 0 || selectedRole == 2 {
            if section == 1 {
                return 0.00001
            }
        }
        
        return 30
    }
    
    override func tableView(_ tableView: UITableView, titleForHeaderInSection section: Int) -> String? {
        // check
        if selectedRole == 0 || selectedRole == 2 {
            if section == 1 {
                return ""
            }
        }
        
        return ["Role", "Host", "Recipient"][section]
    }
    
    override func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        guard indexPath.section == 0 else {
            return
        }
        
        if let cell = tableView.cellForRow(at: indexPath) {
            cell.accessoryType = .checkmark
            
            // assign
            self.selectedRole = indexPath.row
            
            self.tableView.beginUpdates()
            self.tableView.endUpdates()
        }
    }
    
    override func tableView(_ tableView: UITableView, didDeselectRowAt indexPath: IndexPath) {
        guard indexPath.section == 0 else {
            return
        }
        
        if let cell = tableView.cellForRow(at: indexPath) {
            cell.accessoryType = .none
        }
    }
    
    // MARK: - Actions -
    
    @IBAction func hostSwitchValueChanged(_ sender: Any) {
        isSomeoneWillHost = !isSomeoneWillHost
        
        self.tableView.beginUpdates()
        self.tableView.endUpdates()
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        
        // role
        let role = ["Needs to Sign", "Signs in Person", "Receives a copy"]
        // host
        var hostName = ""
        var hostEmail = ""
        // check
        if role[selectedRole] == "Signs in Person" {
            // check
            if isSomeoneWillHost {
                hostName = hostNameField.text!
                hostEmail = hostEmailField.text!
            } else {
                hostName = App.shared.user!.full_name + " (me)"
                hostEmail = App.shared.user!.email
            }
        }
        
        // params
        let params: Parameters = ["name": nameField.text!,
                                  "email": emailField.text!,
                                  "role": role[selectedRole],
                                  "host_name": hostName,
                                  "host_email": hostEmail,
                                  "color": EventColor.colors.random()!]
        
        // add recipient
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show()
        App.shared.api.putESignRecipient(item.id.intValue, params: params) { (result, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            
            // get item
            SVProgressHUD.setDefaultMaskType(.clear)
            SVProgressHUD.show()
            App.shared.api.getESign(self.item.docfile_id.intValue) { (result2, error2) in
                SVProgressHUD.setDefaultMaskType(.none)
                SVProgressHUD.dismiss()
                guard error == nil else {
                    return SVProgressHUD.showError(withStatus: error2?.localizedDescription ?? "")
                }
                
                self.callback!(result2!)
            }
        }
    }
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        self.dismiss(animated: true, completion: nil)
    }

}
