//
//  APIClient+Login.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 07/07/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Alamofire
import AlamofireObjectMapper

extension APIClient {

    func postLogin(email: String, password: String, completion: @escaping (_ response: AuthResponse?, _ error: NSError?) -> Void) {
        
        let params: Parameters = [
            "email": email,
            "password": password
        ]
        
        APIClient.manager.request(apiURL.login, method: .post, parameters: params, encoding: JSONEncoding.default, headers: headers)
            .validate()
            .responseObject { (response: DataResponse<AuthResponse>) in
                guard response.error == nil else {
                    return completion(nil, response.error! as NSError)
                }
                
                if let result = response.result.value {
                    completion(result, nil)
                }
        }
    }
    
    func refreshToken(_ refresh_token: String, completion: @escaping (_ token: OAuthToken?, _ error: NSError?) -> Void) {
        let path = apiURL.login + "?refresh_token=" + refresh_token
        
        APIClient.manager.request(path, method: .get, parameters: nil, encoding: JSONEncoding.default, headers: headers)
            .validate()
            .responseObject { (response: DataResponse<AuthResponse>) in
                guard response.error == nil else {
                    return completion(nil, response.error! as NSError)
                }
                
                if let result = response.result.value {
                    completion(result.OAuth, nil)
                }
        }
    }
}
