//
//  Role.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 29/07/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import AlamofireJsonToObjects

class RoleResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [Role] = []
}

class Role: EVNetworkingObject {
    var id: String = ""
    var title: String = ""
    var company_id: String = ""
}
