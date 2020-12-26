//
//  AttoDepartmentDetailController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 27/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import FontAwesome_swift

class AttoDepartmentDetailController: UITableViewController {
    
    // MARK: - Properties -
    
    var item: TimesheetDepartment!
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        loadData()
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Load data -
    
    func loadData() {
        // set title
        self.navigationItem.title = item.name
    }
    
    // MARK: - TableView Datasource -
    
    override func numberOfSections(in tableView: UITableView) -> Int {
        return 2
    }
    
    override func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        //return [1, managers.count, 1, members.count][section]
        return [1, item.members.count][section]
    }
    
    override func tableView(_ tableView: UITableView, titleForHeaderInSection section: Int) -> String? {
        //return ["Department Managers", nil, "Department Members", nil][section]
        return ["Department Members", nil][section]
    }
    
    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        // check
        /*if indexPath.section == 0 {
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "AddManagerCell", for: indexPath)
            
            // add plus button
            let plusButton = UIButton(frame: CGRect(x: Device.width-44, y: 10, width: 24, height: 24))
            plusButton.setImage(UIImage.fontAwesomeIcon(name: .plus, style: .regular, textColor: .link, size: CGSize(width: 24, height: 24)), for: .normal)
            cell.contentView.addSubview(plusButton)
            
            return cell
            
        } else*/ if indexPath.section == 0 {
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "AddMemberCell", for: indexPath)
            
            // add plus button
            let plusButton = UIButton(frame: CGRect(x: Device.width-44, y: 10, width: 24, height: 24))
            plusButton.setImage(UIImage.fontAwesomeIcon(name: .plus, style: .regular, textColor: .link, size: CGSize(width: 24, height: 24)), for: .normal)
            cell.contentView.addSubview(plusButton)
            
            return cell
            
        }/* else if indexPath.section == 1 {
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
            cell.textLabel?.text = managers[indexPath.row].name
            
            return cell
        }*/
        
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        cell.textLabel?.text = item.members[indexPath.row].name
        
        return cell
    }
    
    override func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        self.pushTo(storyBoard: "Others", identifier: "sb_AttoAddDeptMemberController")
    }

}
