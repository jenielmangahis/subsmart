//
//  Trac360PeopleDetailController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 12/7/20.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import CoreLocation
import FontAwesome_swift
import iOSDropDown
import PullUpController

class Trac360PeopleDetailController: PullUpController {
    
    // MARK: - Properties -
    
    @IBOutlet var dropdownField: DropDown!
    @IBOutlet var containerView: UIView!
    @IBOutlet var tableView: UITableView!
    @IBOutlet var routeButton: UIButton!
    @IBOutlet var mapButton: UIButton!
    
    var item: Trac360People = App.shared.selectedTrac360People!
    
    enum InitialState {
        case contracted
        case expanded
    }
        
    var initialState: InitialState = .contracted
    
    var initialPointOffset: CGFloat {
        switch initialState {
        case .contracted:
            return 260
        case .expanded:
            return pullUpControllerPreferredSize.height
        }
    }
    
    public var portraitSize: CGSize = .zero
    
    
    var monthDateFormatter: DateFormatter = {
        let formatter = DateFormatter()
        formatter.dateFormat = "MMMM d"
        return formatter
    }()
    
    var timeDayFormatter: DateFormatter = {
        let formatter = DateFormatter()
        formatter.dateFormat = "h:m a EEEE"
        return formatter
    }()
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
        initDropDown()
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    override func viewDidLayoutSubviews() {
        super.viewDidLayoutSubviews()
            
        containerView.layer.cornerRadius = 20
        self.view.backgroundColor = .clear
    }
    
    // MARK: - Functions -
    
    func initViews() {
        // init buttons
        routeButton.setImage(UIImage.fontAwesomeIcon(name: .route, style: .regular, textColor: .link, size: CGSize(width: 24, height: 24)), for: .normal)
        mapButton.setImage(UIImage.fontAwesomeIcon(name: .map, style: .regular, textColor: .link, size: CGSize(width: 24, height: 24)), for: .normal)
        
        // init portraitSize
        portraitSize = CGSize(width: min(UIScreen.main.bounds.width, UIScreen.main.bounds.height), height: tableView.frame.maxY-450)
        
        // init table
        tableView.isScrollEnabled = false
        tableView.attach(to: self)
    }
    
    // MARK: - Dropdown
        
    func initDropDown() {
        let options: [String] = App.shared.cache.loadCachedTrac360Circles().map { (item) -> String in
            return String(format: "%@", item.name)
        }
        
        dropdownField.optionArray = options
        dropdownField.text = (options.count > 0) ? options.first : ""
        dropdownField.rowHeight = 51
        dropdownField.selectedIndex = 0
        dropdownField.selectedRowColor = UIColor(rgb: 0xF1F1F9)
        dropdownField.isSearchEnable = false
        dropdownField.arrowSize = 7
        dropdownField.arrowColor = UIColor(rgb: 0x76849F)
        dropdownField.setLeftPaddingPoints(20)
        dropdownField.font = UIFont.robotoFont(ofSize: 14)
        dropdownField.didSelect(completion: { (selectedText , index ,id) in
            
        })
    }
    
    // MARK: - PullUpController -
        
    override var pullUpControllerPreferredSize: CGSize {
        return portraitSize
    }
    
    override var pullUpControllerMiddleStickyPoints: [CGFloat] {
        switch initialState {
        case .contracted:
            return [260]
        case .expanded:
            return [tableView.frame.maxY]
        }
    }
    
    override var pullUpControllerBounceOffset: CGFloat {
        return 20
    }
    
    override func pullUpControllerAnimate(action: PullUpController.Action, withDuration duration: TimeInterval, animations: @escaping () -> Void, completion: ((Bool) -> Void)?) {
        switch action {
        case .move:
            UIView.animate(withDuration: 0.3,
                           delay: 0,
                           usingSpringWithDamping: 0.7,
                           initialSpringVelocity: 0,
                           options: .curveEaseInOut,
                           animations: animations,
                           completion: completion)
        default:
            UIView.animate(withDuration: 0.3,
                           animations: animations,
                           completion: completion)
        }
    }
    
    // MARK: - Actions -
    
    @IBAction func routeButtonTapped(_ sender: Any) {
    }
    
    @IBAction func mapButtonTapped(_ sender: Any) {
    }

}

// MARK: - TableView Datasource -

extension Trac360PeopleDetailController: UITableViewDelegate, UITableViewDataSource, UIScrollViewDelegate {
    
    func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return 1
    }
    
    func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 0.0001
    }
    
    func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        return 0.0001
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        // parse date
        let date = App.shared.dateTimeFormatter.date(from: item.last_tracked_location_date)
        var locationSince = ""
        
        // check if today
        if date?.compare(.isToday) ==  true {
            locationSince = "Since " + App.shared.timeFormatter.string(from: date!)
        } else if date?.compare(.isYesterday) == true {
            locationSince = "Since " + App.shared.timeFormatter.string(from: date!) + " yesterday"
        } else if date?.compare(.isThisWeek) == true {
            locationSince = "Since " + timeDayFormatter.string(from: date!)
        } else if item.last_tracked_location_date.isEmpty {
            locationSince = "Location not available!"
        } else {
            locationSince = "Since " + monthDateFormatter.string(from: date!)
        }
        
        
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath) as! PeopleDetailCell
        cell.icon.image         = Utils.generateThumbnail(from: item.name)
        cell.name.text          = item.name.components(separatedBy: " ").first!
        cell.location.text      = "Near " + item.last_tracked_location_address
        cell.locationSince.text = locationSince
        
        // check if location disabled
        if item.is_location_off.boolValue == true {
            cell.location.text      = "Location permission off"
            cell.location.textColor = .systemRed
            
        } else if item.last_tracked_location.isEmpty {
            cell.location.text      = "Location not available"
            cell.location.textColor = .systemRed
            cell.locationSince.text = "-"
        }
        
        // check
        if !item.last_tracked_location.isEmpty {
            // get coordinates
            let coordinates = item.last_tracked_location.components(separatedBy: ",")
            
            // check if not nil
            if let lat = coordinates.first,
               let lon = coordinates.last {
                
                let location = CLLocation(latitude: lat.doubleValue, longitude: lon.doubleValue)
                let image = Utils.generateAnnotationImage(item.name)
                
                (parent as? Trac360MapController)?.addAnnotation(coordinate: location.coordinate, image: image)
                (parent as? Trac360MapController)?.zoom(to: location.coordinate)
            }
        }
        
        return cell
    }
}

// MARK: - TableViewCell -

class PeopleDetailCell: UITableViewCell {
    @IBOutlet var icon: UIImageView!
    @IBOutlet var name: UILabel!
    @IBOutlet var location: UILabel!
    @IBOutlet var locationSince: UILabel!
    @IBOutlet var addButton: UIButton!
}
