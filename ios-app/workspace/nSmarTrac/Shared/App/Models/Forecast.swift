//
//  Forecast.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 11/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import ObjectMapper

class ForecastResponse: Mappable {
    var city: City!
    var cod: String!
    var message: Double = 0.0
    var cnt: Int = 0
    var list: [Forecast] = []
    
    required init?(map: Map) {}
    
    // Mappable
    func mapping(map: Map) {
        city        <- map["city"]
        cod         <- map["cod"]
        message     <- map["message"]
        cnt         <- map["cnt"]
        list        <- map["list"]
    }
}

class City: Mappable {
    var id: UInt = 0
    var name: String!
    var coord: Coordinate!
    var country: String!
    var population: UInt = 0
    
    required init?(map: Map) {}
    
    // Mappable
    func mapping(map: Map) {
        id              <- map["id"]
        name            <- map["name"]
        coord           <- map["coord"]
        country         <- map["country"]
        population      <- map["population"]
    }
}

class Forecast: Mappable {
    var dt: UInt = 0
    var temp: Temperature!
    var pressure: Double = 0.0
    var humidity: Int = 0
    var weather: [Weather] = []
    var speed: Int = 0
    var deg: Int = 0
    var clouds: Int = 0
    var rain: Double = 0.0
    
    required init?(map: Map) {}
    
    // Mappable
    func mapping(map: Map) {
        dt              <- map["dt"]
        temp            <- map["temp"]
        pressure        <- map["pressure"]
        humidity        <- map["humidity"]
        weather         <- map["weather"]
        speed           <- map["speed"]
        deg             <- map["deg"]
        clouds          <- map["clouds"]
        rain            <- map["rain"]
    }
}

class Temperature: Mappable {
    var day: Double = 0.0
    var min: Double = 0.0
    var max: Double = 0.0
    var night: Double = 0.0
    var eve: Double = 0.0
    var morn: Double = 0.0
    
    required init?(map: Map) {}
    
    // Mappable
    func mapping(map: Map) {
        day         <- map["day"]
        min         <- map["min"]
        max         <- map["max"]
        night       <- map["night"]
        eve         <- map["eve"]
        morn        <- map["morn"]
    }
}
