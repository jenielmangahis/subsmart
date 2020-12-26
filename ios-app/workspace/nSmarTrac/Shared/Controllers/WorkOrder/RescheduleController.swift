//
//  RescheduleController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 21/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import DLRadioButton
import RxSwift
import RxCocoa
import SVProgressHUD

class RescheduleController: UITableViewController {

    // MARK: - Properties -
    
    @IBOutlet var startDateField: MaterialDatePickerField!
    @IBOutlet var startTimeField: MaterialDropdownField!
    @IBOutlet var endDateField: MaterialDatePickerField!
    @IBOutlet var endTimeField: MaterialDropdownField!
    @IBOutlet var employeeField: MaterialDropdownField!
    @IBOutlet var customerReminderField: MaterialDropdownField!
    @IBOutlet var timezoneField: MaterialDropdownField!
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
    
    var item: WorkOrder!
    
    var callback: ((WorkOrder) -> Void)?



    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
        loadData()
                
        self.title = "Schedule & Assign"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Load data -
    
    func loadData() {
        startDateField.date             = Date(fromString: item.start_date, format: DateHelper.dateFormatType)!
        startTimeField.text             = item.start_time
        endDateField.date               = Date(fromString: item.end_date, format: DateHelper.dateFormatType)!
        endTimeField.text               = item.end_time
        employeeField.text              = item.employee_name
        customerReminderField.text      = item.customer_reminder_notification
        timezoneField.text              = item.timezone
    }
    
    // MARK: - Actions -
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        
        // get event color
        let eventColor = EventColor.colors[defaultRadio.selected()?.tag ?? 0]
        
        let workOrder: Parameters = ["company_id": App.shared.companyId,
                                     "employee_id": Helpers.getEmployeeId(employeeField.text!),
                                     "start_date": App.shared.dateFormatter.string(from: startDateField.date),
                                     "start_time": startTimeField.text!,
                                     "end_date": App.shared.dateFormatter.string(from: endDateField.date),
                                     "end_time": endTimeField.text!,
                                     "event_color": eventColor,
                                     "customer_reminder_notification": customerReminderField.text!,
                                     "timezone": timezoneField.text!,
                                     "status": "Scheduled"]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show()
        App.shared.api.putWorkOrder(item.id.intValue, params: workOrder) { (success, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard success == true else {
                return SVProgressHUD.showError(withStatus: "Saving data failed!")
            }
            
            SVProgressHUD.showSuccess(withStatus: "Data has been saved!")
            
            // get item
            SVProgressHUD.setDefaultMaskType(.clear)
            SVProgressHUD.show()
            App.shared.api.getWorkOrder(self.item.id.intValue) { (result, error) in
                SVProgressHUD.setDefaultMaskType(.none)
                SVProgressHUD.dismiss()
                guard error == nil else {
                    return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                }
                
                // assign
                App.shared.selectedWorkOrder = result!
                
                self.callback!(result!)
                self.popViewController()
            }
        }
    }
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        self.popViewController()
    }
    
    // MARK: - Functions -
    
    func initViews() {
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
        
        // init employee
        employeeField.updateOptions(options: Helpers.getEmployees())
        employeeField.setSelectedOption(option: item.employee_name)
        
        // init customer reminder
        customerReminderField.updateOptions(options: ["None", "5 minutes before", "10 minutes before", "30 minutes before", "1 hour before", "2 hours before", "4 hours before", "6 hours before", "8 hours before", "12 hours before", "16 hours before", "1 day before", "2 days before", "On date of event"])
        customerReminderField.setSelectedOption(option: item.customer_reminder_notification)
        
        // init timezone
        timezoneField.updateOptions(options: ["Hawaii Time (UTC -10)", "Hawaii Daylight Time (UTC -9)", "Alaska Time (UTC -8)", "Pacific Time (UTC -7)", "Arizona Time (UTC -7)", "Mountain Time (UTC -6)", "Central Time (UTC -5)", "Eastern Time (UTC -4)"])
        timezoneField.setSelectedOption(option: item.timezone)
        
        // init dates
        endDateField.minimumDate = startDateField.date
        
        // init time
        let time = ["12:00 am", "12:30 am", "1:00 am", "1:30 am", "2:00 am", "2:30 am", "3:00 am", "3:30 am", "4:00 am", "4:30 am", "5:00 am", "5:30 am", "6:00 am", "6:30 am", "7:00 am", "7:30 am", "8:00 am", "8:30 am", "9:00 am", "9:30 am", "10:00 am", "10:30 am", "11:00 am", "11:30 am", "12:00 pm", "12:30 pm", "1:00 pm", "1:30 pm", "2:00 pm", "2:30 pm", "3:00 pm", "3:30 pm", "4:00 pm", "4:30 pm", "5:00 pm", "5:30 pm", "6:00 pm", "6:30 pm", "7:00 pm", "7:30 pm", "8:00 pm", "8:30 pm", "9:00 pm", "9:30 pm", "10:00 pm", "10:30 pm", "11:00 pm", "11:30 pm"]
        startTimeField.updateOptions(options: time)
        startTimeField.setSelectedOption(option: item.start_time)
        endTimeField.updateOptions(options: time)
        endTimeField.setSelectedOption(option: item.end_time)
        
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
            radio?.isSelected = (item.event_color == EventColor.colors[x]) ? true : false
            // increment
            x+=1
        }
    }

}
