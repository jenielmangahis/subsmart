//
//  EventDetailController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 14/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import FontAwesome_swift
import MessageUI

class EventDetailController: UITableViewController, MFMessageComposeViewControllerDelegate, MFMailComposeViewControllerDelegate {
    
    // MARK: - Properties -
    
    @IBOutlet var eventColor: UIView!
    @IBOutlet var eventColor2: UIView!
    @IBOutlet var userIcon: UIImageView!
    @IBOutlet var calendarIcon: UIImageView!
    
    @IBOutlet var customerName: UILabel!
    @IBOutlet var startDate: UILabel!
    @IBOutlet var startTime: UILabel!
    @IBOutlet var remindMe: UILabel!
    @IBOutlet var assignedTo: UILabel!
    @IBOutlet var instructions: UITextView!
    
    let item = App.shared.selectedEvent!
    
    
    
    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
        
        // configure icons
        userIcon.image = UIImage.fontAwesomeIcon(name: .user, style: .regular, textColor: App.shared.iconColor, size: CGSize(width: 22, height: 22))
        calendarIcon.image = UIImage.fontAwesomeIcon(name: .calendarDay, style: .regular, textColor: App.shared.iconColor, size: CGSize(width: 22, height: 22))
        
        // event details
        customerName.text       = item.customer_name
        startDate.text          = item.start_date.getDay + ", " + item.start_date.toReadableDate
        startTime.text          = item.start_time + " - " + item.end_time
        remindMe.text           = item.customer_reminder_notification
        assignedTo.text         = (item.employee_id == "0") ? "All Employees" : item.employee_name
        instructions.text       = item.instructions
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Actions -
    
    @IBAction func smsButtonTapped(_ sender: Any) {
        if !item.customer_phone.isEmpty || !item.customer_mobile.isEmpty {
            if (MFMessageComposeViewController.canSendText()) {
                let controller = MFMessageComposeViewController()
                controller.body = ""
                controller.recipients = [item.customer_phone, item.customer_mobile]
                controller.messageComposeDelegate = self
                self.present(controller, animated: true, completion: nil)
            }
        }
    }
    
    @IBAction func callButtonTapped(_ sender: Any) {
        if !item.customer_phone.isEmpty {
            if let url = URL(string: "tel://" + item.customer_phone) {
                if UIApplication.shared.canOpenURL(url) {
                    UIApplication.shared.open(url, options: [:], completionHandler: nil)
                }
            }
        } else if !item.customer_mobile.isEmpty {
            if let url = URL(string: "tel://" + item.customer_mobile) {
                if UIApplication.shared.canOpenURL(url) {
                    UIApplication.shared.open(url, options: [:], completionHandler: nil)
                }
            }
        }
    }
    
    @IBAction func emailButtonTapped(_ sender: Any) {
        if !item.customer_email.isEmpty {
            if MFMailComposeViewController.canSendMail() {
                let mail = MFMailComposeViewController()
                mail.mailComposeDelegate = self
                mail.setToRecipients([item.customer_email])
                mail.setSubject("")
                mail.setMessageBody("", isHTML: true)
                present(mail, animated: true)
            }
        }
    }
    
    // MARK: - MFMessageComposeViewControllerDelegate -
    
    func messageComposeViewController(_ controller: MFMessageComposeViewController, didFinishWith result: MessageComposeResult) {
        switch (result) {
            case .cancelled:
                print("Message was cancelled")
                dismiss(animated: true, completion: nil)
            case .failed:
                print("Message failed")
                dismiss(animated: true, completion: nil)
            case .sent:
                print("Message was sent")
                dismiss(animated: true, completion: nil)
            default:
                break
        }
    }
    
    // MARK: - MFMailComposeViewControllerDelegate -
    
    func mailComposeController(_ controller: MFMailComposeViewController, didFinishWith result: MFMailComposeResult, error: Error?) {
        controller.dismiss(animated: true)
    }

}
