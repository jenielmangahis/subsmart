//
//  PrimaryServicesController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 01/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import FontAwesome_swift
import SVProgressHUD

class PrimaryServicesController: UITableViewController {

    // MARK: - Properties -
    
    let titles = ["Residential", "Commercial", "Auto", "Event", "Moving"]
    let residential = ["Accoustical Covering", "Air Duct - Dryer vent cleaning", "Appliance", "Architect - Engineer", "Art - Picture Framing", "Assembly", "Cabinets", "Carpentry - Finish", "Carpentry - Rough", "Carpet - Tile Cleaning", "Cleaning", "Concreate - Paving", "Countertop", "Doors - Windows", "Drywall", "Electrical", "Electronics", "Fence - Gate", "Fire Protection", "Flooring Carpet", "Garage Doors", "General Contractor", "Gutter Cleaning", "Handyman", "Hardwood Flooring", "Heating & Air Conditioning Contractor", "Home Inspection", "Installation", "Insulation", "Interior Designer", "Junk Removal", "Landscaping", "Locksmith", "Maid Service", "Masonry", "Organizing", "Painting", "Pest Control", "Plastering", "Plumbing", "Pool Services", "Power Wash", "Professional Lighting", "Remodeling", "Restoration", "Restoration", "Resurfacing - Regglazing", "Roofing", "Security", "Septic Tank", "Sheet Metal", "Snow Removal", "Softwash", "Swamp Cooler", "Tree Services", "Welding", "Window Cleaning"]
    let commercial = ["Acoustical Covering", "Air Duct - Dryer vent cleaning", "Appliance", "Architect - Engineer", "Art - Picture Framing", "Assembly", "Banner Signs", "Cabinets", "Carpentry - Finish", "Carpentry - Rough", "Carpet - Tile Cleaning", "Concrete - Paving", "Countertop", "Doors - Windows", "Drywall", "Electrical", "Electronics", "Fence - Gate", "Fire Protection", "Flooring Carpet", "Garage Doors", "General Contractor", "Gutter Cleaning", "Handyman", "Hardwood Flooring", "Heating & Air Conditiong Contractor", "INSPECTION", "Installation", "Insulation", "Interior Designer", "Junk Removal", "Landscaping", "Locksmith", "Masonry", "Painting", "Pest Control", "Plastering", "Plumbing", "Pool Services", "Power Wash", "Professional Lighting", "Remodeling", "Restoration", "Resurfacing - Reglazing", "Roofing", "Security Network", "Septic Tank", "Sheet Metal", "Snow Removal", "Softwash", "Solar", "Swamp Cooler", "Tree Services", "Welding", "Window Cleaning"]
    let auto = ["AC Repair", "Alarm - Remote", "Audio - Video Tech", "Body Shop", "Brakes", "Bumper - Dents", "Detail Wash", "Headlight Restoration", "Locksmith", "Mechanic", "Paint Jobs - Restoration", "Towing", "Transmission", "Upholstery", "Window Tint", "Windshield", "Wrap - Graphics"]
    let event = ["Bartending", "Catering", "Comedy Acts", "Craft / Sewing", "Dancers", "Florist", "Impersonators", "Kids Entertainment", "Limo / Rentals", "Magician Illusion", "Music / DJ / Karaoke", "Photo Videography", "Planning Staging", "Professional Lighting", "Stylist"]
    let moving = ["Assemble", "Auto Transport", "Hourly rate service", "Moving", "Packing", "Storage space", "Wall Mount / Dismount"]
    var array: [[String]] = []
    
    var item: BusinessProfile?
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
                
        self.title = "Choose Primary Services"
        
        array = [residential, commercial, auto, event, moving]
    }
    
    override func viewWillAppear(_ animated: Bool) {
        loadData()
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Load data -
    
    func loadData() {
        // call api
        SVProgressHUD.show(withStatus: "Loading...")
        App.shared.api.getBusinessProfile() { (item, error) in
            SVProgressHUD.dismiss()
            if let e = error {
                return SVProgressHUD.showError(withStatus: e.localizedDescription)
            }
            
            self.item = item
            self.tableView.reloadData()
        }
    }
    
    // MARK: - TableView Datasource -
    
    override func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    override func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return titles.count
    }
    
    override func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 1
    }
    
    override func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        return 1
    }
    
    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let icons: [FontAwesome] = [.home, .building, .car, .calendarDay, .truckMoving]
        let image = UIImage.fontAwesomeIcon(name: icons[indexPath.row], style: .regular, textColor: App.shared.iconColor, size: CGSize(width: 24, height: 24))
        
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        cell.imageView?.image       = image
        cell.textLabel?.text        = titles[indexPath.row]
        cell.detailTextLabel?.text  = ""
        
        // check
        if let data = item {
            if titles[indexPath.row] == data.service_category {
                cell.detailTextLabel?.text = data.service_subcategory
            }
        }
        
        return cell
    }
    
    override func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        let storyboard = UIStoryboard(name: "Others", bundle: Bundle.main)
        let viewController = storyboard.instantiateViewController(withIdentifier: "sb_DetailedServicesController") as? DetailedServicesController
        viewController?.serviceName = titles[indexPath.row]
        viewController?.services    = array[indexPath.row]
        
        // check
        if let data = item {
            viewController?.currentServiceCategory      = data.service_category
            viewController?.currentServiceSubCategory   = data.service_subcategory
        }
        
        navigationController?.pushViewController(viewController!, animated: true)
    }

}
