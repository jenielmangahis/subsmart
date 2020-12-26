//
//  Trac360PlacesController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 11/28/20.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

class Trac360PlacesController: UITableViewController {
    
    // MARK: - Properties -
    
    var items: [Trac360Place] = []
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        setupIndicator()
        setupRefreshControl()
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Load data -
    
    func loadData() {
        // handle nil
        if let selectedCircle = App.shared.selectedTrac360Circle {
            // assign
            self.items = selectedCircle.places
            self.tableView.backgroundView = nil
            self.tableView.reloadData()
            
        } else {
            // get my circles
            App.shared.api.getTrac360Circles() { (list, error) in
                if let e = error {
                    return print(e.localizedDescription)
                }
                
                // save to cache
                let data = NSKeyedArchiver.archivedData(withRootObject: list)
                UserDefaults.standard.set(data, forKey: UDKeys.cachedTrac360Circles.envPrefixed)
                UserDefaults.standard.synchronize()
                
                // assign
                App.shared.myTrac360Circle = list
                App.shared.selectedTrac360Circle = (list.count > 0) ? list.first! : nil
                
                // handle nil
                if let circle = list.first {
                    // assign
                    self.items = circle.places
                    self.tableView.backgroundView = nil
                    self.tableView.reloadData()
                }
            }
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
        let indicator = UIActivityIndicatorView(frame: CGRect(x: 0, y: 0, width: 40, height: 40))
        indicator.style = UIActivityIndicatorView.Style.medium
        indicator.center = self.view.center
        self.view.addSubview(indicator)
        self.tableView.backgroundView = indicator
        indicator.startAnimating()
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
        return items.count + 1
    }
    
    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        // check
        if indexPath.row == items.count {
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "AddCell", for: indexPath) as! AddCell
            return cell
        }
        
        // get item
        let item = items[indexPath.row]
        
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath) as! PlaceCell
        cell.icon.image = UIImage.fontAwesomeIcon(name: .mapMarkerAlt, style: .solid, textColor: .purple, size: CGSize(width: 24, height: 24))
        cell.name.text = item.address
        
        
        return cell
    }
    
    override func tableView(_ tableView: UITableView, didSelectRowAt indexPath: IndexPath) {
        
    }

}

// MARK: - TableViewCell -

class PlaceCell: UITableViewCell {
    @IBOutlet var icon: UIImageView!
    @IBOutlet var name: UILabel!
    @IBOutlet var btnAlert: UIButton!
}
