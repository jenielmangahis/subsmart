//
//  BoxFilesController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 03/09/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import AuthenticationServices
import BoxSDK
import FontAwesome_swift
import SVProgressHUD

protocol BoxControllerDelegate: class {
    func viewController(_ viewController: BoxController, didFinishedPickingWithURLString urlString: URL, filename: String)
    func viewControllerDidCancel(_ viewController: BoxController)
    
}

class BoxController: UINavigationController {
    
    var mDelegate: BoxControllerDelegate?
    
    var controller: UITableViewController = {
        let sb = UIStoryboard(name: "Others", bundle: Bundle.main)
        return sb.instantiateViewController(withIdentifier: "sb_BoxFilesController") as! BoxFilesController
    }()
    
    override public var supportedInterfaceOrientations: UIInterfaceOrientationMask {
        return .portrait
    }
    
    required init?(coder: NSCoder) {
        fatalError("init(coder:) has not been implemented")
    }
    
    required init(delegate: BoxControllerDelegate? = nil) {
        super.init(rootViewController: controller)
        
        self.mDelegate = delegate
    }
}

class BoxFilesController: UITableViewController, ASWebAuthenticationPresentationContextProviding {

    // MARK: - Properties -
    
    private var sdk: BoxSDK!
    private var client: BoxClient!
    private var folderItems: [FolderItem] = []
    private let initialPageSize: Int = 100
    var item: FolderItem?
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        setupNavigationBar()
        initBox()
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
        self.title = "Box"
    }
    
    @objc private func cancelController(_ sender: Any) {
        guard let controller = navigationController as? BoxController else { return }
        controller.mDelegate?.viewControllerDidCancel(controller)
    }
    
    @objc private func refreshController(_ sender: Any) {
        initBox()
    }
    
    // MARK: - Functions -
    
    func initBox() {
        // init
        let clientId = "rpj0fg3di6yelgyovx7bx6mt55hy5hwf"
        let clientSecret = "DNQP6WoBGhJiz42AtBCB61WXbZHxtuzM"
        
        sdk = BoxSDK(clientId: clientId, clientSecret: clientSecret)
        sdk.getOAuth2Client(tokenStore: KeychainTokenStore(), context: self) { result in
            switch result {
            case let .success(client):
                self.client = client
                
                // check
                if case let .folder(folder) = self.item {
                    self.title = folder.name
                    self.getSinglePageOfFolderItems(folder.id)
                } else {
                    self.getSinglePageOfFolderItems()
                }
            case let .failure(error):
                self.addErrorView(with: error)
            }
        }
    }
    
    func getSinglePageOfFolderItems(_ folderId: String = BoxSDK.Constants.rootFolder) {
        // call api
        client.folders.listItems(folderId: folderId, usemarker: true, fields: ["name", "extension"]) { [weak self] result in
            guard let self = self else {return}

            switch result {
            case let .success(items):
                self.folderItems = []

                for _ in 1...self.initialPageSize {
                    items.next { result in
                        switch result {
                        case let .success(item):
                            DispatchQueue.main.async {
                                self.folderItems.append(item)
                                self.tableView.reloadData()
                            }
                        case let .failure(error):
                            return print (error.message)
                        }
                    }
                }
            case let .failure(error):
                self.addErrorView(with: error)
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
        if case let .file(file) = item {
            cell.textLabel?.text = file.name
            cell.accessoryType = .none
            
            var icon: UIImage?
            
            switch file.extension {
            case "boxnote":
                icon = UIImage.fontAwesomeIcon(name: .file, style: .regular, textColor: .systemBlue, size: CGSize(width: 24, height: 24))
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
        else if case let .folder(folder) = item {
            cell.textLabel?.text = folder.name
            cell.accessoryType = .disclosureIndicator
            cell.imageView?.image = UIImage.fontAwesomeIcon(name: .folder, style: .regular, textColor: .systemBlue, size: CGSize(width: 24, height: 24))
        }

        return cell
    }
    
    override func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        let item = folderItems[indexPath.row]
        
        // check
        if case let .file(file) = item {
            // get destination url
            let directoryURL = FileManager.default.urls(for: .documentDirectory, in: .userDomainMask)[0]
            let destURL = directoryURL.appendingPathComponent(file.name!)
            let destination: (URL, HTTPURLResponse) -> URL = { temporaryURL, response in
                return destURL
            }
            
            // download the file
            SVProgressHUD.setDefaultMaskType(.clear)
            SVProgressHUD.show()
            client.files.download(fileId: file.id, destinationURL: destURL) { (result: Result<Void, BoxSDKError>) in
                SVProgressHUD.setDefaultMaskType(.none)
                SVProgressHUD.dismiss()
                guard case .success = result else {
                    return SVProgressHUD.showError(withStatus: "Error downloading file!")
                }
                
                DispatchQueue.main.async {
                    guard let controller = self.navigationController as? BoxController else { return }
                    controller.mDelegate?.viewController(controller, didFinishedPickingWithURLString: destURL, filename: file.name!)
                }
            }
        }
        else if case let .folder(folder) = item {
            // expand folder
            let controller = self.storyboard?.instantiateViewController(identifier: "sb_BoxFilesController") as? BoxFilesController
            controller?.item = item
            self.navigationController?.pushViewController(controller!, animated: true)
        }
    }

}

// MARK: - ASWebAuthenticationPresentationContextProviding -
/// Extension for ASWebAuthenticationPresentationContextProviding conformance
extension BoxFilesController {
    
    @available(iOS 13.0, *)
    func presentationAnchor(for session: ASWebAuthenticationSession) -> ASPresentationAnchor {
        return self.view.window ?? ASPresentationAnchor()
    }
}
