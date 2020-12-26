//
//  UIColor+Extensions.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 09/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

extension UIColor {
    
    static let purple = UIColor(rgb: 0x1C0B3B)
    static let purpleLightOpaque = UIColor(rgb: 0x1C0B3B, alpha: 0.25)
    static let purpleMidOpaque = UIColor(rgb: 0x1C0B3B, alpha: 0.50)
    static let lightPurple = UIColor(rgb: 0x531B93)
    static let greenColor = UIColor(rgb: 0x4CB052)
    static let orangeColor = UIColor(rgb: 0xFF9042)
    static let redColor = UIColor(rgb: 0xFF4C4C)
    static let blueColor = UIColor(rgb: 0x2D89DC)
    static let grayColor = UIColor(rgb: 0x76849F)
    static let whiteLightOpaque = UIColor(rgb: 0xFFFFFF, alpha: 0.25)
    
    convenience init(rgb: UInt, alpha: CGFloat = 1.0) {
        self.init(
            red: CGFloat((rgb & 0xFF0000) >> 16) / 255.0,
            green: CGFloat((rgb & 0x00FF00) >> 8) / 255.0,
            blue: CGFloat(rgb & 0x0000FF) / 255.0,
            alpha: CGFloat(alpha)
        )
    }
    
    convenience init?(hex: String, alpha: CGFloat = 1.0) {
        let r, g, b: CGFloat
        
        if hex.hasPrefix("#") {
            let start = hex.index(hex.startIndex, offsetBy: 1)
            let hexColor = String(hex[start...])
            
            let rValue = String(hexColor.prefix(2))
            let bValue = String(hexColor.suffix(2))
            
            let startIndex = hexColor.index(hexColor.startIndex, offsetBy: 2)
            let endIndex = hexColor.index(hexColor.endIndex, offsetBy: -2)
            let range = startIndex..<endIndex
            let gValue = String(hexColor[range])
            
            
            if hexColor.count == 6 {
                let scanner = Scanner(string: hexColor)
                var hexNumber: UInt64 = 0
                
                if scanner.scanHexInt64(&hexNumber) {
                    r = CGFloat((Int(rValue, radix: 16)?.doubleValue)!/255)
                    g = CGFloat((Int(gValue, radix: 16)?.doubleValue)!/255)
                    b = CGFloat((Int(bValue, radix: 16)?.doubleValue)!/255)
                    
                    self.init(red: r, green: g, blue: b, alpha: alpha)
                    return
                }
            }
        }
        
        return nil
    }
}
