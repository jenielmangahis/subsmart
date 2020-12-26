//
//  TaxRate.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 11/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import AlamofireJsonToObjects

class TaxRateResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [TaxRate] = []
}

class TaxRate: EVNetworkingObject {
    var id: String = ""
    var name: String = ""
    var rate: String = ""
    var is_default: Bool = false
    var company_id: String = ""
}
