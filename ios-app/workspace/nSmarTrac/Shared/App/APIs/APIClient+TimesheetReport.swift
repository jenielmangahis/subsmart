//
//  APIClient+TimesheetReport.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 11/11/20.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Alamofire
import AlamofireObjectMapper

extension APIClient {
    
    func postTimesheetReport(_ params: Parameters, completion: @escaping (_ result: Response?, _ error: NSError?) -> Void) {
        
        APIClient.manager.request(apiURL.timesheetReport, method: .post, parameters: params, encoding: JSONEncoding.default, headers: getAuthHeaders())
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

}
