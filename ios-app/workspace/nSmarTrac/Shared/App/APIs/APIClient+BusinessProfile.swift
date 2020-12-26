//
//  APIClient+BusinessProfile.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 11/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Alamofire
import AlamofireObjectMapper

extension APIClient {
    
    func getBusinessProfile(completion: @escaping (_ item: BusinessProfile?, _ error: NSError?) -> Void) {
        let path = apiURL.businessProfile + "?company_id=\(App.shared.companyId)"
        
        APIClient.manager.request(path, method: .get, parameters: nil, encoding: JSONEncoding.default, headers: getAuthHeaders())
            .validate()
            .responseObject { (response: DataResponse<BusinessProfileResponse>) in
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
    
    func putBusinessProfile(_ params: Parameters, completion: @escaping (_ success: Bool, _ error: NSError?) -> Void) {
        let path = apiURL.businessProfile + "?company_id=\(App.shared.companyId)"
        
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
    
    func uploadLogo(_ image: UIImage, completion: @escaping (_ success: Bool, _ error: NSError?) -> Void) {
        
        // Image what you want to send.
        let imageData = image.jpegData(compressionQuality: 1.0)
        
        // Params
        let params: Parameters = ["company_id": App.shared.companyId]
        
        APIClient.manager.upload(multipartFormData: { multipartFormData in
            multipartFormData.append(imageData!, withName: "file", fileName: "logo-\(App.shared.companyId)-\(Date().currentTimeMillis()).jpg", mimeType: "image/jpg")
                            //Optional for extra parameters
                            for (key, value) in params {
                                multipartFormData.append("\(value)".data(using: .utf8)!, withName: key)
                            }
                        },
                        usingThreshold: UInt64.init(),
                        to: baseURL + "UploadLogo.php",
                        method: .post,
                        headers: getUploadHeaders()) { (result) in
                            switch result {
                            case .success(let upload, _, _):
                                upload.uploadProgress(closure: { (progress) in
                                    print("Upload Progress: \(progress.fractionCompleted)")
                                })
                                
                                upload.responseObject { (response: DataResponse<Response>) in
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

                            case .failure(let encodingError):
                                print(encodingError)
                                return completion(false, encodingError as NSError)
                            }
            
        }
    }
    
    func uploadBanner(_ image: UIImage, completion: @escaping (_ success: Bool, _ error: NSError?) -> Void) {
        
        // Image what you want to send.
        let imageData = image.jpegData(compressionQuality: 1.0)
        
        // Params
        let params: Parameters = ["company_id": App.shared.companyId]
        
        APIClient.manager.upload(multipartFormData: { multipartFormData in
            multipartFormData.append(imageData!, withName: "file", fileName: "banner-\(App.shared.companyId)-\(Date().currentTimeMillis()).jpg", mimeType: "image/jpg")
                            //Optional for extra parameters
                            for (key, value) in params {
                                multipartFormData.append("\(value)".data(using: .utf8)!, withName: key)
                            }
                        },
                        usingThreshold: UInt64.init(),
                        to: baseURL + "UploadBanner.php",
                        method: .post,
                        headers: getUploadHeaders()) { (result) in
                            switch result {
                            case .success(let upload, _, _):
                                upload.uploadProgress(closure: { (progress) in
                                    print("Upload Progress: \(progress.fractionCompleted)")
                                })
                                
                                upload.responseObject { (response: DataResponse<Response>) in
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

                            case .failure(let encodingError):
                                print(encodingError)
                                return completion(false, encodingError as NSError)
                            }
            
        }
    }

}
