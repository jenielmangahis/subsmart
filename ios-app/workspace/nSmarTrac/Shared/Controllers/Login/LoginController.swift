//
//  LoginController.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 04/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import DLRadioButton
import FontAwesome_swift
import RxSwift
import RxCocoa
import SVProgressHUD

class LoginController: UIViewController {
    
    // MARK: - Properties -
    
    @IBOutlet var emailField: MaterialTextField!
    @IBOutlet var passwordField: MaterialTextField!
    @IBOutlet var checkbox: DLRadioButton!
    @IBOutlet var submitButton: DesignableButton!
    @IBOutlet var problemSignInLabel: UILabel!
    @IBOutlet var testButton: DesignableButton!
    @IBOutlet var brandLabel: UILabel!
    
    fileprivate var disposeBag = DisposeBag()
    fileprivate var validFormFields: Variable<Set<MaterialTextField>> = Variable([])
    

    // MARK: - Lifecycle -
    
    override func viewDidLoad() {
        super.viewDidLoad()
        //prepareFormFields()
        
        emailField.configureForLogin()
        passwordField.configureForLogin()
        
        //emailField.text = "jpabanil@icloud.com"
        //passwordField.text = "Password1"
        
        Utils.configureCheckbox(checkbox, "Keep me signed in")
        brandLabel.text = Global.brandingText
        
        let tap: UITapGestureRecognizer = UITapGestureRecognizer(target: self, action: #selector(dismissKeyboard(_:)))
        view.addGestureRecognizer(tap)
    }
    
    // MARK: - Actions -
    
    @objc func dismissKeyboard(_ sender: UITapGestureRecognizer) {
        self.view.endEditing(true)
    }
    
    @IBAction func submitButtonTapped(_ sender: Any) {
        
        self.view.endEditing(true)
        
        let email = emailField.text!
        let password = passwordField.text!
        
        SVProgressHUD.setDefaultMaskType(.clear)
        SVProgressHUD.show(withStatus: "Signing in...")
        App.shared.appUser.login(email: email, password: password) { (_, error) in
            SVProgressHUD.setDefaultMaskType(.none)
            SVProgressHUD.dismiss()
            guard error == nil else {
                return SVProgressHUD.showError(withStatus: error!.localizedDescription)
            }
            
            App.shared.selectedMenu = .Home
            NotificationCenter.default.post(name: Notifications.didLogin, object: self, userInfo: nil)
        }
    }
    
    @IBAction func testButtonTapped(_ sender: Any) {
    }
    
    // MARK: - Form Fields -
    
    func prepareFormFields() {
        
        submitButton.isEnabled = true
        submitButton.setBackgroundColor(AppTheme.defaultColor, for: .normal)
        submitButton.setBackgroundColor(UIColor.grayColor, for: .disabled)
        
        validFormFields
            .asObservable()
            .subscribe(onNext: { [unowned self] _ in
                UIView.animate(withDuration: 0.3, animations: {
                    if !self.emailField.text!.isEmpty && !self.passwordField.text!.isEmpty {
                        self.submitButton.isEnabled = true
                    } else {
                        self.submitButton.isEnabled = false
                    }
                })
            })
            .disposed(by: disposeBag)

    }
    
    /*func prepareTextField(textField: MaterialTextField) {
        textField.rx.text
            .asObservable()
            .debounce(0.5, scheduler: MainScheduler.instance)
            .subscribe(onNext: { [unowned self] (text) in
                guard let t = text else { return }
                if Utils.shared.isValidEmail(t) {
                    self.validFormFields.value.insert(textField)
                } else {
                    self.validFormFields.value.remove(textField)
                }
            })
            .disposed(by: disposeBag)
    }*/
}
