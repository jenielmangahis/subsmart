//
//  MaterialDatePickerField.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 04/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import AFDateHelper
import FontAwesome_swift
import PureLayout
import Material

open class MaterialDatePickerField: MaterialTextField {
    
    var dateFormatter: DateFormatter = {
        let formatter = DateFormatter()
        formatter.dateFormat = "MM-dd-yyyy"
        return formatter
    }()
    
    var dateTimeFormatter: DateFormatter = {
        let formatter = DateFormatter()
        formatter.dateFormat = "MM-dd-yyyy hh:mm a"
        return formatter
    }()
    
    var timeFormatter: DateFormatter = {
        let formatter = DateFormatter()
        formatter.dateFormat = "hh:mm a"
        return formatter
    }()
    
    open var picker: UIDatePicker!
    
    open var datePickerMode: UIDatePicker.Mode {
        get {
            return picker.datePickerMode
        }
        set {
            picker.datePickerMode = newValue
            refreshTextValue()
        }
    }
    
    open var date: Date {
        get {
            return picker.date
        }
        set {
            picker.date = newValue
            refreshTextValue()
        }
    }
    
    open var minimumDate: Date? {
        get {
            return picker.minimumDate
        }
        set {
            picker.minimumDate = newValue
        }
    }
    
    open var maximumDate: Date? {
        get {
            return picker.maximumDate
        }
        set {
            picker.maximumDate = newValue
        }
    }
    
    open func refreshTextValue() {
        switch datePickerMode {
        case .date:
            text = dateFormatter.string(from: picker.date) //picker.date.toString(dateStyle: .long, timeStyle: .none)
            break
        case .dateAndTime:
            text = dateTimeFormatter.string(from: picker.date) //picker.date.toString(dateStyle: .long, timeStyle: .short)
            break
        case .time:
            text = timeFormatter.string(from: picker.date) //picker.date.toString(dateStyle: .none, timeStyle: .short)
            break
        case .countDownTimer:
            text = picker.date.toString(format: .custom("HH:mm:ss"))
            break
        }
    }
    
    override open func prepare() {
        super.prepare()
        
        picker = UIDatePicker()
        picker.datePickerMode = .date
        picker.addTarget(self, action: #selector(datePickerValueChanged(_:)), for: .valueChanged)
        
        if #available(iOS 13.4, *) {
            picker.preferredDatePickerStyle = .wheels
        }
        
        // Set current date as default.
        date = Date()
        
        // Set this picker as this field's inputView.
        inputView = picker
        
        isClearIconButtonEnabled = true
        rightViewMode = .always
        rightView?.isUserInteractionEnabled = false
        clearIconButton?.setImage(UIImage.fontAwesomeIcon(name: .calendarAlt, style: .regular, textColor: .lightGray, size: CGSize(width: 24, height: 24)), for: .normal)
        isCutEnabled = false
        isPasteEnabled = false
        configure()
        
        let shim = UIView()
        shim.addGestureRecognizer(UITapGestureRecognizer(target: self, action: #selector(selfTapped)))
        addSubview(shim)
        shim.autoPinEdgesToSuperviewEdges()
    }
    
    @objc open func datePickerValueChanged(_ picker: UIDatePicker) {
        refreshTextValue()
    }
    
    open func setDate(_ date: Date, animated: Bool) {
        picker.setDate(date, animated: animated)
    }
    
    // We don't really need a cursor here.
    override open func caretRect(for position: UITextPosition) -> CGRect {
        return CGRect.zero
    }
    
    @objc func selfTapped() {
        _ = self.becomeFirstResponder()
    }
    
}

// MARK: - Custom Configurations -

extension MaterialDatePickerField {
    
    func reconfigure(_ toolbar: UIToolbar) {
        
        let formActiveColor = (App.shared.appearance == "Dark") ? UIColor.white : UIColor.black
        let formNormalColor = (App.shared.appearance == "Dark") ? UIColor.lightText : UIColor.darkText
        let formFont = UIFont.robotoFont(ofSize: 13)
        
        self.isClearIconButtonEnabled = true
        self.clearIconButton?.tintColor = formActiveColor
        self.autocorrectionType = .no
        self.spellCheckingType = .no
        self.font = formFont
        self.placeholderNormalColor = formNormalColor
        self.placeholderActiveColor = formActiveColor
        self.placeholderVerticalOffset = 8
        self.dividerActiveColor = .clear
        self.dividerNormalColor = .clear
        self.rightView = nil
        self.autocapitalizationType = .none
        self.textColor = (App.shared.appearance == "Dark") ? UIColor.white : UIColor.black
        
        if let date = App.shared.timeFormatter.date(from: "12:00 AM") {
            self.date = date
        }
        
        self.isEnabled          = false
        self.datePickerMode     = .time
        self.inputAccessoryView = toolbar
    }
}
