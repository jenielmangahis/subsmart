//
//  TotalSalesController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 10/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Charts

class TotalSalesController: UIViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var chartView: BarChartView!
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        setup(chartView)
    }

}

// MARK: - PageViewControllerDelegate -

/*extension TotalSalesController: DashboardControllerDelegate {
    
    func pageViewController(pageViewController: DashboardController,
        didUpdatePageCount count: Int) {
        pageControl.numberOfPages = count
    }
    
    func pageViewController(pageViewController: DashboardController,
        didUpdatePageIndex index: Int) {
        pageControl.currentPage = index
    }
    
}*/

// MARK: - ChartViewDelegate -

extension TotalSalesController: ChartViewDelegate {
    
    func setup(_ chartView: BarLineChartViewBase) {
        
        chartView.delegate = self
        chartView.chartDescription?.enabled = false
        chartView.dragEnabled = false
        chartView.setScaleEnabled(false)
        chartView.pinchZoomEnabled = false
        chartView.rightAxis.enabled = false
        chartView.maxVisibleCount = 60
        
        let xAxis = chartView.xAxis
        xAxis.labelPosition = .bottom
        xAxis.labelFont = .systemFont(ofSize: 10)
        xAxis.granularity = 1
        xAxis.labelCount = 7
        xAxis.valueFormatter = TotalSalesFormatter(chart: chartView)
        
        let leftAxisFormatter = NumberFormatter()
        leftAxisFormatter.minimumFractionDigits = 0
        leftAxisFormatter.maximumFractionDigits = 1
        leftAxisFormatter.negativePrefix = "$"
        leftAxisFormatter.positivePrefix = "$"
        
        let leftAxis = chartView.leftAxis
        leftAxis.labelFont = UIFont.robotoFont(ofSize: 11)
        leftAxis.labelCount = 8
        leftAxis.valueFormatter = DefaultAxisValueFormatter(formatter: leftAxisFormatter)
        leftAxis.labelPosition = .outsideChart
        leftAxis.spaceTop = 0.15
        leftAxis.axisMinimum = 0 // FIXME: HUH?? this replaces startAtZero = YES
        
        let l = chartView.legend
        l.horizontalAlignment = .left
        l.verticalAlignment = .bottom
        l.orientation = .horizontal
        l.drawInside = false
        l.form = .circle
        l.formSize = 9
        l.font = UIFont.robotoFont(ofSize: 11)
        l.xEntrySpace = 4
        
        // set data
        setDataCount(4, range: 100)
    }
    
    func setDataCount(_ count: Int, range: UInt32) {
        
        // generate data
        let yVals = (0..<count).map { (i) -> BarChartDataEntry in
            let mult = range + 1
            let val = Double(arc4random_uniform(mult))
            return BarChartDataEntry(x: Double(i), y: val)
        }
        
        let colors = [UIColor.greenColor, UIColor.orangeColor, UIColor.blueColor, UIColor.systemTeal, UIColor.systemPink]
        
        let set1 = BarChartDataSet(entries: yVals, label: "")
        set1.colors = colors
        set1.drawValuesEnabled = true
        set1.valueTextColor = UIColor(rgb: 0x76849F)
        set1.valueFont = UIFont.robotoFont(ofSize: 11)
        
        let data = BarChartData(dataSet: set1)
        data.setValueFont(UIFont.robotoFont(ofSize: 11))
        data.barWidth = 0.8
        chartView.data = data
    }
}

public class TotalSalesFormatter: NSObject, IAxisValueFormatter {
    
    weak var chart: BarLineChartViewBase?
    let names = ["Due", "Overdue", "Paid", "Invoiced"]
    
    init(chart: BarLineChartViewBase) {
        self.chart = chart
    }
    
    public func stringForValue(_ value: Double, axis: AxisBase?) -> String {
        return names[Int(value)]
    }
}
