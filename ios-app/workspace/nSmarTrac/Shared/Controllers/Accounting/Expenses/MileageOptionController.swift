//
//  MileageOptionController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 18/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import FontAwesome_swift

class MileageOptionController: UITableViewController {

    override func viewDidLoad() {
        super.viewDidLoad()
        
        self.title = "Mileage Options"
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - TableView Datasource -
    
    override func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    override func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return 3
    }
    
    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let titles = ["Distance", "Odometer", "GPS"]
        let icons: [FontAwesome] = [.calculator, .tachometerAlt, .mapMarkerAlt]
        let image = UIImage.fontAwesomeIcon(name: icons[indexPath.row], style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 24, height: 24))
        
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        cell.textLabel?.text = titles[indexPath.row]
        cell.imageView?.image = image

        return cell
    }
    
    override func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        switch indexPath.row {
        case 0:
            self.pushTo(storyBoard: "Main", identifier: "sb_AddMileageDistanceController")
        case 1:
            self.pushTo(storyBoard: "Main", identifier: "sb_AddMileageOdometerController")
        case 2:
            self.pushTo(storyBoard: "Main", identifier: "sb_AddMileageGPSController")
        default:
            break
        }
    }

}
