//
//  ProfitLossesController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 10/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Charts

class ProfitLossesController: UIViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var chartView: PieChartView!
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        setup(chartView)
    }

}

// MARK: - ChartViewDelegate -

extension ProfitLossesController: ChartViewDelegate {
    
    func setup(_ chartView: PieChartView) {
        chartView.delegate = self
        chartView.usePercentValuesEnabled = true
        chartView.drawSlicesUnderHoleEnabled = false
        chartView.holeRadiusPercent = 0.58
        chartView.transparentCircleRadiusPercent = 0.61
        chartView.chartDescription?.enabled = false
        chartView.setExtraOffsets(left: 5, top: 10, right: 5, bottom: 5)
        
        chartView.drawCenterTextEnabled = true
        chartView.centerText = "Net Profit"
        
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
        setDataCount(2, range: 1000)
    }
    
    func setDataCount(_ count: Int, range: UInt32) {
        let labels = ["Revenue", "Expenses"]
        let entries = (0..<count).map { (i) -> PieChartDataEntry in
            return PieChartDataEntry(value: Double(arc4random_uniform(range) + range / 5),
                                     label: labels[i])
        }
        
        let colors = [UIColor.greenColor, UIColor.orangeColor, UIColor.blueColor, UIColor.systemTeal, UIColor.systemPink]
        
        let set = PieChartDataSet(entries: entries, label: "")
        set.drawIconsEnabled = false
        set.sliceSpace = 2
        set.colors = colors
        
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
