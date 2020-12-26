//
//  CustomerDetailController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 08/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import CoreLocation
import FontAwesome_swift
import MapKit
import MessageUI

class CustomerDetailController: UITableViewController, MFMessageComposeViewControllerDelegate, MFMailComposeViewControllerDelegate, MKMapViewDelegate {
    
    // MARK: - Properties -
    
    @IBOutlet var mapView: MKMapView!
    
    @IBOutlet var nameIcon: UIImageView!
    @IBOutlet var emailIcon: UIImageView!
    @IBOutlet var mobileIcon: UIImageView!
    @IBOutlet var phoneIcon: UIImageView!
    @IBOutlet var emailNotifyIcon: UIImageView!
    @IBOutlet var smsNotifyIcon: UIImageView!
    @IBOutlet var locationIcon: UIImageView!
    
    @IBOutlet var nameLabel: UILabel!
    @IBOutlet var emailLabel: UILabel!
    @IBOutlet var mobileLabel: UILabel!
    @IBOutlet var phoneLabel: UILabel!
    @IBOutlet var emailNotifyLabel: UILabel!
    @IBOutlet var smsNotifyLabel: UILabel!
    @IBOutlet var addressLabel: UILabel!
    
    @IBOutlet var btnMap: UIButton!
    @IBOutlet var btnCopy: UIButton!
    
    let locationManager = CLLocationManager()
    var regionRadius: CLLocationDistance = 1000
    var location: CLLocation?
    
    let item: Customer = App.shared.selectedCustomer!
    
    
    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        checkLocation()
        
        // configure icons
        nameIcon.image = UIImage.fontAwesomeIcon(name: .user, style: .solid, textColor: App.shared.iconColor, size: CGSize(width: 22, height: 22))
        emailIcon.image = UIImage.fontAwesomeIcon(name: .envelope, style: .regular, textColor: App.shared.iconColor, size: CGSize(width: 22, height: 22))
        mobileIcon.image = UIImage.fontAwesomeIcon(name: .mobileAlt, style: .regular, textColor: App.shared.iconColor, size: CGSize(width: 22, height: 22))
        phoneIcon.image = UIImage.fontAwesomeIcon(name: .phone, style: .solid, textColor: App.shared.iconColor, size: CGSize(width: 22, height: 22))
        emailNotifyIcon.image = UIImage.fontAwesomeIcon(name: .envelope, style: .regular, textColor: App.shared.iconColor, size: CGSize(width: 22, height: 22))
        smsNotifyIcon.image = UIImage.fontAwesomeIcon(name: .sms, style: .solid, textColor: App.shared.iconColor, size: CGSize(width: 22, height: 22))
        locationIcon.image = UIImage.fontAwesomeIcon(name: .mapMarkerAlt, style: .solid, textColor: App.shared.iconColor, size: CGSize(width: 22, height: 22))
        
        btnMap.setImage(UIImage.fontAwesomeIcon(name: .map, style: .regular, textColor: .systemBlue, size: CGSize(width: 22, height: 22)), for: .normal)
        btnCopy.setImage(UIImage.fontAwesomeIcon(name: .copy, style: .regular, textColor: .systemBlue, size: CGSize(width: 22, height: 22)), for: .normal)
    }
    
    override func viewWillAppear(_ animated: Bool) {
        loadData()
        
        // set title
        self.parent?.navigationItem.title = "Customer's Detail"
    }
    
    // MARK: - Load data -
    
    func loadData() {
        nameLabel.text          = item.contact_name
        emailLabel.text         = item.contact_email
        mobileLabel.text        = item.mobile
        phoneLabel.text         = item.phone
        emailNotifyLabel.text   = "Email Notify: \(item.notify_email ? "Yes" : "No")"
        smsNotifyLabel.text     = "SMS Notify: \(item.notify_sms ? "Yes" : "No")"
        // check address
        if let address = item.address.first {
            addressLabel.text       = address.address1 + ", " + address.address2 + ", " + address.city + ", " + address.state + " " + address.postal_code
        }
    }
    
    // MARK: - Actions -
    
    @IBAction func emailButtonTapped(_ sender: Any) {
        if MFMailComposeViewController.canSendMail() {
            let mail = MFMailComposeViewController()
            mail.mailComposeDelegate = self
            mail.setToRecipients([item.contact_email])
            mail.setSubject("")
            mail.setMessageBody("", isHTML: true)
            present(mail, animated: true)
        }
    }
    
    @IBAction func callMobileButtonTapped(_ sender: Any) {
        if !item.mobile.isEmpty {
            if let url = URL(string: "tel://" + item.mobile.unformatContactNumber!) {
                if UIApplication.shared.canOpenURL(url) {
                    UIApplication.shared.open(url, options: [:], completionHandler: nil)
                }
            }
        }
    }
    
    @IBAction func smsMobileButtonTapped(_ sender: Any) {
        if !item.mobile.isEmpty {
            if (MFMessageComposeViewController.canSendText()) {
                let controller = MFMessageComposeViewController()
                controller.body = ""
                controller.recipients = [item.mobile]
                controller.messageComposeDelegate = self
                self.present(controller, animated: true, completion: nil)
            }
        }
    }
    
    @IBAction func callPhoneButtonTapped(_ sender: Any) {
        if !item.phone.isEmpty {
            if let url = URL(string: "tel://" + item.phone.unformatContactNumber!) {
                if UIApplication.shared.canOpenURL(url) {
                    UIApplication.shared.open(url, options: [:], completionHandler: nil)
                }
            }
        }
    }
    
    @IBAction func smsPhoneButtonTapped(_ sender: Any) {
        if !item.phone.isEmpty {
            if (MFMessageComposeViewController.canSendText()) {
                let controller = MFMessageComposeViewController()
                controller.body = ""
                controller.recipients = [item.phone]
                controller.messageComposeDelegate = self
                self.present(controller, animated: true, completion: nil)
            }
        }
    }
    
    @IBAction func openMapButtonTapped(_ sender: Any) {
        if let location = self.location {
            // create actionSheet
            let actionSheet = UIAlertController(title: nil, message: "Select app for navigation", preferredStyle: .actionSheet)
            // add action
            actionSheet.addAction(UIAlertAction(title: "Apple Map", style: .default) { action -> Void in
                // open in apple map
                let regionSpan = MKCoordinateRegion(center: location.coordinate, latitudinalMeters: self.regionRadius, longitudinalMeters: self.regionRadius)
                let options = [
                    MKLaunchOptionsMapCenterKey: NSValue(mkCoordinate: regionSpan.center),
                    MKLaunchOptionsMapSpanKey: NSValue(mkCoordinateSpan: regionSpan.span)
                ]
                let placemark = MKPlacemark(coordinate: location.coordinate, addressDictionary: nil)
                let mapItem = MKMapItem(placemark: placemark)
                mapItem.openInMaps(launchOptions: options)
            })
            actionSheet.addAction(UIAlertAction(title: "Google Map", style: .default)  { action -> Void in
                // open in google map
                if (UIApplication.shared.canOpenURL(URL(string:"comgooglemaps://")!)) {
                    UIApplication.shared.openURL(URL(string:
                        "comgooglemaps://?saddr=&daddr=\(location.coordinate.latitude),\(location.coordinate.longitude)&directionsmode=driving")!)
                }
            })
            // add cancel
            actionSheet.addAction(UIAlertAction(title: "Cancel", style: .cancel)  { action -> Void in
                actionSheet.dismiss(animated: true, completion: nil)
            })
            // present actionSheet
            self.present(actionSheet, animated: true, completion: nil)
        }
    }
    
    @IBAction func copyAddressButtonTapped(_ sender: Any) {
    }
    
    // MARK: - MFMessageComposeViewControllerDelegate -
    
    func messageComposeViewController(_ controller: MFMessageComposeViewController, didFinishWith result: MessageComposeResult) {
        switch (result) {
            case .cancelled:
                print("Message was cancelled")
                dismiss(animated: true, completion: nil)
            case .failed:
                print("Message failed")
                dismiss(animated: true, completion: nil)
            case .sent:
                print("Message was sent")
                dismiss(animated: true, completion: nil)
            default:
                break
        }
    }
    
    // MARK: - MFMailComposeViewControllerDelegate -
    
    func mailComposeController(_ controller: MFMailComposeViewController, didFinishWith result: MFMailComposeResult, error: Error?) {
        controller.dismiss(animated: true)
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
