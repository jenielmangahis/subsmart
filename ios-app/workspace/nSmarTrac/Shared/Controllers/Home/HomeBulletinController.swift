//
//  HomeBulletinController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 09/09/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import EventKit

class HomeBulletinController: UITableViewController {
    
    // MARK: - Variables -
    
    var upNext: [Event] = []
    var today: [Any] = []
    var selectedTab: Int = 0
    
    
    
    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        
        self.tableView.tableFooterView = UIView()
        self.setupIndicator()
        self.getEvents()
        self.loadData()
        
        // notification observers
        NotificationCenter.default.addObserver(self, selector: #selector(updateListing(_:)), name: Notifications.willUpdateHomeBulletin, object: nil)
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Load data -
    
    func loadData() {
        // call api
        App.shared.api.getUpNext() { (list, error) in
            if let e = error {
                return self.addErrorView(with: e)
            }
            
            self.upNext = list
            self.tableView.backgroundView = nil
            self.tableView.reloadData()
        }
        
        // call api
        App.shared.api.getMySchedule() { (list, error) in
            if let e = error {
                print(e.localizedDescription)
            }
            
            // sort ungrouped
            let ungrouped: [Any] = list.sorted(by: {($0 as AnyObject).start_date > ($1 as AnyObject).start_date})
            // group
            let grouped = ungrouped.group(by: {($0 as AnyObject).start_date!})
            // sort
            let sorted = grouped.sorted(by: {$0.key < $1.key})
            // assigned
            self.today = sorted
        }
    }
    
    // MARK: - Notification -
    
    @objc func updateListing(_ notification: NSNotification) {
        if let selected = notification.userInfo?["selectedTab"] as? Int {
            
            self.selectedTab = selected
            self.removeErrorView()
            
            // check
            if (selected == 0 && self.upNext.count == 0) ||
                (selected == 1 && self.today.count == 0) {
                self.displayNoListingError()
            }
            
            // reload table
            self.tableView.reloadData()
        }
    }
    
    // MARK: - Activity Indicator -
    
    func setupIndicator() {
        // init activity indicator
        let indicator = UIActivityIndicatorView(frame: CGRect(x: 0, y: 0, width: 40, height: 40))
        indicator.style = UIActivityIndicatorView.Style.medium
        indicator.center = self.view.center
        self.view.addSubview(indicator)
        self.tableView.backgroundView = indicator
        indicator.startAnimating()
    }
    
    // MARK: - ErrorView -

    private lazy var errorView: BasicErrorView = {
        let errorView = BasicErrorView()
        errorView.translatesAutoresizingMaskIntoConstraints = false
        return errorView
    }()
    
    func addErrorView(with error: Error) {
        DispatchQueue.main.async { [weak self] in
            guard let self = self else { return }
            self.view.addSubview(self.errorView)
            let safeAreaLayoutGuide = self.view.safeAreaLayoutGuide
            NSLayoutConstraint.activate([
                self.errorView.leadingAnchor.constraint(equalTo: safeAreaLayoutGuide.leadingAnchor),
                self.errorView.trailingAnchor.constraint(equalTo: safeAreaLayoutGuide.trailingAnchor),
                self.errorView.topAnchor.constraint(equalTo: safeAreaLayoutGuide.topAnchor),
                self.errorView.bottomAnchor.constraint(equalTo: safeAreaLayoutGuide.bottomAnchor)
                ])
            self.errorView.displayError(error)
        }
    }

    func removeErrorView() {
        if !view.subviews.contains(errorView) {
            return
        }
        DispatchQueue.main.async {
            self.errorView.removeFromSuperview()
        }
    }
    
    // MARK: - Functions -
    
    func displayNoListingError() {
        let userInfo = [NSLocalizedDescriptionKey :  NSLocalizedString("Error", value: "No Results found", comment: "")]
        let error = NSError(domain: APIError.domain, code: 201, userInfo: userInfo)
        self.addErrorView(with: error)
    }
    
    
    // MARK: - TableView Datasource -

    override func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    override func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        if selectedTab == 0 {
            return upNext.count
        } else if selectedTab == 1 {
            return today.count
        }
        return 0
    }
    
    override func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 1
    }
    
    override func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        return 1
    }
    
    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        if selectedTab == 0 {
            let item = upNext[indexPath.row]
            
            // get schedule date
            var startDate = item.start_date.getDay + ", " + item.start_date.toReadableDate
            // check start and end date
            if item.start_date == item.end_date {
                startDate += ", " + item.start_time + " - " + item.end_time
            } else {
                startDate += ", " + item.start_time + " - " + item.end_date.getDay + ", " + item.end_date.toReadableDate  + ", " + item.end_time
            }
            
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
            cell.textLabel!.text        = item.event_description
            cell.detailTextLabel!.text  = startDate
            return cell
            
        } else if selectedTab == 1 {
            let item = today[indexPath.row] as AnyObject
            
            // get schedule date
            var startDate = item.start_date.getDay + ", " + item.start_date.toReadableDate
            // check start and end date
            if item.start_date == item.end_date {
                startDate += ", " + item.start_time + " - " + item.end_time
            } else {
                startDate += ", " + item.start_time + " - " + item.end_date.getDay + ", " + item.end_date.toReadableDate  + ", " + item.end_time
            }
            
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
            cell.textLabel!.text        = (item.event_type == "Event" || item.event_type == "Block") ? item.event_description : item.job_name
            cell.detailTextLabel!.text  = startDate
            return cell
        }
        return tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
    }
    
    override func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        var item: Any?
        if selectedTab == 0 {
            item = upNext[indexPath.row]
        } else {
            item = today[indexPath.row]
        }
        NotificationCenter.default.post(name: Notifications.willOpenBulletinLink, object: self, userInfo: ["type": selectedTab, "item": item!])
    }

}

extension HomeBulletinController {
    
    // MARK: - EKEventStore -
    
    func getEvents() {
        // get icloud calendar name
        if let mCalendar = UserDefaults.standard.string(forKey: "SELECTED_ICLOUD_CALENDAR") {
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
                    
                    //let group = DispatchGroup()
                    
                    // get all events to check
                    App.shared.api.getEvents() { (list, error) in
                        if let e = error {
                            // check
                            if e.localizedDescription == "No Results found" {
                                
                            } else {
                                return print(e.localizedDescription)
                            }
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
                                                          "employee_id": App.shared.user!.id,
                                                          "start_date": startDate,
                                                          "start_time": startTime,
                                                          "end_date": endDate,
                                                          "end_time": endTime,
                                                          "event_color": EventColor.colors[0],
                                                          "customer_reminder_notification": "1 day before",
                                                          "instructions": "",
                                                          "created_by": App.shared.user!.id]
                                
                                App.shared.api.postEvent(params) { (result, error) in
                                    group.leave()
                                    guard error == nil else {
                                        return print(error?.localizedDescription as Any)
                                    }
                                    guard result?.Code == 200 else {
                                        return print(result!.Message as Any)
                                    }
                                }
                            }
                        }*/
                    }
                    
                    /*group.notify(queue: DispatchQueue.main, execute: {
                        self.loadData()
                    })*/
                }
            }
        }
    }
}
