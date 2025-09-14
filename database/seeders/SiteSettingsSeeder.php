<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingsSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            // Company Information
            [
                'key' => 'company_name',
                'value' => 'K-Tech Valves',
                'type' => 'text',
                'group' => 'company',
                'label' => 'Company Name',
                'description' => 'Main company name displayed throughout the website'
            ],
            [
                'key' => 'company_tagline',
                'value' => 'Industrial Valve Solutions',
                'type' => 'text',
                'group' => 'company',
                'label' => 'Company Tagline',
                'description' => 'Short tagline or slogan for the company'
            ],
            [
                'key' => 'company_description',
                'value' => 'Leading manufacturer of high-quality industrial valves for diverse applications worldwide.',
                'type' => 'textarea',
                'group' => 'company',
                'label' => 'Company Description',
                'description' => 'Main company description used in footer and other places'
            ],
            [
                'key' => 'company_logo',
                'value' => '',
                'type' => 'image',
                'group' => 'company',
                'label' => 'Company Logo',
                'description' => 'Company logo displayed in header and footer (recommended size: 200x60px)'
            ],
            [
                'key' => 'company_experience_years',
                'value' => '25',
                'type' => 'number',
                'group' => 'company',
                'label' => 'Years of Experience',
                'description' => 'Number of years the company has been in business'
            ],

            // Contact Information
            [
                'key' => 'contact_phone',
                'value' => '+1 (555) 123-4567',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Phone Number',
                'description' => 'Main contact phone number'
            ],
            [
                'key' => 'contact_email',
                'value' => 'info@ktechvalves.com',
                'type' => 'email',
                'group' => 'contact',
                'label' => 'Email Address',
                'description' => 'Main contact email address'
            ],
            [
                'key' => 'contact_address',
                'value' => '123 Industrial Ave, Manufacturing City, MC 12345',
                'type' => 'textarea',
                'group' => 'contact',
                'label' => 'Address',
                'description' => 'Company physical address'
            ],
            [
                'key' => 'contact_province',
                'value' => 'Ontario',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Province/State',
                'description' => 'Province or state where the company is located'
            ],
            [
                'key' => 'contact_business_hours',
                'value' => 'Mon-Fri 8:00 AM - 6:00 PM',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Business Hours',
                'description' => 'Operating hours for customer service'
            ],
            [
                'key' => 'contact_response_time',
                'value' => "We'll respond within 24 hours",
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Response Time',
                'description' => 'Expected response time for inquiries'
            ],

            // Social Media
            [
                'key' => 'social_facebook',
                'value' => 'https://facebook.com/ktechvalves',
                'type' => 'url',
                'group' => 'social',
                'label' => 'Facebook URL',
                'description' => 'Facebook page URL (leave empty to hide)'
            ],
            [
                'key' => 'social_linkedin',
                'value' => 'https://linkedin.com/company/ktechvalves',
                'type' => 'url',
                'group' => 'social',
                'label' => 'LinkedIn URL',
                'description' => 'LinkedIn page URL (leave empty to hide)'
            ],
            [
                'key' => 'social_twitter',
                'value' => '',
                'type' => 'url',
                'group' => 'social',
                'label' => 'Twitter URL',
                'description' => 'Twitter profile URL (leave empty to hide)'
            ],
            [
                'key' => 'social_youtube',
                'value' => '',
                'type' => 'url',
                'group' => 'social',
                'label' => 'YouTube URL',
                'description' => 'YouTube channel URL (leave empty to hide)'
            ],

            // About Page Content
            [
                'key' => 'about_story_title',
                'value' => 'Our Story',
                'type' => 'text',
                'group' => 'about',
                'label' => 'Story Section Title',
                'description' => 'Title for the story section on about page'
            ],
            [
                'key' => 'about_story_content',
                'value' => 'K-Tech Valves has been at the forefront of industrial valve manufacturing for over two decades. Founded with a commitment to quality and innovation, we have established ourselves as a trusted partner for industries worldwide.\n\nOur journey began with a simple mission: to provide reliable, high-quality valve solutions that meet the demanding requirements of modern industrial applications. Today, we continue to uphold this mission while expanding our capabilities and product offerings.\n\nFrom our state-of-the-art manufacturing facilities to our dedicated research and development team, every aspect of K-Tech Valves is designed to deliver excellence in valve technology.',
                'type' => 'textarea',
                'group' => 'about',
                'label' => 'Story Content',
                'description' => 'Main story content for about page'
            ],
            [
                'key' => 'about_mission',
                'value' => 'To design, manufacture, and deliver superior valve solutions that exceed customer expectations while maintaining the highest standards of quality, safety, and environmental responsibility.',
                'type' => 'textarea',
                'group' => 'about',
                'label' => 'Mission Statement',
                'description' => 'Company mission statement'
            ],
            [
                'key' => 'about_vision',
                'value' => 'To be the global leader in innovative valve technologies, setting industry standards for quality, reliability, and sustainable manufacturing practices.',
                'type' => 'textarea',
                'group' => 'about',
                'label' => 'Vision Statement',
                'description' => 'Company vision statement'
            ],

            // Why Choose Us Points
            [
                'key' => 'why_choose_points',
                'value' => json_encode([
                    'Over 20 years of industry experience',
                    'ISO certified manufacturing processes',
                    'Comprehensive product range',
                    'Global technical support',
                    'Custom solutions available',
                    'Quality assurance at every step',
                    'Competitive pricing',
                    'Fast delivery worldwide'
                ]),
                'type' => 'json',
                'group' => 'about',
                'label' => 'Why Choose Us Points',
                'description' => 'List of reasons why customers should choose the company'
            ],

            // Homepage - Why Choose Section
            [
                'key' => 'homepage_why_choose_title',
                'value' => 'Why Choose K-Tech Valves?',
                'type' => 'text',
                'group' => 'homepage',
                'label' => 'Why Choose Title',
                'description' => 'Title for the why choose section on homepage'
            ],
            [
                'key' => 'homepage_why_choose_subtitle',
                'value' => 'Discover what sets us apart in the valve manufacturing industry and why customers trust us worldwide.',
                'type' => 'textarea',
                'group' => 'homepage',
                'label' => 'Why Choose Subtitle',
                'description' => 'Subtitle for the why choose section on homepage'
            ],
            [
                'key' => 'why_choose_points',
                'value' => json_encode([
                    [
                        'title' => 'Premium Quality Materials',
                        'description' => 'We use only the finest materials and manufacturing processes to ensure durability and reliability.',
                        'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'
                    ],
                    [
                        'title' => 'Expert Engineering',
                        'description' => 'Our team of experienced engineers designs valves that meet the most demanding specifications.',
                        'icon' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z'
                    ],
                    [
                        'title' => 'Global Standards Compliance',
                        'description' => 'All our products meet international standards including API, ANSI, DIN, and ISO certifications.',
                        'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'
                    ],
                    [
                        'title' => 'Custom Solutions',
                        'description' => 'We provide tailored valve solutions to meet your specific application requirements.',
                        'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c-.94 1.543-.826 3.31 2.37 2.37a1.724 1.724 0 002.572 1.065c.426 1.756-1.756 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z'
                    ],
                    [
                        'title' => 'Fast Delivery',
                        'description' => 'Quick turnaround times and efficient logistics ensure you get your valves when you need them.',
                        'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'
                    ],
                    [
                        'title' => '24/7 Support',
                        'description' => 'Our dedicated support team is available around the clock to assist with any technical queries.',
                        'icon' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z'
                    ]
                ]),
                'type' => 'json',
                'group' => 'homepage',
                'label' => 'Why Choose Points (Detailed)',
                'description' => 'Detailed why choose points with titles, descriptions, and icons for homepage'
            ],

            // About Page Settings
            [
                'key' => 'about_hero_title',
                'value' => 'About K-Tech Valves',
                'type' => 'text',
                'group' => 'about',
                'label' => 'About Hero Title',
                'description' => 'Main title for the about page hero section'
            ],
            [
                'key' => 'about_hero_subtitle',
                'value' => 'Leading the valve manufacturing industry with innovation, quality, and reliability for over two decades.',
                'type' => 'textarea',
                'group' => 'about',
                'label' => 'About Hero Subtitle',
                'description' => 'Subtitle for the about page hero section'
            ],
            [
                'key' => 'about_hero_background',
                'value' => '',
                'type' => 'text',
                'group' => 'about',
                'label' => 'About Hero Background Image',
                'description' => 'Background image URL for the about page hero section'
            ],
            [
                'key' => 'about_mission_title',
                'value' => 'Our Mission',
                'type' => 'text',
                'group' => 'about',
                'label' => 'Mission Title',
                'description' => 'Title for the mission section'
            ],
            [
                'key' => 'about_mission_content',
                'value' => 'To provide superior valve solutions that exceed industry standards and customer expectations while maintaining the highest levels of quality, safety, and environmental responsibility.',
                'type' => 'textarea',
                'group' => 'about',
                'label' => 'Mission Content',
                'description' => 'Content for the mission section'
            ],
            [
                'key' => 'about_vision_title',
                'value' => 'Our Vision',
                'type' => 'text',
                'group' => 'about',
                'label' => 'Vision Title',
                'description' => 'Title for the vision section'
            ],
            [
                'key' => 'about_vision_content',
                'value' => 'To be the global leader in valve technology and innovation, recognized for reliability and customer satisfaction across all industrial sectors.',
                'type' => 'textarea',
                'group' => 'about',
                'label' => 'Vision Content',
                'description' => 'Content for the vision section'
            ],
            [
                'key' => 'about_values_title',
                'value' => 'Our Values',
                'type' => 'text',
                'group' => 'about',
                'label' => 'Values Title',
                'description' => 'Title for the values section'
            ],
            [
                'key' => 'about_values_content',
                'value' => 'Integrity, Innovation, Quality, and Customer Focus are the core values that drive our business and culture.',
                'type' => 'textarea',
                'group' => 'about',
                'label' => 'Values Content',
                'description' => 'Content for the values section'
            ],
            [
                'key' => 'about_history_title',
                'value' => 'Our History',
                'type' => 'text',
                'group' => 'about',
                'label' => 'History Title',
                'description' => 'Title for the history section'
            ],
            [
                'key' => 'about_history_content',
                'value' => 'K-Tech Valves was founded in 1998 with a vision to provide high-quality valve solutions. Over the years, we have expanded our product range and global reach, serving diverse industries with excellence.',
                'type' => 'textarea',
                'group' => 'about',
                'label' => 'History Content',
                'description' => 'Content for the history section'
            ],
            [
                'key' => 'about_team_title',
                'value' => 'Meet Our Team',
                'type' => 'text',
                'group' => 'about',
                'label' => 'Team Title',
                'description' => 'Title for the team section'
            ],
            [
                'key' => 'about_team_content',
                'value' => 'Our team of experts is dedicated to delivering innovative valve solutions and exceptional service to our customers.',
                'type' => 'textarea',
                'group' => 'about',
                'label' => 'Team Content',
                'description' => 'Content for the team section'
            ],
            [
                'key' => 'about_careers_title',
                'value' => 'Join Our Team',
                'type' => 'text',
                'group' => 'about',
                'label' => 'Careers Title',
                'description' => 'Title for the careers section'
            ],
            [
                'key' => 'about_careers_content',
                'value' => 'We are always looking for talented individuals who share our passion for innovation and quality. Explore our current job openings and become a part of the K-Tech Valves team.',
                'type' => 'textarea',
                'group' => 'about',
                'label' => 'Careers Content',
                'description' => 'Content for the careers section'
            ],
            [
                'key' => 'about_contact_title',
                'value' => 'Get in Touch',
                'type' => 'text',
                'group' => 'about',
                'label' => 'Contact Title',
                'description' => 'Title for the contact section'
            ],
            [
                'key' => 'about_contact_content',
                'value' => 'Have questions or need more information about our products and services? Our team is here to help.',
                'type' => 'textarea',
                'group' => 'about',
                'label' => 'Contact Content',
                'description' => 'Content for the contact section'
            ],

            // Footer Settings
            [
                'key' => 'footer_about_text',
                'value' => 'Leading manufacturer of high-quality industrial valves for diverse applications worldwide.',
                'type' => 'textarea',
                'group' => 'footer',
                'label' => 'Footer About Text',
                'description' => 'About text displayed in footer'
            ],
            [
                'key' => 'footer_copyright',
                'value' => 'K-Tech Valves. All rights reserved.',
                'type' => 'text',
                'group' => 'footer',
                'label' => 'Copyright Text',
                'description' => 'Copyright text (year will be added automatically)'
            ],

            // Form Messages
            [
                'key' => 'form_success_message',
                'value' => 'Thank you for your message! We will get back to you within 24 hours.',
                'type' => 'textarea',
                'group' => 'forms',
                'label' => 'Success Message',
                'description' => 'Message shown after successful form submission'
            ],
            [
                'key' => 'form_newsletter_text',
                'value' => 'I would like to receive newsletters and updates about K-Tech Valves products and services.',
                'type' => 'textarea',
                'group' => 'forms',
                'label' => 'Newsletter Checkbox Text',
                'description' => 'Text for newsletter subscription checkbox'
            ]
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
