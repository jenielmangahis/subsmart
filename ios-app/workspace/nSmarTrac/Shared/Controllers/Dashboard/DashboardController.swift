//
//  DashboardController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 09/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import FontAwesome_swift

class DashboardController: UIViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var viewPager: ViewPager!
    
    private(set) lazy var viewControllers: [UIViewController] = {
        return [profitLossesController(),
                jobForecastController(),
                businessPerfomanceController(),
                totalSalesController(),
                jobsWonController(),
                expensessController()]
    }()
    
    
    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        initPagerView()
    }

    override func viewDidAppear(_ animated: Bool) {
        super.viewDidAppear(animated)
        self.parent?.title = "Dashboard"
        viewPager.scrollToPage(index: 0)
    }
    
    override var preferredStatusBarStyle : UIStatusBarStyle {
        return .lightContent
    }
    
}

// MARK: - ViewPagerDataSource -

extension DashboardController: ViewPagerDataSource {

    func initPagerView() {
        viewPager.dataSource = self
        viewPager.animationNext()
    }

    func numberOfItems(viewPager:ViewPager) -> Int {
        return viewControllers.count
    }

    func viewAtIndex(viewPager: ViewPager, index: Int, view: UIView?) -> UIView {
        // init
        let mView = viewControllers[index].view
        return mView!
    }

    func didSelectedItem(index: Int) {
        print("select index \(index)")
    }
    
    // MARK: - Functions -
    
    private func profitLossesController() -> UIViewController {
        return (self.storyboard?.instantiateViewController(withIdentifier: "sb_ProfitLossesController"))!
    }
    
    private func jobForecastController() -> UIViewController {
        return (self.storyboard?.instantiateViewController(withIdentifier: "sb_JobForecastController"))!
    }
    
    private func businessPerfomanceController() -> UIViewController {
        return (self.storyboard?.instantiateViewController(withIdentifier: "sb_BusinessPerfomanceController"))!
    }
    
    private func totalSalesController() -> UIViewController {
        return (self.storyboard?.instantiateViewController(withIdentifier: "sb_TotalSalesController"))!
    }
    
    private func jobsWonController() -> UIViewController {
        return (self.storyboard?.instantiateViewController(withIdentifier: "sb_JobsWonController"))!
    }
    
    private func expensessController() -> UIViewController {
        return (self.storyboard?.instantiateViewController(withIdentifier: "sb_ExpensessController"))!
    }
}
