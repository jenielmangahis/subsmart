//
//  APIClient+Timesheet.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 02/11/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Alamofire
import AlamofireObjectMapper

extension APIClient {
    
    func getTimesheetForAllMembers(_ startDate: String, _ endDate: String, completion: @escaping (_ list: [TimesheetTeamMember], _ error: NSError?) -> Void) {
        let path = apiURL.timesheet + "?company_id=\(App.shared.companyId)&start_date=\(startDate)&end_date=\(endDate)"
        
        APIClient.manager.request(path, method: .get, parameters: nil, encoding: JSONEncoding.default, headers: getAuthHeaders())
            .validate()
            .responseObject { (response: DataResponse<TimesheetTeamMemberResponse>) in
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
    
    func getTimesheetForMember(_ userId: Int, _ startDate: String, _ endDate: String, completion: @escaping (_ result: TimesheetTeamMember?, _ error: NSError?) -> Void) {
        let path = apiURL.timesheet + "?user_id=\(userId)&start_date=\(startDate)&end_date=\(endDate)"
        
        APIClient.manager.request(path, method: .get, parameters: nil, encoding: JSONEncoding.default, headers: getAuthHeaders())
            .validate()
            .responseObject { (response: DataResponse<TimesheetTeamMemberResponse>) in
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
    
    func getUserTimesheet(completion: @escaping (_ result: TimesheetTeamMember?, _ error: NSError?) -> Void) {
        let path = apiURL.timesheet + "?active_user_id=\(App.shared.user!.id)"
        
        APIClient.manager.request(path, method: .get, parameters: nil, encoding: JSONEncoding.default, headers: getAuthHeaders())
            .validate()
            .responseObject { (response: DataResponse<TimesheetTeamMemberResponse>) in
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
    
    func postTimesheet(_ params: Parameters, completion: @escaping (_ result: TimesheetTeamMember?, _ error: NSError?) -> Void) {
        
        APIClient.manager.request(apiURL.timesheet, method: .post, parameters: params, encoding: JSONEncoding.default, headers: getAuthHeaders())
            .validate()
            .responseObject { (response: DataResponse<TimesheetTeamMemberResponse>) in
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
    
    func putTimesheet(_ id: Int, params: Parameters, completion: @escaping (_ result: TimesheetTeamMember?, _ error: NSError?) -> Void) {
        let path = apiURL.timesheet + "?id=\(id)"
        
        APIClient.manager.request(path, method: .put, parameters: params, encoding: JSONEncoding.default, headers: getAuthHeaders())
            .validate()
            .responseObject { (response: DataResponse<TimesheetTeamMemberResponse>) in
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

}
