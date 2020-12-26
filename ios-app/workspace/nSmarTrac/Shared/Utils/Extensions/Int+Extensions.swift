//
//  Int+Extensions.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 10/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

extension Int {
    var boolValue: Bool {
        return self != 0
    }
    
    var doubleValue: Double {
        return Double(self)
    }
    
    var floatValue: Float {
        return Float(self)
    }
    
    var stringValue: String {
        return "\(self)"
    }
}
