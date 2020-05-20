//
//  MaterialDropdownField.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 04/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Material

open class MaterialDropdownField: MaterialTextField {
    
    open var pickerView: UIPickerView!
    
    public fileprivate(set) var options: [String] = []
    
    override open func prepare() {
        super.prepare()
        
        isClearIconButtonEnabled = true
        rightViewMode = .always
        rightView?.isUserInteractionEnabled = false
        clearIconButton?.setImage(UIImage(named: "ic-arrow-down"), for: .normal)
        isCutEnabled = false
        isPasteEnabled = false
        configure()
        
        let picker = UIPickerView()
        picker.dataSource = self
        picker.delegate = self
        
        self.inputView = picker
        pickerView = picker
        
        let shim = UIView()
        shim.addGestureRecognizer(UITapGestureRecognizer(target: self, action: #selector(selfTapped)))
        addSubview(shim)
        shim.autoPinEdgesToSuperviewEdges()
    }
    
    // We don't really need a cursor here.
    override open func caretRect(for position: UITextPosition) -> CGRect {
        return CGRect.zero
    }
    
    open func updateOptions(options: [String]) {
        self.options = options
        pickerView.reloadAllComponents()
    }
    
    open func setSelectedOption(option: String?) {
        guard let o = option else { return }
        if let index = options.firstIndex(of: o) {
            pickerView.selectRow(index, inComponent: 0, animated: false)
            text = o
        }
    }
    
    @objc func selfTapped() {
        debugPrint("tapped")
        _ = self.becomeFirstResponder()
    }
    
}

extension MaterialDropdownField: UIPickerViewDataSource {
    
    open func numberOfComponents(in pickerView: UIPickerView) -> Int {
        return 1
    }
    
    open func pickerView(_ pickerView: UIPickerView, numberOfRowsInComponent component: Int) -> Int {
        return options.count
    }
    
}

extension MaterialDropdownField: UIPickerViewDelegate {
    
    open func pickerView(_ pickerView: UIPickerView,
                         titleForRow row: Int,
                         forComponent component: Int) -> String? {
        return options[row]
    }
    
    open func pickerView(_ pickerView: UIPickerView, didSelectRow row: Int, inComponent component: Int) {
        self.text = options[row]
    }
    
}
