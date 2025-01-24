<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (! function_exists('get_automation_options')) {
    function get_automation_options()
    {
        return [
            'eventOptions'  => [
                'lead'     => [
                    'created'    => 'is created',
                    'has_status' => 'has a status',
                    'scheduled'  => 'is scheduled',
                ],
                'job'      => [
                    'created'    => 'is created',
                    'has_status' => 'has a status',
                ],
                'estimate' => [
                    'created'  => 'is created',
                    'sent'     => 'is sent',
                    'approved' => 'is approved',
                    'declined' => 'is declined',
                ],
                'invoice'  => [
                    'created'  => 'is created',
                    'sent'     => 'is sent',
                    'due'      => 'is due',
                    'past_due' => 'is past due',
                ],
            ],
            'targetOptions' => [
                'technician' => 'assigned tech',
                'sales_rep' => 'sales representative',
                'client'     => 'client',
                'user'       => 'to user',
            ],
            'actionOptions' => [
                'send_sms' => 'a text message',
                'send_email' => 'an email',
                'send_sms_and_email' => 'a text message and an email',
            ],
            'timeOptions'   => [
                '10'   => '10 minutes',
                '15'   => '15 minutes',
                '30'   => '30 minutes',
                '120'  => '2 hours',
                '1440' => '1 day',
                '0'    => 'immediately',
            ],
            'timingOptions' => [
                'ahead_of' => 'ahead of',
                'after'    => 'after',
            ],
            'dateOptions'   => [
                'scheduled_date' => 'scheduled date',
                'end_date'       => 'end date',
            ],
        ];
    }
}

if (! function_exists('get_automation_email_config')) {
    function get_automation_email_config()
    {
        return [
            'reminders' => [
                'templates' => [
                    'client'     => [
                        'subject' => "Reminder: Upcoming Service Appointment",
                        'body'    => "
                            <p>Hi {first_name},</p>
                            <p>This is a friendly reminder about your upcoming service appointment with us at {account_business_name}.</p>
                            <p><strong>Appointment details:</strong></p>
                            <p><strong>Date: </strong>{start_date} at {start_time}</p>
                            <p><strong>Address: </strong> {job_location}</p>
                            <p><strong>Technician(s): </strong> {tech_names}</p>
                            <p>Feel free to call or text us if you have any updates or questions!</p>
                        ",
                    ],
                    'technician' => [
                        'subject' => "Reminder: Service Appointment",
                        'body'    => "
                            <p><strong>Service Appointment Reminder</strong></p>
                            <p><strong>Job ID: </strong>{job_number}</p>
                            <p><strong>Client: </strong>{first_name} {last_name}</p>
                            <p><strong>Date: </strong>{start_date} at {start_time}</p>
                            <p><strong>Address: </strong>{job_location}</p>
                            <p><strong>Job Type: </strong>{job_type}</p>
                            <p><strong>Job Description: </strong>{job_description}</p>
                        ",
                    ],
                ],
            ],
            'marketing' => [
                'templates' => [
                    'client' => [
                        'subject' => "Exciting Offers Just for You!",
                        'body'    => "
                            <p>Hi {client_first_name},</p>
                            <p>We have exciting offers tailored just for you!</p>
                            <p><strong>Discount:</strong> {discount_code}</p>
                            <p><strong>Expires:</strong> {expiry_date}</p>
                            <p>Don't miss out! Visit us at {website_url}</p>
                        ",
                    ],
                ],
            ],
            'followUps' => [
                'templates' => [
                    'client' => [
                        'subject' => "Follow-up on Your Recent Service",
                        'body'    => "
                            <p>Hi {client_first_name},</p>
                            <p>We hope you're satisfied with the service we provided. We'd love to hear your feedback.</p>
                            <p><a href='{feedback_link}'>Click here to leave feedback</a>.</p>
                            <p>Thank you for choosing {account_business_name}!</p>
                        ",
                    ],
                ],
            ],
            'call'      => [
                'templates' => [
                    'tech' => [
                        'subject' => "Scheduled Call Reminder",
                        'body'    => "
                            <p>Hi {tech_name},</p>
                            <p>You have a scheduled call with the following details:</p>
                            <p><strong>Client:</strong> {client_first_name} {client_last_name}</p>
                            <p><strong>Date:</strong> {call_date} at {call_time}</p>
                            <p><strong>Topic:</strong> {call_topic}</p>
                            <p>Please be prepared for the call.</p>
                        ",
                    ],
                ],
            ],
        ];
    }
}

if (! function_exists('generateAutomationDescription')) {
    function generateAutomationDescription($automation)
    {
        // Fetch the options from the helper function
        $options = get_automation_options();

        // Build the trigger description
        $description = "When a ";

        // Add entity (e.g., job, lead, etc.)
        $description .= $automation->entity;

        // Add the status if available
        if (! empty($automation->trigger_event)) {
            $eventText = isset($options['eventOptions'][$automation->entity][$automation->trigger_event])
            ? $options['eventOptions'][$automation->entity][$automation->trigger_event]
            : '';
            $description .= " " . $eventText;
        }

        // Add event type (if available)
        if (! empty($automation->trigger_status)) {
            $statusText = ucfirst($automation->trigger_status);
            $description .= " of " . $statusText;
        }

        if (! empty($automation->target)) {
            $actionText = isset($options['targetOptions'][$automation->target])
            ? $options['targetOptions'][$automation->target]
            : ucfirst($automation->target);
            $description .= " send " . $actionText;
        }

        // Add action (e.g., send an email, send a text message, etc.)
        if (! empty($automation->trigger_action)) {
            $actionText = isset($options['actionOptions'][$automation->trigger_action])
            ? $options['actionOptions'][$automation->trigger_action]
            : ucfirst($automation->trigger_action);
            $description .= " " . $actionText;
        }

        // Add time reference (if available)
        if (isset($automation->trigger_time)) {
            $formattedTime = formatTriggerTime($automation->trigger_time);

            $description .= " " . $formattedTime;
        }

        // Add timing and date reference (if available)
        if (!empty($automation->trigger_time)) {
            $timingText    = $options['timingOptions'][$automation->timing_reference] ?? '';
            $dateText      = $options['dateOptions'][$automation->date_reference] ?? 'scheduled date';

            $description .= " " . $timingText . " the " . $dateText;
        }


        return $description;
    }

    function formatTriggerTime($triggerTime)
    {

        if ($triggerTime >= 1440) { // 1440 minutes = 1 day
            $days = floor($triggerTime / 1440);
            return $days . " day" . ($days > 1 ? "s" : "");
        } elseif ($triggerTime >= 60) { // 60 minutes = 1 hour
            $hours = floor($triggerTime / 60);
            return $hours . " hour" . ($hours > 1 ? "s" : "");
        } elseif ($triggerTime == 0) { // 0
            return 'immediately';
        } else {
            return $triggerTime . " minute" . ($triggerTime > 1 ? "s" : "");
        }
    }

}

if (! function_exists('isValueValid')) {
    function isValueValid($value)
    {
        return isset($value) && $value !== null && ! empty($value);
    }
}

if (!function_exists('getRemindersTemplate')) {
    /**
     * Get predefined card configurations.
     *
     * @return array
     */
    function getRemindersTemplate()
    {
        return [
              [
                'title' => 'Immediate Notice / Client Reminder',
                'description' => 'Send immediate notice to a client.',
                'onclick' => "populateModal({'entity': 'job', 'event': 'has_status', 'target': 'client', 'action': 'send_email', 'time': '0'})"
            ],

            [
                'title' => '2 hours / Tech Reminder',
                'description' => 'Send an email to a technician 2 hours ahead of the job.',
                'onclick' => "populateModal({'entity': 'job', 'event': 'has_status', 'target': 'technician', 'action': 'send_email', 'time': '120', 'timing': 'ahead_of', 'date': 'scheduled_date'})"
            ],
            [
                'title' => '4 hours / Tech Reminder',
                'description' => 'Send an email to a technician 4 hours ahead of the job.',
                'onclick' => "populateModal({'entity': 'job', 'event': 'has_status', 'target': 'technician', 'action': 'send_email', 'time': '240', 'timing': 'ahead_of', 'date': 'scheduled_date'})"
            ],
            [
                'title' => '1 Day Notice / Client Reminder',
                'description' => 'Send an email to a client 1 day ahead of the job.',
                'onclick' => "populateModal({'entity': 'job', 'event': 'created', 'target': 'client', 'action': 'send_email', 'time': '1440', 'timing': 'after', 'date': 'scheduled_date'})"
            ]
        ];
    }
}
