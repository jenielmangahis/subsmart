//
//  ItemLocationsController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 27/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Floaty
import FontAwesome_swift
import SVProgressHUD

class ItemLocationsController: UITableViewController {
    
    // MARK: - Properties -
    
    var indicator = UIActivityIndicatorView()
    var floaty = Floaty()
    
    var items: [ItemLocation] = []
    var filteredItems: [ItemLocation] = []
    var groupedItems: [Object] = []
    
    struct Object {
        var group: String
        var item: [ItemLocation]
    }
    
    var item: Item!
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        setupIndicator()
        setupRefreshControl()
        initFAB()
        
        self.title = "Item Locations"
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
        App.shared.api.getItemLocations(item!.id.intValue) { (list, error) in
            if let e = error {
                return self.addErrorView(with: e)
            }
            
            self.items = list
            self.processData(list)
        }
    }
    
    func processData(_ list: [ItemLocation]) {
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
        self.refreshControl?.addTarget(self, action: #selector(refreshData(_:)), for: .valueChanged)
        self.refreshControl?.attributedTitle = NSAttributedString(string: "Fetching Data ...")
    }
    
    @objc func refreshData(_ sender: Any) {
        self.refreshControl?.endRefreshing()
        self.removeErrorView()
        self.loadData()
    }

    // MARK: - TableView Datasource -
    
    override func numberOfSections(in tableView: UITableView) -> Int {
        return groupedItems.count
    }
    
    override func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return groupedItems[section].item.count
    }
    
    override func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 32
    }
    
    override func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        return 1
    }
    
    override func tableView(_ tableView: UITableView, viewForHeaderInSection section: Int) -> UIView? {
        return Utils.createHeader(App.shared.headerBgColor, App.shared.headerColor, groupedItems[section].group.uppercased())
    }
    
    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let item = groupedItems[indexPath.section].item[indexPath.row]
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        cell.textLabel?.text        = item.name
        cell.detailTextLabel?.text  = item.qty
        
        return cell
    }
    
    override func tableView(_ tableView: UITableView, trailingSwipeActionsConfigurationForRowAt indexPath: IndexPath) -> UISwipeActionsConfiguration? {
        // edit button
        let edit = UIContextualAction(style: .normal, title: "") {  (contextualAction, view, boolValue) in
            // edit item at indexPath
            let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_EditItemLocationController") as? EditItemLocationController
            viewController?.item = self.item
            viewController?.itemLoc = self.groupedItems[indexPath.section].item[indexPath.row]
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
                    App.shared.api.deleteItemLocation(item.id.intValue) { (success, error) in
                        SVProgressHUD.setDefaultMaskType(.none)
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

extension ItemLocationsController: FloatyDelegate, UIGestureRecognizerDelegate {
    
    func initFAB() {
        
        // init
        floaty.fabDelegate  = self
        floaty.sticky       = true
        floaty.buttonColor  = .greenColor
        floaty.buttonImage  = UIImage.fontAwesomeIcon(name: .plus, style: .solid, textColor: .white, size: CGSize(width: 30, height: 30))
        
        // add action
        let tap = UITapGestureRecognizer(target: self, action: #selector(handleFloaty(_:)))
        tap.delegate = self
        floaty.addGestureRecognizer(tap)
        
        self.view.addSubview(floaty)
    }
    
    // back button action
    @objc func handleFloaty(_ gestureRecognizer: UITapGestureRecognizer) {
        let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_AddItemLocationController") as? AddItemLocationController
        viewController?.item = self.item
        self.navigationController?.pushViewController(viewController!, animated: true)
    }
}
