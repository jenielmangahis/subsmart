//
//  EditWorkOrderController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 13/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import CoreLocation
import DLRadioButton
import GooglePlaces

class EditWorkOrderController: UITableViewController {

    // MARK: - Properties -
    
    @IBOutlet var customerField: MaterialDropdownField!
    @IBOutlet var jobLocationField: MaterialTextField!

    @IBOutlet var defaultRadio: DLRadioButton!
    @IBOutlet var redRadio: DLRadioButton!
    @IBOutlet var pinkRadio: DLRadioButton!
    @IBOutlet var magentaRadio: DLRadioButton!
    @IBOutlet var purpleRadio: DLRadioButton!
    @IBOutlet var blueRadio: DLRadioButton!
    @IBOutlet var tealRadio: DLRadioButton!
    @IBOutlet var greenRadio: DLRadioButton!
    @IBOutlet var goldRadio: DLRadioButton!
    
    var otherButtons: [DLRadioButton] = []
    
    let placesClient = GMSPlacesClient.shared()
    var location: CLLocationCoordinate2D!



    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        configureRadioButtons()
                
        self.title = "Edit Work Order"
        
        jobLocationField.addTarget(self, action: #selector(autocompleteClicked(_:)), for: .editingDidBegin)
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func configureRadioButtons() {
        otherButtons = [redRadio, pinkRadio, magentaRadio, purpleRadio, blueRadio, tealRadio, greenRadio, goldRadio]
        defaultRadio.isMultipleSelectionEnabled = false
        defaultRadio.isSelected = true
        defaultRadio.otherButtons = otherButtons
    }
    
    // MARK: - Actions -
    
    @objc func autocompleteClicked(_ sender: Any) {
        let autocompleteController = GMSAutocompleteViewController()
        autocompleteController.delegate = self
        
        // Specify the place data types to return.
        let fields: GMSPlaceField = GMSPlaceField(rawValue: UInt(GMSPlaceField.all.rawValue))!
        autocompleteController.placeFields = fields
        
        // Specify a filter.
        let filter = GMSAutocompleteFilter()
        filter.type = .city
        autocompleteController.autocompleteFilter = filter
        
        // Display the autocomplete view controller.
        present(autocompleteController, animated: true, completion: nil)
    }

}

// MARK: - GMSAutocompleteViewControllerDelegate

extension EditWorkOrderController: GMSAutocompleteViewControllerDelegate {
    
    func viewController(_ viewController: GMSAutocompleteViewController, didAutocompleteWith place: GMSPlace) {
        self.location = place.coordinate
        self.jobLocationField.text = place.formattedAddress
        
        dismiss(animated: true, completion: nil)
    }
    
    func viewController(_ viewController: GMSAutocompleteViewController, didFailAutocompleteWithError error: Error) {
        print("Error: ", error.localizedDescription)
    }
    
    func wasCancelled(_ viewController: GMSAutocompleteViewController) {
        dismiss(animated: true, completion: nil)
    }
}
