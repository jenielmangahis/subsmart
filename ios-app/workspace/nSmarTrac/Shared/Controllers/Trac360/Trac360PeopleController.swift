//
//  Trac360PeopleController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 11/28/20.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import AFDateHelper
import CoreLocation
import FontAwesome_swift
import PullUpController

class Trac360PeopleController: PullUpController {
    
    // MARK: - Properties -
    
    @IBOutlet var containerView: UIView!
    @IBOutlet var tableView: UITableView!
    @IBOutlet var mapButton: UIButton!
    
    var indicator = UIActivityIndicatorView()
    var refreshControl = UIRefreshControl()
    
    var items: [Trac360People] = []
    
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
        setupIndicator()
        setupRefreshControl()
        initViews()
    }
    
    override func viewDidAppear(_ animated: Bool) {
        loadData()
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
        // init button
        mapButton.setImage(UIImage.fontAwesomeIcon(name: .map, style: .regular, textColor: .link, size: CGSize(width: 24, height: 24)), for: .normal)
        
        // init portraitSize
        portraitSize = CGSize(width: min(UIScreen.main.bounds.width, UIScreen.main.bounds.height), height: tableView.frame.maxY-380)
        
        // init table
        tableView.isScrollEnabled = false
        tableView.attach(to: self)
    }
    
    func setPortraitSize() {
        // set size
        let height = (items.count > 0) ? items.count * 60 + 200 : Int(tableView.frame.maxY-350)
        portraitSize = CGSize(width: min(UIScreen.main.bounds.width, UIScreen.main.bounds.height), height: CGFloat(height))
    }
    
    // MARK: - Load data -
    
    func loadData() {
        // handle nil
        if let selectedCircle = App.shared.selectedTrac360Circle {
            // assign
            self.items = selectedCircle.people
            self.tableView.backgroundView = nil
            self.tableView.reloadData()
            //self.setPortraitSize()
            
        } else {
            // get my circles
            App.shared.api.getTrac360Circles() { (list, error) in
                if let e = error {
                    return print(e.localizedDescription)
                }
                
                // save to cache
                let data = NSKeyedArchiver.archivedData(withRootObject: list)
                UserDefaults.standard.set(data, forKey: UDKeys.cachedTrac360Circles.envPrefixed)
                UserDefaults.standard.synchronize()
                
                // handle nil
                if let circle = list.first {
                    // assign
                    App.shared.myTrac360Circle = list
                    App.shared.selectedTrac360Circle = circle
                    
                    self.items = circle.people
                    self.tableView.backgroundView = nil
                    self.tableView.reloadData()
                    self.setPortraitSize()
                }
            }
        }
    }
    
    // MARK: - ErrorView -

    private lazy var errorView: BasicErrorView = {
        let errorView = BasicErrorView()
        errorView.translatesAutoresizingMaskIntoConstraints = false
        return errorView
    }()
    
    func addErrorView(with error: Error) {
        DispatchQueue.main.async { [weak self] in
            guard let self = self else { return }
            self.tableView.backgroundView?.addSubview(self.errorView)
            let safeAreaLayoutGuide = self.view.safeAreaLayoutGuide
            NSLayoutConstraint.activate([
                self.errorView.leadingAnchor.constraint(equalTo: safeAreaLayoutGuide.leadingAnchor),
                self.errorView.trailingAnchor.constraint(equalTo: safeAreaLayoutGuide.trailingAnchor),
                self.errorView.topAnchor.constraint(equalTo: safeAreaLayoutGuide.topAnchor),
                self.errorView.bottomAnchor.constraint(equalTo: safeAreaLayoutGuide.bottomAnchor)
                ])
            self.errorView.displayError(error)
        }
    }

    func removeErrorView() {
        if self.tableView.backgroundView == nil || !self.tableView.backgroundView!.subviews.contains(errorView) {
            return
        }
        DispatchQueue.main.async {
            self.errorView.removeFromSuperview()
        }
    }
    
    // MARK: - Activity Indicator -
    
    func setupIndicator() {
        // init activity indicator
        self.indicator = UIActivityIndicatorView(frame: CGRect(x: 0, y: 0, width: 40, height: 40))
        self.indicator.style = UIActivityIndicatorView.Style.medium
        self.indicator.center = self.view.center
        self.view.addSubview(indicator)
        self.tableView.backgroundView = indicator
        self.indicator.startAnimating()
    }
    
    // MARK: - Refresh Control -
    
    func setupRefreshControl() {
        // init refresh control
        self.tableView.refreshControl = refreshControl
        self.refreshControl.addTarget(self, action: #selector(refreshData(_:)), for: .valueChanged)
        self.refreshControl.attributedTitle = NSAttributedString(string: "Fetching Data ...")
    }
    
    @objc func refreshData(_ sender: Any) {
        self.refreshControl.endRefreshing()
        self.removeErrorView()
        self.loadData()
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
    
    @IBAction func mapButtonTapped(_ sender: Any) {
    }
    
}

// MARK: - TableView Datasource -

extension Trac360PeopleController: UITableViewDelegate, UITableViewDataSource, UIScrollViewDelegate {
    
    func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return items.count + 1
    }
    
    func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 0.0001
    }
    
    func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        return 0.0001
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        // check
        if indexPath.row == items.count {
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "AddCell", for: indexPath) as! AddCell
            return cell
        }
        
        // get item
        let item = items[indexPath.row]
        
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
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath) as! PeopleCell
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
            }
        }
        
        return cell
    }
    
    func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        // check
        if indexPath.row == items.count {
            return
        }
        
        tableView.deselectRow(at: indexPath, animated: true)
        view.endEditing(true)
        
        // get item
        let item = items[indexPath.row]
        
        App.shared.selectedTrac360People = item
        
        let controller = self.storyboard?.instantiateViewController(withIdentifier: "sb_Trac360MapController") as! Trac360MapController
        controller.isPeopleDetail = true
        self.navigationController?.pushViewController(controller, animated: true)
        
        // check
        /*if !item.last_tracked_location.isEmpty {
            // get coordinates
            let coordinates = item.last_tracked_location.components(separatedBy: ",")
            
            // check if not nil
            if let lat = coordinates.first,
               let lon = coordinates.last {
                
                let location = CLLocation(latitude: lat.doubleValue, longitude: lon.doubleValue)
                
                pullUpControllerMoveToVisiblePoint(pullUpControllerMiddleStickyPoints[0], animated: true, completion: nil)
                (parent as? Trac360MapController)?.zoom(to: location.coordinate)
            }
        }*/
    }
}

// MARK: - TableViewCell -

class PeopleCell: UITableViewCell {
    @IBOutlet var icon: UIImageView!
    @IBOutlet var name: UILabel!
    @IBOutlet var location: UILabel!
    @IBOutlet var locationSince: UILabel!
}
