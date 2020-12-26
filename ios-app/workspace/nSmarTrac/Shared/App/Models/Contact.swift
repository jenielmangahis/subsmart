//
//  Contact.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 08/07/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import AlamofireJsonToObjects

class ContactResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [Contact] = []
}

class Contact: EVNetworkingObject {
    var id: String = ""
    var name: String = ""
    var email: String = ""
    var phone: String = ""
    var mobile: String = ""
    var notes: String = ""
    var customer_id: String = ""
    var company_id: String = ""
}
