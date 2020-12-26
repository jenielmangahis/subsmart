//
//  PdfHelper.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 30/07/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import PDFKit

class PdfHelper {
    
    public static func createPdfDocument(forURL url: String) -> PDFDocument? {
        if let resourceUrl = URL(string: url) {
            return PDFDocument(url: resourceUrl)
        }
        return nil
    }
    
    public static func createPdfDocument(fromImage image: UIImage) -> PDFDocument? {
        let pdfPage = PDFPage(image: image)
        let pdfDocument = PDFDocument()
        pdfDocument.insert(pdfPage!, at: 0)
        return pdfDocument
    }
    
    public static func getThumbnail(for document: PDFDocument, width: CGFloat = 124) -> UIImage? {
        if let page = document.page(at: 0) {
            let pageSize = page.bounds(for: .mediaBox)
            let pdfScale = width / pageSize.width

            // Apply if you're displaying the thumbnail on screen
            let scale = UIScreen.main.scale * pdfScale
            let screenSize = CGSize(width: pageSize.width * scale,
                                    height: pageSize.height * scale)

            return page.thumbnail(of: screenSize, for: .mediaBox)
        }
        return nil
    }
    
    public static func merge(_ documents: [PDFDocument]) -> PDFDocument? {
        let outputData = NSMutableData()
        UIGraphicsBeginPDFContextToData(outputData, .zero, nil)

        guard let context = UIGraphicsGetCurrentContext() else {
            return PDFDocument(data: outputData as Data)
        }
        
        // convert to pdf to data
        var pdfs: [Data] = []
        // iterate documents
        for pdf in documents {
            pdfs.append(pdf.dataRepresentation()!)
        }

        for pdf in pdfs {
            guard let dataProvider = CGDataProvider(data: pdf as CFData), let document = CGPDFDocument(dataProvider) else { continue }

            for pageNumber in 1...document.numberOfPages {
                guard let page = document.page(at: pageNumber) else { continue }
                var mediaBox = page.getBoxRect(.mediaBox)
                context.beginPage(mediaBox: &mediaBox)
                context.drawPDFPage(page)
                context.endPage()
            }
        }

        context.closePDF()
        UIGraphicsEndPDFContext()

        return PDFDocument(data: outputData as Data)
    }
    
    public static func savePdf(_ document: PDFDocument) -> URL {
        var documentsURL = FileManager.default.urls(for: .documentDirectory, in: .userDomainMask)[0]
        documentsURL.appendPathComponent("temp.pdf")
        document.write(to: documentsURL)
        return documentsURL
    }

    public static func addTitle(pageRect: CGRect, title: String, textTop: CGFloat = 36) -> CGFloat {
        // 1
        let titleFont = UIFont.robotoBoldFont(ofSize: 32)
        // 2
        let titleAttributes: [NSAttributedString.Key: Any] = [NSAttributedString.Key.font: titleFont]
        // 3
        let attributedTitle = NSAttributedString(
            string: title,
            attributes: titleAttributes)
        // 4
        let titleStringSize = attributedTitle.size()
        // 5
        // centered
        //let titleStringRect = CGRect(x: (pageRect.width - titleStringSize.width) / 2.0, y: 36, width: titleStringSize.width, height: titleStringSize.height)
        // aligned right
        let titleStringRect = CGRect(x: (pageRect.width - titleStringSize.width) - 30, y: textTop, width: titleStringSize.width, height: titleStringSize.height)
        // 6
        attributedTitle.draw(in: titleStringRect)
        // 7
        return titleStringRect.origin.y + titleStringRect.size.height
    }
    
    public static func addBodyText(pageRect: CGRect, textTop: CGFloat, text: String, xCoor: CGFloat = 30, height: CGFloat) -> CGFloat {
        let textFont = UIFont.robotoFont(ofSize: 18)
        // 1
        let paragraphStyle = NSMutableParagraphStyle()
        paragraphStyle.alignment = .natural
        paragraphStyle.lineBreakMode = .byWordWrapping
        // 2
        let textAttributes = [
            NSAttributedString.Key.paragraphStyle: paragraphStyle,
            NSAttributedString.Key.font: textFont]
        let attributedText = NSAttributedString(string: text, attributes: textAttributes)
        // 3
        // 4
        let textRect = CGRect(x: xCoor, y: textTop+30, width: pageRect.width - (xCoor * 2), height: height)
        attributedText.draw(in: textRect)
        // 5
        return textRect.origin.y + height
    }
    
    public static func addText(pageRect: CGRect, textTop: CGFloat, text: String, textFont: UIFont = UIFont.robotoFont(ofSize: 18)) -> CGFloat {
        // 1
        let paragraphStyle = NSMutableParagraphStyle()
        paragraphStyle.alignment = .natural
        paragraphStyle.lineBreakMode = .byWordWrapping
        // 2
        let textAttributes = [
            NSAttributedString.Key.paragraphStyle: paragraphStyle,
            NSAttributedString.Key.font: textFont]
        let attributedText = NSAttributedString(string: text, attributes: textAttributes)
        // 3
        let stringSize = attributedText.size()
        // 4
        let textRect = CGRect(x: (pageRect.width - stringSize.width) - 30, y: textTop, width: stringSize.width, height: stringSize.height)
        attributedText.draw(in: textRect)
        // 5
        return textRect.origin.y + textRect.size.height
    }
    
    public static func addText(pageRect: CGRect, xCoor: CGFloat, mWidth: CGFloat, textTop: CGFloat, text: String, textFont: UIFont = UIFont.robotoFont(ofSize: 18)) -> CGFloat {
        // 1
        let paragraphStyle = NSMutableParagraphStyle()
        paragraphStyle.alignment = .right
        paragraphStyle.lineBreakMode = .byWordWrapping
        // 2
        let textAttributes = [
            NSAttributedString.Key.paragraphStyle: paragraphStyle,
            NSAttributedString.Key.font: textFont]
        let attributedText = NSAttributedString(string: text, attributes: textAttributes)
        // 3
        let stringSize = attributedText.size()
        // 4
        let textRect = CGRect(x: xCoor, y: textTop, width: mWidth, height: stringSize.height)
        attributedText.draw(in: textRect)
        // 5
        return textRect.origin.y + textRect.size.height
    }
    
    public static func addText(pageRect: CGRect, xCoor: CGFloat, textTop: CGFloat, text: String, textFont: UIFont = UIFont.robotoFont(ofSize: 18)) -> CGFloat {
        // 1
        let paragraphStyle = NSMutableParagraphStyle()
        paragraphStyle.alignment = .natural
        paragraphStyle.lineBreakMode = .byWordWrapping
        // 2
        let textAttributes = [
            NSAttributedString.Key.paragraphStyle: paragraphStyle,
            NSAttributedString.Key.font: textFont]
        let attributedText = NSAttributedString(string: text, attributes: textAttributes)
        // 3
        let stringSize = attributedText.size()
        // 4
        let textRect = CGRect(x: xCoor, y: textTop+30, width: stringSize.width, height: stringSize.height)
        attributedText.draw(in: textRect)
        // 5
        return textRect.origin.y + textRect.size.height
    }
    
    public static func addImage(pageRect: CGRect, imageTop: CGFloat, image: UIImage) -> CGFloat {
        // 1
        let maxHeight = pageRect.height * 0.25
        let maxWidth = pageRect.width * 0.25
        // 2
        let aspectWidth = maxWidth / image.size.width
        let aspectHeight = maxHeight / image.size.height
        let aspectRatio = min(aspectWidth, aspectHeight)
        // 3
        let scaledWidth = image.size.width * aspectRatio
        let scaledHeight = image.size.height * aspectRatio
        // 4
        let imageRect = CGRect(x: 20, y: imageTop, width: scaledWidth, height: scaledHeight)
        image.draw(in: imageRect)
        // 5
        return imageRect.origin.y + imageRect.size.height
    }
    
    public static func addIcon(pageRect: CGRect, xCoor: CGFloat, imageTop: CGFloat, image: UIImage) -> CGFloat {
        // 1
        let imageRect = CGRect(x: xCoor, y: imageTop, width: 22, height: 22)
        image.draw(in: imageRect)
        // 2
        return imageRect.origin.y + imageRect.size.height
    }
    
    public static func drawLine(_ drawContext: CGContext, pageRect: CGRect, lineTop: CGFloat, x1: CGFloat = 30, x2: CGFloat?) {
        // 1
        drawContext.saveGState()
        // 2
        drawContext.setLineWidth(1.0)
        drawContext.setStrokeColor(UIColor.lightGray.cgColor)

        // 3
        drawContext.move(to: CGPoint(x: x1, y: lineTop))
        drawContext.addLine(to: CGPoint(x: (x2 == nil) ? pageRect.width-30 : x2!, y: lineTop))
        drawContext.strokePath()
        drawContext.restoreGState()
    }
    
    public static func drawItems(_ drawContext: CGContext, pageRect: CGRect, lineTop: CGFloat, items: [Item]) -> CGFloat {
        // 1
        drawContext.saveGState()
        // 2
        drawContext.setLineWidth(44.0)
        drawContext.setStrokeColor(UIColor.purpleLightOpaque.cgColor)

        // 3
        drawContext.move(to: CGPoint(x: 30, y: lineTop))
        drawContext.addLine(to: CGPoint(x: pageRect.width-30, y: lineTop))
        drawContext.strokePath()
        drawContext.restoreGState()
        
        let width = (pageRect.width-30)/8
        let headerTop = lineTop-40
        
        // header
        var headerBottom = addText(pageRect: pageRect, xCoor: 35, textTop: headerTop, text: "Items", textFont: UIFont.robotoBoldFont(ofSize: 18))
        _ = addItemLabel(pageRect: pageRect, xCoor: width*3, width: width, textTop: headerTop, text: "Qty", textFont: UIFont.robotoBoldFont(ofSize: 18))
        _ = addItemLabel(pageRect: pageRect, xCoor: width*4, width: width, textTop: headerTop, text: "Price", textFont: UIFont.robotoBoldFont(ofSize: 18))
        _ = addItemLabel(pageRect: pageRect, xCoor: width*5, width: width, textTop: headerTop, text: "Disc.", textFont: UIFont.robotoBoldFont(ofSize: 18))
        _ = addItemLabel(pageRect: pageRect, xCoor: width*6, width: width-10, textTop: headerTop, text: "Tax", textFont: UIFont.robotoBoldFont(ofSize: 18))
        _ = addItemLabel(pageRect: pageRect, xCoor: width*7, width: width-5, textTop: headerTop, text: "Total", textFont: UIFont.robotoBoldFont(ofSize: 18))
        
        // init total
        var grandTotal = 0.00
        
        // sort ungrouped
        let ungrouped = items.sorted(by: {$0.id > $1.id})
        // group
        let grouped = ungrouped.group(by: {$0.id})
        
        // iterate
        for (_, value) in grouped {
            let qty     = value.count
            let price   = value.first?.price.doubleValue ?? 0.00
            let tax     = price * 0.075
            let total   = (price + tax) * qty.doubleValue
            
            _ = addText(pageRect: pageRect, xCoor: 35, textTop: headerBottom, text: value.first!.title, textFont: UIFont.robotoFont(ofSize: 16))
            _ = addItemLabel(pageRect: pageRect, xCoor: width*3, width: width, textTop: headerBottom, text: qty.stringValue)
            _ = addItemLabel(pageRect: pageRect, xCoor: width*4, width: width, textTop: headerBottom, text: "$\(price.stringValue)")
            _ = addItemLabel(pageRect: pageRect, xCoor: width*5, width: width, textTop: headerBottom, text: "$0.00")
            _ = addItemLabel(pageRect: pageRect, xCoor: width*6, width: width-10, textTop: headerBottom, text: "$\(tax.stringValue)")
            headerBottom = addItemLabel(pageRect: pageRect, xCoor: width*7, width: width-5, textTop: headerBottom, text: "$\(total.stringValue)")
            
            grandTotal += total
        }
        
        drawLine(drawContext, pageRect: pageRect, lineTop: headerBottom+40, x2: nil)
        
        // grand total
        let grandTotalBottom = addText(pageRect: pageRect, xCoor: 30, textTop: headerBottom+20, text: "Grand Total", textFont: UIFont.robotoBoldFont(ofSize: 18))
        _ = addItemLabel(pageRect: pageRect, xCoor: width*6, width: width*2, textTop: headerBottom+20, text: "$\(grandTotal.stringValue)", textFont: UIFont.robotoBoldFont(ofSize: 18))
        
        return grandTotalBottom
    }
    
    public static func addItemLabel(pageRect: CGRect, xCoor: CGFloat, width: CGFloat, textTop: CGFloat, text: String, textFont: UIFont = UIFont.robotoFont(ofSize: 16)) -> CGFloat {
        // 1
        let paragraphStyle = NSMutableParagraphStyle()
        paragraphStyle.alignment = .right
        paragraphStyle.lineBreakMode = .byWordWrapping
        // 2
        let textAttributes = [
            NSAttributedString.Key.paragraphStyle: paragraphStyle,
            NSAttributedString.Key.font: textFont]
        let attributedText = NSAttributedString(string: text, attributes: textAttributes)
        // 3
        let stringSize = attributedText.size()
        // 4
        let textRect = CGRect(x: xCoor, y: textTop+30, width: width, height: stringSize.height)
        attributedText.draw(in: textRect)
        // 5
        return textRect.origin.y + textRect.size.height
    }
    
    public static func addSignature(pageRect: CGRect, imageTop: CGFloat, image: UIImage, xCoor: CGFloat = 30) -> CGFloat {
        // 1
        let maxHeight = pageRect.height * 0.25
        let maxWidth = pageRect.width * 0.25
        // 2
        let aspectWidth = maxWidth / image.size.width
        let aspectHeight = maxHeight / image.size.height
        let aspectRatio = min(aspectWidth, aspectHeight)
        // 3
        let scaledWidth = image.size.width * aspectRatio
        let scaledHeight = image.size.height * aspectRatio
        // 4
        let imageRect = CGRect(x: xCoor, y: imageTop, width: scaledWidth, height: scaledHeight)
        image.draw(in: imageRect)
        // 5
        return imageRect.origin.y + imageRect.size.height
    }
    
    public static func addBadge(pageRect: CGRect, status: String) {
        // 1
        var color: UIColor?
        // 2
        if status == "Draft" || status == "New" {
            color = UIColor(rgb: 0x00BFFF)
        } else if status == "Submitted" || status == "Paid" {
            color = UIColor.systemGreen
        } else if status == "Accepted" || status == "Overdue" {
            color = UIColor(rgb: 0x9400D3)
        } else if status == "Scheduled" {
            color = UIColor(rgb: 0x808000)
        } else if status == "Lost" {
            color = UIColor.systemRed
        }
        // 3
        let view = UIView(frame: CGRect(x: 0, y: 0, width: 300, height: 300))
        view.backgroundColor = color!
        view.addDiamondMask()
        // 4
        let label = UILabel(frame: CGRect(x: 130, y: 140, width: 150, height: 150))
        label.font = UIFont.robotoFont(ofSize: 20)
        label.text = status
        label.textColor = .white
        label.textAlignment = .center
        label.transform = CGAffineTransform(rotationAngle: -CGFloat.pi / CGFloat(180/45))
        view.addSubview(label)
        // 5
        let image = view.asImage()
        // 6
        let imageRect = CGRect(x:-150, y: -150, width: 300, height: 300)
        image.draw(in: imageRect)
    }
    
    public static func addBadge(status: String) -> UIImage {
        // 1
        var color: UIColor?
        // 2
        if status == "Draft" || status == "New" {
            color = UIColor(rgb: 0x00BFFF)
        } else if status == "Submitted" || status == "Paid" {
            color = UIColor.systemGreen
        } else if status == "Accepted" || status == "Overdue" {
            color = UIColor(rgb: 0x9400D3)
        } else if status == "Scheduled" {
            color = UIColor(rgb: 0x808000)
        } else if status == "Lost" {
            color = UIColor.systemRed
        }
        // 3
        let view = UIView(frame: CGRect(x: 0, y: 0, width: 300, height: 300))
        view.backgroundColor = color!
        view.addDiamondMask()
        // 4
        let label = UILabel(frame: CGRect(x: 130, y: 140, width: 150, height: 150))
        label.font = UIFont.robotoFont(ofSize: 20)
        label.text = status
        label.textColor = .white
        label.textAlignment = .center
        label.transform = CGAffineTransform(rotationAngle: -CGFloat.pi / CGFloat(180/45))
        view.addSubview(label)
        // 5
        return view.asImage()
    }
    
    public static func addWidget(pdfView: PDFView, buttonTop: CGFloat, xCoor: CGFloat, icon: UIImage) -> PDFAnnotation? {
        // 1
        guard let page = pdfView.currentPage else { return nil }
        // 2
        let imageBounds = CGRect(x: xCoor, y: buttonTop,  width: 24, height: 24)
        let annotation = PDFImageAnnotation(with: icon,  forBounds: imageBounds, withProperties: nil)
        page.addAnnotation(annotation)
        // 3
        return annotation
    }

}

// MARK: - Extension -

extension UIView {
    
    func addDiamondMask(cornerRadius: CGFloat = 0) {
        let path = UIBezierPath()
        path.move(to: CGPoint(x: bounds.midX, y: bounds.minY + cornerRadius))
        path.addLine(to: CGPoint(x: bounds.maxX - cornerRadius, y: bounds.midY))
        path.addLine(to: CGPoint(x: bounds.midX, y: bounds.maxY - cornerRadius))
        path.addLine(to: CGPoint(x: bounds.minX + cornerRadius, y: bounds.midY))
        path.close()

        let shapeLayer = CAShapeLayer()
        shapeLayer.path = path.cgPath
        shapeLayer.fillColor = UIColor.white.cgColor
        shapeLayer.strokeColor = UIColor.white.cgColor
        shapeLayer.lineWidth = cornerRadius * 2
        shapeLayer.lineJoin = CAShapeLayerLineJoin.round
        shapeLayer.lineCap = CAShapeLayerLineCap.round

        layer.mask = shapeLayer
    }
}
