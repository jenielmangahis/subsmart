//
//  PreviewController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 24/09/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import PDFKit

class PreviewController: UIViewController {

    // MARK: - Properties -
    
    var documents: [PDFDocument] = []
    var item: ESign!
    
    
    
    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        loadData()
        
        self.title = item.name
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Load data -
    
    func loadData() {
        // create group
        let group = DispatchGroup()
        
        // get documents
        for file in item.files {
            // enter group
            group.enter()
            
            // create a PDFDocument
            if let document = PdfHelper.createPdfDocument(forURL: file.path) {
                // append
                self.documents.append(document)
                
                // leave group
                group.leave()
            }
        }
        
        // notify group
        group.notify(queue: DispatchQueue.main, execute: {
            // display pdf
            self.initPDFView()
        })
    }
    
    // MARK: - Functions -
    
    func initPDFView() {
        let pdfView = PDFView(frame: view.bounds)
        pdfView.autoScales          = true
        pdfView.displayDirection    = .vertical
        pdfView.displayMode         = .singlePageContinuous
        pdfView.document            = PdfHelper.merge(documents)
        view.addSubview(pdfView)
    }
    
    // MARK: - Actions -
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.dismiss(animated: true, completion: nil)
    }
    
}
