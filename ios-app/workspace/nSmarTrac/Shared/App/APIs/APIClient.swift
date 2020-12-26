//
//  APIClient.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 06/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import Alamofire

let baseURL = "https://nsmartrac.com/api/v1/"

public struct APIError {
    static let domain = "com.nsmartrac.error"
}

open class AppService {
    public init() {}
}

public class APIClient: AppService {
    
    struct apiURL {
        static let login                            = baseURL + "Login.php"
        static let address                          = baseURL + "Address.php"
        static let businessProfile                  = baseURL + "BusinessProfile.php"
        static let cards                            = baseURL + "Cards.php"
        static let contact                          = baseURL + "Contact.php"
        static let customer                         = baseURL + "Customer.php"
        static let customerGroup                    = baseURL + "CustomerGroup.php"
        static let customerSource                   = baseURL + "CustomerSource.php"
        static let eSign                            = baseURL + "ESign.php"
        static let eSignRecipients                  = baseURL + "ESignRecipients.php"
        static let estimates                        = baseURL + "Estimates.php"
        static let estimateItems                    = baseURL + "EstimateItems.php"
        static let estimatesSetting                 = baseURL + "EstimatesSetting.php"
        static let events                           = baseURL + "Events.php"
        static let eventSetting                     = baseURL + "EventSetting.php"
        static let files                            = baseURL + "Files.php"
        static let folders                          = baseURL + "Folders.php"
        static let homeBulletin                     = baseURL + "HomeBulletin.php"
        static let item                             = baseURL + "Item.php"
        static let itemLocation                     = baseURL + "ItemLocation.php"
        static let invoice                          = baseURL + "Invoice.php"
        static let invoiceItems                     = baseURL + "InvoiceItems.php"
        static let invoiceSetting                   = baseURL + "InvoiceSetting.php"
        static let lead                             = baseURL + "Lead.php"
        static let notificationSetting              = baseURL + "NotificationSetting.php"
        static let payments                         = baseURL + "Payments.php"
        static let phone                            = baseURL + "Phone.php"
        static let portfolio                        = baseURL + "PortfolioPictures.php"
        static let quickLink                        = baseURL + "QuickLinks.php"
        static let role                             = baseURL + "Role.php"
        static let schedule                         = baseURL + "Schedule.php"
        static let task                             = baseURL + "Task.php"
        static let taskParticipant                  = baseURL + "TaskParticipant.php"
        static let taxRate                          = baseURL + "TaxRate.php"
        static let timesheet                        = baseURL + "Timesheet.php"
        static let timesheetAttendance              = baseURL + "TimesheetAttendance.php"
        static let timesheetDepartments             = baseURL + "TimesheetDepartments.php"
        static let timesheetDepartmentMembers       = baseURL + "TimesheetDepartmentMembers.php"
        static let timesheetJobCodes                = baseURL + "TimesheetJobCodes.php"
        static let timesheetJobSites                = baseURL + "TimesheetJobSites.php"
        static let timesheetLeave                   = baseURL + "TimesheetLeave.php"
        static let timesheetLogs                    = baseURL + "TimesheetLog.php"
        static let timesheetNotificationSettings    = baseURL + "TimesheetNotificationSettings.php"
        static let timesheetPTO                     = baseURL + "TimesheetPTO.php"
        static let timesheetReport                  = baseURL + "TimesheetReport.php"
        static let timesheetSettings                = baseURL + "TimesheetSettings.php"
        static let timesheetTeamMembers             = baseURL + "TimesheetTeamMembers.php"
        static let trac360Circle                    = baseURL + "Trac360Circle.php"
        static let trac360People                    = baseURL + "Trac360People.php"
        static let trac360Places                    = baseURL + "Trac360Places.php"
        static let user                             = baseURL + "User.php"
        static let userSign                         = baseURL + "UserSign.php"
        static let vendor                           = baseURL + "Vendor.php"
        static let workOrder                        = baseURL + "WorkOrder.php"
        static let workOrderItems                   = baseURL + "WorkOrderItems.php"
        static let workOrderSetting                 = baseURL + "WorkOrderSetting.php"
        static let workOrderTemplate                = baseURL + "WorkOrderTemplate.php"
        static let workOrderTypes                   = baseURL + "WorkOrderTypes.php"
        
    }
    
    let headers: HTTPHeaders = [
        "Content-Type": "application/json"
    ]
    
    public override init() {
    }
    
    func getAuthHeaders() -> HTTPHeaders {
        let headers: HTTPHeaders = ["Content-Type": "application/json",
                                    "Authorization": "Bearer " //+ App.shared.user.getToken().access_token
        ]
        return headers
    }
    
    func getUploadHeaders() -> HTTPHeaders {
        let headers: HTTPHeaders = ["Content-type": "multipart/form-data",
                                    "Content-Disposition" : "form-data"]
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
        
        // Create a session manager
        let manager = Alamofire.SessionManager(
            configuration: URLSessionConfiguration.default,
            serverTrustPolicyManager: ServerTrustPolicyManager(policies: serverTrustPolicies)
        )
        
        // Create a request retrier
        let requestRetrier = NetworkRequestRetrier()
        manager.retrier = requestRetrier
        
        return manager
    }()
}
