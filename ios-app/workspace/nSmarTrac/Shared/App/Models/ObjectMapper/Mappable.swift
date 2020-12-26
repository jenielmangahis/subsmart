//
//  Mappable.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 11/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import ObjectMapper

public extension BaseMappable {
    
    static func create(with JSON: [String: Any]? = nil) -> Self {
        return Mapper<Self>().map(JSON: JSON ?? [:])!
    }
    
    static func models(from array: [[String: Any]]) -> [Self] {
        return Mapper<Self>().mapArray(JSONArray: array)
    }
    
    func update(with JSON: [String: Any]) {
        _ = Mapper().map(JSON: JSON, toObject: self)
    }
}
