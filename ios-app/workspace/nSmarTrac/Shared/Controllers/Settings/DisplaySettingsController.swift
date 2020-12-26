//
//  DisplaySettingsController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 07/09/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class DisplaySettingsController: UITableViewController {

    // MARK: - Properties -
    
    @IBOutlet var darkMode: UISwitch!
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
                
        self.title = "Display Settings"
        
        // check
        if let appearance = UserDefaults.standard.string(forKey: "APPEARANCE"), appearance == "DARK" {
            darkMode.isOn = true
        }
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Actions -
    
    @IBAction func darkModeSwitchValueChanged(_ sender: UISwitch) {
        // check
        if sender.isOn {
            UIApplication.shared.windows.forEach { window in
                window.overrideUserInterfaceStyle = .dark
                
                App.shared.appearance = "Dark"
                App.shared.iconColor = .white
                App.shared.headerColor = .white
                App.shared.headerBgColor = .whiteLightOpaque
                
                UserDefaults.standard.set("DARK", forKey: "APPEARANCE")
                UserDefaults.standard.synchronize()
            }
        } else {
            UIApplication.shared.windows.forEach { window in
                window.overrideUserInterfaceStyle = .light
                
                App.shared.appearance = "Light"
                App.shared.iconColor = UIColor.purple
                App.shared.headerColor = UIColor.purple
                App.shared.headerBgColor = UIColor.purpleLightOpaque
                
                UserDefaults.standard.set("LIGHT", forKey: "APPEARANCE")
                UserDefaults.standard.synchronize()
            }
        }
        
        UIToolbar.appearance().tintColor    = App.shared.iconColor
        UITabBar.appearance().tintColor     = App.shared.iconColor
    }
    

}
