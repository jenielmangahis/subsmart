//
//  ActivityController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 21/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import CoreLocation
import FontAwesome_swift
import MapKit

class ActivityController: UITableViewController, MKMapViewDelegate {
    
    // MARK: - Properties -
    
    @IBOutlet var mapView: MKMapView!
    
    let locationManager = CLLocationManager()
    var regionRadius: CLLocationDistance = 200
    var location: CLLocation?
    
    var items: [TimesheetTeamMember] = []
    var annotationColor: UIColor = .lightGray
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        setupIndicator()
        setupRefreshControl()
    }
    
    override func viewDidAppear(_ animated: Bool) {
        checkLocation()
        loadData()
        
        self.tableView.reloadData()
        self.parent?.navigationItem.title = "Team Activity"
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Load data -
    
    func loadData() {
        // call api
        App.shared.api.getTimesheetTeamMembers("1") { (list, error) in
            if let e = error {
                return print(e.localizedDescription)
            }
            
            // iterate list
            for item in list {
                // get last attendance
                if let attendance = item.attendance.first {
                    // get last log
                    if let lastLog = attendance.logs.last {
                        // get last log time
                        let lastLogDate = App.shared.dateTimeFormatter.date(from: lastLog.date_created)!
                        
                        // check last log
                        if lastLog.action == "Break in" {
                            // update values
                            item.iconBorderColor = .orangeColor
                            item.statusDetail = App.shared.timeFormatter.string(from: lastLogDate) + " • On Break"
                            
                        } else if lastLog.action == "Check in" || lastLog.action == "Break out" {
                            // update values
                            item.iconBorderColor = .greenColor
                            
                            // check if manually clocked
                            if lastLog.entry_type == "Manual" {
                                item.statusDetail = "\(App.shared.timeFormatter.string(from: lastLogDate)) • Manual Clock In"
                            } else {
                                // check
                                if let address = lastLog.user_location_address.components(separatedBy: ", ").first {
                                    item.statusDetail = "\(App.shared.timeFormatter.string(from: lastLogDate)) • \(address)"
                                }
                            }
                            
                            // check if clock from previous day
                            if App.shared.dateFormatter.string(from: lastLogDate) != App.shared.dateFormatter.string(from: Date()) {
                                item.statusDetail = "12:00am • Clocked in from the previous day"
                            }
                            
                            
                            // check if logged user is active
                            
                        } else if lastLog.action == "Check out" {
                            // check if its today
                            if App.shared.dateFormatter.string(from: lastLogDate) == App.shared.dateFormatter.string(from: Date()) {
                                // update values
                                item.iconBorderColor = .redColor
                                
                                // check if manually clocked
                                if lastLog.entry_type == "Manual" {
                                    item.statusDetail = "\(App.shared.timeFormatter.string(from: lastLogDate)) • Manual Clock Out"
                                } else {
                                    // check
                                    if let address = lastLog.user_location_address.components(separatedBy: ", ").first {
                                        item.statusDetail = "\(App.shared.timeFormatter.string(from: lastLogDate)) • \(address)"
                                    }
                                }
                            } else {
                                item.iconBorderColor = .lightGray
                                item.statusDetail = "Not Active!"
                                item.showUserLocation = false
                            }
                        }
                    }
                }
                
                self.items = list
                self.tableView.backgroundView = nil
                self.tableView.reloadData()
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
        let indicator = UIActivityIndicatorView(frame: CGRect(x: 0, y: 0, width: 40, height: 40))
        indicator.style = UIActivityIndicatorView.Style.medium
        indicator.center = self.view.center
        self.view.addSubview(indicator)
        self.tableView.backgroundView = indicator
        indicator.startAnimating()
    }
    
    // MARK: - Refresh Control -
    
    func setupRefreshControl() {
        // init refresh control
        self.refreshControl?.addTarget(self, action: #selector(refreshData(_:)), for: .valueChanged)
        self.refreshControl?.attributedTitle = NSAttributedString(string: "Fetching Data ...")
    }
    
    @objc func refreshData(_ sender: Any) {
        self.refreshControl?.endRefreshing()
        self.removeErrorView()
        self.loadData()
    }
    
    // MARK: -  MKMapView -
    
    func checkLocation() {
        // check if location is on
        if App.shared.userLocation == nil {
            let alertController = UIAlertController(title: "", message: "Please share your location with nSmarTrac.", preferredStyle: .alert)
            let okAction = UIAlertAction(title: "OK", style: .destructive) { (alertAction) -> Void in
                if !CLLocationManager.locationServicesEnabled() {
                    if let url = URL(string: UIApplication.openSettingsURLString) {
                        UIApplication.shared.open(url, options: [:], completionHandler: nil)
                    }
                }
            }
            alertController.addAction(okAction)
            self.present(alertController, animated: true, completion: nil)
        } else {
            // display map
            self.initMap()
        }
        
        // add NotificationCenter Observers
        NotificationCenter.default.addObserver(self, selector: #selector(processLocationChange(_:)), name: Notifications.didLocationEnabled, object: nil)
    }
    
    func initMap() {
        // init
        self.mapView.delegate = self
        self.mapView.showsUserLocation = false
        
        // check if not nil
        if let userLocation = App.shared.userLocation {
            // set location
            self.location = userLocation
            
            // center users's location
            self.centerToLocation(self.location!)
        }
    }
    
    @objc func processLocationChange(_ notification: Notification) {
        self.initMap()
    }
    
    func centerToLocation(_ location: CLLocation, regionRadius: CLLocationDistance = 200) {
        let coordinateRegion = MKCoordinateRegion(center: location.coordinate, latitudinalMeters: regionRadius, longitudinalMeters: regionRadius)
        self.mapView.setRegion(coordinateRegion, animated: true)
    }
    
    func mapView(_ mapView: MKMapView, viewFor annotation: MKAnnotation) -> MKAnnotationView? {
        let annotationView = MKAnnotationView(annotation: annotation, reuseIdentifier: "custom pin")
        annotationView.image =  Utils.generateTimeClockAnnotationImage(self.annotationColor)
        annotationView.canShowCallout = true
        return annotationView
    }
    
    // MARK: - TableView Datasource -
    
    override func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    override func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return items.count + 1
    }
    
    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        // check
        if indexPath.row == items.count {
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "AddCell", for: indexPath)
            cell.imageView?.image = UIImage.fontAwesomeIcon(name: .plus, style: .regular, textColor: .greenColor, size: CGSize(width: 48, height: 48))
            return cell
        }
        
        // get item
        let item = items[indexPath.row]
        
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        cell.imageView?.image       = Utils.generateThumbnail(from: item.name, borderColor: item.iconBorderColor)
        cell.textLabel?.text        = item.name
        cell.detailTextLabel?.text  = item.statusDetail
        
        // check
        if item.user_id == App.shared.user!.id {
            // set annotation color
            self.annotationColor = item.iconBorderColor
            
            // remove all annotations
            self.mapView.removeAnnotations(mapView.annotations)
            
            // add annotation
            let annotation = MKPointAnnotation()
            annotation.coordinate = App.shared.userLocation!.coordinate
            self.mapView.addAnnotation(annotation)
        }
        
        return cell
    }
    
    override func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        // check
        if indexPath.row == items.count {
            self.pushTo(storyBoard: "Others", identifier: "sb_AttoInviteMemberController")
        } else {
            // get item
            let item = items[indexPath.row]
            
            // check
            if item.statusDetail == "Not Active!" {
                // check
                if item.user_id == App.shared.user!.id {
                    guard let tabBarController = UIApplication.shared.tabbarController() as? AttoTabController else { return }
                    tabBarController.selectedIndex = 1
                } else {
                    let controller = self.storyboard?.instantiateViewController(withIdentifier: "sb_UserActivityForInactiveController") as! UserActivityForInactiveController
                    controller.item = items[indexPath.row]
                    self.navigationController?.pushViewController(controller, animated: true)
                }
            } else {
                let controller = self.storyboard?.instantiateViewController(withIdentifier: "sb_UserActivityController") as! UserActivityController
                controller.item = items[indexPath.row]
                self.navigationController?.pushViewController(controller, animated: true)
            }
        }
    }

}

// MARK: - UIApplication used by this screen -

extension UIApplication {
    
    /*function will return reference to tabbarcontroller */
    func tabbarController() -> UIViewController? {
        guard let vcs = self.keyWindow?.rootViewController?.children else { return nil }
        for vc in vcs {
            if  let _ = vc as? AttoTabController {
                return vc
            }
        }
        return nil
    }
}
