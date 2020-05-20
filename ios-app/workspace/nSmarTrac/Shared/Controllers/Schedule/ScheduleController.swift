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

class ScheduleController: UIViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var menuButtonItem: UIBarButtonItem!
    @IBOutlet var chatButtonItem: UIBarButtonItem!
    @IBOutlet var inboxButtonItem: UIBarButtonItem!
    @IBOutlet var tableView: UITableView!
    @IBOutlet var calendar: FSCalendar!
    
    var indicator = UIActivityIndicatorView()
    var refreshControl = UIRefreshControl()
    var floaty = Floaty()
    
    //var invoices: [Invoice] = []
    //var filteredItems: [Invoice] = []
    var selectedIndexPath: [IndexPath] = []
    var isFiltered: Bool = false
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initNavBar()
        initCalendar()
        initFAB()
    }
    
    override func viewWillAppear(_ animated: Bool) {
        self.selectedIndexPath.removeAll()
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Navigation Bar -
    
    func initNavBar() {
        // setup navBar icons
        menuButtonItem.image = UIImage.fontAwesomeIcon(name: .bars
            , style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
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
        self.indicator.style = UIActivityIndicatorView.Style.gray
        self.indicator.center = self.view.center
        self.view.addSubview(indicator)
        self.tableView.backgroundView = indicator
        //self.indicator.startAnimating()
    }
    
    // MARK: - Refresh Control -
    
    func setupRefreshControl() {
        // init refresh control
        self.tableView.refreshControl = refreshControl
        self.refreshControl.addTarget(self, action: #selector(refreshData(_:)), for: .valueChanged)
        self.refreshControl.attributedTitle = NSAttributedString(string: "Fetching Data ...")
    }
    
    @objc func refreshData(_ sender: Any) {
        
    }
    
    // MARK: - Notification -
    
    @objc func reloadData(_ notification: Notification) {
        self.refreshData(notification)
    }
    
    // MARK: - Action -

    @IBAction func sideMenuTapped(_ sender: Any) {
        self.present(SideMenuManager.default.leftMenuNavigationController!, animated: true, completion: nil)
    }

}

// MARK: - UISideMenuNavigationControllerDelegate -

extension ScheduleController: SideMenuNavigationControllerDelegate {
    
    func sideMenuWillAppear(menu: SideMenuNavigationController, animated: Bool) {
    }
    
    func sideMenuDidAppear(menu: SideMenuNavigationController, animated: Bool) {
    }
    
    func sideMenuWillDisappear(menu: SideMenuNavigationController, animated: Bool) {
    }
    
    func sideMenuDidDisappear(menu: SideMenuNavigationController, animated: Bool) {
    }
    
}

// MARK: - TableView Datasource -

extension ScheduleController: UITableViewDelegate, UITableViewDataSource {
    
    func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return 2
    }
    
    func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 32
    }
    
    func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        return 1
    }
    func tableView(_ tableView: UITableView, viewForHeaderInSection section: Int) -> UIView? {
        return Utils.createHeader(AppTheme.defaultLightOpaque!, AppTheme.defaultColor, "J")
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        //let item = isFiltered ? filteredItems[indexPath.section] : invoices[indexPath.section]
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        
        // remove other views
        cell.contentView.subviews.forEach {
            $0.removeFromSuperview()
        }
        
        // add schedule color
        let eventColor = UIView(frame: CGRect(x: 0, y: 0, width: 7, height: 200))
        eventColor.backgroundColor = UIColor(rgb: 0x4cb052)
        cell.contentView.addSubview(eventColor)
        
        // nameButton
        let nameButton = Utils.createPurpleButton(28, 12, Int(Device.width-40), "Jane Smith", hasArrow: true)
        nameButton.addTarget(self, action: #selector(didButtonTapped(_:)), for: .touchUpInside)
        nameButton.tag = indexPath.section
        cell.contentView.addSubview(nameButton)
        
        // topLeft view
        let topLeft = Utils.createView(20, 50, Int((Device.width-40)/2), 50, "DATE ISSUED", "May 12, 2020", [.top, .right])
        cell.contentView.addSubview(topLeft)
        
        // topRight view
        let topRight = Utils.createView(Int(Device.width/2), 50, Int((Device.width-40)/2), 50, "EMPLOYEES", "John Doe", [.top])
        cell.contentView.addSubview(topRight)
        
        // bottomLeft view
        let bottomLeft = Utils.createView(20, 100, Int((Device.width-40)/2), 50, "PRIORITY", "Standard", [.top, .right])
        cell.contentView.addSubview(bottomLeft)
        
        // bottomRight view
        let bottomRight = Utils.createView(Int(Device.width/2), 100, Int((Device.width-40)/2), 50, "STATUS", "Scheduled", [.top])
        cell.contentView.addSubview(bottomRight)
        
        // dateLabel
        let dateLabel = Utils.createView(20, 150, Int(Device.width-40), 50, "SCHEDULE ON", "13 May 2020, 2:30 pm to 3:30 pm", [.top])
        cell.contentView.addSubview(dateLabel)
        
        // bottom border
        let bottomBorder = Utils.createBottomBorder(200)
        cell.contentView.addSubview(bottomBorder)
        
        // selected
        cell.contentView.backgroundColor = selectedIndexPath.contains(indexPath) ? UIColor(rgb: 0xCDEDB6) : .white
        
        return cell
    }
    
    // MARK: - Protocols -
    
    @objc func didButtonTapped(_ sender: UIButton) {
        self.pushTo(storyBoard: "Main", identifier: "sb_ScheduleTabController")
    }
}

// MARK: - Floaty Delegate -

extension ScheduleController: FloatyDelegate {
    
    func initFAB() {
        
        // init
        floaty.fabDelegate  = self
        floaty.buttonColor  = AppTheme.defaultColor
        floaty.buttonImage  = UIImage.fontAwesomeIcon(name: .plus, style: .solid, textColor: .white, size: CGSize(width: 30, height: 30))
        floaty.addItem("New Workorder", icon: UIImage.fontAwesomeIcon(name: .edit, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
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
        // get date string
        /*let dateString          = App.shared.dateFormatter2.string(from: date)
        // check date existence in array
        let foundInTask         = taskDates.contains(dateString)
        let foundInAlarm        = alarmDates.contains(dateString)
        let foundInReservation  = reservationDates.contains(dateString)
        
        if foundInTask && foundInAlarm && foundInReservation {
            return 3
        }*/
        return 0
    }
    
    func calendar(_ calendar: FSCalendar, didSelect date: Date, at monthPosition: FSCalendarMonthPosition) {
        //App.shared.selectedCalendarDate = date
        //NotificationCenter.default.post(name: Notifications.willOpenCalendarDate, object: self, userInfo: nil)
    }
    
    func calendar(_ calendar: FSCalendar, appearance: FSCalendarAppearance, fillDefaultColorFor date: Date) -> UIColor? {
        // get date string
        /*let dateString          = App.shared.dateFormatter2.string(from: date)
        // check date existence in array
        let foundInTask         = taskDates.contains(dateString)
        let foundInAlarm        = alarmDates.contains(dateString)
        let foundInReservation  = reservationDates.contains(dateString)
        
        // filter
        if foundInTask && foundInAlarm && foundInReservation {
            return appearance.todayColor
        } else if foundInTask {
            return UIColor(rgb: 0x55D671)
        } else if foundInAlarm {
            return UIColor(rgb: 0xFF9042)
        } else if foundInReservation {
            return UIColor(rgb: 0x2D89DC)
        }*/
        
        return nil
    }
    
    func calendar(_ calendar: FSCalendar, appearance: FSCalendarAppearance, fillSelectionColorFor date: Date) -> UIColor? {
        // get date string
        /*let dateString          = App.shared.dateFormatter2.string(from: date)
        // check date existence in array
        let foundInTask         = taskDates.contains(dateString)
        let foundInAlarm        = alarmDates.contains(dateString)
        let foundInReservation  = reservationDates.contains(dateString)
        
        // filter
        if foundInTask && foundInAlarm && foundInReservation {
            return appearance.todaySelectionColor
        } else if foundInTask {
            return UIColor(rgb: 0x55D671)
        } else if foundInAlarm {
            return UIColor(rgb: 0xFF9042)
        } else if foundInReservation {
            return UIColor(rgb: 0x2D89DC)
        }*/
        
        return appearance.selectionColor
    }
    
    func calendar(_ calendar: FSCalendar, appearance: FSCalendarAppearance, borderDefaultColorFor date: Date) -> UIColor? {
        // get date string
        /*let dateString          = App.shared.dateFormatter2.string(from: date)
        // check date existence in array
        let foundInTask         = taskDates.contains(dateString)
        let foundInAlarm        = alarmDates.contains(dateString)
        let foundInReservation  = reservationDates.contains(dateString)
        
        // filter
        if foundInTask && foundInAlarm && foundInReservation {
            return UIColor(rgb: 0xC0C0E2)
        }*/
        return appearance.borderDefaultColor
    }
    
    func calendar(_ calendar: FSCalendar, appearance: FSCalendarAppearance, titleDefaultColorFor date: Date) -> UIColor? {
        // get date string
        /*let dateString          = App.shared.dateFormatter2.string(from: date)
        // check date existence in array
        let foundInTask         = Utils.getAllTaskStartDates().contains(dateString)
        let foundInAlarm        = Utils.getAllAlarmDates().contains(dateString)
        let foundInReservation  = Utils.getAllReservationDates().contains(dateString)
        
        // filter
        if foundInTask && foundInAlarm && foundInReservation {
            return appearance.titleDefaultColor
        } else if foundInTask {
            return .white
        } else if foundInAlarm {
            return .white
        } else if foundInReservation {
            return .white
        }*/
        
        return appearance.titleDefaultColor
    }
}
