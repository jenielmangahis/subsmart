//
//  APIClient.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 06/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import Alamofire

let baseURL = "http://nsmartrac.com/api/v1/"

public struct APIError {
    static let domain = "com.nsmartrac.error"
}

open class AppService {
    public init() {}
}

public class APIClient: AppService {
    
    struct apiURL {
        static let alarm                                = baseURL + "Alarm.php"
        
    }
    
    let headers: HTTPHeaders = [
        "Content-Type": "application/json"
    ]
    
    public override init() {
    }
    
    func getAuthHeaders() -> HTTPHeaders {
        let headers: HTTPHeaders = [
            "Content-Type": "application/json",
            "Authorization": "Bearer " //+ App.shared.user.getToken().access_token
        ]
        return headers
    }
    
    /// Disable SSL Verification for now coz iOS does not allow self-signed certs.
    /// TODO For development use only.
    /// Ref: http://stackoverflow.com/a/40086770/425694
    public private(set) static var manager: Alamofire.SessionManager = {
        
        // Create the server trust policies
        let serverTrustPolicies: [String: ServerTrustPolicy] = [
            "http://nsmartrac.com": .disableEvaluation
        ]
        
        // Create custom manager
        let configuration = URLSessionConfiguration.default
        configuration.httpAdditionalHeaders = Alamofire.SessionManager.defaultHTTPHeaders
        
        let manager = Alamofire.SessionManager(
            configuration: URLSessionConfiguration.default,
            serverTrustPolicyManager: ServerTrustPolicyManager(policies: serverTrustPolicies)
        )
        
        return manager
    }()
}
