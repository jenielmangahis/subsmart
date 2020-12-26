//
//  APIClient+WorkOrder.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 17/07/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Alamofire
import AlamofireObjectMapper
import PDFKit

extension APIClient {
    
    func getWorkOrders(completion: @escaping (_ list: [WorkOrder], _ error: NSError?) -> Void) {
        let path = apiURL.workOrder + "?company_id=\(App.shared.companyId)"
        
        APIClient.manager.request(path, method: .get, parameters: nil, encoding: JSONEncoding.default, headers: getAuthHeaders())
            .validate()
            .responseObject { (response: DataResponse<WorkOrderResponse>) in
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
    
    func getWorkOrder(_ id: Int, completion: @escaping (_ item: WorkOrder?, _ error: NSError?) -> Void) {
        let path = apiURL.workOrder + "?id=\(id)"
        
        APIClient.manager.request(path, method: .get, parameters: nil, encoding: JSONEncoding.default, headers: getAuthHeaders())
            .validate()
            .responseObject { (response: DataResponse<WorkOrderResponse>) in
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
    
    func postWorkOrder(_ params: Parameters, completion: @escaping (_ result: Response?, _ error: NSError?) -> Void) {
        
        APIClient.manager.request(apiURL.workOrder, method: .post, parameters: params, encoding: JSONEncoding.default, headers: getAuthHeaders())
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
    
    func putWorkOrder(_ id: Int, params: Parameters, flag: String = "", completion: @escaping (_ success: Bool, _ error: NSError?) -> Void) {
        let path = apiURL.workOrder + "?id=\(id)&flag=\(flag)"
        
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
    
    func deleteWorkOrder(_ id: Int, completion: @escaping (_ success: Bool, _ error: NSError?) -> Void) {
        let path = apiURL.workOrder + "?id=\(id)"
        
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
    
    func uploadWorkOrderPhoto(_ image: UIImage, imageName: String, params: Parameters, completion: @escaping (_ success: Bool, _ error: NSError?) -> Void) {
        
        // Image what you want to send.
        let imageData = image.jpegData(compressionQuality: 1.0)
        
        APIClient.manager.upload(multipartFormData: { multipartFormData in
            multipartFormData.append(imageData!, withName: "file", fileName: imageName, mimeType: "image/jpg")
                            //Optional for extra parameters
                            for (key, value) in params {
                                multipartFormData.append("\(value)".data(using: .utf8)!, withName: key)
                            }
                        },
                        usingThreshold: UInt64.init(),
                        to: baseURL + "UploadWorkOrderPhoto.php",
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
    
    func uploadWorkOrderSignature(_ image: UIImage, imageName: String, params: Parameters, completion: @escaping (_ success: Bool, _ error: NSError?) -> Void) {
        
        // Image what you want to send.
        let imageData = image.jpegData(compressionQuality: 1.0)
        
        APIClient.manager.upload(multipartFormData: { multipartFormData in
            multipartFormData.append(imageData!, withName: "file", fileName: imageName, mimeType: "image/jpg")
                            //Optional for extra parameters
                            for (key, value) in params {
                                multipartFormData.append("\(value)".data(using: .utf8)!, withName: key)
                            }
                        },
                        usingThreshold: UInt64.init(),
                        to: baseURL + "UploadWorkOrderSignature.php",
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
