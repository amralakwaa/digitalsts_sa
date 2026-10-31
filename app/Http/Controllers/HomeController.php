<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Project;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use App\Models\Article;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        $featuredProjects = Project::with('images')
            ->where('is_published', true)
            ->orderBy('sort_order', 'asc')
            ->take(6)
            ->get();

        $sectors = [
            [
                'id' => 'commercial',
                'title_ar' => 'الأبراج والشركات التجارية',
                'title_en' => 'Commercial & Corporate Towers',
                'icon' => 'building-2',
                'desc_ar' => 'بوابات ذكية، كاميرات مراقبة متطورة، وتحكم دقيق في الدخول لإدارة حركة الموظفين والزوار بكل سلاسة.',
                'desc_en' => 'Optical speed gates, AI CCTV surveillance, and destination elevator integration for corporate facilities.',
                'tag_ar' => 'أبراج ومكاتب',
                'tag_en' => 'Towers & Offices',
            ],
            [
                'id' => 'hospitality',
                'title_ar' => 'الفنادق والمنتجعات السياحية',
                'title_en' => 'Hotels & Luxury Resorts',
                'icon' => 'hotel',
                'desc_ar' => 'أنظمة GRMS ذكية لإدارة غرف النزلاء، وتوفير طاقة التكييف، وأقفال إلكترونية RFID فندقية.',
                'desc_en' => 'Intelligent GRMS guestroom automation, energy setback control, and RFID/BLE mobile key locks.',
                'tag_ar' => 'فنادق وضيافة',
                'tag_en' => 'Hospitality',
            ],
            [
                'id' => 'residential',
                'title_ar' => 'القصور والفلل السكنية الفاخرة',
                'title_en' => 'Villas & Private Palaces',
                'icon' => 'home',
                'desc_ar' => 'أتمتة ذكية للإضاءة والتكييف والستائر عبر الصوت والهاتف، مع حماية الأسوار والمحيط ضد التسلل.',
                'desc_en' => 'Full KNX home automation for lighting, HVAC, and drapes coupled with active perimeter security.',
                'tag_ar' => 'فلل ومنازل ذكية',
                'tag_en' => 'Smart Residences',
            ],
            [
                'id' => 'industrial',
                'title_ar' => 'المصانع والمستودعات واللوجستيات',
                'title_en' => 'Warehouses & Industrial Plants',
                'icon' => 'factory',
                'desc_ar' => 'كواشف حرارية وشعاعية للحرائق معتمدة من الدفاع المدني، وتأمين بوابات الشاحنات ونقاط التفتيش.',
                'desc_en' => 'Civil Defense optical beam fire detection, ANPR truck barriers, and ruggedized industrial Wi-Fi.',
                'tag_ar' => 'صناعي ولوجستي',
                'tag_en' => 'Industrial & Logistics',
            ],
        ];

        // Featured service offers/packages
        $featuredOffers = \App\Models\ServiceOffer::with('service')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('sort_order', 'asc')
            ->take(3)
            ->get();

        // 10 Client Testimonials
        $testimonials = Testimonial::active()
            ->orderBy('sort_order', 'asc')
            ->get();

        // Latest Articles & Insights
        $latestArticles = Article::published()
            ->recent()
            ->take(3)
            ->get();

        return view('pages.home', compact('services', 'featuredProjects', 'sectors', 'featuredOffers', 'testimonials', 'latestArticles'));
    }
}
