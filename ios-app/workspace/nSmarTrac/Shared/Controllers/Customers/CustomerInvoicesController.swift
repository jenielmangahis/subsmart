//
//  CustomerInvoicesController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 08/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import CoreLocation
import Floaty
import FontAwesome_swift
import MapKit

class CustomerInvoicesController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var mapView: MKMapView!
    
    var floaty = Floaty()
    
    
    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initFAB()
        
        // set title
        self.parent?.navigationItem.title = "Invoices"
    }

}

// MARK: - Floaty Delegate -

extension CustomerInvoicesController: FloatyDelegate, UIGestureRecognizerDelegate {
    
    func initFAB() {
        
        // init
        floaty.fabDelegate  = self
        floaty.buttonColor  = AppTheme.defaultColor
        floaty.buttonImage  = UIImage.fontAwesomeIcon(name: .plus, style: .solid, textColor: .white, size: CGSize(width: 30, height: 30))
        floaty.paddingY     = 60
        
        let tap = UITapGestureRecognizer(target: self, action: #selector(addButtonClick(_:)))
        floaty.addGestureRecognizer(tap)
        
        self.view.addSubview(floaty)
    }
    
    @objc func addButtonClick(_ sender: Any) {
        self.pushTo(storyBoard: "Main", identifier: "sb_AddCustomerInvoiceController")
    }
}
