//
//  MaterialFormFieldToolbar.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 04/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Foundation

public protocol MaterialFormFieldToolbarNavigable {
    
    var toolbar: MaterialFormFieldToolbar { get set }
    var navIndex: Int { get set }
    var previousField: UIResponder? { get set }
    var nextField: UIResponder? { get set }
    
}

open class MaterialFormFieldToolbar: UIToolbar {
    
    open var prevButton: UIBarButtonItem!
    open var nextButton: UIBarButtonItem!
    open var doneButton: UIBarButtonItem!
    
    open var prevButtonTapHandler: ((UIBarButtonItem) -> Void)?
    open var nextButtonTapHandler: ((UIBarButtonItem) -> Void)?
    open var doneButtonTapHandler: ((UIBarButtonItem) -> Void)?
    
    public override init(frame: CGRect) {
        super.init(frame: frame)
        prepare()
    }
    
    public required init?(coder aDecoder: NSCoder) {
        super.init(coder: aDecoder)
        prepare()
    }
    
    open func prepare() {
        barStyle = .default
        tintColor = App.shared.iconColor
        
        prevButton = UIBarButtonItem(title: "Previous", style: .plain, target: self, action: #selector(onPrevButtonTapped(_:)))
        nextButton = UIBarButtonItem(title: "Next", style: .plain, target: self, action: #selector(onNextButtonTapped(_:)))
        
        let flexibleSpace = UIBarButtonItem(barButtonSystemItem: .flexibleSpace, target: nil, action: nil)
        
        doneButton = UIBarButtonItem(title: "Done", style: .done, target: self, action: #selector(onDoneButtonTapped(_:)))
        
        //items = [prevButton, nextButton, flexibleSpace, doneButton]
        items = [flexibleSpace, doneButton]
    }
    
    @objc private func onPrevButtonTapped(_ sender: UIBarButtonItem) {
        if let h = prevButtonTapHandler {
            h(sender)
        }
    }
    
    @objc private func onNextButtonTapped(_ sender: UIBarButtonItem) {
        if let h = nextButtonTapHandler {
            h(sender)
        }
    }
    
    @objc private func onDoneButtonTapped(_ sender: UIBarButtonItem) {
        if let h = doneButtonTapHandler {
            h(sender)
        }
    }
    
}
