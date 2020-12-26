//
//  SignController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 05/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import FontAwesome_swift
import SVProgressHUD

class SignController: UIViewController {

    // MARK: - Properties -
    
    @IBOutlet var sendButtonItem: UIButton!
    @IBOutlet var estimateLabel: UILabel!
    @IBOutlet var dateLabel: UILabel!
    @IBOutlet var amountLabel: UILabel!
    @IBOutlet var textLabel: UILabel!
    @IBOutlet var signatureView: YPDrawSignatureView!
    @IBOutlet var signLabel: UIView!
    @IBOutlet var resetButton: UIButton!
    @IBOutlet var beforeButton: UIButton!
    @IBOutlet var afterButton: UIButton!
    @IBOutlet var businessButton: UIButton!
    
    var item: Estimate = App.shared.selectedEstimate!
    
    var callback: ((UIImage) -> Void)?
    


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
        // setup navBar icons
        sendButtonItem.setImage(UIImage.fontAwesomeIcon(name: .paperPlane, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24)), for: .normal)
        
        // reset button
        resetButton.setImage(UIImage.fontAwesomeIcon(name: .times, style: .solid, textColor: .systemGroupedBackground, size: CGSize(width: 30, height: 30)), for: .normal)
        
        // set title
        self.navigationItem.title = "Signature"
    }

    // MARK: - Functions -
    
    func initViews() {
        // init total
        var subTotal = 0.00
        var taxes = 0.00
        var grandTotal = 0.00
        
        // iterate items
        for mItem in item.items {
            subTotal += mItem.price.doubleValue
            taxes += (subTotal * 0.075)
            grandTotal = subTotal + taxes
        }
        
        estimateLabel.text  = "Estimate: #\(item.estimate_number)"
        dateLabel.text      = "Date: \(item.estimate_date.toReadableDate)"
        amountLabel.text    = "Amount: $\(grandTotal.stringValue)"
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
    
    @IBAction func viewTermsButtonTapped(_ sender: Any) {
    }
    
    @IBAction func sendButtonTapped(_ sender: Any) {
        if let image = signatureView.getCroppedSignature() {
            self.callback!(image)
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
        businessButton.setBackgroundColor(.lightGray, for: .normal)
        // set selected to green
        beforeButton.setBackgroundColor(.greenColor, for: .normal)
        // set textLabel
        textLabel.text = "I have read and agree to the terms of service agreement."
    }
    
    @IBAction func afterButtonTapped(_ sender: Any) {
        // reset to gray
        beforeButton.setBackgroundColor(.lightGray, for: .normal)
        afterButton.setBackgroundColor(.lightGray, for: .normal)
        businessButton.setBackgroundColor(.lightGray, for: .normal)
        // set selected to green
        afterButton.setBackgroundColor(.greenColor, for: .normal)
        // set textLabel
        textLabel.text = "I confirm that all the work has been performed to my satisfaction."
    }
    
    @IBAction func businessButtonTapped(_ sender: Any) {
        // reset to gray
        beforeButton.setBackgroundColor(.lightGray, for: .normal)
        afterButton.setBackgroundColor(.lightGray, for: .normal)
        businessButton.setBackgroundColor(.lightGray, for: .normal)
        // set selected to green
        businessButton.setBackgroundColor(.greenColor, for: .normal)
        // set textLabel
        textLabel.text = "I hereby submit an Estimate."
    }
    
}

// MARK: - YPSignatureDelegate -

extension SignController: YPSignatureDelegate {
    
    func didStart(_ view: YPDrawSignatureView) {
        print(#function)
        signLabel.isHidden = true
    }
    
    func didFinish(_ view: YPDrawSignatureView) {
        print(#function)
    }
}
