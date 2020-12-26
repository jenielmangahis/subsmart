//
//  Task.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 08/07/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import AlamofireJsonToObjects

class TaskResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [Task] = []
}

class Task: EVNetworkingObject {
    var task_id: String = ""
    var subject: String = ""
    var descriptionn: String = ""
    var created_by: String = ""
    var date_created: String = ""
    var estimated_date_complete: String = ""
    var actual_date_complete: String = ""
    var task_color: String = ""
    var status_id: String = ""
    var status_name: String = ""
    var status_color: String = ""
    var priority: String = ""
    var company_id: String = ""
    var participants: [TaskParticipant] = []
}

class TaskParticipantResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [TaskParticipant] = []
}

class TaskParticipant: EVNetworkingObject {
    var id: String = ""
    var user_id: String = ""
    var full_name: String = ""
    var is_assigned: Bool = false
}
