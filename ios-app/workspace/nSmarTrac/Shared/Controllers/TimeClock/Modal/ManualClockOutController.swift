//
//  ManualClockOutController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 11/20/20.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import FontAwesome_swift
import SVProgressHUD

class ManualClockOutController: UIViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var promptLabel: UILabel!
    @IBOutlet var closeButton: UIButton!
    
    var item: TimesheetTeamMember!
    
    
    
    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func initViews() {
        
        // init button
        closeButton.setImage(UIImage.fontAwesomeIcon(name: .times, style: .solid, textColor: .lightGray, size: CGSize(width: 28, height: 28)), for: .normal)
        
        
        // create attributed text
        let string = NSString(string: "Are you sure you want to clock out on behalf of \(item.name)?")
        let attrString = NSMutableAttributedString(string: String(string))
        attrString.addAttributes([.foregroundColor: UIColor.redColor, .font: UIFont.robotoBoldFont(ofSize: 15),], range: string.range(of: "clock out"))
        attrString.addAttributes([.foregroundColor: UIColor.label, .font: UIFont.robotoBoldFont(ofSize: 15),], range: string.range(of: "\(item.name)?"))
        
        // init prompt
        promptLabel.attributedText = attrString
    }
    
    // MARK: - Actions -
    
    @IBAction func closeButtonTapped(_ sender: Any) {
        self.dismiss(animated: true, completion: nil)
    }
    
    @IBAction func clockOutButtonTapped(_ sender: Any) {
        // get last attendance
        if let attendance = item.attendance.last,
           let lastLog = attendance.logs.last {
            
            // get createdDate
            let createdDate = App.shared.dateTimeFormatter.date(from: lastLog.date_created)
            
            // get shift duration
            let actualDiff = Calendar.current.dateComponents([.hour, .minute], from: createdDate!, to: Date())
            var shiftDuration = "\(actualDiff.hour!):\(actualDiff.minute!)".decimalTime
            
            // get break duration
            let breakDuration = attendance.break_duration.doubleValue
            
            // update shiftDuration
            shiftDuration = shiftDuration - breakDuration
            
            // get overtime
            let overtime = (shiftDuration > 8) ? shiftDuration - 8 : 0.00
            
            // check shift duration
            if shiftDuration > 8 {
                shiftDuration = shiftDuration - overtime
            }
            
            // params
            let params: Parameters = ["user_id": item.user_id,
                                      "shift_duration": shiftDuration,
                                      "break_duration": breakDuration,
                                      "overtime": overtime,
                                      "status": 0]
            
            // update attendance
            SVProgressHUD.setDefaultMaskType(.clear)
            SVProgressHUD.show()
            App.shared.api.putTimesheetAttendance(self.item.attendance.last!.id.intValue, params: params) { (result, error) in
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show()
                guard error == nil else {
                    return print(error?.localizedDescription as Any)
                }
                
                // create time clock message
                let message = App.shared.user!.full_name + " has Manually Clocked Out " + self.item.name + " today at " + App.shared.timeFormatter.string(from: Date())
                
                // check out
                let params2: Parameters = ["attendance_id": self.item.attendance.first!.id,
                                           "user_id": self.item.user_id,
                                           "user_location": "0,0",
                                           "user_location_address": "",
                                           "action": "Check out",
                                           "entry_type": "Manual",
                                           "date_created": App.shared.dateTimeFormatter.string(from: Date()),
                                           "approved_by": App.shared.user!.id,
                                           "company_id": App.shared.companyId,
                                           "workorder_id": 0,
                                           "message": message]
                
                // add log
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show()
                App.shared.api.postTimesheetLog(params2) { (result2, error2) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.dismiss()
                    
                    // check user_id
                    if self.item.user_id == App.shared.user!.id {
                        // get current attendance
                        App.shared.api.getUserTimesheet() { (result, error) in
                            if let e = error {
                                return print(e.localizedDescription)
                            }
                            
                            App.shared.userTimesheet = result
                            
                            self.dismiss(animated: true, completion: nil)
                        }
                    }
                }
            }
        }
    }
    
}
