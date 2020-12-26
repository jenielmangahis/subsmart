//
//  Cards.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 19/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import AlamofireJsonToObjects

class CardResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [Card] = []
}

class Card: EVNetworkingObject {
    var id: String = ""
    var card_holder: String = ""
    var card_number: String = ""
    var expiration: String = ""
    var cvv: String = ""
    var card_type: String = ""
    var is_default: Bool = false
    var date_added: String = ""
    var date_updated: String = ""
    var company_id: String = ""
}
