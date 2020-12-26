//
//  HomeTabController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 25/07/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import FontAwesome_swift
import SideMenu
import SVProgressHUD

class HomeTabController: UIViewController {
    
    // MARK: Properties -
    
    @IBOutlet var menuButtonItem: UIBarButtonItem!
    @IBOutlet var timerButtonItem: UIBarButtonItem!
    @IBOutlet var chatButtonItem: UIBarButtonItem!
    @IBOutlet var inboxButtonItem: UIBarButtonItem!
    @IBOutlet var taskButtonItem: UIBarButtonItem!
    @IBOutlet var pageView: UIView!
    @IBOutlet var feedIcon: UIImageView!
    @IBOutlet var globeIcon: UIImageView!
    
    var pageViewController: UIPageViewController = {
       return UIPageViewController(transitionStyle: .scroll, navigationOrientation: .horizontal, options: nil)
    }()
    
    var orderedViewControllers: [UIViewController] = {
        return [UIStoryboard(name: "Main", bundle: nil).instantiateViewController(withIdentifier: "sb_HomeController"),
                UIStoryboard(name: "Main", bundle: nil).instantiateViewController(withIdentifier: "sb_OtherPageController"),
                UIStoryboard(name: "Main", bundle: nil).instantiateViewController(withIdentifier: "sb_OtherPage2Controller")]
    }()
    
    var timer = Timer()
    var timer2 = Timer()
    
    var pie: PieChart!
    
    
    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initNavBar()
        setupPageViewController()
        
        // configure icons
        feedIcon.image = UIImage.fontAwesomeIcon(name: .rssSquare, style: .regular, textColor: .white, size: CGSize(width: 22, height: 22))
        globeIcon.image = UIImage.fontAwesomeIcon(name: .globe, style: .regular, textColor: .white, size: CGSize(width: 22, height: 22))
        
        // notification observers
        NotificationCenter.default.addObserver(self, selector: #selector(updateTimerIcon(_:)), name: Notifications.willUpdateTimesheetIcon, object: nil)
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
    // MARK: - Navigation Bar -
    
    func initNavBar() {
        // setup navBar icons
        menuButtonItem.image = UIImage.fontAwesomeIcon(name: .bars, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        chatButtonItem.image = UIImage.fontAwesomeIcon(name: .comments, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        inboxButtonItem.image = UIImage.fontAwesomeIcon(name: .envelope, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        taskButtonItem.image = UIImage.fontAwesomeIcon(name: .clipboardList, style: .solid, textColor: .white, size: CGSize(width: 24, height: 24))
        
        // setup SideMenu
        SideMenuManager.default.leftMenuNavigationController = storyboard?.instantiateViewController(withIdentifier: "sb_SideMenu") as? SideMenuNavigationController
        SideMenuManager.default.rightMenuNavigationController = nil
        SideMenuManager.default.addPanGestureToPresent(toView: self.navigationController!.navigationBar)
        SideMenuManager.default.addScreenEdgePanGesturesToPresent(toView: self.navigationController!.view)
        SideMenuManager.default.leftMenuNavigationController?.statusBarEndAlpha = 0
        
        
        // setup company logo
        let imageKey = "BUSINESS_LOGO_\(App.shared.companyId)"
        if let image = UserDefaults.standard.imageForKey(key: imageKey) {
            timerButtonItem.image = image.resize(toWidth: 24)!.withRenderingMode(.alwaysOriginal)
        }
        
        // schedule timer
        self.timer = Timer.scheduledTimer(timeInterval: 5, target: self, selector: #selector(updateTimer(_:)), userInfo: nil, repeats: false)
    }
    
    // MARK: - Notification -
    
    @objc func updateTimerIcon(_ notification: NSNotification) {
        self.updateTimer(notification)
    }
    
    // MARK: - Action -
    
    @objc func updateTimer(_ sender: Any) {
        // check based on data fetch
        if let item = App.shared.userTimesheet {
            // get last attendance
            if let attendance = item.attendance.last {
                
                // get last log
                if let lastLog = attendance.logs.last {
                    // get last log action
                    if lastLog.action == "Check in" || lastLog.action == "Break out" {
                        
                        // create view
                        let buttonView = UIView(frame: CGRect(x: 0, y: 0, width: 24, height: 24))
                        
                        // add image view
                        let imageView = UIImageView(frame: CGRect(x: 0, y: 0, width: 24, height: 24))
                        imageView.image = UIImage(systemName: "stopwatch")?.tint(with: .magenta)
                        imageView.contentMode = .scaleAspectFill
                        buttonView.addSubview(imageView)
                        
                        // pie
                        pie = PieChart(frame: CGRect(x: 2, y: 3, width: 15, height: 14))
                        pie.slices = [Slice(percent: 0.99, color: UIColor.magenta)]
                        buttonView.addSubview(pie)
                        
                        self.timer2 = Timer.scheduledTimer(timeInterval: 1, target: self, selector: #selector(rotatePie(_:)), userInfo: nil, repeats: true)
                        
                        // assign
                        timerButtonItem.customView = buttonView
                    }
                }
            }
        }
    }
    
    @objc func rotatePie(_ sender: Any) {
        pie.animateChart()
    }

    @IBAction func sideMenuTapped(_ sender: Any) {
        self.present(SideMenuManager.default.leftMenuNavigationController!, animated: true, completion: nil)
    }
    
    @IBAction func chatButtonTapped(_ sender: Any) {
        App.shared.selectedMenu = .Chat
        NotificationCenter.default.post(name: Notifications.didSwitchLeftMenu, object: self, userInfo: nil)
    }
    
    @IBAction func messagesButtonTapped(_ sender: Any) {
        App.shared.selectedMenu = .Messages
        NotificationCenter.default.post(name: Notifications.didSwitchLeftMenu, object: self, userInfo: nil)
    }
    
    @IBAction func taskButtonTapped(_ sender: Any) {
        App.shared.selectedMenu = .Tasks
        NotificationCenter.default.post(name: Notifications.didSwitchLeftMenu, object: self, userInfo: nil)
    }
    
    @IBAction func feedButtonTapped(_ sender: Any) {
    }
    
    @IBAction func websiteButtonTapped(_ sender: Any) {
        // check
        guard UserDefaults.standard.string(forKey: "WEBSITE_URL") != nil else {
            return Utils.shared.showAlertWithMessage(title: "Info", message: "Please set your desired website url in Settings->Website URL")
        }
        
        // load link
        if let link = UserDefaults.standard.string(forKey: "WEBSITE_URL") {
            if let url = URL(string: link) {
                UIApplication.shared.open(url)
            }
        }
    }
    
    // MARK: - Functions -
    
    func setupPageViewController() {
        //1.Set its datasource and delegate methods
        self.pageViewController.dataSource = self
        self.pageViewController.delegate = self
        self.pageViewController.view.frame = .zero
        
        //2.Show view controller with initial page - page zero
        let pageController = orderedViewControllers[0]
        self.pageViewController.setViewControllers([pageController], direction: .forward, animated: false, completion: nil)
        self.addChild(self.pageViewController)
        
        //3.Add to holder view
        self.pageView.addSubview(self.pageViewController.view)
        self.pageViewController.didMove(toParent: self)
       
        //4.Pin to super view - (holder view)
        self.pageViewController.view.translatesAutoresizingMaskIntoConstraints = false
        self.pageViewController.view.topAnchor.constraint(equalTo: self.pageView.topAnchor).isActive = true
        self.pageViewController.view.leftAnchor.constraint(equalTo: self.pageView.leftAnchor).isActive = true
        self.pageViewController.view.bottomAnchor.constraint(equalTo: self.pageView.bottomAnchor).isActive = true
        self.pageViewController.view.rightAnchor.constraint(equalTo: self.pageView.rightAnchor).isActive = true
    }
    
}

// MARK: - UIPageViewControllerDataSource -

extension HomeTabController: UIPageViewControllerDelegate, UIPageViewControllerDataSource {
    
    func pageViewController(_ pageViewController: UIPageViewController, viewControllerBefore viewController: UIViewController) -> UIViewController? {
        
            guard let viewControllerIndex = orderedViewControllers.firstIndex(of: viewController) else {
                return nil
            }
            
            let previousIndex = viewControllerIndex - 1
            
            // User is on the first view controller and swiped left to loop to
            // the last view controller.
            guard previousIndex >= 0 else {
                //return orderedViewControllers.last
                return nil
            }
            
            guard orderedViewControllers.count > previousIndex else {
                return nil
            }
            
            return orderedViewControllers[previousIndex]
    }

    func pageViewController(_ pageViewController: UIPageViewController, viewControllerAfter viewController: UIViewController) -> UIViewController? {
        
            guard let viewControllerIndex = orderedViewControllers.firstIndex(of: viewController) else {
                return nil
            }
            
            let nextIndex = viewControllerIndex + 1
            let orderedViewControllersCount = orderedViewControllers.count
            
            // User is on the last view controller and swiped right to loop to
            // the first view controller.
            guard orderedViewControllersCount != nextIndex else {
                //return orderedViewControllers.first
                return nil
            }
            
            guard orderedViewControllersCount > nextIndex else {
                return nil
            }
            
            return orderedViewControllers[nextIndex]
    }
    
    func pageViewController(_ pageViewController: UIPageViewController, didFinishAnimating finished: Bool, previousViewControllers: [UIViewController], transitionCompleted completed: Bool) {
        
    }
}

// MARK: - Custom Class -

struct Slice {
    var percent: CGFloat
    var color: UIColor
}

class PieChart: UIView {

    static let ANIMATION_DURATION: CGFloat = 1.4
    
    //@IBOutlet var canvasView: UIView!

    var slices: [Slice]?
    var sliceIndex: Int = 0
    var currentPercent: CGFloat = 0.0

    override func draw(_ rect: CGRect) {
        //subviews[0].frame = bounds
        //self.frame = bounds
    }

    /// Get an animation duration for the passed slice.
    /// If slice share is 40%, for example, it returns 40% of total animation duration.
    ///
    /// - Parameter slice: Slice struct
    /// - Returns: Animation duration
    func getDuration(_ slice: Slice) -> CFTimeInterval {
        return CFTimeInterval(slice.percent / 1.0 * PieChart.ANIMATION_DURATION)
    }
    
    /// Convert slice percent to radian.
    ///
    /// - Parameter percent: Slice percent (0.0 - 1.0).
    /// - Returns: Radian
    func percentToRadian(_ percent: CGFloat) -> CGFloat {
        //Because angle starts wtih X positive axis, add 270 degrees to rotate it to Y positive axis.
        var angle = 270 + percent * 360
        if angle >= 360 {
            angle -= 360
        }
        return angle * CGFloat.pi / 180.0
    }

    /// Add a slice CAShapeLayer to the canvas.
    ///
    /// - Parameter slice: Slice to be drawn.
    func addSlice(_ slice: Slice) {
        let animation = CABasicAnimation(keyPath: "strokeEnd")
        animation.fromValue = 0
        animation.toValue = 1
        animation.duration = getDuration(slice)
        animation.timingFunction = CAMediaTimingFunction(name: CAMediaTimingFunctionName.linear)
        animation.delegate = self
        
        let canvasWidth = self.frame.width
        let path = UIBezierPath(arcCenter: self.center,
                                radius: canvasWidth / 2 /*canvasWidth * 3 / 8*/,
                                startAngle: percentToRadian(currentPercent),
                                endAngle: percentToRadian(currentPercent + slice.percent),
                                clockwise: true)
        
        let sliceLayer = CAShapeLayer()
        sliceLayer.path = path.cgPath
        sliceLayer.fillColor = nil
        sliceLayer.strokeColor = slice.color.cgColor
        sliceLayer.lineWidth = canvasWidth / 2 //canvasWidth * 2 / 8
        sliceLayer.strokeEnd = 1
        sliceLayer.add(animation, forKey: animation.keyPath)
        
        self.layer.addSublayer(sliceLayer)
    }
    
    /// Call this to start pie chart animation.
    func animateChart() {
        sliceIndex = 0
        currentPercent = 0.0
        self.layer.sublayers = nil
        
        if slices != nil && slices!.count > 0 {
            let firstSlice = slices![0]
            addSlice(firstSlice)
        }
    }
}

extension PieChart: CAAnimationDelegate {

    func animationDidStop(_ anim: CAAnimation, finished flag: Bool) {
        if flag {
            currentPercent += slices![sliceIndex].percent
            sliceIndex += 1
            if sliceIndex < slices!.count {
                let nextSlice = slices![sliceIndex]
                addSlice(nextSlice)
            }
        }
    }
}
