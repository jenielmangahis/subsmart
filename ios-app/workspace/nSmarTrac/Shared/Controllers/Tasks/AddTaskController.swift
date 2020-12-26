//
//  AddTaskController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 05/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import DLRadioButton
import SVProgressHUD

class AddTaskController: UITableViewController {

    // MARK: - Properties -

    @IBOutlet var nameField: MaterialTextField!
    @IBOutlet var descriptionField: MaterialTextField!
    @IBOutlet var employeeField: MaterialDropdownField!
    @IBOutlet var dueDateField: MaterialDatePickerField!
    @IBOutlet var statusField: MaterialDropdownField!
    @IBOutlet var priorityField: MaterialDropdownField!
    
    @IBOutlet var defaultRadio: DLRadioButton!
    @IBOutlet var redRadio: DLRadioButton!
    @IBOutlet var pinkRadio: DLRadioButton!
    @IBOutlet var magentaRadio: DLRadioButton!
    @IBOutlet var purpleRadio: DLRadioButton!
    @IBOutlet var blueRadio: DLRadioButton!
    @IBOutlet var tealRadio: DLRadioButton!
    @IBOutlet var greenRadio: DLRadioButton!
    @IBOutlet var goldRadio: DLRadioButton!
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
                
        self.title = "Add Task"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func initViews() {
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
        
        // init employees
        employeeField.updateOptions(options: Helpers.getEmployees())
        
        // init statusField
        statusField.updateOptions(options: ["Active", "Completed"])
        statusField.setSelectedOption(option: "Active")
        
        // init priorityField
        priorityField.updateOptions(options: ["Low", "Medium", "High"])
        priorityField.setSelectedOption(option: "Low")
        
        // init radioButtons
        defaultRadio.isMultipleSelectionEnabled = false
        defaultRadio.isSelected = true
        defaultRadio.otherButtons = [redRadio, pinkRadio, magentaRadio, purpleRadio, blueRadio, tealRadio, greenRadio, goldRadio]
        
        defaultRadio.tag    = 0
        redRadio.tag        = 1
        pinkRadio.tag       = 2
        magentaRadio.tag    = 3
        purpleRadio.tag     = 4
        blueRadio.tag       = 5
        tealRadio.tag       = 6
        greenRadio.tag      = 7
        goldRadio.tag       = 8
    }
    
    // MARK: - Actions -
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        self.popViewController()
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        
        let params: Parameters = ["subject": nameField.text!,
                                  "description": descriptionField.text!,
                                  "created_by": App.shared.user?.id ?? 0,
                                  "estimated_date_complete": App.shared.dateFormatter.string(from: dueDateField.date),
                                  "status_id": 1,
                                  "priority": priorityField.text!,
                                  "company_id": App.shared.companyId]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show(withStatus: "Saving...")
        App.shared.api.postTask(params) { (result, error) in
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
                
                let user: Parameters = ["task_id": id,
                                        "user_id": Helpers.getEmployeeId(self.employeeField.text!),
                                        "is_assigned": 1]
                
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show(withStatus: "Saving...")
                App.shared.api.postTaskParticipant(user) { (_, _) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.showSuccess(withStatus: "Data has been saved!")
                    self.popViewController()
                }
            }
        }
    }

}
