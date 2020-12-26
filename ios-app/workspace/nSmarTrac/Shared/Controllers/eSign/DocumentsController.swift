//
//  DocumentsController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 05/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import SVProgressHUD

class DocumentsController: UIViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var tableView: UITableView!
    
    var indicator = UIActivityIndicatorView()
    var refreshControl = UIRefreshControl()
    
    var items: [ESign] = []
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        setupIndicator()
        setupRefreshControl()
        
        self.parent?.navigationItem.title = "Documents"
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
        App.shared.api.getESignDocs() { (list, error) in
            if let e = error {
                return self.addErrorView(with: e)
            }
            
            self.items = list
            self.tableView.backgroundView = nil
            self.tableView.reloadData()
            self.refreshControl.endRefreshing()
        }
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

extension DocumentsController: UITableViewDelegate, UITableViewDataSource {
    
    func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return items.count
    }
    
    func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 1
    }
    
    func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        return 1
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let item = items[indexPath.row]
        var status = item.status
        // check
        if item.status == "Action Required" {
            status = "Needs to Sign"
        } else if status == "Cancelled" {
            status = "Voided"
        }
        
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        cell.textLabel?.text = (item.status == "Action Required" && item.type == "Multiple") ? "Please eSign: \(item.name)" : item.name
        cell.detailTextLabel?.text = status
        
        // add date
        let date = Date(fromString: item.created_at, format: DateHelper.dateFormatType) ?? Date()
        let dateLabel = UILabel(frame: CGRect(x: Device.width-140, y: 32.67, width: 80, height: 13))
        dateLabel.font = UIFont.robotoFont(ofSize: 11)
        dateLabel.text = App.shared.documentDateFormatter.string(from: date)
        dateLabel.textAlignment = .right
        dateLabel.textColor = .darkGray
        cell.contentView.addSubview(dateLabel)
        
        return cell
    }
    
    func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        let controller = self.storyboard?.instantiateViewController(withIdentifier: "sb_DocumentDetailController")  as? DocumentDetailController
        controller?.item = items[indexPath.row]
        self.navigationController?.pushViewController(controller!, animated: true)
    }
    
    func tableView(_ tableView: UITableView, trailingSwipeActionsConfigurationForRowAt indexPath: IndexPath) -> UISwipeActionsConfiguration? {
        // get item
        let item = items[indexPath.row]
        let status = item.status
        
        // check status
        if status == "Action Required" {
            // void button
            let void = UIContextualAction(style: .normal, title: "Void") {  (contextualAction, view, boolValue) in
                // params
                let params: Parameters = ["status": "Cancelled"]
                
                // update esign status to Cancelled
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show()
                App.shared.api.putESign(item.id.intValue, params: params) { (result, error) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.dismiss()
                    guard error == nil else {
                        return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                    }
                    
                    self.loadData()
                }
            }
            void.backgroundColor = .red
            
            // sign button
            let sign = UIContextualAction(style: .normal, title: "Sign") {  (contextualAction, view, boolValue) in
                // check
                if item.type == "Single" {
                    // go to sign screen
                    let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_SignMeController") as? SignMeController
                    viewController?.item = item
                    self.navigationController?.pushViewController(viewController!, animated: true)
                } else {
                    // go to multiple signer screen
                    let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_SignOtherController") as? SignOtherController
                    viewController?.item = item
                    self.navigationController?.pushViewController(viewController!, animated: true)
                }
            }
            sign.backgroundColor = .blue
            
            return UISwipeActionsConfiguration(actions: [sign, void])
            
        } else if status == "Waiting for Others" {
            // void button
            let void = UIContextualAction(style: .normal, title: "Void") {  (contextualAction, view, boolValue) in
                // params
                let params: Parameters = ["status": "Cancelled"]
                
                // update esign status to Cancelled
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show()
                App.shared.api.putESign(item.id.intValue, params: params) { (result, error) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.dismiss()
                    guard error == nil else {
                        return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                    }
                    
                    self.loadData()
                }
            }
            void.backgroundColor = .red
            
            // remind button
            let remind = UIContextualAction(style: .normal, title: "Remind") {  (contextualAction, view, boolValue) in
                // send a reminder
                
            }
            remind.backgroundColor = .blue
            
            return UISwipeActionsConfiguration(actions: [remind, void])
            
        } else if status == "Completed" {
            // delete button
            let delete = UIContextualAction(style: .normal, title: "Delete") {  (contextualAction, view, boolValue) in
                // show alert
                let alertController = UIAlertController(title: "Delete Item", message: "Are you sure you want to delete this item?", preferredStyle: .alert)
                let yesAction = UIAlertAction(title: "Delete", style: .default) { (alertAction) -> Void in
                    // delete esign
                    SVProgressHUD.setDefaultMaskType(.clear)
                    SVProgressHUD.show()
                    App.shared.api.deleteESign(item.id.intValue) { (result, error) in
                        SVProgressHUD.setDefaultMaskType(.none)
                        SVProgressHUD.dismiss()
                        guard error == nil else {
                            return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                        }
                        
                        self.items.remove(at: indexPath.row)
                        tableView.deleteRows(at: [indexPath], with: .fade)
                        tableView.beginUpdates()
                        tableView.endUpdates()
                    }
                }
                alertController.addAction(yesAction)
                
                let noAction = UIAlertAction(title: "Cancel", style: .cancel) { (alertAction) -> Void in
                    self.dismiss(animated: true, completion: nil)
                }
                alertController.addAction(noAction)
                
                self.present(alertController, animated: true, completion: nil)
            }
            delete.backgroundColor = .red
            
            // share button
            let share = UIContextualAction(style: .normal, title: "Share") {  (contextualAction, view, boolValue) in
                // share the document
                
            }
            share.backgroundColor = .blue
            
            return UISwipeActionsConfiguration(actions: [share, delete])
            
        } else if status == "Draft" {
            // delete button
            let delete = UIContextualAction(style: .normal, title: "Delete") {  (contextualAction, view, boolValue) in
                // show alert
                let alertController = UIAlertController(title: "", message: "Are you sure you want to delete this item?", preferredStyle: .alert)
                let yesAction = UIAlertAction(title: "Delete", style: .default) { (alertAction) -> Void in
                    // delete esign
                    SVProgressHUD.setDefaultMaskType(.clear)
                    SVProgressHUD.show()
                    App.shared.api.deleteESign(item.id.intValue) { (result, error) in
                        SVProgressHUD.setDefaultMaskType(.none)
                        SVProgressHUD.dismiss()
                        guard error == nil else {
                            return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                        }
                        
                        self.items.remove(at: indexPath.row)
                        tableView.deleteRows(at: [indexPath], with: .fade)
                        tableView.beginUpdates()
                        tableView.endUpdates()
                    }
                }
                alertController.addAction(yesAction)
                
                let noAction = UIAlertAction(title: "Cancel", style: .cancel) { (alertAction) -> Void in
                    self.dismiss(animated: true, completion: nil)
                }
                alertController.addAction(noAction)
                
                self.present(alertController, animated: true, completion: nil)
            }
            delete.backgroundColor = .red
            
            // resume button
            let resume = UIContextualAction(style: .normal, title: "Resume") {  (contextualAction, view, boolValue) in
                // go to documents screen
                let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_ScannedDocumentController") as? ScannedDocumentController
                viewController?.item = item
                self.navigationController?.pushViewController(viewController!, animated: true)
            }
            resume.backgroundColor = .blue
            
            return UISwipeActionsConfiguration(actions: [resume, delete])
            
        } else if status == "Cancelled" {
            // delete button
            let delete = UIContextualAction(style: .normal, title: "Delete") {  (contextualAction, view, boolValue) in
                // delete esign
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show()
                App.shared.api.deleteESign(item.id.intValue) { (result, error) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.dismiss()
                    guard error == nil else {
                        return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                    }
                    
                    self.items.remove(at: indexPath.row)
                    tableView.deleteRows(at: [indexPath], with: .fade)
                    tableView.beginUpdates()
                    tableView.endUpdates()
                }
            }
            delete.backgroundColor = .red
            
            return UISwipeActionsConfiguration(actions: [delete])
                   
        }

        return UISwipeActionsConfiguration(actions: [])
    }
}
