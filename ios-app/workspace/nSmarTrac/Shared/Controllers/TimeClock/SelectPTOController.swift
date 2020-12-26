//
//  SelectPTOController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 01/11/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class SelectPTOController: UITableViewController {

    // MARK: - Properties -
    
    var items: [TimesheetPTO] = []
    
    var callback: ((TimesheetPTO) -> Void)?
    
    

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
        // call api
        App.shared.api.getTimesheetPTOs { (list, error) in
            if let e = error {
                return print(e.localizedDescription)
            }
            
            self.items = list
            self.tableView.reloadData()
        }
    }
    
    // MARK: - TableView Datasource -
    
    override func numberOfSections(in tableView: UITableView) -> Int {
        return 2
    }
    
    override func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return [1, items.count][section]
    }
    
    override func tableView(_ tableView: UITableView, titleForHeaderInSection section: Int) -> String? {
        return "PTO CODES"
    }
    
    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        cell.textLabel?.text = items[indexPath.row].name
        
        return cell
    }
    
    override func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        self.callback!(items[indexPath.row])
        self.dismiss(animated: true, completion: nil)
    }

}
