//
//  Users.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 07/07/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import AlamofireJsonToObjects

class UserResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [User] = []
}

class User: EVNetworkingObject {
    var id: String = ""
    var full_name: String = ""
    var FName: String = ""
    var LName: String = ""
    var username: String = ""
    var email: String = ""
    var password: String = ""
    var last_login: String = ""
    var role: String = ""
    var reset_token: String = ""
    var status: String = ""
    var about: String = ""
    var comments: String = ""
    var notify_email: Bool = false
    var notify_sms: Bool = false
    var employment_type: String = ""
    var birthdate: String = ""
    var date_hired: String = ""
    var pay_type: String = ""
    var pay_rate: String = ""
    var travel_rate: String = ""
    var created_at: String = ""
    var updated_at: String = ""
    var profile_img: String = ""
    var company_id: String = ""
    var device_token: String = ""
    var device_uuid: String = ""
    var device_type: String = ""
    var address: [Address] = []
    var phone: [Phone] = []
    var user_sign: UserSign?
    var company: BusinessProfile?
    var menus: [String] = []
}

class Address: EVNetworkingObject {
    var address_id: String = ""
    var address1: String = ""
    var address2: String = ""
    var city: String = ""
    var state: String = ""
    var postal_code: String = ""
    var address_type: String = ""
    var contact_name: String = ""
    var email: String = ""
    var phone: String = ""
    var mobile: String = ""
    var notes: String = ""
    var user_id: String = ""
    var customer_id: String = ""
}

class Phone: EVNetworkingObject {
    var phone_id: String = ""
    var number: String = ""
    var extensionn: String = ""
    var type: String = ""
    var is_primary: String = ""
    var accept_text: String = ""
    var user_id: String = ""
}

class UserSignResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: UserSign?
}

class UserSign: EVNetworkingObject {
    var id: String = ""
    var user_id: String = ""
    var signature_image: String = ""
    var initial_image: String = ""
    var show_identity: Bool = false
    var display_company_title: Bool = false
    var display_address_phone: Bool = false
    var display_usage_history: Bool = false
    var date_format_for_signers: String = ""
    var status: String = ""
    var created_at: String = ""
    var updated_at: String = ""
    var company_id: String = ""
}
