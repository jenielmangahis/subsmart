//
//  DrawSignatureController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 14/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class DrawSignatureController: UIViewController {

    // MARK: - Properties -
    
    @IBOutlet var signatureView: YPDrawSignatureView!
    @IBOutlet var adoptButtonItem: UIBarButtonItem!
    @IBOutlet var blackButton: DesignableButton!
    @IBOutlet var blueButton: DesignableButton!
    @IBOutlet var redButton: DesignableButton!
    
    var callback: ((UIImage) -> Void)?
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        rotateToLandsScapeDevice()
        
        self.title = "Draw Your Signature"
        self.adoptButtonItem.isEnabled = false
        
        // delegate
        signatureView.delegate      = self
        signatureView.strokeWidth   = 3
        signatureView.strokeColor   = .black
        
        // stroke buttons
        blackButton.borderWidth = 3
        blueButton.borderWidth = 0
        redButton.borderWidth = 0
    }
    
    override func viewWillDisappear(_ animated: Bool) {
        super.viewWillDisappear(animated)
        rotateToPotraitScapeDevice()
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }

    // MARK: - Functions -
    
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
    
    // MARK: Actions -
    
    @IBAction func cancelButtonTapped(_ sender: Any) {
        self.popViewController()
    }
    
    @IBAction func adoptButtonTapped(_ sender: Any) {
        // get image
        if let image = signatureView.getCroppedSignature() {
            self.callback!(image)
        }
        self.popViewController()
    }
    
    @IBAction func blackButtonTapped(_ sender: Any) {
        blackButton.borderWidth = 3
        blueButton.borderWidth = 0
        redButton.borderWidth = 0
        signatureView.strokeColor = .black
    }
    
    @IBAction func blueButtonTapped(_ sender: Any) {
        blackButton.borderWidth = 0
        blueButton.borderWidth = 3
        redButton.borderWidth = 0
        signatureView.strokeColor = .blue
    }
    
    @IBAction func redButtonTapped(_ sender: Any) {
        blackButton.borderWidth = 0
        blueButton.borderWidth = 0
        redButton.borderWidth = 3
        signatureView.strokeColor = .red
    }
    
    @IBAction func clearButtonTapped(_ sender: Any) {
        signatureView.clear()
        adoptButtonItem.isEnabled = false
    }

}

// MARK: - YPSignatureDelegate -

extension DrawSignatureController: YPSignatureDelegate {
    
    func didStart(_ view: YPDrawSignatureView) {
        print(#function)
    }
    
    func didFinish(_ view: YPDrawSignatureView) {
        print(#function)
        adoptButtonItem.isEnabled = true
    }
}
