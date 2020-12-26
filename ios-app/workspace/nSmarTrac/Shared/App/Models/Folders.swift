//
//  Folders.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 29/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import Foundation
import AlamofireJsonToObjects

class FolderResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [Folder] = []
}

class Folder: EVNetworkingObject {
    var folder_id: String = ""
    var folder_name: String = ""
    var parent_id: String = ""
    var descriptionn: String = ""
    var path: String = ""
    var mPath: String = ""
    var type: String = ""
    var permissions: String = ""
    var created_by: String = ""
    var create_date: String = ""
    var password_protection: String = ""
    var password: String = ""
    var company_id: String = ""
    var softdelete: String = ""
    var softdelete_date: String = ""
    var softdelete_by: String = ""
    var category_id: String = ""
    var date_modified: String = ""
    var modified_by: String = ""
    var subfolder: [Folder] = []
    var files: [File] = []
}

class FileResponse: EVNetworkingObject {
    var Status: String!
    var Code: Int = 0
    var Message: String!
    var Data: [File] = []
}

class File: EVNetworkingObject {
    var file_id: String = ""
    var name: String = ""
    var title: String = ""
    var descriptionn: String = ""
    var file_path: String = ""
    var modified: String = ""
    var created: String = ""
    var file_size: String = ""
    var folder_id: String = ""
    var user_id: String = ""
    var alt_text: String = ""
    var attach_to_estimates: String = ""
    var attach_to_invoices: String = ""
    var company_id: String = ""
    var downloads_count: String = ""
    var previews_count: String = ""
    var softdelete: String = ""
    var softdelete_date: String = ""
    var softdelete_by: String = ""
    var category_id: String = ""
}
