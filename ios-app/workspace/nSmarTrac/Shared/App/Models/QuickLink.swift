//
//  QuickLink.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 12/07/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import AlamofireJsonToObjects

class QuickLinkResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [QuickLink] = []
}

class QuickLink: EVNetworkingObject {
    var id: String = ""
    var company_id: String = ""
    var category: String = ""
    var name: String = ""
    var url: String = ""
}
