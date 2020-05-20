//
//  ExpenseDetailController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 18/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import FontAwesome_swift

class ExpenseDetailController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var editBarButton: UIBarButtonItem!
    @IBOutlet var deleteBarButton: UIBarButtonItem!
    
    
    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        
        // set title
        self.navigationItem.title = "Expense Preview"
        
        // configure navBar icons
        editBarButton.image = UIImage.fontAwesomeIcon(name: .edit, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        deleteBarButton.image = UIImage.fontAwesomeIcon(name: .trashAlt, style: .regular, textColor: .white, size: CGSize(width: 24, height: 24))
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }

}
