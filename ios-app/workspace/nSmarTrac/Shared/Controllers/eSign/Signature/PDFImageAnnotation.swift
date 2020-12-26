//
//  PDFImageAnnotation.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 27/09/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import PDFKit

class PDFImageAnnotation: PDFAnnotation {
    
    var image: UIImage!
    
    init(with image: UIImage!, forBounds bounds: CGRect, withProperties properties: [AnyHashable : Any]?) {
        super.init(bounds: bounds, forType: PDFAnnotationSubtype.stamp,  withProperties: properties)
        self.image = image
    }
    
    required init?(coder aDecoder: NSCoder) {
        fatalError("init(coder:) has not been implemented")
    }

    override func draw(with box: PDFDisplayBox, in context: CGContext) {
        guard let cgImage = self.image.cgImage else { return }
        context.draw(cgImage, in: self.bounds)
    }
}
