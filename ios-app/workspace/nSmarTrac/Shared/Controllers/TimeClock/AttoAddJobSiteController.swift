//
//  AttoAddJobSiteController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 27/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import CoreLocation
import MapKit
import SVProgressHUD

class AttoAddJobSiteController: UITableViewController, MKMapViewDelegate {
    
    // MARK: - Properties -
    
    @IBOutlet var nameField: MaterialTextField!
    @IBOutlet var addressField: MaterialTextField!
    @IBOutlet var diameterField: MaterialDropdownField!
    @IBOutlet var mapView: MKMapView!
    
    let locationManager = CLLocationManager()
    var regionRadius: CLLocationDistance = 200
    var location: CLLocation?
    
    

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
        diameterField.updateOptions(options: ["200", "400", "600", "800", "1000", "1200", "1400", "1600", "1800", "2000"])
        diameterField.setSelectedOption(option: "200")
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
        App.shared.api.postTimesheetJobSite(params) { (result, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard result?.Code == 200 else {
                return SVProgressHUD.showError(withStatus: result!.Message)
            }
                
            self.popViewController()
        }
    }
    
}
