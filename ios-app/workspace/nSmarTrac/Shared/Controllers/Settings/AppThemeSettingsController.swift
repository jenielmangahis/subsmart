//
//  AppThemeSettingsController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 03/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class AppThemeSettingsController: UIViewController {

    // MARK: - Properties -
    
    @IBOutlet var collectionView: UICollectionView!

    let images = ["img-bgHome.jpeg", "img-bgHome2.jpeg", "img-bgHome3.jpeg", "img-bgHome4.jpeg", "img-bgHome5.jpeg", "img-bgHome6.jpeg", "img-bgHome7.jpeg", "img-bgHome8.jpeg", "img-bgHome9.jpeg", "img-bgHome10.jpeg", "img-bgHome11.jpeg", "img-bgHome12.jpeg", "img-bgHome13.jpeg", "img-bgHome14.jpeg", "img-bgHome15.jpeg", "img-bgHome16.jpeg", "img-bgHome17.jpeg", "img-bgHome18.jpeg", "img-bgHome19.jpeg", "img-bgHome20.jpeg", "img-bgHome21.jpeg", "img-bgHome22.jpeg", "img-bgHome23.jpeg", "img-bgHome24.jpeg"]
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initCollectionViewLayout()
                
        self.title = "Select App Theme"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func initCollectionViewLayout() {
        let layout = UICollectionViewFlowLayout()
        layout.scrollDirection = .vertical
        layout.itemSize = CGSize(width: (Device.width)/2, height: 100)
        layout.sectionInset = UIEdgeInsets(top: 0, left: 0, bottom: 0, right: 0)
        layout.minimumLineSpacing = 0
        layout.minimumInteritemSpacing = 0
        self.collectionView.setCollectionViewLayout(layout, animated: true)
    }

}

// MARK: - UICollectionView Datasource -

extension AppThemeSettingsController: UICollectionViewDelegate, UICollectionViewDataSource {
    
    func collectionView(_ collectionView: UICollectionView, numberOfItemsInSection section: Int) -> Int {
        return images.count + 1
    }
    
    func collectionView(_ collectionView: UICollectionView, cellForItemAt indexPath: IndexPath) -> UICollectionViewCell {
        // get row
        let row = indexPath.row
        
        // check
        if images.count > 0 && row >= 0 && row <= images.count-1 {
            // get the selected image from userDefaults
            let selectedImage = UserDefaults.standard.string(forKey: "HOME_SCREEN_BG")
            // Configure the cell...
            let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "Cell", for: indexPath) as! AppThemeCell
            cell.imageView.image = UIImage(named: images[row])
            cell.themeName.isHidden = (indexPath.row == 7) ? false : true
            
            // check
            if selectedImage == images[indexPath.row] {
                cell.contentView.borders(for: [.all], width: 5, color: .white)
            }
            return cell
            
        } else {
            // Configure the cell...
            let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "AddThemeCell", for: indexPath) as! AddThemeCell
            cell.btnAdd.setImage(UIImage.fontAwesomeIcon(name: .plus, style: .regular, textColor: .lightGray, size: CGSize(width: 40, height: 40)), for: .normal)
            cell.btnAdd.addTarget(self, action: #selector(presentImagePicker(_:)), for: .touchUpInside)
            return cell
        }
    }
    
    func collectionView(_ collectionView: UICollectionView, didSelectItemAt indexPath: IndexPath) {
        // get row
        let row = indexPath.row
        // check row
        if images.count > 0 && row >= 0 && row <= images.count-1 {
            let imageName = images[row]
            UserDefaults.standard.setImage(image: nil, forKey: "CUSTOM_HOME_SCREEN_BG")
            UserDefaults.standard.set(imageName, forKey: "HOME_SCREEN_BG")
            UserDefaults.standard.synchronize()
            
            self.collectionView.reloadData()
        }
    }
}

// MARK: - UIImagePickerControllerDelegate -

extension AppThemeSettingsController: UIImagePickerControllerDelegate, UINavigationControllerDelegate {
    
    @objc func presentImagePicker(_ sender: Any) {
        if UIImagePickerController.isSourceTypeAvailable(.photoLibrary) {
            let imagePicker = UIImagePickerController()
            imagePicker.delegate = self
            imagePicker.sourceType = .photoLibrary
            imagePicker.allowsEditing = false
            present(imagePicker, animated: true, completion: nil)
        }
    }
    
    func imagePickerController(_ picker: UIImagePickerController, didFinishPickingMediaWithInfo info: [UIImagePickerController.InfoKey : Any]) {
        // close picker
        dismiss(animated:true, completion: nil)
        
        // get image
        guard let image = info[.originalImage] as? UIImage else { return }
        
        // save to user defaults
        UserDefaults.standard.setImage(image: image, forKey: "CUSTOM_HOME_SCREEN_BG")
        UserDefaults.standard.synchronize()
    }
    
    func imagePickerControllerDidCancel(_ picker: UIImagePickerController) {
        dismiss(animated:true, completion: nil)
    }
}

// MARK: - Cells -

class AppThemeCell: UICollectionViewCell {
    @IBOutlet var themeName: UILabel!
    @IBOutlet var imageView: UIImageView!
}

class AddThemeCell: UICollectionViewCell {
    @IBOutlet var btnAdd: UIButton!
}
