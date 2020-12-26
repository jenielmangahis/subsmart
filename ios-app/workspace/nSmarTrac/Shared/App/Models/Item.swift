//
//  Item.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 07/07/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import AlamofireJsonToObjects

class ItemResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [Item] = []
}

class Item: EVNetworkingObject {
    var id: String = ""
    var company_id: String = ""
    var title: String = ""
    var type: String = ""
    var descriptionn: String = ""
    var model: String = ""
    var brand: String = ""
    var COGS: String = ""
    var price: String = ""
    var cost_per: String = ""
    var url: String = ""
    var notes: String = ""
    var item_categories_id: String = ""
    var is_active: String = ""
    var vendor_id: String = ""
    var units: String = ""
    var frequency: String = ""
    var estimated_time: String = ""
    var modified: String = ""
    var total_qty: String = ""
    var locations: [ItemLocation] = []
}

class ItemLocationResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [ItemLocation] = []
}

class ItemLocation: EVNetworkingObject {
    var id: String = ""
    var name: String = ""
    var qty: String = ""
}
