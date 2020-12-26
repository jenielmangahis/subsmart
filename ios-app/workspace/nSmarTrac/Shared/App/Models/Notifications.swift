//
//  Notifications.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 11/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import AlamofireJsonToObjects

/*class NotificationResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [Vendor] = []
}

class Notification: EVNetworkingObject {
    var id: String = ""
    var company_id: String = ""
}*/

class NotificationSettingResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: NotificationSetting?
}

class NotificationSetting: EVNetworkingObject {
    var id: String = ""
    var notify_email: Bool = true
    var notify_sms: Bool = true
    var notify_residential_when_scheduling: Bool = true
    var notify_residential_during_rescheduling_cancelling: Bool = true
    var set_default_commercial_value_as_residential: Bool = true
    var notify_commercial_when_scheduling: Bool = true
    var notify_commercial_during_rescheduling_cancelling: Bool = true
    var customer_reminder_notification: String = ""
    var customer_first_heads_up_notification: String = ""
    var customer_second_heads_up_notification: String = ""
    var business_reminder_notification: String = ""
    var task_reminder_notification: String = ""
    var copy_when_sending_estimate: Bool = true
    var copy_when_sending_invoice: Bool = true
    var notify_when_employees_arrive: Bool = true
    var notify_tenant_from_service_address: Bool = true
    var company_id: String = ""
}
