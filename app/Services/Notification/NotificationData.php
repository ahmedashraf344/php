<?php

namespace App\Services\Notification;

use Illuminate\Support\Facades\Log;

class NotificationData
{
    protected $key, $case, $concatenation_ar, $concatenation_en, $redirectRoute;

    public function __construct(string $key, string $case, array $concatenation_ar = [], array $concatenation_en = [], string $redirectRoute = null)
    {
        $this->key = $key;
        $this->case = $case;
        $this->concatenation_ar = $concatenation_ar;
        $this->concatenation_en = $concatenation_en;
        $this->redirectRoute = $redirectRoute;
    }


    public function messageKeys()
    {
        return [
            'task' => [
                'meeting' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_task_create.subject'),
                        'data' => config('notification-ar.meeting_task_create.line1') . ' '
                            . value_of($this->concatenation_ar, 0)
                            . ' ' . config('notification-ar.meeting_task_create.line2') . ' '
                            . value_of($this->concatenation_ar, 1),
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_task_create.subject'),
                        'data' => config('notification-en.meeting_task_create.line1') . ' '
                            . value_of($this->concatenation_en, 0)
                            . ' ' . config('notification-en.meeting_task_create.line2') . ' '
                            . value_of($this->concatenation_en, 1),
                    ]
                ],
                'meeting_third_party' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_task_create.subject'),
                        'data' => config('notification-ar.meeting_task_create.line1') . ' '
                            . value_of($this->concatenation_ar, 0)
                            . ' ' . config('notification-ar.meeting_task_create.line2') . ' '
                            . value_of($this->concatenation_ar, 1),
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_task_create.subject'),
                        'data' => config('notification-en.meeting_task_create.line1') . ' '
                            . value_of($this->concatenation_en, 0)
                            . ' ' . config('notification-en.meeting_task_create.line2') . ' '
                            . value_of($this->concatenation_en, 1),
                    ]
                ],
                'agenda' => [
                    'ar' => [
                        'subject' => config('notification-ar.agenda_task_create.subject'),
                        'data' => config('notification-ar.agenda_task_create.line1') . ' '
                            . value_of($this->concatenation_ar, 0)
                            . ' ' . config('notification-ar.agenda_task_create.line2') . ' '
                            . value_of($this->concatenation_ar, 1)
                            . ' ' . config('notification-ar.agenda_task_create.line3') . ' '
                            . value_of($this->concatenation_ar, 2),
                    ],
                    'en' => [
                        'subject' => config('notification-en.agenda_task_create.subject'),
                        'data' => config('notification-en.agenda_task_create.line1') . ' '
                            . value_of($this->concatenation_en, 0)
                            . ' ' . config('notification-en.agenda_task_create.line2') . ' '
                            . value_of($this->concatenation_en, 1)
                            . ' ' . config('notification-en.agenda_task_create.line3') . ' '
                            . value_of($this->concatenation_en, 2),
                    ]
                ],
                'agenda_third_party' => [
                    'ar' => [
                        'subject' => config('notification-ar.agenda_third_party_task_create.subject'),
                        'data' => config('notification-ar.agenda_third_party_task_create.line1') . ' '
                            . value_of($this->concatenation_ar, 0)
                            . ' ' . config('notification-ar.agenda_third_party_task_create.line2') . ' '
                            . value_of($this->concatenation_ar, 1)
                            . ' ' . config('notification-ar.agenda_third_party_task_create.line3') . ' '
                            . value_of($this->concatenation_ar, 2)
                            . ' ' . config('notification-ar.agenda_third_party_task_create.line4') . ' '
                            . value_of($this->concatenation_ar, 3),
                    ],
                    'en' => [
                        'subject' => config('notification-en.agenda_third_party_task_create.subject'),
                        'data' => config('notification-en.agenda_third_party_task_create.line1') . ' '
                            . value_of($this->concatenation_en, 0)
                            . ' ' . config('notification-en.agenda_third_party_task_create.line2') . ' '
                            . value_of($this->concatenation_en, 1)
                            . ' ' . config('notification-en.agenda_third_party_task_create.line3') . ' '
                            . value_of($this->concatenation_en, 2)
                            . ' ' . config('notification-en.agenda_third_party_task_create.line4') . ' '
                            . value_of($this->concatenation_en, 3)
                        ,
                    ]
                ],
                'general' => [
                    'ar' => [
                        'subject' => config('notification-ar.task_general.subject'),
                        'data' => config('notification-ar.task_general.line1') . ' '
                            . value_of($this->concatenation_ar, 0),
                    ],
                    'en' => [
                        'subject' => config('notification-en.task_general.subject'),
                        'data' => config('notification-en.task_general.line1') . ' '
                            . value_of($this->concatenation_en, 0),
                    ]
                ],
                'status' => [
                    'ar' => [
                        'subject' => config('notification-ar.task_status_update.subject'),
                        'data' => config('notification-ar.task_status_update.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.task_status_update.line2'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.task_status_update.subject'),
                        'data' => config('notification-en.task_status_update.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-ar.task_status_update.line2'),
                    ]
                ],
                'status_agenda_third_party' => [
                    'ar' => [
                        'subject' => config('notification-ar.task_status_agenda_third_party.subject'),
                        'data' => config('notification-ar.task_status_agenda_third_party.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.task_status_agenda_third_party.line2') . ' '
                            . value_of($this->concatenation_ar, 1) . ' '
                            . config('notification-ar.task_status_agenda_third_party.line3') . ' '
                            . value_of($this->concatenation_ar, 2) . ' '
                            . config('notification-ar.task_status_agenda_third_party.line4'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.task_status_agenda_third_party.subject'),
                        'data' => config('notification-en.task_status_agenda_third_party.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.task_status_agenda_third_party.line2') . ' '
                            . value_of($this->concatenation_en, 1) . ' '
                            . config('notification-en.task_status_agenda_third_party.line3') . ' '
                            . value_of($this->concatenation_en, 2) . ' '
                            . config('notification-en.task_status_agenda_third_party.line4'),
                    ]
                ],
                'status_general_third_party' => [
                    'ar' => [
                        'subject' => config('notification-ar.task_status_general_third_party.subject'),
                        'data' => config('notification-ar.task_status_general_third_party.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.task_status_general_third_party.line2'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.task_status_general_third_party.subject'),
                        'data' => config('notification-en.task_status_general_third_party.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.task_status_general_third_party.line2'),
                    ]
                ],
                'alert_task_date' => [
                    'ar' => [
                        'subject' => config('notification-ar.task_date_alert.subject'),
                        'data' => config('notification-ar.task_date_alert.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.task_date_alert.line2'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.task_date_alert.subject'),
                        'data' => config('notification-en.task_date_alert.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.task_date_alert.line2'),
                    ]
                ],
                'alert_creator_third_party_task_date' => [
                    'ar' => [
                        'subject' => config('notification-ar.task_alert_creator_agenda_third_party_task_date.subject'),
                        'data' => config('notification-ar.task_alert_creator_agenda_third_party_task_date.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.task_alert_creator_agenda_third_party_task_date.line2'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.task_alert_creator_agenda_third_party_task_date.subject'),
                        'data' => config('notification-en.task_alert_creator_agenda_third_party_task_date.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.task_alert_creator_agenda_third_party_task_date.line2'),
                    ]
                ],
                'alert_third_party_task_date' => [
                    'ar' => [
                        'subject' => config('notification-ar.task_alert_agenda_third_party_task_date.subject'),
                        'data' => config('notification-ar.task_alert_agenda_third_party_task_date.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.task_alert_agenda_third_party_task_date.line2'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.task_alert_agenda_third_party_task_date.subject'),
                        'data' => config('notification-en.task_alert_agenda_third_party_task_date.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.task_alert_agenda_third_party_task_date.line2'),
                    ]
                ]
            ],
            'profile' => [
                'update' => [
                    'ar' => [
                        'subject' => config('notification-ar.profile_update.subject'),
                        'data' => config('notification-ar.profile_update.line1') . ' '
                            . value_of($this->concatenation_ar, 0),
                    ],
                    'en' => [
                        'subject' => config('notification-en.profile_update.subject'),
                        'data' => config('notification-en.profile_update.line1') . ' '
                            . value_of($this->concatenation_en, 0),
                    ]
                ],
                'update_reminder' => [
                    'ar' => [
                        'subject' => config('notification-ar.profile_update_reminder.subject'),
                        'data' => config('notification-ar.profile_update_reminder.line1'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.profile_update_reminder.subject'),
                        'data' => config('notification-en.profile_update_reminder.line1'),
                    ]
                ]
            ],
            'disclosure' => [
                'member_sign' => [
                    'ar' => [
                        'subject' => config('notification-ar.disclosure_member_sign.subject'),
                        'data' => config('notification-ar.disclosure_member_sign.line1') . ' '
                            . value_of($this->concatenation_ar, 0),
                    ],
                    'en' => [
                        'subject' => config('notification-en.disclosure_member_sign.subject'),
                        'data' => config('notification-en.disclosure_member_sign.line1') . ' '
                            . value_of($this->concatenation_en, 0),
                    ]
                ],
                'approve_sign' => [
                    'ar' => [
                        'subject' => config('notification-ar.disclosure_approve_sign.subject'),
                        'data' => config('notification-ar.disclosure_approve_sign.line1'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.disclosure_approve_sign.subject'),
                        'data' => config('notification-en.disclosure_approve_sign.line1'),
                    ]
                ],
                'reject_sign' => [
                    'ar' => [
                        'subject' => config('notification-ar.disclosure_reject_sign.subject'),
                        'data' => config('notification-ar.disclosure_reject_sign.line1'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.disclosure_reject_sign.subject'),
                        'data' => config('notification-en.disclosure_reject_sign.line1'),
                    ]
                ],
                'alert_publish' => [
                    'ar' => [
                        'subject' => config('notification-ar.disclosure_publish_alert.subject'),
                        'data' => config('notification-ar.disclosure_publish_alert.line1'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.disclosure_publish_alert.subject'),
                        'data' => config('notification-en.disclosure_publish_alert.line1'),
                    ]
                ],
                'alert_non_signed_before_publish' => [
                    'ar' => [
                        'subject' => config('notification-ar.disclosure_non_signed_alert_before_next_publish.subject'),
                        'data' => config('notification-ar.disclosure_non_signed_alert_before_next_publish.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.disclosure_non_signed_alert_before_next_publish.' . value_of($this->concatenation_ar, 1)) . ' '
                            . config('notification-ar.disclosure_non_signed_alert_before_next_publish.line4') . ' '
                            . value_of($this->concatenation_ar, 2) . ' '
                            . config('notification-ar.disclosure_non_signed_alert_before_next_publish.line5'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.disclosure_non_signed_member_alert_before_next_publish.subject'),
                        'data' => config('notification-en.disclosure_non_signed_alert_before_next_publish.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.disclosure_non_signed_alert_before_next_publish.' . value_of($this->concatenation_en, 1)) . ' '
                            . config('notification-en.disclosure_non_signed_alert_before_next_publish.line4') . ' '
                            . value_of($this->concatenation_en, 2) . ' '
                            . config('notification-en.disclosure_non_signed_alert_before_next_publish.line5'),
                    ]
                ],
            ],
            'meeting_invitation' => [
                'third_party' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_invitation_third_party.subject'),
                        'data' => config('notification-ar.meeting_invitation_third_party.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_invitation_third_party.line2') . ' '
                            . value_of($this->concatenation_ar, 1) . ' '
                            . config('notification-ar.meeting_invitation_third_party.line3') . ' '
                            . value_of($this->concatenation_ar, 2) . ' '
                            . config('notification-ar.meeting_invitation_third_party.line4')
                        ,
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_invitation_third_party.subject'),
                        'data' => config('notification-en.meeting_invitation_third_party.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_invitation_third_party.line2') . ' '
                            . value_of($this->concatenation_en, 1) . ' '
                            . config('notification-en.meeting_invitation_third_party.line3') . ' '
                            . value_of($this->concatenation_en, 2) . ' '
                            . config('notification-en.meeting_invitation_third_party.line4'),
                    ]
                ],
                'shareholder' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_invitation_shareholder.subject'),
                        'data' => config('notification-ar.meeting_invitation_shareholder.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_invitation_shareholder.line2') . ' '
                            . value_of($this->concatenation_ar, 1) . ' '
                            . config('notification-ar.meeting_invitation_shareholder.line3') . ' '
                            . value_of($this->concatenation_ar, 2) . ' '
                            . config('notification-ar.meeting_invitation_shareholder.line4')
                        ,
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_invitation_shareholder.subject'),
                        'data' => config('notification-en.meeting_invitation_shareholder.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_invitation_shareholder.line2') . ' '
                            . value_of($this->concatenation_en, 1) . ' '
                            . config('notification-en.meeting_invitation_shareholder.line3') . ' '
                            . value_of($this->concatenation_en, 2) . ' '
                            . config('notification-en.meeting_invitation_shareholder.line4'),
                    ]
                ],
                'new' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_invitation_new.subject'),
                        'data' => config('notification-ar.meeting_invitation_new.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_invitation_new.line2') . ' '
                            . value_of($this->concatenation_ar, 1),
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_invitation_new.subject'),
                        'data' => config('notification-en.meeting_invitation_new.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_invitation_new.line2') . ' '
                            . value_of($this->concatenation_en, 1),
                    ]
                ],
                'accepted' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_invitation_accepted.subject'),
                        'data' => config('notification-ar.meeting_invitation_accepted.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_invitation_accepted.line2') . ' '
                            . value_of($this->concatenation_ar, 1),
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_invitation_accepted.subject'),
                        'data' => config('notification-en.meeting_invitation_accepted.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_invitation_accepted.line2') . ' '
                            . value_of($this->concatenation_en, 1),
                    ]
                ],
                'rejected' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_invitation_rejected.subject'),
                        'data' => config('notification-ar.meeting_invitation_rejected.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_invitation_rejected.line2') . ' '
                            . value_of($this->concatenation_ar, 1),
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_invitation_rejected.subject'),
                        'data' => config('notification-en.meeting_invitation_rejected.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_invitation_rejected.line2') . ' '
                            . value_of($this->concatenation_en, 1),
                    ]
                ],
                'reached_elnesab' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_invitation_reached_minimum_acceptance.subject'),
                        'data' => config('notification-ar.meeting_invitation_reached_minimum_acceptance.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_invitation_reached_minimum_acceptance.line2'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_invitation_reached_minimum_acceptance.subject'),
                        'data' => config('notification-en.meeting_invitation_reached_minimum_acceptance.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_invitation_reached_minimum_acceptance.line2'),
                    ]
                ],
                'lose_elnesab' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_invitation_lose_minimum_acceptance.subject'),
                        'data' => config('notification-ar.meeting_invitation_lose_minimum_acceptance.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_invitation_lose_minimum_acceptance.line2'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_invitation_lose_minimum_acceptance.subject'),
                        'data' => config('notification-en.meeting_invitation_lose_minimum_acceptance.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_invitation_lose_minimum_acceptance.line2'),
                    ]
                ],
            ],
            'resolution' => [
                'meeting' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_resolution_create.subject'),
                        'data' => config('notification-ar.meeting_resolution_create.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_resolution_create.line2') . ' '
                            . value_of($this->concatenation_ar, 1) . ' '
                            . config('notification-ar.meeting_resolution_create.line3'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_resolution_create.subject'),
                        'data' => config('notification-en.meeting_resolution_create.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_resolution_create.line2') . ' '
                            . value_of($this->concatenation_en, 1) . ' '
                            . config('notification-en.meeting_resolution_create.line3'),
                    ]
                ],
                'committee' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_resolution_create.subject'),
                        'data' => config('notification-ar.meeting_resolution_create.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_resolution_create.line2') . ' '
                            . value_of($this->concatenation_ar, 1) . ' '
                            . config('notification-ar.meeting_resolution_create.line3'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_resolution_create.subject'),
                        'data' => config('notification-en.meeting_resolution_create.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_resolution_create.line2') . ' '
                            . value_of($this->concatenation_en, 1) . ' '
                            . config('notification-en.meeting_resolution_create.line3'),
                    ]
                ],
                'board' => [
                    'ar' => [
                        'subject' => config('notification-ar.board_resolution_create.subject'),
                        'data' => config('notification-ar.board_resolution_create.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.board_resolution_create.line2'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.board_resolution_create.subject'),
                        'data' => config('notification-en.board_resolution_create.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.board_resolution_create.line2'),
                    ]
                ],
                'accepted' => [
                    'ar' => [
                        'subject' => config('notification-ar.resolution_accepted.subject'),
                        'data' => config('notification-ar.resolution_accepted.line1') . ' '
                            . value_of($this->concatenation_ar, 0),
                    ],
                    'en' => [
                        'subject' => config('notification-en.resolution_accepted.subject'),
                        'data' => config('notification-en.resolution_accepted.line1') . ' '
                            . value_of($this->concatenation_en, 0),
                    ]
                ],
                'rejected' => [
                    'ar' => [
                        'subject' => config('notification-ar.resolution_rejected.subject'),
                        'data' => config('notification-ar.resolution_rejected.line1') . ' '
                            . value_of($this->concatenation_ar, 0),
                    ],
                    'en' => [
                        'subject' => config('notification-en.resolution_rejected.subject'),
                        'data' => config('notification-en.resolution_rejected.line1') . ' '
                            . value_of($this->concatenation_en, 0),
                    ]
                ],
            ],
            'announcement' => [
                'agenda' => [
                    'ar' => [
                        'subject' => config('notification-ar.agenda_announcement_create.subject'),
                        'data' => config('notification-ar.agenda_announcement_create.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.agenda_announcement_create.line2') . ' '
                            . value_of($this->concatenation_ar, 1) . ' '
                            . config('notification-ar.agenda_announcement_create.line3') . ' '
                            . value_of($this->concatenation_ar, 2),
                    ],
                    'en' => [
                        'subject' => config('notification-en.agenda_announcement_create.subject'),
                        'data' => config('notification-en.agenda_announcement_create.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.agenda_announcement_create.line2') . ' '
                            . value_of($this->concatenation_en, 1) . ' '
                            . config('notification-en.agenda_announcement_create.line3') . ' '
                            . value_of($this->concatenation_en, 2),
                    ]
                ],
                'agenda_third_party' => [
                    'ar' => [
                        'subject' => config('notification-ar.agenda_third_party_announcement_create.subject'),
                        'data' => config('notification-ar.agenda_third_party_announcement_create.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.agenda_third_party_announcement_create.line2') . ' '
                            . value_of($this->concatenation_ar, 1) . ' '
                            . config('notification-ar.agenda_third_party_announcement_create.line3') . ' '
                            . value_of($this->concatenation_ar, 2),
                    ],
                    'en' => [
                        'subject' => config('notification-en.agenda_third_party_announcement_create.subject'),
                        'data' => config('notification-en.agenda_third_party_announcement_create.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.agenda_third_party_announcement_create.line2') . ' '
                            . value_of($this->concatenation_en, 1) . ' '
                            . config('notification-en.agenda_third_party_announcement_create.line3') . ' '
                            . value_of($this->concatenation_en, 2),
                    ]
                ],
                'meeting' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_announcement_create.subject'),
                        'data' => config('notification-ar.meeting_announcement_create.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_announcement_create.line2') . ' '
                            . value_of($this->concatenation_ar, 1) . ' '
                            . config('notification-ar.meeting_announcement_create.line3'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_announcement_create.subject'),
                        'data' => config('notification-en.meeting_announcement_create.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_announcement_create.line2') . ' '
                            . value_of($this->concatenation_en, 1) . ' '
                            . config('notification-en.meeting_announcement_create.line3'),
                    ]
                ],
                'general' => [
                    'ar' => [
                        'subject' => config('notification-ar.general_announcement_create.subject'),
                        'data' => config('notification-ar.general_announcement_create.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.general_announcement_create.line2'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.general_announcement_create.subject'),
                        'data' => config('notification-en.general_announcement_create.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.general_announcement_create.line2'),
                    ]
                ],
                'update' => [
                    'ar' => [
                        'subject' => config('notification-ar.announcement_update.subject'),
                        'data' => config('notification-ar.announcement_update.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.announcement_update.line2'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.announcement_update.subject'),
                        'data' => config('notification-en.announcement_update.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.announcement_update.line2'),
                    ]
                ],
            ],
            'company_member' => [
                'assign' => [
                    'ar' => [
                        'subject' => config('notification-ar.assign_member_company.subject'),
                        'data' => config('notification-ar.assign_member_company.line1') . ' '
                            . value_of($this->concatenation_ar, 0),
                    ],
                    'en' => [
                        'subject' => config('notification-en.assign_member_company.subject'),
                        'data' => config('notification-en.assign_member_company.line1') . ' '
                            . value_of($this->concatenation_en, 0),
                    ]
                ],
            ],
            'training_plan' => [
                'certificate_upload' => [
                    'ar' => [
                        'subject' => config('notification-ar.training_plan_certificate_uploaded.subject'),
                        'data' => config('notification-ar.training_plan_certificate_uploaded.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.training_plan_certificate_uploaded.line2'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.training_plan_certificate_uploaded.subject'),
                        'data' => config('notification-en.training_plan_certificate_uploaded.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.training_plan_certificate_uploaded.line2'),
                    ]
                ],
                'certificate_update' => [
                    'ar' => [
                        'subject' => config('notification-ar.training_plan_certificate_updated.subject'),
                        'data' => config('notification-ar.training_plan_certificate_updated.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.training_plan_certificate_updated.line2'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.training_plan_certificate_updated.subject'),
                        'data' => config('notification-en.training_plan_certificate_updated.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.training_plan_certificate_updated.line2'),
                    ]
                ],
            ],
            'orientation_process' => [
                'create' => [
                    'ar' => [
                        'subject' => config('notification-ar.orientation_process_create.subject'),
                        'data' => config('notification-ar.orientation_process_create.line1'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.orientation_process_create.subject'),
                        'data' => config('notification-en.orientation_process_create.line1'),
                    ]
                ],
                'update' => [
                    'ar' => [
                        'subject' => config('notification-ar.orientation_process_update.subject'),
                        'data' => config('notification-ar.orientation_process_update.line1'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.orientation_process_update.subject'),
                        'data' => config('notification-en.orientation_process_update.line1'),
                    ]
                ],
            ],
            'orientation_item' => [
                'undone' => [
                    'ar' => [
                        'subject' => config('notification-ar.orientation_item_undone.subject'),
                        'data' => config('notification-ar.orientation_item_undone.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.orientation_item_undone.line2') . ' '
                            . value_of($this->concatenation_ar, 1) . ' '
                            . config('notification-ar.orientation_item_undone.line3'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.orientation_item_undone.subject'),
                        'data' => config('notification-en.orientation_item_undone.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.orientation_item_undone.line2') . ' '
                            . value_of($this->concatenation_en, 1) . ' '
                            . config('notification-en.orientation_item_undone.line3'),
                    ]
                ],
                'done' => [
                    'ar' => [
                        'subject' => config('notification-ar.orientation_item_done.subject'),
                        'data' => config('notification-ar.orientation_item_done.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.orientation_item_done.line2') . ' '
                            . value_of($this->concatenation_ar, 1) . ' '
                            . config('notification-ar.orientation_item_done.line3'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.orientation_item_done.subject'),
                        'data' => config('notification-en.orientation_item_done.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.orientation_item_done.line2') . ' '
                            . value_of($this->concatenation_en, 1) . ' '
                            . config('notification-en.orientation_item_done.line3'),
                    ]
                ],
            ],
            'meeting_type' => [
                'minimum_alert' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_type_minimum_alert.subject'),
                        'data' => config('notification-ar.meeting_type_minimum_alert.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_type_minimum_alert.' . value_of($this->concatenation_ar, 1)) . ' '
                            . config('notification-ar.meeting_type_minimum_alert.line4') . ' '
                            . value_of($this->concatenation_ar, 2) . ' '
                            . config('notification-ar.meeting_type_minimum_alert.line5') . ' '
                            . value_of($this->concatenation_ar, 3),
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_type_minimum_alert.subject'),
                        'data' => config('notification-en.meeting_type_minimum_alert.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_type_minimum_alert.' . value_of($this->concatenation_en, 1)) . ' '
                            . config('notification-en.meeting_type_minimum_alert.line4') . ' '
                            . value_of($this->concatenation_en, 2) . ' '
                            . config('notification-en.meeting_type_minimum_alert.line5') . ' '
                            . value_of($this->concatenation_en, 3),
                    ],
                ],
            ],
            'meeting' => [
                'accepted_members_alert' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_accepted_members_alert.subject'),
                        'data' => config('notification-ar.meeting_accepted_members_alert.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_accepted_members_alert.line2'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_accepted_members_alert.subject'),
                        'data' => config('notification-en.meeting_accepted_members_alert.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_accepted_members_alert.line2'),
                    ]
                ],
                'creator_alert' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_creator_alert.subject'),
                        'data' => config('notification-ar.meeting_creator_alert.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_creator_alert.line2'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_creator_alert.subject'),
                        'data' => config('notification-en.meeting_creator_alert.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_creator_alert.line2'),
                    ]
                ],
                'third_party_alert' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_third_party_alert.subject'),
                        'data' => config('notification-ar.meeting_third_party_alert.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_third_party_alert.line2') . ' '
                            . value_of($this->concatenation_ar, 1) . ' '
                            . config('notification-ar.meeting_third_party_alert.line3'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_third_party_alert.subject'),
                        'data' => config('notification-en.meeting_third_party_alert.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_third_party_alert.line2') . ' '
                            . value_of($this->concatenation_en, 1) . ' '
                            . config('notification-en.meeting_third_party_alert.line3'),
                    ]
                ],
                'accepted_members_before_alert' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_accepted_members_before_alert.subject'),
                        'data' => config('notification-ar.meeting_accepted_members_before_alert.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_accepted_members_before_alert.line2') . ' '
                            . value_of($this->concatenation_ar, 1),
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_accepted_members_before_alert.subject'),
                        'data' => config('notification-en.meeting_accepted_members_before_alert.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_accepted_members_before_alert.line2') . ' '
                            . value_of($this->concatenation_en, 1),
                    ]
                ],
                'creator_before_alert' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_creator_before_alert.subject'),
                        'data' => config('notification-ar.meeting_creator_before_alert.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_creator_before_alert.line2') . ' '
                            . value_of($this->concatenation_ar, 1),
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_creator_before_alert.subject'),
                        'data' => config('notification-en.meeting_creator_before_alert.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_creator_before_alert.line2') . ' '
                            . value_of($this->concatenation_en, 1),
                    ]
                ],
                'third_party_before_alert' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_third_party_before_alert.subject'),
                        'data' => config('notification-ar.meeting_third_party_before_alert.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_third_party_before_alert.line2') . ' '
                            . value_of($this->concatenation_ar, 1),
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_third_party_before_alert.subject'),
                        'data' => config('notification-en.meeting_third_party_before_alert.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_third_party_before_alert.line2') . ' '
                            . value_of($this->concatenation_en, 1),
                    ]
                ],
            ],
            'meeting_agenda' => [
                'create_alert' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_agenda_creation_alert.subject'),
                        'data' => config('notification-ar.meeting_agenda_creation_alert.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_agenda_creation_alert.line2') . ' '
                            . value_of($this->concatenation_ar, 1) . ' '
                            . config('notification-ar.meeting_agenda_creation_alert.' . value_of($this->concatenation_ar, 2)) . ' '
                            . config('notification-ar.meeting_agenda_creation_alert.line5'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_agenda_creation_alert.subject'),
                        'data' => config('notification-en.meeting_agenda_creation_alert.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_creator_alert.line2') . ' '
                            . value_of($this->concatenation_en, 1) . ' '
                            . config('notification-en.meeting_agenda_creation_alert.' . value_of($this->concatenation_en, 2)) . ' '
                            . config('notification-en.meeting_agenda_creation_alert.line5'),
                    ],
                ],
                'publish_alert' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_agenda_publishing_alert.subject'),
                        'data' => config('notification-ar.meeting_agenda_publishing_alert.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_agenda_publishing_alert.line2') . ' '
                            . value_of($this->concatenation_ar, 1) . ' '
                            . config('notification-ar.meeting_agenda_publishing_alert.' . value_of($this->concatenation_ar, 2)) . ' '
                            . config('notification-ar.meeting_agenda_publishing_alert.line5'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_agenda_publishing_alert.subject'),
                        'data' => config('notification-en.meeting_agenda_publishing_alert.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_creator_alert.line2') . ' '
                            . value_of($this->concatenation_en, 1) . ' '
                            . config('notification-en.meeting_agenda_publishing_alert.' . value_of($this->concatenation_en, 2)) . ' '
                            . config('notification-en.meeting_agenda_publishing_alert.line5'),
                    ],
                ],
                'first_publish' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_agenda_first_publish.subject'),
                        'data' => config('notification-ar.meeting_agenda_first_publish.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_agenda_first_publish.line2'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_agenda_first_publish.subject'),
                        'data' => config('notification-en.meeting_agenda_first_publish.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_agenda_first_publish.line2'),
                    ],
                ],
                'first_publish_with_invitation' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_agenda_first_publish_with_invitation.subject'),
                        'data' => config('notification-ar.meeting_agenda_first_publish_with_invitation.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_agenda_first_publish_with_invitation.line2'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_agenda_first_publish_with_invitation.subject'),
                        'data' => config('notification-en.meeting_agenda_first_publish_with_invitation.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_agenda_first_publish_with_invitation.line2'),
                    ],
                ],
                'member_first_publish' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_agenda_member_first_publish.subject'),
                        'data' => config('notification-ar.meeting_agenda_member_first_publish.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_agenda_member_first_publish.line2') . ' '
                            . value_of($this->concatenation_ar, 1),
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_agenda_member_first_publish.subject'),
                        'data' => config('notification-en.meeting_agenda_member_first_publish.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_agenda_member_first_publish.line2') . ' '
                            . value_of($this->concatenation_en, 1),
                    ],
                ],
                'edits_publish' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_agenda_edits_publish.subject'),
                        'data' => config('notification-ar.meeting_agenda_edits_publish.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_agenda_edits_publish.line2'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_agenda_edits_publish.subject'),
                        'data' => config('notification-en.meeting_agenda_edits_publish.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_agenda_edits_publish.line2'),
                    ],
                ],
                'member_edits_publish' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_agenda_member_edits_publish.subject'),
                        'data' => config('notification-ar.meeting_agenda_member_edits_publish.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_agenda_member_edits_publish.line2') . ' '
                            . value_of($this->concatenation_ar, 1),
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_agenda_member_edits_publish.subject'),
                        'data' => config('notification-en.meeting_agenda_member_edits_publish.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_agenda_member_edits_publish.line2') . ' '
                            . value_of($this->concatenation_en, 1),
                    ],
                ],
                'conflict' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_agenda_conflict.subject'),
                        'data' => config('notification-ar.meeting_agenda_conflict.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_agenda_conflict.line2') . ' '
                            . value_of($this->concatenation_ar, 1),
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_agenda_conflict.subject'),
                        'data' => config('notification-en.meeting_agenda_conflict.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_agenda_conflict.line2') . ' '
                            . value_of($this->concatenation_en, 1),
                    ],
                ],
                'third_party' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_agenda_invitation_third_party.subject'),
                        'data' => config('notification-ar.meeting_agenda_invitation_third_party.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_agenda_invitation_third_party.line2') . ' '
                            . value_of($this->concatenation_ar, 1) . ' '
                            . config('notification-ar.meeting_agenda_invitation_third_party.line3') . ' '
                            . value_of($this->concatenation_ar, 2) . ' '
                            . config('notification-ar.meeting_agenda_invitation_third_party.line4') . ' '
                            . value_of($this->concatenation_ar, 3) . ' '
                            . config('notification-ar.meeting_agenda_invitation_third_party.line5') . ' '
                            . value_of($this->concatenation_ar, 4)

                        ,
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_agenda_invitation_third_party.subject'),
                        'data' => config('notification-en.meeting_agenda_invitation_third_party.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_agenda_invitation_third_party.line2') . ' '
                            . value_of($this->concatenation_en, 1) . ' '
                            . config('notification-en.meeting_agenda_invitation_third_party.line3') . ' '
                            . value_of($this->concatenation_en, 2) . ' '
                            . config('notification-en.meeting_agenda_invitation_third_party.line4') . ' '
                            . value_of($this->concatenation_en, 3) . ' '
                            . config('notification-en.meeting_agenda_invitation_third_party.line5') . ' '
                            . value_of($this->concatenation_en, 4)
                        ,
                    ]
                ],
                'adding_attachments_alert' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_agenda_adding_attachments_alert.subject'),
                        'data' => config('notification-ar.meeting_agenda_adding_attachments_alert.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_agenda_adding_attachments_alert.line2'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_agenda_adding_attachments_alert.subject'),
                        'data' => config('notification-en.meeting_agenda_adding_attachments_alert.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_agenda_adding_attachments_alert.line2'),
                    ]
                ],
                'new_attachment' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_agenda_new_attachments.subject'),
                        'data' => config('notification-ar.meeting_agenda_new_attachments.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_agenda_new_attachments.line2') . ' '
                            . value_of($this->concatenation_ar, 1),
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_agenda_new_attachments.subject'),
                        'data' => config('notification-en.meeting_agenda_new_attachments.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_agenda_new_attachments.line2') . ' '
                            . value_of($this->concatenation_en, 1),
                    ]
                ],
                'new_link' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_agenda_new_links.subject'),
                        'data' => config('notification-ar.meeting_agenda_new_links.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_agenda_new_links.line2') . ' '
                            . value_of($this->concatenation_ar, 1),
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_agenda_new_links.subject'),
                        'data' => config('notification-en.meeting_agenda_new_links.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_agenda_new_links.line2') . ' '
                            . value_of($this->concatenation_en, 1),
                    ]
                ],
            ],
            'notification_center' => [
                'custom' => [
                    'ar' => [
                        'subject' => value_of($this->concatenation_ar, 0),
                        'data' => value_of($this->concatenation_ar, 1),
                    ],
                    'en' => [
                        'subject' => value_of($this->concatenation_en, 0),
                        'data' => value_of($this->concatenation_en, 1),
                    ],
                ],
            ],
            'meeting_output' => [
                'request_member_signature' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_output_request_member_signature.subject'),
                        'data' => config('notification-ar.meeting_output_request_member_signature.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_output_request_member_signature.line2'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_output_request_member_signature.subject'),
                        'data' => config('notification-en.meeting_output_request_member_signature.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_output_request_member_signature.line2'),
                    ]
                ],
                'member_signed' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_output_member_signed.subject'),
                        'data' => config('notification-ar.meeting_output_member_signed.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_output_member_signed.line2') . ' '
                            . value_of($this->concatenation_ar, 1),
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_output_member_signed.subject'),
                        'data' => config('notification-en.meeting_output_member_signed.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_output_member_signed.line2') . ' '
                            . value_of($this->concatenation_en, 1),
                    ]
                ],
                'mozkra' => [
                    'ar' => [
                        'subject' => config('notification-ar.meeting_output_mozkra.subject'),
                        'data' => config('notification-ar.meeting_output_mozkra.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.meeting_output_mozkra.line2') . ' '
                            . value_of($this->concatenation_ar, 1)/*.' '
                            . config('notification-ar.meeting_output_mozkra.line3')*/,
                    ],
                    'en' => [
                        'subject' => config('notification-en.meeting_output_mozkra.subject'),
                        'data' => config('notification-en.meeting_output_mozkra.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.meeting_output_mozkra.line2') . ' '
                            . value_of($this->concatenation_en, 1)/*.' '
                            . config('notification-en.meeting_output_mozkra.line3')*/,
                    ]
                ],
            ],
            'account' => [
                'new' => [
                    'ar' => [
                        'subject' => config('notification-ar.account_new_registered_user.subject'),
                        'data' => config('notification-ar.account_new_registered_user.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.account_new_registered_user.line2') . ' '
                            . value_of($this->concatenation_ar, 1) . ' '
                            . config('notification-ar.account_new_registered_user.line3'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.account_new_registered_user.subject'),
                        'data' => config('notification-en.account_new_registered_user.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.account_new_registered_user.line2') . ' '
                            . value_of($this->concatenation_en, 1) . ' '
                            . config('notification-en.account_new_registered_user.line3'),
                    ],
                ],
            ],
            'training_kpi' => [
                'alert_start_date' => [
                    'ar' => [
                        'subject' => config('notification-ar.training_kpi_start_date_alert.subject'),
                        'data' => config('notification-ar.training_kpi_start_date_alert.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.training_kpi_start_date_alert.line2'),
                    ],
                    'en' => [
                        'subject' => config('notification-en.training_kpi_start_date_alert.subject'),
                        'data' => config('notification-en.training_kpi_start_date_alert.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.training_kpi_start_date_alert.line2'),
                    ],
                ],
                'member_final_send_kpi' => [
                    'ar' => [
                        'subject' => config('notification-ar.training_kpi_member_final_send.subject'),
                        'data' => config('notification-ar.training_kpi_member_final_send.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.training_kpi_member_final_send.line2') . ' '
                            . value_of($this->concatenation_ar, 1) . ' '
                            . config('notification-ar.training_kpi_member_final_send.line3') . ' '
                            . value_of($this->concatenation_ar, 2),
                    ],
                    'en' => [
                        'subject' => config('notification-en.training_kpi_member_final_send.subject'),
                        'data' => config('notification-en.training_kpi_member_final_send.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.training_kpi_member_final_send.line2') . ' '
                            . value_of($this->concatenation_en, 1) . ' '
                            . config('notification-en.training_kpi_member_final_send.line3') . ' '
                            . value_of($this->concatenation_en, 2),
                    ],
                ],
            ],
            'ceo_kpi' => [
                'member_alert_start_date' => [
                    'ar' => [
                        'subject' => config('notification-ar.ceo_kpi_start_date_alert_to_member.subject'),
                        'data' => config('notification-ar.ceo_kpi_start_date_alert_to_member.line1') . ' '
                            . value_of($this->concatenation_ar, 0),
                    ],
                    'en' => [
                        'subject' => config('notification-en.ceo_kpi_start_date_alert_to_member.subject'),
                        'data' => config('notification-en.ceo_kpi_start_date_alert_to_member.line1') . ' '
                            . value_of($this->concatenation_en, 0),
                    ],
                ],
                'secretary_alert_start_date' => [
                    'ar' => [
                        'subject' => config('notification-ar.ceo_kpi_start_date_alert_to_secretary.subject'),
                        'data' => config('notification-ar.ceo_kpi_start_date_alert_to_secretary.line1') . ' '
                            . value_of($this->concatenation_ar, 0),
                    ],
                    'en' => [
                        'subject' => config('notification-en.ceo_kpi_start_date_alert_to_secretary.subject'),
                        'data' => config('notification-en.ceo_kpi_start_date_alert_to_secretary.line1') . ' '
                            . value_of($this->concatenation_en, 0),
                    ],
                ],
                'member_final_send_kpi' => [
                    'ar' => [
                        'subject' => config('notification-ar.ceo_kpi_member_final_send.subject'),
                        'data' => config('notification-ar.ceo_kpi_member_final_send.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.ceo_kpi_member_final_send.line2') . ' '
                            . value_of($this->concatenation_ar, 1),
                    ],
                    'en' => [
                        'subject' => config('notification-en.ceo_kpi_member_final_send.subject'),
                        'data' => config('notification-en.ceo_kpi_member_final_send.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.ceo_kpi_member_final_send.line2') . ' '
                            . value_of($this->concatenation_en, 1),
                    ],
                ],
                'secretary_final_send_kpi' => [
                    'ar' => [
                        'subject' => config('notification-ar.ceo_kpi_secretary_final_send.subject'),
                        'data' => config('notification-ar.ceo_kpi_secretary_final_send.line1') . ' '
                            //. value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.ceo_kpi_secretary_final_send.line2') . ' '
                            . value_of($this->concatenation_ar, 1),
                    ],
                    'en' => [
                        'subject' => config('notification-en.ceo_kpi_secretary_final_send.subject'),
                        'data' => config('notification-en.ceo_kpi_secretary_final_send.line1') . ' '
                            //. value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.ceo_kpi_secretary_final_send.line2') . ' '
                            . value_of($this->concatenation_en, 1),
                    ],
                ],
                'send_to_chairman' => [
                    'ar' => [
                        'subject' => config('notification-ar.ceo_kpi_send_to_chairman.subject'),
                        'data' => config('notification-ar.ceo_kpi_send_to_chairman.line1') . ' '
                            . value_of($this->concatenation_ar, 0),
                    ],
                    'en' => [
                        'subject' => config('notification-en.ceo_kpi_send_to_chairman.subject'),
                        'data' => config('notification-en.ceo_kpi_send_to_chairman.line1') . ' '
                            . value_of($this->concatenation_en, 0),
                    ],
                ],
                'chairman_signature_to_member' => [
                    'ar' => [
                        'subject' => config('notification-ar.ceo_kpi_chairman_signature_to_member.subject'),
                        'data' => config('notification-ar.ceo_kpi_chairman_signature_to_member.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.ceo_kpi_chairman_signature_to_member.line2') . ' '
                            . value_of($this->concatenation_ar, 1),
                    ],
                    'en' => [
                        'subject' => config('notification-en.ceo_kpi_chairman_signature_to_member.subject'),
                        'data' => config('notification-en.ceo_kpi_chairman_signature_to_member.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.ceo_kpi_chairman_signature_to_member.line2') . ' '
                            . value_of($this->concatenation_en, 1),
                    ],
                ],
                'chairman_signature_to_secretary' => [
                    'ar' => [
                        'subject' => config('notification-ar.ceo_kpi_chairman_signature_to_secretary.subject'),
                        'data' => config('notification-ar.ceo_kpi_chairman_signature_to_secretary.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.ceo_kpi_chairman_signature_to_secretary.line2') . ' '
                            . value_of($this->concatenation_ar, 1) . ' '
                            . config('notification-ar.ceo_kpi_chairman_signature_to_secretary.line3') . ' '
                            . value_of($this->concatenation_ar, 2),
                    ],
                    'en' => [
                        'subject' => config('notification-en.ceo_kpi_chairman_signature_to_secretary.subject'),
                        'data' => config('notification-en.ceo_kpi_chairman_signature_to_secretary.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.ceo_kpi_chairman_signature_to_secretary.line2') . ' '
                            . value_of($this->concatenation_en, 1) . ' '
                            . config('notification-en.ceo_kpi_chairman_signature_to_secretary.line3'),
                    ],
                ],
            ],
            'board_member_kpi' => [
                'member_alert_start_date' => [
                    'ar' => [
                        'subject' => config('notification-ar.board_member_kpi_start_date_alert_to_member.subject'),
                        'data' => config('notification-ar.board_member_kpi_start_date_alert_to_member.line1') . ' '
                            . value_of($this->concatenation_ar, 0),
                    ],
                    'en' => [
                        'subject' => config('notification-en.board_member_kpi_start_date_alert_to_member.subject'),
                        'data' => config('notification-en.board_member_kpi_start_date_alert_to_member.line1') . ' '
                            . value_of($this->concatenation_en, 0),
                    ],
                ],
                'secretary_alert_start_date' => [
                    'ar' => [
                        'subject' => config('notification-ar.board_member_kpi_start_date_alert_to_secretary.subject'),
                        'data' => config('notification-ar.board_member_kpi_start_date_alert_to_secretary.line1') . ' '
                            . value_of($this->concatenation_ar, 0),
                    ],
                    'en' => [
                        'subject' => config('notification-en.board_member_kpi_start_date_alert_to_secretary.subject'),
                        'data' => config('notification-en.board_member_kpi_start_date_alert_to_secretary.line1') . ' '
                            . value_of($this->concatenation_en, 0),
                    ],
                ],
                'member_final_send_kpi' => [
                    'ar' => [
                        'subject' => config('notification-ar.board_member_kpi_member_final_send.subject'),
                        'data' => config('notification-ar.board_member_kpi_member_final_send.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.board_member_kpi_member_final_send.line2') . ' '
                            . value_of($this->concatenation_ar, 1),
                    ],
                    'en' => [
                        'subject' => config('notification-en.board_member_kpi_member_final_send.subject'),
                        'data' => config('notification-en.board_member_kpi_member_final_send.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.board_member_kpi_member_final_send.line2') . ' '
                            . value_of($this->concatenation_en, 1),
                    ],
                ],
                'secretary_final_send_kpi' => [
                    'ar' => [
                        'subject' => config('notification-ar.board_member_kpi_secretary_final_send.subject'),
                        'data' => config('notification-ar.board_member_kpi_secretary_final_send.line1') . ' '
                            // . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.board_member_kpi_secretary_final_send.line2') . ' '
                            . value_of($this->concatenation_ar, 1),
                    ],
                    'en' => [
                        'subject' => config('notification-en.board_member_kpi_secretary_final_send.subject'),
                        'data' => config('notification-en.board_member_kpi_secretary_final_send.line1') . ' '
                            // . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.board_member_kpi_secretary_final_send.line2') . ' '
                            . value_of($this->concatenation_en, 1),
                    ],
                ],
                'send_to_chairman' => [
                    'ar' => [
                        'subject' => config('notification-ar.board_member_kpi_send_to_chairman.subject'),
                        'data' => config('notification-ar.board_member_kpi_send_to_chairman.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' ' .
                            config('notification-ar.board_member_kpi_send_to_chairman.line2') . ' '
                            . value_of($this->concatenation_ar, 1),
                    ],
                    'en' => [
                        'subject' => config('notification-en.board_member_kpi_send_to_chairman.subject'),
                        'data' => config('notification-en.board_member_kpi_send_to_chairman.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' ' .
                            config('notification-en.board_member_kpi_send_to_chairman.line2') . ' '
                            . value_of($this->concatenation_en, 1),
                    ],
                ],
                'chairman_signature_to_member' => [
                    'ar' => [
                        'subject' => config('notification-ar.board_member_kpi_chairman_signature_to_member.subject'),
                        'data' => config('notification-ar.board_member_kpi_chairman_signature_to_member.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.board_member_kpi_chairman_signature_to_member.line2') . ' '
                            . value_of($this->concatenation_ar, 1),
                    ],
                    'en' => [
                        'subject' => config('notification-en.board_member_kpi_chairman_signature_to_member.subject'),
                        'data' => config('notification-en.board_member_kpi_chairman_signature_to_member.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.board_member_kpi_chairman_signature_to_member.line2') . ' '
                            . value_of($this->concatenation_en, 1),
                    ],
                ],
                'chairman_signature_to_secretary' => [
                    'ar' => [
                        'subject' => config('notification-ar.board_member_kpi_chairman_signature_to_secretary.subject'),
                        'data' => config('notification-ar.board_member_kpi_chairman_signature_to_secretary.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.board_member_kpi_chairman_signature_to_secretary.line2') . ' '
                            . value_of($this->concatenation_ar, 1) . ' '
                            . config('notification-ar.board_member_kpi_chairman_signature_to_secretary.line3') . ' '
                            . value_of($this->concatenation_ar, 2),
                    ],
                    'en' => [
                        'subject' => config('notification-en.board_member_kpi_chairman_signature_to_secretary.subject'),
                        'data' => config('notification-en.board_member_kpi_chairman_signature_to_secretary.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.board_member_kpi_chairman_signature_to_secretary.line2') . ' '
                            . value_of($this->concatenation_en, 1) . ' '
                            . config('notification-en.board_member_kpi_chairman_signature_to_secretary.line3'),
                    ],
                ],
            ],
            'committee_member_kpi' => [
                'member_alert_start_date' => [
                    'ar' => [
                        'subject' => config('notification-ar.committee_member_kpi_start_date_alert_to_member.subject'),
                        'data' => config('notification-ar.committee_member_kpi_start_date_alert_to_member.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.committee_member_kpi_start_date_alert_to_member.line2') . ' '
                            . value_of($this->concatenation_ar, 1),
                    ],
                    'en' => [
                        'subject' => config('notification-en.committee_member_kpi_start_date_alert_to_member.subject'),
                        'data' => config('notification-en.committee_member_kpi_start_date_alert_to_member.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.committee_member_kpi_start_date_alert_to_member.line2') . ' '
                            . value_of($this->concatenation_en, 1),
                    ],
                ],
                'secretary_alert_start_date' => [
                    'ar' => [
                        'subject' => config('notification-ar.committee_member_kpi_start_date_alert_to_secretary.subject'),
                        'data' => config('notification-ar.committee_member_kpi_start_date_alert_to_secretary.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.committee_member_kpi_start_date_alert_to_secretary.line2') . ' '
                            . value_of($this->concatenation_ar, 1),
                    ],
                    'en' => [
                        'subject' => config('notification-en.committee_member_kpi_start_date_alert_to_secretary.subject'),
                        'data' => config('notification-en.committee_member_kpi_start_date_alert_to_secretary.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.committee_member_kpi_start_date_alert_to_secretary.line2') . ' '
                            . value_of($this->concatenation_en, 1),
                    ],
                ],
                'member_final_send_kpi' => [
                    'ar' => [
                        'subject' => config('notification-ar.committee_member_kpi_member_final_send.subject'),
                        'data' => config('notification-ar.committee_member_kpi_member_final_send.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.committee_member_kpi_member_final_send.line2') . ' '
                            . value_of($this->concatenation_ar, 1) . ' '
                            . config('notification-ar.committee_member_kpi_member_final_send.line3') . ' '
                            . value_of($this->concatenation_ar, 2),
                    ],
                    'en' => [
                        'subject' => config('notification-en.committee_member_kpi_member_final_send.subject'),
                        'data' => config('notification-en.committee_member_kpi_member_final_send.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.committee_member_kpi_member_final_send.line2') . ' '
                            . value_of($this->concatenation_en, 1) . ' '
                            . config('notification-en.committee_member_kpi_member_final_send.line3') . ' '
                            . value_of($this->concatenation_en, 2),
                    ],
                ],
                'secretary_final_send_kpi' => [
                    'ar' => [
                        'subject' => config('notification-ar.committee_member_kpi_secretary_final_send.subject'),
                        'data' => config('notification-ar.committee_member_kpi_secretary_final_send.line1') . ' '
                            // . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.committee_member_kpi_secretary_final_send.line2') . ' '
                            . value_of($this->concatenation_ar, 1) . ' '
                            . config('notification-ar.committee_member_kpi_secretary_final_send.line3') . ' '
                            . value_of($this->concatenation_ar, 2),
                    ],
                    'en' => [
                        'subject' => config('notification-en.committee_member_kpi_secretary_final_send.subject'),
                        'data' => config('notification-en.committee_member_kpi_secretary_final_send.line1') . ' '
                            // . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.committee_member_kpi_secretary_final_send.line2') . ' '
                            . value_of($this->concatenation_en, 1) . ' '
                            . config('notification-en.committee_member_kpi_secretary_final_send.line3') . ' '
                            . value_of($this->concatenation_en, 2),
                    ],
                ],
                'send_to_committee_responsible' => [
                    'ar' => [
                        'subject' => config('notification-ar.committee_member_kpi_send_to_responsible.subject'),
                        'data' => config('notification-ar.committee_member_kpi_send_to_responsible.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' ' .
                            config('notification-ar.committee_member_kpi_send_to_responsible.line2') . ' '
                            . value_of($this->concatenation_ar, 1) . ' ' .
                            config('notification-ar.committee_member_kpi_send_to_responsible.line3') . ' '
                            . value_of($this->concatenation_ar, 2),
                    ],
                    'en' => [
                        'subject' => config('notification-en.committee_member_kpi_send_to_responsible.subject'),
                        'data' => config('notification-en.committee_member_kpi_send_to_responsible.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' ' .
                            config('notification-en.committee_member_kpi_send_to_responsible.line2') . ' '
                            . value_of($this->concatenation_en, 1) . ' ' .
                            config('notification-ar.committee_member_kpi_send_to_responsible.line3') . ' '
                            . value_of($this->concatenation_ar, 2),
                    ],
                ],
                'responsible_signature_to_member' => [
                    'ar' => [
                        'subject' => config('notification-ar.committee_member_kpi_responsible_signature_to_member.subject'),
                        'data' => config('notification-ar.committee_member_kpi_responsible_signature_to_member.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.committee_member_kpi_responsible_signature_to_member.line2') . ' '
                            . value_of($this->concatenation_ar, 1) . ' '
                            . config('notification-ar.committee_member_kpi_responsible_signature_to_member.line3') . ' '
                            . value_of($this->concatenation_ar, 2),
                    ],
                    'en' => [
                        'subject' => config('notification-en.committee_member_kpi_responsible_signature_to_member.subject'),
                        'data' => config('notification-en.committee_member_kpi_responsible_signature_to_member.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.committee_member_kpi_responsible_signature_to_member.line2') . ' '
                            . value_of($this->concatenation_en, 1) . ' '
                            . config('notification-en.committee_member_kpi_responsible_signature_to_member.line3') . ' '
                            . value_of($this->concatenation_en, 2),
                    ],
                ],
                'responsible_signature_to_secretary' => [
                    'ar' => [
                        'subject' => config('notification-ar.committee_member_kpi_responsible_signature_to_secretary.subject'),
                        'data' => config('notification-ar.committee_member_kpi_responsible_signature_to_secretary.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.committee_member_kpi_responsible_signature_to_secretary.line2') . ' '
                            . value_of($this->concatenation_ar, 1) . ' '
                            . config('notification-ar.committee_member_kpi_responsible_signature_to_secretary.line3') . ' '
                            . value_of($this->concatenation_ar, 2) . ' '
                            . config('notification-ar.committee_member_kpi_responsible_signature_to_secretary.line4') . ' '
                            . value_of($this->concatenation_ar, 3),
                    ],
                    'en' => [
                        'subject' => config('notification-en.committee_member_kpi_responsible_signature_to_secretary.subject'),
                        'data' => config('notification-en.committee_member_kpi_responsible_signature_to_secretary.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.committee_member_kpi_responsible_signature_to_secretary.line2') . ' '
                            . value_of($this->concatenation_en, 1) . ' '
                            . config('notification-en.committee_member_kpi_responsible_signature_to_secretary.line3') . ' '
                            . value_of($this->concatenation_en, 2) . ' '
                            . config('notification-en.committee_member_kpi_responsible_signature_to_secretary.line4'),
                    ],
                ],
            ],
            'board_kpi' => [
                'secretary_alert_start_date' => [
                    'ar' => [
                        'subject' => config('notification-ar.board_kpi_start_date_alert_to_secretary.subject'),
                        'data' => config('notification-ar.board_kpi_start_date_alert_to_secretary.line1') . ' '
                            . value_of($this->concatenation_ar, 0),
                    ],
                    'en' => [
                        'subject' => config('notification-en.board_kpi_start_date_alert_to_secretary.subject'),
                        'data' => config('notification-en.board_kpi_start_date_alert_to_secretary.line1') . ' '
                            . value_of($this->concatenation_en, 0),
                    ],
                ],
                'send_to_chairman' => [
                    'ar' => [
                        'subject' => config('notification-ar.board_kpi_send_to_chairman.subject'),
                        'data' => config('notification-ar.board_kpi_send_to_chairman.line1') . ' '
                            . value_of($this->concatenation_ar, 0),
                    ],
                    'en' => [
                        'subject' => config('notification-en.board_kpi_send_to_chairman.subject'),
                        'data' => config('notification-en.board_kpi_send_to_chairman.line1') . ' '
                            . value_of($this->concatenation_en, 0),
                    ],
                ],
                'chairman_signature_to_member' => [
                    'ar' => [
                        'subject' => config('notification-ar.board_kpi_chairman_signature_to_member.subject'),
                        'data' => config('notification-ar.board_kpi_chairman_signature_to_member.line1') . ' '
                            . value_of($this->concatenation_ar, 0),
                    ],
                    'en' => [
                        'subject' => config('notification-en.board_kpi_chairman_signature_to_member.subject'),
                        'data' => config('notification-en.board_kpi_chairman_signature_to_member.line1') . ' '
                            . value_of($this->concatenation_en, 0),
                    ],
                ],
                'chairman_signature_to_secretary' => [
                    'ar' => [
                        'subject' => config('notification-ar.board_kpi_chairman_signature_to_secretary.subject'),
                        'data' => config('notification-ar.board_kpi_chairman_signature_to_secretary.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.board_kpi_chairman_signature_to_secretary.line2') . ' '
                            . value_of($this->concatenation_ar, 1),
                    ],
                    'en' => [
                        'subject' => config('notification-en.board_kpi_chairman_signature_to_secretary.subject'),
                        'data' => config('notification-en.board_kpi_chairman_signature_to_secretary.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.board_kpi_chairman_signature_to_secretary.line2') . ' '
                            . value_of($this->concatenation_en, 1),
                    ],
                ],
                'member_signature_to_secretary' => [
                    'ar' => [
                        'subject' => config('notification-ar.board_kpi_member_signature_to_secretary.subject'),
                        'data' => config('notification-ar.board_kpi_member_signature_to_secretary.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.board_kpi_member_signature_to_secretary.line2') . ' '
                            . value_of($this->concatenation_ar, 1),
                    ],
                    'en' => [
                        'subject' => config('notification-en.board_kpi_member_signature_to_secretary.subject'),
                        'data' => config('notification-en.board_kpi_member_signature_to_secretary.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.board_kpi_member_signature_to_secretary.line2') . ' '
                            . value_of($this->concatenation_en, 1),
                    ],
                ],
            ],
            'committee_kpi' => [
                'secretary_alert_start_date' => [
                    'ar' => [
                        'subject' => config('notification-ar.committee_kpi_start_date_alert_to_secretary.subject'),
                        'data' => config('notification-ar.committee_kpi_start_date_alert_to_secretary.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.committee_kpi_start_date_alert_to_secretary.line2') . ' '
                            . value_of($this->concatenation_ar, 1),
                    ],
                    'en' => [
                        'subject' => config('notification-en.committee_kpi_start_date_alert_to_secretary.subject'),
                        'data' => config('notification-en.committee_kpi_start_date_alert_to_secretary.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.committee_kpi_start_date_alert_to_secretary.line2') . ' '
                            . value_of($this->concatenation_en, 1),
                    ],
                ],
                'send_to_member' => [
                    'ar' => [
                        'subject' => config('notification-ar.committee_kpi_send_to_member.subject'),
                        'data' => config('notification-ar.committee_kpi_send_to_member.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.committee_kpi_send_to_member.line2') . ' '
                            . value_of($this->concatenation_ar, 1),
                    ],
                    'en' => [
                        'subject' => config('notification-en.committee_kpi_send_to_member.subject'),
                        'data' => config('notification-en.committee_kpi_send_to_member.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.committee_kpi_send_to_member.line2') . ' '
                            . value_of($this->concatenation_en, 1),
                    ],
                ],
                'member_signature_to_secretary' => [
                    'ar' => [
                        'subject' => config('notification-ar.committee_kpi_member_signature_to_secretary.subject'),
                        'data' => config('notification-ar.committee_kpi_member_signature_to_secretary.line1') . ' '
                            . value_of($this->concatenation_ar, 0) . ' '
                            . config('notification-ar.committee_kpi_member_signature_to_secretary.line2') . ' '
                            . value_of($this->concatenation_ar, 1) . ' '
                            . config('notification-ar.committee_kpi_member_signature_to_secretary.line3') . ' '
                            . value_of($this->concatenation_ar, 2),
                    ],
                    'en' => [
                        'subject' => config('notification-en.committee_kpi_member_signature_to_secretary.subject'),
                        'data' => config('notification-en.committee_kpi_member_signature_to_secretary.line1') . ' '
                            . value_of($this->concatenation_en, 0) . ' '
                            . config('notification-en.committee_kpi_member_signature_to_secretary.line2') . ' '
                            . value_of($this->concatenation_en, 1) . ' '
                            . config('notification-en.committee_kpi_member_signature_to_secretary.line3') . ' '
                            . value_of($this->concatenation_en, 2),
                    ],
                ],
            ],
        ];
    }

    public function notification(): array
    {
        $messages = $this->messageKeys();
        $notification = $messages[$this->key][$this->case][app()->getLocale()];
        $notification['key'] = $this->key;
        $notification['case'] = $this->case;
        $notification['concatenation_ar'] = $this->handleConcatenationAr();
        $notification['concatenation_en'] = $this->handleConcatenationEn();
        $notification['redirect_route'] = $this->redirectRoute ?? route('dashboard.v1.home');
        return $notification;
    }


    // en values by default it may be null , it will check if en value null replace it with ar value
    private function handleConcatenationEn()
    {
        $concatenationAr = $this->concatenation_ar;
        $concatenationEn = $this->concatenation_en;
        if ($concatenationAr != []) {
            foreach ($concatenationAr as $key => $arValue) {
                if (array_key_exists($key, $concatenationEn) && ($concatenationEn[$key] == null)) {
                    $concatenationEn[$key] = $arValue;
                }
            }
        }
        return $concatenationEn;
    }

    // en values by default it may be null , it will check if en value null replace it with ar value
    private function handleConcatenationAr()
    {
        $concatenationAr = $this->concatenation_ar;
        $concatenationEn = $this->concatenation_en;
        if ($concatenationEn != []) {
            foreach ($concatenationEn as $key => $enValue) {
                if (array_key_exists($key, $concatenationAr) && ($concatenationAr[$key] == null)) {
                    $concatenationAr[$key] = $enValue;
                }
            }
        }
        return $concatenationAr;
    }
}
