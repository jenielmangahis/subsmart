//
//  Customer.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 07/07/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import AlamofireJsonToObjects

class CustomerResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [Customer] = []
}

class Customer: EVNetworkingObject {
    var id: String = ""
    var customer_type: String = ""
    var company_name: String = ""
    var contact_name: String = ""
    var contact_email: String = ""
    var mobile: String = ""
    var phone: String = ""
    var notify_email: Bool = false
    var notify_sms: Bool = false
    var birthday: String = ""
    var customer_group: String = ""
    var comments: String = ""
    var status: String = ""
    var contact_id: String = ""
    var source_id: String = ""
    var company_id: String = ""
    var address: [Address] = []
    var contacts: [Contact] = []
    var events: [Event] = []
    var work_orders: [WorkOrder] = []
    var estimates: [Estimate] = []
    var invoices: [Invoice] = []
}

class CustomerGroupResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [CustomerGroup] = []
}

class CustomerGroup: EVNetworkingObject {
    var id: String = ""
    var name: String = ""
    var decription: String = ""
    var company_id: String = ""
}

class CustomerSourceResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [CustomerSource] = []
}

class CustomerSource: EVNetworkingObject {
    var id: String = ""
    var name: String = ""
    var company_id: String = ""
}
