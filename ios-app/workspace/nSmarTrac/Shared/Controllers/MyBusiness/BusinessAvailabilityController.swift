//
//  BusinessAvailabilityController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 01/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import DLRadioButton
import SVProgressHUD

class BusinessAvailabilityController: UITableViewController {

    // MARK: - Properties -
    
    @IBOutlet var cbMonday: DLRadioButton!
    @IBOutlet var cbTuesday: DLRadioButton!
    @IBOutlet var cbWednesday: DLRadioButton!
    @IBOutlet var cbThursday: DLRadioButton!
    @IBOutlet var cbFriday: DLRadioButton!
    @IBOutlet var cbSaturday: DLRadioButton!
    @IBOutlet var cbSunday: DLRadioButton!
    @IBOutlet var startTimeField: MaterialDropdownField!
    @IBOutlet var endTimeField: MaterialDropdownField!
    @IBOutlet var timeOffFromField: MaterialDatePickerField!
    @IBOutlet var timeOffToField: MaterialDatePickerField!
    
    var item: BusinessProfile?
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
                
        self.title = "Business Availability"
    }
    
    override func viewWillAppear(_ animated: Bool) {
        loadData()
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Load data -
    
    func loadData() {
        // call api
        SVProgressHUD.show(withStatus: "Loading...")
        App.shared.api.getBusinessProfile() { (item, error) in
            SVProgressHUD.dismiss()
            if let e = error {
                return SVProgressHUD.showError(withStatus: e.localizedDescription)
            }
            
            self.item                       = item
            self.timeOffFromField.date      = Date(fromString: item!.working_off_from, format: DateHelper.dateFormatType) ?? Date()
            self.timeOffToField.date        = Date(fromString: item!.working_of_to, format: DateHelper.dateFormatType) ?? Date()
            
            self.startTimeField.setSelectedOption(option: item?.start_time_of_day)
            self.endTimeField.setSelectedOption(option: item?.end_time_of_day)
            
            // explode
            let days = item?.working_days.components(separatedBy: ", ")
            self.cbMonday.configure(days?.contains("Mon") ?? false)
            self.cbTuesday.configure(days?.contains("Tue") ?? false)
            self.cbWednesday.configure(days?.contains("Wed") ?? false)
            self.cbThursday.configure(days?.contains("Thur") ?? false)
            self.cbFriday.configure(days?.contains("Fri") ?? false)
            self.cbSaturday.configure(days?.contains("Sat") ?? false)
            self.cbSunday.configure(days?.contains("Sun") ?? false)
        }
    }
    
    // MARK: - Functions -
    
    func initViews() {
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
        
        // init checkboxes
        cbMonday.otherButtons = [cbTuesday, cbWednesday, cbThursday, cbFriday, cbSaturday, cbSunday]
        cbMonday.configure(true)
        cbTuesday.configure(true)
        cbWednesday.configure(true)
        cbThursday.configure(true)
        cbFriday.configure(true)
        cbSaturday.configure()
        cbSunday.configure()
        
        // init time
        let time = ["12:00 am", "12:30 am", "1:00 am", "1:30 am", "2:00 am", "2:30 am", "3:00 am", "3:30 am", "4:00 am", "4:30 am", "5:00 am", "5:30 am", "6:00 am", "6:30 am", "7:00 am", "7:30 am", "8:00 am", "8:30 am", "9:00 am", "9:30 am", "10:00 am", "10:30 am", "11:00 am", "11:30 am", "12:00 pm", "12:30 pm", "1:00 pm", "1:30 pm", "2:00 pm", "2:30 pm", "3:00 pm", "3:30 pm", "4:00 pm", "4:30 pm", "5:00 pm", "5:30 pm", "6:00 pm", "6:30 pm", "7:00 pm", "7:30 pm", "8:00 pm", "8:30 pm", "9:00 pm", "9:30 pm", "10:00 pm", "10:30 pm", "11:00 pm", "11:30 pm"]
        startTimeField.updateOptions(options: time)
        endTimeField.updateOptions(options: time)
        
        // init unavailability
        timeOffToField.minimumDate = timeOffFromField.date
    }
    
    // MARK: - Actions -
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        self.popViewController()
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        
        var workingDays: [String] = []
        // check
        if cbMonday.isSelected {
            workingDays.append("Mon")
        }
        if cbTuesday.isSelected {
            workingDays.append("Tue")
        }
        if cbWednesday.isSelected {
            workingDays.append("Wed")
        }
        if cbThursday.isSelected {
            workingDays.append("Thur")
        }
        if cbFriday.isSelected {
            workingDays.append("Fri")
        }
        if cbSaturday.isSelected {
            workingDays.append("Sat")
        }
        if cbSunday.isSelected {
            workingDays.append("Sun")
        }
        
        
        
        let params: Parameters = ["working_days": workingDays.joined(separator: ", "),
                                  "start_time_of_day": startTimeField.text!,
                                  "end_time_of_day": endTimeField.text!,
                                  "working_off_from": App.shared.dateFormatter.string(from: timeOffFromField.date),
                                  "working_off_to": App.shared.dateFormatter.string(from: timeOffToField.date)]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show()
        App.shared.api.putBusinessProfile(params) { (success, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard success == true else {
                return SVProgressHUD.showError(withStatus: "Saving data failed!")
            }
            
            SVProgressHUD.showSuccess(withStatus: "Data has been saved!")
            self.popViewController()
        }
    }
    
}
