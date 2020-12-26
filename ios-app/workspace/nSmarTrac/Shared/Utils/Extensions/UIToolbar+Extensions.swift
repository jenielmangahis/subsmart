//
//  UIToolbar+Extensions.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 10/08/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit

extension UIToolbar {
    
    private func image(withColor color: UIColor) -> UIImage? {
        let rect = CGRect(x: 0.0, y: 0.0, width: 1.0, height: 1.0)
        UIGraphicsBeginImageContext(rect.size)
        let context = UIGraphicsGetCurrentContext()
        
        context?.setFillColor(color.cgColor)
        context?.fill(rect)
        
        let image = UIGraphicsGetImageFromCurrentImageContext()
        UIGraphicsEndImageContext()
        
        return image
    }
    
    func setBackgroundColor(_ color: UIColor, position: UIBarPosition) {
        self.setBackgroundImage(image(withColor: color), forToolbarPosition: position, barMetrics: .default)
    }
}
