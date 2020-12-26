//
//  BusinessPerfomanceController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 10/06/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import Charts

class BusinessPerfomanceController: UIViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var chartView: LineChartView!
    
    struct ChartData {
        var name: String!
        var values: [ChartDataEntry] = []
    }
    

    // MARK: - Lifecycle -

    override func viewDidLoad() {
        super.viewDidLoad()
        setup(chartView)
    }

}

// MARK: - ChartViewDelegate -

extension BusinessPerfomanceController: ChartViewDelegate {
    
    func setup(_ chartView: LineChartView) {
        chartView.delegate = self
        chartView.chartDescription?.enabled = false
        chartView.dragEnabled = true
        chartView.setScaleEnabled(true)
        chartView.pinchZoomEnabled = true
        
        // x-axis limit line
        let llXAxis = ChartLimitLine(limit: 20, label: "Index 10")
        llXAxis.labelPosition = .bottomRight
        llXAxis.valueFont = UIFont.muliFont(ofSize: 10)
        
        let leftAxis = chartView.leftAxis
        leftAxis.removeAllLimitLines()
        leftAxis.axisMinimum = 0
        
        let xAxisFormatter = MonthYearChartXAxisFormatter(["Jan 2020", "Feb 2020", "Mar 2020", "Apr 2020", "May 2020", "Jun 2020"])
        
        let xAxis = chartView.xAxis
        xAxis.labelPosition = .bottom
        xAxis.drawLabelsEnabled = true
        xAxis.granularity = 1
        xAxis.valueFormatter = xAxisFormatter
        
        chartView.rightAxis.enabled = false
        chartView.legend.form = .square
        chartView.animate(xAxisDuration: 2.5)
        
        // set data
        setDataCount(6, range: 100)
    }
    
    func setDataCount(_ count: Int, range: UInt32) {
        
        // generate data
        var chartData: [ChartData] = []
        
        // create 3 datasets
        for x in 0...2 {
            let names = ["Total Revenue", "Expenses", "Profit"]
            let values = (0..<count).map { (i) -> ChartDataEntry in
                let val = Double(arc4random_uniform(range) + 3)
                return ChartDataEntry(x: Double(i), y: val)
            }
            chartData.append(ChartData(name: names[x], values: values))
        }
        
        let colors = [UIColor.greenColor, UIColor.orangeColor, UIColor.blueColor, UIColor.systemTeal, UIColor.systemPink]
        
        // iterate dataSets
        let dataSets = chartData.map { (item) -> LineChartDataSet in
            let color = colors.randomElement()!
            let set1 = LineChartDataSet(entries: item.values, label: item.name)
            set1.drawIconsEnabled = false
            set1.setColor(color)
            set1.setCircleColor(color)
            set1.lineWidth = 2
            set1.circleRadius = 5
            set1.circleHoleRadius = 2.5
            set1.drawCircleHoleEnabled = true
            set1.valueFont = UIFont.muliFont(ofSize: 10)
            set1.valueColors = [UIColor(rgb: 0x76849F)]
            set1.formLineDashLengths = [5, 2.5]
            set1.formLineWidth = 1
            set1.formSize = 15
            set1.mode = .cubicBezier
            return set1
        }
        
        let data = LineChartData(dataSets: dataSets)
        
        chartView.data = data
    }
}

public class MonthYearChartXAxisFormatter: NSObject, IAxisValueFormatter {
    
    var monthYear: [String] = []
    
    convenience init(_ monthYear: [String]) {
        self.init()
        self.monthYear = monthYear
    }
    
    public func stringForValue(_ value: Double, axis: AxisBase?) -> String {
        return monthYear[Int(value)]
    }
}
