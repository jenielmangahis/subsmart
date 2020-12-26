//
//  SelectDatesController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 24/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import DLRadioButton
import FSCalendar

class SelectDatesController: UIViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var calendar: FSCalendar!
    @IBOutlet var repeatButton: DLRadioButton!
    
    var dates: [Date] = []
    var callback: (([Date]) -> Void)?
    
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
        initCalendar()
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func initViews() {
        repeatButton.configure(true)
    }
    
    // MARK: - Actions -
    
    @IBAction func repeatButtonTapped(_ sender: DLRadioButton) {
        // check
        if sender.isSelected {
            calendar.allowsMultipleSelection = true
        } else {
            calendar.allowsMultipleSelection = false
        }
    }
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.dismiss(animated: true, completion: nil)
    }
    
    @IBAction func clearButtonTapped(_ sender: Any) {
        // iterate dates
        for date in dates {
            calendar.deselect(date)
            calendar.reloadData()
        }
        
        // clear
        dates.removeAll()
    }
    
    @IBAction func selectDatesButtonTapped(_ sender: Any) {
        guard !dates.isEmpty else {
            return Utils.shared.showAlertWithMessage(title: nil, message: "Please select dates!")
        }
        
        self.callback!(dates)
        self.dismiss(animated: true, completion: nil)
    }
    
}

// MARK: - FSCalendar Datasource -

extension SelectDatesController: FSCalendarDataSource, FSCalendarDelegate, FSCalendarDelegateAppearance {
    
    // MARK: - Calendar -
    
    func initCalendar() {
        // init calendar
        calendar.borders(for: [.bottom], width: 1, color: .lightGray)
        calendar.calendarHeaderView.backgroundColor     = .clear
        calendar.calendarWeekdayView.backgroundColor    = .clear
        calendar.allowsMultipleSelection                = true
        calendar.scrollDirection                        = .vertical
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
        calendar.appearance.todayColor                  = .lightGray
        calendar.appearance.todaySelectionColor         = AppTheme.defaultLinkColor
        calendar.appearance.eventDefaultColor           = AppTheme.defaultColor
        calendar.appearance.eventSelectionColor         = AppTheme.defaultLinkColor
    }
    
    func calendar(_ calendar: FSCalendar, didSelect date: Date, at monthPosition: FSCalendarMonthPosition) {
        dates.append(date)
    }
    
    func maximumDate(for calendar: FSCalendar) -> Date {
        return Date()
    }
}
