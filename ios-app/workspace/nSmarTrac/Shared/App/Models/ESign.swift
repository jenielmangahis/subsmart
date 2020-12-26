//
//  ESign.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 17/09/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import AlamofireJsonToObjects

class ESignResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [ESign] = []
}

class ESign: EVNetworkingObject {
    var id: String = ""
    var name: String = ""
    var type: String = ""
    var status: String = ""
    var message: String = ""
    var reason: String = ""
    var user_id: String = ""
    var full_name: String = ""
    var created_at: String = ""
    var updated_at: String = ""
    var company_id: String = ""
    var files: [ESignFile] = []
    var recipients: [ESignRecipient] = []
}

class ESignFile: EVNetworkingObject {
    var id: String = ""
    var name: String = ""
    var path: String = ""
    var docfile_id: String = ""
}

class ESignRecipientResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [ESignRecipient] = []
}

class ESignRecipient: EVNetworkingObject {
    var id: String = ""
    var user_id: String = ""
    var docfile_id: String = ""
    var name: String = ""
    var email: String = ""
    var role: String = ""
    var host_name: String = ""
    var host_email: String = ""
    var color: String = ""
}
