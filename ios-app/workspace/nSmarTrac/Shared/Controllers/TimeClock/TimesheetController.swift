//
//  TimesheetController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 21/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import AFDateHelper
import Alamofire
import SVProgressHUD

class TimesheetController: UITableViewController {

    // MARK: - Properties -

    @IBOutlet var viewPager: ViewPager!
    @IBOutlet var topTableView: UITableView!

    var thisWeek: [TimesheetTeamMember] = []
    var lastWeek: [TimesheetTeamMember] = []
    var thisMonth: [TimesheetTeamMember] = []
    var lastMonth: [TimesheetTeamMember] = []
    var items: [TimesheetTeamMember] = []


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        setupIndicator()
        setupRefreshControl()
        initPagerView()
        
        // notification observers
        NotificationCenter.default.addObserver(self, selector: #selector(updateTableView(_:)), name: Notifications.willUpdateTimesheet, object: nil)
    }

    override func viewDidAppear(_ animated: Bool) {
        super.viewDidAppear(animated)
        self.parent?.navigationItem.title = "Timesheet"
        viewPager.scrollToPage(index: 0)
        loadData()
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }

    // MARK: - Load data -

    func loadData() {
        // this week
        let startDateOfWeek  = Date().dateFor(.startOfWeek)
        let endDateOfWeek    = Date().dateFor(.endOfWeek)
        
        // get this week
        var startDate = App.shared.dateFormatter.string(from: startDateOfWeek)
        var endDate = App.shared.dateFormatter.string(from: endDateOfWeek)
        
        App.shared.api.getTimesheetForAllMembers(startDate, endDate) { (list, error) in
            if let e = error {
                return print(e.localizedDescription)
            }

            self.thisWeek = list
            self.items = list
            self.viewPager.reloadData()
            self.tableView.backgroundView = nil
            self.tableView.reloadData()
        }
        
        // get last week
        let lastWeekStartDate = startDateOfWeek.adjust(.week, offset: -1)
        let lastWeekEndDate = endDateOfWeek.adjust(.week, offset: -1)
        
        startDate = App.shared.dateFormatter.string(from: lastWeekStartDate)
        endDate = App.shared.dateFormatter.string(from: lastWeekEndDate)
        
        App.shared.api.getTimesheetForAllMembers(startDate, endDate) { (list, error) in
            if let e = error {
                return print(e.localizedDescription)
            }

            self.lastWeek = list
            self.viewPager.reloadData()
        }
        
        // get this month
        startDate = App.shared.dateFormatter.string(from: Date().startOfMonth)
        endDate = App.shared.dateFormatter.string(from: Date().endOfMonth)
        
        App.shared.api.getTimesheetForAllMembers(startDate, endDate) { (list, error) in
            if let e = error {
                return print(e.localizedDescription)
            }

            self.thisMonth = list
            self.viewPager.reloadData()
        }
        
        // get last month
        let lastMonthDate = Date().adjust(.month, offset: -1)
        
        startDate = App.shared.dateFormatter.string(from: lastMonthDate.startOfMonth)
        endDate = App.shared.dateFormatter.string(from: lastMonthDate.endOfMonth)
        
        App.shared.api.getTimesheetForAllMembers(startDate, endDate) { (list, error) in
            if let e = error {
                return print(e.localizedDescription)
            }

            self.lastMonth = list
            self.viewPager.reloadData()
        }
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
    
    // MARK: - Refresh Control -
    
    func setupRefreshControl() {
        // init refresh control
        self.refreshControl?.addTarget(self, action: #selector(refreshData(_:)), for: .valueChanged)
        self.refreshControl?.attributedTitle = NSAttributedString(string: "Fetching Data ...")
    }
    
    @objc func refreshData(_ sender: Any) {
        self.refreshControl?.endRefreshing()
        self.removeErrorView()
        self.loadData()
    }
    
    // MARK: - Notification -
    
    @objc func updateTableView(_ notification: Notification) {
        // check if not nil
        if let index = notification.userInfo?["index"] as? Int {
            // check index
            if index == 1 {
                self.items = thisWeek
            } else if index == 2 {
                self.items = lastWeek
            } else if index == 3 {
                self.items = thisMonth
            } else if index == 4 {
                self.items = lastMonth
            }
            self.tableView.reloadData()
        }
    }

    // MARK: - TableView Datasource -

    override func numberOfSections(in tableView: UITableView) -> Int {
        if tableView == topTableView {
            return 1
        }
        return 1
    }

    override func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        if tableView == topTableView {
            return 0
        }
        return items.count
    }

    override func tableView(_ tableView: UITableView, titleForHeaderInSection section: Int) -> String? {
        if tableView == topTableView {
            return "JOB CODES"
        }
        return nil
    }

    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        // check
        if tableView == topTableView {
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
            
            return cell
        }
        
        // get item
        let item = items[indexPath.row]

        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        cell.imageView?.image       = Utils.generateThumbnail(from: item.name)
        cell.textLabel?.text        = item.name
        cell.detailTextLabel?.text  = App.shared.toAbbreviatedHourFormatter.string(from: item.total_hours * 3600) ?? "0m"

        return cell
    }

    override func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        // check
        if tableView != topTableView {
            let controller = self.storyboard?.instantiateViewController(withIdentifier: "sb_UserTimesheetController") as! UserTimesheetController
            controller.item = items[indexPath.row]
            self.navigationController?.pushViewController(controller, animated: true)
        }
    }

}

// MARK: - ViewPagerDataSource -

extension TimesheetController: ViewPagerDataSource {

    func initPagerView() {
        viewPager.dataSource = self
        //viewPager.animationNext()
    }

    func numberOfItems(viewPager:ViewPager) -> Int {
        return 4
    }

    func viewAtIndex(viewPager: ViewPager, index: Int, view: UIView?) -> UIView {
        // init
        let mView = CustomView().loadView() as! CustomView
        
        var regularHours: Double = 0.0
        var overtimeHours: Double = 0.0
        var breakHours: Double = 0.0
        var ptoHours: Double = 0.0
        var title: String = "This Week"

        // check index
        if index == 0 {
            title = "This Week"
            // iterate this week
            for item in thisWeek {
                regularHours += item.total_hours
                overtimeHours += item.total_overtime
                breakHours += item.total_break
                ptoHours += item.total_pto
            }
        } else if index == 1 {
            title = "Last Week"
            // iterate last week
            for item in lastWeek {
                regularHours += item.total_hours
                overtimeHours += item.total_overtime
                breakHours += item.total_break
                ptoHours += item.total_pto
            }
        } else if index == 2 {
            title = "This Month"
            // iterate this month
            for item in thisMonth {
                regularHours += item.total_hours
                overtimeHours += item.total_overtime
                breakHours += item.total_break
                ptoHours += item.total_pto
            }
        } else if index == 3 {
            title = "Last Month"
            // iterate last month
            for item in lastMonth {
                regularHours += item.total_hours
                overtimeHours += item.total_overtime
                breakHours += item.total_break
                ptoHours += item.total_pto
            }
        }
        

        mView.totalHoursLabel.text = title + " • " + (App.shared.toAbbreviatedHourFormatter.string(from: regularHours * 3600) ?? "0m")
        mView.regularHoursLabel.text = App.shared.toAbbreviatedHourFormatter.string(from: regularHours * 3600) ?? "0m"
        mView.overtimeLabel.text = App.shared.toAbbreviatedHourFormatter.string(from: overtimeHours * 3600) ?? "0m"
        mView.breakTimeLabel.text = App.shared.toAbbreviatedHourFormatter.string(from: breakHours * 3600) ?? "0m"
        mView.ptoLabel.text = App.shared.toAbbreviatedHourFormatter.string(from: ptoHours * 3600) ?? "0m"
        
        mView.sendReportButton.tag = index
        mView.sendReportButton.addTarget(self, action: #selector(sendReport(_:)), for: .touchUpInside)

        return mView
    }

    func didSelectedItem(index: Int) {
        print("select index \(index)")
    }
    
    // MARK: - Action -
    
    @objc func sendReport(_ sender: UIButton) {
        // show alert
        let alertController = UIAlertController(title: "Send Report to:", message: App.shared.user!.email, preferredStyle: .actionSheet)
        let yesAction = UIAlertAction(title: "Send Report", style: .default) { (alertAction) -> Void in
            
            // this week
            let startDateOfWeek  = Date().dateFor(.startOfWeek)
            let endDateOfWeek    = Date().dateFor(.endOfWeek)
            
            // get proper date thru sender.tag
            // get this week
            var startDate = App.shared.dateFormatter.string(from: startDateOfWeek)
            var endDate = App.shared.dateFormatter.string(from: endDateOfWeek)
            
            // last week
            if sender.tag == 1 {
                // get last week
                let lastWeekStartDate = startDateOfWeek.adjust(.week, offset: -1)
                let lastWeekEndDate = endDateOfWeek.adjust(.week, offset: -1)
                
                startDate = App.shared.dateFormatter.string(from: lastWeekStartDate)
                endDate = App.shared.dateFormatter.string(from: lastWeekEndDate)
            }
            // this month
            else if sender.tag == 2 {
                // get this month
                startDate = App.shared.dateFormatter.string(from: Date().startOfMonth)
                endDate = App.shared.dateFormatter.string(from: Date().endOfMonth)
            }
            // last month
            else if sender.tag == 3 {
                // get last month
                let lastMonthDate = Date().adjust(.month, offset: -1)
                
                startDate = App.shared.dateFormatter.string(from: lastMonthDate.startOfMonth)
                endDate = App.shared.dateFormatter.string(from: lastMonthDate.endOfMonth)
            }
            
            SVProgressHUD.show()
            App.shared.api.getTimesheetForAllMembers(startDate, endDate) { (list, error) in
                SVProgressHUD.dismiss()
                if let e = error {
                    return print(e.localizedDescription)
                }
                
                // init
                var regularHours: Double = 0.0
                var overtimeHours: Double = 0.0
                var breakHours: Double = 0.0
                var ptoHours: Double = 0.0
                
                // iterate
                for item in list {
                    regularHours += item.total_hours
                    overtimeHours += item.total_overtime
                    breakHours += item.total_break
                    ptoHours += item.total_pto
                }
                
                
                // get proper date
                let mStartDate = App.shared.monthDateFormatter.string(from: startDateOfWeek)
                let mEndDate = App.shared.monthDateFormatter.string(from: endDateOfWeek)
                
                // init date
                var date = mStartDate + " - " + mEndDate
                
                // check
                let startMonthDay = mStartDate.components(separatedBy: " ")
                let endMonthDay = mEndDate.components(separatedBy: " ")
                
                // check if not nil
                if let startMonth = startMonthDay.first,
                   let endMonth = endMonthDay.first, let endDay = endMonthDay.last {
                    // check
                    if startMonth == endMonth {
                        date = mStartDate + " - " + endDay
                    }
                }
                
                let subject = App.shared.company!.business_name + " : Timesheet Report from nSmarTrac - " + date
                let message = "Below you\'ll find the timesheet report you requested for your team at <b>" + App.shared.company!.business_name + "</b> for the period <b>" + date + "</b>"
                
                
                // params
                let params: Parameters = ["requester": App.shared.user!.full_name,
                                          "email": App.shared.user!.email,
                                          "subject": subject,
                                          "message": message,
                                          "date": date,
                                          "link": "company_id=\(App.shared.companyId)&start_date=\(startDate)&end_date=\(endDate)",
                                          "total_hours": App.shared.toAbbreviatedHourFormatter.string(from: breakHours * regularHours) ?? "0m",
                                          "total_break": App.shared.toAbbreviatedHourFormatter.string(from: breakHours * 3600) ?? "0m",
                                          "total_overtime": App.shared.toAbbreviatedHourFormatter.string(from: overtimeHours * 3600) ?? "0m",
                                          "total_pto": App.shared.toAbbreviatedHourFormatter.string(from: ptoHours * 3600) ?? "0m"]
                
                SVProgressHUD.show()
                App.shared.api.postTimesheetReport(params) { (result, error) in
                    SVProgressHUD.dismiss()
                    guard error == nil else {
                        return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                    }
                    guard result?.Code == 200 else {
                        return SVProgressHUD.showError(withStatus: result!.Message)
                    }
                    
                    SVProgressHUD.showSuccess(withStatus: "Timesheet report generated!")
                }
            }
        }
        alertController.addAction(yesAction)
        
        let noAction = UIAlertAction(title: "Cancel", style: .cancel) { (alertAction) -> Void in
            self.dismiss(animated: true, completion: nil)
        }
        alertController.addAction(noAction)
        
        self.present(alertController, animated: true, completion: nil)
    }

}
