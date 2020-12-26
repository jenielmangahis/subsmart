//
//  ESignCloudStorageController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 13/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import AuthenticationServices
import BoxSDK
import GoogleSignIn
import GoogleAPIClientForREST
import SwiftyDropbox
import SVProgressHUD

class ESignCloudStorageController: UITableViewController, ASWebAuthenticationPresentationContextProviding {
    
    // MARK: - Properties -
    
    let googleDriveService = GTLRDriveService()
    var googleUser: GIDGoogleUser?
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        
        self.title = "Cloud Storage"
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }

    // MARK: - TableView Datasource -
    
    override func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    override func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return 3
    }
    
    override func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 1
    }
    
    override func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        return 1
    }
    
    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let titles = ["Link with Dropbox", "Link with Google Drive", "Link with Box"]
        let images = ["ic_esign_dropbox", "ic_esign_gdrive", "ic_esign_box"]
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        cell.textLabel?.text    = titles[indexPath.row]
        cell.imageView?.image   = UIImage(named: images[indexPath.row])?.resize(toWidth: 24)

        return cell
    }
    
    override func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        switch indexPath.row {
        case 0:
            linkWithDropbox()
        case 1:
            linkWithGDrive()
        case 2:
            linkWithBox()
        default:
            break
        }
    }
    
    // MARK: - Functions -
    
    func linkWithDropbox() {
        DropboxClientsManager.authorizeFromController(UIApplication.shared, controller: self, openURL: { (url: URL) -> Void in
            UIApplication.shared.openURL(url)
        })
    }
    
    func linkWithGDrive() {
        /***** Configure Google Sign In *****/
        GIDSignIn.sharedInstance()?.delegate = self
        GIDSignIn.sharedInstance()?.presentingViewController = self
        GIDSignIn.sharedInstance()?.scopes = [kGTLRAuthScopeDrive]
        GIDSignIn.sharedInstance()?.signIn()
    }
    
    func linkWithBox() {
        // init
        let clientId = "rpj0fg3di6yelgyovx7bx6mt55hy5hwf" //"3frou8bsyy77j678lw64ghkwmwsqi422"
        let clientSecret = "DNQP6WoBGhJiz42AtBCB61WXbZHxtuzM" //"S18F7BsVBcxZXpP8Z2Qim8liWfEoUFnD"
        
        let sdk = BoxSDK(clientId: clientId, clientSecret: clientSecret)
        //var mClient: BoxClient!
        sdk.getOAuth2Client(tokenStore: KeychainTokenStore(), context: self) { [weak self] result in
            switch result {
            case let .success(client):
                SVProgressHUD.showSuccess(withStatus: "Success! App is now linked to your Box account.")
            case let .failure(error):
                print(error)
            }
        }
    }

}

// MARK: - ASWebAuthenticationPresentationContextProviding -
/// Extension for ASWebAuthenticationPresentationContextProviding conformance
extension ESignCloudStorageController {
    @available(iOS 13.0, *)
    func presentationAnchor(for session: ASWebAuthenticationSession) -> ASPresentationAnchor {
        return self.view.window ?? ASPresentationAnchor()
    }
}

// MARK: - GIDSignInDelegate -

extension ESignCloudStorageController: GIDSignInDelegate {
    func sign(_ signIn: GIDSignIn!, didSignInFor user: GIDGoogleUser!, withError error: Error!) {
        // check
        if error == nil {
            // Include authorization headers/values with each Drive API request.
            self.googleDriveService.authorizer = user.authentication.fetcherAuthorizer()
            self.googleUser = user
        } else {
            self.googleDriveService.authorizer = nil
            self.googleUser = nil
        }
    }
    
    func sign(_ signIn: GIDSignIn!, didDisconnectWith user: GIDGoogleUser!, withError error: Error!) {
        print("Did disconnect to user")
    }
}
