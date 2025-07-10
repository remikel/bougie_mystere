# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a PHP-based interactive escape game called "Bougie Mystère" (Mystery Candle) that generates personalized postcards for users. The project combines puzzle-solving mechanics with automated image generation and email delivery.

### Core Architecture

- **Frontend**: Multi-step questionnaire form using HTML/CSS/JavaScript with jQuery animations
- **Backend**: PHP with GD library for dynamic image generation
- **Email**: Mailjet API integration for sending generated images
- **Dependencies**: Composer manages PHP packages (GD-Text for typography, Mailjet API client)

### Main Application Flow

1. **index.php**: Entry point with escape game puzzle interface and solution verification (code: "2547")
2. **questionnaire.php**: Multi-step form collecting user preferences (personality quiz style)
3. **generate.php**: Image generation engine that composites multiple PNG layers based on user choices
4. **fin.php**: Success page displaying the generated personalized image

## Key Components

### Image Generation System (`generate.php`)
- Creates 2315x3307px postcards by layering themed PNG assets
- Color schemes: BLEU, VERT, ROSE, JAUNE, VIOLET (each with unique color palettes)
- Asset categories: animals, drinks, desserts, numbers, plants, sports, transportation
- Text rendering with custom fonts (AmaticSC-Bold.ttf, Quicksand-Bold.ttf)
- Dynamic text sizing based on content length
- Email delivery via Mailjet API

### Asset Structure
```
images/
├── [COLOR]/               # Color-themed asset folders
│   ├── animaux/           # Animal icons
│   ├── boissons/          # Beverage icons  
│   ├── desserts/          # Dessert icons
│   ├── chiffres/          # Number icons (0-9)
│   ├── plantes[1-3]/      # Plant icons (multiple sets)
│   ├── sports[1-2]/       # Sports icons (multiple sets)
│   └── transports/        # Transportation icons
├── background/            # Background images
└── generated/             # Output folder for created images
```

### Configuration Files
- **composer.json**: Defines dependencies (stil/gd-text, mailjet/mailjet-apiv3-php)
- **style.css**: Frontend styling with responsive design
- **fonts/**: Custom typography assets

## Development Commands

Since this is a PHP project without build tools:

### Local Development
```bash
# Install dependencies
composer install

# Start local PHP server
php -S localhost:8000

# View application
open http://localhost:8000
```

### File Permissions
Ensure the `images/generated/` directory is writable by the web server:
```bash
chmod 755 images/generated/
```

## Environment Requirements

- PHP 7.0+ with GD extension enabled
- Composer for dependency management
- Web server (Apache/Nginx) or PHP built-in server
- Mailjet API credentials (configured in generate.php lines 200-201)

## Security Considerations

- Email credentials are hardcoded in generate.php (should be moved to environment variables)
- User input is directly used in file paths and database operations
- Generated images are stored in publicly accessible directory
- No input sanitization on form submissions

## Code Patterns

- PHP includes for modular templates (header.php, footer.php)
- jQuery for form interactions and animations
- Direct PHP superglobal usage ($_POST, $_GET)
- Inline CSS and JavaScript mixed with PHP
- File-based session management (no database)