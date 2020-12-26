//
//  EditTaskController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 05/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import DLRadioButton
import SVProgressHUD

class EditTaskController: UITableViewController {

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
    
    var item: Task!
    var assigneeId: Int = 0
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
        loadData()
                
        self.title = "Edit Task"
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
        
        // iterate radio to set checked
        let radios = [defaultRadio, redRadio, pinkRadio, magentaRadio, purpleRadio, blueRadio, tealRadio, greenRadio, goldRadio]
        var x = 0
        for radio in radios {
            // check
            radio?.isSelected = (item.status_color == EventColor.colors[x]) ? true : false
            // increment
            x+=1
        }
    }
    
    // MARK: - Load data -
    
    func loadData() {
        // get assignee
        var userId = 0
        // iterate
        for user in item.participants {
            // check
            if user.is_assigned {
                userId = user.user_id.intValue
                assigneeId = user.id.intValue
            }
        }
        
        nameField.text          = item.subject
        descriptionField.text   = item.descriptionn
        employeeField.text      = Helpers.getEmployeeById(userId.stringValue)?.full_name
        dueDateField.date       = Date(fromString: item.estimated_date_complete, format: DateHelper.dateFormatType) ?? Date()
        statusField.text        = item.status_name
        priorityField.text      = item.priority
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
                                  "estimated_date_complete": App.shared.dateFormatter.string(from: dueDateField.date),
                                  "status_id": 1,
                                  "priority": priorityField.text!,
                                  "company_id": App.shared.companyId]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show(withStatus: "Saving...")
        App.shared.api.putTask(item.task_id.intValue, params: params) { (success, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard success == true else {
                return SVProgressHUD.showError(withStatus: "Saving data failed!")
            }
                
            // assignee
            let user: Parameters = ["task_id": self.item.task_id,
                                    "user_id": Helpers.getEmployeeId(self.employeeField.text!),
                                    "is_assigned": 1]
            
            SVProgressHUD.setDefaultMaskType(.clear)
            SVProgressHUD.show(withStatus: "Saving...")
            App.shared.api.putTaskParticipant(self.assigneeId, params: user) { (_, _) in
                SVProgressHUD.setDefaultMaskType(.none)
                SVProgressHUD.showSuccess(withStatus: "Data has been saved!")
                self.popViewController()
            }
        }
    }

}
