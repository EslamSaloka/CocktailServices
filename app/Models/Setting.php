<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = "settings";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'value',
        'group_by',
    ];

    public function getModePermissions() {
        return [
            "settings" => [
                "settings.index",
                "settings.edit",
            ]
        ];
    }

    const FORM_INPUTS = [
        'application' => [
            'title' => 'الإعددات الأساسية',
            'short_desc' => 'الإعددات الأساسية',
            'icon' => 'edit-2',
            'form' => [
                'inputs' => [
                    [
                        'label'         => 'رقم السجل التجاري',
                        'name'          => 'commercial_registration',
                        'type'          => 'text',
                        'placeholder'   => 'رقم السجل التجاري',
                    ],
                    [
                        'label'         => 'عنوان المؤسسة',
                        'name'          => 'address_name',
                        'type'          => 'text',
                        'placeholder'   => 'عنوان المؤسسة',
                    ],
                    [
                        'label'         => 'البريد الإلكتروني',
                        'name'          => 'email',
                        'type'          => 'email',
                        'placeholder'   => 'البريد الإلكتروني',
                    ],
                    [
                        'label'         => 'رقم الجوال',
                        'name'          => 'phone',
                        'type'          => 'number',
                        'placeholder'   => 'رقم الجوال',
                    ],
                    [
                        'label'         => 'رقم الواتساب',
                        'name'          => 'whatsapp',
                        'type'          => 'number',
                        'placeholder'   => 'رقم الواتساب',
                    ],
                    [
                        'label'         => 'صوره شعار المنصة',
                        'name'          => 'logo',
                        'type'          => 'image',
                        'placeholder'   => 'صوره شعار المنصة',
                    ],
                ],
            ],
        ],
        'social' => [
            'title' => 'السوشيال ميديا',
            'short_desc' => 'السوشيال ميديا',
            'icon' => 'twitter',
            'form' => [
                'inputs' => [
                    [
                        'label'         => 'سناب شات',
                        'name'          => 'snapchat',
                        'type'          => 'url',
                        'placeholder'   => 'رابط حسابك في سناب شات',
                    ],
                    [
                        'label'         => 'يوتيوب',
                        'name'          => 'youtube',
                        'type'          => 'url',
                        'placeholder'   => 'رابط حسابك في يوتيوب',
                    ],
                    [
                        'label'         => 'تويتر',
                        'name'          => 'twitter',
                        'type'          => 'url',
                        'placeholder'   => 'رابط حسابك في تويتر',
                    ],
                    [
                        'label'         => 'إنستقرام',
                        'name'          => 'instagram',
                        'type'          => 'url',
                        'placeholder'   => 'رابط حسابك في إنستقرام',
                    ]
                ]
            ]
        ],
        'footer' => [
            'title' => 'نبدة تعريفية',
            'short_desc' => 'نبذة تعريفية عن الموقع',
            'icon' => 'info',
            'form' => [
                'inputs' => [
                    [
                        'label'         => 'نبذة تعريفية مختصرة',
                        'name'          => 'footer',
                        'type'          => 'text',
                        'placeholder'   => 'اكتب نبذة تعريفية مختصرة عن الموقع',
                    ],
                ]
            ]
        ],
        'pages' => [
            'title' => 'صور الصفحات',
            'short_desc' => 'إعدادات صور الصفحات',
            'icon' => 'maximize',
            'form' => [
                'inputs' => [
                    [
                        'label'         => 'صوره صفحة من نحن',
                        'name'          => 'about_page_image',
                        'type'          => 'image',
                        'placeholder'   => 'صوره صفحة من نحن',
                    ],
                    [
                        'label'         => 'صوره صفحة الأسئلة الشائعه',
                        'name'          => 'faq_page_image',
                        'type'          => 'image',
                        'placeholder'   => 'صوره صفحة الأسئلة الشائعه',
                    ],
                    [
                        'label'         => 'صوره صفحة تواصل معنا',
                        'name'          => 'contact_page_image',
                        'type'          => 'image',
                        'placeholder'   => 'صوره صفحة تواصل معنا',
                    ],
                    [
                        'label'         => 'صوره صفحة الخدمات',
                        'name'          => 'services_page_image',
                        'type'          => 'image',
                        'placeholder'   => 'صوره صفحة الخدمات',
                    ],
                    [
                        'label'         => 'صوره صفحة الشروط والأحكام',
                        'name'          => 'terms_page_image',
                        'type'          => 'image',
                        'placeholder'   => 'صوره صفحة الشروط والأحكام',
                    ],
                    [
                        'label'         => 'صوره صفحة الحساب الشخصي',
                        'name'          => 'profile_page_image',
                        'type'          => 'image',
                        'placeholder'   => 'صوره صفحة الحساب الشخصي',
                    ],
                    [
                        'label'         => 'صوره صفحة الإشعارات',
                        'name'          => 'profile_notifications_page_image',
                        'type'          => 'image',
                        'placeholder'   => 'صوره صفحة الإشعارات',
                    ],
                    [
                        'label'         => 'صوره صفحة الطلبات',
                        'name'          => 'profile_orders_page_image',
                        'type'          => 'image',
                        'placeholder'   => 'صوره صفحة الطلبات',
                    ],
                ]
            ]
        ],
    ];
}
