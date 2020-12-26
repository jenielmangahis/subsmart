//
//  LibraryFilesController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 14/09/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import FontAwesome_swift
import SVProgressHUD

protocol LibraryControllerDelegate: class {
    func viewController(_ viewController: LibraryController, didFinishedPickingWithURLString urlString: URL, filename: String)
    func viewControllerDidCancel(_ viewController: LibraryController)
    
}

class LibraryController: UINavigationController {
    
    var mDelegate: LibraryControllerDelegate?
    
    var controller: UITableViewController = {
        let sb = UIStoryboard(name: "Others", bundle: Bundle.main)
        return sb.instantiateViewController(withIdentifier: "sb_LibraryFilesController") as! LibraryFilesController
    }()
    
    override public var supportedInterfaceOrientations: UIInterfaceOrientationMask {
        return .portrait
    }
    
    required init?(coder: NSCoder) {
        fatalError("init(coder:) has not been implemented")
    }
    
    required init(delegate: LibraryControllerDelegate? = nil) {
        super.init(rootViewController: controller)
        
        self.mDelegate = delegate
    }
}

class LibraryFilesController: UITableViewController {
    
    // MARK: - Properties -
    
    var indicator = UIActivityIndicatorView()
    
    var items: [Folder] = []
    var filteredItems: [Folder] = []
    var selectedFolder: Folder? = nil
    var selectedFolderFiles: [File] = []
    var path: String = "root"
    
    let userId = App.shared.user?.id
    let allowedFileExt = ["docx", "pdf", "png", "jpg", "jpeg"]
    
    

    // MARK: - Lifecycle -
    
    override func viewDidLoad() {
        super.viewDidLoad()
        setupNavigationBar()
        setupIndicator()
        setupRefreshControl()
    }
    
    override func viewWillAppear(_ animated: Bool) {
        loadData()
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    private func setupNavigationBar() {
        guard selectedFolder == nil else {
            return
        }
        
        let cancelButton = UIBarButtonItem(title: "Cancel", style: .plain, target: self, action: #selector(cancelController(_:)))
        navigationItem.setLeftBarButton(cancelButton, animated: false)
        
        // set title
        self.title = "Shared Library"
    }
    
    @objc private func cancelController(_ sender: Any) {
        guard let controller = navigationController as? LibraryController else { return }
        controller.mDelegate?.viewControllerDidCancel(controller)
    }
    
    // MARK: - Load data -
    
    func loadData() {
        // check
        if let folder = selectedFolder {
            self.title = folder.folder_name
            
            // filter files
            selectedFolderFiles = folder.files.filter({ item in
                let fileExt = getFileExtension(for: item.title)
                return (allowedFileExt.contains(fileExt))
            })
            
            self.tableView.backgroundView = nil
            self.refreshControl?.endRefreshing()
        } else {
            // call api
            App.shared.api.getSharedFolders() { (list, error) in
                if let e = error {
                    return self.addErrorView(with: e)
                }
                
                self.items = list
                self.tableView.backgroundView = nil
                self.tableView.reloadData()
                self.refreshControl?.endRefreshing()
            }
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
        if !self.tableView.backgroundView!.subviews.contains(errorView) {
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
        self.removeErrorView()
        //self.loadData()
    }
    
    // MARK: - Functions -
    
    public static func getFileIcon(for filename: String) -> UIImage {
        let array = filename.components(separatedBy: ".")
        
        if let ext = array.last {
            
            var icon: UIImage?
            
            switch ext {
            case "jpg",
                 "jpeg",
                 "png",
                 "tiff",
                 "tif",
                 "gif",
                 "bmp",
                 "BMPf",
                 "ico",
                 "cur",
                 "xbm":
                icon = UIImage.fontAwesomeIcon(name: .image, style: .regular, textColor: .systemBlue, size: CGSize(width: 24, height: 24))
            case "pdf":
                icon = UIImage.fontAwesomeIcon(name: .filePdf, style: .regular, textColor: .systemBlue, size: CGSize(width: 24, height: 24))
            case "docx":
                icon = UIImage.fontAwesomeIcon(name: .fileWord, style: .regular, textColor: .systemBlue, size: CGSize(width: 24, height: 24))
            case "pptx":
                icon = UIImage.fontAwesomeIcon(name: .filePowerpoint, style: .regular, textColor: .systemBlue, size: CGSize(width: 24, height: 24))
            case "xlsx":
                icon = UIImage.fontAwesomeIcon(name: .fileExcel, style: .regular, textColor: .systemBlue, size: CGSize(width: 24, height: 24))
            case "zip":
                icon = UIImage.fontAwesomeIcon(name: .fileArchive, style: .regular, textColor: .systemBlue, size: CGSize(width: 24, height: 24))
            default:
                icon = UIImage.fontAwesomeIcon(name: .file, style: .regular, textColor: .systemBlue, size: CGSize(width: 24, height: 24))
            }
            return icon!
        }
        return UIImage.fontAwesomeIcon(name: .file, style: .regular, textColor: .systemBlue, size: CGSize(width: 24, height: 24))
    }
    
    func getFileExtension(for filename: String) -> String {
        let array = filename.components(separatedBy: ".")
        return array.last!
    }

    // MARK: - TableView Datasource -
    
    override func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    override func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        if let folder = selectedFolder {
            // check
            if folder.type == "Folder" {
                return folder.subfolder.count + selectedFolderFiles.count
            }
            return selectedFolderFiles.count
        }
        return items.count
    }
    
    override func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 32
    }
    
    override func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        return 1
    }
    
    override func tableView(_ tableView: UITableView, viewForHeaderInSection section: Int) -> UIView? {
        return Utils.createHeader(App.shared.headerBgColor, App.shared.headerColor, path)
    }
    
    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
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
                    cell.accessoryType = .disclosureIndicator
                } else {
                    let item = selectedFolderFiles[row - folder.subfolder.count]
                    cell.imageView?.image = LibraryFilesController.getFileIcon(for: item.file_path)
                    cell.textLabel!.text = item.title
                }
            } else {
                let item = selectedFolderFiles[row]
                cell.imageView?.image = LibraryFilesController.getFileIcon(for: item.file_path)
                cell.textLabel!.text = item.title
            }
        } else {
            let item = items[row]
            cell.imageView?.image = UIImage.fontAwesomeIcon(name: .folder, style: .regular, textColor: .systemBlue, size: CGSize(width: 24, height: 24))
            cell.textLabel!.text = item.folder_name + " (\(item.subfolder.count + item.files.count))"
            cell.accessoryType = .disclosureIndicator
        }
        
        return cell
    }
    
    override func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        let row = indexPath.row
        // check
        if selectedFolder == nil {
            // folder is selected
            let item = items[row]
            
            // expand folder
            let controller = self.storyboard?.instantiateViewController(identifier: "sb_LibraryFilesController") as? LibraryFilesController
            controller?.selectedFolder = item
            controller?.path = "root\(item.path)"
            self.navigationController?.pushViewController(controller!, animated: true)
            
        } else if selectedFolder != nil {
            // check
            if let folder = selectedFolder {
                // check
                if folder.type == "Folder" {
                    if row < folder.subfolder.count {
                        // subfolder is selected
                        let item = folder.subfolder[row]
                        
                        // expand folder
                        let controller = self.storyboard?.instantiateViewController(identifier: "sb_LibraryFilesController") as? LibraryFilesController
                        controller?.selectedFolder = item
                        controller?.path = "root\(item.path)"
                        self.navigationController?.pushViewController(controller!, animated: true)
                    } else {
                        // file is selected
                        let item = selectedFolderFiles[row - folder.subfolder.count]
                        
                        // download the file
                        SVProgressHUD.setDefaultMaskType(.clear)
                        SVProgressHUD.show()
                        App.shared.api.downloadFile(item.file_path, item.name, completion: { (success, error, fileLocation) in
                            SVProgressHUD.setDefaultMaskType(.none)
                            SVProgressHUD.dismiss()
                            guard error == nil else {
                                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                            }
                            
                             DispatchQueue.main.async {
                                guard let controller = self.navigationController as? LibraryController else { return }
                                controller.mDelegate?.viewController(controller, didFinishedPickingWithURLString: fileLocation!, filename: item.title)
                            }
                        })
                    }
                } else {
                    // file is selected
                    let item = selectedFolderFiles[row]
                    
                    // download the file
                    SVProgressHUD.setDefaultMaskType(.clear)
                    SVProgressHUD.show()
                    App.shared.api.downloadFile(item.file_path, item.name, completion: { (success, error, fileLocation) in
                        SVProgressHUD.setDefaultMaskType(.none)
                        SVProgressHUD.dismiss()
                        guard error == nil else {
                            return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                        }
                        
                         DispatchQueue.main.async {
                            guard let controller = self.navigationController as? LibraryController else { return }
                            controller.mDelegate?.viewController(controller, didFinishedPickingWithURLString: fileLocation!, filename: item.title)
                        }
                    })
                }
                
            }
        }
    }

}


