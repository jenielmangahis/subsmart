//
//  DropboxFilesController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 03/09/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import FontAwesome_swift
import SwiftyDropbox
import SVProgressHUD

protocol DropboxControllerDelegate: class {
    func viewController(_ viewController: DropboxController, didFinishedPickingWithURLString urlString: URL, filename: String)
    func viewControllerDidCancel(_ viewController: DropboxController)
    
}

class DropboxController: UINavigationController {
    
    var mDelegate: DropboxControllerDelegate?
    
    var controller: UITableViewController = {
        let sb = UIStoryboard(name: "Others", bundle: Bundle.main)
        return sb.instantiateViewController(withIdentifier: "sb_DropboxFilesController") as! DropboxFilesController
    }()
    
    override public var supportedInterfaceOrientations: UIInterfaceOrientationMask {
        return .portrait
    }
    
    required init?(coder: NSCoder) {
        fatalError("init(coder:) has not been implemented")
    }
    
    required init(delegate: DropboxControllerDelegate? = nil) {
        super.init(rootViewController: controller)
        
        self.mDelegate = delegate
    }
}

class DropboxFilesController: UITableViewController {

    // MARK: - Properties -
    
    var folderItems: [Files.Metadata] = []
    var item: Files.Metadata?
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        setupNavigationBar()
        initDropbox()
        
        // notification observers
        NotificationCenter.default.addObserver(self, selector: #selector(updateListing(_:)), name: Notifications.willUpdateDropboxFiles, object: nil)
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    private func setupNavigationBar() {
        guard item == nil else {
            return
        }
        
        let cancelButton = UIBarButtonItem(title: "Cancel", style: .plain, target: self, action: #selector(cancelController(_:)))
        navigationItem.setLeftBarButton(cancelButton, animated: false)
        
        let refreshButton = UIBarButtonItem(title: "Refresh", style: .done, target: self, action: #selector(refreshController(_:)))
        navigationItem.setRightBarButton(refreshButton, animated: false)
        
        // set titlte
        self.title = "Dropbox"
    }
    
    @objc private func cancelController(_ sender: Any) {
        guard let controller = navigationController as? DropboxController else { return }
        controller.mDelegate?.viewControllerDidCancel(controller)
    }
    
    @objc private func refreshController(_ sender: Any) {
        initDropbox()
    }
    
    // MARK: - Notification -
    
    @objc func updateListing(_ notification: NSNotification) {
        initDropbox()
    }
    
    // MARK: - Functions -
    
    func initDropbox() {
        
        guard DropboxClientsManager.authorizedClient != nil else {
            // login to dropbox
            DropboxClientsManager.authorizeFromController(UIApplication.shared, controller: self, openURL: { (url: URL) -> Void in
                UIApplication.shared.openURL(url)
            })
            return
        }
        
        guard let dropboxClient = DropboxClientsManager.authorizedClient else {
            return
        }
        
        
        var mPath = ""
        
        // check
        if let folder = item as? Files.FolderMetadata {
            self.title = folder.name
            mPath = folder.pathLower!
        }
        
        dropboxClient.files.listFolder(path: mPath).response { response, error in
            if let result = response {
                self.folderItems = result.entries
                self.tableView.reloadData()
            } else if let callError = error {
                switch callError {
                case .routeError(let boxed, _, _ , _):
                    switch boxed.unboxed {
                    case .path(let lookupError):
                        print("lookupError:")
                        print(lookupError)
                    case .other:
                        print("Other")
                    }
                default:
                    print("default")
                }
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
        self.tableView.tableFooterView = UIView()
        
        DispatchQueue.main.async { [weak self] in
            guard let self = self else { return }
            self.view.addSubview(self.errorView)
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
        if !view.subviews.contains(errorView) {
            return
        }
        DispatchQueue.main.async {
            self.errorView.removeFromSuperview()
        }
    }
    
    // MARK: - TableView Datasource -
    
    override func numberOfSections(in _: UITableView) -> Int {
        return 1
    }

    override func tableView(_: UITableView, numberOfRowsInSection _: Int) -> Int {
        return folderItems.count
    }
    
    override func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 0.0001
    }

    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let item = folderItems[indexPath.row]
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        
        // check
        if let file = item as? Files.FileMetadata {
            cell.textLabel?.text = file.name
            cell.accessoryType = .none
            
            // get file extension
            let name = file.name.components(separatedBy: ".")
            if let ext = name.last {
                
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
                cell.imageView?.image = icon!
            }
            
        } else if let folder = item as? Files.FolderMetadata {
            cell.textLabel?.text = folder.name
            cell.accessoryType = .disclosureIndicator
            cell.imageView?.image = UIImage.fontAwesomeIcon(name: .folder, style: .regular, textColor: .systemBlue, size: CGSize(width: 24, height: 24))
        }

        return cell
    }
    
    override func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        let item = folderItems[indexPath.row]
        
        // check
        if let file = item as? Files.FileMetadata {
            
            guard let dropboxClient = DropboxClientsManager.authorizedClient else {
                return
            }
            
            // get destination url
            let directoryURL = FileManager.default.urls(for: .documentDirectory, in: .userDomainMask)[0]
            let destURL = directoryURL.appendingPathComponent(file.name)
            let destination: (URL, HTTPURLResponse) -> URL = { temporaryURL, response in
                return destURL
            }
            
            
            // download the file
            SVProgressHUD.setDefaultMaskType(.clear)
            SVProgressHUD.show()
            dropboxClient.files.download(path: file.pathLower!, overwrite: true, destination: destination)
                        .response { response, error in
                            SVProgressHUD.setDefaultMaskType(.none)
                            SVProgressHUD.dismiss()
                            guard error == nil else {
                                print(error?.description as Any)
                                return SVProgressHUD.showError(withStatus: "Error downloading file!")
                            }
                            
                            DispatchQueue.main.async {
                                guard let controller = self.navigationController as? DropboxController else { return }
                                controller.mDelegate?.viewController(controller, didFinishedPickingWithURLString: destURL, filename: file.name)
                            }
                        }
                        .progress { progressData in
                            print(progressData)
                        }
            
        } else if let folder = item as? Files.FolderMetadata {
            // expand folder
            let controller = self.storyboard?.instantiateViewController(identifier: "sb_DropboxFilesController") as? DropboxFilesController
            controller?.item = folder
            self.navigationController?.pushViewController(controller!, animated: true)
        }
    }

}
