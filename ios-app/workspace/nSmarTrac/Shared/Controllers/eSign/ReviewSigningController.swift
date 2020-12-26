//
//  ReviewSigningController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 24/09/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Material

class ReviewSigningController: UITableViewController {

    // MARK: - Properties -
    
    var subjectField: UITextField!
    var messageField: TextView!
    
    var item: ESign!
    
    
    
    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Actions -
    
    @IBAction func moreButtonTapped(_ sender: Any) {
    }
    
    @IBAction func sendButtonTapped(_ sender: Any) {
    }

    // MARK: - TableView Datasource -
    
    override func numberOfSections(in tableView: UITableView) -> Int {
        return 4
    }
    
    override func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        // check
        if section == 3 {
            return item.recipients.count
        }
        return 1
    }
    
    override func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        // check
        if indexPath.section == 0 || indexPath.section == 1 {
            return 44
        } else if indexPath.section == 2 {
            return 165
        }
        return 80
    }
    
    override func tableView(_ tableView: UITableView, titleForHeaderInSection section: Int) -> String? {
        return ["FROM", "EMAIL SUBJECT", "EMAIL MESSAGE", "RECIPIENTS"][section]
    }
    
    override func tableView(_ tableView: UITableView, titleForFooterInSection section: Int) -> String? {
        return ["", "100 character limit", "10,000 character limit", ""][section]
    }
    
    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let section = indexPath.section
        
        // check
        if section == 0 {
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "FromCell", for: indexPath)
            cell.textLabel?.text = "\(App.shared.user!.full_name) via eSign"
            return cell
        } else if section == 1 {
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "SubjectCell", for: indexPath)
            
            // remove other views
            cell.contentView.subviews.forEach {
                $0.removeFromSuperview()
            }
            
            subjectField = UITextField(frame: CGRect(x: 20, y: 7, width: Device.width-40, height: 30))
            subjectField.font = UIFont.robotoFont(ofSize: 13)
            subjectField.placeholder = "Please eSign: \(item.name)"
            subjectField.text = "Please eSign: \(item.name)"
            subjectField.clearButtonMode = .whileEditing
            cell.contentView.addSubview(subjectField)
            
            return cell
        } else if section == 2 {
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "MessageCell", for: indexPath)
            
            // remove other views
            cell.contentView.subviews.forEach {
                $0.removeFromSuperview()
            }
            
            messageField = TextView(frame: CGRect(x: 10, y: 11, width: Device.width-20, height: 145))
            messageField.font = UIFont.robotoFont(ofSize: 13)
            messageField.placeholder = "Add a message to your recipients..."
            cell.contentView.addSubview(messageField)
            
            return cell
        }
        
        //
        let data = item?.recipients[indexPath.row]
        
        // get initials
        var initials = ""
        let name = data?.name.components(separatedBy: " ")
        if let firstLetter = name?.first?.first,
            let secondLetter = name?.last?.first {
            initials = "\(firstLetter)\(secondLetter)"
        }
        
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath) as! SignerCell
        cell.thumbnail.backgroundColor  = UIColor(hex: data!.color)
        cell.thumbnail.text             = initials.uppercased()
        cell.name.text                  = data?.name
        cell.email.text                 = data?.email
        cell.action.text                = data?.role
        
        // check role
        if data?.role == "Signs in Person" {
            // get host name and email
            cell.email.text = "Hosted By: \(data?.host_name ?? "-")"
        }
        
        return cell
    }
    
}
