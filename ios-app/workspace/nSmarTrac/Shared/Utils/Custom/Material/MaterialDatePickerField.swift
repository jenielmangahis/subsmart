//
//  MaterialDatePickerField.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 04/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import AFDateHelper
import PureLayout
import Material

open class MaterialDatePickerField: MaterialTextField {
    
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
            text = picker.date.toString(dateStyle: .long, timeStyle: .none)
            break
        case .dateAndTime:
            text = picker.date.toString(dateStyle: .long, timeStyle: .short)
            break
        case .time:
            text = picker.date.toString(dateStyle: .none, timeStyle: .short)
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
        
        // Set current date as default.
        date = Date()
        
        // Set this picker as this field's inputView.
        inputView = picker
        
        isClearIconButtonEnabled = true
        rightViewMode = .always
        rightView?.isUserInteractionEnabled = false
        clearIconButton?.setImage(UIImage(named: "ic-calendar-grey"), for: .normal)
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
        debugPrint("tapped")
        _ = self.becomeFirstResponder()
    }
    
}
