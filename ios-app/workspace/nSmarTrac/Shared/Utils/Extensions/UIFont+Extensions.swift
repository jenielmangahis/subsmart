//
//  UIFont+Extensions.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 04/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

@available(iOS 4.3 ,watchOS 8.0 ,tvOS 9.0, *)
public extension UIFont {
    
    enum appleSDGothicNeo: String {
        case thin = "AppleSDGothicNeo-Thin"
        case light = "AppleSDGothicNeo-Light"
        case regular = "AppleSDGothicNeo-Regular"
        case medium = "AppleSDGothicNeo-Medium"
        case semiBold = "AppleSDGothicNeo-SemiBold"
        case bold = "AppleSDGothicNeo-Bold"
        
        public func font(size: CGFloat) -> UIFont {
            return UIFont(name: self.rawValue, size: size)!
        }
    }
    
    enum lato: String {
        case bold = "Lato-Bold"
        case regular = "Lato-Regular"
        
        public func font(size: CGFloat) -> UIFont {
            return UIFont(name: self.rawValue, size: size)!
        }
    }
    
    enum muli: String {
        case bold = "Muli-Bold"
        case regular = "Muli-Regular"
        
        public func font(size: CGFloat) -> UIFont {
            return UIFont(name: self.rawValue, size: size)!
        }
    }
    
    enum roboto: String {
       case Regular = "Roboto-Regular"
       case Medium = "Roboto-Medium"
       case Bold = "Roboto-Bold"
       
       public func font(size: CGFloat) -> UIFont {
           return UIFont(name: self.rawValue, size: size)!
       }
    }
}

extension UIFontDescriptor.AttributeName {
    static let nsctFontUIUsage = UIFontDescriptor.AttributeName(rawValue: "NSCTFontUIUsageAttribute")
}

extension UIFont {
    
    @objc class func latoFont(ofSize size: CGFloat) -> UIFont {
        return UIFont(name: UIFont.lato.regular.rawValue, size: size)!
    }
    
    @objc class func latoBoldFont(ofSize size: CGFloat) -> UIFont {
        return UIFont(name: UIFont.lato.bold.rawValue, size: size)!
    }
    
    @objc class func muliFont(ofSize size: CGFloat) -> UIFont {
        return UIFont(name: UIFont.muli.regular.rawValue, size: size)!
    }
    
    @objc class func muliBoldFont(ofSize size: CGFloat) -> UIFont {
        return UIFont(name: UIFont.muli.bold.rawValue, size: size)!
    }
    
    @objc class func robotoFont(ofSize size: CGFloat) -> UIFont {
        return UIFont(name: UIFont.roboto.Regular.rawValue, size: size)!
    }
    
    @objc class func robotoMediumFont(ofSize size: CGFloat) -> UIFont {
        return UIFont(name: UIFont.roboto.Medium.rawValue, size: size)!
    }
    
    @objc class func robotoBoldFont(ofSize size: CGFloat) -> UIFont {
        return UIFont(name: UIFont.roboto.Bold.rawValue, size: size)!
    }
    
    @objc class func mySystemFont(ofSize size: CGFloat) -> UIFont {
        return UIFont(name: UIFont.appleSDGothicNeo.medium.rawValue, size: size)!
    }
    
    @objc class func myBoldSystemFont(ofSize size: CGFloat) -> UIFont {
        return UIFont(name: UIFont.appleSDGothicNeo.bold.rawValue, size: size)!
    }
    
    @objc convenience init(myCoder aDecoder: NSCoder) {
        guard
            let fontDescriptor = aDecoder.decodeObject(forKey: "UIFontDescriptor") as? UIFontDescriptor,
            let fontAttribute = fontDescriptor.fontAttributes[.nsctFontUIUsage] as? String else {
                self.init(myCoder: aDecoder)
                return
        }
        var fontName = ""
        switch fontAttribute {
        case "CTFontRegularUsage":
            fontName = UIFont.appleSDGothicNeo.medium.rawValue
        case "CTFontEmphasizedUsage", "CTFontBoldUsage":
            fontName = UIFont.appleSDGothicNeo.bold.rawValue
        default:
            fontName = UIFont.appleSDGothicNeo.medium.rawValue
        }
        self.init(name: fontName, size: fontDescriptor.pointSize)!
    }
    
    class func overrideInitialize() {
        guard self == UIFont.self else { return }
        
        if let systemFontMethod = class_getClassMethod(self, #selector(systemFont(ofSize:))),
            let mySystemFontMethod = class_getClassMethod(self, #selector(mySystemFont(ofSize:))) {
            method_exchangeImplementations(systemFontMethod, mySystemFontMethod)
        }
        
        if let boldSystemFontMethod = class_getClassMethod(self, #selector(boldSystemFont(ofSize:))),
            let myBoldSystemFontMethod = class_getClassMethod(self, #selector(myBoldSystemFont(ofSize:))) {
            method_exchangeImplementations(boldSystemFontMethod, myBoldSystemFontMethod)
        }
        
        if let initCoderMethod = class_getInstanceMethod(self, #selector(UIFontDescriptor.init(coder:))), // Trick to get over the lack of UIFont.init(coder:))
            let myInitCoderMethod = class_getInstanceMethod(self, #selector(UIFont.init(myCoder:))) {
            method_exchangeImplementations(initCoderMethod, myInitCoderMethod)
        }
    }
}
