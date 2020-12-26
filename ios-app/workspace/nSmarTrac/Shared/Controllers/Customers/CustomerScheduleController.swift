//
//  CustomerScheduleController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 08/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import CoreLocation
import Floaty
import FontAwesome_swift
import MapKit
import SVProgressHUD

class CustomerScheduleController: UITableViewController, MKMapViewDelegate {
    
    // MARK: - Properties -
    
    @IBOutlet var mapView: MKMapView!
    
    var indicator = UIActivityIndicatorView()
    var floaty = Floaty()
    
    let locationManager = CLLocationManager()
    var regionRadius: CLLocationDistance = 1000
    var location: CLLocation?
    
    var items: [Any] = []
    var filteredItems: [Any] = []
    var groupedItems: [Object] = []
    
    struct Object {
        var group: String
        var item: [Any]
    }
    
    let item: Customer = App.shared.selectedCustomer!
    
    
    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        checkLocation()
        initFAB()
        setupIndicator()
        setupRefreshControl()
    }
    
    override func viewWillAppear(_ animated: Bool) {
        loadData()
        
        // set title
        self.parent?.navigationItem.title = "Schedule"
    }
    
    // MARK: - Load data -
    
    func loadData() {
        // clear items
        self.items.removeAll()
        
        // add data
        self.items.append(contentsOf: item.events)
        self.items.append(contentsOf: item.work_orders)
        
        // sort ungrouped
        let ungrouped: [Any] = items.sorted(by: {($0 as AnyObject).start_date > ($1 as AnyObject).start_date})
        // group
        let grouped = ungrouped.group(by: {($0 as AnyObject).start_date!})
        // sort
        let sorted = grouped.sorted(by: {$0.key < $1.key})
        // create temp groupedObjects
        var tempGroupedObjects = [Object]()
        // iterate
        for (key, value) in sorted {
            tempGroupedObjects.append(Object(group: String(key), item: value))
        }
        
        self.groupedItems = tempGroupedObjects
        self.tableView.backgroundView = nil
        self.tableView.reloadData()
        self.refreshControl?.endRefreshing()
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
        self.refreshControl?.addTarget(self, action: #selector(refreshData(_:)), for: .valueChanged)
        self.refreshControl?.attributedTitle = NSAttributedString(string: "Fetching Data ...")
    }
    
    @objc func refreshData(_ sender: Any) {
        self.refreshControl?.endRefreshing()
        self.loadData()
    }
    
    // MARK: - TableView Datasource -

    override func numberOfSections(in tableView: UITableView) -> Int {
        return groupedItems.count
    }
    
    override func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return groupedItems[section].item.count
    }
    
    override func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        let item = groupedItems[indexPath.section].item[indexPath.row] as AnyObject
        // check if event, block or work order
        if item.event_type == "Event" || item.event_type == "Block" {
            return 105
        }
        return 205
    }
    
    override func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 32
    }
    
    override func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        return 1
    }
    
    override func tableView(_ tableView: UITableView, viewForHeaderInSection section: Int) -> UIView? {
        return Utils.createHeader(App.shared.headerBgColor, App.shared.headerColor, groupedItems[section].group.toReadableDate)
    }
    
    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let item = groupedItems[indexPath.section].item[indexPath.row] as AnyObject
        
        // get schedule date
        var startDate = item.start_date.getDay + ", " + item.start_date.toReadableDate
        // check start and end date
        if item.start_date == item.end_date {
            startDate += ", " + item.start_time + " - " + item.end_time
        } else {
            startDate += ", " + item.start_time + " - " + item.end_date.getDay + ", " + item.end_date.toReadableDate  + ", " + item.end_time
        }
        
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        
        // remove other views
        cell.contentView.subviews.forEach {
            $0.removeFromSuperview()
        }
        
        // check if event, block or work order
        if item.event_type == "Event" || item.event_type == "Block" {
            // add schedule color
            let eventColor = UIView(frame: CGRect(x: 0, y: 0, width: 7, height: 200))
            eventColor.backgroundColor = UIColor(hex: item.event_color)
            cell.contentView.addSubview(eventColor)
            
            // nameButton
            let nameButton = Utils.createPurpleButton(28, 12, Int(Device.width-40), item.event_description, hasArrow: true)
            cell.contentView.addSubview(nameButton)
            
            // topLeft view
            let topLeft = Utils.createView(20, 50, Int((Device.width-40)/2), 50, "SCHEDULE ON", startDate, [.top, .right])
            cell.contentView.addSubview(topLeft)
            
            // topRight view
            let topRight = Utils.createView(Int(Device.width/2), 50, Int((Device.width-40)/2), 50, "EMPLOYEES", item.employee_name, [.top])
            cell.contentView.addSubview(topRight)
            
            // bottom border
            let bottomBorder = Utils.createBottomBorder(100)
            cell.contentView.addSubview(bottomBorder)
            
        } else {
            // add schedule color
            let eventColor = UIView(frame: CGRect(x: 0, y: 0, width: 7, height: 200))
            eventColor.backgroundColor = UIColor(hex: item.event_color)
            cell.contentView.addSubview(eventColor)
            
            // nameButton
            let nameButton = Utils.createPurpleButton(28, 12, Int(Device.width-40), item.job_name, hasArrow: true)
            cell.contentView.addSubview(nameButton)
            
            // topLeft view
            let topLeft = Utils.createView(20, 50, Int((Device.width-40)/2), 50, "DATE ISSUED", item.date_issued.toReadableDate, [.top, .right])
            cell.contentView.addSubview(topLeft)
            
            // topRight view
            let topRight = Utils.createView(Int(Device.width/2), 50, Int((Device.width-40)/2), 50, "EMPLOYEES", item.employee_name, [.top])
            cell.contentView.addSubview(topRight)
            
            // bottomLeft view
            let bottomLeft = Utils.createView(20, 100, Int((Device.width-40)/2), 50, "PRIORITY", item.priority, [.top, .right])
            cell.contentView.addSubview(bottomLeft)
            
            // bottomRight view
            let bottomRight = Utils.createView(Int(Device.width/2), 100, Int((Device.width-40)/2), 50, "STATUS", "Scheduled", [.top])
            cell.contentView.addSubview(bottomRight)
            
            // dateLabel
            let dateLabel = Utils.createView(20, 150, Int(Device.width-40), 50, "SCHEDULE ON", startDate, [.top])
            cell.contentView.addSubview(dateLabel)
            
            // bottom border
            let bottomBorder = Utils.createBottomBorder(200)
            cell.contentView.addSubview(bottomBorder)
        }
        
        return cell
    }
    
    override func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        let item = groupedItems[indexPath.section].item[indexPath.row] as AnyObject
        
        // check if event, block or work order
        if item.event_type == "Event" {
            App.shared.selectedEvent = item as? Event
            self.pushTo(storyBoard: "Main", identifier: "sb_ScheduleTabController")
        } else if item.event_type == "Block" {
            App.shared.selectedEvent = item as? Event
            self.pushTo(storyBoard: "Main", identifier: "sb_BlockDetailController")
        } else {
            App.shared.selectedWorkOrder = item as? WorkOrder
            self.pushTo(storyBoard: "Main", identifier: "sb_WorkOrderTabController")
        }
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
        self.mapView.showsUserLocation = true
        
        if let address = item.address.first {
            // get complete address
            let customerAddress = "\(address.address1) \(!address.address2.isEmpty), \(address.city), \(address.state) \(address.postal_code)"
            // get location
            CLGeocoder().geocodeAddressString(customerAddress, completionHandler: { placemarks, error in
                if (error != nil) {
                    return
                }

                if let placemark = placemarks?[0]  {
                    // set location
                    self.location = placemark.location!
                    
                    // center customer's location
                    self.centerToLocation(self.location!)
                    
                    // focus to customer's location
                    self.focusToLocation(self.location!)
                    
                    
                    self.mapView.removeOverlays(self.mapView.overlays)
                    
                    // add annotation
                    let annotation = MKPointAnnotation()
                    annotation.title = self.item.contact_name
                    annotation.coordinate = self.location!.coordinate
                    self.mapView.addAnnotation(annotation)
                }
            })
        }
    }
    
    @objc func processLocationChange(_ notification: Notification) {
        self.initMap()
    }
    
    func centerToLocation(_ location: CLLocation, regionRadius: CLLocationDistance = 5000) {
        let coordinateRegion = MKCoordinateRegion(center: location.coordinate, latitudinalMeters: regionRadius, longitudinalMeters: regionRadius)
        self.mapView.setRegion(coordinateRegion, animated: true)
    }
    
    func focusToLocation(_ location: CLLocation, regionRadius: CLLocationDistance = 5000) {
        let region = MKCoordinateRegion(center: location.coordinate, latitudinalMeters: regionRadius, longitudinalMeters: regionRadius)
        self.mapView.setCameraBoundary(MKMapView.CameraBoundary(coordinateRegion: region), animated: true)
        
        let zoomRange = MKMapView.CameraZoomRange(maxCenterCoordinateDistance: 200000)
        self.mapView.setCameraZoomRange(zoomRange, animated: true)
    }
    
    // MARK: -  MKMapViewDelegate -
    
    func mapView(_ mapView: MKMapView, rendererFor overlay: MKOverlay) -> MKOverlayRenderer {
        if overlay is MKCircle {
            let renderer = MKCircleRenderer(overlay: overlay)
            renderer.fillColor = UIColor.blue.withAlphaComponent(0.08)
            return renderer
        } else {
            return MKPolylineRenderer()
        }
    }
    
    func mapView(_ mapView: MKMapView, viewFor annotation: MKAnnotation) -> MKAnnotationView? {
        if annotation is MKUserLocation { return nil }
        
        let identifier = "Annotation"
        var annotationView = mapView.dequeueReusableAnnotationView(withIdentifier: identifier)
        
        if annotationView == nil {
            annotationView = CustomAnnotationView(annotation: annotation, reuseIdentifier: identifier)
        } else {
            annotationView?.annotation = annotation
        }
        
        return annotationView
    }
}

// MARK: - Floaty Delegate -

extension CustomerScheduleController: FloatyDelegate, UIGestureRecognizerDelegate {
    
    func initFAB() {
        
        // init
        floaty.fabDelegate  = self
        floaty.sticky       = true
        floaty.buttonColor  = .greenColor
        floaty.buttonImage  = UIImage.fontAwesomeIcon(name: .plus, style: .solid, textColor: .white, size: CGSize(width: 30, height: 30))
        floaty.paddingY     = 90
        
        let tap = UITapGestureRecognizer(target: self, action: #selector(addButtonClick(_:)))
        floaty.addGestureRecognizer(tap)
        
        self.view.addSubview(floaty)
    }
    
    @objc func addButtonClick(_ sender: Any) {
        //self.pushTo(storyBoard: "Main", identifier: "sb_AddCustomerScheduleController")
    }
}
