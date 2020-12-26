//
//  CustomView.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 01/11/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class CustomView: UIView {
    
    // MARK: - Properties -
    
    @IBOutlet var totalHoursLabel: UILabel!
    @IBOutlet var regularHoursLabel: UILabel!
    @IBOutlet var overtimeLabel: UILabel!
    @IBOutlet var breakTimeLabel: UILabel!
    @IBOutlet var ptoLabel: UILabel!
    @IBOutlet var sendReportButton: UIButton!
    

    // MARK: - Lifecycle -
    
    required public init?(coder aDecoder: NSCoder) {
        super.init(coder: aDecoder)
    }
    
    override init(frame: CGRect) {
        super.init(frame: frame)
    }
    
    // MARK: - UIView -
    
    func loadView() -> UIView {
        let bundleName = Bundle(for: type(of: self))
        let nibName = String(describing: type(of: self))
        let nib = UINib(nibName: nibName, bundle: bundleName)
        let view = nib.instantiate(withOwner: nil, options: nil).first as! UIView
        //view.translatesAutoresizingMaskIntoConstraints = false
        return view
    }
    
}
