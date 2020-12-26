//
//  APIClient+Image.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 24/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Alamofire
import AlamofireImage

extension APIClient {
    
    func downloadImage(_ url: String, completion: @escaping (_ image: UIImage?) -> Void) {
        APIClient.manager.request(url).responseImage { response in
            if let image = response.result.value {
                return completion(image)
            }
        }
    }
    
    func downloadFile(_ url: String, _ filename: String, completion: @escaping (_ success: Bool, _ error: Error?, _ fileLocation: URL?) -> Void) {
        
        if let itemUrl = URL(string: url.trimmingCharacters(in: .whitespacesAndNewlines).addingPercentEncoding(withAllowedCharacters: CharacterSet.urlQueryAllowed)!) {
            
            let destination: DownloadRequest.DownloadFileDestination = { _, _ in
                var documentsURL = FileManager.default.urls(for: .documentDirectory, in: .userDomainMask)[0]
                documentsURL.appendPathComponent(filename)
                return (documentsURL, [.removePreviousFile])
            }
            
            APIClient.manager.download(itemUrl, to: destination).responseData { response in
                if let destinationUrl = response.destinationURL {
                    return completion(true, nil, destinationUrl)
                }
                return completion(false, response.error, nil)
            }
        }
    }
    
    func fileExistsAt(url: URL, completion: @escaping (Bool) -> Void) {
        let checkSession = URLSession.shared
        var request = URLRequest(url: url)
        request.httpMethod = "HEAD"
        request.timeoutInterval = 1.0
        
        // Adjust to your needs
        let task = checkSession.dataTask(with: request) { (data, response, error) -> Void in
            if let httpResp = response as? HTTPURLResponse { completion(httpResp.statusCode == 200) }
            
        }
        task.resume()
    }
}
