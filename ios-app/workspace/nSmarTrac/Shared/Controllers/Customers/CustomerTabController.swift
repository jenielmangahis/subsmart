//
//  CustomerTabController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 08/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import FontAwesome_swift

class CustomerTabController: UITabBarController {
    
    // MARK: - Properties -
    
    @IBOutlet var filesBarButton: UIBarButtonItem!
    @IBOutlet var editBarButton: UIBarButtonItem!
    @IBOutlet var deleteBarButton: UIBarButtonItem!
    
    
    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initNavBar()
        
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Navigation Bar -
    
    func initNavBar() {
        // configure navBar icons
        filesBarButton.image = UIImage.fontAwesomeIcon(name: .inbox, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        editBarButton.image = UIImage.fontAwesomeIcon(name: .userEdit, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        deleteBarButton.image = UIImage.fontAwesomeIcon(name: .trashAlt, style: .regular, textColor: .white, size: CGSize(width: 24, height: 24))
        
        // set title
        self.navigationItem.title = "Customer's Detail"
        
        // set tabBar tintColor
        //self.tabBar.tintColor = AppTheme.defaultColor
    }
    
    // MARK: - Actions -
    
    @IBAction func fileButtonTapped(_ sender: Any) {
    }
    
    @IBAction func editButtonTapped(_ sender: Any) {
    }
    
    @IBAction func deleteButtonTapped(_ sender: Any) {
    }
    
}
