//
//  ScheduleSettingsController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 03/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import DLRadioButton
import EventKit
import GoogleSignIn
import GoogleAPIClientForREST
import SVProgressHUD

class ScheduleSettingsController: UITableViewController {

    // MARK: - Properties -
    
    @IBOutlet var timezoneField: MaterialDropdownField!
    @IBOutlet var btnAutoSyncICloudCalendar: DLRadioButton!
    @IBOutlet var btnAutoSyncGoogleCalendar: DLRadioButton!
    @IBOutlet var btnAutoSyncOutlookCalendar: DLRadioButton!
    @IBOutlet var btnDisplayColorCode: DLRadioButton!
    @IBOutlet var btnCustomerDetails: DLRadioButton!
    @IBOutlet var btnJobDetails: DLRadioButton!
    @IBOutlet var btnJobPrice: DLRadioButton!
    @IBOutlet var btnAutoSyncOffline: DLRadioButton!
    
    let googleCalendarService = GTLRCalendarService()
    var googleUser: GIDGoogleUser?
    var events: [GTLRCalendar_Event] = []
    
    var item: EventSetting?
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
        loadData()
                
        self.title = "Schedule Settings"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Load data -
    
    func loadData() {
        // call api
        SVProgressHUD.show(withStatus: "Loading...")
        App.shared.api.getEventSetting() { (item, error) in
            SVProgressHUD.dismiss()
            if let e = error {
                return SVProgressHUD.showError(withStatus: e.localizedDescription)
            }
            
            self.item                                   = item
            self.btnAutoSyncICloudCalendar.isSelected   = item?.auto_sync_icloud_cal ?? false
            self.btnAutoSyncGoogleCalendar.isSelected   = item?.auto_sync_google_cal ?? false
            self.btnAutoSyncOutlookCalendar.isSelected  = item?.auto_sync_outlook_cal ?? false
            self.btnDisplayColorCode.isSelected         = item?.display_color_codes ?? true
            self.btnCustomerDetails.isSelected          = item?.display_customer_info ?? true
            self.btnJobDetails.isSelected               = item?.display_job_info ?? true
            self.btnJobPrice.isSelected                 = item?.display_job_price ?? true
            self.btnAutoSyncOffline.isSelected          = item?.auto_sync_offline ?? false
            
            self.timezoneField.setSelectedOption(option: item?.timezone)
        }
    }
    
    // MARK: - Functions -
    
    func initViews() {
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
        
        timezoneField.updateOptions(options: ["Hawaii Time (UTC -10)", "Hawaii Daylight Time (UTC -9)", "Alaska Time (UTC -8)", "Pacific Time (UTC -7)", "Arizona Time (UTC -7)", "Mountain Time (UTC -6)", "Central Time (UTC -5)", "Eastern Time (UTC -4)"])
        
        btnAutoSyncICloudCalendar.configure()
        btnAutoSyncGoogleCalendar.configure()
        btnAutoSyncOutlookCalendar.configure()
        btnDisplayColorCode.configure()
        
        btnCustomerDetails.configure()
        btnJobDetails.configure()
        btnJobPrice.configure()
        
        btnAutoSyncOffline.configure()
        
    }
    
    // MARK: - EKEventStore -
    
    func initEKEventStore() {
        // 1
        let eventStore = EKEventStore()
        // 2
        switch EKEventStore.authorizationStatus(for: .event) {
            case .authorized:
                self.getCalendars(for: eventStore)
            case .denied:
                print("Access denied")
            case .notDetermined:
            // 3
                eventStore.requestAccess(to: .event, completion:
                  {[weak self] (granted: Bool, error: Error?) -> Void in
                    if granted {
                        self?.getCalendars(for: eventStore)
                    } else {
                        print("Access denied")
                    }
                })
            default:
                print("Case default")
        }
    }
    
    func getCalendars(for eventStore: EKEventStore) {
        // get event store
        let eventStore = EKEventStore()
        // get calendars
        let calendars = eventStore.calendars(for: .event)
        
        var array: [String] = []

        // iterate
        for calendar in calendars {
            array.append(calendar.title)
        }
        
        DispatchQueue.main.async {
            if let vc = self.storyboard?.instantiateViewController(withIdentifier: "sb_SelectCalendarController")  as? SelectCalendarController {
                vc.list = array
                vc.callback = { calendar in
                    self.getEvents(for: calendar)
                }
                self.navigationController?.pushViewController(vc, animated: true)
            }
        }
    }
    
    func getEvents(for mCalendar: String) {
        // save selected Calendar to UserDefaults
        UserDefaults.standard.set(mCalendar, forKey: "SELECTED_ICLOUD_CALENDAR")
        UserDefaults.standard.synchronize()
        
        // get event store
        let eventStore = EKEventStore()
        // get calendars
        let calendars = eventStore.calendars(for: .event)

        // iterate
        for calendar in calendars {
            // check
            if calendar.title == mCalendar {
                // get dates
                let oneMonthAgo = Calendar.current.date(byAdding: .month, value: -1, to: Date())!
                let threeMonthsAfter = Calendar.current.date(byAdding: .month, value: 3, to: Date())!

                let predicate = eventStore.predicateForEvents(withStart: oneMonthAgo, end: threeMonthsAfter, calendars: [calendar])
                let events = eventStore.events(matching: predicate)
                
                let group = DispatchGroup()
                
                // get all events to check
                App.shared.api.getEvents() { (list, error) in
                    if let e = error {
                        return print(e.localizedDescription)
                    }
                    
                    // filter my events
                    let myEvents = list.filter({ item in
                        return (item.employee_id == App.shared.user!.id)
                    })
                    
                    // iterate list
                    for item in myEvents {
                        // event detail
                        let title       = item.event_description
                        let startDate   = Date(fromString: item.start_date + " " + item.start_time, format: DateHelper.dateTime2FormatType)!
                        let endDate     = Date(fromString: item.end_date + " " + item.end_time, format: DateHelper.dateTime2FormatType)!
                        
                        // filter to look for match
                        let filteredItems = events.filter({ item in
                            return (item.startDate == startDate &&
                                    item.endDate == endDate &&
                                    item.title.contains(title))
                        })
                        
                        // check if empty
                        if filteredItems.count == 0 {
                            // enter group
                            group.enter()
                            
                            // save to icloud
                            let event: EKEvent = EKEvent(eventStore: eventStore)
                            event.title = item.event_description
                            event.startDate = Date(fromString: item.start_date + " " + item.start_time, format: DateHelper.dateTime2FormatType)!
                            event.endDate = Date(fromString: item.end_date + " " + item.end_time, format: DateHelper.dateTime2FormatType)!
                            event.calendar = calendar
                              
                            do {
                                try eventStore.save(event, span: .thisEvent)
                            } catch let error as NSError {
                                print("failed to save event with error : \(error)")
                            }
                        }
                    }
                    
                    
                    // iterate events
                    /*for event in events {
                        // event detail
                        let title       = event.title!
                        let startDate   = App.shared.dateFormatter.string(from: event.startDate)
                        let startTime   = App.shared.timeFormatter.string(from: event.startDate).lowercased()
                        let endDate     = App.shared.dateFormatter.string(from: event.endDate)
                        let endTime     = App.shared.timeFormatter.string(from: event.endDate).lowercased()
                        
                        // filter to look for match
                        let filteredItems = list.filter({ item in
                            return (item.start_date == startDate &&
                                    item.start_time == startTime &&
                                    item.end_date == endDate &&
                                    item.end_time == endTime &&
                                    item.event_description == title &&
                                    item.employee_id == App.shared.user!.id)
                        })
                        
                        // check if empty
                        if filteredItems.count == 0 && !title.isEmpty {
                            // enter group
                            group.enter()
                            
                            // save to remote db
                            let params: Parameters = ["company_id": App.shared.companyId,
                                                      "customer_id": 0,
                                                      "event_description": title,
                                                      "employee_id": App.shared.user?.id ?? "0",
                                                      "start_date": startDate,
                                                      "start_time": startTime,
                                                      "end_date": endDate,
                                                      "end_time": endTime,
                                                      "event_color": EventColor.colors[0],
                                                      "customer_reminder_notification": "1 day before",
                                                      "instructions": ""]
                            
                            SVProgressHUD.setDefaultMaskType(.clear)
                            SVProgressHUD.show(withStatus: "Syncing...")
                            App.shared.api.postEvent(params) { (result, error) in
                                SVProgressHUD.setDefaultMaskType(.none)
                                SVProgressHUD.dismiss()
                                group.leave()
                                guard error == nil else {
                                    return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                                }
                                guard result?.Code == 200 else {
                                    return SVProgressHUD.showError(withStatus: result!.Message)
                                }
                                
                                SVProgressHUD.showSuccess(withStatus: "Data has been saved!")
                            }
                        }
                    }*/
                }
            }
        }
    }
    
    // MARK: - Outlook Calendar -
    
    func initOutlookCalendar() {
        
    }
    
    // MARK: - Actions -
    
    @IBAction func syncToiCloudButtonTapped(_ sender: DLRadioButton) {
        guard sender.isSelected == true else {
            return
        }
        
        initEKEventStore()
    }
    
    @IBAction func syncToGoogleButtonTapped(_ sender: DLRadioButton) {
        guard sender.isSelected == true else {
            return
        }
        
        initGCalendar()
    }
    
    @IBAction func syncToOutlookButtonTapped(_ sender: DLRadioButton) {
        guard sender.isSelected == true else {
            return
        }
        
    }
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        self.popViewController()
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        
        let params: Parameters = ["company_id": App.shared.companyId,
                                  "timezone": timezoneField.text!,
                                  "auto_sync_icloud_cal": btnAutoSyncICloudCalendar.isSelected,
                                  "auto_sync_google_cal": btnAutoSyncGoogleCalendar.isSelected,
                                  "auto_sync_outlook_cal": btnAutoSyncOutlookCalendar.isSelected,
                                  "display_color_codes": btnDisplayColorCode.isSelected,
                                  "display_customer_info": btnCustomerDetails.isSelected,
                                  "display_job_info": btnJobDetails.isSelected,
                                  "display_job_price": btnJobPrice.isSelected,
                                  "auto_sync_offline": btnAutoSyncOffline.isSelected]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show()
        App.shared.api.putEventSetting(params) { (success, error) in
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

// MARK: - GIDSignInDelegate -

extension ScheduleSettingsController: GIDSignInDelegate {
    
    func initGCalendar() {
        /***** Configure Google Sign In *****/
        GIDSignIn.sharedInstance()?.delegate = self
        GIDSignIn.sharedInstance()?.presentingViewController = self
        GIDSignIn.sharedInstance()?.scopes = [kGTLRAuthScopeCalendar, kGTLRAuthScopeDrive]
        GIDSignIn.sharedInstance()?.signIn()
    }
    
    func getCalendarList(onCompleted: @escaping (GTLRCalendar_CalendarList?, Error?) -> ()) {
        let query = GTLRCalendarQuery_CalendarListList.query()
        
        self.googleCalendarService.executeQuery(query, completionHandler: { (ticket, result, error) in
            onCompleted(result as? GTLRCalendar_CalendarList, error)
        })
    }
    
    func getEvents(_ calendarId: String = "primary", onCompleted: @escaping (GTLRCalendar_Events?, Error?) -> ()) {
        let previousMonth = Calendar.current.date(byAdding: .month, value: -1, to: Date())!
        let nextThreeMonth = Calendar.current.date(byAdding: .month, value: 3, to: Date())!
        // You can pass start and end dates with function parameters
        let startDateTime = GTLRDateTime(date: previousMonth)
        let endDateTime = GTLRDateTime(date: nextThreeMonth)

        let eventsListQuery = GTLRCalendarQuery_EventsList.query(withCalendarId: calendarId)
        eventsListQuery.timeMin = startDateTime
        eventsListQuery.timeMax = endDateTime
        
        self.googleCalendarService.executeQuery(eventsListQuery, completionHandler: { (ticket, result, error) in
            onCompleted(result as? GTLRCalendar_Events, error)
        })
    }
    
    func processEvents() {
        self.getEvents(onCompleted: { (result, error) in
            guard error == nil else {
                return print(error?.localizedDescription ?? "")
            }
            
            // check if not nil
            if let items = result?.items {
                // assign
                self.events = items
                
                // iterate
                for item in items {
                    print(item)
                }
            }
        })
    }
    
    func sign(_ signIn: GIDSignIn!, didSignInFor user: GIDGoogleUser!, withError error: Error!) {
        // Have the service object set tickets to fetch consecutive pages
        // of the feed so we do not need to manually fetch them
        self.googleCalendarService.shouldFetchNextPages = true
        // Have the service object set tickets to retry temporary error conditions
        // automatically
        self.googleCalendarService.isRetryEnabled = true
        self.googleCalendarService.maxRetryInterval = 15
        
        // check
        if error == nil {
            // Include authorization headers/values with each Calendar API request.
            self.googleCalendarService.authorizer = user.authentication.fetcherAuthorizer()
            self.googleUser = user
            
            self.processEvents()
        } else {
            self.googleCalendarService.authorizer = nil
            self.googleUser = nil
        }
    }
    
    func sign(_ signIn: GIDSignIn!, didDisconnectWith user: GIDGoogleUser!, withError error: Error!) {
        print(error.localizedDescription)
    }
}

// MARK: - Extensions -

extension Date {
    
    var startOfDay: Date {
        return Calendar.current.startOfDay(for: self)
    }

    var startOfMonth: Date {
        let calendar = Calendar(identifier: .gregorian)
        let components = calendar.dateComponents([.year, .month], from: self)
        return  calendar.date(from: components)!
    }

    var endOfDay: Date {
        var components = DateComponents()
        components.day = 1
        components.second = -1
        return Calendar.current.date(byAdding: components, to: startOfDay)!
    }

    var endOfMonth: Date {
        var components = DateComponents()
        components.month = 1
        components.second = -1
        return Calendar(identifier: .gregorian).date(byAdding: components, to: startOfMonth)!
    }

    func isMonday() -> Bool {
        let calendar = Calendar(identifier: .gregorian)
        let components = calendar.dateComponents([.weekday], from: self)
        return components.weekday == 2
    }
}
