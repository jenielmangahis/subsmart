//
//  DetailedServicesController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 01/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import FontAwesome_swift
import SVProgressHUD

class DetailedServicesController: UIViewController {

    // MARK: - Properties -
    
    @IBOutlet var searchView: UIView!
    @IBOutlet var textField: UITextField!
    @IBOutlet var tableView: UITableView!
    
    @IBOutlet var tableTop: NSLayoutConstraint!
    
    var isFiltered: Bool = false
    var services: [String] = []
    var filteredServices: [String] = []
    var serviceName = ""
    var currentServiceCategory: String?
    var currentServiceSubCategory: String?
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initSearchView()
                
        self.title = "Choose \(serviceName) Services"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Search View -
    
    func initSearchView() {
        searchView.backgroundColor = .systemGroupedBackground
        searchView.isHidden = false
        tableTop.constant = 0.0
        
        let leftView = UIView(frame: CGRect(x: 0, y: 7, width: 33, height: 20))
        leftView.backgroundColor = .clear
        
        let imageView = UIImageView(frame: CGRect(x: 13, y: 0, width: 20, height: 20))
        imageView.image = UIImage.fontAwesomeIcon(name: .search, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 20, height: 20))
        imageView.contentMode = .scaleAspectFit
        leftView.addSubview(imageView)
        
        
        let rightView = UIView(frame: CGRect(x: 0, y: 7, width: 24, height: 20))
        rightView.backgroundColor = .clear
        
        let cancelButton = UIButton(frame: CGRect(x: 0, y: 0, width: 20, height: 20))
        cancelButton.setImage(UIImage.fontAwesomeIcon(name: .times, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 20, height: 20)), for: .normal)
        cancelButton.addTarget(self, action: #selector(cancelButtonTapped(_:)), for: .touchUpInside)
        rightView.addSubview(cancelButton)
        
        textField.borderStyle = .roundedRect
        textField.font = UIFont.robotoFont(ofSize: 13)
        textField.leftViewMode = .always
        textField.leftView = leftView
        textField.rightViewMode = .always
        textField.rightView = rightView
        textField.textColor = UIColor(rgb: 0x545454)
        textField.addTarget(self, action: #selector(searchItem(_ :)), for: .editingChanged)
        textField.addTarget(self, action: #selector(textFieldShouldReturn(_ :)), for: .editingDidEnd)
    }
    
    @objc func cancelButtonTapped(_ sender: Any) {
        self.isFiltered = false
        self.searchView.isHidden = true
        self.tableTop.constant = -50.0
        self.tableView.reloadData()
        self.view.endEditing(true)
    }
    
    // MARK: - UITextField Delegate -
    
    @objc func textFieldShouldReturn(_ textField: UITextField) -> Bool {
        textField.resignFirstResponder()
        return true
    }
    
    // MARK: - Filter Array -
    
    @objc func searchItem(_ textfield: UITextField) {
        let searchText = textfield.text!
        
        filteredServices = services.filter({ item in
            return (item.lowercased().contains(searchText.lowercased()))
        })
        
        self.isFiltered = true
        self.tableView.reloadData()
    }

}

// MARK: - TableView Datasource -

extension DetailedServicesController: UITableViewDelegate, UITableViewDataSource {
    
    func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return isFiltered ? filteredServices.count : services.count
    }
    
    func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 1
    }
    
    func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        return 1
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let item = isFiltered ? filteredServices[indexPath.row] : services[indexPath.row]
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        cell.textLabel?.text = item
        cell.accessoryType = .none
        
        // check
        if currentServiceCategory != nil && currentServiceSubCategory != nil {
            if serviceName == currentServiceCategory && item == currentServiceSubCategory {
                cell.accessoryType = .checkmark
            }
        }
        
        return cell
    }
    
    func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        if let cell = tableView.cellForRow(at: indexPath) {
            cell.accessoryType = .checkmark
            
            // update db
            let params: Parameters = ["service_category": serviceName,
                                      "service_subcategory": cell.textLabel?.text! ?? ""]
            
            SVProgressHUD.setDefaultMaskType(.clear)
            SVProgressHUD.show()
            App.shared.api.putUserSign(params) { (success, error) in
                SVProgressHUD.setDefaultMaskType(.none)
                SVProgressHUD.dismiss()
                guard error == nil else {
                    return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                }
                guard success == true else {
                    return SVProgressHUD.showError(withStatus: "Saving data failed!")
                }
                
                SVProgressHUD.showSuccess(withStatus: "Changes has been saved!")
            }
        }
    }
    
    func tableView(_ tableView: UITableView, didDeselectRowAt indexPath: IndexPath) {
        if let cell = tableView.cellForRow(at: indexPath) {
            cell.accessoryType = .none
        }
    }
}
