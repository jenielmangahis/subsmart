//
//  BusinessProfile.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 11/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import AlamofireJsonToObjects

class BusinessProfileResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: BusinessProfile?
}

class BusinessProfile: EVNetworkingObject {
    var id: String = ""
    var contact_name: String = ""
    var business_name: String = ""
    var business_email: String = ""
    var business_image: String = ""
    var website: String = ""
    var service_category: String = ""
    var service_subcategory: String = ""
    var timezone: String = ""
    var is_emergency_support: Bool = true
    var year_est: String = ""
    var employee_count: String = ""
    var is_subcontract_allowed: Bool = true
    var EIN: String = ""
    var business_desc: String = ""
    var business_logo: String = ""
    var business_number: String = ""
    var street: String = ""
    var suite_unit: String = ""
    var city: String = ""
    var postal_code: String = ""
    var state: String = ""
    var business_phone: String = ""
    var office_phone: String = ""
    var office_phone_extn: String = ""
    var phone_emergency: String = ""
    var is_public_phone: Bool = true
    var is_public_office_phone: Bool = true
    var service_location: String = ""
    var working_days: String = ""
    var start_time_of_day: String = ""
    var end_time_of_day: String = ""
    var working_off_from: String = ""
    var working_of_to: String = ""
    var is_business_insured: Bool = false
    var insured_amount: String = ""
    var insurance_expiry_date: String = ""
    var is_bonded: Bool = false
    var bond_amount: String = ""
    var bond_expiry_date: String = ""
    var is_licensed: Bool = false
    var license_class: String = ""
    var license_number: String = ""
    var license_state: String = ""
    var license_expiry_date: String = ""
    var is_bbb_accredited: Bool = false
    var bbb_link: String = ""
    var is_phone_verified: Bool = false
    var is_email_verified: Bool = false
    var is_facebook_connected: Bool = false
    var is_google_connected: Bool = false
    var nsmart_plans_id: String = ""
    var nsmart_plans_name: String = ""
    var nsmart_plans_price: String = ""
    var nsmart_plans_valid_from: String = ""
    var nsmart_plans_valid_to: String = ""
    var nsmart_plans_next_billing_date: String = ""
    var nsmart_plans_next_payment: String = ""
    var nsmart_plans_is_auto_renew: Bool = false
    var folder_name: String = ""
    var user_id: String = ""
    var created_at: String = ""
    var updated_at: String = ""
    var deleted_at: String = ""
    var created_by: String = ""
    var portfolio: [Portfolio] = []
}
