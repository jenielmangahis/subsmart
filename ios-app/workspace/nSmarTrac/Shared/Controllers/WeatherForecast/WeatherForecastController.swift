//
//  WeatherForecastController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 09/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import CoreLocation
import FontAwesome_swift
import Kingfisher
import MapKit
import SideMenu

class WeatherForecastController: UIViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var menuButtonItem: UIBarButtonItem!
    @IBOutlet var homeButtonItem: UIBarButtonItem!
    @IBOutlet var chatButtonItem: UIBarButtonItem!
    @IBOutlet var inboxButtonItem: UIBarButtonItem!
    
    @IBOutlet var locationLabel: UILabel!
    @IBOutlet var weatherLabel: UILabel!
    @IBOutlet var temperatureLabel: UILabel!
    @IBOutlet var todayLabel: UILabel!
    @IBOutlet var todayTempMaxLabel: UILabel!
    @IBOutlet var todayTempMinLabel: UILabel!
    @IBOutlet var tableView: UITableView!
    
    var weather: WeatherResponse!
    var forecast: [Forecast] = []
    


    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initNavBar()
    }
    
    override func viewWillAppear(_ animated: Bool) {
        // reset first
        self.locationLabel.text     = ""
        self.weatherLabel.text      = ""
        self.temperatureLabel.text  = ""
        self.todayLabel.text        = ""
        self.todayTempMaxLabel.text = ""
        self.todayTempMinLabel.text = ""
        
        initWeather()
    }

    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Navigation Bar -
    
    func initNavBar() {
        // setup navBar icons
        menuButtonItem.image = UIImage.fontAwesomeIcon(name: .bars, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        homeButtonItem.image = UIImage.fontAwesomeIcon(name: .home, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        chatButtonItem.image = UIImage.fontAwesomeIcon(name: .comments, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        inboxButtonItem.image = UIImage.fontAwesomeIcon(name: .envelope, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        
        // setup SideMenu
        let storyboard = UIStoryboard(name: "Main", bundle: Bundle.main)
        SideMenuManager.default.leftMenuNavigationController = storyboard.instantiateViewController(withIdentifier: "sb_SideMenu") as? SideMenuNavigationController
        SideMenuManager.default.rightMenuNavigationController = nil
        SideMenuManager.default.addPanGestureToPresent(toView: self.navigationController!.navigationBar)
        SideMenuManager.default.addScreenEdgePanGesturesToPresent(toView: self.navigationController!.view)
        SideMenuManager.default.leftMenuNavigationController?.statusBarEndAlpha = 0
        
        // set title
        self.navigationItem.title = "Weather Forecast"
    }
    
    // MARK: - Action -

    @IBAction func sideMenuTapped(_ sender: Any) {
        self.present(SideMenuManager.default.leftMenuNavigationController!, animated: true, completion: nil)
    }
    
    @IBAction func homeButtonTapped(_ sender: Any) {
        App.shared.selectedMenu = .Home
        NotificationCenter.default.post(name: Notifications.didSwitchLeftMenu, object: self, userInfo: nil)
    }
    
    @IBAction func chatButtonTapped(_ sender: Any) {
        App.shared.selectedMenu = .Chat
        NotificationCenter.default.post(name: Notifications.didSwitchLeftMenu, object: self, userInfo: nil)
    }
    
    @IBAction func messagesButtonTapped(_ sender: Any) {
        App.shared.selectedMenu = .Messages
        NotificationCenter.default.post(name: Notifications.didSwitchLeftMenu, object: self, userInfo: nil)
    }
    
    // MARK: - Functions -
    
    func initWeather() {
        // get current weather
        if App.shared.userLocation != nil {
            App.shared.api.getWeatherByLocation(App.shared.userLocation!.coordinate) { (result, error) in
                if let e = error {
                    return print(e.localizedDescription)
                }
                
                self.weather = WeatherResponse(JSON: result!.toJSON())
                
                // set values
                self.locationLabel.text     = self.weather.name
                self.weatherLabel.text      = self.weather.weather.first?.main
                self.temperatureLabel.text  = self.convertToDegreeFahrenheit(kelvin: self.weather.main.temp)
                self.todayLabel.text        = "\(self.getReadableDate(timeStamp: Double(self.weather.dt)) ?? "")  TODAY"
                self.todayTempMaxLabel.text = self.convertToFahrenheit(kelvin: self.weather.main.temp_max)
                self.todayTempMinLabel.text = self.convertToFahrenheit(kelvin: self.weather.main.temp_min)
            }
        }
        
        // get forcast weather
        if App.shared.userLocation != nil {
            App.shared.api.getWeatherForecast(App.shared.userLocation!.coordinate) { (list, error) in
                if let e = error {
                    return print(e.localizedDescription)
                }
                
                self.forecast = list
                self.tableView.reloadData()
            }
        }
    }
    
    func getReadableDate(timeStamp: TimeInterval) -> String? {
        let date = Date(timeIntervalSince1970: timeStamp)
        let dateFormatter = DateFormatter()
        dateFormatter.dateFormat = "EEEE"
        
        return dateFormatter.string(from: date)
    }
    
    func convertToCelsius(fahrenheit: Double) -> String {
        let temp = Int(5.0 / 9.0 * (fahrenheit - 32.0))
        return temp.stringValue //"\(temp)°C"
    }
    
    func convertToCelsius(kelvin: Double) -> String {
        return Int(kelvin - 273.15).stringValue //"\(Int(kelvin - 273.15))°C"
    }
    
    func convertToDegreeCelsius(kelvin: Double) -> String {
        return "\(Int(kelvin - 273.15))°"
    }
    
    func convertToFahrenheit(kelvin: Double) -> String {
        return Int(1.8 * (kelvin - 273.15) + 32).stringValue //"\(Int(kelvin - 273.15))°C"
    }
    
    func convertToDegreeFahrenheit(kelvin: Double) -> String {
        return "\(Int(1.8 * (kelvin - 273.15) + 32))°"
    }

}

// MARK: - TableView Datasource -

extension WeatherForecastController: UITableViewDelegate, UITableViewDataSource {
    
    func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return forecast.count-1
    }
    
    func tableView(_ tableView: UITableView, heightForHeaderInSection section: Int) -> CGFloat {
        return 1
    }
    
    func tableView(_ tableView: UITableView, heightForFooterInSection section: Int) -> CGFloat {
        return 1
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        let item = forecast[indexPath.row+1]
        
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath) as! ForecastCell
        cell.day.text = getReadableDate(timeStamp: Double(item.dt))
        cell.icon.kf.setImage(with: URL(string: "http://openweathermap.org/img/w/" + (item.weather.first?.icon)! + ".png"))
        cell.tempMax.text = convertToFahrenheit(kelvin: item.temp.max)
        cell.tempMin.text = convertToFahrenheit(kelvin: item.temp.min)
        
        return cell
    }
}

// MARK: - Cells -

class ForecastCell: UITableViewCell {
    @IBOutlet var day: UILabel!
    @IBOutlet var icon: UIImageView!
    @IBOutlet var tempMax: UILabel!
    @IBOutlet var tempMin: UILabel!
}
