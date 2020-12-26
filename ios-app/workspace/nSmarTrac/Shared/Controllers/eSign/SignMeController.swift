//
//  SignMeController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 18/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import FontAwesome_swift
import PDFKit
import SVProgressHUD

class SignMeController: UIViewController, UIActionSheetDelegate, UIGestureRecognizerDelegate {

    // MARK: - Properties -
    
    @IBOutlet var pdfView: PDFView!
    
    var currentlySelectedAnnotation: PDFAnnotation?
    var touchLocation: CGPoint?
    
    var documents: [PDFDocument] = []
    var item: ESign!
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initPDFView()
        
        self.title = item.name
        
        // notification observers
        NotificationCenter.default.addObserver(self, selector: #selector(addSignature(_:)), name: Notifications.willAddSignature, object: nil)
        NotificationCenter.default.addObserver(self, selector: #selector(addInitials(_:)), name: Notifications.willAddInitials, object: nil)
        NotificationCenter.default.addObserver(self, selector: #selector(addDate(_:)), name: Notifications.willAddDate, object: nil)
        NotificationCenter.default.addObserver(self, selector: #selector(addName(_:)), name: Notifications.willAddName, object: nil)
        NotificationCenter.default.addObserver(self, selector: #selector(addFirstName(_:)), name: Notifications.willAddFirstName, object: nil)
        NotificationCenter.default.addObserver(self, selector: #selector(addLastName(_:)), name: Notifications.willAddLastName, object: nil)
        NotificationCenter.default.addObserver(self, selector: #selector(addEmail(_:)), name: Notifications.willAddEmail, object: nil)
        NotificationCenter.default.addObserver(self, selector: #selector(addCompany(_:)), name: Notifications.willAddCompany, object: nil)
        NotificationCenter.default.addObserver(self, selector: #selector(addTitle(_:)), name: Notifications.willAddTitle, object: nil)
        NotificationCenter.default.addObserver(self, selector: #selector(addText(_:)), name: Notifications.willAddText, object: nil)
        NotificationCenter.default.addObserver(self, selector: #selector(addCheckbox(_:)), name: Notifications.willAddCheckbox, object: nil)
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func initPDFView() {
        // display
        pdfView.autoScales          = true
        pdfView.displayDirection    = .vertical
        pdfView.displayMode         = .singlePageContinuous
        pdfView.document            = PdfHelper.merge(documents)
        
        // add tap gesture
        let tap = UITapGestureRecognizer(target: self, action: #selector(didTapView(_:)))
        tap.delegate = self
        pdfView.addGestureRecognizer(tap)
        
        // add pan gesture
        let panAnnotation = UIPanGestureRecognizer(target: self, action: #selector(didPanAnnotation(_:)))
        pdfView.addGestureRecognizer(panAnnotation)
    }
    
    // MARK: - Actions -
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        // create actionSheet
        let actionSheet = UIAlertController(title: nil, message: nil, preferredStyle: .actionSheet)
        // add action
        actionSheet.addAction(UIAlertAction(title: "Sign Later", style: .default) { action -> Void in
            self.dismiss(animated: true, completion: {
                self.popToRootController()
            })
        })
        // add action
        actionSheet.addAction(UIAlertAction(title: "Decline to Sign", style: .destructive) { action -> Void in
            // dismiss actionSheet
            actionSheet.dismiss(animated: true, completion: {
                // present DeclineToSignController
                let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_DeclineToSignController") as? DeclineToSignController
                let navController = UINavigationController(rootViewController: viewController!)
                self.present(navController, animated: true, completion: nil)
            })
        })
        // add cancel
        actionSheet.addAction(UIAlertAction(title: "Cancel", style: .cancel)  { action -> Void in
            actionSheet.dismiss(animated: true, completion: nil)
        })
        // present actionSheet
        self.present(actionSheet, animated: true, completion: nil)
    }
    
    @IBAction func moreButtonTapped(_ sender: Any) {
        // create actionSheet
        let actionSheet = UIAlertController(title: nil, message: nil, preferredStyle: .actionSheet)
        // add action
        actionSheet.addAction(UIAlertAction(title: "Save Draft", style: .default) { action -> Void in
            
        })
        actionSheet.addAction(UIAlertAction(title: "Discard Draft", style: .destructive)  { action -> Void in
            // delete from database
            SVProgressHUD.setDefaultMaskType(.clear)
            SVProgressHUD.show()
            App.shared.api.deleteESign(self.item.id.intValue) { (result, error) in
                SVProgressHUD.setDefaultMaskType(.none)
                SVProgressHUD.dismiss()
                guard error == nil else {
                    return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                }
                
                self.popToRootController()
            }
        })
        // add cancel
        actionSheet.addAction(UIAlertAction(title: "Cancel", style: .cancel)  { action -> Void in
            actionSheet.dismiss(animated: true, completion: nil)
        })
        // present actionSheet
        self.present(actionSheet, animated: true, completion: nil)
    }
    
    @IBAction func finishButtonTapped(_ sender: Any) {
    }
    
}

// MARK: - Popover -

extension SignMeController: UIPopoverPresentationControllerDelegate {
    
    func adaptivePresentationStyle(for controller: UIPresentationController) -> UIModalPresentationStyle {
        return .none
    }
    
    // MARK: - Tap Gesture -
    
    @objc func didTapView(_ sender: UITapGestureRecognizer) {
        let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_ToolController") as! ToolController
        viewController.preferredContentSize = CGSize(width: 320, height: 180)
        viewController.modalPresentationStyle = .popover
        
        touchLocation = sender.location(in: pdfView)
        
        let popover: UIPopoverPresentationController = viewController.popoverPresentationController!
        popover.delegate = self
        popover.sourceView = self.view
        popover.sourceRect = CGRect(x: touchLocation!.x, y: touchLocation!.y, width: 50, height: 50)
        present(viewController, animated: true, completion:nil)
    }
    
    @objc func didTapAnnotation(_ sender: UITapGestureRecognizer) {
        
    }
    
    // MARK: - Pan Gesture -
    
    @objc func didPanAnnotation(_ sender: UIPanGestureRecognizer) {
        let touchLocation = sender.location(in: pdfView)
        guard let page = pdfView.page(for: touchLocation, nearest: true) else {
            return
        }
        let locationOnPage = pdfView.convert(touchLocation, to: page)
        
        switch sender.state {
        case .began:
            guard let annotation = page.annotation(at: locationOnPage) else {
                return
            }
            currentlySelectedAnnotation = annotation
            
        case .changed:
            guard let annotation = currentlySelectedAnnotation else {
                return
            }
            let initialBounds = annotation.bounds
            // Set the center of the annotation to the spot of our finger
            annotation.bounds = CGRect(x: locationOnPage.x - (initialBounds.width / 2), y: locationOnPage.y - (initialBounds.height / 2), width: initialBounds.width, height: initialBounds.height)
            print("move to \(locationOnPage)")
            
        case .ended, .cancelled, .failed:
            currentlySelectedAnnotation = nil
            
        default:
            break
        }
    }
    
    // MARK: - Functions -
    
    @objc func addSignature(_ notification: NSNotification) {
        guard let signatureImage = UserDefaults.standard.imageForKey(key: "ESIGN-SIGNATURE-" + App.shared.user!.id),
              let page = pdfView.currentPage else { return }
        
        let imageBounds = CGRect(x: touchLocation!.x, y: touchLocation!.y,  width: 100, height: 50)
        let imageStamp = PDFImageAnnotation(with: signatureImage,  forBounds: imageBounds, withProperties: nil)
        page.addAnnotation(imageStamp)
    }
    
    @objc func addInitials(_ notification: NSNotification) {
        guard let signatureImage = UserDefaults.standard.imageForKey(key: "ESIGN-INITIALS-" + App.shared.user!.id),
              let page = pdfView.currentPage else { return }
        
        let imageBounds = CGRect(x: touchLocation!.x, y: touchLocation!.y,  width: 80, height: 50)
        let imageStamp = PDFImageAnnotation(with: signatureImage,  forBounds: imageBounds, withProperties: nil)
        page.addAnnotation(imageStamp)
    }
    
    @objc func addDate(_ notification: NSNotification) {
        guard let page = pdfView.currentPage else { return }
        
        let annotation = PDFAnnotation(bounds: CGRect(x: touchLocation!.x, y: touchLocation!.y, width: 80, height: 30), forType: .widget, withProperties: nil)
        annotation.widgetFieldType = .text
        annotation.widgetDefaultStringValue = Date().toString(format: DateHelper.dateReadableFormatType)
        annotation.backgroundColor = .yellow
        page.addAnnotation(annotation)
    }
    
    @objc func addName(_ notification: NSNotification) {
        guard let page = pdfView.currentPage else { return }
        
        let annotation = PDFAnnotation(bounds: CGRect(x: touchLocation!.x, y: touchLocation!.y, width: 100, height: 30), forType: .widget, withProperties: nil)
        annotation.widgetFieldType = .text
        annotation.widgetDefaultStringValue = App.shared.user!.full_name
        annotation.backgroundColor = .yellow
        page.addAnnotation(annotation)
    }
    
    @objc func addFirstName(_ notification: NSNotification) {
        guard let page = pdfView.currentPage else { return }
        
        let annotation = PDFAnnotation(bounds: CGRect(x: touchLocation!.x, y: touchLocation!.y, width: 80, height: 30), forType: .widget, withProperties: nil)
        annotation.widgetFieldType = .text
        annotation.widgetDefaultStringValue = App.shared.user!.FName
        annotation.backgroundColor = .yellow
        page.addAnnotation(annotation)
    }
    
    @objc func addLastName(_ notification: NSNotification) {
        guard let page = pdfView.currentPage else { return }
        
        let annotation = PDFAnnotation(bounds: CGRect(x: touchLocation!.x, y: touchLocation!.y, width: 80, height: 30), forType: .widget, withProperties: nil)
        annotation.widgetFieldType = .text
        annotation.widgetDefaultStringValue = App.shared.user!.LName
        annotation.backgroundColor = .yellow
        page.addAnnotation(annotation)
    }
    
    @objc func addEmail(_ notification: NSNotification) {
        guard let page = pdfView.currentPage else { return }
        
        let annotation = PDFAnnotation(bounds: CGRect(x: touchLocation!.x, y: touchLocation!.y, width: 150, height: 30), forType: .widget, withProperties: nil)
        annotation.widgetFieldType = .text
        annotation.widgetDefaultStringValue = App.shared.user!.email
        annotation.backgroundColor = .yellow
        page.addAnnotation(annotation)
    }
    
    @objc func addCompany(_ notification: NSNotification) {
        guard let page = pdfView.currentPage else { return }
        
        let annotation = PDFAnnotation(bounds: CGRect(x: touchLocation!.x, y: touchLocation!.y, width: 100, height: 30), forType: .widget, withProperties: nil)
        annotation.widgetFieldType = .text
        annotation.widgetDefaultStringValue = App.shared.company!.business_name
        annotation.backgroundColor = .yellow
        page.addAnnotation(annotation)
    }
    
    @objc func addTitle(_ notification: NSNotification) {
        guard let page = pdfView.currentPage else { return }
        
        let annotation = PDFAnnotation(bounds: CGRect(x: touchLocation!.x, y: touchLocation!.y, width: 80, height: 30), forType: .widget, withProperties: nil)
        annotation.widgetFieldType = .text
        annotation.backgroundColor = .yellow
        page.addAnnotation(annotation)
    }
    
    @objc func addText(_ notification: NSNotification) {
        guard let page = pdfView.currentPage else { return }
        
        let annotation = PDFAnnotation(bounds: CGRect(x: touchLocation!.x, y: touchLocation!.y, width: 80, height: 30), forType: .widget, withProperties: nil)
        annotation.widgetFieldType = .text
        annotation.backgroundColor = .yellow
        page.addAnnotation(annotation)
    }
    
    @objc func addCheckbox(_ notification: NSNotification) {
        guard let page = pdfView.currentPage else { return }
        
        let annotation = PDFAnnotation(bounds: CGRect(x: touchLocation!.x, y: touchLocation!.y, width: 24, height: 24), forType: .widget, withProperties: nil)
        annotation.widgetFieldType = .button
        annotation.widgetControlType = .checkBoxControl
        annotation.backgroundColor = .yellow
        page.addAnnotation(annotation)
    }
}
