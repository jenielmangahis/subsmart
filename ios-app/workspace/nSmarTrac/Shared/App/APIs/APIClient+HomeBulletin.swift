//
//  APIClient+HomeBulletin.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 12/7/20.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Alamofire
import AlamofireObjectMapper

extension APIClient {
    
    func getUpNext(completion: @escaping (_ list: [Event], _ error: NSError?) -> Void) {
        let path = apiURL.homeBulletin + "?company_id=\(App.shared.companyId)"
        
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
    
    func getMySchedule(completion: @escaping (_ list: [Any], _ error: NSError?) -> Void) {
        let path = apiURL.homeBulletin + "?user_id=\(App.shared.user?.id.intValue ?? 0)"
        
        APIClient.manager.request(path, method: .get, parameters: nil, encoding: JSONEncoding.default, headers: getAuthHeaders())
            .validate()
            .responseObject { (response: DataResponse<HomeBulletinResponse>) in
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

}
