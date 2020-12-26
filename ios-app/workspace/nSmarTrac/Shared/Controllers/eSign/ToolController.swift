//
//  ToolController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 01/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import FontAwesome_swift

class ToolController: UICollectionViewController {
    
    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initCollectionViewLayout()
    }
    
    // MARK: - Functions -
    
    func initCollectionViewLayout() {
        let layout = UICollectionViewFlowLayout()
        layout.scrollDirection = .vertical
        layout.itemSize = CGSize(width: 80, height: 60)
        layout.sectionInset = UIEdgeInsets(top: 0, left: 0, bottom: 0, right: 0)
        layout.minimumLineSpacing = 0
        layout.minimumInteritemSpacing = 0
        self.collectionView.setCollectionViewLayout(layout, animated: true)
    }

    // MARK: - UICollectionViewDataSource -

    override func numberOfSections(in collectionView: UICollectionView) -> Int {
        return 1
    }


    override func collectionView(_ collectionView: UICollectionView, numberOfItemsInSection section: Int) -> Int {
        return 11
    }

    override func collectionView(_ collectionView: UICollectionView, cellForItemAt indexPath: IndexPath) -> UICollectionViewCell {
        // field cell
        let titles = ["Signature", "Initials", "Date Signed", "Name", "First Name", "Last Name", "Email Address", "Company", "Title", "Text", "Checkbox"]
        let icons: [FontAwesome] = [.penAlt, .font, .calendar, .user, .user, .user, .envelope, .building, .briefcase, .text, .checkSquare]
        let icon = UIImage.fontAwesomeIcon(name: icons[indexPath.row], style: (indexPath.row == 10) ? .regular : .solid, textColor: App.shared.iconColor, size: CGSize(width: 24, height: 24))
        
        // Configure the cell...
        let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "Cell", for: indexPath) as! ESignFieldCell
        cell.icon.image = icon
        cell.name.text = titles[indexPath.row]
        
        return cell
    }
    
    override func collectionView(_ collectionView: UICollectionView, didSelectItemAt indexPath: IndexPath) {
        switch indexPath.row {
            case 0:
                NotificationCenter.default.post(name: Notifications.willAddSignature, object: self, userInfo: nil)
            case 1:
                NotificationCenter.default.post(name: Notifications.willAddInitials, object: self, userInfo: nil)
            case 2:
                NotificationCenter.default.post(name: Notifications.willAddDate, object: self, userInfo: nil)
            case 3:
                NotificationCenter.default.post(name: Notifications.willAddName, object: self, userInfo: nil)
            case 4:
                NotificationCenter.default.post(name: Notifications.willAddFirstName, object: self, userInfo: nil)
            case 5:
                NotificationCenter.default.post(name: Notifications.willAddLastName, object: self, userInfo: nil)
            case 6:
                NotificationCenter.default.post(name: Notifications.willAddEmail, object: self, userInfo: nil)
            case 7:
                NotificationCenter.default.post(name: Notifications.willAddCompany, object: self, userInfo: nil)
            case 8:
                NotificationCenter.default.post(name: Notifications.willAddTitle, object: self, userInfo: nil)
            case 9:
                NotificationCenter.default.post(name: Notifications.willAddText, object: self, userInfo: nil)
            case 10:
                NotificationCenter.default.post(name: Notifications.willAddCheckbox, object: self, userInfo: nil)
            default:
                break
        }
    }

}
