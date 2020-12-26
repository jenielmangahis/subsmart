//
//  ExampleCalloutView.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 06/10/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import MapKit

protocol ExampleCalloutViewDelegate {
    func mapView(_ mapView: MKMapView, didTapDetailsButton button: UIButton, for annotation: MKAnnotation)
}

/// Callout that shows title and subtitle
///
/// This is concrete subclass of `CalloutView` that has two labels. Note, to
/// have the callout resized appropriately, all this class needed to do was
/// update is the constraints between these two labels (which have intrinsic
/// sizes based upon the text contained therein) and the `contentView`.
/// Autolayout takes care of everything else.
///
/// Note, I've added observers for the `title` and `subtitle` properties of
/// the annotation view. Generally you don't need to worry about that, but it
/// can be useful if you're retrieving details about the annotation asynchronously
/// but you want to show the pin while that's happening. You just want to make sure
/// that when the annotation's relevant properties are retrieved, that we update
/// this callout view (if it's being shown at all).
class ExampleCalloutView: CalloutView {
    
    private var titleLabel: UILabel = {
        let label = UILabel()
        label.translatesAutoresizingMaskIntoConstraints = false
        label.textColor = .black
        label.font = .preferredFont(forTextStyle: .callout)
        
        return label
    }()
    
    private var subtitleLabel: UILabel = {
        let label = UILabel()
        label.translatesAutoresizingMaskIntoConstraints = false
        label.textColor = .black
        label.font = .preferredFont(forTextStyle: .caption1)
        
        return label
    }()
    
    private var detailsButton: UIButton = {
        let button = UIButton(type: .roundedRect)
        button.translatesAutoresizingMaskIntoConstraints = false
        button.setTitle("Details", for: .normal)
        button.setTitleColor(.black, for: .normal)
        button.backgroundColor = .clear
        
        return button
    }()
    
    override init(annotation: MKAnnotation) {
        super.init(annotation: annotation)
        
        configure()
        
        updateContents(for: annotation)
    }
    
    required init?(coder aDecoder: NSCoder) {
        fatalError("Should not call init(coder:)")
    }
    
    /// Update callout contents
    
    private func updateContents(for annotation: MKAnnotation) {
        //titleLabel.text = annotation.title ?? "Unknown"
        //subtitleLabel.text = annotation.subtitle ?? nil
        detailsButton.setTitle(annotation.title ?? "Unknown", for: .normal)
    }
    
    /// Add constraints for subviews of `contentView`
    
    private func configure() {
        translatesAutoresizingMaskIntoConstraints = false
        
        //contentView.addSubview(titleLabel)
        //contentView.addSubview(subtitleLabel)
        contentView.addSubview(detailsButton)
        detailsButton.addTarget(self, action: #selector(didTapDetailsButton(_:)), for: .touchUpInside)
        
        let views: [String: UIView] = [
            /*"titleLabel": titleLabel,*/
            "subtitleLabel": subtitleLabel,
            "detailsButton": detailsButton
        ]
        
        /*let vflStrings = [
            "V:|[titleLabel][subtitleLabel][detailsButton]|",
            "H:|[titleLabel]|",
            "H:|[subtitleLabel]|",
            "H:|[detailsButton]|"
        ]*/
        let vflStrings = [
            "V:|[detailsButton]|",
            "H:|[detailsButton]|"
        ]
        
        for vfl in vflStrings {
            contentView.addConstraints(NSLayoutConstraint.constraints(withVisualFormat: vfl, metrics: nil, views: views))
        }
    }
    
    // This is an example method, defined by `CalloutView`, which is called when you tap on the callout
    // itself (but not one of its subviews that have user interaction enabled).
    
    @objc override func didTouchUpInCallout(_ sender: Any) {
        print(#function)
    }
    
    /// Callout detail button was tapped
    ///
    /// This is an example action method for tapping the button we added in this subclass.
    /// You'd probably either have a button like this method, or not have a button and use
    /// the above `didTouchUpCallout`, above, but not both. But I'm showing both, so you
    /// can pick whichever you prefer.
    ///
    /// If you want the view controller to do something when you tap on the button, you would:
    ///
    ///  - Want to declare a protocol to which your map view delegate will conform; and
    ///  - Actually see if map view's delegate conforms to this protocol and, if so, call the method.
    ///
    /// - Parameter sender: The button we tapped on in the callout.
    
    @objc func didTapDetailsButton(_ sender: UIButton) {
        if let mapView = mapView, let delegate = mapView.delegate as? ExampleCalloutViewDelegate {
            delegate.mapView(mapView, didTapDetailsButton: sender, for: annotation!)
        }
    }
    
    /// Map view
    ///
    /// Navigate up view hierarchy until we find `MKMapView`.
    
    var mapView: MKMapView? {
        var view = superview
        while view != nil {
            if let mapView = view as? MKMapView { return mapView }
            view = view?.superview
        }
        return nil
    }
}
