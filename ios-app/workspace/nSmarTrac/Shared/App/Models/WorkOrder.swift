//
//  WorkOrder.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 17/07/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import AlamofireJsonToObjects

class WorkOrderResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [WorkOrder] = []
}

class WorkOrder: EVNetworkingObject {
    var id: String = ""
    var work_order_number: String = ""
    var customer_id: String = ""
    var customer_name: String = ""
    var customer_email: String = ""
    var customer_phone: String = ""
    var customer_mobile: String = ""
    var customer_address: String = ""
    var employee_id: String = ""
    var employee_name: String = ""
    var job_location: String = ""
    var start_date: String = ""
    var start_time: String = ""
    var end_date: String = ""
    var end_time: String = ""
    var event_color: String = ""
    var customer_reminder_notification: String = ""
    var timezone: String = ""
    var is_recurring: String = ""
    var date_issued: String = ""
    var job_type: String = ""
    var job_name: String = ""
    var job_description: String = ""
    var status: String = ""
    var is_invoiced: String = ""
    var invoiced_date: String = ""
    var priority: String = ""
    var po_number: String = ""
    var instructions: String = ""
    var header: String = ""
    var password: String = ""
    var security_number: String = ""
    var custom_field: String = ""
    var terms_and_conditions: String = ""
    var terms_of_use: String = ""
    var company_representative_signature: String = ""
    var company_representative_sign_date: String = ""
    var company_representative_name: String = ""
    var primary_account_holder_signature: String = ""
    var primary_account_holder_sign_date: String = ""
    var primary_account_holder_name: String = ""
    var secondary_account_holder_signature: String = ""
    var secondary_account_holder_sign_date: String = ""
    var secondary_account_holder_name: String = ""
    var authorizer_name: String = ""
    var before_signature: String = ""
    var before_sign_date: String = ""
    var after_signature: String = ""
    var after_sign_date: String = ""
    var owner_signature: String = ""
    var owner_sign_date: String = ""
    var date_created: String = ""
    var date_updated: String = ""
    var company_id: String = ""
    var items: [Item] = []
    var photos: [WorkOrderPhoto] = []
}

class WorkOrderPhoto: EVNetworkingObject {
    var id: String = ""
    var path: String = ""
    var work_order_id: String = ""
    var company_id: String = ""
}

class WorkOrderSettingResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: WorkOrderSetting?
}

class WorkOrderSetting: EVNetworkingObject {
    var id: String = ""
    var work_order_num_prefix: String = ""
    var work_order_num_next: String = ""
    var capture_customer_signature: Bool = true
    var company_id: String = ""
}

class WorkOrderTypeResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [WorkOrderType] = []
}

class WorkOrderType: EVNetworkingObject {
    var id: String = ""
    var name: String = ""
    var company_id: String = ""
    var template: WorkOrderTemplate? = nil
}

class WorkOrderTemplate: EVNetworkingObject {
    var id: String = ""
    var work_order_type_id: String = ""
    var customer_id: String = ""
    var customer_name: String = ""
    var customer_email: String = ""
    var customer_phone: String = ""
    var customer_mobile: String = ""
    var customer_address: String = ""
    var employee_id: String = ""
    var employee_name: String = ""
    var job_location: String = ""
    var start_date: String = ""
    var start_time: String = ""
    var end_date: String = ""
    var end_time: String = ""
    var event_color: String = ""
    var customer_reminder_notification: String = ""
    var timezone: String = ""
    var is_recurring: String = ""
    var date_issued: String = ""
    var job_type: String = ""
    var job_name: String = ""
    var job_description: String = ""
    var status: String = ""
    var is_invoiced: String = ""
    var invoiced_date: String = ""
    var priority: String = ""
    var po_number: String = ""
    var instructions: String = ""
    var header: String = ""
    var password: String = ""
    var security_number: String = ""
    var custom_field: String = ""
    var terms_and_conditions: String = ""
    var terms_of_use: String = ""
    var company_representative_signature: String = ""
    var company_representative_sign_date: String = ""
    var company_representative_name: String = ""
    var primary_account_holder_signature: String = ""
    var primary_account_holder_sign_date: String = ""
    var primary_account_holder_name: String = ""
    var secondary_account_holder_signature: String = ""
    var secondary_account_holder_sign_date: String = ""
    var secondary_account_holder_name: String = ""
    var authorizer_name: String = ""
    var before_signature: String = ""
    var before_sign_date: String = ""
    var after_signature: String = ""
    var after_sign_date: String = ""
    var owner_signature: String = ""
    var owner_sign_date: String = ""
    var date_created: String = ""
    var date_updated: String = ""
    var company_id: String = ""
    var items: [Item] = []
    var photos: [WorkOrderPhoto] = []
}
