//
//  AddBlockTimeController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 13/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import DLRadioButton
import RxSwift
import RxCocoa
import SVProgressHUD

class AddBlockTimeController: UITableViewController {

    // MARK: - Properties -
    
    @IBOutlet var descriptionField: MaterialTextField!
    @IBOutlet var startDateField: MaterialDatePickerField!
    @IBOutlet var startTimeField: MaterialDropdownField!
    @IBOutlet var endDateField: MaterialDatePickerField!
    @IBOutlet var endTimeField: MaterialDropdownField!
    @IBOutlet var employeeField: MaterialDropdownField!
    @IBOutlet var instructionsField: MaterialTextField!
    @IBOutlet var saveButton: DesignableButton!
    
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
            
        self.title = "New Block Time"
        self.tableView.allowsSelection = false
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
        
        // get event color
        let eventColor = EventColor.colors[defaultRadio.selected()?.tag ?? 0]
        
        let params: Parameters = ["company_id": App.shared.companyId,
                                  "customer_id": 0,
                                  "event_description": descriptionField.text!,
                                  "employee_id": Helpers.getEmployeeId(employeeField.text!),
                                  "start_date": App.shared.dateFormatter.string(from: startDateField.date),
                                  "start_time": startTimeField.text!,
                                  "end_date": App.shared.dateFormatter.string(from: endDateField.date),
                                  "end_time": endTimeField.text!,
                                  "event_color": eventColor,
                                  "instructions": instructionsField.text!,
                                  "created_by": App.shared.user!.id]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show(withStatus: "Saving...")
        App.shared.api.postEvent(params) { (result, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard result?.Code == 200 else {
                return SVProgressHUD.showError(withStatus: result!.Message)
            }
            
            SVProgressHUD.showSuccess(withStatus: "Data has been saved!")
            self.popViewController()
        }
    }
    
}
