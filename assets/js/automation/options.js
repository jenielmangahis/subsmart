// options.js

console.log('test')

const eventOptions = {
    lead: [
        { text: "is created", value: "created" },
        { text: "has a status", value: "status" },
        { text: "is scheduled", value: "scheduled" }
    ],
    job: [
        { text: "is created", value: "created" },
        { text: "has a status", value: "status" }
    ],
    estimate: [
        { text: "is created", value: "created" },
        { text: "is sent", value: "sent" },
        { text: "is approved", value: "approved" },
        { text: "is declined", value: "declined" }
    ],
    invoice: [
        { text: "is created", value: "created" },
        { text: "is sent", value: "sent" },
        { text: "is due", value: "due" },
        { text: "is past due", value: "past_due" }
    ]
};

const targetOptions = [
    { text: "assigned tech", value: "technician" },
    { text: "client", value: "client" },
    { text: "to user", value: "user" }
];

const actionOptions = [
    { text: "send a text message", value: "send_sms" },
    { text: "send an email", value: "send_email" },
    { text: "send both text and email", value: "send_sms_and_email" }
];

const timeOptions = [
    { text: "10 minutes", value: "10" },
    { text: "15 minutes", value: "15" },
    { text: "30 minutes", value: "30" },
    { text: "2 hours", value: "120" }, // in minutes
    { text: "1 day", value: "1440" }, // in minutes
    { text: "immediately", value: "0" } // 0 minutes
];

const timingOptions = [
    { text: "ahead of", value: "ahead_of" },
    { text: "after", value: "after" }
];

const dateOptions = [
    { text: "scheduled date", value: "scheduled_date" },
    { text: "end date", value: "end_date" }
];

// Export all options as a module to use in other files
export { eventOptions, targetOptions, actionOptions, timeOptions, timingOptions, dateOptions };
