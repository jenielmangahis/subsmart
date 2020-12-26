//
//  NotificationSettingsController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 03/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import DLRadioButton
import ScrollableSegmentedControl
import SVProgressHUD

class NotificationSettingsController: UITableViewController {

    // MARK: - Properties -
    
    @IBOutlet var segmentedControl: ScrollableSegmentedControl!
    @IBOutlet var btnEmailNotification: DLRadioButton!
    @IBOutlet var btnSmsNotification: DLRadioButton!
    @IBOutlet var btnNotifyResCustomerWhenScheduling: DLRadioButton!
    @IBOutlet var btnNotifyResCustomerWhenCancelling: DLRadioButton!
    @IBOutlet var btnSetDefaultValueAsResidential: DLRadioButton!
    @IBOutlet var btnNotifyCommCustomerWhenScheduling: DLRadioButton!
    @IBOutlet var btnNotifyCommCustomerWhenCancelling: DLRadioButton!
    @IBOutlet var customerReminderNotificationField: MaterialDropdownField!
    @IBOutlet var customerReminderFirstHeadsupField: MaterialDropdownField!
    @IBOutlet var customerReminderSecondHeadsupField: MaterialDropdownField!
    @IBOutlet var businessReminderNotificationField: MaterialDropdownField!
    @IBOutlet var taskReminderNotificationField: MaterialDropdownField!
    @IBOutlet var btnCopyEstimateToMe: DLRadioButton!
    @IBOutlet var btnCopyInvoiceToMe: DLRadioButton!
    @IBOutlet var btnNotifyEmployeeOnWork: DLRadioButton!
    @IBOutlet var btnNotifyTenantWhenScheduling: DLRadioButton!
    
    var item: NotificationSetting?
    var isResidential: Bool = true
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
        initScrollableSegmentControl()
                
        self.title = "Notification Settings"
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
        App.shared.api.getNotificationSetting() { (item, error) in
            SVProgressHUD.dismiss()
            if let e = error {
                return SVProgressHUD.showError(withStatus: e.localizedDescription)
            }
            
            self.item                                               = item
            self.btnEmailNotification.isSelected                    = item?.notify_email ?? false
            self.btnSmsNotification.isSelected                      = item?.notify_sms ?? false
            self.btnNotifyResCustomerWhenScheduling.isSelected      = item?.notify_residential_when_scheduling ?? false
            self.btnNotifyResCustomerWhenCancelling.isSelected      = item?.notify_residential_during_rescheduling_cancelling ?? true
            self.btnSetDefaultValueAsResidential.isSelected         = item?.set_default_commercial_value_as_residential ?? true
            self.btnNotifyCommCustomerWhenScheduling.isSelected     = item?.notify_commercial_when_scheduling ?? true
            self.btnNotifyCommCustomerWhenCancelling.isSelected     = item?.notify_commercial_during_rescheduling_cancelling ?? true
            self.btnCopyEstimateToMe.isSelected                     = item?.copy_when_sending_estimate ?? false
            self.btnCopyInvoiceToMe.isSelected                      = item?.copy_when_sending_invoice ?? false
            self.btnNotifyEmployeeOnWork.isSelected                 = item?.notify_when_employees_arrive ?? false
            self.btnNotifyTenantWhenScheduling.isSelected           = item?.notify_tenant_from_service_address ?? false
            
            self.customerReminderNotificationField.setSelectedOption(option: item?.customer_reminder_notification)
            self.customerReminderFirstHeadsupField.setSelectedOption(option: item?.customer_first_heads_up_notification)
            self.customerReminderSecondHeadsupField.setSelectedOption(option: item?.customer_second_heads_up_notification)
            self.businessReminderNotificationField.setSelectedOption(option: item?.business_reminder_notification)
            self.taskReminderNotificationField.setSelectedOption(option: item?.task_reminder_notification)
        }
    }
    
    // MARK: - Functions -
    
    func initViews() {
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
        
        // init checkboxes
        btnEmailNotification.configure()
        btnSmsNotification.configure()
        
        btnNotifyResCustomerWhenScheduling.configure()
        btnNotifyResCustomerWhenCancelling.configure()
        btnSetDefaultValueAsResidential.configure()
        btnNotifyCommCustomerWhenScheduling.configure()
        btnNotifyCommCustomerWhenCancelling.configure()
        
        btnCopyEstimateToMe.configure()
        btnCopyInvoiceToMe.configure()
        
        btnNotifyEmployeeOnWork.configure()
        btnNotifyTenantWhenScheduling.configure()
        
        // init dropdown
        customerReminderNotificationField.updateOptions(options: ["None", "5 minutes before", "10 minutes before", "30 minutes before", "1 hour before", "2 hours before", "4 hours before", "6 hours before", "8 hours before", "12 hours before", "16 hours before", "1 day before", "2 days before", "On date of event"])
        customerReminderNotificationField.setSelectedOption(option: "1 day before")
        
        customerReminderFirstHeadsupField.updateOptions(options: ["None", "3 days before", "5 days before", "7 days before", "14 days before", "21 days before", "1 month before"])
        customerReminderFirstHeadsupField.setSelectedOption(option: "None")
        
        customerReminderSecondHeadsupField.updateOptions(options: ["None", "3 days before", "5 days before", "7 days before", "14 days before", "21 days before", "1 month before"])
        customerReminderSecondHeadsupField.setSelectedOption(option: "None")
        
        businessReminderNotificationField.updateOptions(options: ["None", "5 minutes before", "10 minutes before", "30 minutes before", "1 hour before", "2 hours before", "4 hours before", "6 hours before", "8 hours before", "12 hours before", "16 hours before", "1 day before", "2 days before", "On date of event"])
        businessReminderNotificationField.setSelectedOption(option: "2 hours before")
        
        taskReminderNotificationField.updateOptions(options: ["None", "5 minutes before", "10 minutes before", "30 minutes before", "1 hour before"])
        taskReminderNotificationField.setSelectedOption(option: "5 minutes before")
        
    }
    
    // MARK: - Scrollable Segment Control -
    
    func initScrollableSegmentControl() {
        segmentedControl.segmentStyle = .textOnly
        segmentedControl.insertSegment(withTitle: "RESIDENTIAL", at: 0)
        segmentedControl.insertSegment(withTitle: "COMMERCIAL", at: 1)
        
        segmentedControl.addTarget(self, action: #selector(segmentSelected(sender:)), for: .valueChanged)
        segmentedControl.backgroundColor = AppTheme.defaultMidOpaque
        segmentedControl.tintColor = AppTheme.defaultMidOpaque
        segmentedControl.segmentContentColor = UIColor.white
        segmentedControl.selectedSegmentContentColor = AppTheme.defaultColor
        segmentedControl.selectedSegmentIndex = 0
        segmentedControl.fixedSegmentWidth = true
        segmentedControl.underlineSelected = true
    }
    
    @objc func segmentSelected(sender:ScrollableSegmentedControl) {
        switch sender.selectedSegmentIndex {
        case 0:
            isResidential = true
            break
        case 1:
            isResidential = false
            break
        default:
            break
        }
        
        tableView.beginUpdates()
        tableView.endUpdates()
    }

    // MARK: - TableView Datasource -
    
    override func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        let section = indexPath.section
        let row = indexPath.row
        let sec46 = [0, 4, 5, 6]
        
        if sec46.contains(section) {
            return 46
        } else if section == 1 {
            let res = [1, 2]
            let comm = [3, 4, 5]
            if isResidential && res.contains(row) {
                return 46
            } else if !isResidential && comm.contains(row) {
                return 46
            } else if row == 0 {
                return 46
            }
            return 0
        } else if section == 7 {
            return 130
        }
        return 60
    }
    
    // MARK: Actions -
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        self.popViewController()
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        
        let params: Parameters = ["company_id": App.shared.companyId,
                                  "notify_email": btnEmailNotification.isSelected,
                                  "notify_sms": btnSmsNotification.isSelected,
                                  "notify_residential_when_scheduling": btnNotifyResCustomerWhenScheduling.isSelected,
                                  "notify_residential_during_rescheduling_cancelling": btnNotifyResCustomerWhenCancelling.isSelected,
                                  "set_default_commercial_value_as_residential": btnSetDefaultValueAsResidential.isSelected,
                                  "notify_commercial_when_scheduling": btnNotifyCommCustomerWhenScheduling.isSelected,
                                  "notify_commercial_during_rescheduling_cancelling": btnNotifyCommCustomerWhenCancelling.isSelected,
                                  "customer_reminder_notification": customerReminderNotificationField.text!,
                                  "customer_first_heads_up_notification": customerReminderFirstHeadsupField.text!,
                                  "customer_second_heads_up_notification": customerReminderSecondHeadsupField.text!,
                                  "business_reminder_notification": businessReminderNotificationField.text!,
                                  "task_reminder_notification": taskReminderNotificationField.text!,
                                  "copy_when_sending_estimate": btnCopyEstimateToMe.isSelected,
                                  "copy_when_sending_invoice": btnCopyInvoiceToMe.isSelected,
                                  "notify_when_employees_arrive": btnNotifyEmployeeOnWork.isSelected,
                                  "notify_tenant_from_service_address": btnNotifyTenantWhenScheduling.isSelected]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show()
        App.shared.api.putNotificationSetting(params) { (success, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard success == true else {
                return SVProgressHUD.showError(withStatus: "Saving data failed!")
            }
            
            SVProgressHUD.showSuccess(withStatus: "Settings has been saved!")
        }
    }

}
