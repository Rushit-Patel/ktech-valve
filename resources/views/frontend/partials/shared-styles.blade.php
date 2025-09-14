<style>
    /* CSS Variables for consistent theming */
    :root {
        --primary-blue: #0f4c75;
        --secondary-blue: #3282b8;
        --accent-blue: #bbe1fa;
        --primary-orange: #ff6b35;
        --secondary-orange: #f7931e;
        --gradient-primary: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 50%, var(--accent-blue) 100%);
        --gradient-orange: linear-gradient(135deg, var(--primary-orange) 0%, var(--secondary-orange) 100%);
        --shadow-soft: 0 10px 40px rgba(0, 0, 0, 0.1);
        --shadow-medium: 0 20px 60px rgba(0, 0, 0, 0.15);
        --shadow-strong: 0 30px 80px rgba(0, 0, 0, 0.2);
        --transition-smooth: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        --transition-bounce: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    /* Hero Section Styles */
    .hero-gradient {
        background: var(--gradient-primary);
        position: relative;
        overflow: hidden;
    }

    .hero-gradient::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(15, 76, 117, 0.9) 0%, rgba(50, 130, 184, 0.8) 50%, rgba(187, 225, 250, 0.7) 100%);
        z-index: 1;
    }

    .hero-gradient::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='1'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        animation: patternFloat 20s linear infinite;
        z-index: 2;
    }

    .hero-content {
        position: relative;
        z-index: 3;
    }

    @keyframes patternFloat {
        0% { transform: translate(0, 0); }
        100% { transform: translate(-60px, -60px); }
    }

    /* Card Hover Effects */
    .card-hover {
        transition: var(--transition-smooth);
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--shadow-soft);
    }

    .card-hover:hover {
        transform: translateY(-12px) scale(1.02);
        box-shadow: var(--shadow-medium);
    }

    /* Section Dividers */
    .section-divider {
        background: linear-gradient(90deg, transparent, var(--secondary-blue), transparent);
        height: 2px;
        margin: 2rem 0;
    }

    /* Button Styles */
    .btn-primary {
        background: var(--gradient-orange);
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        transition: var(--transition-smooth);
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-medium);
        color: white;
        text-decoration: none;
    }

    .btn-secondary {
        background: white;
        color: var(--primary-blue);
        border: 2px solid var(--primary-blue);
        padding: 10px 22px;
        border-radius: 8px;
        font-weight: 600;
        transition: var(--transition-smooth);
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-secondary:hover {
        background: var(--primary-blue);
        color: white;
        transform: translateY(-2px);
        box-shadow: var(--shadow-medium);
        text-decoration: none;
    }

    /* Content Animation */
    .content-animate {
        opacity: 0;
        transform: translateY(60px);
        transition: all 1s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .content-animate.active {
        opacity: 1;
        transform: translateY(0);
    }

    .content-animate.delay-100 {
        transition-delay: 0.1s;
    }

    .content-animate.delay-200 {
        transition-delay: 0.2s;
    }

    .content-animate.delay-300 {
        transition-delay: 0.3s;
    }

    .content-animate.delay-400 {
        transition-delay: 0.4s;
    }

    /* Stats and Numbers */
    .stats-gradient {
        background: var(--gradient-orange);
    }

    /* Filter Buttons */
    .filter-btn {
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        transition: var(--transition-smooth);
        border: 2px solid transparent;
        cursor: pointer;
        background: white;
        color: var(--primary-blue);
        margin: 4px;
    }

    .filter-btn:hover {
        background: var(--accent-blue);
        transform: translateY(-2px);
    }

    .filter-btn.active {
        background: var(--primary-blue);
        color: white;
        border-color: var(--primary-blue);
    }

    /* Image Overlays */
    .image-overlay {
        position: relative;
        overflow: hidden;
    }

    .image-overlay::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        opacity: 0;
        transition: var(--transition-smooth);
        z-index: 1;
    }

    .image-overlay:hover::before {
        opacity: 0.8;
    }

    .image-overlay img {
        transition: var(--transition-smooth);
    }

    .image-overlay:hover img {
        transform: scale(1.1);
    }

    /* Typography Enhancements */
    .heading-gradient {
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Grid Layouts */
    .grid-enhanced {
        display: grid;
        gap: 2rem;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    }

    @media (min-width: 768px) {
        .grid-enhanced {
            gap: 3rem;
        }
    }

    /* Page Headers */
    .page-header {
        background: var(--gradient-primary);
        color: white;
        padding: 5rem 0;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='1'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        animation: patternFloat 20s linear infinite;
        z-index: 1;
    }

    .page-header-content {
        position: relative;
        z-index: 2;
    }

    /* Loading States */
    .loading-shimmer {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% {
            background-position: -200% 0;
        }
        100% {
            background-position: 200% 0;
        }
    }

    /* Responsive Utilities */
    @media (max-width: 768px) {
        .hero-gradient {
            padding: 3rem 0;
        }
        
        .card-hover:hover {
            transform: translateY(-8px) scale(1.01);
        }
        
        .btn-primary, .btn-secondary {
            padding: 10px 20px;
            font-size: 14px;
        }
    }
</style>
