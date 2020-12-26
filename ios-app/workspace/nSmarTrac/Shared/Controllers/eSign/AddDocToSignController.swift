//
//  AddDocToSignController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 05/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import FontAwesome_swift
import GoogleSignIn
import GoogleAPIClientForREST
import MobileCoreServices
import PDFKit
import SVProgressHUD
import SwiftyDropbox
import WeScan

class AddDocToSignController: UIViewController {

    // MARK: - Properties -
    
    @IBOutlet var closeButtonItem: UIBarButtonItem!
    @IBOutlet var collectionView: UICollectionView!
    
    let googleDriveService = GTLRDriveService()
    var googleUser: GIDGoogleUser?
    
    var callback: ((PDFDocument, String) -> Void)?
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initNavBar()
        initCollectionViewLayout()
                
        self.title = "Add Documents"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func initNavBar() {
        // setup navBar icons
        closeButtonItem.image = UIImage.fontAwesomeIcon(name: .times
            , style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
    }
    
    func getFileExtension(for filename: String) -> String {
        let array = filename.components(separatedBy: ".")
        return array.last!
    }
    
    // MARK: - Actions -
    
    @IBAction func closeButtonTapped(_ sender: Any) {
        dismiss(animated: true, completion: nil)
    }
    
}

// MARK: - UICollectionView Datasource -

extension AddDocToSignController: UICollectionViewDelegate, UICollectionViewDataSource {
    
    func initCollectionViewLayout() {
        let layout = UICollectionViewFlowLayout()
        layout.scrollDirection = .vertical
        layout.itemSize = CGSize(width: (Device.width-80)/3, height: 100)
        layout.sectionInset = UIEdgeInsets(top: 20, left: 20, bottom: 20, right: 20)
        layout.minimumLineSpacing = 20
        layout.minimumInteritemSpacing = 20
        self.collectionView.setCollectionViewLayout(layout, animated: true)
    }
    
    func collectionView(_ collectionView: UICollectionView, numberOfItemsInSection section: Int) -> Int {
        return 8
    }
    
    func collectionView(_ collectionView: UICollectionView, cellForItemAt indexPath: IndexPath) -> UICollectionViewCell {
        let titles = ["Scan", "Photos", "Files", "Templates", "Library", "Dropbox", "Google", "Box"]
        let imageNames = ["ic_esign_scan", "ic_esign_photos", "ic_esign_files", "ic_esign_templates", "ic_esign_library", "ic_esign_dropbox", "ic_esign_gdrive", "ic_esign_box"]
        // Configure the cell...
        let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "Cell", for: indexPath) as! AddDocCell
        cell.logo.image = UIImage(named: imageNames[indexPath.row])?.resizeImage(40, opaque: false)
        cell.name.text = titles[indexPath.row]
        
        return cell
    }
    
    func collectionView(_ collectionView: UICollectionView, didSelectItemAt indexPath: IndexPath) {
        switch indexPath.row {
        case 0:
            presentWeScanner()
        case 1:
            presentImagePicker()
        case 2:
            presentDocumentPicker()
        case 3:
            break
        case 4:
            presentLibraryController()
        case 5:
            presentDropboxController()
        case 6:
            initGDrive()
        case 7:
            presentBoxController()
        default:
            break
        }
    }
}

// MARK: - Cells -

class AddDocCell: UICollectionViewCell {
    @IBOutlet var logo: UIImageView!
    @IBOutlet var name: UILabel!
}

// MARK: - WeScan Delegate -

extension AddDocToSignController: ImageScannerControllerDelegate {
    
    func presentWeScanner() {
        let scannerViewController = ImageScannerController()
        scannerViewController.imageScannerDelegate = self
        present(scannerViewController, animated: true)
    }
    
    func imageScannerController(_ scanner: ImageScannerController, didFinishScanningWithResults results: ImageScannerResults) {
        // close scanner
        scanner.dismiss(animated: true)
        
        // get image
        let image = results.croppedScan.image
        
        if let pdfDocument = PdfHelper.createPdfDocument(fromImage: image.resize(toWidth: 250)!) {
            // pass to callback
            self.callback!(pdfDocument, "Scan \(App.shared.scanDateFormatter.string(from: Date())).pdf")
        }
    }
    
    func imageScannerControllerDidCancel(_ scanner: ImageScannerController) {
        scanner.dismiss(animated: true)
    }
    
    func imageScannerController(_ scanner: ImageScannerController, didFailWithError error: Error) {
        print(error)
    }
}

// MARK: - UIImagePickerControllerDelegate -

extension AddDocToSignController: UIImagePickerControllerDelegate, UINavigationControllerDelegate {
    
    func presentImagePicker() {
        if UIImagePickerController.isSourceTypeAvailable(.photoLibrary) {
            let imagePicker = UIImagePickerController()
            imagePicker.delegate = self
            imagePicker.sourceType = .photoLibrary
            imagePicker.allowsEditing = false
            self.present(imagePicker, animated: true, completion: nil)
        }
    }
    
    func imagePickerController(_ picker: UIImagePickerController, didFinishPickingMediaWithInfo info: [UIImagePickerController.InfoKey : Any]) {
        // close picker
        dismiss(animated:true, completion: nil)
        
        guard let image = info[.originalImage] as? UIImage else { return }
        let scannerViewController = ImageScannerController(image: image, delegate: self)
        self.present(scannerViewController, animated: true)
    }
    
    func imagePickerControllerDidCancel(_ picker: UIImagePickerController) {
        dismiss(animated:true, completion: nil)
    }
}

// MARK: - UIDocumentPickerDelegate

extension AddDocToSignController: UIDocumentPickerDelegate {
    
    func presentDocumentPicker() {
        let types: [String] = [kUTTypePDF as String, kUTTypeRTF as String, kUTTypePNG as String, kUTTypeJPEG as String]
        let documentPicker = UIDocumentPickerViewController(documentTypes: types, in: .import)
        documentPicker.delegate = self
        documentPicker.modalPresentationStyle = .formSheet
        self.present(documentPicker, animated: true, completion: nil)
    }
    
    func documentPicker(_ controller: UIDocumentPickerViewController, didPickDocumentsAt urls: [URL]) {
        
    }

    func documentPickerWasCancelled(_ controller: UIDocumentPickerViewController) {
        dismiss(animated: true, completion: nil)
    }
}

// MARK: - Library Files -

extension AddDocToSignController: LibraryControllerDelegate {
    
    func presentLibraryController() {
        let controller = LibraryController()
        controller.mDelegate = self
        self.present(controller, animated: true, completion: nil)
    }
    
    func viewController(_ viewController: LibraryController, didFinishedPickingWithURLString urlString: URL, filename: String) {
        dismiss(animated: true, completion: nil)
        
        // create a PDFDocument
        if let pdfDocument = PdfHelper.createPdfDocument(forURL: urlString.absoluteString) {
            // pass to callback
            self.callback!(pdfDocument, filename)
        }
    }
    
    func viewControllerDidCancel(_ viewController: LibraryController) {
        dismiss(animated: true, completion: nil)
    }
}

// MARK: - Dropbox -

extension AddDocToSignController: DropboxControllerDelegate {
    
    func presentDropboxController() {
        let controller = DropboxController()
        controller.mDelegate = self
        self.present(controller, animated: true, completion: nil)
    }
    
    func viewController(_ viewController: DropboxController, didFinishedPickingWithURLString urlString: URL, filename: String) {
        dismiss(animated: true, completion: nil)
        
        // create a PDFDocument
        if let pdfDocument = PdfHelper.createPdfDocument(forURL: urlString.absoluteString) {
            // pass to callback
            self.callback!(pdfDocument, filename)
        }
    }
    
    func viewControllerDidCancel(_ viewController: DropboxController) {
        dismiss(animated: true, completion: nil)
    }
}

// MARK: - Box -

extension AddDocToSignController: BoxControllerDelegate {
    
    func presentBoxController() {
        let controller = BoxController()
        controller.mDelegate = self
        self.present(controller, animated: true, completion: nil)
    }
    
    func viewController(_ viewController: BoxController, didFinishedPickingWithURLString urlString: URL, filename: String) {
        dismiss(animated: true, completion: nil)
        
        // create a PDFDocument
        if let pdfDocument = PdfHelper.createPdfDocument(forURL: urlString.absoluteString) {
            // pass to callback
            self.callback!(pdfDocument, filename)
        }
    }
    
    func viewControllerDidCancel(_ viewController: BoxController) {
        dismiss(animated: true, completion: nil)
    }
}

// MARK: - Google Drive -

extension AddDocToSignController: GDriveControllerDelegate {
    
    func presentGDriveController() {
        let controller = GDriveController()
        controller.mDelegate = self
        self.present(controller, animated: true, completion: nil)
    }
    
    func viewController(_ viewController: GDriveController, didFinishedPickingWithURLString urlString: URL, filename: String) {
        dismiss(animated: true, completion: nil)
        
        // create a PDFDocument
        if let pdfDocument = PdfHelper.createPdfDocument(forURL: urlString.absoluteString) {
            // pass to callback
            self.callback!(pdfDocument, filename)
        }
    }
    
    func viewControllerDidCancel(_ viewController: GDriveController) {
        dismiss(animated: true, completion: nil)
    }
}

// MARK: - GIDSignInDelegate -

extension AddDocToSignController: GIDSignInDelegate {
    
    func initGDrive() {
        /***** Configure Google Sign In *****/
        GIDSignIn.sharedInstance()?.delegate = self
        GIDSignIn.sharedInstance()?.presentingViewController = self
        GIDSignIn.sharedInstance()?.scopes = [kGTLRAuthScopeCalendar, kGTLRAuthScopeDrive]
        GIDSignIn.sharedInstance()?.signIn()
    }
    
    func sign(_ signIn: GIDSignIn!, didSignInFor user: GIDGoogleUser!, withError error: Error!) {
        // check
        if error == nil {
            // Include authorization headers/values with each Drive API request.
            self.googleDriveService.authorizer = user.authentication.fetcherAuthorizer()
            self.googleUser = user
            
            //self.presentGDriveController()
            
            // present file list
            /*let controller = self.storyboard?.instantiateViewController(identifier: "sb_GDriveFilesController") as? GDriveFilesController
            controller?.googleDriveService.authorizer = user.authentication.fetcherAuthorizer()
            controller?.googleUser = user
            self.navigationController?.pushViewController(controller!, animated: true)*/
            
        } else {
            self.googleDriveService.authorizer = nil
            self.googleUser = nil
        }
    }
    
    func sign(_ signIn: GIDSignIn!, didDisconnectWith user: GIDGoogleUser!, withError error: Error!) {
        print(error.localizedDescription)
    }
}

