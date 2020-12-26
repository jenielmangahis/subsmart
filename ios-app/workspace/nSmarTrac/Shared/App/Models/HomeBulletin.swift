//
//  HomeBulletin.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 12/7/20.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import AlamofireJsonToObjects

class HomeBulletinResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [Any] = []
}
