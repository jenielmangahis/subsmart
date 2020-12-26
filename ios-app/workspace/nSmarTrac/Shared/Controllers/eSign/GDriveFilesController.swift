//
//  GDriveFilesController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 03/09/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import FontAwesome_swift
import GoogleSignIn
import GoogleAPIClientForREST
import SVProgressHUD

protocol GDriveControllerDelegate: class {
    func viewController(_ viewController: GDriveController, didFinishedPickingWithURLString urlString: URL, filename: String)
    func viewControllerDidCancel(_ viewController: GDriveController)
    
}

class GDriveController: UINavigationController {
    
    var mDelegate: GDriveControllerDelegate?
    
    var controller: UITableViewController = {
        let sb = UIStoryboard(name: "Others", bundle: Bundle.main)
        return sb.instantiateViewController(withIdentifier: "sb_GDriveFilesController") as! GDriveFilesController
    }()
    
    override public var supportedInterfaceOrientations: UIInterfaceOrientationMask {
        return .portrait
    }
    
    required init?(coder: NSCoder) {
        fatalError("init(coder:) has not been implemented")
    }
    
    required init(delegate: GDriveControllerDelegate? = nil) {
        super.init(rootViewController: controller)
        
        self.mDelegate = delegate
    }
}

class GDriveFilesController: UITableViewController {

    // MARK: - Properties -
    
    let googleDriveService = GTLRDriveService()
    var googleUser: GIDGoogleUser?
    var folderItems: [GTLRDrive_File] = []
    var item: GTLRDrive_File?
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        setupNavigationBar()
        initGDrive()
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
        self.title = "Google Drive"
    }
    
    @objc private func cancelController(_ sender: Any) {
        guard let controller = navigationController as? GDriveController else { return }
        controller.mDelegate?.viewControllerDidCancel(controller)
    }
    
    @objc private func refreshController(_ sender: Any) {
        initGDrive()
    }
    
    // MARK: - Google Drive -
    
    func initGDrive() {
        // init
        var id = ""
        
        // check
        if let item = self.item {
            self.title = item.name
            id = item.identifier!
        }
        
        // get list
        self.listFiles(id, completion: { (list, error) in
            guard error == nil else {
                return self.addErrorView(with: error!)
            }
            
            if let files = list?.files {
                print(files)
                self.folderItems = files
                self.tableView.reloadData()
            }
        })
    }
    
    func search(_ fileName: String, completion: @escaping (String?, Error?) -> ()) {
        let query = GTLRDriveQuery_FilesList.query()
        query.pageSize = 1
        query.q = "name contains '\(fileName)'"
            
        self.googleDriveService.executeQuery(query) { (ticket, results, error) in
            completion((results as? GTLRDrive_FileList)?.files?.first?.identifier, error)
        }
    }
    
    func listFilesInFolder(_ folder: String, completion: @escaping (GTLRDrive_FileList?, Error?) -> ()) {
        search(folder) { (folderID, error) in
            guard let ID = folderID else {
                completion(nil, error)
                return
            }
            self.listFiles(ID, completion: completion)
        }
    }
        
    func listFiles(_ folderID: String, completion: @escaping (GTLRDrive_FileList?, Error?) -> ()) {
        let query = GTLRDriveQuery_FilesList.query()
        query.pageSize = 100
        query.q = "'\(folderID)' in parents"
            
        self.googleDriveService.executeQuery(query) { (ticket, result, error) in
            completion(result as? GTLRDrive_FileList, error)
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
        let mimeType = item.mimeType
        let ext = item.fileExtension
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        
        // check
        if mimeType != "application/vnd.google-apps.folder" {
            cell.textLabel?.text = item.name
            cell.accessoryType = .none
            
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
            
        } else {
            cell.textLabel?.text = item.name
            cell.accessoryType = .disclosureIndicator
            cell.imageView?.image = UIImage.fontAwesomeIcon(name: .folder, style: .regular, textColor: .systemBlue, size: CGSize(width: 24, height: 24))
        }

        return cell
    }
    
    override func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        let item = folderItems[indexPath.row]
        let mimeType = item.mimeType
        
        // check
        if mimeType != "application/vnd.google-apps.folder" {
            
        } else {
            // expand folder
            let controller = self.storyboard?.instantiateViewController(identifier: "sb_GDriveFilesController") as? GDriveFilesController
            controller?.item = item
            self.navigationController?.pushViewController(controller!, animated: true)
        }
    }

}

// MARK: - GIDSignInDelegate -

/*extension GDriveFilesController: GIDSignInDelegate {
    
    func initGDrive() {
        /***** Configure Google Sign In *****/
        GIDSignIn.sharedInstance()?.delegate = self
        GIDSignIn.sharedInstance()?.presentingViewController = self
        GIDSignIn.sharedInstance()?.scopes = [kGTLRAuthScopeDrive]
        GIDSignIn.sharedInstance()?.signIn()
    }
    
    func sign(_ signIn: GIDSignIn!, didSignInFor user: GIDGoogleUser!, withError error: Error!) {
        // check
        if error == nil {
            // Include authorization headers/values with each Drive API request.
            self.googleDriveService.authorizer = user.authentication.fetcherAuthorizer()
            self.googleUser = user
            
            self.initFiles()
        } else {
            self.googleDriveService.authorizer = nil
            self.googleUser = nil
        }
    }
    
    func sign(_ signIn: GIDSignIn!, didDisconnectWith user: GIDGoogleUser!, withError error: Error!) {
        self.addErrorView(with: error!)
    }
}*/
