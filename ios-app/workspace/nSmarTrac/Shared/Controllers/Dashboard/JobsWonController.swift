//
//  JobsWonController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 10/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Charts

class JobsWonController: UIViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var chartView: PieChartView!
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        setup(chartView)
    }

}

// MARK: - ChartViewDelegate -

extension JobsWonController: ChartViewDelegate {
    
    func setup(_ chartView: PieChartView) {
        chartView.delegate = self
        chartView.holeColor = .white
        chartView.transparentCircleColor = NSUIColor.white.withAlphaComponent(0.43)
        chartView.holeRadiusPercent = 0.58
        chartView.rotationEnabled = false
        chartView.highlightPerTapEnabled = true
        chartView.maxAngle = 180 // Half chart
        chartView.rotationAngle = 180 // Rotate to make the half on the upper side
        chartView.centerTextOffset = CGPoint(x: 0, y: -20)
        chartView.drawCenterTextEnabled = true
        chartView.centerText = "Estimated: $20866.54 (8)"
        
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
        var total = 0.0
        let labels = ["Submitted", "Lost"]
        let entries = (0..<count).map { (i) -> PieChartDataEntry in
            let mVal = Double(arc4random_uniform(range) + range / 5)
            total += mVal
            return PieChartDataEntry(value: mVal,
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
        chartView.centerText = "Estimated: $\(total) (8)"
    }
}
