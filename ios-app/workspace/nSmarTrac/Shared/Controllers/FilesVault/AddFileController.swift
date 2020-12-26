//
//  AddFileController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 05/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import FontAwesome_swift
import MobileCoreServices
import SVProgressHUD

class AddFileController: UITableViewController {

    // MARK: - Properties -
    
    @IBOutlet var nameField: MaterialTextField!
    @IBOutlet var attachToEstimateField: MaterialDropdownField!
    @IBOutlet var attachToInvoiceField: MaterialDropdownField!
    @IBOutlet var btnUpload: DesignableButton!
    
    var folder: Folder?
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initViews()
                
        self.title = "Add File"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func initViews() {
        // configure tableview
        tableView = UITableView(frame: CGRect.zero, style: .grouped)
        tableView.sectionFooterHeight = 1
        
        // configure button
        btnUpload.setImage(UIImage.fontAwesomeIcon(name: .upload, style: .regular, textColor: .white, size: CGSize(width: 24, height: 24)), for: .normal)
        
        // configure dropdown
        attachToEstimateField.updateOptions(options: ["-select-", "Residential and Commercial Estimates", "Residential Estimates", "Commercial Estimates"])
        attachToInvoiceField.updateOptions(options: ["-select-", "Residential and Commercial Invoices", "Residential Invoices", "Commercial Invoices"])
    }
    
    // MARK: - Actions -
    
    @IBAction func uploadButtonTapped(_ sender: Any) {
        presentDocumentPicker()
    }
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.view.endEditing(true)
        self.popViewController()
    }
    
    @IBAction func saveButtonTapped(_ sender: Any) {
    }
    
}

// MARK: - UIDocumentMenuDelegate, UIDocumentPickerDelegate, UINavigationControllerDelegate

extension AddFileController: UIDocumentPickerDelegate, UINavigationControllerDelegate {
    
    func presentDocumentPicker() {
        let types: [String] = [kUTTypePDF as String, kUTTypeRTF as String, kUTTypePNG as String, kUTTypeJPEG as String, kUTTypeGIF as String]
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
