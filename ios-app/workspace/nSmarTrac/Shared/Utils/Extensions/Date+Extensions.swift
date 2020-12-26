//
//  Date+Extensions.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 10/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

extension Date {
    func isBetween(_ date1: Date, and date2: Date) -> Bool {
        return (min(date1, date2) ... max(date1, date2)).contains(self)
    }
    
    func currentTimeMillis() -> Int64 {
        return Int64(self.timeIntervalSince1970 * 1000)
    }
}
