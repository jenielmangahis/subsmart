//
//  MockSocket.swift
//  nSmarTrac
//
//  Created by Jonah Abanil on 25/05/2020.
//  Copyright © 2020 nSmarTrac LLC. All rights reserved.
//

import UIKit
import MessageKit

final class MockSocket {
    
    static var shared = MockSocket()
    
    private var timer: Timer?
    
    private var queuedMessage: MockMessage?
    
    private var onNewMessageCode: ((MockMessage) -> Void)?
    
    private var onTypingStatusCode: (() -> Void)?
    
    private var connectedUsers: [MockUser] = []
    
    private init() {}
    
    @discardableResult
    func connect(with senders: [MockUser]) -> Self {
        disconnect()
        connectedUsers = senders
        timer = Timer.scheduledTimer(timeInterval: 2.5, target: self, selector: #selector(handleTimer), userInfo: nil, repeats: true)
        return self
    }
    
    @discardableResult
    func disconnect() -> Self {
        timer?.invalidate()
        timer = nil
        onTypingStatusCode = nil
        onNewMessageCode = nil
        return self
    }
    
    @discardableResult
    func onNewMessage(code: @escaping (MockMessage) -> Void) -> Self {
        onNewMessageCode = code
        return self
    }
    
    @discardableResult
    func onTypingStatus(code: @escaping () -> Void) -> Self {
        onTypingStatusCode = code
        return self
    }
    
    @objc
    private func handleTimer() {
        if let message = queuedMessage {
            onNewMessageCode?(message)
            queuedMessage = nil
        } else {
            let sender = arc4random_uniform(1) % 2 == 0 ? connectedUsers.first! : connectedUsers.last!
            SampleData.shared.getMessages(count: 1, allowedSenders: [sender]) { (message) in
                queuedMessage = message.first
            }
            onTypingStatusCode?()
        }
    }
    
}
