//
//  APIClient+Weather.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 11/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Alamofire
import AlamofireObjectMapper
import MapKit

extension APIClient {
    
    func getWeatherByLocation(_ location: CLLocationCoordinate2D, completion: @escaping (_ result: WeatherResponse?, _ error: NSError?)->()) {
        
        let url = "http://api.openweathermap.org/data/2.5/weather?"
        let appID = "410f8c7029235074b3e28236257a3820"
        
        let path = url + "lat=\(location.latitude)&lon=\(location.longitude)&appid=" + appID
        
        APIClient.manager.request(path, method: .get, parameters: nil, encoding: JSONEncoding.default, headers: headers)
            .validate()
            .responseJSON { response in
                guard response.error == nil else {
                    return completion(nil, response.error! as NSError)
                }
                
                if let result = response.result.value {
                    let object = WeatherResponse(JSON: result as! [String : Any])
                    completion(object, nil)
                }
        }
    }
    
    func getWeatherForecast(_ location: CLLocationCoordinate2D, completion: @escaping (_ result: [Forecast], _ error: NSError?)->()) {
        
        let url = "http://api.openweathermap.org/data/2.5/forecast/daily?"
        let appID = "410f8c7029235074b3e28236257a3820"
        
        let path = url + "lat=\(location.latitude)&lon=\(location.longitude)&cnt=9&appid=" + appID // change to 3
        
        APIClient.manager.request(path, method: .get, parameters: nil, encoding: JSONEncoding.default, headers: headers)
            .validate()
            .responseJSON { response in
                guard response.error == nil else {
                    return completion([], response.error! as NSError)
                }
                
                if let result = response.result.value {
                    let object = ForecastResponse(JSON: result as! [String : Any])
                    completion((object?.list)!, nil)
                }
        }
    }
}
