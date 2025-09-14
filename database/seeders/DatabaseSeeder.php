<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create roles
        $superAdminRole = Role::create([
            'name' => 'super_admin',
            'display_name' => 'Super Administrator',
            'description' => 'Full access to all features',
            'permissions' => [
                'manage_users',
                'manage_roles',
                'manage_products',
                'manage_categories',
                'manage_pages',
                'manage_banners',
                'manage_galleries',
                'manage_industries',
                'manage_certifications',
                'manage_clients',
                'manage_inquiries',
                'manage_settings'
            ]
        ]);

        $adminRole = Role::create([
            'name' => 'admin',
            'display_name' => 'Administrator',
            'description' => 'Content management access',
            'permissions' => [
                'manage_products',
                'manage_categories',
                'manage_pages',
                'manage_banners',
                'manage_galleries',
                'manage_industries',
                'manage_certifications',
                'manage_clients',
                'manage_inquiries'
            ]
        ]);

        // Create super admin user
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@ktechvalves.com',
            'password' => Hash::make('password123'),
            'role_id' => $superAdminRole->id,
            'is_active' => true,
        ]);

        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'manager@ktechvalves.com',
            'password' => Hash::make('password123'),
            'role_id' => $adminRole->id,
            'is_active' => true,
        ]);

        // Create product categories
        $categories = [
            [
                'name' => 'Butterfly Valves',
                'slug' => 'butterfly-valves',
                'description' => 'High-performance butterfly valves for various industrial applications',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Ball Valves',
                'slug' => 'ball-valves',
                'description' => 'Durable ball valves designed for reliable flow control',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Check Valves',
                'slug' => 'check-valves',
                'description' => 'Prevent backflow with our premium check valves',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Gate Valves',
                'slug' => 'gate-valves',
                'description' => 'Industrial gate valves for on/off applications',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Globe Valves',
                'slug' => 'globe-valves',
                'description' => 'Precision flow control with globe valves',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Automation Valves',
                'slug' => 'automation-valves',
                'description' => 'Automated valve solutions for modern industrial processes',
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create sample products
        $products = [
            [
                'name' => 'Industrial Butterfly Valve DN100',
                'slug' => 'industrial-butterfly-valve-dn100',
                'category_id' => 1,
                'description' => 'High-performance industrial butterfly valve with ductile iron body and stainless steel disc.',
                'content' => '<p>High-performance industrial butterfly valve with ductile iron body and stainless steel disc. Designed for reliable operation in demanding industrial applications.</p>',
                'model_number' => 'KTV-BF-100',
                'technical_specifications' => json_encode([
                    'Nominal Size' => 'DN100 (4 inches)',
                    'Body Material' => 'Ductile Iron ASTM A536 Grade 65-45-12',
                    'Disc Material' => 'Stainless Steel 316 (ASTM A351 CF8M)',
                    'Shaft Material' => 'Stainless Steel 420 (ASTM A276)',
                    'Seat Material' => 'EPDM (Standard) / NBR / Viton Available',
                    'Pressure Rating' => 'PN16 (16 bar @ 20°C)',
                    'Temperature Range' => '-10°C to +120°C (EPDM Seat)',
                    'End Connection' => 'Wafer, Lug, or Flanged Types Available',
                    'Face to Face' => 'EN 558-1 Series 20 (43mm Wafer)',
                    'Flange Standard' => 'EN 1092-1 PN16 or ASME B16.5 Class 150',
                    'Test Pressure' => 'Shell: 24 bar, Seat: 17.6 bar',
                    'Leakage Rate' => 'EN 12266-1 Rate A (Zero Leakage)',
                    'Flow Coefficient (Kv)' => '840 m³/h (Full Open)',
                    'Torque Requirement' => '95 Nm (Manual Operation)',
                    'Weight' => 'Approximately 12.8 kg (Wafer Type)',
                    'Mounting Standard' => 'ISO 5211 F07/F10 Compatible',
                    'Coating' => 'Epoxy Powder Coating (250 microns)',
                    'Standards Compliance' => 'EN 593, API 609, AWWA C504',
                    'Certifications' => 'CE Marked, PED 2014/68/EU Compliant',
                    'Fire Safe' => 'API 607 Fire Safe Design Available',
                    'Operation' => 'Manual Lever, Gearbox, or Electric Actuator Ready'
                ]),
                'features' => json_encode([
                    'Low torque operation',
                    'Bidirectional sealing',
                    'Fire-safe design',
                    'Extended stem available',
                    'ISO 5211 mounting pad'
                ]),
                'applications' => json_encode([
                    'Water treatment',
                    'HVAC systems',
                    'Chemical processing',
                    'Power generation'
                ]),
                'price' => 1250.00,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
                'meta_data' => json_encode([
                    'title' => 'Industrial Butterfly Valve DN100 - K-Tech Valves',
                    'description' => 'High-performance DN100 butterfly valve for industrial applications with ductile iron body and stainless steel disc.'
                ])
            ],
            [
                'name' => 'Stainless Steel Ball Valve 1/2"',
                'slug' => 'stainless-steel-ball-valve-half-inch',
                'category_id' => 2,
                'description' => 'Premium stainless steel ball valve with full bore design and PTFE seats.',
                'content' => '<p>Premium stainless steel ball valve with full bore design and PTFE seats. Ideal for high-pressure applications requiring reliable shut-off.</p>',
                'model_number' => 'KTV-BV-15',
                'technical_specifications' => json_encode([
                    'Size' => '1/2" (DN15)',
                    'Material' => 'SS316',
                    'Pressure' => '1000 PSI',
                    'Temperature' => '-20°C to +200°C',
                    'End Connection' => 'NPT/BSP'
                ]),
                'features' => json_encode([
                    'Full bore design',
                    'Blow-out proof stem',
                    'Anti-static device',
                    'Locking handle available',
                    'ISO 5211 mounting'
                ]),
                'applications' => json_encode([
                    'Oil & Gas',
                    'Petrochemical',
                    'Marine applications',
                    'Food processing'
                ]),
                'price' => 85.00,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
                'meta_data' => json_encode([
                    'title' => 'Stainless Steel Ball Valve 1/2" - K-Tech Valves',
                    'description' => 'Premium 1/2" stainless steel ball valve with full bore design and PTFE seats for industrial use.'
                ])
            ],
            [
                'name' => 'Swing Check Valve DN50',
                'slug' => 'swing-check-valve-dn50',
                'category_id' => 3,
                'description' => 'Reliable swing check valve with bronze disc and renewable seat ring.',
                'content' => '<p>Reliable swing check valve with bronze disc and renewable seat ring. Prevents backflow in pipeline systems.</p>',
                'model_number' => 'KTV-CV-50',
                'technical_specifications' => json_encode([
                    'Size' => 'DN50 (2")',
                    'Material' => 'Cast Iron + Bronze',
                    'Pressure' => 'PN16',
                    'Temperature' => '-10°C to +100°C',
                    'End Connection' => 'Flanged'
                ]),
                'features' => json_encode([
                    'Low pressure drop',
                    'Renewable seat ring',
                    'Slam-shut design',
                    'Horizontal/vertical installation',
                    'Metal-to-metal sealing'
                ]),
                'applications' => json_encode([
                    'Water systems',
                    'Pump protection',
                    'Pipeline systems',
                    'Industrial processes'
                ]),
                'price' => 320.00,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 3,
                'meta_data' => json_encode([
                    'title' => 'Swing Check Valve DN50 - K-Tech Valves',
                    'description' => 'Reliable DN50 swing check valve with bronze disc and renewable seat ring for backflow prevention.'
                ])
            ],
            [
                'name' => 'Cast Steel Gate Valve DN80',
                'slug' => 'cast-steel-gate-valve-dn80',
                'category_id' => 4,
                'description' => 'Heavy-duty cast steel gate valve with rising stem and handwheel operation.',
                'content' => '<p>Heavy-duty cast steel gate valve with rising stem and handwheel operation. Designed for on/off service in high-pressure applications.</p>',
                'model_number' => 'KTV-GV-80',
                'technical_specifications' => json_encode([
                    'Size' => 'DN80 (3")',
                    'Material' => 'Cast Steel',
                    'Pressure' => 'Class 150',
                    'Temperature' => '-29°C to +425°C',
                    'End Connection' => 'RF Flanged'
                ]),
                'features' => json_encode([
                    'Rising stem design',
                    'Backseat capability',
                    'Solid wedge disc',
                    'Bolted bonnet',
                    'OS&Y construction'
                ]),
                'applications' => json_encode([
                    'Steam service',
                    'Oil refinery',
                    'Power plants',
                    'Chemical plants'
                ]),
                'price' => 890.00,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 4,
                'meta_data' => json_encode([
                    'title' => 'Cast Steel Gate Valve DN80 - K-Tech Valves',
                    'description' => 'Heavy-duty DN80 cast steel gate valve with rising stem and handwheel operation for industrial use.'
                ])
            ],
            [
                'name' => 'Bronze Globe Valve 1"',
                'slug' => 'bronze-globe-valve-1-inch',
                'category_id' => 5,
                'description' => 'Precision bronze globe valve with renewable disc and seat for accurate flow control.',
                'content' => '<p>Precision bronze globe valve with renewable disc and seat for accurate flow control. Perfect for throttling applications.</p>',
                'model_number' => 'KTV-GBV-25',
                'technical_specifications' => json_encode([
                    'Size' => '1" (DN25)',
                    'Material' => 'Bronze',
                    'Pressure' => '200 PSI',
                    'Temperature' => '-10°C to +120°C',
                    'End Connection' => 'NPT'
                ]),
                'features' => json_encode([
                    'Renewable disc & seat',
                    'Precision flow control',
                    'Packed gland design',
                    'Handwheel operation',
                    'Compact design'
                ]),
                'applications' => json_encode([
                    'HVAC systems',
                    'Plumbing',
                    'Process control',
                    'Building services'
                ]),
                'price' => 145.00,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 5,
                'meta_data' => json_encode([
                    'title' => 'Bronze Globe Valve 1" - K-Tech Valves',
                    'description' => 'Precision 1" bronze globe valve with renewable disc and seat for accurate flow control applications.'
                ])
            ],
            [
                'name' => 'Pneumatic Butterfly Valve DN150',
                'slug' => 'pneumatic-butterfly-valve-dn150',
                'category_id' => 6,
                'description' => 'Automated butterfly valve with pneumatic actuator and positioner for remote control.',
                'content' => '<p>Automated butterfly valve with pneumatic actuator and positioner for remote control. Includes fail-safe operation and position feedback.</p>',
                'model_number' => 'KTV-PBF-150',
                'technical_specifications' => json_encode([
                    'Size' => 'DN150 (6")',
                    'Material' => 'Ductile Iron + SS316',
                    'Pressure' => 'PN16',
                    'Temperature' => '-10°C to +120°C',
                    'Actuator' => 'Pneumatic Double Acting'
                ]),
                'features' => json_encode([
                    'Fail-safe operation',
                    'Position feedback',
                    'Remote control capability',
                    'Fast operation time',
                    'Manual override'
                ]),
                'applications' => json_encode([
                    'Process automation',
                    'Water treatment',
                    'Power generation',
                    'Chemical processing'
                ]),
                'price' => 2850.00,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 6,
                'meta_data' => json_encode([
                    'title' => 'Pneumatic Butterfly Valve DN150 - K-Tech Valves',
                    'description' => 'Automated DN150 butterfly valve with pneumatic actuator and positioner for remote control applications.'
                ])
            ],
            [
                'name' => 'High Pressure Ball Valve 2"',
                'slug' => 'high-pressure-ball-valve-2-inch',
                'category_id' => 2,
                'description' => 'Heavy-duty ball valve designed for high-pressure applications with forged steel body.',
                'content' => '<p>Heavy-duty ball valve designed for high-pressure applications with forged steel body. Fire-safe design for critical applications.</p>',
                'model_number' => 'KTV-HPBV-50',
                'technical_specifications' => json_encode([
                    'Size' => '2" (DN50)',
                    'Material' => 'Forged Steel',
                    'Pressure' => 'Class 800',
                    'Temperature' => '-46°C to +425°C',
                    'End Connection' => 'RTJ Flanged'
                ]),
                'features' => json_encode([
                    'Forged body construction',
                    'Fire-safe design',
                    'Anti-blow-out stem',
                    'Emergency sealant injection',
                    'Extended bonnet available'
                ]),
                'applications' => json_encode([
                    'Oil & Gas upstream',
                    'High-pressure pipelines',
                    'Wellhead applications',
                    'Refinery processes'
                ]),
                'price' => 1650.00,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 7,
                'meta_data' => json_encode([
                    'title' => 'High Pressure Ball Valve 2" - K-Tech Valves',
                    'description' => 'Heavy-duty 2" ball valve designed for high-pressure applications with forged steel body construction.'
                ])
            ],
            [
                'name' => 'Wafer Check Valve DN25',
                'slug' => 'wafer-check-valve-dn25',
                'category_id' => 3,
                'description' => 'Compact wafer check valve with spring-loaded disc for space-saving installation.',
                'content' => '<p>Compact wafer check valve with spring-loaded disc for space-saving installation. Silent operation with low cracking pressure.</p>',
                'model_number' => 'KTV-WCV-25',
                'technical_specifications' => json_encode([
                    'Size' => 'DN25 (1")',
                    'Material' => 'Ductile Iron',
                    'Pressure' => 'PN25',
                    'Temperature' => '-10°C to +120°C',
                    'End Connection' => 'Wafer'
                ]),
                'features' => json_encode([
                    'Space-saving design',
                    'Spring-loaded disc',
                    'Low cracking pressure',
                    'Silent operation',
                    'Maintenance-free'
                ]),
                'applications' => json_encode([
                    'Pump discharge',
                    'Compressor systems',
                    'Meter protection',
                    'Heating systems'
                ]),
                'price' => 95.00,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 8,
                'meta_data' => json_encode([
                    'title' => 'Wafer Check Valve DN25 - K-Tech Valves',
                    'description' => 'Compact DN25 wafer check valve with spring-loaded disc for space-saving installation.'
                ])
            ],
            [
                'name' => 'Electric Actuated Gate Valve DN100',
                'slug' => 'electric-actuated-gate-valve-dn100',
                'category_id' => 6,
                'description' => 'Motor-operated gate valve with electric actuator for automated on/off control.',
                'content' => '<p>Motor-operated gate valve with electric actuator for automated on/off control. Features position indication and manual override.</p>',
                'model_number' => 'KTV-EGV-100',
                'technical_specifications' => json_encode([
                    'Size' => 'DN100 (4")',
                    'Material' => 'Cast Steel',
                    'Pressure' => 'Class 300',
                    'Temperature' => '-29°C to +425°C',
                    'Actuator' => 'Electric Motor Operated'
                ]),
                'features' => json_encode([
                    'Remote operation',
                    'Position indication',
                    'Torque protection',
                    'Manual override',
                    'Weatherproof enclosure'
                ]),
                'applications' => json_encode([
                    'Power plants',
                    'Water treatment',
                    'Oil & Gas facilities',
                    'Process automation'
                ]),
                'price' => 3250.00,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 9,
                'meta_data' => json_encode([
                    'title' => 'Electric Actuated Gate Valve DN100 - K-Tech Valves',
                    'description' => 'Motor-operated DN100 gate valve with electric actuator for automated on/off control applications.'
                ])
            ],
            [
                'name' => 'Cryogenic Ball Valve DN80',
                'slug' => 'cryogenic-ball-valve-dn80',
                'category_id' => 2,
                'description' => 'Specialized ball valve designed for cryogenic applications with extended bonnet.',
                'content' => '<p>Specialized ball valve designed for cryogenic applications with extended bonnet. Features special packing system for extreme low temperatures.</p>',
                'model_number' => 'KTV-CBV-80',
                'technical_specifications' => json_encode([
                    'Nominal Size' => 'DN80 (3 inches)',
                    'Body Material' => 'Stainless Steel 316L (ASTM A351 CF3M)',
                    'Ball Material' => 'Stainless Steel 316L with Chrome Plating',
                    'Seat Material' => 'PEEK (Polyetheretherketone) or PTFE',
                    'Stem Material' => 'Stainless Steel 316L (ASTM A182 F316L)',
                    'Pressure Rating' => 'ANSI Class 150 (19.3 bar @ 38°C)',
                    'Temperature Range' => '-196°C to +100°C (Cryogenic to Standard)',
                    'End Connection' => 'Raised Face Flanged (ASME B16.5)',
                    'Face to Face' => 'ASME B16.10 (203mm)',
                    'Test Pressure' => 'Shell: 28.95 bar, Seat: 19.3 bar',
                    'Leakage Class' => 'API 598 Class VI (Bubble Tight)',
                    'Fire Safe Design' => 'API 607 & BS 6755 Part 2 Compliant',
                    'Mounting Pad' => 'ISO 5211 Direct Mount Ready',
                    'Operation' => 'Manual Lever, Gear Box, or Actuator Ready',
                    'Flow Coefficient (Cv)' => '175 (Full Bore Design)',
                    'Weight' => 'Approximately 18.5 kg',
                    'Bonnet Type' => 'Extended Bonnet for Cryogenic Service',
                    'Packing' => 'Expanded Graphite + PTFE Backup Rings',
                    'Stem Sealing' => 'Double O-Ring + Live Loaded Packing',
                    'Certifications' => 'CE, PED 2014/68/EU, ATEX if required',
                    'Standards Compliance' => 'ASME B16.34, API 6D, ISO 17292'
                ]),
                'features' => json_encode([
                    'Extended bonnet design',
                    'Cryogenic service rated',
                    'Special packing system',
                    'Vacuum jacketed',
                    'Low emission design'
                ]),
                'applications' => json_encode([
                    'LNG facilities',
                    'Cryogenic storage',
                    'Air separation plants',
                    'Liquid nitrogen systems'
                ]),
                'price' => 4250.00,
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 10,
                'meta_data' => json_encode([
                    'title' => 'Cryogenic Ball Valve DN80 - K-Tech Valves',
                    'description' => 'Specialized DN80 ball valve designed for cryogenic applications with extended bonnet and special materials.'
                ])
            ]
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }

        // Create sample pages
        $pages = [
            [
                'title' => 'About K-Tech Valves',
                'slug' => 'about-us',
                'content' => '<h2>About K-Tech Valves</h2><p>K-Tech Valves is a leading manufacturer of industrial valves with over 25 years of experience in the industry. We specialize in designing and manufacturing high-quality valves for various industrial applications including oil & gas, water treatment, power generation, and chemical processing.</p><p>Our commitment to quality, innovation, and customer satisfaction has made us a trusted partner for businesses worldwide.</p>',
                'template' => 'default',
                'is_active' => true,
                'meta_data' => json_encode([
                    'title' => 'About K-Tech Valves - Industrial Valve Manufacturer',
                    'description' => 'Learn about K-Tech Valves, a leading manufacturer of industrial valves with 25+ years of experience in oil & gas, water treatment, and chemical processing.'
                ])
            ],
            [
                'title' => 'Quality Assurance',
                'slug' => 'quality-assurance',
                'content' => '<h2>Quality Assurance</h2><p>At K-Tech Valves, quality is our top priority. We maintain strict quality control measures throughout our manufacturing process to ensure every valve meets the highest standards.</p><ul><li>ISO 9001:2015 certified facility</li><li>100% pressure testing</li><li>Material traceability</li><li>Third-party inspections</li></ul>',
                'template' => 'default',
                'is_active' => true,
                'meta_data' => json_encode([
                    'title' => 'Quality Assurance - K-Tech Valves',
                    'description' => 'K-Tech Valves maintains strict quality control with ISO 9001:2015 certification, 100% pressure testing, and material traceability.'
                ])
            ],
            [
                'title' => 'Manufacturing Capabilities',
                'slug' => 'manufacturing',
                'content' => '<h2>Manufacturing Capabilities</h2><p>Our state-of-the-art manufacturing facility is equipped with the latest technology and machinery to produce valves ranging from 1/2" to 48" in diameter.</p><p>We have the capability to manufacture valves in various materials including carbon steel, stainless steel, alloy steel, and exotic materials for specialized applications.</p>',
                'template' => 'default',
                'is_active' => true,
                'meta_data' => json_encode([
                    'title' => 'Manufacturing Capabilities - K-Tech Valves',
                    'description' => 'State-of-the-art manufacturing facility producing valves from 1/2" to 48" diameter in various materials including exotic alloys.'
                ])
            ],
            [
                'title' => 'Technical Support',
                'slug' => 'technical-support',
                'content' => '<h2>Technical Support</h2><p>Our experienced technical team provides comprehensive support throughout the entire project lifecycle, from initial consultation to after-sales service.</p><p>We offer:</p><ul><li>Application engineering</li><li>Custom valve design</li><li>Installation guidance</li><li>Maintenance support</li><li>Training programs</li></ul>',
                'template' => 'default',
                'is_active' => true,
                'meta_data' => json_encode([
                    'title' => 'Technical Support - K-Tech Valves',
                    'description' => 'Comprehensive technical support including application engineering, custom design, installation guidance, and training programs.'
                ])
            ],
            [
                'title' => 'Global Presence',
                'slug' => 'global-presence',
                'content' => '<h2>Global Presence</h2><p>K-Tech Valves serves customers worldwide through our network of distributors and sales representatives. We have successfully supplied valves to projects in over 50 countries.</p><p>Our global presence ensures quick response times and local support for our international customers.</p>',
                'template' => 'default',
                'is_active' => true,
                'meta_data' => json_encode([
                    'title' => 'Global Presence - K-Tech Valves',
                    'description' => 'K-Tech Valves serves customers worldwide through distributor network, successfully supplying valves to projects in 50+ countries.'
                ])
            ],
            [
                'title' => 'Environmental Commitment',
                'slug' => 'environmental-commitment',
                'content' => '<h2>Environmental Commitment</h2><p>We are committed to sustainable manufacturing practices and environmental protection. Our facility operates under strict environmental guidelines to minimize our carbon footprint.</p><p>We implement green manufacturing processes and continuously work to reduce waste and improve energy efficiency.</p>',
                'template' => 'default',
                'is_active' => true,
                'meta_data' => json_encode([
                    'title' => 'Environmental Commitment - K-Tech Valves',
                    'description' => 'K-Tech Valves is committed to sustainable manufacturing practices, environmental protection, and reducing carbon footprint.'
                ])
            ],
            [
                'title' => 'Research & Development',
                'slug' => 'research-development',
                'content' => '<h2>Research & Development</h2><p>Our R&D team continuously works on developing innovative valve solutions to meet evolving industry requirements. We invest significantly in research and development to stay ahead of market trends.</p><p>Recent developments include smart valve technology, improved sealing systems, and enhanced materials for extreme conditions.</p>',
                'template' => 'default',
                'is_active' => true,
                'meta_data' => json_encode([
                    'title' => 'Research & Development - K-Tech Valves',
                    'description' => 'K-Tech Valves R&D team develops innovative valve solutions including smart technology, improved sealing, and extreme condition materials.'
                ])
            ],
            [
                'title' => 'Testing Facilities',
                'slug' => 'testing-facilities',
                'content' => '<h2>Testing Facilities</h2><p>Our comprehensive testing facilities ensure every valve meets or exceeds industry standards. We have invested in state-of-the-art testing equipment for various applications.</p><p>Testing capabilities include pressure testing, temperature cycling, flow testing, and endurance testing.</p>',
                'template' => 'default',
                'is_active' => true,
                'meta_data' => json_encode([
                    'title' => 'Testing Facilities - K-Tech Valves',
                    'description' => 'State-of-the-art testing facilities for pressure, temperature, flow, and endurance testing to ensure valves meet industry standards.'
                ])
            ],
            [
                'title' => 'Career Opportunities',
                'slug' => 'careers',
                'content' => '<h2>Career Opportunities</h2><p>Join our team of dedicated professionals and be part of our growing success. We offer excellent career opportunities in engineering, manufacturing, quality assurance, and sales.</p><p>We provide competitive compensation, comprehensive benefits, and opportunities for professional development.</p>',
                'template' => 'default',
                'is_active' => true,
                'meta_data' => json_encode([
                    'title' => 'Career Opportunities - K-Tech Valves',
                    'description' => 'Join K-Tech Valves team with excellent career opportunities in engineering, manufacturing, quality, and sales with competitive benefits.'
                ])
            ],
            [
                'title' => 'Contact Information',
                'slug' => 'contact',
                'content' => '<h2>Contact Information</h2><p>Get in touch with us for all your valve requirements. Our team is ready to assist you with technical support, quotations, and project consultation.</p><p><strong>Head Office:</strong><br>123 Industrial Avenue<br>Manufacturing District<br>City, State 12345</p><p><strong>Phone:</strong> +1 (555) 123-4567<br><strong>Email:</strong> info@ktechvalves.com</p>',
                'template' => 'default',
                'is_active' => true,
                'meta_data' => json_encode([
                    'title' => 'Contact K-Tech Valves - Valve Manufacturer',
                    'description' => 'Contact K-Tech Valves for valve requirements, technical support, quotations, and project consultation. Phone: +1 (555) 123-4567'
                ])
            ]
        ];

        foreach ($pages as $page) {
            \App\Models\Page::create($page);
        }

        // Create sample banners
        $banners = [
            [
                'title' => 'Premium Industrial Valves',
                'subtitle' => 'Quality You Can Trust - Discover our comprehensive range of industrial valves designed for critical applications.',
                'image' => 'banners/hero-1.jpg',
                'link_url' => '/products',
                'link_text' => 'View Products',
                'position' => 'homepage',
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'title' => 'Custom Valve Solutions',
                'subtitle' => 'Engineered for Excellence - Get custom-designed valves tailored to your specific requirements and applications.',
                'image' => 'banners/hero-2.jpg',
                'link_url' => '/contact',
                'link_text' => 'Contact Us',
                'position' => 'homepage',
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'title' => '25+ Years of Experience',
                'subtitle' => 'Industry Leadership - Trusted by companies worldwide for reliable valve solutions and exceptional service.',
                'image' => 'banners/hero-3.jpg',
                'link_url' => '/about',
                'link_text' => 'About Us',
                'position' => 'homepage',
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'title' => 'ISO Certified Quality',
                'subtitle' => 'Guaranteed Performance - All our valves meet international quality standards with comprehensive testing.',
                'image' => 'banners/secondary-1.jpg',
                'link_url' => '/quality',
                'link_text' => 'Quality Assurance',
                'position' => 'category',
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'title' => 'Global Service Network',
                'subtitle' => 'Worldwide Support - Local support through our international network of distributors and service centers.',
                'image' => 'banners/secondary-2.jpg',
                'link_url' => '/distributors',
                'link_text' => 'Find Distributor',
                'position' => 'category',
                'is_active' => true,
                'sort_order' => 5
            ],
            [
                'title' => 'Technical Innovation',
                'subtitle' => 'Future-Ready Solutions - Advanced valve technology for modern industrial automation and control systems.',
                'image' => 'banners/secondary-3.jpg',
                'link_url' => '/innovation',
                'link_text' => 'Learn More',
                'position' => 'category',
                'is_active' => true,
                'sort_order' => 6
            ],
            [
                'title' => 'Emergency Service',
                'subtitle' => '24/7 Support Available - Round-the-clock technical support for critical valve maintenance and repairs.',
                'image' => 'banners/sidebar-1.jpg',
                'link_url' => '/emergency',
                'link_text' => 'Emergency Contact',
                'position' => 'product',
                'is_active' => true,
                'sort_order' => 7
            ],
            [
                'title' => 'Training Programs',
                'subtitle' => 'Valve Knowledge Center - Comprehensive training programs for valve selection, installation, and maintenance.',
                'image' => 'banners/sidebar-2.jpg',
                'link_url' => '/training',
                'link_text' => 'Training Schedule',
                'position' => 'product',
                'is_active' => true,
                'sort_order' => 8
            ],
            [
                'title' => 'Download Catalogs',
                'subtitle' => 'Technical Resources - Access detailed product catalogs, technical specifications, and installation guides.',
                'image' => 'banners/footer-1.jpg',
                'link_url' => '/downloads',
                'link_text' => 'Download Center',
                'position' => 'homepage',
                'is_active' => true,
                'sort_order' => 9
            ],
            [
                'title' => 'Partnership Program',
                'subtitle' => 'Become a Distributor - Join our global network of distributors and grow your business with K-Tech Valves.',
                'image' => 'banners/footer-2.jpg',
                'link_url' => '/partnership',
                'link_text' => 'Apply Now',
                'position' => 'homepage',
                'is_active' => true,
                'sort_order' => 10
            ]
        ];

        foreach ($banners as $banner) {
            \App\Models\Banner::create($banner);
        }

        // Create sample gallery items
        $galleries = [
            [
                'title' => 'Manufacturing Facility Overview',
                'description' => 'State-of-the-art manufacturing facility with modern equipment and quality control systems.',
                'image' => 'gallery/facility-overview.jpg',
                'category' => 'facility',
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'title' => 'CNC Machining Center',
                'description' => 'Precision CNC machining center for valve body and component manufacturing.',
                'image' => 'gallery/cnc-machining.jpg',
                'category' => 'equipment',
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'title' => 'Quality Testing Laboratory',
                'description' => 'Advanced testing laboratory with pressure testing and material analysis equipment.',
                'image' => 'gallery/testing-lab.jpg',
                'category' => 'testing',
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'title' => 'Assembly Workshop',
                'description' => 'Clean assembly environment where valves are carefully assembled and tested.',
                'image' => 'gallery/assembly-workshop.jpg',
                'category' => 'production',
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'title' => 'Warehouse & Logistics',
                'description' => 'Modern warehouse facility with efficient logistics and shipping capabilities.',
                'image' => 'gallery/warehouse.jpg',
                'category' => 'facility',
                'is_active' => true,
                'sort_order' => 5
            ],
            [
                'title' => 'Research & Development Lab',
                'description' => 'R&D laboratory where new valve designs and materials are tested and developed.',
                'image' => 'gallery/rd-lab.jpg',
                'category' => 'innovation',
                'is_active' => true,
                'sort_order' => 6
            ],
            [
                'title' => 'Raw Material Inspection',
                'description' => 'Incoming material inspection area ensuring only quality materials are used.',
                'image' => 'gallery/material-inspection.jpg',
                'category' => 'quality',
                'is_active' => true,
                'sort_order' => 7
            ],
            [
                'title' => 'Finished Product Storage',
                'description' => 'Climate-controlled storage area for finished valves awaiting shipment.',
                'image' => 'gallery/product-storage.jpg',
                'category' => 'storage',
                'is_active' => true,
                'sort_order' => 8
            ],
            [
                'title' => 'Training Center',
                'description' => 'Modern training facility for customer education and employee development.',
                'image' => 'gallery/training-center.jpg',
                'category' => 'training',
                'is_active' => true,
                'sort_order' => 9
            ],
            [
                'title' => 'Office Complex',
                'description' => 'Modern office complex housing engineering, sales, and administrative teams.',
                'image' => 'gallery/office-complex.jpg',
                'category' => 'office',
                'is_active' => true,
                'sort_order' => 10
            ]
        ];

        foreach ($galleries as $gallery) {
            \App\Models\Gallery::create($gallery);
        }

        // Create sample industries
        $industries = [
            [
                'name' => 'Oil & Gas',
                'slug' => 'oil-gas',
                'description' => 'Comprehensive valve solutions for upstream, midstream, and downstream oil & gas operations including wellhead, pipeline, and refinery applications.',
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'Water Treatment',
                'slug' => 'water-treatment',
                'description' => 'Reliable valve solutions for municipal water treatment, wastewater management, and industrial water processing applications.',
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'name' => 'Power Generation',
                'slug' => 'power-generation',
                'description' => 'High-performance valves for thermal, nuclear, hydro, and renewable energy power generation facilities.',
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'name' => 'Chemical Processing',
                'slug' => 'chemical-processing',
                'description' => 'Corrosion-resistant valves designed for aggressive chemical environments and critical process control applications.',
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'name' => 'Marine & Offshore',
                'slug' => 'marine-offshore',
                'description' => 'Robust valve solutions for marine applications, offshore platforms, and shipbuilding with seawater resistance.',
                'is_active' => true,
                'sort_order' => 5
            ],
            [
                'name' => 'Pharmaceutical',
                'slug' => 'pharmaceutical',
                'description' => 'Sanitary valve solutions meeting FDA and GMP requirements for pharmaceutical and biotechnology applications.',
                'is_active' => true,
                'sort_order' => 6
            ],
            [
                'name' => 'Food & Beverage',
                'slug' => 'food-beverage',
                'description' => 'Hygienic valve solutions for food processing, beverage production, and dairy applications with FDA compliance.',
                'is_active' => true,
                'sort_order' => 7
            ],
            [
                'name' => 'Mining & Minerals',
                'slug' => 'mining-minerals',
                'description' => 'Heavy-duty valves for mining operations, mineral processing, and slurry handling applications.',
                'is_active' => true,
                'sort_order' => 8
            ],
            [
                'name' => 'HVAC Systems',
                'slug' => 'hvac-systems',
                'description' => 'Efficient valve solutions for heating, ventilation, and air conditioning systems in commercial and industrial buildings.',
                'is_active' => true,
                'sort_order' => 9
            ],
            [
                'name' => 'Aerospace',
                'slug' => 'aerospace',
                'description' => 'Precision valve solutions for aerospace applications including aircraft systems and ground support equipment.',
                'is_active' => true,
                'sort_order' => 10
            ]
        ];

        foreach ($industries as $industry) {
            \App\Models\Industry::create($industry);
        }

        // Create sample certifications
        $certifications = [
            [
                'name' => 'ISO 9001:2015',
                'issuing_authority' => 'Bureau Veritas',
                'certificate_number' => 'ISO-9001-2024-001',
                'issue_date' => '2024-01-15',
                'expiry_date' => '2027-01-14',
                'description' => 'Quality Management System certification ensuring consistent quality in valve manufacturing processes.',
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'API 6D',
                'issuing_authority' => 'American Petroleum Institute',
                'certificate_number' => 'API-6D-2024-KTV',
                'issue_date' => '2024-02-20',
                'expiry_date' => '2026-02-19',
                'description' => 'Specification for pipeline valves used in petroleum and natural gas industries.',
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'name' => 'ASME Section VIII',
                'issuing_authority' => 'ASME',
                'certificate_number' => 'ASME-VIII-2024-567',
                'issue_date' => '2024-03-10',
                'expiry_date' => '2026-03-09',
                'description' => 'Pressure vessel design and manufacturing certification for high-pressure valve applications.',
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'name' => 'CE Marking',
                'issuing_authority' => 'TUV Rheinland',
                'certificate_number' => 'CE-PED-2024-789',
                'issue_date' => '2024-04-05',
                'expiry_date' => '2026-04-04',
                'description' => 'European Conformity marking for Pressure Equipment Directive compliance.',
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'name' => 'SIL 3 Certification',
                'issuing_authority' => 'TUV SUD',
                'certificate_number' => 'SIL3-2024-KTV-001',
                'issue_date' => '2024-05-12',
                'expiry_date' => '2027-05-11',
                'description' => 'Safety Integrity Level 3 certification for safety-critical valve applications.',
                'is_active' => true,
                'sort_order' => 5
            ],
            [
                'name' => 'ATEX Certification',
                'issuing_authority' => 'DEKRA',
                'certificate_number' => 'ATEX-EX-2024-KTV',
                'issue_date' => '2024-06-18',
                'expiry_date' => '2026-06-17',
                'description' => 'Explosive atmospheres certification for valves used in hazardous environments.',
                'is_active' => true,
                'sort_order' => 6
            ],
            [
                'name' => 'Fire Safe API 607',
                'issuing_authority' => 'Underwriters Laboratories',
                'certificate_number' => 'FS-API607-2024-345',
                'issue_date' => '2024-07-22',
                'expiry_date' => '2026-07-21',
                'description' => 'Fire safe testing certification for quarter-turn valves in fire situations.',
                'is_active' => true,
                'sort_order' => 7
            ],
            [
                'name' => 'NACE MR0175',
                'issuing_authority' => 'NACE International',
                'certificate_number' => 'NACE-MR0175-2024-KTV',
                'issue_date' => '2024-08-14',
                'expiry_date' => '2026-08-13',
                'description' => 'Materials certification for sour service applications in oil and gas industry.',
                'is_active' => true,
                'sort_order' => 8
            ],
            [
                'name' => '3A Sanitary Standards',
                'issuing_authority' => '3-A Sanitary Standards Inc.',
                'certificate_number' => '3A-SSI-2024-KTV-789',
                'issue_date' => '2024-09-08',
                'expiry_date' => '2026-09-07',
                'description' => 'Sanitary equipment certification for food, beverage, and pharmaceutical applications.',
                'is_active' => true,
                'sort_order' => 9
            ],
            [
                'name' => 'PED 2014/68/EU',
                'issuing_authority' => 'Lloyd\'s Register',
                'certificate_number' => 'PED-2024-LR-KTV-012',
                'issue_date' => '2024-10-25',
                'expiry_date' => '2026-10-24',
                'description' => 'Pressure Equipment Directive compliance for European market valve sales.',
                'is_active' => true,
                'sort_order' => 10
            ]
        ];

        foreach ($certifications as $certification) {
            \App\Models\Certification::create($certification);
        }

        // Create sample clients
        $clients = [
            [
                'name' => 'ExxonMobil',
                'description' => 'Global energy corporation - supplied high-pressure valves for offshore drilling platforms',
                'logo' => 'clients/exxonmobil.png',
                'website' => 'https://corporate.exxonmobil.com',
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'Chevron Corporation',
                'description' => 'Multinational energy corporation - provided refinery valves for multiple facilities',
                'logo' => 'clients/chevron.png',
                'website' => 'https://www.chevron.com',
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'name' => 'General Electric',
                'description' => 'Power generation equipment manufacturer - supplied steam valves for power plants',
                'logo' => 'clients/ge.png',
                'website' => 'https://www.ge.com',
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'name' => 'Dow Chemical',
                'description' => 'Chemical manufacturing company - provided corrosion-resistant valves for chemical processes',
                'logo' => 'clients/dow.png',
                'website' => 'https://www.dow.com',
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'name' => 'Veolia Water Technologies',
                'description' => 'Water treatment solutions provider - supplied valves for municipal water treatment plants',
                'logo' => 'clients/veolia.png',
                'website' => 'https://www.veolia.com',
                'is_active' => true,
                'sort_order' => 5
            ],
            [
                'name' => 'Maersk Line',
                'description' => 'Global shipping company - provided marine-grade valves for container ships',
                'logo' => 'clients/maersk.png',
                'website' => 'https://www.maersk.com',
                'is_active' => true,
                'sort_order' => 6
            ],
            [
                'name' => 'Pfizer Inc.',
                'description' => 'Pharmaceutical corporation - supplied sanitary valves for manufacturing facilities',
                'logo' => 'clients/pfizer.png',
                'website' => 'https://www.pfizer.com',
                'is_active' => true,
                'sort_order' => 7
            ],
            [
                'name' => 'Nestle S.A.',
                'description' => 'Food and beverage company - provided hygienic valves for food processing plants',
                'logo' => 'clients/nestle.png',
                'website' => 'https://www.nestle.com',
                'is_active' => true,
                'sort_order' => 8
            ],
            [
                'name' => 'BHP Billiton',
                'description' => 'Mining company - supplied heavy-duty valves for mineral processing operations',
                'logo' => 'clients/bhp.png',
                'website' => 'https://www.bhp.com',
                'is_active' => true,
                'sort_order' => 9
            ],
            [
                'name' => 'Boeing Company',
                'description' => 'Aerospace manufacturer - provided precision valves for aircraft systems',
                'logo' => 'clients/boeing.png',
                'website' => 'https://www.boeing.com',
                'is_active' => true,
                'sort_order' => 10
            ]
        ];

        foreach ($clients as $client) {
            \App\Models\Client::create($client);
        }

        // Create sample inquiries
        $inquiries = [
            [
                'name' => 'John Smith',
                'email' => 'j.smith@petrotech.com',
                'phone' => '+1-555-0101',
                'company' => 'PetroTech Industries',
                'subject' => 'High Pressure Ball Valves for Offshore Platform',
                'message' => 'We need 50 pieces of 2" Class 800 ball valves for our new offshore platform. Please provide quotation with delivery schedule.',
                'status' => 'new'
            ],
            [
                'name' => 'Maria Garcia',
                'email' => 'm.garcia@waterworks.gov',
                'phone' => '+1-555-0102',
                'company' => 'City Water Works',
                'subject' => 'Gate Valves for Water Treatment Plant',
                'message' => 'Our municipal water treatment plant requires replacement gate valves. Sizes range from 6" to 24". Need AWWA compliance.',
                'status' => 'in_progress'
            ],
            [
                'name' => 'David Chen',
                'email' => 'd.chen@chemcorp.com',
                'phone' => '+1-555-0103',
                'company' => 'ChemCorp Manufacturing',
                'subject' => 'Corrosion Resistant Valves for Chemical Plant',
                'message' => 'Looking for Hastelloy C-276 butterfly valves for aggressive chemical service. Need technical consultation.',
                'status' => 'new'
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 's.johnson@powergen.com',
                'phone' => '+1-555-0104',
                'company' => 'PowerGen Solutions',
                'subject' => 'Steam Valves for Power Plant Upgrade',
                'message' => 'We are upgrading our power plant and need high-temperature steam valves. Please send technical specifications.',
                'status' => 'resolved'
            ],
            [
                'name' => 'Ahmed Al-Rashid',
                'email' => 'a.alrashid@arabiangas.ae',
                'phone' => '+971-555-0105',
                'company' => 'Arabian Gas Company',
                'subject' => 'Emergency Valve Replacement',
                'message' => 'We have an emergency situation and need immediate replacement of a 12" gate valve. Can you provide emergency service?',
                'status' => 'closed'
            ],
            [
                'name' => 'Lisa Anderson',
                'email' => 'l.anderson@foodtech.com',
                'phone' => '+1-555-0106',
                'company' => 'FoodTech Processing',
                'subject' => 'Sanitary Valves for Food Production',
                'message' => 'Need FDA-compliant sanitary valves for our new food processing line. Require 3A certification.',
                'status' => 'new'
            ],
            [
                'name' => 'Roberto Silva',
                'email' => 'r.silva@marinaserv.br',
                'phone' => '+55-11-555-0107',
                'company' => 'Marina Services Brazil',
                'subject' => 'Marine Valves for Ship Repair',
                'message' => 'We operate a ship repair facility and need bronze seacock valves. Please provide pricing for various sizes.',
                'status' => 'in_progress'
            ],
            [
                'name' => 'Emma Thompson',
                'email' => 'e.thompson@pharmatech.co.uk',
                'phone' => '+44-20-555-0108',
                'company' => 'PharmaTech UK',
                'subject' => 'Validation Documentation Required',
                'message' => 'We need complete validation documentation for your sanitary valves including material certificates and test reports.',
                'status' => 'resolved'
            ],
            [
                'name' => 'Hans Mueller',
                'email' => 'h.mueller@deutscheeng.de',
                'phone' => '+49-30-555-0109',
                'company' => 'Deutsche Engineering GmbH',
                'subject' => 'Custom Valve Design Project',
                'message' => 'We have a special application requiring custom valve design. Can we schedule a technical meeting to discuss requirements?',
                'status' => 'new'
            ],
            [
                'name' => 'Yuki Tanaka',
                'email' => 'y.tanaka@japansteel.jp',
                'phone' => '+81-3-555-0110',
                'company' => 'Japan Steel Works',
                'subject' => 'Training Program for Maintenance Team',
                'message' => 'Our maintenance team needs training on valve installation and maintenance. Do you offer training programs?',
                'status' => 'in_progress'
            ]
        ];

        foreach ($inquiries as $inquiry) {
            \App\Models\Inquiry::create($inquiry);
        }

        // Seed site settings
        $this->call(SiteSettingsSeeder::class);
    }
}
