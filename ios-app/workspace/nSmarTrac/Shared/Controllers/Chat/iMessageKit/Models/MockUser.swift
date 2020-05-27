//
//  MockUser.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 25/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import MessageKit

struct MockUser: SenderType, Equatable {
    var senderId: String
    var displayName: String
}
