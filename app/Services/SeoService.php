<?php

namespace App\Services;

use App\Models\WebsiteSetting;
use Illuminate\Support\Facades\View;

class SeoService
{
    /**
     * Set SEO data for the current page
     *
     * @param string $pageType
     * @param string|null $identifier
     * @param array $fallbackData
     * @return void
     */
    public static function setSeoData($pageType, $identifier = null, $fallbackData = [])
    {
        $seoData = static::getSeoData($pageType, $identifier, $fallbackData);
        
        // Share SEO data with all views
        View::share('seoData', $seoData);
        View::share('pageTitle', $seoData['title']);
        View::share('metaDescription', $seoData['description']);
        View::share('metaKeywords', $seoData['keywords']);
        View::share('canonicalUrl', $seoData['canonical_url']);
        View::share('ogData', $seoData['og_data']);
        View::share('twitterData', $seoData['twitter_data']);
    }

    /**
     * Get SEO data for a specific page
     *
     * @param string $pageType
     * @param string|null $identifier
     * @param array $fallbackData
     * @return array
     */
    public static function getSeoData($pageType, $identifier = null, $fallbackData = [])
    {
        // Get website settings for default values
        $websiteSettings = WebsiteSetting::getByGroup('general');
        $socialSettings = WebsiteSetting::getByGroup('social');
        
        $defaultTitle = $websiteSettings['site_name'] ?? 'K Tech Valves';
        $defaultDescription = $websiteSettings['site_description'] ?? 'Leading Industrial Valve Manufacturer';
        $defaultKeywords = $websiteSettings['site_keywords'] ?? 'industrial valves, butterfly valve, ball valve';
        $siteName = $websiteSettings['site_name'] ?? 'K Tech Valves';
        $siteUrl = $websiteSettings['site_url'] ?? url('/');
        
        // Base SEO data
        $seoData = [
            'title' => $fallbackData['title'] ?? $defaultTitle,
            'description' => $fallbackData['description'] ?? $defaultDescription,
            'keywords' => $fallbackData['keywords'] ?? $defaultKeywords,
            'canonical_url' => $fallbackData['canonical_url'] ?? request()->url(),
            'site_name' => $siteName,
            'page_type' => $pageType,
            'identifier' => $identifier,
        ];

        // Open Graph data
        $seoData['og_data'] = [
            'title' => $seoData['title'],
            'description' => $seoData['description'],
            'url' => $seoData['canonical_url'],
            'type' => static::getOgType($pageType),
            'site_name' => $siteName,
            'image' => $fallbackData['og_image'] ?? $websiteSettings['og_image'] ?? asset('images/og-default.jpg'),
        ];

        // Twitter Card data
        $seoData['twitter_data'] = [
            'card' => 'summary_large_image',
            'title' => $seoData['title'],
            'description' => $seoData['description'],
            'image' => $seoData['og_data']['image'],
            'site' => $socialSettings['twitter_handle'] ?? '@ktechvalves',
        ];

        return $seoData;
    }

    /**
     * Generate organization schema markup
     *
     * @return string
     */
    public static function generateOrganizationSchema()
    {
        $websiteSettings = WebsiteSetting::getByGroup('general');
        $contactSettings = WebsiteSetting::getByGroup('contact');
        $socialSettings = WebsiteSetting::getByGroup('social');

        $schema = [
            "@context" => "https://schema.org",
            "@type" => "Organization",
            "name" => $websiteSettings['site_name'] ?? "K Tech Valves",
            "description" => $websiteSettings['site_description'] ?? "Leading Industrial Valve Manufacturer",
            "url" => $websiteSettings['site_url'] ?? url('/'),
            "logo" => [
                "@type" => "ImageObject",
                "url" => $websiteSettings['site_logo'] ?? asset('images/logo.png'),
            ],
            "contactPoint" => [
                "@type" => "ContactPoint",
                "telephone" => $contactSettings['phone'] ?? "",
                "contactType" => "Customer Service",
                "email" => $contactSettings['email'] ?? "",
            ],
            "address" => [
                "@type" => "PostalAddress",
                "streetAddress" => $contactSettings['address'] ?? "",
                "addressLocality" => $contactSettings['city'] ?? "",
                "addressRegion" => $contactSettings['state'] ?? "",
                "postalCode" => $contactSettings['postal_code'] ?? "",
                "addressCountry" => $contactSettings['country'] ?? "IN",
            ],
            "foundingDate" => "2010",
            "numberOfEmployees" => "50-100",
        ];

        // Add social media profiles if available
        $socialProfiles = [];
        if (!empty($socialSettings['facebook_url'])) {
            $socialProfiles[] = $socialSettings['facebook_url'];
        }
        if (!empty($socialSettings['twitter_url'])) {
            $socialProfiles[] = $socialSettings['twitter_url'];
        }
        if (!empty($socialSettings['linkedin_url'])) {
            $socialProfiles[] = $socialSettings['linkedin_url'];
        }
        if (!empty($socialSettings['youtube_url'])) {
            $socialProfiles[] = $socialSettings['youtube_url'];
        }

        if (!empty($socialProfiles)) {
            $schema["sameAs"] = $socialProfiles;
        }

        return json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     * Generate product schema markup
     *
     * @param object $product
     * @return string
     */
    public static function generateProductSchema($product)
    {
        $websiteSettings = WebsiteSetting::getByGroup('general');
        
        $schema = [
            "@context" => "https://schema.org",
            "@type" => "Product",
            "name" => $product->name,
            "description" => $product->short_description ?? $product->description,
            "image" => $product->main_image_url ?? asset('images/product-default.jpg'),
            "url" => route('products.show', $product->slug),
            "sku" => $product->sku ?? $product->id,
            "brand" => [
                "@type" => "Brand",
                "name" => $websiteSettings['site_name'] ?? "K Tech Valves",
            ],
            "manufacturer" => [
                "@type" => "Organization",
                "name" => $websiteSettings['site_name'] ?? "K Tech Valves",
            ],
            "category" => $product->category->name ?? "Industrial Valves",
        ];

        // Add offers if price is available
        if (!empty($product->price)) {
            $schema["offers"] = [
                "@type" => "Offer",
                "price" => $product->price,
                "priceCurrency" => "INR",
                "availability" => "https://schema.org/InStock",
                "seller" => [
                    "@type" => "Organization",
                    "name" => $websiteSettings['site_name'] ?? "K Tech Valves",
                ],
            ];
        }

        return json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     * Generate breadcrumb schema markup
     *
     * @param array $breadcrumbs
     * @return string
     */
    public static function generateBreadcrumbSchema($breadcrumbs)
    {
        $itemListElement = [];
        
        foreach ($breadcrumbs as $index => $breadcrumb) {
            $itemListElement[] = [
                "@type" => "ListItem",
                "position" => $index + 1,
                "name" => $breadcrumb['title'],
                "item" => $breadcrumb['url'] ?? null,
            ];
        }

        $schema = [
            "@context" => "https://schema.org",
            "@type" => "BreadcrumbList",
            "itemListElement" => $itemListElement,
        ];

        return json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     * Generate FAQ schema markup
     *
     * @param array $faqs
     * @return string
     */
    public static function generateFaqSchema($faqs)
    {
        $mainEntity = [];
        
        foreach ($faqs as $faq) {
            $mainEntity[] = [
                "@type" => "Question",
                "name" => $faq['question'],
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => $faq['answer'],
                ],
            ];
        }

        $schema = [
            "@context" => "https://schema.org",
            "@type" => "FAQPage",
            "mainEntity" => $mainEntity,
        ];

        return json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     * Get Open Graph type based on page type
     *
     * @param string $pageType
     * @return string
     */
    protected static function getOgType($pageType)
    {
        $typeMap = [
            'homepage' => 'website',
            'product' => 'product',
            'blog' => 'article',
            'page' => 'article',
            'category' => 'website',
            'industry' => 'website',
        ];

        return $typeMap[$pageType] ?? 'website';
    }

    /**
     * Generate meta tags HTML
     *
     * @param array $seoData
     * @return string
     */
    public static function generateMetaTags($seoData = null)
    {
        if (!$seoData) {
            $seoData = View::shared('seoData', []);
        }

        $html = '';
        
        // Basic meta tags
        if (!empty($seoData['description'])) {
            $html .= '<meta name="description" content="' . e($seoData['description']) . '">' . "\n";
        }
        
        if (!empty($seoData['keywords'])) {
            $html .= '<meta name="keywords" content="' . e($seoData['keywords']) . '">' . "\n";
        }
        
        if (!empty($seoData['canonical_url'])) {
            $html .= '<link rel="canonical" href="' . e($seoData['canonical_url']) . '">' . "\n";
        }

        // Open Graph tags
        if (!empty($seoData['og_data'])) {
            foreach ($seoData['og_data'] as $property => $content) {
                if (!empty($content)) {
                    $html .= '<meta property="og:' . $property . '" content="' . e($content) . '">' . "\n";
                }
            }
        }

        // Twitter Card tags
        if (!empty($seoData['twitter_data'])) {
            foreach ($seoData['twitter_data'] as $name => $content) {
                if (!empty($content)) {
                    $html .= '<meta name="twitter:' . $name . '" content="' . e($content) . '">' . "\n";
                }
            }
        }

        return $html;
    }
}