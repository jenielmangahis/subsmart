//
//  Trac360.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 12/5/20.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import AlamofireJsonToObjects

class Trac360CircleResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [Trac360Circle] = []
}

class Trac360Circle: EVNetworkingObject {
    var id: String = ""
    var name: String = ""
    var invite_code: String = ""
    var created_by: String = ""
    var date_created: String = ""
    var people: [Trac360People] = []
    var places: [Trac360Place] = []
}

class Trac360PeopleResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [Trac360People] = []
}

class Trac360People: EVNetworkingObject {
    var id: String = ""
    var user_id: String = ""
    var name: String = ""
    var last_tracked_location: String = ""
    var last_tracked_location_address: String = ""
    var last_tracked_location_date: String = ""
    var is_location_off: String = ""
    var circle_id: String = ""
}

class Trac360PlaceResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [Trac360Place] = []
}

class Trac360Place: EVNetworkingObject {
    var id: String = ""
    var coordinates: String = ""
    var address: String = ""
    var zone_radius: String = ""
    var category_name: String = ""
    var created_by: String = ""
    var date_created: String = ""
    var circle_id: String = ""
}
