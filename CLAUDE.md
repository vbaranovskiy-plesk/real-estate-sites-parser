# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

### Development Setup
```bash
composer install
php -S 0.0.0.0:80 index.php
```

### Docker (Selenium Grid)
```bash
docker-compose up -d
```
This starts Selenium Hub on port 4444 with Chrome nodes for browser automation.

### Usage
Open http://localhost to run the parser.
or run ```bash
php index.php
```

## Architecture

### Core Components

**Report System** (`src/Report.php`):
- Main orchestrator that processes all site parsers
- Generates Excel reports for each site in `report/` directory
- Handles exceptions gracefully, continuing with other sites if one fails

**Site Interface** (`src/Site/SiteInterface.php`):
- All site parsers implement `getData(): array` and `getReportFileName(): string`
- Each site parser is responsible for fetching and structuring its own data

**Excel Generation** (`src/XlsBuilder.php`):
- Uses Vtiful\Kernel\Excel extension for Excel file creation
- Automatically sets column headers from first data row
- Applies consistent formatting (20px column width)

### Site Parser Patterns

**DomoPlaner Sites** (`src/Site/DomoPlaner.php`):
- Abstract base class for sites using DomoPlaner API
- Fetches JSON data from widget endpoints
- Standardizes flat data structure (area, number, price, rooms, etc.)
- Examples: PromDom7, ZvezdaCity variants

**Profitbase Sites** (`src/Site/Profitbase.php`):
- Abstract base class for sites using Profitbase API
- Handles authentication tokens and API requests to profitbase.ru subdomains
- Standardizes property data structure from Profitbase API responses
- Each site specifies: subdomain, house IDs, site URL, and client ID
- Examples: Avtorskiy (pb6858), Voikov (pb14280), Nasledie (pb11304)

**Other Site Parsers**:
- Each site has its own parsing logic in `src/Site/` directory
- Follow naming convention: class name matches file name
- All extend or implement `SiteInterface`

### Data Flow

1. `index.php` instantiates Report with array of site parser objects
2. `Report::make()` iterates through each site parser
3. Each parser's `getData()` method fetches and structures data
4. `XlsBuilder::createXls()` generates Excel file in `report/` directory
5. Files are named with site identifier and current date

### Dependencies

- **PHP 8.2+** with extensions: curl, dom, simplexml, json, libxml
- **Guzzle HTTP** for HTTP requests
- **php-webdriver** for Selenium automation (commented out in main flow)
- **xlswriter extension** via Vtiful\Kernel for Excel generation

### Adding New Sites

**For Profitbase Sites:**
1. Create new class extending `Profitbase` in `src/Site/`
2. Implement required abstract methods:
   - `getReportFileName()`: Return filename pattern
   - `getSubdomain()`: Return Profitbase subdomain (e.g., 'pb6858')
   - `getHouseIds()`: Return array of house IDs to parse
   - `getSiteUrl()`: Return main site URL
   - `getClientId()`: Return Profitbase client ID
3. Add authentication token to `Profitbase::getAuthToken()` tokens array
4. Add to site list in `index.php`

**For Other Sites:**
1. Create new class in `src/Site/` implementing `SiteInterface`
2. Add to site list in `index.php` constructor
3. Implement `getData()` to return array of associative arrays
4. Implement `getReportFileName()` following convention: `sitename-YYYY-MM-DD.xlsx`