//
//  Estimate.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 12/07/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import AlamofireJsonToObjects

class EstimateResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [Estimate] = []
}

class Estimate: EVNetworkingObject {
    var id: String = ""
    var estimate_number: String = ""
    var estimate_type: String = ""
    var customer_id: String = ""
    var customer_name: String = ""
    var customer_email: String = ""
    var customer_phone: String = ""
    var customer_mobile: String = ""
    var customer_address: String = ""
    var job_id: String = ""
    var job_location: String = ""
    var job_name: String = ""
    var job_description: String = ""
    var estimate_date: String = ""
    var expiry_date: String = ""
    var purchase_order_number: String = ""
    var deposit_request: String = ""
    var estimate_value: String = ""
    var status: String = ""
    var is_accepted: String = ""
    var accepted_date: String = ""
    var is_seen: String = ""
    var seen_date: String = ""
    var is_invoiced: String = ""
    var invoiced_date: String = ""
    var customer_message: String = ""
    var terms_conditions: String = ""
    var instructions: String = ""
    var signature: String = ""
    var sign_date: String = ""
    var date_created: String = ""
    var date_updated: String = ""
    var company_id: String = ""
    var items: [Item] = []
    var photos: [EstimatePhoto] = []
}

class EstimatePhoto: EVNetworkingObject {
    var id: String = ""
    var path: String = ""
    var estimate_id: String = ""
    var company_id: String = ""
}

class EstimateSettingResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: EstimateSetting?
}

class EstimateSetting: EVNetworkingObject {
    var id: String = ""
    var estimate_num_prefix: String = ""
    var estimate_num_next: String = ""
    var default_expire_period: String = ""
    var capture_customer_signature: Bool = true
    var hide_item_price: Bool = false
    var hide_item_qty: Bool = false
    var hide_item_tax: Bool = false
    var hide_item_discount: Bool = false
    var hide_item_total: Bool = false
    var hide_grand_total: Bool = false
    var message: String = ""
    var terms_and_conditions: String = ""
    var company_id: String = ""
}
