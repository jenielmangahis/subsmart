//
//  UpdateWONoteController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 21/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import DLRadioButton
import RxSwift
import RxCocoa
import SVProgressHUD

class UpdateWONoteController: UITableViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var instructionsField: UITextView!
    @IBOutlet var saveButton: DesignableButton!
    
    var item: WorkOrder!



    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        loadData()
                
        self.title = "Update Notes"
        
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Load data -
    
    func loadData() {
        instructionsField.text          = item.instructions
    }
    
    // MARK: - Actions -
    
    @IBAction func saveButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        
        let workOrder: Parameters = ["company_id": App.shared.companyId,
                                     "instructions": instructionsField.text!]
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show()
        App.shared.api.putWorkOrder(item.id.intValue, params: workOrder) { (success, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard success == true else {
                return SVProgressHUD.showError(withStatus: "Saving data failed!")
            }
            
            SVProgressHUD.showSuccess(withStatus: "Data has been saved!")
            self.popViewController()
        }
    }
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        self.popViewController()
    }

}
