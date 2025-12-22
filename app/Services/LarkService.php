<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class LarkService
{
    private $client;
    private $appId;
    private $appSecret;
    private $baseUrl;

    public function __construct()
    {
        $this->client = new Client([
            'timeout' => 10,
            'verify' => false // Tắt SSL verify nếu gặp lỗi
        ]);
        
        $this->appId = env('LARK_APP_ID');
        $this->appSecret = env('LARK_APP_SECRET');
        $this->baseUrl = env('LARK_API_BASE_URL', 'https://open.larksuite.com/open-apis');
    }

    /**
     * Get tenant access token with caching
     */
    private function getAccessToken()
    {
        // Cache token for 1 hour (token expires in ~2 hours)
        return Cache::remember('lark_access_token', 3600, function () {
            try {
                $response = $this->client->post($this->baseUrl . '/auth/v3/tenant_access_token/internal', [
                    'json' => [
                        'app_id' => $this->appId,
                        'app_secret' => $this->appSecret,
                    ],
                    'headers' => [
                        'Content-Type' => 'application/json',
                    ]
                ]);

                $data = json_decode($response->getBody(), true);
                
                if (isset($data['code']) && $data['code'] === 0) {
                    Log::info('✅ Lark access token obtained successfully');
                    return $data['tenant_access_token'];
                }

                Log::error('❌ Lark get access token failed', $data);
                return null;

            } catch (\Exception $e) {
                Log::error('❌ Lark get access token exception: ' . $e->getMessage());
                return null;
            }
        });
    }

    /**
     * Send text message to group chat
     */
    public function sendMessageToGroup($chatId, $message)
    {
        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            Log::error('Cannot send message: No access token');
            return false;
        }

        try {
            $response = $this->client->post($this->baseUrl . '/im/v1/messages', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type' => 'application/json; charset=utf-8',
                ],
                'query' => [
                    'receive_id_type' => 'chat_id',
                ],
                'json' => [
                    'receive_id' => $chatId,
                    'msg_type' => 'text',
                    'content' => json_encode([
                        'text' => $message
                    ], JSON_UNESCAPED_UNICODE)
                ]
            ]);

            $data = json_decode($response->getBody(), true);
            
            if (isset($data['code']) && $data['code'] === 0) {
                Log::info('✅ Lark message sent successfully', [
                    'message_id' => $data['data']['message_id'] ?? null
                ]);
                return true;
            }

            Log::error('❌ Lark send message failed', $data);
            return false;

        } catch (\Exception $e) {
            Log::error('❌ Lark send message exception: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send rich text (card) message
     */
    public function sendCardMessage($chatId, $contact)
    {
        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            return false;
        }

        $card = $this->buildContactCard($contact);

        try {
            $response = $this->client->post($this->baseUrl . '/im/v1/messages', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type' => 'application/json; charset=utf-8',
                ],
                'query' => [
                    'receive_id_type' => 'chat_id',
                ],
                'json' => [
                    'receive_id' => $chatId,
                    'msg_type' => 'interactive',
                    'content' => json_encode($card, JSON_UNESCAPED_UNICODE)
                ]
            ]);

            $data = json_decode($response->getBody(), true);
            
            if (isset($data['code']) && $data['code'] === 0) {
                Log::info('✅ Lark card message sent successfully');
                return true;
            }

            Log::error('❌ Lark send card message failed', $data);
            return false;

        } catch (\Exception $e) {
            Log::error('❌ Lark send card message exception: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Build interactive card for contact
     */
    private function buildContactCard($contact)
    {
        $statusColors = [
            'new' => 'blue',
            'processing' => 'orange',
            'completed' => 'green'
        ];

        $elements = [
            // Company info if exists
            [
                'tag' => 'div',
                'fields' => [
                    [
                        'is_short' => true,
                        'text' => [
                            'content' => "👤 **Họ tên:**\n{$contact->name}",
                            'tag' => 'lark_md',
                        ],
                    ],
                    [
                        'is_short' => true,
                        'text' => [
                            'content' => "📧 **Email:**\n{$contact->email}",
                            'tag' => 'lark_md',
                        ],
                    ],
                    [
                        'is_short' => true,
                        'text' => [
                            'content' => "📞 **Số ĐT:**\n{$contact->phone}",
                            'tag' => 'lark_md',
                        ],
                    ],
                    [
                        'is_short' => true,
                        'text' => [
                            'content' => "⏰ **Thời gian:**\n" . $contact->created_at->format('H:i d/m/Y'),
                            'tag' => 'lark_md',
                        ],
                    ],
                ],
            ]
        ];

        // Add company if exists
        if ($contact->company) {
            $elements[] = [
                'tag' => 'div',
                'text' => [
                    'content' => "🏢 **Công ty:** {$contact->company}",
                    'tag' => 'lark_md',
                ],
            ];
        }

        // Add location if exists
        if ($contact->location) {
            $elements[] = [
                'tag' => 'div',
                'text' => [
                    'content' => "📍 **Địa điểm:** {$contact->location}",
                    'tag' => 'lark_md',
                ],
            ];
        }

        // Inquiry types
        if ($contact->inquiry_types && count($contact->inquiry_types) > 0) {
            $inquiryText = implode(', ', $contact->inquiry_types);
            $elements[] = [
                'tag' => 'div',
                'text' => [
                    'content' => "📋 **Loại yêu cầu:** {$inquiryText}",
                    'tag' => 'lark_md',
                ],
            ];
        }

        // Products of interest
        if (($contact->ev_products && count($contact->ev_products) > 0) || ($contact->charging_products && count($contact->charging_products) > 0)) {
            $productText = '';
            if ($contact->ev_products && count($contact->ev_products) > 0) {
                $productText .= "\n🚛 Xe điện: " . implode(', ', $contact->ev_products);
                if ($contact->ev_products_other) {
                    $productText .= " (Khác: {$contact->ev_products_other})";
                }
            }
            if ($contact->charging_products && count($contact->charging_products) > 0) {
                $productText .= "\n⚡ Trạm sạc: " . implode(', ', $contact->charging_products);
                if ($contact->charging_products_other) {
                    $productText .= " (Khác: {$contact->charging_products_other})";
                }
            }
            $elements[] = [
                'tag' => 'div',
                'text' => [
                    'content' => "**Sản phẩm quan tâm:**{$productText}",
                    'tag' => 'lark_md',
                ],
            ];
        }

        // Intended use
        if ($contact->intended_use) {
            $intendedUseText = '';
            switch ($contact->intended_use) {
                case 'b2c':
                    $intendedUseText = 'Cá nhân (B2C)';
                    break;
                case 'b2b':
                    $intendedUseText = 'Doanh nghiệp / Logistics (B2B)';
                    break;
                case 'project':
                    $intendedUseText = 'Dự án / Đội xe';
                    break;
                case 'other':
                    $intendedUseText = 'Khác';
                    if ($contact->intended_use_other) {
                        $intendedUseText .= ": {$contact->intended_use_other}";
                    }
                    break;
            }
            $elements[] = [
                'tag' => 'div',
                'text' => [
                    'content' => "🎯 **Mục đích:** {$intendedUseText}",
                    'tag' => 'lark_md',
                ],
            ];
        }

        // Purchase plan
        $purchaseInfo = [];
        if ($contact->estimated_budget) {
            $budgetMap = [
                'under_500m' => 'Dưới 500 triệu',
                '500m_1b' => '500 triệu - 1 tỷ',
                '1b_3b' => '1 tỷ - 3 tỷ',
                '3b_5b' => '3 tỷ - 5 tỷ',
                'over_5b' => 'Trên 5 tỷ'
            ];
            $purchaseInfo[] = "💰 Ngân sách: " . ($budgetMap[$contact->estimated_budget] ?? $contact->estimated_budget);
        }
        if ($contact->purchase_timeline) {
            $timelineMap = [
                'immediate' => 'Ngay lập tức',
                '1_3_months' => '1-3 tháng',
                '3_6_months' => '3-6 tháng',
                'over_6_months' => 'Trên 6 tháng'
            ];
            $purchaseInfo[] = "📅 Thời gian: " . ($timelineMap[$contact->purchase_timeline] ?? $contact->purchase_timeline);
        }
        if (count($purchaseInfo) > 0) {
            $elements[] = [
                'tag' => 'div',
                'text' => [
                    'content' => implode("\n", $purchaseInfo),
                    'tag' => 'lark_md',
                ],
            ];
        }

        // Notes
        if ($contact->notes) {
            $elements[] = [
                'tag' => 'hr',
            ];
            $elements[] = [
                'tag' => 'div',
                'text' => [
                    'content' => "💬 **Ghi chú:**\n{$contact->notes}",
                    'tag' => 'lark_md',
                ],
            ];
        }

        // Action buttons
        $elements[] = [
            'tag' => 'hr',
        ];
        $elements[] = [
            'tag' => 'action',
            'actions' => [
                [
                    'tag' => 'button',
                    'text' => [
                        'content' => '📧 Gửi Email',
                        'tag' => 'plain_text',
                    ],
                    'url' => "mailto:{$contact->email}",
                    'type' => 'primary',
                ],
                [
                    'tag' => 'button',
                    'text' => [
                        'content' => '📞 Gọi điện',
                        'tag' => 'plain_text',
                    ],
                    'url' => "tel:{$contact->phone}",
                    'type' => 'default',
                ],
                [
                    'tag' => 'button',
                    'text' => [
                        'content' => '👁️ Xem chi tiết',
                        'tag' => 'plain_text',
                    ],
                    'url' => env('APP_URL') . "/contacts/{$contact->id}",
                    'type' => 'default',
                ],
            ],
        ];

        // Note
        $elements[] = [
            'tag' => 'note',
            'elements' => [
                [
                    'tag' => 'plain_text',
                    'content' => 'Vui lòng xử lý liên hệ này sớm nhất có thể',
                ],
            ],
        ];

        return [
            'config' => [
                'wide_screen_mode' => true,
            ],
            'header' => [
                'template' => $statusColors[$contact->status] ?? 'blue',
                'title' => [
                    'content' => '🔔 TIN NHẮN LIÊN HỆ MỚI',
                    'tag' => 'plain_text',
                ],
            ],
            'elements' => $elements,
        ];
    }

    /**
     * Format simple text message for contact
     */
    public function formatContactMessage($contact)
    {
        $statusEmojis = [
            'new' => '🔵',
            'processing' => '🟠',
            'completed' => '🟢'
        ];

        $emoji = $statusEmojis[$contact->status] ?? '🔵';
        $time = $contact->created_at->format('H:i - d/m/Y');

        $message = "━━━━━━━━━━━━━━━━━━━━━━\n";
        $message .= "🔔 TIN NHẮN LIÊN HỆ MỚI\n";
        $message .= "━━━━━━━━━━━━━━━━━━━━━━\n\n";
        $message .= "📝 Chủ đề: {$contact->subject}\n\n";
        $message .= "👤 Họ và tên: {$contact->name}\n";
        $message .= "📧 Email: {$contact->email}\n";
        $message .= "📞 Số điện thoại: {$contact->phone}\n\n";
        $message .= "💬 Nội dung:\n{$contact->message}\n\n";
        $message .= "⏰ Thời gian: {$time}\n";
        $message .= "{$emoji} Trạng thái: " . $this->getStatusText($contact->status) . "\n\n";
        $message .= "🔗 Xem chi tiết: " . env('APP_URL') . "/contacts/{$contact->id}\n";
        $message .= "━━━━━━━━━━━━━━━━━━━━━━";

        return $message;
    }

    /**
     * Get status text in Vietnamese
     */
    private function getStatusText($status)
    {
        $statuses = [
            'new' => 'Mới',
            'processing' => 'Đang xử lý',
            'completed' => 'Đã giải quyết'
        ];

        return $statuses[$status] ?? 'Không xác định';
    }

    /**
     * Test connection
     */
    public function testConnection()
    {
        $token = $this->getAccessToken();
        return $token !== null;
    }
}
