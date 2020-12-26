//
//  TaxRateSettingsController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 03/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Floaty
import FontAwesome_swift
import SVProgressHUD

class TaxRateSettingsController: UIViewController {

    // MARK: - Properties -
    
    @IBOutlet var searchView: UIView!
    @IBOutlet var textField: UITextField!
    @IBOutlet var tableView: UITableView!
    
    @IBOutlet var tableTop: NSLayoutConstraint!
    
    var indicator = UIActivityIndicatorView()
    var refreshControl = UIRefreshControl()
    var floaty = Floaty()
    
    var items: [TaxRate] = []
    var filteredItems: [TaxRate] = []
    var groupedItems: [Object] = []
    
    struct Object {
        var group: String
        var item: [TaxRate]
    }
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initFAB()
        initSearchView()
        setupIndicator()
        setupRefreshControl()
                
        self.title = "Tax Rates"
    }
    
    override func viewWillAppear(_ animated: Bool) {
        loadData()
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Load data -
    
    func loadData() {
        // call api
        App.shared.api.getTaxRates() { (list, error) in
            if let e = error {
                return self.addErrorView(with: e)
            }
            
            self.items = list
            self.processData(list)
        }
    }
    
    func processData(_ list: [TaxRate]) {
        // sort ungrouped
        let ungrouped = list.sorted(by: {$0.name.prefix(1) > $1.name.prefix(1)})
        // group
        let grouped = ungrouped.group(by: {$0.name.prefix(1)})
        // sort
        let sorted = grouped.sorted(by: {$0.key < $1.key})
        // create temp groupedObjects
        var tempGroupedObjects = [Object]()
        // iterate
        for (key, value) in sorted {
            tempGroupedObjects.append(Object(group: String(key), item: value))
        }
        
        self.groupedItems = tempGroupedObjects
        self.tableView.backgroundView = nil
        self.tableView.reloadData()
        self.refreshControl.endRefreshing()
    }
    
    // MARK: - ErrorView -

    private lazy var errorView: BasicErrorView = {
        let errorView = BasicErrorView()
        errorView.translatesAutoresizingMaskIntoConstraints = false
        return errorView
    }()
    
    func addErrorView(with error: Error) {
        DispatchQueue.main.async { [weak self] in
            guard let self = self else { return }
            self.tableView.backgroundView?.addSubview(self.errorView)
            let safeAreaLayoutGuide = self.view.safeAreaLayoutGuide
            NSLayoutConstraint.activate([
                self.errorView.leadingAnchor.constraint(equalTo: safeAreaLayoutGuide.leadingAnchor),
                self.errorView.trailingAnchor.constraint(equalTo: safeAreaLayoutGuide.trailingAnchor),
                self.errorView.topAnchor.constraint(equalTo: safeAreaLayoutGuide.topAnchor),
                self.errorView.bottomAnchor.constraint(equalTo: safeAreaLayoutGuide.bottomAnchor)
                ])
            self.errorView.displayError(error)
        }
    }

    func removeErrorView() {
        if self.tableView.backgroundView == nil || !self.tableView.backgroundView!.subviews.contains(errorView) {
            return
        }
        DispatchQueue.main.async {
            self.errorView.removeFromSuperview()
        }
    }
    
    // MARK: - Search View -
    
    func initSearchView() {
        searchView.backgroundColor = .systemGroupedBackground
        searchView.isHidden = true
        tableTop.constant = -50.0
        
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
        self.processData(items)
        self.searchView.isHidden = true
        self.tableTop.constant = -50.0
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
        
        filteredItems = items.filter({ item in
            return (item.name.lowercased().contains(searchText.lowercased()))
        })
        
        self.processData(filteredItems)
    }
    
    // MARK: - Activity Indicator -
    
    func setupIndicator() {
        // init activity indicator
        self.indicator = UIActivityIndicatorView(frame: CGRect(x: 0, y: 0, width: 40, height: 40))
        self.indicator.style = UIActivityIndicatorView.Style.medium
        self.indicator.center = self.view.center
        self.view.addSubview(indicator)
        self.tableView.backgroundView = indicator
        self.indicator.startAnimating()
    }
    
    // MARK: - Refresh Control -
    
    func setupRefreshControl() {
        // init refresh control
        self.tableView.refreshControl = refreshControl
        self.refreshControl.addTarget(self, action: #selector(refreshData(_:)), for: .valueChanged)
        self.refreshControl.attributedTitle = NSAttributedString(string: "Fetching Data ...")
    }
    
    @objc func refreshData(_ sender: Any) {
        self.refreshControl.endRefreshing()
        self.removeErrorView()
        self.loadData()
    }

}

// MARK: - TableView Datasource -

extension TaxRateSettingsController: UITableViewDelegate, UITableViewDataSource {
    
    func numberOfSections(in tableView: UITableView) -> Int {
        return groupedItems.count
    }
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return groupedItems[section].item.count
    }
    
    func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 32
    }
    
    func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        return 1
    }
    
    func tableView(_ tableView: UITableView, viewForHeaderInSection section: Int) -> UIView? {
        return Utils.createHeader(App.shared.headerBgColor, App.shared.headerColor, groupedItems[section].group.uppercased())
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let item = groupedItems[indexPath.section].item[indexPath.row]
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        cell.textLabel?.text = "\(item.name) - \(item.rate)%"
        
        if item.is_default {
            // add default badge
            let badge = UILabel(frame: CGRect(x: 200, y: 12, width: 50, height: 20))
            badge.backgroundColor = .greenColor
            badge.cornerRadius = 5
            badge.font = UIFont.robotoFont(ofSize: 12)
            badge.text = "Default"
            badge.textAlignment = .center
            badge.textColor = .white
            cell.contentView.addSubview(badge)
        }
        
        return cell
    }
    
    func tableView(_ tableView: UITableView, trailingSwipeActionsConfigurationForRowAt indexPath: IndexPath) -> UISwipeActionsConfiguration? {
        // edit button
        let edit = UIContextualAction(style: .normal, title: "") {  (contextualAction, view, boolValue) in
            // edit item at indexPath
            let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_EditTaxRateController") as? EditTaxRateController
            viewController?.item = self.groupedItems[indexPath.section].item[indexPath.row]
            self.navigationController?.pushViewController(viewController!, animated: true)
        }
        edit.image = UIImage.fontAwesomeIcon(name: .pen, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        edit.backgroundColor = .blueColor
        
        
        // check role
        if App.shared.user!.role.intValue <= 3 {
            // delete button
            let delete = UIContextualAction(style: .destructive, title: "") {  (contextualAction, view, boolValue) in
                // show alert
                let alertController = UIAlertController(title: "", message: "Are you sure you want to delete this item?", preferredStyle: .alert)
                let yesAction = UIAlertAction(title: "Yes", style: .default) { (alertAction) -> Void in
                    // delete item at indexPath
                    let item = self.groupedItems[indexPath.section].item[indexPath.row]
                    
                    SVProgressHUD.setDefaultMaskType(.clear)
                    SVProgressHUD.show(withStatus: "Deleting...")
                    App.shared.api.deleteTaxRate(item.id.intValue) { (success, error) in
                        SVProgressHUD.dismiss()
                        guard error == nil else {
                            return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                        }
                        guard success == true else {
                            return SVProgressHUD.showError(withStatus: "Deleting item failed!")
                        }
                        
                        self.groupedItems[indexPath.section].item.remove(at: indexPath.row)
                        tableView.deleteRows(at: [indexPath], with: .fade)
                        tableView.beginUpdates()
                        tableView.endUpdates()
                    }
                }
                alertController.addAction(yesAction)
                
                let noAction = UIAlertAction(title: "No", style: .cancel) { (alertAction) -> Void in
                    self.dismiss(animated: true, completion: {
                        tableView.beginUpdates()
                        tableView.endUpdates()
                    })
                }
                alertController.addAction(noAction)
                
                self.present(alertController, animated: true, completion: nil)
            }
            delete.image = UIImage.fontAwesomeIcon(name: .trashAlt, style: .regular, textColor: .white, size: CGSize(width: 24, height: 24))

            return UISwipeActionsConfiguration(actions: [delete, edit])
        }

        return UISwipeActionsConfiguration(actions: [edit])
    }
}

// MARK: - Floaty Delegate -

extension TaxRateSettingsController: FloatyDelegate {
    
    func initFAB() {
        
        // init
        floaty.fabDelegate  = self
        floaty.sticky       = true
        floaty.buttonColor  = .greenColor
        floaty.buttonImage  = UIImage.fontAwesomeIcon(name: .plus, style: .solid, textColor: .white, size: CGSize(width: 30, height: 30))
        floaty.addItem("Search", icon: UIImage.fontAwesomeIcon(name: .search, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            self.searchView.isHidden = false
            self.tableTop.constant = 0.0
            self.floaty.close()
        })
        floaty.addItem("Add", icon: UIImage.fontAwesomeIcon(name: .edit, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            self.pushTo(storyBoard: "Settings", identifier: "sb_AddTaxRateController")
            self.floaty.close()
        })
        
        self.view.addSubview(floaty)
    }
}
