//
//  Extensions.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 04/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit


extension UIColor {
    
    static let purple = UIColor(rgb: 0x1C0B3B)
    static let purpleLightOpaque = UIColor(hex: "#1C0B3B", alpha: 0.25)
    static let purpleMidOpaque = UIColor(hex: "#1C0B3B", alpha: 0.50)
    static let lightPurple = UIColor(rgb: 0x531B93)
    
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

extension Dictionary {
    var stringValue: String {
        let data = try! JSONSerialization.data(withJSONObject: self, options: [])
        return String(data: data, encoding: String.Encoding.utf8)!
    }
    
}

extension Data {
    var hexString: String {
        let hexString = map { String(format: "%02.2hhx", $0) }.joined()
        return hexString
    }
}

extension String {
    var isInt: Bool {
        return Int(self) != nil
    }
    
    var dictionaryValue: [String: Any]? {
        if let data = self.data(using: .utf8) {
            do {
                return try JSONSerialization.jsonObject(with: data, options: []) as? [String:AnyObject]
            } catch let error as NSError {
                print(error)
            }
        }
        return nil
    }
    
    var intValue: Int {
        return Int(self)!
    }
    
    var doubleValue: Double {
        return Double(self)!
    }
    
    var floatValue: Float {
        return Float(self)!
    }
}

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

extension Bool {
    var intValue: Int {
        return self ? 1 : 0
    }
}

extension Float {
    var intValue: Int {
        return Int(self)
    }
}

extension Date {
    func isBetween(_ date1: Date, and date2: Date) -> Bool {
        return (min(date1, date2) ... max(date1, date2)).contains(self)
    }
    
    func currentTimeMillis() -> Int64 {
        return Int64(self.timeIntervalSince1970 * 1000)
    }
}

extension Sequence {
    func group<U: Hashable>(by key: (Iterator.Element) -> U) -> [U:[Iterator.Element]] {
        var categories: [U: [Iterator.Element]] = [:]
        for element in self {
            let key = key(element)
            if case nil = categories[key]?.append(element) {
                categories[key] = [element]
            }
        }
        return categories
    }
}

extension Sequence where Element: Equatable {
    var uniqueElements: [Element] {
        return self.reduce(into: []) {
            uniqueElements, element in
            
            if !uniqueElements.contains(element) {
                uniqueElements.append(element)
            }
        }
    }
}

extension UIButton {
    // https://stackoverflow.com/questions/14523348/how-to-change-the-background-color-of-a-uibutton-while-its-highlighted
    private func image(withColor color: UIColor) -> UIImage? {
        let rect = CGRect(x: 0.0, y: 0.0, width: 1.0, height: 1.0)
        UIGraphicsBeginImageContext(rect.size)
        let context = UIGraphicsGetCurrentContext()
        
        context?.setFillColor(color.cgColor)
        context?.fill(rect)
        
        let image = UIGraphicsGetImageFromCurrentImageContext()
        UIGraphicsEndImageContext()
        
        return image
    }
    
    func setBackgroundColor(_ color: UIColor, for state: UIControl.State) {
        self.setBackgroundImage(image(withColor: color), for: state)
    }
}

extension UIToolbar {
    
    private func image(withColor color: UIColor) -> UIImage? {
        let rect = CGRect(x: 0.0, y: 0.0, width: 1.0, height: 1.0)
        UIGraphicsBeginImageContext(rect.size)
        let context = UIGraphicsGetCurrentContext()
        
        context?.setFillColor(color.cgColor)
        context?.fill(rect)
        
        let image = UIGraphicsGetImageFromCurrentImageContext()
        UIGraphicsEndImageContext()
        
        return image
    }
    
    func setBackgroundColor(_ color: UIColor, position: UIBarPosition) {
        self.setBackgroundImage(image(withColor: color), forToolbarPosition: position, barMetrics: .default)
    }
}
