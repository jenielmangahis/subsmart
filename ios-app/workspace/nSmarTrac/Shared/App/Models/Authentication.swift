//
//  Authentication.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 07/07/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import AlamofireJsonToObjects

class AuthResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var OAuth: OAuthToken!
    var Data: User!
}

class OAuthToken: EVNetworkingObject {
    var access_token: String!
    var expires_in: Int = 0
    var token_type: String!
    var scope: String = ""
    var refresh_token: String!
}

class Response: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: String!
}
