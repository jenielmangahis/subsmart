//
//  BlockDetailController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 14/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import SVProgressHUD
import MessageUI

class BlockDetailController: UITableViewController, MFMessageComposeViewControllerDelegate, MFMailComposeViewControllerDelegate {
    
    // MARK: - Properties -
    
    @IBOutlet var editBarButton: UIBarButtonItem!
    @IBOutlet var deleteBarButton: UIBarButtonItem!
    
    @IBOutlet var blockIcon: UIImageView!
    @IBOutlet var calendarIcon: UIImageView!
    
    @IBOutlet var eventDescription: UILabel!
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
        editBarButton.image = UIImage.fontAwesomeIcon(name: .edit, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        deleteBarButton.image = UIImage.fontAwesomeIcon(name: .trashAlt, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        blockIcon.image = UIImage.fontAwesomeIcon(name: .ban, style: .solid, textColor: App.shared.iconColor, size: CGSize(width: 22, height: 22))
        calendarIcon.image = UIImage.fontAwesomeIcon(name: .calendarDay, style: .solid, textColor: App.shared.iconColor, size: CGSize(width: 22, height: 22))
        
        // set title
        self.navigationItem.title = "Schedule Details"
        
        // event details
        eventDescription.text   = item.event_description
        startDate.text          = item.start_date.getDay + ", " + item.start_date.toReadableDate
        startTime.text          = item.start_time + " - " + item.end_time
        remindMe.text           = "Alert None"
        assignedTo.text         = (item.employee_id == "0") ? "All Employees" : item.employee_name
        instructions.text       = item.instructions
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Actions -
    
    @IBAction func editButtonTapped(_ sender: Any) {
        let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_EditBlockTimeController") as? EditBlockTimeController
        viewController?.item = item
        self.navigationController?.pushViewController(viewController!, animated: true)
    }
    
    @IBAction func deleteButtonTapped(_ sender: Any) {
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show(withStatus: "Deleting...")
        App.shared.api.deleteEvent(item.id.intValue) { (success, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard success == true else {
                return SVProgressHUD.showError(withStatus: "Deleting item failed!")
            }
            
            self.popViewController()
        }
    }
    
    @IBAction func smsButtonTapped(_ sender: Any) {
        if (MFMessageComposeViewController.canSendText()) {
            let controller = MFMessageComposeViewController()
            controller.body = ""
            controller.recipients = [item.customer_phone, item.customer_mobile]
            controller.messageComposeDelegate = self
            self.present(controller, animated: true, completion: nil)
        }
    }
    
    @IBAction func callButtonTapped(_ sender: Any) {
        if let url = URL(string: "tel://" + item.customer_phone) {
            if UIApplication.shared.canOpenURL(url) {
                UIApplication.shared.open(url, options: [:], completionHandler: nil)
            }
        }
    }
    
    @IBAction func emailButtonTapped(_ sender: Any) {
        if MFMailComposeViewController.canSendMail() {
            let mail = MFMailComposeViewController()
            mail.mailComposeDelegate = self
            mail.setToRecipients([item.customer_email])
            mail.setSubject("")
            mail.setMessageBody("", isHTML: true)
            present(mail, animated: true)
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
