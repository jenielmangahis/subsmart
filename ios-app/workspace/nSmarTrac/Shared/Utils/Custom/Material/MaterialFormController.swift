//
//  MaterialFormController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 04/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Material

@available(*, deprecated, message: "Use BaseMaterialFormController instead")
open class MaterialFormController: BaseFormController {
    
    open var navigableFields: [MaterialFormFieldToolbarNavigable] = []
    
    open override func viewDidLoad() {
        super.viewDidLoad()
        
        fieldVerticalSpacing = 40
        formContainerContentInsets = UIEdgeInsets(top: 24, left: 24, bottom: 24, right: 24)
    }
    
    open func applyDefaultTextFieldProperties(_ field: MaterialTextField) {
        let t = field
        t.clearButtonMode = .whileEditing
        t.font = formFont
        t.placeholderActiveColor = formActiveColor
        t.dividerActiveColor = formActiveColor
        t.autocorrectionType = .no
        t.spellCheckingType = .no
        t.isClearIconButtonEnabled = true
    }
    
    open func createGenericTextField(_ placeholder: String = "") -> MaterialTextField {
        let t = MaterialTextField()
        t.placeholder = placeholder
        applyDefaultTextFieldProperties(t)
        return t
    }
    
    open func createGenericDropdownField(_ placeholder: String = "") -> MaterialDropdownField {
        let t = MaterialDropdownField()
        t.placeholder = placeholder
        applyDefaultTextFieldProperties(t)
        return t
    }
    
    open func createGenericDatePickerField(_ placeholder: String = "") -> MaterialDatePickerField {
        let t = MaterialDatePickerField()
        t.placeholder = placeholder
        applyDefaultTextFieldProperties(t)
        return t
    }
    
    open func createGenericSecureTextField(_ placeholder: String = "") -> MaterialTextField {
        let t = createGenericTextField(placeholder)
        t.isVisibilityIconButtonEnabled = true
        t.visibilityIconButton?.tintColor = formActiveColor
        return t
    }
    
    open func refreshNavigableFields() {
        let fields = navigableFields.sorted { (prev, next) -> Bool in
            return prev.navIndex < next.navIndex
        }
        for (i, field) in fields.enumerated() {
            var fld = field
            fld.previousField = nil
            fld.nextField = nil
            if i > 0 {
                var prevField = fields[i - 1]
                fld.previousField = prevField as? UIResponder
                prevField.nextField = fld as? UIResponder
            }
        }
    }
    
}
