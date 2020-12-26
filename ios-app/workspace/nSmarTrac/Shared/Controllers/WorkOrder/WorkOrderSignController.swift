//
//  WorkOrderSignController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 21/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import FontAwesome_swift
import SVProgressHUD

class WorkOrderSignController: UIViewController {

    // MARK: - Properties -
    
    @IBOutlet var numberLabel: UILabel!
    @IBOutlet var nameLabel: UILabel!
    @IBOutlet var textLabel: UILabel!
    @IBOutlet var signatureView: YPDrawSignatureView!
    @IBOutlet var signLabel: UIView!
    @IBOutlet var resetButton: UIButton!
    @IBOutlet var beforeButton: UIButton!
    @IBOutlet var afterButton: UIButton!
    @IBOutlet var ownerButton: UIButton!
    
    var item: WorkOrder = App.shared.selectedWorkOrder!
    var authorizer: String!
    var callback: ((UIImage?, UIImage?, UIImage?) -> Void)?
    
    var beforeImage: UIImage?
    var afterImage: UIImage?
    var ownerImage: UIImage?
    var selectedButton: UIButton?
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        rotateToLandsScapeDevice()
        initNavBar()
        initViews()
        
        // delegate
        signatureView.delegate      = self
        signatureView.strokeWidth   = 2
        signatureView.strokeColor   = .black
        
        // pre-select button
        selectedButton = beforeButton
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    override func viewWillDisappear(_ animated: Bool) {
        super.viewWillDisappear(animated)
        rotateToPotraitScapeDevice()
    }
    
    // MARK: - Navigation Bar -
    
    func initNavBar() {
        // reset button
        resetButton.setImage(UIImage.fontAwesomeIcon(name: .times, style: .solid, textColor: .systemGroupedBackground, size: CGSize(width: 30, height: 30)), for: .normal)
        
        // set title
        self.navigationItem.title = "Authorized to Start"
    }

    // MARK: - Functions -
    
    func initViews() {
        numberLabel.text  = "Work Order: #\(item.work_order_number)"
        nameLabel.text    = authorizer
        nameLabel.borders(for: [.bottom], width: 1, color: .lightGray)
    }
    
    func rotateToLandsScapeDevice() {
        let appDelegate = UIApplication.shared.delegate as! AppDelegate
        appDelegate.myOrientation = .landscapeRight
        UIDevice.current.setValue(UIInterfaceOrientation.landscapeLeft.rawValue, forKey: "orientation")
        UIView.setAnimationsEnabled(true)
    }

    func rotateToPotraitScapeDevice() {
        let appDelegate = UIApplication.shared.delegate as! AppDelegate
        appDelegate.myOrientation = .portrait
        UIDevice.current.setValue(UIInterfaceOrientation.portrait.rawValue, forKey: "orientation")
        UIView.setAnimationsEnabled(true)
    }
    
    // MARK: - Actions -
    
    @IBAction func doneButtonTapped(_ sender: Any) {
        if signatureView.getCroppedSignature() != nil {
            self.callback!(beforeImage ?? nil, afterImage ?? nil, ownerImage ?? nil)
        }
        
        self.navigationController?.popViewController(animated: true)
    }
    
    @IBAction func resetButtonTapped(_ sender: Any) {
        signatureView.clear()
        signLabel.isHidden = false
    }
    
    @IBAction func beforeButtonTapped(_ sender: Any) {
        // reset to gray
        beforeButton.setBackgroundColor(.lightGray, for: .normal)
        afterButton.setBackgroundColor(.lightGray, for: .normal)
        ownerButton.setBackgroundColor(.lightGray, for: .normal)
        // set selected to green
        beforeButton.setBackgroundColor(.greenColor, for: .normal)
        // set textLabel
        textLabel.text = "By signing, I agree to the terms and conditions of this agreement and authorized above work to be performed. Payable upon completion."
        // set image
        selectedButton = beforeButton
        signatureView.clear()
    }
    
    @IBAction func afterButtonTapped(_ sender: Any) {
        // reset to gray
        beforeButton.setBackgroundColor(.lightGray, for: .normal)
        afterButton.setBackgroundColor(.lightGray, for: .normal)
        ownerButton.setBackgroundColor(.lightGray, for: .normal)
        // set selected to green
        afterButton.setBackgroundColor(.greenColor, for: .normal)
        // set textLabel
        textLabel.text = "By signing, I confirm that all the work has been performed to my satisfaction."
        // set image
        selectedButton = afterButton
        signatureView.clear()
    }
    
    @IBAction func ownerButtonTapped(_ sender: Any) {
        // reset to gray
        beforeButton.setBackgroundColor(.lightGray, for: .normal)
        afterButton.setBackgroundColor(.lightGray, for: .normal)
        ownerButton.setBackgroundColor(.lightGray, for: .normal)
        // set selected to green
        ownerButton.setBackgroundColor(.greenColor, for: .normal)
        // set textLabel
        textLabel.text = "By signing, I confirm the work order data."
        // set image
        selectedButton = ownerButton
        signatureView.clear()
    }

}

// MARK: - YPSignatureDelegate -

extension WorkOrderSignController: YPSignatureDelegate {
    
    func didStart(_ view: YPDrawSignatureView) {
        signLabel.isHidden = true
    }
    
    func didFinish(_ view: YPDrawSignatureView) {
        // check selectedButton
        if selectedButton == beforeButton {
            beforeImage = signatureView.getCroppedSignature()
        } else if selectedButton == afterButton {
            afterImage = signatureView.getCroppedSignature()
        } else if selectedButton == ownerButton {
            ownerImage = signatureView.getCroppedSignature()
        }
    }
}
