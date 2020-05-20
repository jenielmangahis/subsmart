//
//  LoginController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 04/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import DLRadioButton
import FontAwesome_swift

class LoginController: UIViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var businessNameField: MaterialTextField!
    @IBOutlet var emailField: MaterialTextField!
    @IBOutlet var passwordField: MaterialTextField!
    @IBOutlet var checkbox: DLRadioButton!
    @IBOutlet var submitButton: DesignableButton!
    @IBOutlet var problemSignInLabel: UILabel!
    @IBOutlet var testButton: DesignableButton!
    @IBOutlet var brandLabel: UILabel!
    

    // MARK: - Lifecycle -
    
    override func viewDidLoad() {
        super.viewDidLoad()
        configureCheckbox()
        
        brandLabel.text = Global.brandingText
    }
    
    // MARK: - Actions -
    
    @IBAction func submitButtonTapped(_ sender: Any) {
        NotificationCenter.default.post(name: Notifications.didLogin, object: self, userInfo: nil)
    }
    
    @IBAction func testButtonTapped(_ sender: Any) {
    }
    
    // MARK: - Functions -
    
    func configureCheckbox() {
        checkbox.setTitle("Keep me signed in", for: .normal)
        checkbox.setTitleColor(AppTheme.defaultColor, for: .normal)
        checkbox.setTitleColor(AppTheme.defaultColor, for: .selected)
        checkbox.icon = UIImage.fontAwesomeIcon(name: .square, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 24, height: 24))
        checkbox.iconSelected = UIImage.fontAwesomeIcon(name: .checkSquare, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 24, height: 24))
        checkbox.isMultipleSelectionEnabled = false
        checkbox.contentHorizontalAlignment = .left
        checkbox.titleLabel?.font = UIFont.robotoFont(ofSize: 13)
        checkbox.titleLabel?.adjustsFontSizeToFitWidth = true
        checkbox.titleLabel?.lineBreakMode = .byClipping
        checkbox.titleLabel?.textAlignment = .left
        checkbox.setBackgroundColor(UIColor.clear, for: .normal)
        checkbox.setBackgroundColor(UIColor.clear, for: .selected)
    }
    
}
