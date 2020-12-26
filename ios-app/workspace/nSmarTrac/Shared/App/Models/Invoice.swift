//
//  Invoice.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 23/07/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import AlamofireJsonToObjects

class InvoiceResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [Invoice] = []
}

class Invoice: EVNetworkingObject {
    var id: String = ""
    var customer_id: String = ""
    var customer_name: String = ""
    var customer_email: String = ""
    var customer_phone: String = ""
    var customer_mobile: String = ""
    var customer_address: String = ""
    var job_location: String = ""
    var job_name: String = ""
    var invoice_type: String = ""
    var work_order_number: String = ""
    var po_number: String = ""
    var invoice_number: String = ""
    var date_issued: String = ""
    var due_date: String = ""
    var status: String = ""
    var total_due: String = ""
    var balance: String = ""
    var deposit_request: String = ""
    var accept_credit_card: String = ""
    var accept_check: String = ""
    var accept_cash: String = ""
    var accept_direct_deposit: String = ""
    var accept_credit: String = ""
    var message_to_customer: String = ""
    var terms_and_conditions: String = ""
    var signature: String = ""
    var sign_date: String = ""
    var date_created: String = ""
    var date_updated: String = ""
    var company_id: String = ""
    var items: [Item] = []
    var payment_schedules: [PaymentSchedule] = []
    var photos: [InvoicePhoto] = []
}

class PaymentSchedule: EVNetworkingObject {
    var id: String = ""
    var payment_type: String = ""
    var payment_name: String = ""
    var amount: String = ""
    var due_date: String = ""
    var invoice_id: String = ""
}

class InvoicePhoto: EVNetworkingObject {
    var id: String = ""
    var path: String = ""
    var invoice_id: String = ""
    var company_id: String = ""
}

class InvoiceSettingResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: InvoiceSetting?
}

class InvoiceSetting: EVNetworkingObject {
    var id: String = ""
    var invoice_num_prefix: String = ""
    var invoice_num_next: String = ""
    var check_payable_to: String = ""
    var accept_credit_card: Bool = false
    var accept_check: Bool = false
    var accept_cash: Bool = false
    var accept_direct_deposit: Bool = false
    var accept_credit: Bool = false
    var capture_customer_signature: Bool = true
    var hide_item_price: Bool = false
    var hide_item_qty: Bool = false
    var hide_item_tax: Bool = false
    var hide_item_discount: Bool = false
    var hide_item_total: Bool = false
    var hide_business_phone: Bool = false
    var hide_office_phone: Bool = false
    var accept_tip: Bool = false
    var due_terms: String = ""
    var auto_convert_completed_work_order: Bool = true
    var message: String = ""
    var terms_and_conditions: String = ""
    var company_id: String = ""
}
