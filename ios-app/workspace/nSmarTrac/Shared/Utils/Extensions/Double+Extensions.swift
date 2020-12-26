//
//  Double+Extensions.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 10/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

extension Double {
    var formatCurrency: String {
        let formatter = NumberFormatter()
        formatter.numberStyle = .currency
        formatter.maximumFractionDigits = 2
        if let str = formatter.string(for: self) {
            return str
        }
        return ""
    }
    
    var intValue: Int {
        return Int(self)
    }
    
    var stringValue: String {
        return String(format:"%.2f", self)
    }
    
    func rounded(toPlaces places:Int) -> Double {
        let divisor = pow(10.0, Double(places))
        return (self * divisor).rounded() / divisor
    }
}
