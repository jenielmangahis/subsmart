//
//  SignOtherController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 19/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import FontAwesome_swift
import PDFKit
import SVProgressHUD

class SignOtherController: UIViewController {

    // MARK: - Properties -
    
    @IBOutlet var recipientsCollectionView: UICollectionView!
    @IBOutlet var fieldsCollectionView: UICollectionView!
    @IBOutlet var pdfView: PDFView!
    
    var documents: [PDFDocument] = []
    var selectedRecipient: ESignRecipient?
    var item: ESign!
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initCollectionViewLayout()
        initPDFView()
                
        self.title = "Add Fields"
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func initPDFView() {
        // display
        pdfView.autoScales          = true
        pdfView.displayDirection    = .vertical
        pdfView.displayMode         = .singlePageContinuous
        pdfView.document            = PdfHelper.merge(documents)
    }
    
    // MARK: - Actions -
    
    @IBAction func moreButtonTapped(_ sender: Any) {
    }
    
    @IBAction func nextButtonTapped(_ sender: Any) {
        // go to review screen
        let viewController = self.storyboard?.instantiateViewController(withIdentifier: "sb_ReviewSigningController") as? ReviewSigningController
        viewController?.item = self.item
        self.navigationController?.pushViewController(viewController!, animated: true)
    }
    
}

// MARK: - UICollectionView Datasource -

extension SignOtherController: UICollectionViewDelegate, UICollectionViewDataSource {
    
    func initCollectionViewLayout() {
        let layout = UICollectionViewFlowLayout()
        layout.scrollDirection = .horizontal
        layout.itemSize = CGSize(width: 80, height: 100)
        layout.sectionInset = UIEdgeInsets(top: 20, left: 20, bottom: 20, right: 20)
        layout.minimumLineSpacing = 0
        layout.minimumInteritemSpacing = 20
        self.recipientsCollectionView.setCollectionViewLayout(layout, animated: true)
        self.fieldsCollectionView.setCollectionViewLayout(layout, animated: true)
        
        // set default recipient
        self.selectedRecipient = self.item.recipients.first!
        // reload collectionView
        self.recipientsCollectionView.reloadData()
    }
    
    func collectionView(_ collectionView: UICollectionView, numberOfItemsInSection section: Int) -> Int {
        if collectionView == recipientsCollectionView {
            return item.recipients.count
        }
        return 8
    }
    
    func collectionView(_ collectionView: UICollectionView, cellForItemAt indexPath: IndexPath) -> UICollectionViewCell {
        if collectionView == recipientsCollectionView {
            // recipient cell
            let data = item.recipients[indexPath.row]
            
            // get initials
            var initials = ""
            var shortName = ""
            let name = data.name.components(separatedBy: " ")
            if let firstLetter = name.first?.first,
               let secondLetter = name.last?.first {
                initials = "\(firstLetter)\(secondLetter)"
                shortName = "\(name.first!) \(secondLetter)."
            }
            
            // Configure the cell...
            let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "Cell", for: indexPath) as! ESignRecipientCell
            cell.initial.backgroundColor    = UIColor(hex: data.color)
            cell.initial.cornerRadius       = 20
            cell.initial.text               = initials
            cell.name.text                  = shortName
            
            // check
            if let selected = selectedRecipient {
                // check
                if selected == data {
                    cell.initial.font = UIFont.robotoBoldFont(ofSize: 15)
                    cell.name.font = UIFont.robotoBoldFont(ofSize: 12)
                } else {
                    cell.initial.font = UIFont.robotoFont(ofSize: 15)
                    cell.name.font = UIFont.robotoFont(ofSize: 12)
                }
            }
            
            return cell
            
        } else {
            // field cell
            let titles = ["Signature", "Initials", "Date", "Textbox", "Name", "Checkbox", "Title", "Company"]
            let icons: [FontAwesome] = [.penAlt, .font, .calendar, .text, .user, .checkSquare, .briefcase, .building]
            let icon = UIImage.fontAwesomeIcon(name: icons[indexPath.row], style: (indexPath.row == 5) ? .regular : .solid, textColor: App.shared.iconColor, size: CGSize(width: 24, height: 24))
            
            // Configure the cell...
            let cell = collectionView.dequeueReusableCell(withReuseIdentifier: "Cell", for: indexPath) as! ESignFieldCell
            cell.iconView.backgroundColor = UIColor(hex: selectedRecipient!.color)
            cell.icon.image = icon
            cell.name.text = titles[indexPath.row]
            
            return cell
        }
    }
    
    func collectionView(_ collectionView: UICollectionView, didSelectItemAt indexPath: IndexPath) {
        if collectionView == recipientsCollectionView {
            selectedRecipient = item.recipients[indexPath.row]
            self.recipientsCollectionView.reloadData()
            self.fieldsCollectionView.reloadData()
        } else {
            
        }
    }
}

// MARK: - Cells -

class ESignRecipientCell: UICollectionViewCell {
    @IBOutlet var initial: UILabel!
    @IBOutlet var name: UILabel!
}

class ESignFieldCell: UICollectionViewCell {
    @IBOutlet var iconView: UIView!
    @IBOutlet var icon: UIImageView!
    @IBOutlet var name: UILabel!
}
