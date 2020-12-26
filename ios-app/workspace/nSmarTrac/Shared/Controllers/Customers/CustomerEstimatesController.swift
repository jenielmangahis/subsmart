//
//  CustomerEstimatesController.swift
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

class CustomerEstimatesController: UITableViewController, MKMapViewDelegate {
    
    // MARK: - Properties -
    
    @IBOutlet var mapView: MKMapView!
    
    var indicator = UIActivityIndicatorView()
    var floaty = Floaty()
    
    let locationManager = CLLocationManager()
    var regionRadius: CLLocationDistance = 1000
    var location: CLLocation?
    
    var items: [Estimate] = []
    var filteredItems: [Estimate] = []
    var groupedItems: [Object] = []
    
    struct Object {
        var group: String
        var item: [Estimate]
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
        self.parent?.navigationItem.title = "Estimates"
    }
    
    // MARK: - Load data -
    
    func loadData() {
        // set data
        self.items = item.estimates
        
        // sort ungrouped
        let ungrouped = self.items.sorted(by: {$0.job_name.prefix(1) > $1.job_name.prefix(1)})
        // group
        let grouped = ungrouped.group(by: {$0.job_name.prefix(1)})
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
    
    override func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 32
    }
    
    override func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        return 1
    }
    
    override func tableView(_ tableView: UITableView, viewForHeaderInSection section: Int) -> UIView? {
        return Utils.createHeader(App.shared.headerBgColor, App.shared.headerColor, groupedItems[section].group.uppercased())
    }
    
    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let item = groupedItems[indexPath.section].item[indexPath.row]
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        
        // remove other views
        cell.contentView.subviews.forEach {
            $0.removeFromSuperview()
        }
        
        // nameButton
        let nameButton = Utils.createPurpleButton(28, 12, Int(Device.width-40), "\(item.customer_name) (\(item.job_name))", hasArrow: true)
        cell.contentView.addSubview(nameButton)
        
        // topLeft view
        let topLeft = Utils.createView(20, 50, Int((Device.width-40)/2), 50, "ESTIMATE #", item.estimate_number, [.top, .right])
        cell.contentView.addSubview(topLeft)
        
        // topRight view
        let topRight = Utils.createView(Int(Device.width/2), 50, Int((Device.width-40)/2), 50, "DATE", item.estimate_date.toReadableDate, [.top])
        cell.contentView.addSubview(topRight)
        
        // bottomLeft view
        let bottomLeft = Utils.createView(20, 100, Int((Device.width-40)/2), 50, "STATUS", item.status, [.top, .right])
        cell.contentView.addSubview(bottomLeft)
        
        // bottomRight view
        let bottomRight = Utils.createView(Int(Device.width/2), 100, Int((Device.width-40)/2), 50, "AMOUNT", "$\(item.estimate_value)", [.top])
        cell.contentView.addSubview(bottomRight)
        
        // bottom border
        let bottomBorder = Utils.createBottomBorder(150)
        cell.contentView.addSubview(bottomBorder)
        
        return cell
    }
    
    override func tableView(_ tableView: UITableView, trailingSwipeActionsConfigurationForRowAt indexPath: IndexPath) -> UISwipeActionsConfiguration? {
        // delete button
        let delete = UIContextualAction(style: .destructive, title: "") {  (contextualAction, view, boolValue) in
            // delete item at indexPath
            let item = self.groupedItems[indexPath.section].item[indexPath.row]
            
            SVProgressHUD.setDefaultMaskType(.clear)
            SVProgressHUD.show(withStatus: "Deleting...")
            App.shared.api.deleteEstimate(item.id.intValue) { (success, error) in
                SVProgressHUD.setDefaultMaskType(.none)
                SVProgressHUD.dismiss()
                guard error == nil else {
                    return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                }
                guard success == true else {
                    return SVProgressHUD.showError(withStatus: "Deleting item failed!")
                }
                
                self.groupedItems[indexPath.section].item.remove(at: indexPath.row)
                tableView.deleteRows(at: [indexPath], with: .fade)
                tableView.beginUpdates()
                tableView.endUpdates()
            }
        }
        delete.image = UIImage.fontAwesomeIcon(name: .trashAlt, style: .regular, textColor: .white, size: CGSize(width: 24, height: 24))
        
        // edit button
        let edit = UIContextualAction(style: .normal, title: "") {  (contextualAction, view, boolValue) in
            // get item
            let item =  self.groupedItems[indexPath.section].item[indexPath.row]
            // check type
            if item.estimate_type == "Standard" {
                // edit item at indexPath
                let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_EditStandardEstimateController") as? EditStandardEstimateController
                viewController?.item = item
                self.navigationController?.pushViewController(viewController!, animated: true)
            } else if item.estimate_type == "Option" {
                // edit item at indexPath
                let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_EditCustomEstimateController") as? EditCustomEstimateController
                viewController?.item = item
                self.navigationController?.pushViewController(viewController!, animated: true)
            }
        }
        edit.image = UIImage.fontAwesomeIcon(name: .pen, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        edit.backgroundColor = .blueColor

        return UISwipeActionsConfiguration(actions: [delete, edit])
    }
    
    override func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        App.shared.selectedEstimate = groupedItems[indexPath.section].item[indexPath.row]
        self.pushTo(storyBoard: "Main", identifier: "sb_EstimatePreviewController")
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

extension CustomerEstimatesController: FloatyDelegate, UIGestureRecognizerDelegate {
    
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
        let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_AddStandardEstimateController") as? AddStandardEstimateController
        viewController?.selectedCustomer = item
        self.navigationController?.pushViewController(viewController!, animated: true)
    }
}
