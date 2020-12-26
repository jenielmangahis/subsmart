//
//  ScheduleController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 12/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Floaty
import FontAwesome_swift
import FSCalendar
import SideMenu
import SVProgressHUD

class ScheduleController: UIViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var menuButtonItem: UIBarButtonItem!
    @IBOutlet var homeButtonItem: UIBarButtonItem!
    @IBOutlet var chatButtonItem: UIBarButtonItem!
    @IBOutlet var inboxButtonItem: UIBarButtonItem!
    @IBOutlet var tableView: UITableView!
    @IBOutlet var calendar: FSCalendar!
    
    var indicator = UIActivityIndicatorView()
    var refreshControl = UIRefreshControl()
    var floaty = Floaty()
    
    var items: [Any] = []
    var filteredItems: [Any] = []
    var groupedItems: [Object] = []
    var calGroupedItems: [Object] = []
    
    struct Object {
        var group: String
        var item: [Any]
    }
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initNavBar()
        initCalendar()
        setupIndicator()
        setupRefreshControl()
        initFAB()
    }
    
    override func viewWillAppear(_ animated: Bool) {
        self.parent?.title = "Schedule"
        loadData()
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Load data -
    
    func loadData() {
        // clear items
        self.items.removeAll()
        
        //SVProgressHUD.show(withStatus: "Loading...")
        
        // create group
        let group = DispatchGroup()
        
        // call api
        group.enter()
        App.shared.api.getEvents() { (list, error) in
            if let e = error {
                group.leave()
                return //self.addErrorView(with: e)
            }
            
            self.items.append(contentsOf: list)
            group.leave()
        }
        
        // call api
        group.enter()
        App.shared.api.getWorkOrders() { (list, error) in
            if let e = error {
                group.leave()
                return //self.addErrorView(with: e)
            }
            
            // filter scheduled and invoiced
            let filteredItems = list.filter({ item in
                return (item.status == "Scheduled" || item.status == "Invoiced")
            })
            self.items.append(contentsOf: filteredItems)
            
            group.leave()
        }
        
        group.notify(queue: DispatchQueue.main, execute: {
            self.processData(Date().toString(format: DateHelper.dateFormatType))
        })
    }
    
    func processData(_ date: String) {
        // filter
        filteredItems = items.filter({ item in
            return ((item as AnyObject).start_date.contains(date) ||
                (item as AnyObject).end_date.contains(date))
        })
        
        // sort ungrouped
        let ungrouped: [Any] = filteredItems.sorted(by: {($0 as AnyObject).start_date > ($1 as AnyObject).start_date})
        // group
        let grouped = ungrouped.group(by: {($0 as AnyObject).start_date!})
        // sort
        let sorted = grouped.sorted(by: {$0.key < $1.key})
        // create temp groupedObjects
        var tempGroupedObjects = [Object]()
        // iterate
        for (key, value) in sorted {
            tempGroupedObjects.append(Object(group: String(key), item: value))
        }
        
        // for calendar dots
        // sort ungrouped
        let ungrouped2: [Any] = items.sorted(by: {($0 as AnyObject).start_date > ($1 as AnyObject).start_date})
        // group
        let grouped2 = ungrouped2.group(by: {($0 as AnyObject).start_date!})
        // sort
        let sorted2 = grouped2.sorted(by: {$0.key < $1.key})
        // create temp groupedObjects
        var tempGroupedObjects2 = [Object]()
        // iterate
        for (key, value) in sorted2 {
            tempGroupedObjects2.append(Object(group: String(key), item: value))
        }
        
        self.groupedItems = tempGroupedObjects
        self.calGroupedItems = tempGroupedObjects2
        self.tableView.backgroundView = nil
        self.tableView.reloadData()
        self.calendar.reloadData()
        self.refreshControl.endRefreshing()
        SVProgressHUD.dismiss()
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
            self.tableView.backgroundView?.addSubview(self.errorView)
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
        if self.tableView.backgroundView == nil || !self.tableView.backgroundView!.subviews.contains(errorView) {
            return
        }
        DispatchQueue.main.async {
            self.errorView.removeFromSuperview()
        }
    }
    
    // MARK: - Navigation Bar -
    
    func initNavBar() {
        // setup navBar icons
        menuButtonItem.image = UIImage.fontAwesomeIcon(name: .bars, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        homeButtonItem.image = UIImage.fontAwesomeIcon(name: .home, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        chatButtonItem.image = UIImage.fontAwesomeIcon(name: .comments, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        inboxButtonItem.image = UIImage.fontAwesomeIcon(name: .envelope, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        
        // setup SideMenu
        SideMenuManager.default.leftMenuNavigationController = storyboard?.instantiateViewController(withIdentifier: "sb_SideMenu") as? SideMenuNavigationController
        SideMenuManager.default.rightMenuNavigationController = nil
        SideMenuManager.default.addPanGestureToPresent(toView: self.navigationController!.navigationBar)
        SideMenuManager.default.addScreenEdgePanGesturesToPresent(toView: self.navigationController!.view)
        SideMenuManager.default.leftMenuNavigationController?.statusBarEndAlpha = 0
        
        // set title
        self.navigationItem.title = "Schedule"
    }
    
    // MARK: - Activity Indicator -
    
    func setupIndicator() {
        // init activity indicator
        self.indicator = UIActivityIndicatorView(frame: CGRect(x: 0, y: 0, width: 40, height: 40))
        self.indicator.style = UIActivityIndicatorView.Style.medium
        self.indicator.center = self.tableView.center
        self.view.addSubview(indicator)
        self.tableView.backgroundView = indicator
        self.indicator.startAnimating()
    }
    
    // MARK: - Refresh Control -
    
    func setupRefreshControl() {
        // init refresh control
        self.tableView.refreshControl = refreshControl
        self.refreshControl.addTarget(self, action: #selector(refreshData(_:)), for: .valueChanged)
        self.refreshControl.attributedTitle = NSAttributedString(string: "Fetching Data ...")
    }
    
    @objc func refreshData(_ sender: Any) {
        self.removeErrorView()
        self.loadData()
    }
    
    // MARK: - Action -

    @IBAction func sideMenuTapped(_ sender: Any) {
        self.present(SideMenuManager.default.leftMenuNavigationController!, animated: true, completion: nil)
    }
    
    @IBAction func homeButtonTapped(_ sender: Any) {
        App.shared.selectedMenu = .Home
        NotificationCenter.default.post(name: Notifications.didSwitchLeftMenu, object: self, userInfo: nil)
    }
    
    @IBAction func chatButtonTapped(_ sender: Any) {
        App.shared.selectedMenu = .Chat
        NotificationCenter.default.post(name: Notifications.didSwitchLeftMenu, object: self, userInfo: nil)
    }
    
    @IBAction func messagesButtonTapped(_ sender: Any) {
        App.shared.selectedMenu = .Messages
        NotificationCenter.default.post(name: Notifications.didSwitchLeftMenu, object: self, userInfo: nil)
    }

}

// MARK: - TableView Datasource -

extension ScheduleController: UITableViewDelegate, UITableViewDataSource {
    
    func numberOfSections(in tableView: UITableView) -> Int {
        return groupedItems.count
    }
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return groupedItems[section].item.count
    }
    
    func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        let item = groupedItems[indexPath.section].item[indexPath.row] as AnyObject
        // check if event, block or work order
        if item.event_type == "Event" || item.event_type == "Block" {
            return 155
        }
        return 205
    }
    
    func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 32
    }
    
    func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        return 1
    }
    
    func tableView(_ tableView: UITableView, viewForHeaderInSection section: Int) -> UIView? {
        return Utils.createHeader(App.shared.headerBgColor, App.shared.headerColor, groupedItems[section].group.toReadableDate)
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let item = groupedItems[indexPath.section].item[indexPath.row] as AnyObject
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        
        // remove other views
        cell.contentView.subviews.forEach {
            $0.removeFromSuperview()
        }
        
        // check if event, block or work order
        if item.event_type == "Event" || item.event_type == "Block" {
            // add schedule color
            let eventColor = UIView(frame: CGRect(x: 0, y: 0, width: 7, height: 200))
            eventColor.backgroundColor = UIColor(hex: item.event_color)
            cell.contentView.addSubview(eventColor)
            
            // nameButton
            let nameButton = Utils.createPurpleButton(28, 12, Int(Device.width-40), item.event_description, hasArrow: true)
            cell.contentView.addSubview(nameButton)
            
            // topLeft view
            let topLeft = Utils.createView(20, 50, Int((Device.width-40)/2), 50, "START / END TIME", item.start_time + " - " + item.end_time, [.top, .right])
            cell.contentView.addSubview(topLeft)
            
            // topRight view
            let topRight = Utils.createView(Int(Device.width/2), 50, Int((Device.width-40)/2), 50, "EMPLOYEES", item.employee_name, [.top])
            cell.contentView.addSubview(topRight)
            
            // dateLabel
            let dateLabel = Utils.createView(20, 100, Int(Device.width-40), 50, "CREATED BY", item.created_by_name, [.top])
            cell.contentView.addSubview(dateLabel)
            
            // bottom border
            let bottomBorder = Utils.createBottomBorder(150)
            cell.contentView.addSubview(bottomBorder)
            
        } else {
            // add schedule color
            let eventColor = UIView(frame: CGRect(x: 0, y: 0, width: 7, height: 200))
            eventColor.backgroundColor = UIColor(hex: item.event_color)
            cell.contentView.addSubview(eventColor)
            
            // nameButton
            let nameButton = Utils.createPurpleButton(28, 12, Int(Device.width-40), item.job_name, hasArrow: true)
            cell.contentView.addSubview(nameButton)
            
            // topLeft view
            let topLeft = Utils.createView(20, 50, Int((Device.width-40)/2), 50, "DATE ISSUED", item.date_issued.toReadableDate, [.top, .right])
            cell.contentView.addSubview(topLeft)
            
            // topRight view
            let topRight = Utils.createView(Int(Device.width/2), 50, Int((Device.width-40)/2), 50, "EMPLOYEES", item.employee_name, [.top])
            cell.contentView.addSubview(topRight)
            
            // bottomLeft view
            let bottomLeft = Utils.createView(20, 100, Int((Device.width-40)/2), 50, "PRIORITY", item.priority, [.top, .right])
            cell.contentView.addSubview(bottomLeft)
            
            // bottomRight view
            let bottomRight = Utils.createView(Int(Device.width/2), 100, Int((Device.width-40)/2), 50, "STATUS", "Scheduled", [.top])
            cell.contentView.addSubview(bottomRight)
            
            // dateLabel
            let dateLabel = Utils.createView(20, 150, Int(Device.width-40), 50, "START / END TIME", item.start_time + " - " + item.end_time, [.top])
            cell.contentView.addSubview(dateLabel)
            
            // bottom border
            let bottomBorder = Utils.createBottomBorder(200)
            cell.contentView.addSubview(bottomBorder)
        }
        
        return cell
    }
    
    func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        let item = groupedItems[indexPath.section].item[indexPath.row] as AnyObject
        
        // check if event, block or work order
        if item.event_type == "Event" {
            App.shared.selectedEvent = item as? Event
            self.pushTo(storyBoard: "Main", identifier: "sb_ScheduleTabController")
        } else if item.event_type == "Block" {
            App.shared.selectedEvent = item as? Event
            self.pushTo(storyBoard: "Main", identifier: "sb_BlockDetailController")
        } else {
            App.shared.selectedWorkOrder = item as? WorkOrder
            self.pushTo(storyBoard: "Main", identifier: "sb_WorkOrderTabController")
        }
    }
}

// MARK: - Floaty Delegate -

extension ScheduleController: FloatyDelegate {
    
    func initFAB() {
        
        // init
        floaty.fabDelegate  = self
        floaty.sticky       = true
        floaty.buttonColor  = .greenColor
        floaty.buttonImage  = UIImage.fontAwesomeIcon(name: .plus, style: .solid, textColor: .white, size: CGSize(width: 30, height: 30))
        floaty.addItem("Settings", icon: UIImage.fontAwesomeIcon(name: .cog, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            self.pushTo(storyBoard: "Settings", identifier: "sb_ScheduleSettingsController")
            self.floaty.close()
        })
        floaty.addItem("Assign New Lead", icon: UIImage.fontAwesomeIcon(name: .clipboardCheck, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            self.pushTo(storyBoard: "Main", identifier: "sb_AddLeadController")
            self.floaty.close()
        })
        floaty.addItem("New Workorder", icon: UIImage.fontAwesomeIcon(name: .edit, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            self.pushTo(storyBoard: "Main", identifier: "sb_AddWorkOrderController")
            self.floaty.close()
        })
        floaty.addItem("New Event", icon: UIImage.fontAwesomeIcon(name: .calendarCheck, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
        self.pushTo(storyBoard: "Main", identifier: "sb_AddEventController")
        self.floaty.close()
        })
        floaty.addItem("Block Time", icon: UIImage.fontAwesomeIcon(name: .calendarMinus, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
        self.pushTo(storyBoard: "Main", identifier: "sb_AddBlockTimeController")
        self.floaty.close()
        })
        
        self.view.addSubview(floaty)
    }
}

// MARK: - FSCalendar Datasource -

extension ScheduleController: FSCalendarDataSource, FSCalendarDelegate, FSCalendarDelegateAppearance {
    
    // MARK: - Calendar -
    
    func initCalendar() {
        // init calendar
        calendar.calendarHeaderView.backgroundColor     = .clear
        calendar.calendarWeekdayView.backgroundColor    = .clear
        calendar.appearance.headerTitleColor            = AppTheme.defaultColor
        calendar.appearance.headerTitleFont             = UIFont.robotoBoldFont(ofSize: 15)
        calendar.appearance.headerMinimumDissolvedAlpha = 0
        calendar.appearance.weekdayTextColor            = AppTheme.defaultLinkColor
        calendar.appearance.weekdayFont                 = UIFont.robotoBoldFont(ofSize: 13)
        calendar.appearance.borderDefaultColor          = .clear
        calendar.appearance.borderSelectionColor        = .clear
        calendar.appearance.selectionColor              = AppTheme.defaultLinkColor
        calendar.appearance.separators                  = .none
        calendar.appearance.titleFont                   = UIFont.robotoFont(ofSize: 13)
        calendar.appearance.titleTodayColor             = .white
        calendar.appearance.titleSelectionColor         = .white
        calendar.appearance.todayColor                  = AppTheme.defaultColor
        calendar.appearance.todaySelectionColor         = AppTheme.defaultColor
        calendar.appearance.eventDefaultColor           = AppTheme.defaultColor
        calendar.appearance.eventSelectionColor         = AppTheme.defaultLinkColor
        
        // calendar button
        let prevButton = UIButton(type: .custom)
        prevButton.frame = CGRect(x: 10, y: 18, width: 15, height: 22)
        prevButton.backgroundColor = UIColor.clear
        prevButton.setImage(UIImage.fontAwesomeIcon(name: .chevronLeft
            , style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 16, height: 16)), for: .normal)
        prevButton.addTarget(self, action: #selector(previousButtonClicked(_:)), for: .touchUpInside)
        calendar.addSubview(prevButton)
        
        let nextButton = UIButton(type: .custom)
        nextButton.frame = CGRect(x: self.view.frame.width - 25, y: 18, width: 15, height: 22)
        nextButton.backgroundColor = UIColor.clear
        nextButton.setImage(UIImage.fontAwesomeIcon(name: .chevronRight
        , style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 16, height: 16)), for: .normal)
        nextButton.addTarget(self, action: #selector(nextButtonClicked(_:)), for: .touchUpInside)
        calendar.addSubview(nextButton)
    }
    
    @objc func previousButtonClicked(_ sender: Any) {
        let currentMonth: Date = calendar.currentPage
        let previousMonth: Date = Calendar.current.date(byAdding: .month, value: -1, to: currentMonth)!
        calendar.setCurrentPage(previousMonth, animated: true)
    }
    
    @objc func nextButtonClicked(_ sender: Any) {
        let currentMonth: Date = calendar.currentPage
        let nextMonth: Date = Calendar.current.date(byAdding: .month, value: 1, to: currentMonth)!
        calendar.setCurrentPage(nextMonth, animated: true)
    }
    
    func calendarCurrentPageDidChange(_ calendar: FSCalendar) {
        
    }
    
    func calendar(_ calendar: FSCalendar, numberOfEventsFor date: Date) -> Int {
        // calendar date
        let dateString = App.shared.dateFormatter.string(from: date)
        
        // iterate
        for group in calGroupedItems {
            // get date string
            let groupDate = group.group
            
            // check
            if dateString == groupDate && group.item.count > 1 {
                return 3
            } else if dateString == groupDate && group.item.count == 1 {
                return 1
            }
        }
        
        return 0
    }
    
    func calendar(_ calendar: FSCalendar, didSelect date: Date, at monthPosition: FSCalendarMonthPosition) {
        self.processData(date.toString(format: DateHelper.dateFormatType))
    }
}
