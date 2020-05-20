//
//  VerticalStackController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 04/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import PureLayout

open class VerticalStackController: ScrollViewController {
    
    @IBOutlet open var stackView: UIStackView! = UIStackView()
    
    /// TODO Move this to ScrollViewController
    @IBOutlet open var contentView: UIView! = UIView()
    
    override open func viewDidLoad() {
        super.viewDidLoad()
        
        print("Overriding initial VerticalStackController.stackView properties.")
        stackView.axis = .vertical
        stackView.alignment = .fill
        stackView.distribution = .fill
        stackView.spacing = stackViewSpacing()
        stackView.setContentHuggingPriority(UILayoutPriority(rawValue: Float(250)), for: .horizontal)
        
        if stackView.superview == nil {
            contentView.addSubview(stackView)
            let insets = stackViewInsets()
            stackView.autoPinEdgesToSuperviewEdges(with: insets, excludingEdge: .bottom)
            stackView.autoPinEdge(toSuperviewEdge: .bottom, withInset: insets.bottom, relation: .greaterThanOrEqual)
        } else {
            print("VerticalStackController.stackView is already attached to a superview. Skipped adding NSLayoutConstraints.")
        }
        
        if contentView.superview == nil {
            scrollView.insertSubview(contentView, at: 0)
            contentView.autoPinEdgesToSuperviewEdges()
            contentView.autoMatch(.width, to: .width, of: view)
        }
    }
    
    open func stackViewInsets() -> UIEdgeInsets {
        return UIEdgeInsets(top: 16, left: 16, bottom: 16, right: 16)
    }
    
    open func stackViewSpacing() -> CGFloat {
        return 16
    }
    
}
