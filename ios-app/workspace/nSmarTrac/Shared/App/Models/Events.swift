//
//  Events.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 01/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import AlamofireJsonToObjects

class EventResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [Event] = []
}

class Event: EVNetworkingObject {
    var id: String = ""
    var event_description: String = ""
    var event_type: String = ""
    var customer_id: String = ""
    var customer_name: String = ""
    var customer_email: String = ""
    var customer_phone: String = ""
    var customer_mobile: String = ""
    var customer_address: String = ""
    var employee_id: String = ""
    var employee_name: String = ""
    var start_date: String = ""
    var start_time: String = ""
    var end_date: String = ""
    var end_time: String = ""
    var event_color: String = ""
    var customer_reminder_notification: String = ""
    var instructions: String = ""
    var is_recurring: String = ""
    var created_by: String = ""
    var created_by_name: String = ""
    var date_created: String = ""
    var date_updated: String = ""
    var company_id: String = ""
}

class EventSettingResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: EventSetting?
}

class EventSetting: EVNetworkingObject {
    var id: String = ""
    var timezone: String = ""
    var auto_sync_icloud_cal: Bool = true
    var auto_sync_google_cal: Bool = true
    var auto_sync_outlook_cal: Bool = true
    var display_color_codes: Bool = true
    var display_customer_info: Bool = true
    var display_job_info: Bool = true
    var display_job_price: Bool = true
    var auto_sync_offline: Bool = true
    var company_id: String = ""
}
