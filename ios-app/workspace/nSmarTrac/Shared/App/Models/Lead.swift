//
//  Lead.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 08/07/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import AlamofireJsonToObjects

class LeadResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [Lead] = []
}

class Lead: EVNetworkingObject {
    var id: String = ""
    var customer_type: String = ""
    var company_name: String = ""
    var contact_name: String = ""
    var contact_email: String = ""
    var phone: String = ""
    var street_address: String = ""
    var suite_unit: String = ""
    var city: String = ""
    var postal_code: String = ""
    var state: String = ""
    var source: String = ""
    var comments: String = ""
    var notify_email: Bool = false
    var notify_sms: Bool = false
    var type: String = ""
    var status: String = ""
    var date_created: String = ""
    var company_id: String = ""
}
