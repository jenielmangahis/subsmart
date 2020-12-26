//
//  String+Extensions.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 10/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import AFDateHelper
import AnyFormatKit

extension String {
    
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
    
    var boolValue: Bool {
        return (self == "1") ? true : false
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
    
    var format5DigitNumber: String {
        return String(format: "%05d", Int(self)!)
    }
    
    var toDate: Date {
        return Date(fromString: self, format: DateHelper.dateFormatType)!
    }
    
    var toDateTime: Date {
        return Date(fromString: self, format: DateHelper.dateTimeFormatType)!
    }
    
    var toReadableDate: String {
        let date = Date(fromString: self, format: DateHelper.dateFormatType)!
        return date.toString(format: DateHelper.dateReadableFormatType)
    }
    
    var toReadableDateTime: String {
        let date = Date(fromString: self, format: DateHelper.dateTimeFormatType)!
        return date.toString(format: DateHelper.dateTimeReadableFormatType)
    }
    
    var getDay: String {
        let date = Date(fromString: self, format: DateHelper.dateFormatType)!
        return date.toString(format: DateFormatType.custom("EEEE"))
    }
    
    var unformatContactNumber: String? {
        let formatter = DefaultTextInputFormatter(textPattern: "(###) ###-####")
        return formatter.unformat(self)
    }
}
