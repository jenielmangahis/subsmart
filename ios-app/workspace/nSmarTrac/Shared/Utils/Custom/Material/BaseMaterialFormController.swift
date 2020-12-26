//
//  BaseMaterialFormController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 04/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import RxCocoa
import RxSwift

open class BaseMaterialFormController: VerticalStackController {
    
    let formActiveColor = AppTheme.defaultColor
    let formFont = UIFont.robotoFont(ofSize: 13)
    
    // MARK: - VerticalStackController
    
    override open func stackViewSpacing() -> CGFloat {
        return 48
    }
    
    override open func stackViewInsets() -> UIEdgeInsets {
        return UIEdgeInsets(top: 40, left: 16, bottom: 32, right: 16)
    }
    
    // MARK: - Field Factory Methods
    
    //@available(*, deprecated, message: "Use MaterialTextField(placeholder: String?) instead")
    open func createTextField(_ placeholder: String?) -> MaterialTextField {
        return MaterialTextField(placeholder)
    }
    
    open func createDropdownField(_ placeholder: String?) -> MaterialDropdownField {
        return MaterialDropdownField(placeholder)
    }
    
    open func createDatePickerField(_ placeholder: String?) -> MaterialDatePickerField {
        return MaterialDatePickerField(placeholder)
    }
    
    open func createSecureTextField(_ placeholder: String?) -> MaterialTextField {
        let t = createTextField(placeholder)
        t.isVisibilityIconButtonEnabled = true
        t.visibilityIconButton?.tintColor = formActiveColor
        return t
    }
    
    // MARK: - Required Field Indicator
    
    open var requiredFieldsIndicator: UILabel?
    
    open func addRequiredFieldsIndicator() {
        let label = UILabel()
        label.text = "* Required"
        label.textColor = UIColor.lightGray
        label.font = UIFont.systemFont(ofSize: 13)
        label.autoSetDimension(.height, toSize: 24)
        addField(label)
        requiredFieldsIndicator = label
    }
    
    // MARK: Field Insertion and Removal
    
    /// Inserts the field to the bottom of the StackView.
    open func addField(_ field: UIView, required: Bool = false, navigable: Bool = false) {
        stackView.addArrangedSubview(field)
        
        if required && field is MaterialTextField {
            addRequiredField(field as! MaterialTextField)
        }
        if navigable && field is MaterialFormFieldToolbarNavigable {
            addNavigableField(field as! MaterialFormFieldToolbarNavigable)
        }
    }
    
    open func insertField(_ field: UIView, aboveField: UIView) {
        guard let index = stackView.arrangedSubviews.firstIndex(of: aboveField) else {
            return print("aboveField is not a child of the stackView")
        }
        // Ensure that the field is already in the arrangedSubviews array before moving it to a different position.
        if !stackView.arrangedSubviews.contains(field) {
            addField(field)
        }
        stackView.insertArrangedSubview(field, at: index + 1)
    }
    
    open func insertField(_ field: UIView, belowField: UIView) {
        guard let index = stackView.arrangedSubviews.firstIndex(of: belowField) else {
            return print("belowField is not a child of the stackView")
        }
        // Ensure that the field is already in the arrangedSubviews array before moving it to a different position.
        if !stackView.arrangedSubviews.contains(field) {
            addField(field)
        }
        stackView.insertArrangedSubview(field, at: index)
    }
    
    // MARK: Navigable Fields
    
    open var navigableFields: [MaterialFormFieldToolbarNavigable] = []
    
    /// Use this instead of adding the field directly to `navigableFields` prop. This has the
    /// added advantage of automatically setting the right `navIndex` value for you.
    open func addNavigableField(_ field: MaterialFormFieldToolbarNavigable) {
        var fld = field
        navigableFields.append(field)
        fld.navIndex = navigableFields.count
    }
    
    /// Call this after adding or reordering all navigable fields. What this does is set up
    /// the fields for sequential navigation (see `MaterialFormFieldToolbar`).
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
    
    // MARK: Field Validations
    
    open var requiredFields: [MaterialTextField] = []
    open var fieldValidityDetectorDisposeBag = DisposeBag()
    open var validFields: Variable<Set<MaterialTextField>> = Variable([])
    
    open func addRequiredField(_ field: MaterialTextField) {
        field.isRequired = true
        requiredFields.append(field)
    }
    
    open func refreshFieldValidityDetectors() {
        fieldValidityDetectorDisposeBag = DisposeBag()
        validFields.value.removeAll()
        
        requiredFields.forEach({ (field) in
            field.rx.text.subscribe(onNext:{ text in
                // Usually, when a field is initially empty and the user hasn't attempted to edit
                // them yet, we also want to avoid displaying validity issues.
                if field.editAttempts == 0 && field.isEmpty {
                    return
                }
                
                self.validateField(field)
            }).disposed(by: fieldValidityDetectorDisposeBag)
        })
        
        validFields
            .asObservable()
            .subscribe(onNext: { [weak self] _ in
                guard let s = self else { return }
                s.formSubmissionReadinessDidChange(s.validFields.value.count == s.requiredFields.count)
            })
            .disposed(by: fieldValidityDetectorDisposeBag)
    }
    
    open func isReadyForSubmission() -> Bool {
        validateFields()
        return validFields.value.count == requiredFields.count
    }
    
    open func formSubmissionReadinessDidChange(_ isReady: Bool) {
        //
    }
    
    open func validateField(_ field: MaterialTextField) {
        let failedValidation = { [unowned self] in
            self.validFields.value.remove(field)
            field.detail =  field.failedValidationText ?? "Required"
            field.detailColor = UIColor.red
        }
        
        if !field.isEmpty {
            if let v = field.validator, v(field.text) == false {
                failedValidation()
            } else {
                validFields.value.insert(field)
                field.detail = field.helpText ?? nil
                field.detailColor = field.placeholderNormalColor
            }
        } else {
            failedValidation()
        }
    }
    
    open func validateFields() {
        requiredFields.forEach({ (field) in
            self.validateField(field)
        })
    }
    
}
