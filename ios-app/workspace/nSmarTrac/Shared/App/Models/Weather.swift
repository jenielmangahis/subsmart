//
//  Weather.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 11/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import ObjectMapper

class WeatherResponse: Mappable {
    var coord: Coordinate!
    var weather: [Weather] = []
    var base: String!
    var main: Main!
    var visibility: Int = 0
    var wind: Wind!
    var rain: Rain!
    var clouds: Clouds!
    var dt: UInt = 0
    var sys: System!
    var id: UInt = 0
    var name: String!
    var cod: Int = 0
    
    required init?(map: Map) {}
    
    // Mappable
    func mapping(map: Map) {
        coord           <- map["coord"]
        weather         <- map["weather"]
        base            <- map["base"]
        main            <- map["main"]
        visibility      <- map["visibility"]
        wind            <- map["wind"]
        rain            <- map["rain"]
        clouds          <- map["clouds"]
        dt              <- map["dt"]
        sys             <- map["sys"]
        id              <- map["id"]
        name            <- map["name"]
        cod             <- map["cod"]
    }
}

class Coordinate: Mappable {
    var lon: Int = 0
    var lat: Int = 0
    
    required init?(map: Map) {}
    
    // Mappable
    func mapping(map: Map) {
        lon     <- map["lon"]
        lat     <- map["lat"]
    }
}

class Weather: Mappable {
    var id: Int = 0
    var main: String!
    var descriptionn: String!
    var icon: String!
    
    required init?(map: Map) {}
    
    // Mappable
    func mapping(map: Map) {
        id              <- map["id"]
        main            <- map["main"]
        descriptionn    <- map["description"]
        icon            <- map["icon"]
    }
}

class Main: Mappable {
    var temp: Double = 0.0
    var pressure: Int = 0
    var humidity: Int = 0
    var temp_min: Double = 0.0
    var temp_max: Double = 0.0
    
    required init?(map: Map) {}
    
    // Mappable
    func mapping(map: Map) {
        temp        <- map["temp"]
        pressure    <- map["pressure"]
        humidity    <- map["humidity"]
        temp_min    <- map["temp_min"]
        temp_max    <- map["temp_max"]
    }
}

class Wind: Mappable {
    var speed: Double = 0.0
    var deg: Int = 0
    
    required init?(map: Map) {}
    
    // Mappable
    func mapping(map: Map) {
        speed   <- map["speed"]
        deg     <- map["deg"]
    }
}

class Rain: Mappable {
    var h1: Double = 0.0
    
    required init?(map: Map) {}
    
    // Mappable
    func mapping(map: Map) {
        h1  <- map["1h"]
    }
}

class Clouds: Mappable {
    var all: Int = 0
    
    required init?(map: Map) {}
    
    // Mappable
    func mapping(map: Map) {
        all <- map["all"]
    }
}

class System: Mappable {
    var type: Int = 0
    var id: Int = 0
    var message: Double = 0.0
    var country: String!
    var sunrise: UInt = 0
    var sunset: UInt = 0
    
    required init?(map: Map) {}
    
    // Mappable
    func mapping(map: Map) {
        type    <- map["type"]
        id      <- map["id"]
        message <- map["message"]
        sunrise <- map["sunrise"]
        sunset  <- map["sunset"]
    }
}
