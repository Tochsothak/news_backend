<?php
namespace App\View\Components;

use Illuminate\View\Component;

class IconPicker extends Component
{
    public array $icons;
    public array $categories;
    public string $selectedIcon;
    public string $name;

    public function __construct(string $selectedIcon = 'folder', string $name = 'icon')
    {
        $this->selectedIcon = $selectedIcon;
        $this->name = $name;
        $this->categories = $this->getIconCategories();
        $this->icons = $this->getAllIcons();
    }

    protected function getIconCategories(): array
    {
        return [
            'all' => 'All',
            'news' => 'News',
            'tech' => 'Tech',
            'business' => 'Business',
            'health' => 'Health',
            'sports' => 'Sports',
            'entertainment' => 'Entertainment',
            'lifestyle' => 'Lifestyle',
            'science' => 'Science',
            'travel' => 'Travel',
            'general' => 'General',
        ];
    }

    protected function getAllIcons(): array
    {
        return [
            // News & Media
            ['name' => 'newspaper', 'label' => 'Newspaper', 'category' => 'news'],
            ['name' => 'article', 'label' => 'Article', 'category' => 'news'],
            ['name' => 'broadcast', 'label' => 'Broadcast', 'category' => 'news'],
            ['name' => 'television', 'label' => 'Television', 'category' => 'news'],
            ['name' => 'radio', 'label' => 'Radio', 'category' => 'news'],
            ['name' => 'microphone', 'label' => 'Microphone', 'category' => 'news'],
            ['name' => 'video-camera', 'label' => 'Video Camera', 'category' => 'news'],
            ['name' => 'camera', 'label' => 'Camera', 'category' => 'news'],
            ['name' => 'film-slate', 'label' => 'Film Slate', 'category' => 'news'],
            ['name' => 'music-notes', 'label' => 'Music Notes', 'category' => 'news'],

            // Technology
            ['name' => 'cpu', 'label' => 'CPU', 'category' => 'tech'],
            ['name' => 'desktop', 'label' => 'Desktop', 'category' => 'tech'],
            ['name' => 'device-mobile', 'label' => 'Mobile', 'category' => 'tech'],
            ['name' => 'robot', 'label' => 'Robot', 'category' => 'tech'],
            ['name' => 'rocket', 'label' => 'Rocket', 'category' => 'tech'],
            ['name' => 'lightning', 'label' => 'Lightning', 'category' => 'tech'],
            ['name' => 'cloud', 'label' => 'Cloud', 'category' => 'tech'],
            ['name' => 'code', 'label' => 'Code', 'category' => 'tech'],
            ['name' => 'terminal', 'label' => 'Terminal', 'category' => 'tech'],
            ['name' => 'database', 'label' => 'Database', 'category' => 'tech'],
            ['name' => 'hard-drives', 'label' => 'Hard Drives', 'category' => 'tech'],
            ['name' => 'wifi-high', 'label' => 'WiFi', 'category' => 'tech'],
            ['name' => 'bluetooth', 'label' => 'Bluetooth', 'category' => 'tech'],
            ['name' => 'printer', 'label' => 'Printer', 'category' => 'tech'],
            ['name' => 'keyboard', 'label' => 'Keyboard', 'category' => 'tech'],
            ['name' => 'monitor', 'label' => 'Monitor', 'category' => 'tech'],
            ['name' => 'laptop', 'label' => 'Laptop', 'category' => 'tech'],
            ['name' => 'devices', 'label' => 'Devices', 'category' => 'tech'],

            // Business
            ['name' => 'chart-line-up', 'label' => 'Chart Line Up', 'category' => 'business'],
            ['name' => 'bank', 'label' => 'Bank', 'category' => 'business'],
            ['name' => 'currency-dollar', 'label' => 'Dollar', 'category' => 'business'],
            ['name' => 'chart-pie', 'label' => 'Chart Pie', 'category' => 'business'],
            ['name' => 'briefcase', 'label' => 'Briefcase', 'category' => 'business'],
            ['name' => 'buildings', 'label' => 'Buildings', 'category' => 'business'],
            ['name' => 'handshake', 'label' => 'Handshake', 'category' => 'business'],
            ['name' => 'shopping-cart', 'label' => 'Shopping Cart', 'category' => 'business'],
            ['name' => 'storefront', 'label' => 'Storefront', 'category' => 'business'],
            ['name' => 'wallet', 'label' => 'Wallet', 'category' => 'business'],
            ['name' => 'credit-card', 'label' => 'Credit Card', 'category' => 'business'],
            ['name' => 'receipt', 'label' => 'Receipt', 'category' => 'business'],
            ['name' => 'coins', 'label' => 'Coins', 'category' => 'business'],
            ['name' => 'piggy-bank', 'label' => 'Piggy Bank', 'category' => 'business'],
            ['name' => 'trend-up', 'label' => 'Trend Up', 'category' => 'business'],
            ['name' => 'presentation-chart', 'label' => 'Presentation', 'category' => 'business'],
            ['name' => 'calculator', 'label' => 'Calculator', 'category' => 'business'],
            ['name' => 'scales', 'label' => 'Scales', 'category' => 'business'],

            // Health
            ['name' => 'pulse', 'label' => 'Heart Pulse', 'category' => 'health'],
            ['name' => 'first-aid-kit', 'label' => 'First Aid', 'category' => 'health'],
            ['name' => 'pill', 'label' => 'Pill', 'category' => 'health'],
            ['name' => 'brain', 'label' => 'Brain', 'category' => 'health'],
            ['name' => 'leaf', 'label' => 'Leaf', 'category' => 'health'],
            ['name' => 'eye', 'label' => 'Eye', 'category' => 'health'],
            ['name' => 'tooth', 'label' => 'Tooth', 'category' => 'health'],
            ['name' => 'stethoscope', 'label' => 'Stethoscope', 'category' => 'health'],
            ['name' => 'syringe', 'label' => 'Syringe', 'category' => 'health'],
            ['name' => 'thermometer', 'label' => 'Thermometer', 'category' => 'health'],
            ['name' => 'hospital', 'label' => 'Hospital', 'category' => 'health'],

            // Sports
            ['name' => 'soccer-ball', 'label' => 'Soccer Ball', 'category' => 'sports'],
            ['name' => 'basketball', 'label' => 'Basketball', 'category' => 'sports'],
            ['name' => 'football', 'label' => 'Football', 'category' => 'sports'],
            ['name' => 'tennis-ball', 'label' => 'Tennis Ball', 'category' => 'sports'],
            ['name' => 'barbell', 'label' => 'Barbell', 'category' => 'sports'],
            ['name' => 'bicycle', 'label' => 'Bicycle', 'category' => 'sports'],
            ['name' => 'person-simple-run', 'label' => 'Running', 'category' => 'sports'],
            ['name' => 'trophy', 'label' => 'Trophy', 'category' => 'sports'],
            ['name' => 'medal', 'label' => 'Medal', 'category' => 'sports'],
            ['name' => 'golf', 'label' => 'Golf', 'category' => 'sports'],
            ['name' => 'swimming-pool', 'label' => 'Swimming', 'category' => 'sports'],
            ['name' => 'target', 'label' => 'Target', 'category' => 'sports'],

            // Entertainment
            ['name' => 'film-strip', 'label' => 'Film Strip', 'category' => 'entertainment'],
            ['name' => 'ticket', 'label' => 'Ticket', 'category' => 'entertainment'],
            ['name' => 'mask-happy', 'label' => 'Theater Mask', 'category' => 'entertainment'],
            ['name' => 'guitar', 'label' => 'Guitar', 'category' => 'entertainment'],
            ['name' => 'headphones', 'label' => 'Headphones', 'category' => 'entertainment'],
            ['name' => 'game-controller', 'label' => 'Game Controller', 'category' => 'entertainment'],
            ['name' => 'star', 'label' => 'Star', 'category' => 'entertainment'],
            ['name' => 'heart', 'label' => 'Heart', 'category' => 'entertainment'],
            ['name' => 'smiley', 'label' => 'Smiley', 'category' => 'entertainment'],
            ['name' => 'puzzle-piece', 'label' => 'Puzzle', 'category' => 'entertainment'],

            // Lifestyle
            ['name' => 'house', 'label' => 'House', 'category' => 'lifestyle'],
            ['name' => 'fork-knife', 'label' => 'Food', 'category' => 'lifestyle'],
            ['name' => 'cooking-pot', 'label' => 'Cooking', 'category' => 'lifestyle'],
            ['name' => 'coffee', 'label' => 'Coffee', 'category' => 'lifestyle'],
            ['name' => 'bed', 'label' => 'Bed', 'category' => 'lifestyle'],
            ['name' => 'sun', 'label' => 'Sun', 'category' => 'lifestyle'],
            ['name' => 'moon', 'label' => 'Moon', 'category' => 'lifestyle'],
            ['name' => 'plant', 'label' => 'Plant', 'category' => 'lifestyle'],
            ['name' => 'paw-print', 'label' => 'Paw Print', 'category' => 'lifestyle'],
            ['name' => 't-shirt', 'label' => 'T-Shirt', 'category' => 'lifestyle'],
            ['name' => 'gift', 'label' => 'Gift', 'category' => 'lifestyle'],

            // Science
            ['name' => 'atom', 'label' => 'Atom', 'category' => 'science'],
            ['name' => 'flask', 'label' => 'Flask', 'category' => 'science'],
            ['name' => 'dna', 'label' => 'DNA', 'category' => 'science'],
            ['name' => 'graduation-cap', 'label' => 'Graduation', 'category' => 'science'],
            ['name' => 'book-open', 'label' => 'Book Open', 'category' => 'science'],
            ['name' => 'lightbulb', 'label' => 'Lightbulb', 'category' => 'science'],
            ['name' => 'magnifying-glass', 'label' => 'Magnifying Glass', 'category' => 'science'],
            ['name' => 'microscope', 'label' => 'Microscope', 'category' => 'science'],
            ['name' => 'planet', 'label' => 'Planet', 'category' => 'science'],
            ['name' => 'globe-hemisphere-west', 'label' => 'Globe West', 'category' => 'science'],

            // Travel
            ['name' => 'globe', 'label' => 'Globe', 'category' => 'travel'],
            ['name' => 'airplane', 'label' => 'Airplane', 'category' => 'travel'],
            ['name' => 'car', 'label' => 'Car', 'category' => 'travel'],
            ['name' => 'train', 'label' => 'Train', 'category' => 'travel'],
            ['name' => 'boat', 'label' => 'Boat', 'category' => 'travel'],
            ['name' => 'map-pin', 'label' => 'Map Pin', 'category' => 'travel'],
            ['name' => 'mountains', 'label' => 'Mountains', 'category' => 'travel'],
            ['name' => 'tent', 'label' => 'Tent', 'category' => 'travel'],
            ['name' => 'suitcase', 'label' => 'Suitcase', 'category' => 'travel'],
            ['name' => 'compass', 'label' => 'Compass', 'category' => 'travel'],

            // General
            ['name' => 'chat-circle', 'label' => 'Chat', 'category' => 'general'],
            ['name' => 'envelope', 'label' => 'Envelope', 'category' => 'general'],
            ['name' => 'phone', 'label' => 'Phone', 'category' => 'general'],
            ['name' => 'bell', 'label' => 'Bell', 'category' => 'general'],
            ['name' => 'users', 'label' => 'Users', 'category' => 'general'],
            ['name' => 'lock', 'label' => 'Lock', 'category' => 'general'],
            ['name' => 'shield-check', 'label' => 'Shield', 'category' => 'general'],
            ['name' => 'gear', 'label' => 'Gear', 'category' => 'general'],
            ['name' => 'folder', 'label' => 'Folder', 'category' => 'general'],
            ['name' => 'calendar', 'label' => 'Calendar', 'category' => 'general'],
            ['name' => 'clock', 'label' => 'Clock', 'category' => 'general'],
            ['name' => 'flag', 'label' => 'Flag', 'category' => 'general'],
            ['name' => 'bookmark', 'label' => 'Bookmark', 'category' => 'general'],
            ['name' => 'tag', 'label' => 'Tag', 'category' => 'general'],
            ['name' => 'hash', 'label' => 'Hash', 'category' => 'general'],
        ];
    }

    public function render()
    {
        return view('components.icon-picker');
    }
}
