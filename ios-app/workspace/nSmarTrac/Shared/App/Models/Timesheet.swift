//
//  TimeSheet.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 17/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import AlamofireJsonToObjects

class TimesheetAttendanceResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [TimesheetAttendance] = []
}

class TimesheetAttendance: EVNetworkingObject {
    var id: String = ""
    var user_id: String = ""
    var shift_duration: String = ""
    var break_duration: String = ""
    var overtime: String = ""
    var overtime_status: String = ""
    var date_created: String = ""
    var notes: String = ""
    var status: String = ""
    var logs: [TimesheetLog] = []
}

class TimesheetDepartmentResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [TimesheetDepartment] = []
}

class TimesheetDepartment: EVNetworkingObject {
    var id: String = ""
    var name: String = ""
    var company_id: String = ""
    var members: [TimesheetTeamMember] = []
}

class TimesheetJobCodeResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [TimesheetJobCode] = []
}

class TimesheetJobCode: EVNetworkingObject {
    var id: String = ""
    var name: String = ""
    var company_id: String = ""
}

class TimesheetJobSiteResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [TimesheetJobSite] = []
}

class TimesheetJobSite: EVNetworkingObject {
    var id: String = ""
    var name: String = ""
    var address: String = ""
    var coordinates: String = ""
    var diameter: String = ""
    var company_id: String = ""
}

class TimesheetLeaveResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [TimesheetLeave] = []
}

class TimesheetLeave: EVNetworkingObject {
    var id: String = ""
    var user_id: String = ""
    var pto_id: String = ""
    var pto_name: String = ""
    var total_hours: String = ""
    var status: String = ""
    var date_created: String = ""
    var date: String = ""
}

class TimesheetLogResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [TimesheetLog] = []
}

class TimesheetLog: EVNetworkingObject {
    var id: String = ""
    var attendance_id: String = ""
    var user_id: String = ""
    var user_location: String = ""
    var user_location_address: String = ""
    var action: String = ""
    var entry_type: String = ""
    var date_created: String = ""
    var status: String = ""
    var approved_by: String = ""
    var company_id: String = ""
    var workorder_id: String = ""
    var approved_by_name: String = ""
}

class TimesheetPTOResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [TimesheetPTO] = []
}

class TimesheetPTO: EVNetworkingObject {
    var id: String = ""
    var name: String = ""
    var company_id: String = ""
}

class TimesheetTeamMemberResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [TimesheetTeamMember] = []
}

class TimesheetTeamMember: EVNetworkingObject {
    var id: String = ""
    var user_id: String = ""
    var name: String = ""
    var email: String = ""
    var role: String = ""
    var department_id: String = ""
    var department_role: String = ""
    var will_track_location: String = ""
    var status: String = ""
    var company_id: String = ""
    var attendance: [TimesheetAttendance] = []
    var leave: [TimesheetLeave] = []
    var total_hours: Double = 0.0
    var total_break: Double = 0.0
    var total_overtime: Double = 0.0
    var total_pto: Double = 0.0
    var iconBorderColor: UIColor = .lightGray
    var statusDetail: String = "Not Active!"
    var showUserLocation: Bool = true
}

class TimesheetNotificationSettingResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: TimesheetNotificationSetting?
}

class TimesheetNotificationSetting: EVNetworkingObject {
    var id: String = ""
    var company_id: String = ""
    var clocked_in_reminder: String = ""
    var clocked_in_reminder_time: String = ""
    var clocked_out_reminder: String = ""
    var clocked_out_reminder_time: String = ""
    var when_enter_a_job_site: String = ""
    var when_leave_a_job_site: String = ""
    var clocked_in_for_12h: String = ""
    var clocked_in_for_24h: String = ""
    var days_to_be_reminded: String = ""
    var when_user_clock_in: String = ""
    var when_user_clock_out: String = ""
    var when_user_start_a_break: String = ""
    var when_user_ends_a_break: String = ""
    var when_time_entry_is_modified: String = ""
}

class TimesheetSettingResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: TimesheetSetting?
}

class TimesheetSetting: EVNetworkingObject {
    var id: String = ""
    var company_id: String = ""
    var date_created: String = ""
    var status: String = ""
    var allow_departments: String = ""
    var workweek_start_day: String = ""
    var regular_hours_per_week: String = ""
    var regular_hours_per_day: String = ""
    var overtime: String = ""
    var allow_email_report: String = ""
    var payroll_workweek_start_day: String = ""
    var payroll_schedule: String = ""
    var allow_manual_entries: String = ""
    var roles: [String] = []
    var allow_fixed_timezone: String = ""
    var timezone: String = ""
    var allow_use_decimal_hours: String = ""
    var round_clock_inout_times: String = ""
    var round_increment: String = ""
    var break_rule: String = ""
    var break_length: String = ""
    var break_type: String = ""
    var require_job_code: String = ""
    var allow_location_tracking: String = ""
    var allow_user_specific: String = ""
    var allow_clock_in_restrictions: String = ""
}
