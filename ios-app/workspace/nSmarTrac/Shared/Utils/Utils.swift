//
//  Utils.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 04/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import DLRadioButton
import Floaty
import FontAwesome_swift
import Material

class Utils {

    static let shared = Utils()
    
    func showAlertWithMessage(message: String) {
        let alertController = UIAlertController(title: "", message: message, preferredStyle: .alert)
        let closeAction = UIAlertAction(title: "Close", style: .cancel) { (alertAction) -> Void in
            
        }
        alertController.addAction(closeAction)
        
        if let topMostController = UIApplication.topViewController() {
            topMostController.present(alertController, animated: true, completion: nil)
        }
    }
    
    func showOfflineAlert() {
        if let topMostController = UIApplication.topViewController() {
            let alertController = UIAlertController(title: "No Internet Connection", message: "You data was saved. It will be synced remotely once your internet connection is back...", preferredStyle: .alert)
            let closeAction = UIAlertAction(title: "Close", style: .cancel) { (alertAction) -> Void in
                topMostController.popViewController()
            }
            alertController.addAction(closeAction)
            
            topMostController.present(alertController, animated: true, completion: nil)
        }
    }
    
    func add(asChildViewController viewController: UIViewController) {
        if let topMostController = UIApplication.topViewController() {
            topMostController.addChild(viewController)
            viewController.view.frame = CGRect.init(x: 0, y: 0, width: Device.width, height: Device.height)
            topMostController.view.addSubview(viewController.view)
            viewController.view.autoresizingMask = [.flexibleWidth, .flexibleHeight]
        }
    }
    
    func getAppLogo() -> UIImageView {
        let logo            = UIImage(named: "img-logo.png")
        let imgView         = UIImageView(frame: CGRect(x: 0, y: 0, width: 150, height: 40))
        imgView.image       = logo
        imgView.contentMode = .scaleAspectFit
        return imgView
        //return UIImageView(image: logo)
    }
    
    func generateNoResultBg(text: String) -> UIImage {
        let view                = UIView(frame: CGRect(x: 0, y: 0, width: Device.width, height: Device.height))
        view.backgroundColor    = UIColor(rgb: 0x00B693, alpha: 0.1)
        
        let label           = UILabel(frame: CGRect(x: 0, y: 0, width: Int(Device.width-100), height: 44))
        label.text          = text
        label.textAlignment = .center
        label.textColor     = .black
        label.center        = view.center
        label.numberOfLines = 2
        label.font          = UIFont.latoFont(ofSize: 13)
        view.addSubview(label)
        
        return view.asImage()
    }
    
    public static func addTextToRigthView(textField: TextField, text: String) {
        let label           = UILabel(frame: CGRect(x: 0, y: 0, width: 30, height: 30))
        label.font          = UIFont.latoFont(ofSize: 10)
        label.textAlignment = .right
        label.textColor     = UIColor(rgb: 0x76849F)
        label.text          = text
        
        let view = UIView(frame: CGRect(x: 0, y: 0, width: 30, height: 30))
        view.addSubview(label)
        
        let image = view.asImage()
        
        textField.clearIconButton?.setImage(image, for: .normal)
        textField.isClearIconButtonEnabled = true
        textField.rightViewMode = .always
        textField.rightView?.isUserInteractionEnabled = false
    }
    
    public static func image(_ image:UIImage, withSize newSize: CGSize) -> UIImage {
        UIGraphicsBeginImageContext(newSize)
        image.draw(in: CGRect(x: 0, y: 0, width: newSize.width, height: newSize.height))
        let newImage = UIGraphicsGetImageFromCurrentImageContext()
        UIGraphicsEndImageContext()
        return newImage!.withRenderingMode(.automatic)
    }
    
    // create radio
    public static func createRadioButton(_ x: Int, _ y: Int, _ width: Int, _ title: String) -> DLRadioButton {
        let radio = DLRadioButton(frame: CGRect(x: x, y: y, width: width, height: 30))
        radio.setTitle(title, for: .normal)
        radio.setTitleColor(AppTheme.defaultColor, for: .normal)
        radio.setTitleColor(AppTheme.defaultColor, for: .selected)
        radio.iconColor = AppTheme.defaultColor
        radio.iconSize = 16
        radio.indicatorColor = AppTheme.defaultColor
        radio.indicatorSize = 8
        radio.isIconSquare = false
        radio.iconStrokeWidth = 2
        radio.isMultipleSelectionEnabled = false
        radio.contentHorizontalAlignment = .left
        radio.titleLabel?.font = UIFont.robotoFont(ofSize: 13)
        radio.titleLabel?.adjustsFontSizeToFitWidth = true
        radio.titleLabel?.lineBreakMode = .byClipping
        radio.titleLabel?.textAlignment = .left
        radio.setBackgroundColor(UIColor.clear, for: .normal)
        return radio
    }
    
    // create checkbox
    public static func createCheckBox(_ x: Int, _ y: Int, _ width: Int, _ title: String) -> DLRadioButton {
        let checkbox = DLRadioButton(frame: CGRect(x: x, y: y, width: width, height: 30))
        checkbox.setTitle(title, for: .normal)
        checkbox.setTitleColor(AppTheme.defaultColor, for: .normal)
        checkbox.setTitleColor(AppTheme.defaultColor, for: .selected)
        checkbox.icon = UIImage.fontAwesomeIcon(name: .square, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 24, height: 24))
        checkbox.iconSelected = UIImage.fontAwesomeIcon(name: .checkSquare, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 24, height: 24))
        checkbox.isMultipleSelectionEnabled = false
        checkbox.contentHorizontalAlignment = .left
        checkbox.titleLabel?.font = UIFont.robotoFont(ofSize: 13)
        checkbox.titleLabel?.adjustsFontSizeToFitWidth = true
        checkbox.titleLabel?.lineBreakMode = .byClipping
        checkbox.titleLabel?.textAlignment = .left
        checkbox.setBackgroundColor(UIColor.clear, for: .normal)
        checkbox.setBackgroundColor(UIColor.clear, for: .selected)
        return checkbox
    }
    
    public static func configureCheckbox(_ checkbox: DLRadioButton, _ text: String) {
        checkbox.setTitle(text, for: .normal)
        checkbox.setTitleColor(AppTheme.defaultColor, for: .normal)
        checkbox.setTitleColor(AppTheme.defaultColor, for: .selected)
        checkbox.icon = UIImage.fontAwesomeIcon(name: .square, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 20, height: 20))
        checkbox.iconSelected = UIImage.fontAwesomeIcon(name: .checkSquare, style: .regular, textColor: AppTheme.defaultColor, size: CGSize(width: 20, height: 20))
        checkbox.isMultipleSelectionEnabled = false
        checkbox.contentHorizontalAlignment = .left
        checkbox.titleLabel?.font = UIFont.robotoFont(ofSize: 13)
        checkbox.titleLabel?.adjustsFontSizeToFitWidth = true
        checkbox.titleLabel?.lineBreakMode = .byClipping
        checkbox.titleLabel?.textAlignment = .left
        checkbox.setBackgroundColor(UIColor.clear, for: .normal)
        checkbox.setBackgroundColor(UIColor.clear, for: .selected)
    }
    
    // create table header
    public static func createHeader(_ bgColor: UIColor, _ textColor: UIColor, _ text: String) -> UIView {
        // create label
        let label       = UILabel(frame: CGRect(x: 20, y: 6, width: Device.width-16, height: 21))
        label.font      = UIFont.robotoBoldFont(ofSize: 15)
        label.textColor = textColor
        label.text      = text
        
        // create view
        let header              = UIView(frame: CGRect(x: 0, y: 0, width: Device.width, height: 32))
        header.backgroundColor  = bgColor
        header.addSubview(label)
        
        return header
    }
    
    // create button with right arrow
    public static func createPurpleButton(_ x: Int, _ y: Int, _ mWidth: Int, _ text: String, hasArrow: Bool = true) -> UIButton {
        // create label
        let button                          = UIButton(frame: CGRect(x: x, y: y, width: mWidth, height: 21))
        button.contentHorizontalAlignment   = .left
        button.imageEdgeInsets              = UIEdgeInsets(top: 0, left: 10, bottom: 0, right: 0)
        button.semanticContentAttribute     = .forceRightToLeft
        button.titleLabel?.font             = UIFont.robotoBoldFont(ofSize: 14)
        button.titleLabel?.lineBreakMode    = .byTruncatingTail
        button.setTitle(text, for: .normal)
        button.setTitleColor(AppTheme.defaultColor, for: .normal)
        // check if will add arrow
        if hasArrow {
            button.setImage(UIImage.fontAwesomeIcon(name: .chevronRight, style: .solid, textColor: .lightGray, size: CGSize(width: 12, height: 12)), for: .normal)
        }
        
        return button
    }
    
    // create view for table listing
    public static func createView(_ x: Int, _ y: Int, _ mWidth: Int, _ mHeight: Int, _ label: String, _ value: String, _ borders: [UIRectEdge], _ textAlignment: NSTextAlignment = .left, withArrow: Bool = false) -> UIView {
        // create view
        let view = UIView(frame: CGRect(x: x, y: y, width: mWidth, height: mHeight))
        view.backgroundColor = .clear
        view.borders(for: borders, width: 1, color: UIColor(rgb: 0xDADADA))
        
        // create label
        let topLabel            = UILabel(frame: CGRect(x: 8, y: 8, width: mWidth-8, height: 13))
        topLabel.font           = UIFont.robotoFont(ofSize: 11)
        topLabel.textAlignment  = textAlignment
        topLabel.textColor      = UIColor(rgb: 0xA4A4A4)
        topLabel.text           = label
        view.addSubview(topLabel)
        
        // create value
        let bottomLabel             = UILabel(frame: CGRect(x: 8, y: 25, width: mWidth-8, height: 20))
        bottomLabel.font            = UIFont.robotoFont(ofSize: 13)
        bottomLabel.textAlignment   = textAlignment
        bottomLabel.textColor       = UIColor(rgb: 0x545454)
        bottomLabel.text            = value
        view.addSubview(bottomLabel)
        
        // create arrow
        let arrow = UIButton(frame: CGRect(x: mWidth-20, y: 14, width: 15, height: 22))
        arrow.setImage(UIImage.fontAwesomeIcon(name: .chevronRight, style: .solid, textColor: .lightGray, size: CGSize(width: 12, height: 12)), for: .normal)
        arrow.isHidden = !withArrow
        view.addSubview(arrow)
        
        return view
    }
    
    // create view for table listing with blue textColor
    public static func createViewForInvoice(_ x: Int, _ y: Int, _ mWidth: Int, _ mHeight: Int, _ label: String, _ value: String, _ borders: [UIRectEdge]) -> UIView {
        // create view
        let view = UIView(frame: CGRect(x: x, y: y, width: mWidth, height: mHeight))
        view.backgroundColor = .clear
        view.borders(for: borders, width: 1, color: UIColor(rgb: 0xDADADA))
        
        // create label
        let topLabel            = UILabel(frame: CGRect(x: 8, y: 8, width: mWidth-8, height: 13))
        topLabel.font           = UIFont.robotoFont(ofSize: 11)
        topLabel.textAlignment  = .right
        topLabel.textColor      = UIColor(rgb: 0x3263AB)
        topLabel.text           = label
        view.addSubview(topLabel)
        
        // create value
        let bottomLabel             = UILabel(frame: CGRect(x: 8, y: 25, width: mWidth-8, height: 20))
        bottomLabel.font            = UIFont.robotoFont(ofSize: 13)
        bottomLabel.textAlignment   = .right
        bottomLabel.textColor       = UIColor(rgb: 0x3263AB)
        bottomLabel.text            = value
        view.addSubview(bottomLabel)
        
        return view
    }
    
    // create view for table listing of invoice item and payments
    public static func createPurpleView(_ x: Int, _ y: Int, _ mWidth: Int, _ mHeight: Int, _ text: String, _ borders: [UIRectEdge]) -> UIView {
        // create view
        let view = UIView(frame: CGRect(x: x, y: y, width: mWidth, height: mHeight))
        view.backgroundColor = .clear
        view.borders(for: borders, width: 1, color: UIColor(rgb: 0xDADADA))
        
        // create label
        let label            = UILabel(frame: CGRect(x: 8, y: 14, width: mWidth, height: 21))
        label.font           = UIFont.robotoFont(ofSize: 14)
        label.textAlignment  = .left
        label.textColor      = AppTheme.defaultColor
        label.text           = text
        view.addSubview(label)
        
        return view
    }
    
    // create purple label
    public static func createPurpleLabel(_ x: Int, _ y: Int, _ mWidth: Int, _ text: String, _ textAlignment: NSTextAlignment = .left) -> UILabel {
        // create label
        let label            = UILabel(frame: CGRect(x: x, y: y, width: mWidth, height: 21))
        label.font           = UIFont.robotoFont(ofSize: 14)
        label.textAlignment  = textAlignment
        label.textColor      = AppTheme.defaultColor
        label.text           = text
        
        return label
    }
    
    // create gray label
    public static func createGrayLabel(_ x: Int, _ y: Int, _ mWidth: Int, _ text: String) -> UILabel {
        // create label
        let label            = UILabel(frame: CGRect(x: x, y: y, width: mWidth, height: 21))
        label.font           = UIFont.robotoFont(ofSize: 11)
        label.textAlignment  = .left
        label.textColor      = UIColor(rgb: 0x76849F)
        label.text           = text
        
        return label
    }
    
    // create invoice amount label
    public static func createInvoiceLabel(_ x: Int, _ y: Int, _ mWidth: Int, _ text: String) -> UILabel {
        // create label
        let label            = UILabel(frame: CGRect(x: x, y: y, width: mWidth, height: 21))
        label.font           = UIFont.robotoBoldFont(ofSize: 13)
        label.textAlignment  = .right
        label.textColor      = UIColor(rgb: 0x3263AB)
        label.text           = text
        
        return label
    }
    
    // create label for multiple selection
    public static func createMultipleSelectionLabel(_ text: String) -> UILabel {
        // create label
        let label               = UILabel(frame: CGRect(x: 53, y: 14, width: 110, height: 21))
        label.font              = UIFont.robotoFont(ofSize: 11)
        label.backgroundColor   = UIColor(rgb: 0x53AB12)
        label.cornerRadius      = 10
        label.textAlignment     = .center
        label.textColor         = UIColor.white
        label.text              = text
        
        return label
    }
    
    public static func createBottomBorder(_ y: Int) -> UIView {
        let bottomBorder = UIView(frame: CGRect(x: 0, y: y, width: Int(Device.width), height: 5))
        bottomBorder.backgroundColor = UIColor(rgb: 0xDADADA)
        
        return bottomBorder
    }
    
    public static func createFloatyItem() -> FloatyItem {
        let item = FloatyItem()
        
        return item
    }
}

// MARK: - Validators
extension Utils {
    
    /// Ref: http://stackoverflow.com/a/25471164/425694
    func isValidEmail(_ email: String = "") -> Bool {
        let regEx = "[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,}"
        let test = NSPredicate(format:"SELF MATCHES %@", regEx)
        return test.evaluate(with: email)
    }
    
    /// Ref: http://stackoverflow.com/a/39285576/425694
    func isValidPassword(_ password: String = "") -> Bool {
        let regEx = "^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[$@$!%*?&#]*)[A-Za-z\\d$@$!%*?&#]{8,}"
        let test = NSPredicate(format:"SELF MATCHES %@", regEx)
        return test.evaluate(with: password)
    }
    
}
