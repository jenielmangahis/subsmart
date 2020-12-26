//
//  CardsController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 02/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Floaty

class CardsController: UITableViewController {

    // MARK: - Properties -
    
    var indicator = UIActivityIndicatorView()
    var floaty = Floaty()
    
    var items: [Card] = []
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initFAB()
        setupIndicator()
        setupRefreshControl()
    }
    
    override func viewWillAppear(_ animated: Bool) {
        self.parent?.navigationItem.title = "Payment Methods"
        self.loadData()
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Load data -
    
    func loadData() {
        // call api
        App.shared.api.getCards() { (list, error) in
            if let e = error {
                return self.addErrorView(with: e)
            }
            
            self.items = list
            self.tableView.backgroundView = nil
            self.tableView.reloadData()
        }
    }
    
    // MARK: - ErrorView -

    private lazy var errorView: BasicErrorView = {
        let errorView = BasicErrorView()
        errorView.translatesAutoresizingMaskIntoConstraints = false
        return errorView
    }()
    
    func addErrorView(with error: Error) {
        DispatchQueue.main.async { [weak self] in
            guard let self = self else { return }
            self.tableView.backgroundView?.addSubview(self.errorView)
            let safeAreaLayoutGuide = self.view.safeAreaLayoutGuide
            NSLayoutConstraint.activate([
                self.errorView.leadingAnchor.constraint(equalTo: safeAreaLayoutGuide.leadingAnchor),
                self.errorView.trailingAnchor.constraint(equalTo: safeAreaLayoutGuide.trailingAnchor),
                self.errorView.topAnchor.constraint(equalTo: safeAreaLayoutGuide.topAnchor),
                self.errorView.bottomAnchor.constraint(equalTo: safeAreaLayoutGuide.bottomAnchor)
                ])
            self.errorView.displayError(error)
        }
    }

    func removeErrorView() {
        if self.tableView.backgroundView == nil || !self.tableView.backgroundView!.subviews.contains(errorView) {
            return
        }
        DispatchQueue.main.async {
            self.errorView.removeFromSuperview()
        }
    }
    
    // MARK: - Activity Indicator -
    
    func setupIndicator() {
        // init activity indicator
        self.indicator = UIActivityIndicatorView(frame: CGRect(x: 0, y: 0, width: 40, height: 40))
        self.indicator.style = UIActivityIndicatorView.Style.medium
        self.indicator.center = self.view.center
        self.view.addSubview(indicator)
        self.tableView.backgroundView = indicator
        self.indicator.startAnimating()
    }
    
    // MARK: - Refresh Control -
    
    func setupRefreshControl() {
        // init refresh control
        self.refreshControl?.addTarget(self, action: #selector(refreshData(_:)), for: .valueChanged)
        self.refreshControl?.attributedTitle = NSAttributedString(string: "Fetching Data ...")
    }
    
    @objc func refreshData(_ sender: Any) {
        self.refreshControl?.endRefreshing()
        self.removeErrorView()
        self.loadData()
    }
    
    // MARK: - TableView Datasource -
    
    override func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    override func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return items.count
    }
    
    override func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 1
    }
    
    override func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        return 1
    }
    
    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let item = items[indexPath.row]
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
        
        // remove other views
        cell.contentView.subviews.forEach {
            $0.removeFromSuperview()
        }
        
        // nameButton
        let nameButton = Utils.createPurpleButton(28, 12, Int(Device.width-40), "\(item.card_type) ****5898 (expires \(item.expiration)", hasArrow: false)
        cell.contentView.addSubview(nameButton)
        
        // topLeft view
        let topLeft = Utils.createView(20, 50, Int((Device.width-40)/2), 50, "CARD HOLDER", item.card_holder, [.top, .right])
        cell.contentView.addSubview(topLeft)
        
        // topRight view
        let topRight = Utils.createView(Int(Device.width/2), 50, Int((Device.width-40)/2), 50, "PRIMARY", item.is_default ? "Yes" : "", [.top])
        cell.contentView.addSubview(topRight)
        
        // bottom border
        let bottomBorder = Utils.createBottomBorder(100)
        cell.contentView.addSubview(bottomBorder)
        
        return cell
    }

}

// MARK: - Floaty Delegate -

extension CardsController: FloatyDelegate {
    
    func initFAB() {
        
        // init
        floaty.fabDelegate  = self
        floaty.sticky       = true
        floaty.buttonColor  = .greenColor
        floaty.buttonImage  = UIImage.fontAwesomeIcon(name: .plus, style: .solid, textColor: .white, size: CGSize(width: 30, height: 30))
        floaty.paddingY     = 90
        
        let tap = UITapGestureRecognizer(target: self, action: #selector(addButtonClick(_:)))
        floaty.addGestureRecognizer(tap)
        
        self.view.addSubview(floaty)
    }
    
    @objc func addButtonClick(_ sender: Any) {
        self.pushTo(storyBoard: "Others", identifier: "sb_AddCardController")
    }
}
