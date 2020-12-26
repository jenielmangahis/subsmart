//
//  ExpensessController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 10/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Charts

class ExpensessController: UIViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var chartView: PieChartView!
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        setup(chartView)
    }

}

// MARK: - ChartViewDelegate -

extension ExpensessController: ChartViewDelegate {
    
    func setup(_ chartView: PieChartView) {
        chartView.delegate = self
        chartView.usePercentValuesEnabled = true
        chartView.drawSlicesUnderHoleEnabled = false
        chartView.holeRadiusPercent = 0.58
        chartView.transparentCircleRadiusPercent = 0.61
        chartView.chartDescription?.enabled = false
        chartView.setExtraOffsets(left: 5, top: 10, right: 5, bottom: 5)
        
        chartView.drawCenterTextEnabled = true
        chartView.centerText = "Expenses"
        
        chartView.drawHoleEnabled = true
        chartView.rotationAngle = 0
        chartView.rotationEnabled = true
        chartView.highlightPerTapEnabled = true
        
        let l = chartView.legend
        l.horizontalAlignment = .right
        l.verticalAlignment = .top
        l.orientation = .vertical
        l.drawInside = false
        l.xEntrySpace = 7
        l.yEntrySpace = 0
        l.yOffset = 0
        
        // set data
        setDataCount(20, range: 1000)
    }
    
    func setDataCount(_ count: Int, range: UInt32) {
        let labels = ["Automobile Expense", "Bank Charges", "Commission & Fees", "Dues & Subscriptions", "Federal Taxes (941/944)", "FL Unemployment Tax", "Fuel/Mileage Expenses", "Insurance", "Job Materials", "Legal & Professional Fees", "Loan Payable", "Meals & Entertainment", "Office Expenses", "Payroll Expenses", "Penalties & Settlements", "Reimburstment", "Rent or Lease", "Repair & Maintenance", "Shareholder Notes Payable", "Subcontractors"]
        let entries = (0..<count).map { (i) -> PieChartDataEntry in
            return PieChartDataEntry(value: Double(arc4random_uniform(range) + range / 5),
                                     label: labels[i])
        }
        
        let colors = [UIColor.greenColor, UIColor.orangeColor, UIColor.blueColor, UIColor.systemTeal, UIColor.systemPink, UIColor.redColor, UIColor.systemTeal]
        
        let set = PieChartDataSet(entries: entries, label: "")
        set.colors = colors
        set.drawIconsEnabled = false
        set.sliceSpace = 2
        
        let pFormatter = NumberFormatter()
        pFormatter.numberStyle = .currencyAccounting
        pFormatter.currencySymbol = "$"
        pFormatter.maximumFractionDigits = 1
        pFormatter.multiplier = 1
        
        let data = PieChartData(dataSet: set)
        data.setValueFormatter(DefaultValueFormatter(formatter: pFormatter))
        data.setValueFont(UIFont.robotoFont(ofSize: 11))
        data.setValueTextColor(.black)
        
        chartView.data = data
        chartView.highlightValues(nil)
    }
}
