//
//  ManualClockInController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 11/20/20.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import FontAwesome_swift
import SVProgressHUD

class ManualClockInController: UIViewController {
    
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
        let string = NSString(string: "Are you sure you want to clock in on behalf of \(item.name)?")
        let attrString = NSMutableAttributedString(string: String(string))
        attrString.addAttributes([.foregroundColor: UIColor.greenColor, .font: UIFont.robotoBoldFont(ofSize: 15),], range: string.range(of: "clock in"))
        attrString.addAttributes([.foregroundColor: UIColor.label, .font: UIFont.robotoBoldFont(ofSize: 15),], range: string.range(of: "\(item.name)?"))
        
        // init prompt
        promptLabel.attributedText = attrString
    }
    
    // MARK: - Actions -
    
    @IBAction func closeButtonTapped(_ sender: Any) {
        self.dismiss(animated: true, completion: nil)
    }
    
    @IBAction func clockInButtonTapped(_ sender: Any) {
        // params
        let params: Parameters = ["user_id": self.item.user_id,
                                  "shift_duration": 0.00,
                                  "break_duration": 0.00,
                                  "overtime": 0.00,
                                  "date_created": App.shared.dateTimeFormatter.string(from: Date()),
                                  "status": 1]
        
        // add attendance
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show()
        App.shared.api.postTimesheetAttendance(params) { (result, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return print(error?.localizedDescription as Any)
            }
            guard result?.Code == 200 else {
                return print(result!.Message!)
            }
            
            // id
            if let id = result?.Data {
                
                // create time clock message
                let message = App.shared.user!.full_name + " has Manually Clocked Out " + self.item.name + " today at " + App.shared.timeFormatter.string(from: Date())
                
                // check in
                let params2: Parameters = ["attendance_id": id,
                                           "user_id": self.item.user_id,
                                           "user_location": "0,0",
                                           "user_location_address": "",
                                           "action": "Check in",
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
