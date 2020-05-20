//
//  MaterialTextField.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 04/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Material
import RxSwift
import RxCocoa

open class MaterialTextField: TextField, MaterialFormFieldToolbarNavigable {
    
    fileprivate var formActiveColor = AppTheme.defaultColor
    fileprivate var formFont = UIFont.robotoFont(ofSize: 13)
    
    open var editAttempts: Int = 0
    open var helpText: String? {
        didSet {
            detail = helpText
        }
    }
    
    public init(_ placeholder: String? = nil) {
        super.init(frame: .zero)
        self.placeholder = placeholder
        
        // TODO Should be called in `prepare()`.
        self.applyBaseConfiguration()
    }
    
    required public init?(coder aDecoder: NSCoder) {
        super.init(coder: aDecoder)
    }
    
    open override func prepare() {
        addTarget(self, action: #selector(editingDidBeginHandler), for: .editingDidBegin)
        addTarget(self, action: #selector(editingDidEndHandler), for: .editingDidEnd)
        
        super.prepare()
        
        configure()
        configureToolbar()
    }
    
    /// TODO Call this in `prepare` method once `MaterialFormController` is finally removed.
    open func applyBaseConfiguration() {
        clearButtonMode = .whileEditing
        font = formFont
        textColor = UIColor.black
        placeholderActiveColor = formActiveColor
        dividerActiveColor = formActiveColor
        autocorrectionType = .no
        spellCheckingType = .no
        isClearIconButtonEnabled = true
        
        if Utils.isOSAtLeast11 {
            placeholderVerticalOffset = 8
        }
    }
    
    @objc open func editingDidBeginHandler() {
        UIView.setAnimationsEnabled(false)
        Utils.delay(0.5) {
            UIView.setAnimationsEnabled(true)
        }
    }
    
    @objc open func editingDidEndHandler() {
        editAttempts += 1
        
        guard isEmpty else {
            UIView.setAnimationsEnabled(false)
            Utils.delay(0.5) {
                UIView.setAnimationsEnabled(true)
            }
            return
        }
    }
    
    open override func becomeFirstResponder() -> Bool {
        updateToolbarNavigationButtons()
        return super.becomeFirstResponder()
    }
    
    // MARK: Validity
    
    open var isRequired = false
    
    /// Used to validate the `text` value. Only called when `isRequired` is set to True.
    open var validator: ((String?) -> Bool)?
    
    open var failedValidationText: String?
    
    // MARK: MaterialFormFieldToolbarNavigable
    
    public var navIndex: Int = 0
    public var toolbar: MaterialFormFieldToolbar =
        MaterialFormFieldToolbar(frame: CGRect(origin: .zero, size: CGSize(width: 320, height: 44)))
    public weak var previousField: UIResponder?
    public weak var nextField: UIResponder?
    
    open func configureToolbar() {
        toolbar.doneButtonTapHandler = { [weak self] button in
            guard let slf = self else { return }
            if slf.isFirstResponder {
                slf.resignFirstResponder()
            }
        }
        toolbar.prevButtonTapHandler = { [weak self] button in
            guard let slf = self else { return }
            _ = slf.previousField?.becomeFirstResponder()
        }
        toolbar.nextButtonTapHandler = { [weak self] button in
            guard let slf = self else { return }
            _ = slf.nextField?.becomeFirstResponder()
        }
        inputAccessoryView = toolbar
    }
    
    open func updateToolbarNavigationButtons() {
        toolbar.prevButton.isEnabled = previousField != nil
        toolbar.nextButton.isEnabled = nextField != nil
    }
    
    // MARK: Switchable Standard Edit Actions
    
    @IBInspectable var isPasteEnabled: Bool = true
    @IBInspectable var isSelectEnabled: Bool = true
    @IBInspectable var isSelectAllEnabled: Bool = true
    @IBInspectable var isCopyEnabled: Bool = true
    @IBInspectable var isCutEnabled: Bool = true
    @IBInspectable var isDeleteEnabled: Bool = true
    
    open override func target(forAction action: Selector, withSender sender: Any?) -> Any? {
        if #available(iOS 10, *) {
            switch action {
            case #selector(UIResponderStandardEditActions.paste(_:)) where isPasteEnabled,
                 #selector(UIResponderStandardEditActions.select(_:)) where isSelectEnabled,
                 #selector(UIResponderStandardEditActions.selectAll(_:)) where isSelectAllEnabled,
                 #selector(UIResponderStandardEditActions.copy(_:)) where isCopyEnabled,
                 #selector(UIResponderStandardEditActions.cut(_:)) where isCutEnabled,
                 #selector(UIResponderStandardEditActions.delete(_:)) where isDeleteEnabled:
                // no-op
                break
            default:
                return nil
            }
        } else {
            switch action {
            case #selector(paste(_:)) where isPasteEnabled,
                 #selector(select(_:)) where isSelectEnabled,
                 #selector(selectAll(_:)) where isSelectAllEnabled,
                 #selector(copy(_:)) where isCopyEnabled,
                 #selector(cut(_:)) where isCutEnabled,
                 #selector(delete(_:)) where isDeleteEnabled:
                break
            default:
                return nil
            }
        }
        
        return super.target(forAction: action, withSender: sender)
    }
    
}





// MARK: - OS
extension Utils {
    
    static var isOSAtLeast11: Bool {
        return isOSAtLeastVersion(OperatingSystemVersion(majorVersion: 11, minorVersion: 0, patchVersion: 0))
    }
    
    static var isOSAtLeast10: Bool {
        return isOSAtLeastVersion(OperatingSystemVersion(majorVersion: 10, minorVersion: 0, patchVersion: 0))
    }
    
    static func isOSAtLeastVersion(_ version: OperatingSystemVersion) -> Bool {
        return ProcessInfo.processInfo.isOperatingSystemAtLeast(version)
    }
    
}

// MARK: - Threading
extension Utils {
    
    /// Performs an intensive process in the background, then calls the specified completion
    /// block, if provided, on the main thread.
    ///
    /// Ref: http://stackoverflow.com/a/39082295/425694
    public static func performInBackground(_ work: @escaping () -> Void, completion: (() -> Void)? = nil) {
        DispatchQueue.global(qos: .background).async {
            work()
            DispatchQueue.main.async {
                if let block = completion {
                    block()
                }
            }
        }
    }
    
    /// Ref: http://stackoverflow.com/a/24318861/425694
    /// Ref: http://stackoverflow.com/a/27462144/425694
    public static func delay(_ delay: Double, task: @escaping () -> ()) {
        DispatchQueue.main.asyncAfter(
            deadline: DispatchTime.now() +
                Double(Int64(delay * Double(NSEC_PER_SEC))) / Double(NSEC_PER_SEC), execute: task)
    }
    
}

// MARK: - Custom Configurations
extension TextField {
    
    func configure() {
        let formActiveColor = AppTheme.defaultColor
        let formFont = UIFont.robotoFont(ofSize: 13)
        
        self.isClearIconButtonEnabled = true
        self.clearIconButton?.tintColor = formActiveColor
        self.autocorrectionType = .no
        self.spellCheckingType = .no
        self.font = formFont
        self.placeholderActiveColor = formActiveColor
        self.placeholderVerticalOffset = 8
        self.dividerActiveColor = formActiveColor
        self.autocapitalizationType = .none
        
        // add background color
        self.backgroundColor                    = self.isEnabled ? .clear : UIColor(rgb: 0xE1E1E1)
        //self.placeholderLabel.backgroundColor   = self.isEnabled ? .clear : UIColor(rgb: 0xE1E1E1)
    }
}
