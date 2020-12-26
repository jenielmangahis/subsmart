//
//  PortfolioPicturesController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 01/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Alamofire
import DLRadioButton
import FontAwesome_swift
import ImagePicker
import Kingfisher
import SVProgressHUD
import TLPhotoPicker

class PortfolioPicturesController: UIViewController {

    // MARK: - Properties -
    
    @IBOutlet var collectionView: UICollectionView!
    
    var items: [Portfolio] = []
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initCollectionViewLayout()
        loadData()
                
        self.title = "Portfolio Pictures"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Load data -
     
    func loadData() {
        // call api
        SVProgressHUD.show(withStatus: "Loading...")
        App.shared.api.getPortfolios() { (list, error) in
            SVProgressHUD.dismiss()
            if let e = error {
                return print(e.localizedDescription)
            }
            
            self.items = list
            self.collectionView.reloadData()
        }
    }
    
    // MARK: - Actions -
    
    @IBAction func uploadButtonTapped(_ sender: Any) {
        presentImagePicker()
        //presentMultiImagePicker()
    }

}

// MARK: - UICollectionView Datasource -

extension PortfolioPicturesController: UICollectionViewDelegate, UICollectionViewDataSource {
    
    func initCollectionViewLayout() {
        let layout = UICollectionViewFlowLayout()
        layout.scrollDirection = .vertical
        layout.itemSize = CGSize(width: Device.width-40, height: 200)
        layout.sectionInset = UIEdgeInsets(top: 0, left: 0, bottom: 10, right: 0)
        layout.minimumLineSpacing = 10
        layout.minimumInteritemSpacing = 10
        self.collectionView.setCollectionViewLayout(layout, animated: true)
    }
    
    func collectionView(_ collectionView: UICollectionView, numberOfItemsInSection section: Int) -> Int {
        return items.count
    }
    
    func collectionView(_ collectionView: UICollectionView, cellForItemAt indexPath: IndexPath) -> UICollectionViewCell {
        let row = indexPath.row
        let item = items[row]
        // Configure the cell...
        let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "Cell", for: indexPath) as! PortfolioCell
        cell.imageView.kf.setImage(with: URL(string: item.path))
        cell.btnCancel.setImage(UIImage.fontAwesomeIcon(name: .times, style: .regular, textColor: .white, size: CGSize(width: 18, height: 18)), for: .normal)
        cell.caption.text = item.caption
        
        // add action
        cell.btnCancel.addTarget(self, action: #selector(deletePortfolio(_:)), for: .touchUpInside)
        cell.btnCancel.tag = row
        
        cell.btnEdit.addTarget(self, action: #selector(editCaption(_:)), for: .touchUpInside)
        cell.btnEdit.tag = row
        
        return cell
    }
    
    // MARK: - Protocol -
    
    @objc func deletePortfolio(_ sender: UIButton) {
        // init item
        let item = items[sender.tag]
        
        // delete
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show(withStatus: "Deleting...")
        App.shared.api.deletePortfolio(item.id.intValue){ (success, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
            }
            guard success == true else {
                return SVProgressHUD.showError(withStatus: "Deleting item failed!")
            }
            
            self.items.remove(at: sender.tag)
            self.collectionView.reloadData()
        }
    }
    
    @objc func editCaption(_ sender: UIButton) {
        
    }
}

// MARK: - TLPhotosPickerViewControllerDelegate -

extension PortfolioPicturesController: TLPhotosPickerViewControllerDelegate {
     
    func presentImagePicker() {
        var selectedAssets = [TLPHAsset]()
        
        let viewController = TLPhotosPickerViewController(withTLPHAssets: { assets in
            selectedAssets = assets
            
            // params
            let params = ["company_id": App.shared.companyId]
            
            // create group
            let group = DispatchGroup()
            
            // iterate images
            for asset in assets {
                // enter
                group.enter()
                
                // upload
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show(withStatus: "Uploading...")
                App.shared.api.postPortfolio(asset.fullResolutionImage!, params: params) { (success, error) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.dismiss()
                    guard error == nil else {
                        return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                    }
                    
                    group.leave()
                }
            }
            
            // notify
            group.notify(queue: DispatchQueue.main, execute: {
                SVProgressHUD.showSuccess(withStatus: "Files are uploaded!")
                self.loadData()
            })
            
        }, didCancel: nil)
        viewController.didExceedMaximumNumberOfSelection = { picker in
            //exceed max selection
            SVProgressHUD.showError(withStatus: "You can only upload up to 10 photos.")
        }
        viewController.selectedAssets = selectedAssets
        
        var configure = TLPhotosPickerConfigure()
        configure.numberOfColumn = 2
        configure.maxSelectedAssets = 10
        viewController.configure = configure
        
        self.present(viewController, animated: true, completion: nil)
    }
}

// MARK: - ImagePickerDelegate -

extension PortfolioPicturesController: ImagePickerDelegate {
    
    func presentMultiImagePicker() {
        let config = Configuration()
        config.doneButtonTitle = "Upload"
        config.noImagesTitle = "Sorry! There are no images here!"
        config.recordLocation = false
        config.allowVideoSelection = false

        let imagePicker = ImagePickerController(configuration: config)
        imagePicker.delegate = self

        present(imagePicker, animated: true, completion: nil)
    }
    
    func cancelButtonDidPress(_ imagePicker: ImagePickerController) {
        // close picker
        imagePicker.dismiss(animated: true, completion: nil)
    }

    func wrapperDidPress(_ imagePicker: ImagePickerController, images: [UIImage]) {
        
    }

    func doneButtonDidPress(_ imagePicker: ImagePickerController, images: [UIImage]) {
        // close picker
        imagePicker.dismiss(animated: true, completion: nil)
        
        // params
        let params = ["company_id": App.shared.companyId]
        
        // create group
        let group = DispatchGroup()
        
        // iterate images
        for image in images {
            // enter
            group.enter()
            
            // upload
            SVProgressHUD.setDefaultMaskType(.clear)
            SVProgressHUD.show(withStatus: "Uploading...")
            App.shared.api.postPortfolio(image, params: params) { (success, error) in
                SVProgressHUD.setDefaultMaskType(.none)
                SVProgressHUD.dismiss()
                guard error == nil else {
                    return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                }
                
                group.leave()
            }
        }
        
        // notify
        group.notify(queue: DispatchQueue.main, execute: {
            SVProgressHUD.showSuccess(withStatus: "Files are uploaded!")
            self.loadData()
        })
    }
}

// MARK: - Cells -

class PortfolioCell: UICollectionViewCell {
    @IBOutlet var imageView: UIImageView!
    @IBOutlet var caption: UILabel!
    @IBOutlet var btnCancel: DesignableButton!
    @IBOutlet var btnEdit: DesignableButton!
}
