//
//  AddEventController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 13/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import DLRadioButton

class AddEventController: UITableViewController {

    // MARK: - Properties -

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


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        configureRadioButtons()
                
        self.title = "New Event"
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

}
