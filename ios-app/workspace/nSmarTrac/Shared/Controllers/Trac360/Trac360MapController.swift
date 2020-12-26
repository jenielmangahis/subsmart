//
//  Trac360MapController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 12/2/20.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import CoreLocation
import FontAwesome_swift
import JPSThumbnailAnnotation
import MapKit

class Trac360MapController: UIViewController, MKMapViewDelegate {

    // MARK: - Properties -
    
    @IBOutlet var mapView: MKMapView!
    
    var indicator = UIActivityIndicatorView()
    var refreshControl = UIRefreshControl()
    
    let locationManager = CLLocationManager()
    var regionRadius: CLLocationDistance = 5000
    var location: CLLocation?
    
    var originalPullUpControllerViewSize: CGSize = .zero
    
    var isPeopleDetail: Bool = false
    
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        
        // check
        if isPeopleDetail {
            let pullUpController = initPullupDetailController()
            _ = pullUpController.view
            addPullUpController(pullUpController, initialStickyPointOffset: pullUpController.initialPointOffset, animated: true)
        } else {
            let pullUpController = initPullupController()
            _ = pullUpController.view
            addPullUpController(pullUpController, initialStickyPointOffset: pullUpController.initialPointOffset, animated: true)
        }
    }
    
    override func viewDidAppear(_ animated: Bool) {
        checkLocation()
        
        self.parent?.navigationItem.title = "People"
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
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
        
        // check if not nil
        if let userLocation = App.shared.userLocation {
            // set location
            self.location = userLocation
            
            // check
            if !isPeopleDetail {
                // center users's location
                self.centerToLocation(self.location!)
            }
        }
    }
    
    @objc func processLocationChange(_ notification: Notification) {
        self.initMap()
    }
    
    func centerToLocation(_ location: CLLocation, regionRadius: CLLocationDistance = 5000) {
        let coordinateRegion = MKCoordinateRegion(center: location.coordinate, latitudinalMeters: regionRadius, longitudinalMeters: regionRadius)
        self.mapView.setRegion(coordinateRegion, animated: true)
    }
    
    func zoom(to location: CLLocationCoordinate2D) {
        let span = MKCoordinateSpan(latitudeDelta: 0.05, longitudeDelta: 0.05)
        let region = MKCoordinateRegion(center: location, span: span)
        self.mapView.setRegion(region, animated: true)
    }
    
    func addAnnotation(coordinate: CLLocationCoordinate2D, image: UIImage) {
        let thumbnail = JPSThumbnail()
        thumbnail.image = image
        thumbnail.coordinate = coordinate
        self.mapView.addAnnotation(JPSThumbnailAnnotation(thumbnail: thumbnail))
    }
    
    /*func mapView(_ mapView: MKMapView, didSelect view: MKAnnotationView) {
        if view is JPSThumbnailAnnotationViewProtocol {
            (view as? NSObjectProtocol & JPSThumbnailAnnotationViewProtocol)?.didSelectAnnotationView(inMap: mapView)
        }
    }

    func mapView(_ mapView: MKMapView, didDeselect view: MKAnnotationView) {
        if view is JPSThumbnailAnnotationViewProtocol {
            (view as? NSObjectProtocol & JPSThumbnailAnnotationViewProtocol)?.didDeselectAnnotationView(inMap: mapView)
        }
    }*/

    func mapView(_ mapView: MKMapView, viewFor annotation: MKAnnotation) -> MKAnnotationView? {
        if annotation is JPSThumbnailAnnotationProtocol {
            return (annotation as? NSObjectProtocol & JPSThumbnailAnnotationProtocol)?.annotationView(inMap: mapView)
        }
        return nil
    }
    
    // MARK: - PullupController -
    
    private func initPullupController() -> Trac360PeopleController {
        let currentPullUpController = children.filter({ $0 is Trac360PeopleController }).first as? Trac360PeopleController
        let pullUpController: Trac360PeopleController = currentPullUpController ?? self.storyboard?.instantiateViewController(withIdentifier: "sb_Trac360PeopleController") as! Trac360PeopleController
        
        // check
        if originalPullUpControllerViewSize == .zero {
            originalPullUpControllerViewSize = pullUpController.view.bounds.size
        }

        return pullUpController
    }
    
    private func initPullupDetailController() -> Trac360PeopleDetailController {
        let currentPullUpController = children.filter({ $0 is Trac360PeopleDetailController }).first as? Trac360PeopleDetailController
        let pullUpController: Trac360PeopleDetailController = currentPullUpController ?? self.storyboard?.instantiateViewController(withIdentifier: "sb_Trac360PeopleDetailController") as! Trac360PeopleDetailController
        
        // check
        if originalPullUpControllerViewSize == .zero {
            originalPullUpControllerViewSize = pullUpController.view.bounds.size
        }

        return pullUpController
    }

}
