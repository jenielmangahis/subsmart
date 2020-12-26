//
//  Payments.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 14/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import AlamofireJsonToObjects

class PaymentResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [Payment] = []
}

class Payment: EVNetworkingObject {
    var id: String = ""
    var invoice_id: String = ""
    var amount: String = ""
    var payment_date: String = ""
    var payment_method: String = ""
    var company_id: String = ""
}
