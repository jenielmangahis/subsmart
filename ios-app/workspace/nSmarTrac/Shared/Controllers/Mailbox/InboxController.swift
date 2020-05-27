//
//  InboxController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 25/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Floaty
import FontAwesome_swift

class InboxController: UIViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var searchView: UIView!
    @IBOutlet var textField: UITextField!
    @IBOutlet var tableView: UITableView!
    
    @IBOutlet var tableTop: NSLayoutConstraint!
    
    var indicator = UIActivityIndicatorView()
    var refreshControl = UIRefreshControl()
    var floaty = Floaty()
    
    //var invoices: [Invoice] = []
    //var filteredItems: [Invoice] = []
    var selectedIndexPath: [IndexPath] = []
    var isFiltered: Bool = false
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initFAB()
        initSearchView()
        setupIndicator()
        setupRefreshControl()
        
        self.title = "Inbox"
    }
    
    override func viewWillAppear(_ animated: Bool) {
        self.selectedIndexPath.removeAll()
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Search View -
    
    func initSearchView() {
        searchView.backgroundColor = .groupTableViewBackground
        searchView.isHidden = false
        tableTop.constant = 0.0
        
        let leftView = UIView(frame: CGRect(x: 0, y: 7, width: 33, height: 20))
        leftView.backgroundColor = .clear
        
        let imageView = UIImageView(frame: CGRect(x: 13, y: 0, width: 20, height: 20))
        imageView.image = UIImage.fontAwesomeIcon(name: .search, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 20, height: 20))
        imageView.contentMode = .scaleAspectFit
        leftView.addSubview(imageView)
        
        
        let rightView = UIView(frame: CGRect(x: 0, y: 7, width: 24, height: 20))
        rightView.backgroundColor = .clear
        
        let cancelButton = UIButton(frame: CGRect(x: 0, y: 0, width: 20, height: 20))
        cancelButton.setImage(UIImage.fontAwesomeIcon(name: .times, style: .solid, textColor: AppTheme.defaultColor, size: CGSize(width: 20, height: 20)), for: .normal)
        //cancelButton.addTarget(self, action: #selector(cancelButtonTapped(_:)), for: .touchUpInside)
        rightView.addSubview(cancelButton)
        
        textField.borderStyle = .roundedRect
        textField.font = UIFont.robotoFont(ofSize: 13)
        textField.leftViewMode = .always
        textField.leftView = leftView
        textField.rightViewMode = .always
        textField.rightView = rightView
        textField.textColor = UIColor(rgb: 0x545454)
        textField.addTarget(self, action: #selector(searchItem(_ :)), for: .editingChanged)
        textField.addTarget(self, action: #selector(textFieldShouldReturn(_ :)), for: .editingDidEnd)
    }
    
    // MARK: - UITextField Delegate -
    
    @objc func textFieldShouldReturn(_ textField: UITextField) -> Bool {
        textField.resignFirstResponder()
        return true
    }
    
    // MARK: - Filter Array -
    
    @objc func searchItem(_ textfield: UITextField) {
        /*let searchText = textfield.text!
        
        filteredItems = invoices.filter({ item in
            return (item.customer_name.lowercased().contains(searchText.lowercased()) ||
                    item.date.lowercased().contains(searchText.lowercased()) ||
                    item.invoice_code.lowercased().contains(searchText.lowercased()))
        })*/
        
        self.isFiltered = true
        self.tableView.reloadData()
    }
    
    // MARK: - Activity Indicator -
    
    func setupIndicator() {
        // init activity indicator
        self.indicator = UIActivityIndicatorView(frame: CGRect(x: 0, y: 0, width: 40, height: 40))
        self.indicator.style = UIActivityIndicatorView.Style.medium
        self.indicator.center = self.view.center
        self.view.addSubview(indicator)
        self.tableView.backgroundView = indicator
        //self.indicator.startAnimating()
    }
    
    // MARK: - Refresh Control -
    
    func setupRefreshControl() {
        // init refresh control
        self.tableView.refreshControl = refreshControl
        self.refreshControl.addTarget(self, action: #selector(refreshData(_:)), for: .valueChanged)
        self.refreshControl.attributedTitle = NSAttributedString(string: "Fetching Data ...")
    }
    
    @objc func refreshData(_ sender: Any) {
        
    }
    
    // MARK: - Notification -
    
    @objc func reloadData(_ notification: Notification) {
        self.refreshData(notification)
    }

}

// MARK: - TableView Datasource -

extension InboxController: UITableViewDelegate, UITableViewDataSource {
    
    func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return 3
    }
    
    func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 1
    }
    
    func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        return 1
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        //let item = isFiltered ? filteredItems[indexPath.section] : invoices[indexPath.section]
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        
        // remove other views
        cell.contentView.subviews.forEach {
            $0.removeFromSuperview()
        }
        
        // lastMessage view
        let lastMsg = Utils.createInboxView(0, 0, Int(Device.width-40), 50, "John Doe", "Your Subject Here", "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.", "4:12 PM")
        cell.contentView.addSubview(lastMsg)
        
        // selected
        cell.contentView.backgroundColor = selectedIndexPath.contains(indexPath) ? UIColor(rgb: 0xCDEDB6) : .white
        
        return cell
    }
    
    // MARK: - Protocols -
    
    @objc func didButtonTapped(_ sender: UIButton) {
        
    }
}

// MARK: - Floaty Delegate -

extension InboxController: FloatyDelegate, UIGestureRecognizerDelegate {
    
    func initFAB() {
        
        // init
        floaty.fabDelegate  = self
        floaty.sticky       = true
        floaty.buttonColor  = AppTheme.defaultColor
        floaty.buttonImage  = UIImage.fontAwesomeIcon(name: .edit, style: .solid, textColor: .white, size: CGSize(width: 30, height: 30))
        
        // add action
        let tap = UITapGestureRecognizer(target: self, action: #selector(handleNewMailButton(_:)))
        tap.delegate = self
        floaty.addGestureRecognizer(tap)
        
        self.view.addSubview(floaty)
    }
    
    // new mail action
    @objc func handleNewMailButton(_ gestureRecognizer: UITapGestureRecognizer) {
        
    }
}
