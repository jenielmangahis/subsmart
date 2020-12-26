//
//  DLRadioButton+Extensions.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 04/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import DLRadioButton
import FontAwesome_swift

extension DLRadioButton {
    
    func configure(_ selected: Bool = false) {
        self.setTitleColor((App.shared.appearance == "Dark") ? UIColor.white : UIColor.black, for: .normal)
        self.setTitleColor((App.shared.appearance == "Dark") ? UIColor.white : UIColor.black, for: .selected)
        self.icon = UIImage.fontAwesomeIcon(name: .square, style: .regular, textColor: .lightGray, size: CGSize(width: 24, height: 24))
        self.iconSelected = UIImage.fontAwesomeIcon(name: .checkSquare, style: .solid, textColor: .greenColor, size: CGSize(width: 24, height: 24))
        self.isMultipleSelectionEnabled = true
        self.isSelected = selected
        self.contentHorizontalAlignment = .left
        self.titleLabel?.font = UIFont.robotoFont(ofSize: 13)
        self.titleLabel?.lineBreakMode = .byWordWrapping
        self.titleLabel?.textAlignment = .left
        self.setBackgroundColor(UIColor.clear, for: .normal)
        self.setBackgroundColor(UIColor.clear, for: .selected)
    }
    
    func configureRTL(_ selected: Bool = false) {
        self.setTitleColor((App.shared.appearance == "Dark") ? UIColor.white : UIColor.black, for: .normal)
        self.setTitleColor((App.shared.appearance == "Dark") ? UIColor.white : UIColor.black, for: .selected)
        self.iconSelected = UIImage(named: "ic_event_default_check")!
        self.iconColor = .lightGray
        self.iconSize = 24
        self.isIconSquare = false
        self.iconStrokeWidth = 2
        self.isIconOnRight = true
        self.isMultipleSelectionEnabled = true
        self.isSelected = selected
        self.contentHorizontalAlignment = .left
        self.titleLabel?.font = UIFont.robotoFont(ofSize: 13)
        self.titleLabel?.adjustsFontSizeToFitWidth = true
        self.titleLabel?.lineBreakMode = .byClipping
        self.titleLabel?.textAlignment = .left
        self.setBackgroundColor(UIColor.clear, for: .normal)
    }
    
    func configureRadio(_ selected: Bool = false) {
        self.setTitleColor((App.shared.appearance == "Dark") ? UIColor.white : UIColor.black, for: .normal)
        self.setTitleColor((App.shared.appearance == "Dark") ? UIColor.white : UIColor.black, for: .selected)
        self.iconColor = UIColor.greenColor
        self.iconSize = 24
        self.indicatorColor = UIColor.greenColor
        self.indicatorSize = 12
        self.isIconSquare = false
        self.iconStrokeWidth = 2
        self.isMultipleSelectionEnabled = false
        self.isSelected = selected
        self.contentHorizontalAlignment = .left
        self.titleLabel?.font = UIFont.robotoFont(ofSize: 13)
        self.titleLabel?.adjustsFontSizeToFitWidth = true
        self.titleLabel?.lineBreakMode = .byClipping
        self.titleLabel?.textAlignment = .left
        self.setBackgroundColor(UIColor.clear, for: .normal)
    }
}
