//
//  Vendor.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 07/07/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import AlamofireJsonToObjects

class VendorResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [Vendor] = []
}

class Vendor: EVNetworkingObject {
    var vendor_id: String = ""
    var vendor_name: String = ""
    var status: String = ""
    var business_url: String = ""
    var email: String = ""
    var mobile: String = ""
    var phone: String = ""
    var street_address: String = ""
    var suite_unit: String = ""
    var city: String = ""
    var postal_code: String = ""
    var state: String = ""
    var company_id: String = ""
}
