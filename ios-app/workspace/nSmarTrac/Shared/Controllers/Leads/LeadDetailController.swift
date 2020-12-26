//
//  LeadDetailController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 14/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import FontAwesome_swift
import SVProgressHUD

class LeadDetailController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var editBarButton: UIBarButtonItem!
    @IBOutlet var deleteBarButton: UIBarButtonItem!
    
    @IBOutlet var nameIcon: UIImageView!
    @IBOutlet var emailIcon: UIImageView!
    @IBOutlet var mobileIcon: UIImageView!
    @IBOutlet var emailNotifyIcon: UIImageView!
    @IBOutlet var smsNotifyIcon: UIImageView!
    
    @IBOutlet var nameLabel: UILabel!
    @IBOutlet var emailLabel: UILabel!
    @IBOutlet var mobileLabel: UILabel!
    @IBOutlet var typeLabel: UILabel!
    @IBOutlet var bookedOnLabel: UILabel!
    @IBOutlet var leadSourceLabel: UILabel!
    @IBOutlet var emailNotifyLabel: UILabel!
    @IBOutlet var smsNotifyLabel: UILabel!
    
    var item: Lead = App.shared.selectedLead!
    
    
    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        loadData()
        
        // configure icons
        editBarButton.image = UIImage.fontAwesomeIcon(name: .edit, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        deleteBarButton.image = UIImage.fontAwesomeIcon(name: .trashAlt, style: .regular, textColor: .white, size: CGSize(width: 24, height: 24))
        nameIcon.image = UIImage.fontAwesomeIcon(name: .tag, style: .solid, textColor: App.shared.iconColor, size: CGSize(width: 22, height: 22))
        emailIcon.image = UIImage.fontAwesomeIcon(name: .envelope, style: .regular, textColor: App.shared.iconColor, size: CGSize(width: 22, height: 22))
        mobileIcon.image = UIImage.fontAwesomeIcon(name: .mobileAlt, style: .regular, textColor: App.shared.iconColor, size: CGSize(width: 22, height: 22))
        emailNotifyIcon.image = UIImage.fontAwesomeIcon(name: .envelope, style: .regular, textColor: App.shared.iconColor, size: CGSize(width: 22, height: 22))
        smsNotifyIcon.image = UIImage.fontAwesomeIcon(name: .sms, style: .solid, textColor: App.shared.iconColor, size: CGSize(width: 22, height: 22))
        
        // set title
        self.navigationItem.title = "Lead Detail"
        
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Load data -
    
    func loadData() {
        nameLabel.text          = item.contact_name
        emailLabel.text         = item.contact_email
        mobileLabel.text        = item.phone
        typeLabel.text          = "Type: " + item.type
        bookedOnLabel.text      = "Booked on: " + item.date_created
        leadSourceLabel.text    = "Lead Source: " + item.source
        emailNotifyLabel.text   = "Email Notify: \(item.notify_email ? "Yes" : "No")"
        smsNotifyLabel.text     = "SMS Notify: \(item.notify_sms ? "Yes" : "No")"
    }
    
    // MARK: - Actions -
    
    @IBAction func editButtonTapped(_ sender: Any) {
        // edit
        let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_EditLeadController") as? EditLeadController
        viewController?.item = item
        self.navigationController?.pushViewController(viewController!, animated: true)
    }
    
    @IBAction func deleteButtonTapped(_ sender: Any) {
        // delete
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show()
        App.shared.api.deleteLead(item.id.intValue) { (success, error) in
            guard error == nil else {
                SVProgressHUD.dismiss()
                return SVProgressHUD.showError(withStatus: "Deleting item failed!")
            }
            
            SVProgressHUD.dismiss()
            self.popViewController()
        }
    }
    
}
