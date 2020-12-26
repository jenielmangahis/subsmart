//
//  MyLibraryController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 05/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import Floaty
import FontAwesome_swift
import QuickLook
import SVProgressHUD

class MyLibraryController: UIViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var searchView: UIView!
    @IBOutlet var textField: UITextField!
    @IBOutlet var tableView: UITableView!
    
    @IBOutlet var tableTop: NSLayoutConstraint!
    
    var indicator = UIActivityIndicatorView()
    var refreshControl = UIRefreshControl()
    var floaty = Floaty()
    
    var items: [Folder] = []
    var filteredItems: [Folder] = []
    var selectedFolder: Folder? = nil
    var path: String = "root"
    var folderIds: [Int] = []
    var previewItem = NSURL()
    
    let userId = App.shared.user?.id
    
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initFAB()
        initSearchView()
        setupIndicator()
        setupRefreshControl()
    }
    
    override func viewWillAppear(_ animated: Bool) {
        loadData()
        
        // set title
        self.parent?.navigationItem.title = "My Library"
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Load data -
    
    func loadData() {
        // clear folderIds
        self.folderIds.removeAll()
        self.folderIds.append(0)
        
        // set to nil
        self.selectedFolder = nil
        
        // call api
        App.shared.api.getMyFolders() { (list, error) in
            if let e = error {
                return self.addErrorView(with: e)
            }
            
            self.items = list
            self.path = "root"
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
        self.loadData()
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
            return (item.folder_name.lowercased().contains(searchText.lowercased()))
        })
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
        //self.loadData()
    }

}

// MARK: - TableView Datasource -

extension MyLibraryController: UITableViewDelegate, UITableViewDataSource {
    
    func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        if let folder = selectedFolder {
            // check
            if folder.type == "Folder" {
                return folder.subfolder.count + folder.files.count
            }
            return folder.files.count
        }
        return items.count
    }
    
    func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 32
    }
    
    func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        return 1
    }
    
    func tableView(_ tableView: UITableView, viewForHeaderInSection section: Int) -> UIView? {
        
        // create view
        let header              = UIView(frame: CGRect(x: 0, y: 0, width: Device.width, height: 32))
        header.backgroundColor  = App.shared.headerBgColor
        
        // init
        var x: CGFloat = 20
        var i = 0;
        // explode
        let paths = path.components(separatedBy: "/")
        // iterate path
        for path in paths {
            // create label
            let label       = UILabel()
            label.font      = UIFont.robotoBoldFont(ofSize: 15)
            label.textColor = App.shared.headerColor
            label.text      = "/"
            label.sizeToFit()
            label.frame     = CGRect(x: x, y: 6, width: label.frame.size.width, height: 21)
            header.addSubview(label)
            
            x = x + label.bounds.size.width
            
            // check
            if i < folderIds.count {
                // create button
                let button = UIButton()
                button.titleLabel?.font = UIFont.robotoBoldFont(ofSize: 15)
                button.setTitleColor(App.shared.headerColor, for: .normal)
                button.setTitle(path, for: .normal)
                button.sizeToFit()
                button.frame = CGRect(x: x, y: 6, width: button.frame.size.width, height: 21)
                button.addTarget(self, action: #selector(openFolder(_:)), for: .touchUpInside)
                button.tag = folderIds[i]
                header.addSubview(button)
                
                x = x + button.bounds.size.width
                i += 1
            }
        }
        
        return header
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let row = indexPath.row
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        
        // check
        if let folder = selectedFolder {
            // check
            if folder.type == "Folder" {
                if row < folder.subfolder.count {
                    let item = folder.subfolder[row]
                    cell.imageView?.image = UIImage.fontAwesomeIcon(name: .folder, style: .regular, textColor: .systemBlue, size: CGSize(width: 24, height: 24))
                    cell.textLabel!.text = item.folder_name + " (\(item.files.count))"
                } else {
                    let item = folder.files[row - folder.subfolder.count]
                    cell.imageView?.image = LibraryFilesController.getFileIcon(for: item.file_path)
                    cell.textLabel!.text = item.title
                }
            } else {
                let item = folder.files[row]
                cell.imageView?.image = LibraryFilesController.getFileIcon(for: item.file_path)
                cell.textLabel!.text = item.title
            }
        } else {
            let item = items[row]
            cell.imageView?.image = UIImage.fontAwesomeIcon(name: .folder, style: .regular, textColor: .systemBlue, size: CGSize(width: 24, height: 24))
            cell.textLabel!.text = item.folder_name + " (\(item.subfolder.count + item.files.count))"
        }
        
        return cell
    }
    
    func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        let row = indexPath.row
        // check
        if selectedFolder == nil {
            // folder is selected
            let item = items[row]
            selectedFolder = item
            path = "root\(item.path)"
            folderIds.append(item.folder_id.intValue)
        } else if selectedFolder != nil {
            // check
            if let folder = selectedFolder {
                // check
                if folder.type == "Folder" {
                    if row < folder.subfolder.count {
                        // subfolder is selected
                        let item = folder.subfolder[row]
                        selectedFolder = item
                        path = "root\(item.path)"
                        folderIds.append(item.folder_id.intValue)
                    } else {
                        // file is selected
                        let item = folder.files[row - folder.subfolder.count]
                        
                        // download the file
                        SVProgressHUD.show(withStatus: "Loading...")
                        App.shared.api.downloadFile(item.file_path, item.title, completion: {(success, error, fileLocationURL) in
                            SVProgressHUD.dismiss()
                            if success {
                                // set the preview item to display
                                self.previewItem = fileLocationURL! as NSURL
                                // quicklook
                                let previewController = QLPreviewController()
                                previewController.dataSource = self
                                previewController.modalPresentationStyle = .formSheet
                                self.present(previewController, animated: true, completion: nil)
                            } else {
                                SVProgressHUD.showError(withStatus: error?.localizedDescription)
                            }
                        })
                    }
                } else {
                    // file is selected
                    let item = folder.files[row]
                    
                    // download the file
                    SVProgressHUD.show(withStatus: "Loading...")
                    App.shared.api.downloadFile(item.file_path, item.title, completion: {(success, error, fileLocationURL) in
                        SVProgressHUD.dismiss()
                        if success {
                            // set the preview item to display
                            self.previewItem = fileLocationURL! as NSURL
                            // quicklook
                            let previewController = QLPreviewController()
                            previewController.dataSource = self
                            previewController.modalPresentationStyle = .formSheet
                            self.present(previewController, animated: true, completion: nil)
                        } else {
                            SVProgressHUD.showError(withStatus: error?.localizedDescription)
                        }
                    })
                }
                
            }
        }
        
        self.tableView.reloadData()
    }
    
    func tableView(_ tableView: UITableView, trailingSwipeActionsConfigurationForRowAt indexPath: IndexPath) -> UISwipeActionsConfiguration? {
        let row = indexPath.row
        // edit button
        let edit = UIContextualAction(style: .normal, title: "") {  (contextualAction, view, boolValue) in
            // check
            if self.selectedFolder == nil {
                // edit folder
                let item = self.items[row]
                let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_EditFolderController") as? EditFolderController
                viewController?.item = item
                self.navigationController?.pushViewController(viewController!, animated: true)
                
            } else if self.selectedFolder != nil {
                // check
                if let folder = self.selectedFolder {
                    // check
                    if folder.type == "Folder" {
                        if row < folder.subfolder.count {
                            // edit subfolder
                            let item = folder.subfolder[row]
                            let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_EditFolderController") as? EditFolderController
                            viewController?.item = item
                            self.navigationController?.pushViewController(viewController!, animated: true)
                            
                        } else {
                            // edit file
                            let item = folder.files[row - folder.subfolder.count]
                            let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_EditFileController") as? EditFileController
                            viewController?.item = item
                            self.navigationController?.pushViewController(viewController!, animated: true)
                        }
                    } else {
                        // edit file
                        let item = folder.files[row]
                        let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_EditFileController") as? EditFileController
                        viewController?.item = item
                        self.navigationController?.pushViewController(viewController!, animated: true)
                    }
                }
            }
        }
        edit.image = UIImage.fontAwesomeIcon(name: .pen, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        edit.backgroundColor = .blueColor
        
        // check
        if self.selectedFolder == nil {
            // soft delete folder
            let item = self.items[row]
            // check
            if item.created_by == userId {
                // delete
                let delete = initDeleteFolder(item)
                return UISwipeActionsConfiguration(actions: [delete, edit])
            }
        } else if self.selectedFolder != nil {
            // check
            if let folder = self.selectedFolder {
                // check
                if folder.type == "Folder" {
                    if row < folder.subfolder.count {
                        // soft delete subfolder
                        let item = folder.subfolder[row]
                        // check
                        if item.created_by == userId {
                            // delete
                            let delete = initDeleteFolder(item)
                            return UISwipeActionsConfiguration(actions: [delete, edit])
                        }
                    } else {
                        // soft delete file
                        let item = folder.files[row - folder.subfolder.count]
                        // check
                        if item.user_id == userId {
                            // delete
                            let delete = initDeleteFile(item)
                            return UISwipeActionsConfiguration(actions: [delete, edit])
                        }
                    }
                } else {
                    // soft delete file
                    let item = folder.files[row]
                    // check
                    if item.user_id == userId {
                        // delete
                        let delete = initDeleteFile(item)
                        return UISwipeActionsConfiguration(actions: [delete, edit])
                    }
                }
            }
        }

        return UISwipeActionsConfiguration(actions: [edit])
    }
    
    // MARK: - Protocol -
    
    @objc func openFolder(_ sender: UIButton) {
        print(#function, sender.tag)
        
        self.setupIndicator()
        
        let id = sender.tag
        // check
        if id == 0 {
            // reload
            self.loadData()
        } else {
            // get folder
            App.shared.api.getFolder(id, completion: { (result, error) in
                if let e = error {
                    return self.addErrorView(with: e)
                }
                
                self.selectedFolder = result
                self.path = "root\(result!.path)"
                self.tableView.backgroundView = nil
                self.tableView.reloadData()
                self.refreshControl.endRefreshing()
            })
        }
    }
    
    func initDeleteFolder(_ folder: Folder) -> UIContextualAction {
        // delete button
        let delete = UIContextualAction(style: .destructive, title: "") {  (contextualAction, view, boolValue) in
            // show alert
            let alertController = UIAlertController(title: "", message: "Are you sure you want to delete this item?", preferredStyle: .alert)
            let yesAction = UIAlertAction(title: "Yes", style: .default) { (alertAction) -> Void in
                // params
                let params: Parameters = ["softdelete": 1, "softdelete_date": App.shared.dateFormatter.string(from: Date()), "softdelete_by": self.userId!]
                
                // softdelete
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show(withStatus: "Deleting...")
                App.shared.api.putFolder(folder.folder_id.intValue, params: params) { (success, error) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.dismiss()
                    guard error == nil else {
                        return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                    }
                    guard success == true else {
                        return SVProgressHUD.showError(withStatus: "Deleting item failed!")
                    }
                    
                    // get folder
                    App.shared.api.getFolder(folder.folder_id.intValue, completion: { (result, error) in
                        if let e = error {
                            return self.addErrorView(with: e)
                        }
                        
                        self.selectedFolder = result
                        self.path = "root\(result!.path)"
                        self.tableView.backgroundView = nil
                        self.tableView.reloadData()
                        self.refreshControl.endRefreshing()
                    })
                }
            }
            alertController.addAction(yesAction)
            
            let noAction = UIAlertAction(title: "No", style: .cancel) { (alertAction) -> Void in
                self.dismiss(animated: true, completion: {
                    self.tableView.beginUpdates()
                    self.tableView.endUpdates()
                })
            }
            alertController.addAction(noAction)
            
            self.present(alertController, animated: true, completion: nil)
        }
        delete.image = UIImage.fontAwesomeIcon(name: .trashAlt, style: .regular, textColor: .white, size: CGSize(width: 24, height: 24))

        return delete
    }
    
    func initDeleteFile(_ file: File) -> UIContextualAction {
        // delete button
        let delete = UIContextualAction(style: .destructive, title: "") {  (contextualAction, view, boolValue) in
            // show alert
            let alertController = UIAlertController(title: "", message: "Are you sure you want to delete this item?", preferredStyle: .alert)
            let yesAction = UIAlertAction(title: "Yes", style: .default) { (alertAction) -> Void in
                // params
                let params: Parameters = ["softdelete": 1, "softdelete_date": App.shared.dateFormatter.string(from: Date()), "softdelete_by": self.userId!]
                
                // softdelete
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show(withStatus: "Deleting...")
                App.shared.api.putFile(file.file_id.intValue, params: params) { (success, error) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.dismiss()
                    guard error == nil else {
                        return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                    }
                    guard success == true else {
                        return SVProgressHUD.showError(withStatus: "Deleting item failed!")
                    }
                    
                    // get folder
                    App.shared.api.getFolder(file.folder_id.intValue, completion: { (result, error) in
                        if let e = error {
                            return self.addErrorView(with: e)
                        }
                        
                        self.selectedFolder = result
                        self.path = "root\(result!.path)"
                        self.tableView.backgroundView = nil
                        self.tableView.reloadData()
                        self.refreshControl.endRefreshing()
                    })
                }
            }
            alertController.addAction(yesAction)
            
            let noAction = UIAlertAction(title: "No", style: .cancel) { (alertAction) -> Void in
                self.dismiss(animated: true, completion: {
                    self.tableView.beginUpdates()
                    self.tableView.endUpdates()
                })
            }
            alertController.addAction(noAction)
            
            self.present(alertController, animated: true, completion: nil)
        }
        delete.image = UIImage.fontAwesomeIcon(name: .trashAlt, style: .regular, textColor: .white, size: CGSize(width: 24, height: 24))

        return delete
    }
}

// MARK: - QLPreviewControllerDataSource -

extension MyLibraryController: QLPreviewControllerDataSource {
    
    func numberOfPreviewItems(in controller: QLPreviewController) -> Int {
        return 1
    }

    func previewController(_ controller: QLPreviewController, previewItemAt index: Int) -> QLPreviewItem {
        self.previewItem as QLPreviewItem
    }
}

// MARK: - Floaty Delegate -

extension MyLibraryController: FloatyDelegate {
    
    func initFAB() {
        
        // init
        floaty.fabDelegate  = self
        floaty.sticky       = true
        floaty.buttonColor  = .greenColor
        floaty.buttonImage  = UIImage.fontAwesomeIcon(name: .plus, style: .solid, textColor: .white, size: CGSize(width: 30, height: 30))
        floaty.paddingY     = 60
        
        floaty.addItem("Search", icon: UIImage.fontAwesomeIcon(name: .search, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            self.searchView.isHidden = false
            self.tableTop.constant = 0.0
            self.floaty.close()
        })
        floaty.addItem("Add File", icon: UIImage.fontAwesomeIcon(name: .edit, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
            self.floaty.close()
            
            var folder: Folder? = nil
            // check
            if self.selectedFolder != nil {
                folder = self.selectedFolder
            }
            
            // add file
            let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_AddFileController") as? AddFileController
            viewController?.folder = folder
            self.navigationController?.pushViewController(viewController!, animated: true)
        })
        // check
        if let folder = selectedFolder, folder.type == "Folder" {
            floaty.addItem("Create Folder", icon: UIImage.fontAwesomeIcon(name: .folderPlus, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 30, height: 30)), handler: { item in
                self.floaty.close()
                
                var parentFolder: Folder? = nil
                // check
                if self.selectedFolder != nil {
                    parentFolder = self.selectedFolder
                }
                
                // add folder
                let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_AddFolderController") as? AddFolderController
                viewController?.parentFolder = parentFolder
                self.navigationController?.pushViewController(viewController!, animated: true)
            })
        }
        
        self.view.addSubview(floaty)
    }
}
