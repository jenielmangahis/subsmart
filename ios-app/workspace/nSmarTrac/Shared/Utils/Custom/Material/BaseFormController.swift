//
//  BaseFormController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 04/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import PureLayout

@available(*, deprecated, message: "Use VerticalStackController instead")
open class BaseFormController: ScrollViewController {
    
    @IBOutlet open weak var formContainer: UIView!
    
    let formActiveColor = AppTheme.defaultColor
    let formFont = UIFont.robotoFont(ofSize: 13)
    
    open var lastFieldBottomEdgeALC: NSLayoutConstraint?
    
    open var fieldVerticalSpacing = CGFloat(0)
    open var formContainerContentInsets = UIEdgeInsets.zero
    
    /// Only call this method after calling `super.viewDidLoad`.
    open func prepareFormFields() {
        //
    }
    
    open func insertFieldsFromTopToBottom<T: UIView>(_ fields: [T]) {
        fields.forEach { insertFieldToBottom($0) }
    }
    
    open func insertFieldToBottom<T: UIView>(_ field: T) {
        
        let lastField = formContainer.subviews.last
        
        if field.superview != formContainer {
            field.removeFromSuperview()
            formContainer.addSubview(field)
        }
        
        if let lf = lastField {
            field.autoPinEdge(.top, to: .bottom, of: lf, withOffset: fieldVerticalSpacing)
            lastFieldBottomEdgeALC?.autoRemove()
        } else {
            field.autoPinEdge(toSuperviewEdge: .top, withInset: formContainerContentInsets.top)
        }
        
        field.autoPinEdge(toSuperviewEdge: .left, withInset: formContainerContentInsets.left)
        field.autoPinEdge(toSuperviewEdge: .right, withInset: formContainerContentInsets.right)
        
        lastFieldBottomEdgeALC = field.autoPinEdge(toSuperviewEdge: .bottom,
                                                   withInset: formContainerContentInsets.bottom)
        
        formContainer.setNeedsUpdateConstraints()
    }
    
}

