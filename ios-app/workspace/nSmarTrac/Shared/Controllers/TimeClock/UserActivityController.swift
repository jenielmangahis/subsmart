//
//  UserActivityController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 21/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import CoreLocation
import DottedLineView
import EzPopup
import FontAwesome_swift
import MapKit
import Material
import SVProgressHUD

class UserActivityController: UITableViewController, MKMapViewDelegate {
    
    // MARK: - Properties -
    
    @IBOutlet var mapView: MKMapView!
    
    let locationManager = CLLocationManager()
    var regionRadius: CLLocationDistance = 200
    var location: CLLocation?
    
    var item: TimesheetTeamMember!
    var items: [TimesheetAttendance] = []
    var annotationColor: UIColor = .lightGray
    
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        loadData()
    }
    
    override func viewDidAppear(_ animated: Bool) {
        checkLocation()
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Functions -
    
    func loadData() {
        // init
        self.title = item.name
        
        // filter
        self.items = item.attendance.filter({ item in
            let date = Date(fromString: item.date_created, format: DateHelper.dateTimeFormatType)!
            let date_created = App.shared.dateFormatter.string(from: date)
            let today = App.shared.dateFormatter.string(from: Date())
            
            return (date_created == today)
        })
        self.tableView.reloadData()
    }
    
    // MARK: -  MKMapView -
    
    func checkLocation() {
        // check if location is on
        if App.shared.userLocation == nil {
            let alertController = UIAlertController(title: "", message: "Please share your location with nSmarTrac.", preferredStyle: .alert)
            let okAction = UIAlertAction(title: "OK", style: .destructive) { (alertAction) -> Void in
                if !CLLocationManager.locationServicesEnabled() {
                    if let url = URL(string: UIApplication.openSettingsURLString) {
                        UIApplication.shared.open(url, options: [:], completionHandler: nil)
                    }
                }
            }
            alertController.addAction(okAction)
            self.present(alertController, animated: true, completion: nil)
        } else {
            // display map
            self.initMap()
        }
    }
    
    func initMap() {
        // init
        self.mapView.delegate = self
        self.mapView.showsUserLocation = false
        
        // check
        if let attendance = item.attendance.first,
           let lastLog = attendance.logs.last {
            
            // explode selected user location
            let userLocation = lastLog.user_location.components(separatedBy: ",")
            
            // create location
            self.location = CLLocation(latitude: userLocation.first!.doubleValue, longitude: userLocation.last!.doubleValue)
            
            // center users's location
            self.centerToLocation(self.location!)
            
            // check if currently active
            if let attendance = item.attendance.first,
               let lastLog = attendance.logs.last {
                
                // check
                if lastLog.action == "Check in" || lastLog.action == "Break out" {
                    self.annotationColor = .greenColor
                } else if lastLog.action == "Check out" {
                    self.annotationColor = .redColor
                } else if lastLog.action == "Break in" {
                    self.annotationColor = .orangeColor
                }
            }
            
            // add annotation
            let annotation = MKPointAnnotation()
            annotation.coordinate = self.location!.coordinate
            self.mapView.addAnnotation(annotation)
        }
    }
    
    func centerToLocation(_ location: CLLocation, regionRadius: CLLocationDistance = 200) {
        let coordinateRegion = MKCoordinateRegion(center: location.coordinate, latitudinalMeters: regionRadius, longitudinalMeters: regionRadius)
        self.mapView.setRegion(coordinateRegion, animated: true)
    }
    
    func mapView(_ mapView: MKMapView, viewFor annotation: MKAnnotation) -> MKAnnotationView? {
        let annotationView = MKAnnotationView(annotation: annotation, reuseIdentifier: "custom pin")
        annotationView.image =  Utils.generateTimeClockAnnotationImage(self.annotationColor)
        annotationView.canShowCallout = true
        return annotationView
    }
    
    // MARK: - TableView Datasource -
    
    override func numberOfSections(in tableView: UITableView) -> Int {
        return 1
    }
    
    override func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return (items.count > 0) ? items.count + 1 : 0
    }
    
    override func tableView(_ tableView: UITableView, heightForRowAt indexPath: IndexPath) -> CGFloat {
        if indexPath.row == 0 {
            return 200
        }
        
        // get proper height
        let entry = items[indexPath.row-1]
        // check status
        if entry.status.intValue == 1 {
            return CGFloat(350 + entry.logs.count * 50)
        }
        return CGFloat(400 + entry.logs.count * 50)
    }
    
    override func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        // check
        if indexPath.row == 0 {
            
            var status = ""
            var color = UIColor.greenColor
            var date: Date?
            var userLocation = ""
            
            // check if currently active
            if let attendance = item.attendance.first,
               let lastLog = attendance.logs.last {
                
                date = App.shared.dateTimeFormatter.date(from: lastLog.date_created)
                userLocation = lastLog.user_location_address
                
                // check
                if lastLog.action == "Check in" || lastLog.action == "Break out" {
                    status = "On the Clock"
                    color = .greenColor
                    
                    // check userLocation
                    if userLocation.isEmpty {
                        userLocation = "Manual Clock In"
                    }
                } else if lastLog.action == "Check out" {
                    status = "Clocked Out"
                    color = .redColor
                    
                    // check userLocation
                    if userLocation.isEmpty {
                        userLocation = "Manual Clock Out"
                    }
                } else if lastLog.action == "Break in" {
                    status = "On Break"
                    color = .orangeColor
                }
            }
            
            // change mapView tint
            self.mapView.tintColor = color
            
            // Configure the cell...
            let cell = tableView.dequeueReusableCell(withIdentifier: "Cell", for: indexPath)
            cell.selectionStyle = .none
            
            // remove other views
            cell.contentView.subviews.forEach {
                $0.removeFromSuperview()
            }
            
            // label
            let label = UILabel()
            label.font = UIFont.robotoBoldFont(ofSize: 16)
            label.textColor = color
            label.text = status
            label.frame.size = label.intrinsicContentSize
            label.frame = CGRect(x: 20, y: 20, width: label.frame.size.width, height: 20)
            cell.contentView.addSubview(label)
            
            // arrow
            let arrow = UIImageView(frame: CGRect(x: 30 + label.frame.size.width, y: 25, width: 10, height: 10))
            arrow.image = UIImage(systemName: "arrow.right")
            arrow.tintColor = .lightGray
            cell.contentView.addSubview(arrow)
            
            // start time
            let timeLabel = UILabel(frame: CGRect(x: 50 + label.frame.size.width, y: 20, width: 100, height: 20))
            timeLabel.font = UIFont.robotoBoldFont(ofSize: 16)
            timeLabel.textColor = color
            timeLabel.text = App.shared.timeFormatter.string(from: date!)
            cell.contentView.addSubview(timeLabel)
            
            // button
            let button = UIButton(frame: CGRect(x: Device.width-100, y: 20, width: 80, height: 20))
            button.cornerRadius = 10
            button.backgroundColor = (status == "Clocked Out") ? .greenColor : .redColor
            button.titleLabel?.font = UIFont.robotoFont(ofSize: 10)
            button.titleLabel?.textColor = .white
            button.setTitle((status == "Clocked Out") ? "Clock In" : "Clock Out", for: .normal)
            button.addTarget(self, action: #selector(manualClockInOut(_:)), for: .touchUpInside)
            cell.contentView.addSubview(button)
            
            // gray line
            let grayLine = createLine(y: 60)
            cell.contentView.addSubview(grayLine)
            
            // last location update
            let label2 = UILabel(frame: CGRect(x: 50, y: 80, width: Int(Device.width)-70, height: 20))
            label2.font = UIFont.robotoFont(ofSize: 12)
            label2.textColor = .lightGray
            label2.text = "Last location update • Just now"
            cell.contentView.addSubview(label2)
            
            // marker
            let marker = UIImageView(frame: CGRect(x: 20, y: 100, width: 20, height: 20))
            // check
            if userLocation == "Manual Clock In" || userLocation == "Manual Clock Out" {
                marker.image = UIImage.fontAwesomeIcon(name: .mapMarkerAltSlash, style: .regular, textColor: .lightGray, size: CGSize(width: 20, height: 20))
            } else {
                marker.image = UIImage.fontAwesomeIcon(name: .mapMarkerAlt, style: .regular, textColor: color, size: CGSize(width: 20, height: 20))
            }
            cell.contentView.addSubview(marker)
            
            // last address detected
            let address = UILabel(frame: CGRect(x: 50, y: 100, width: Int(Device.width)-70, height: 20))
            address.font = UIFont.robotoBoldFont(ofSize: 15)
            address.textColor = .label
            address.text = !userLocation.isEmpty ? userLocation : "Manually Clocked by "
            cell.contentView.addSubview(address)
            
            // accuracy
            let label3 = UILabel(frame: CGRect(x: 50, y: 120, width: Int(Device.width)-70, height: 20))
            label3.font = UIFont.robotoFont(ofSize: 12)
            label3.textColor = .lightGray
            label3.text = "Accuracy • 200ft"
            cell.contentView.addSubview(label3)
            
            // gray line
            let grayLine2 = createLine(y: 180)
            cell.contentView.addSubview(grayLine2)
            
            // earlier today
            let earlier = UILabel(frame: CGRect(x: (Device.width-100)/2, y: 165, width: 100, height: 30))
            earlier.backgroundColor = .systemBackground
            earlier.borderColor = UIColor(rgb: 0xf1f1f1)
            earlier.borderWidth = 2
            earlier.cornerRadius = 10
            earlier.font = UIFont.robotoFont(ofSize: 13)
            earlier.textAlignment = .center
            earlier.textColor = .lightGray
            earlier.text = "Earlier Today"
            cell.contentView.addSubview(earlier)
            
            return cell
        }
        
        // get item
        let entry = items[indexPath.row-1]
        
        // init total time
        var totalTime = "0m"
        // get total time
        let createdDate = App.shared.dateTimeFormatter.date(from: entry.date_created)
        // check if active
        if entry.status.intValue == 1 {
            // get shift duration
            let actualDiff = Calendar.current.dateComponents([.hour, .minute], from: createdDate!, to: Date())
            let shiftDuration = "\(actualDiff.hour!):\(actualDiff.minute!)".decimalTime
            totalTime = App.shared.toAbbreviatedHourFormatter.string(from: shiftDuration * 3600) ?? "0m"
        } else {
            totalTime = App.shared.toAbbreviatedHourFormatter.string(from: entry.shift_duration.doubleValue * 3600) ?? "0m"
        }
        
        
        
        // Configure the cell...
        let cell = tableView.dequeueReusableCell(withIdentifier: "EntryCell", for: indexPath)
        cell.selectionStyle = .none
        
        // remove other views
        cell.contentView.subviews.forEach {
            $0.removeFromSuperview()
        }
        
        // time entry
        let timeEntry = UILabel(frame: CGRect(x: 20, y: 30, width: Int(Device.width)-40, height: 20))
        timeEntry.font = UIFont.robotoBoldFont(ofSize: 17)
        timeEntry.textColor = .label
        timeEntry.text = "Time Entry • " + totalTime
        cell.contentView.addSubview(timeEntry)
        
        // check status to add edit and delete button
        if entry.status.intValue == 0 {
            let edit = UIButton(frame: CGRect(x: Device.width-76, y: 30, width: 24, height: 24))
            edit.tag = indexPath.row-1
            edit.setImage(UIImage.fontAwesomeIcon(name: .edit, style: .regular, textColor: .lightGray, size: CGSize(width: 24, height: 24)), for: .normal)
            edit.addTarget(self, action: #selector(editTimeEntry(_:)), for: .touchUpInside)
            cell.contentView.addSubview(edit)
            
            
            let delete = UIButton(frame: CGRect(x: Device.width-44, y: 30, width: 24, height: 24))
            delete.tag = indexPath.row-1
            delete.setImage(UIImage.fontAwesomeIcon(name: .trashAlt, style: .regular, textColor: .lightGray, size: CGSize(width: 24, height: 24)), for: .normal)
            delete.addTarget(self, action: #selector(deleteTimeEntry(_:)), for: .touchUpInside)
            cell.contentView.addSubview(delete)
        }
        
        let grayLine = createLine(x: 0, y: 60, width: Int(Device.width), height: 2)
        cell.contentView.addSubview(grayLine)
        
        var yCoor: Int = 0
        
        // check if manual
        if entry.logs.first?.entry_type == "Manual" {
            // add manual icon
            let icon = UIImageView(frame: CGRect(x: 20, y: 80, width: 30, height: 30))
            icon.image = UIImage(systemName: "m.circle.fill")
            icon.tintColor = .systemPurple
            cell.contentView.addSubview(icon)
            
            // manual text
            let text = UILabel(frame: CGRect(x: 60, y: 80, width: 150, height: 30))
            text.font = UIFont.robotoBoldFont(ofSize: 17)
            text.textColor = .systemPurple
            text.text = "Manual Entry"
            cell.contentView.addSubview(text)
            
            // gray line
            cell.contentView.addSubview(createLine(y: 130))
            
            // set yCoor
            yCoor = 132
        } else {
            // add image
            let mapImage = UIImageView(frame: CGRect(x: 0, y: 62, width: Device.width, height: 128))
            cell.addSubview(mapImage)
            
            // gray line
            cell.contentView.addSubview(createLine(x: 0, y: 190, width: Int(Device.width), height: 2))
            
            // set yCoor
            yCoor = 192
        }
        
        // add value to yCoor
        yCoor += 20
        
        
        var x = 0
        // iterate logs
        for log in entry.logs {
            
            // get log time
            let logTime = App.shared.dateTimeFormatter.date(from: log.date_created)
            
            // check log
            if log.action == "Check in" {
                // clock in time
                let clockInTime = UILabel(frame: CGRect(x: 20, y: yCoor, width: 80, height: 20))
                clockInTime.font = UIFont.robotoBoldFont(ofSize: 13)
                clockInTime.textColor = .label
                clockInTime.text = App.shared.timeFormatter.string(from: logTime!)
                cell.contentView.addSubview(clockInTime)
                
                // icon
                let icon = UIImageView(frame: CGRect(x: 100, y: yCoor-5, width: 30, height: 30))
                icon.image = generateClockIcon(.greenColor)
                cell.contentView.addSubview(icon)
                
                // action
                let action = UILabel(frame: CGRect(x: 140, y: yCoor, width: 100, height: 20))
                action.font = UIFont.robotoBoldFont(ofSize: 16)
                action.textColor = .label
                action.text = "Clock In"
                cell.contentView.addSubview(action)
                
                // address
                let address = UILabel(frame: CGRect(x: 140, y: yCoor+20, width: Int(Device.width)-160, height: 40))
                address.font = UIFont.robotoFont(ofSize: 13)
                address.numberOfLines = 2
                address.textColor = .lightGray
                address.text = !log.user_location_address.isEmpty ? log.user_location_address : "Manually Clocked by " + log.approved_by_name
                cell.contentView.addSubview(address)
                
                // add value to yCoor
                yCoor += 70
                
            } else if log.action == "Break in" {
                // clock in time
                let clockInTime = UILabel(frame: CGRect(x: 20, y: yCoor, width: 80, height: 20))
                clockInTime.font = UIFont.robotoFont(ofSize: 13)
                clockInTime.textColor = .lightGray
                clockInTime.text = App.shared.timeFormatter.string(from: logTime!)
                cell.contentView.addSubview(clockInTime)
                
                // check previous log
                if entry.logs[x-1].action == "Break out" {
                    // print line
                    cell.contentView.addSubview(createVerticalLine(y: yCoor-35))
                } else {
                    // print line
                    cell.contentView.addSubview(createVerticalLine(y: yCoor-45))
                }
                
                // icon
                let icon = UIImageView(frame: CGRect(x: 110, y: yCoor+5, width: 10, height: 10))
                icon.image = generateDot(.orangeColor)
                cell.contentView.addSubview(icon)
                
                // action
                let action = UILabel(frame: CGRect(x: 140, y: yCoor, width: 100, height: 20))
                action.font = UIFont.robotoFont(ofSize: 13)
                action.textColor = .label
                action.text = "Start Break"
                cell.contentView.addSubview(action)
                
                // add value to yCoor
                yCoor += 50
                
            } else if log.action == "Break out" {
                // clock in time
                let clockInTime = UILabel(frame: CGRect(x: 20, y: yCoor, width: 80, height: 20))
                clockInTime.font = UIFont.robotoFont(ofSize: 13)
                clockInTime.textColor = .lightGray
                clockInTime.text = App.shared.timeFormatter.string(from: logTime!)
                cell.contentView.addSubview(clockInTime)
                
                // print line
                cell.contentView.addSubview(createVerticalLine(.orangeColor, y: yCoor-35))
                
                // icon
                let icon = UIImageView(frame: CGRect(x: 110, y: yCoor+5, width: 10, height: 10))
                icon.image = generateDot(.orangeColor)
                cell.contentView.addSubview(icon)
                
                // action
                let action = UILabel(frame: CGRect(x: 140, y: yCoor, width: 100, height: 20))
                action.font = UIFont.robotoFont(ofSize: 13)
                action.textColor = .label
                action.text = "End Break"
                cell.contentView.addSubview(action)
                
                // add value to yCoor
                yCoor += 50
                
            } else if log.action == "Check out" {
                // clock in time
                let clockInTime = UILabel(frame: CGRect(x: 20, y: yCoor, width: 80, height: 20))
                clockInTime.font = UIFont.robotoBoldFont(ofSize: 13)
                clockInTime.textColor = .label
                clockInTime.text = App.shared.timeFormatter.string(from: logTime!)
                cell.contentView.addSubview(clockInTime)
                
                // check previous log
                if entry.logs[x-1].action == "Break out" {
                    // print line
                    cell.contentView.addSubview(createVerticalLine(y: yCoor-35))
                } else {
                    // print line
                    cell.contentView.addSubview(createVerticalLine(y: yCoor-45))
                }
                
                let icon = UIImageView(frame: CGRect(x: 100, y: yCoor-5, width: 30, height: 30))
                icon.image = generateClockIcon(.redColor)
                cell.contentView.addSubview(icon)
                
                // action
                let action = UILabel(frame: CGRect(x: 140, y: yCoor, width: 100, height: 20))
                action.font = UIFont.robotoBoldFont(ofSize: 16)
                action.textColor = .label
                action.text = "Clock Out"
                cell.contentView.addSubview(action)
                
                // address
                let address = UILabel(frame: CGRect(x: 140, y: yCoor+20, width: Int(Device.width)-160, height: 40))
                address.font = UIFont.robotoFont(ofSize: 13)
                address.numberOfLines = 2
                address.textColor = .lightGray
                address.text = !log.user_location_address.isEmpty ? log.user_location_address : "Manually Clocked Out by " + log.approved_by_name
                cell.contentView.addSubview(address)
                
                // add value to yCoor
                yCoor += 70
            }
            
            x+=1
        }
        
        // check last log
        if (entry.logs.last?.action == "Break out" || entry.logs.last?.action == "Check in") && entry.status.intValue == 1 {
            
            // check previous log
            if entry.logs[x-1].action == "Break out" {
                // print line
                cell.contentView.addSubview(createVerticalLine(y: yCoor-35))
            } else {
                // print line
                cell.contentView.addSubview(createVerticalLine(y: yCoor-45))
            }
            
            let icon = UIImageView(frame: CGRect(x: 110, y: yCoor+5, width: 10, height: 10))
            icon.image = generateDot(.greenColor)
            cell.contentView.addSubview(icon)
            
            // action
            let action = UILabel(frame: CGRect(x: 140, y: yCoor, width: 100, height: 20))
            action.font = UIFont.robotoBoldFont(ofSize: 16)
            action.textColor = .label
            action.text = "On the Clock"
            cell.contentView.addSubview(action)
            
            // info
            let info = UILabel(frame: CGRect(x: 140, y: yCoor+20, width: Int(Device.width)-160, height: 20))
            info.font = UIFont.robotoFont(ofSize: 13)
            info.textColor = .lightGray
            info.text = "Member is still active"
            cell.contentView.addSubview(info)
            
            // add value to yCoor
            yCoor += 70
        }
        
        // check status to add not field
        if entry.status.intValue == 0 {
            // add note
            let textView = TextView(frame: CGRect(x: 20, y: yCoor, width: Int(Device.width)-40, height: 80))
            textView.borderColor = UIColor(rgb: 0xf1f1f1)
            textView.borderWidth = 2
            textView.font = UIFont.robotoFont(ofSize: 13)
            textView.textColor = .label
            textView.placeholderLabel.font = UIFont.robotoFont(ofSize: 13)
            textView.placeholderLabel.text = "Type your notes here..."
            textView.placeholderLabel.textColor = .lightGray
            cell.contentView.addSubview(textView)
            
            // add value to yCoor
            yCoor += 110
        }
        
        // add zigzag
        let zigzag = UIImageView(frame: CGRect(x: (Int(Device.width)-100)/2, y: yCoor, width: 100, height: 10))
        zigzag.image = UIImage(named: "ic_zigzag")
        cell.contentView.addSubview(zigzag)
        
        
        return cell
    }
    
    // MARK: - Protocol -
    
    @objc func manualClockInOut(_ sender: UIButton) {
        // check
        if sender.title(for: .normal) == "Clock In" {
            // clock in
            let viewController = ManualClockInController.initFromNib()
            viewController.item = item
            let popup = PopupViewController(contentController: viewController, popupWidth: Device.width-60, popupHeight: 457)
            popup.cornerRadius = 10
            popup.canTapOutsideToDismiss = false
            self.present(popup, animated: true, completion: nil)
        } else {
            // clock out
            let viewController = ManualClockOutController.initFromNib()
            viewController.item = item
            let popup = PopupViewController(contentController: viewController, popupWidth: Device.width-60, popupHeight: 457)
            popup.cornerRadius = 10
            popup.canTapOutsideToDismiss = false
            self.present(popup, animated: true, completion: nil)
        }
    }
    
    @objc func editTimeEntry(_ sender: UIButton) {
        
    }
    
    @objc func deleteTimeEntry(_ sender: UIButton) {
        // show alert
        let alertController = UIAlertController(title: "", message: "Are you sure you want to delete this item?", preferredStyle: .alert)
        let yesAction = UIAlertAction(title: "Yes", style: .default) { (alertAction) -> Void in
            // delete item at indexPath
            let item = self.items[sender.tag]
            
            SVProgressHUD.setDefaultMaskType(.clear)
            SVProgressHUD.show(withStatus: "Deleting...")
            App.shared.api.deleteTimesheetAttendance(item.id.intValue) { (success, error) in
                SVProgressHUD.setDefaultMaskType(.none)
                SVProgressHUD.dismiss()
                guard error == nil else {
                    return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                }
                guard success == true else {
                    return SVProgressHUD.showError(withStatus: "Deleting item failed!")
                }
                
                // get today attendance
                SVProgressHUD.setDefaultMaskType(.clear)
                SVProgressHUD.show()
                App.shared.api.getTimesheetTeamMember(self.item.id.intValue) { (result, error) in
                    SVProgressHUD.setDefaultMaskType(.none)
                    SVProgressHUD.dismiss()
                    guard error == nil else {
                        return SVProgressHUD.showError(withStatus: error?.localizedDescription ?? "")
                    }
                    
                    // assign
                    self.item = result
                    // reload data
                    self.loadData()
                }
            }
        }
        alertController.addAction(yesAction)
        
        let noAction = UIAlertAction(title: "No", style: .cancel) { (alertAction) -> Void in
            self.dismiss(animated: true, completion: nil)
        }
        alertController.addAction(noAction)
        
        self.present(alertController, animated: true, completion: nil)
    }
    
    // MARK: - Other Functions -
    
    func createLine(x: Int = 20, y: Int, width: Int = Int(Device.width)-40, height: Int = 2) -> UIView {
        let grayLine = UIView(frame: CGRect(x: x, y: y, width: width, height: height))
        grayLine.backgroundColor = UIColor(rgb: 0xf1f1f1)
        return grayLine
    }
    
    func generateClockIcon(_ color: UIColor) -> UIImage {
        // large circle
        let view = UIView(frame: CGRect(x: 0, y: 0, width: 30, height: 30))
        view.backgroundColor    = color.withAlphaComponent(0.2)
        view.borderWidth        = 1
        view.borderColor        = color
        view.cornerRadius       = 15
        
        // small circle
        let small = UIView(frame: CGRect(x: 10, y: 10, width: 10, height: 10))
        small.backgroundColor    = color
        small.cornerRadius       = 5
        view.addSubview(small)
        
        return view.asImage()
    }
    
    func generateDot(_ color: UIColor = .greenColor) -> UIImage {
        let small = UIView(frame: CGRect(x: 0, y: 0, width: 10, height: 10))
        small.backgroundColor    = color
        small.cornerRadius       = 5
        return small.asImage()
    }
    
    func createVerticalLine(_ color: UIColor = UIColor(rgb: 0xf1f1f1), y: Int) -> UIView {
        let line = UIView(frame: CGRect(x: 114, y: y, width: 2, height: 50))
        line.backgroundColor = color
        return line
    }
    
    func createDashLine(_ y: Int) -> UIView {
        let line = DottedLineView(frame: CGRect(x: 114, y: y, width: 2, height: 50))
        line.horizontal = false
        line.lineWidth = 2
        line.lineColor = UIColor(rgb: 0xf1f1f1)
        return line
    }

}
