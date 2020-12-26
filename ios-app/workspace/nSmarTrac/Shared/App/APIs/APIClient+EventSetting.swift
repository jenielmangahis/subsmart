//
//  APIClient+EventSetting.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 10/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Alamofire
import AlamofireObjectMapper

extension APIClient {
    
    func getEventSetting(completion: @escaping (_ item: EventSetting?, _ error: NSError?) -> Void) {
        let path = apiURL.eventSetting + "?company_id=\(App.shared.companyId)"
        
        APIClient.manager.request(path, method: .get, parameters: nil, encoding: JSONEncoding.default, headers: getAuthHeaders())
            .validate()
            .responseObject { (response: DataResponse<EventSettingResponse>) in
                guard response.error == nil else {
                    return completion(nil, response.error! as NSError)
                }
                
                if let result = response.result.value {
                    if result.Data != nil {
                        return completion(result.Data, nil)
                    }
                    
                    let userInfo = [NSLocalizedDescriptionKey :  NSLocalizedString("Error", value: "No Results found", comment: "")]
                    return completion(nil, NSError(domain: APIError.domain, code: result.Code, userInfo: userInfo))
                }
        }
    }
    
    func putEventSetting(_ params: Parameters, completion: @escaping (_ success: Bool, _ error: NSError?) -> Void) {
        let path = apiURL.eventSetting + "?company_id=\(App.shared.companyId)"
        
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

}
