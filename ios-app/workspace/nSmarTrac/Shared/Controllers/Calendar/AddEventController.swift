//
//  AddEventController.swift
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

class AddEventController: UITableViewController {

    // MARK: - Properties -
    
    @IBOutlet var customerField: MaterialTextField!
    @IBOutlet var descriptionField: MaterialTextField!
    @IBOutlet var startDateField: MaterialDatePickerField!
    @IBOutlet var startTimeField: MaterialDropdownField!
    @IBOutlet var endDateField: MaterialDatePickerField!
    @IBOutlet var endTimeField: MaterialDropdownField!
    @IBOutlet var employeeField: MaterialDropdownField!
    @IBOutlet var instructionsField: MaterialTextField!
    @IBOutlet var customerReminderField: MaterialDropdownField!
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
    
    var selectedCustomer: Customer?
    
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
            
        self.title = "New Event"
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
        
        // init if customer not nil
        if let customer = selectedCustomer {
            self.selectedCustomer = customer
            self.customerField.text = customer.contact_name
            self.descriptionField.placeholder = "SCHEDULE NAME"
        }
        
        // init customer reminder
        customerReminderField.updateOptions(options: ["None", "5 minutes before", "10 minutes before", "30 minutes before", "1 hour before", "2 hours before", "4 hours before", "6 hours before", "8 hours before", "12 hours before", "16 hours before", "1 day before", "2 days before", "On date of event"])
        customerReminderField.setSelectedOption(option: "1 day before")
        
        // init dates
        endDateField.minimumDate = startDateField.date
        
        // init time
        let time = ["12:00 am", "12:30 am", "1:00 am", "1:30 am", "2:00 am", "2:30 am", "3:00 am", "3:30 am", "4:00 am", "4:30 am", "5:00 am", "5:30 am", "6:00 am", "6:30 am", "7:00 am", "7:30 am", "8:00 am", "8:30 am", "9:00 am", "9:30 am", "10:00 am", "10:30 am", "11:00 am", "11:30 am", "12:00 pm", "12:30 pm", "1:00 pm", "1:30 pm", "2:00 pm", "2:30 pm", "3:00 pm", "3:30 pm", "4:00 pm", "4:30 pm", "5:00 pm", "5:30 pm", "6:00 pm", "6:30 pm", "7:00 pm", "7:30 pm", "8:00 pm", "8:30 pm", "9:00 pm", "9:30 pm", "10:00 pm", "10:30 pm", "11:00 pm", "11:30 pm"]
        startTimeField.updateOptions(options: time)
        endTimeField.updateOptions(options: time)
        
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
    
    @IBAction func selectCustomerButtonTapped(_ sender: Any) {
        if let vc = self.storyboard?.instantiateViewController(withIdentifier: "sb_SelectCustomerController")  as? SelectCustomerController {
            vc.callback = { customer in
                self.selectedCustomer = customer
                self.customerField.text = customer.contact_name
            }
            self.navigationController?.pushViewController(vc, animated: true)
        }
    }
    
    @IBAction func addCustomerButtonTapped(_ sender: Any) {
        self.pushTo(storyBoard: "Main", identifier: "sb_AddCustomerController")
    }
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        self.popViewController()
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        
        // get event color
        let eventColor = EventColor.colors[defaultRadio.selected()?.tag ?? 0]
        
        let params: Parameters = ["company_id": App.shared.companyId,
                                  "customer_id": selectedCustomer?.id ?? 0,
                                  "event_description": descriptionField.text!,
                                  "employee_id": Helpers.getEmployeeId(employeeField.text!),
                                  "start_date": App.shared.dateFormatter.string(from: startDateField.date),
                                  "start_time": startTimeField.text!,
                                  "end_date": App.shared.dateFormatter.string(from: endDateField.date),
                                  "end_time": endTimeField.text!,
                                  "event_color": eventColor,
                                  "customer_reminder_notification": customerReminderField.text!,
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
