//
//  Array+Extensions.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 29/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

extension Array where Element: Hashable {
    
    func difference(from other: [Element]) -> [Element] {
        let thisSet = Set(self)
        let otherSet = Set(other)
        return Array(thisSet.symmetricDifference(otherSet))
    }
}
