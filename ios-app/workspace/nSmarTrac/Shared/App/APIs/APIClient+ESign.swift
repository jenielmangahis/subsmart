//
//  APIClient+ESign.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 17/09/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Alamofire
import AlamofireObjectMapper
import PDFKit

extension APIClient {
    
    func getESignDocs(completion: @escaping (_ list: [ESign], _ error: NSError?) -> Void) {
        let path = apiURL.eSign + "?company_id=\(App.shared.companyId)"
        
        APIClient.manager.request(path, method: .get, parameters: nil, encoding: JSONEncoding.default, headers: getAuthHeaders())
            .validate()
            .responseObject { (response: DataResponse<ESignResponse>) in
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
    
    func getESign(_ id: Int, completion: @escaping (_ item: ESign?, _ error: NSError?) -> Void) {
        let path = apiURL.eSign + "?id=\(id)"
        
        APIClient.manager.request(path, method: .get, parameters: nil, encoding: JSONEncoding.default, headers: getAuthHeaders())
            .validate()
            .responseObject { (response: DataResponse<ESignResponse>) in
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
    
    func postESign(_ params: Parameters, completion: @escaping (_ result: Response?, _ error: NSError?) -> Void) {
        
        APIClient.manager.request(apiURL.eSign, method: .post, parameters: params, encoding: JSONEncoding.default, headers: getAuthHeaders())
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
    
    func putESign(_ id: Int, params: Parameters, completion: @escaping (_ success: Bool, _ error: NSError?) -> Void) {
        let path = apiURL.eSign + "?id=\(id)"
        
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
    
    func deleteESign(_ id: Int, completion: @escaping (_ success: Bool, _ error: NSError?) -> Void) {
        let path = apiURL.eSign + "?id=\(id)"
        
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
    
    func uploadESignFile(_ data: Data, filename: String, params: Parameters, completion: @escaping (_ filename: String?, _ error: NSError?) -> Void) {
        
        let fileName = "\(Date().currentTimeMillis())_\(filename)"
        
        APIClient.manager.upload(multipartFormData: { multipartFormData in
            multipartFormData.append(data, withName: "file", fileName: fileName, mimeType: "application/pdf")
                            //Optional for extra parameters
                            for (key, value) in params {
                                multipartFormData.append("\(value)".data(using: .utf8)!, withName: key)
                            }
                        },
                        usingThreshold: UInt64.init(),
                        to: baseURL + "UploadESignFile.php",
                        method: .post,
                        headers: getUploadHeaders()) { (result) in
                            switch result {
                            case .success(let upload, _, _):
                                upload.uploadProgress(closure: { (progress) in
                                    print("Upload Progress: \(progress.fractionCompleted)")
                                })
                                
                                upload.responseObject { (response: DataResponse<Response>) in
                                    guard response.error == nil else {
                                        return completion(nil, response.error! as NSError)
                                    }
                                    
                                    if let result = response.result.value {
                                        if result.Code == 200 {
                                            return completion(fileName, nil)
                                        }
                                        return completion(nil, nil)
                                    }
                                }

                            case .failure(let encodingError):
                                print(encodingError)
                                return completion(nil, encodingError as NSError)
                            }
            
        }
    }
}
