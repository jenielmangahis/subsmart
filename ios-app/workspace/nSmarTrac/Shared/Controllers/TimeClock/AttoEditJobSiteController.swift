//
//  AttoEditJobSiteController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 11/10/20.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import CoreLocation
import MapKit
import SVProgressHUD

class AttoEditJobSiteController: UITableViewController, MKMapViewDelegate {

    // MARK: - Properties -
    
    @IBOutlet var nameField: MaterialTextField!
    @IBOutlet var addressField: MaterialTextField!
    @IBOutlet var diameterField: MaterialDropdownField!
    @IBOutlet var mapView: MKMapView!
    
    let locationManager = CLLocationManager()
    var regionRadius: CLLocationDistance = 200
    var location: CLLocation?
    
    var item: TimesheetJobSite!
    
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        checkLocation()
        initViews()
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func initViews() {
        // init
        nameField.text = item.name
        addressField.text = item.address
        diameterField.text = item.diameter + " Feet"
            
        diameterField.updateOptions(options: ["200", "400", "600", "800", "1000", "1200", "1400", "1600", "1800", "2000"])
        diameterField.setSelectedOption(option: item.diameter)
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
        if let lat = item.coordinates.components(separatedBy: ",").first,
            let lon = item.coordinates.components(separatedBy: ",").last {
            
            // set location
            self.location = CLLocation(latitude: lat.doubleValue, longitude: lon.doubleValue)
            
            // center users's location
            self.centerToLocation(self.location!, regionRadius: CLLocationDistance(item.diameter)!)
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
        annotationView.image =  Utils.generateTimeClockAnnotationImage(.lightGray)
        annotationView.canShowCallout = true
        return annotationView
    }
    
    func mapView(_ mapView: MKMapView, regionDidChangeAnimated animated: Bool) {
        // Remove all annotations
        self.mapView.removeAnnotations(mapView.annotations)

        // Add new annotation
        let annotation = MKPointAnnotation()
        annotation.coordinate = mapView.centerCoordinate
        self.mapView.addAnnotation(annotation)
        
        // get address
        self.getAddress(completion: { address in
            self.addressField.text = address!
        })
    }
    
    func getAddress(completion: @escaping (_ address: String?) -> Void) {
        // get location
        let coordinates = self.mapView.centerCoordinate
        let userLocation = CLLocation(latitude: coordinates.latitude, longitude: coordinates.longitude)
        
        // geocode location
        CLGeocoder().reverseGeocodeLocation(userLocation) { (placemarks, error) in
            if let placemark = placemarks?.first {
                let address = [placemark.subLocality!, placemark.locality!, placemark.administrativeArea!, placemark.postalCode!, placemark.country!]
                
                return completion(address.joined(separator: ", "))
            }
        }
    }
    
    // MARK: - Actions -
    
    @IBAction func deleteButtonTapped(_ sender: Any) {
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show(withStatus: "Deleting...")
        App.shared.api.deleteTimesheetJobSite(item.id.intValue) { (success, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
                
            self.dismiss(animated: true, completion: nil)
        }
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        
        // get coordinates
        let coordinates = self.mapView.centerCoordinate
        
        
        let params: Parameters = ["name": nameField.text!,
                                  "address": addressField.text!,
                                  "coordinates": "\(coordinates.latitude),\(coordinates.longitude)",
                                  "diameter": diameterField.text!,
                                  "company_id": App.shared.companyId]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show(withStatus: "Saving...")
        App.shared.api.putTimesheetJobSite(item.id.intValue, params: params) { (success, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
                
            self.popViewController()
        }
    }

}
