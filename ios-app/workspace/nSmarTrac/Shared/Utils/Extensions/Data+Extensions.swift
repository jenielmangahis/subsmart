//
//  Data+Extensions.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 10/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

extension Data {
    var hexString: String {
        let hexString = map { String(format: "%02.2hhx", $0) }.joined()
        return hexString
    }
}
