//
//  APIClient+Events.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 01/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Alamofire
import AlamofireObjectMapper

extension APIClient {
    
    func getEvents(completion: @escaping (_ list: [Event], _ error: NSError?) -> Void) {
        let path = apiURL.events + "?company_id=\(App.shared.companyId)"
        
        APIClient.manager.request(path, method: .get, parameters: nil, encoding: JSONEncoding.default, headers: getAuthHeaders())
            .validate()
            .responseObject { (response: DataResponse<EventResponse>) in
                guard response.error == nil else {
                    return completion([], response.error! as NSError)
                }
                
                if let result = response.result.value {
                    if result.Data.count > 0 {
                        return completion(result.Data, nil)
                    }
                    
                    let userInfo = [NSLocalizedDescriptionKey :  NSLocalizedString("Error", value: "No Results found", comment: "")]
                    return completion([], NSError(domain: APIError.domain, code: result.Code, userInfo: userInfo))
                }
        }
    }
    
    func getEvent(_ id: Int, completion: @escaping (_ item: Event?, _ error: NSError?) -> Void) {
        let path = apiURL.events + "?id=\(id)"
        
        APIClient.manager.request(path, method: .get, parameters: nil, encoding: JSONEncoding.default, headers: getAuthHeaders())
            .validate()
            .responseObject { (response: DataResponse<EventResponse>) in
                guard response.error == nil else {
                    return completion(nil, response.error! as NSError)
                }
                
                if let result = response.result.value {
                    if result.Data.count > 0 {
                        return completion(result.Data.first, nil)
                    }
                    
                    let userInfo = [NSLocalizedDescriptionKey :  NSLocalizedString("Error", value: "No Results found", comment: "")]
                    return completion(nil, NSError(domain: APIError.domain, code: result.Code, userInfo: userInfo))
                }
        }
    }
    
    func postEvent(_ params: Parameters, completion: @escaping (_ result: Response?, _ error: NSError?) -> Void) {
        
        APIClient.manager.request(apiURL.events, method: .post, parameters: params, encoding: JSONEncoding.default, headers: getAuthHeaders())
            .validate()
            .responseObject { (response: DataResponse<Response>) in
                guard response.error == nil else {
                    return completion(nil, response.error! as NSError)
                }
                
                if let result = response.result.value {
                    return completion(result, nil)
                }
        }
    }
    
    func putEvent(_ id: Int, params: Parameters, completion: @escaping (_ success: Bool, _ error: NSError?) -> Void) {
        let path = apiURL.events + "?id=\(id)"
        
        APIClient.manager.request(path, method: .put, parameters: params, encoding: JSONEncoding.default, headers: getAuthHeaders())
            .validate()
            .responseObject { (response: DataResponse<Response>) in
                guard response.error == nil else {
                    return completion(false, response.error! as NSError)
                }
                
                if let result = response.result.value {
                    if result.Code == 200 {
                        return completion(true, nil)
                    }
                    return completion(false, nil)
                }
        }
    }
    
    func deleteEvent(_ id: Int, completion: @escaping (_ success: Bool, _ error: NSError?) -> Void) {
        let path = apiURL.events + "?id=\(id)"
        
        APIClient.manager.request(path, method: .delete, parameters: nil, encoding: JSONEncoding.default, headers: getAuthHeaders())
            .validate()
            .responseObject { (response: DataResponse<Response>) in
                guard response.error == nil else {
                    return completion(false, response.error! as NSError)
                }
                
                if let result = response.result.value {
                    if result.Code == 200 {
                        return completion(true, nil)
                    }
                    return completion(false, nil)
                }
        }
    }

}
