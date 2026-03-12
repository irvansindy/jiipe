<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class ShareLinkHelper
{
    /**
     * Generate unique short code untuk news
     * Format: n-XXXXXXXX (n untuk news)
     */
    public static function generateShortCode(string $prefix = 'n'): string
    {
        return $prefix . '-' . Str::random(8);
    }

    /**
     * Generate shareable short URL
     * Contoh: https://jiipe.co.id/s/n-abcd1234
     */
    public static function generateShortUrl(string $shortCode): string
    {
        return config('app.url') . '/s/' . $shortCode;
    }

    /**
     * Generate Facebook share URL
     */
    public static function getFacebookShareUrl(string $url): string
    {
        return 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($url);
    }

    /**
     * Generate Twitter share URL
     */
    public static function getTwitterShareUrl(string $url, string $title = ''): string
    {
        $params = [
            'url' => $url,
        ];

        if (!empty($title)) {
            $params['text'] = Str::limit($title, 130);
        }

        return 'https://twitter.com/intent/tweet?' . http_build_query($params);
    }

    /**
     * Generate LinkedIn share URL
     */
    public static function getLinkedInShareUrl(string $url): string
    {
        return 'https://www.linkedin.com/sharing/share-offsite/?url=' . urlencode($url);
    }

    /**
     * Generate WhatsApp share URL
     */
    public static function getWhatsAppShareUrl(string $url, string $title = ''): string
    {
        $text = $title ? $title . ' ' . $url : $url;
        return 'https://wa.me/?text=' . urlencode($text);
    }

    /**
     * Generate email share URL
     */
    public static function getEmailShareUrl(string $url, string $subject = '', string $body = ''): string
    {
        $params = [
            'subject' => $subject ?: 'Check this out!',
            'body' => ($body ? $body . ' ' : '') . $url,
        ];

        return 'mailto:?subject=' . urlencode($params['subject']) . '&body=' . urlencode($params['body']);
    }

    /**
     * Generate lengkap social share data
     */
    public static function generateShareData(array $data): array
    {
        $shortCode = $data['short_code'] ?? null;
        $url = $data['url'] ?? route('blog.detail', ['id' => $data['id']]);
        $title = $data['title'] ?? '';
        $description = $data['description'] ?? '';
        // Ensure image is fully qualified URL dengan domain
        $image = isset($data['image']) && !empty($data['image'])
            ? $data['image']
            : url('asset/images/default-blog.jpg');

        if ($shortCode) {
            $shortUrl = self::generateShortUrl($shortCode);
        } else {
            $shortUrl = $url;
        }

        return [
            'original_url' => $url,
            'short_url' => $shortUrl,
            'title' => $title,
            'description' => $description,
            'image' => $image,
            'social' => [
                'facebook' => self::getFacebookShareUrl($shortUrl),
                'twitter' => self::getTwitterShareUrl($shortUrl, $title),
                'linkedin' => self::getLinkedInShareUrl($shortUrl),
                'whatsapp' => self::getWhatsAppShareUrl($shortUrl, $title),
                'email' => self::getEmailShareUrl($shortUrl, $title, $description),
            ],
            'og_meta' => [
                'title' => $title,
                'description' => $description,
                'image' => $image,
                'url' => $shortUrl,
                'type' => 'article',
            ],
        ];
    }
}
