//
//  PortfolioPictures.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 18/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import AlamofireJsonToObjects

class PortfolioResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [Portfolio] = []
}

class Portfolio: EVNetworkingObject {
    var id: String = ""
    var path: String = ""
    var caption: String = ""
    var company_id: String = ""
}
