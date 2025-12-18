#!/bin/bash

# Script untuk setup dan deploy dari Linux ke Render
# Untuk Arch Linux (Endeavour)

set -e

echo "=================================="
echo "🚀 Deploy Laravel to Render Script"
echo "=================================="
echo ""

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Functions
print_success() {
    echo -e "${GREEN}✓ $1${NC}"
}

print_error() {
    echo -e "${RED}✗ $1${NC}"
}

print_warning() {
    echo -e "${YELLOW}⚠ $1${NC}"
}

print_info() {
    echo -e "${NC}→ $1${NC}"
}

# Check if command exists
command_exists() {
    command -v "$1" >/dev/null 2>&1
}

# Step 1: Check dependencies
echo "Step 1: Checking dependencies..."
echo "--------------------------------"

if command_exists php; then
    PHP_VERSION=$(php -r "echo PHP_VERSION;")
    print_success "PHP installed: $PHP_VERSION"
else
    print_error "PHP not found. Install with: sudo pacman -S php"
    exit 1
fi

if command_exists composer; then
    print_success "Composer installed"
else
    print_error "Composer not found. Install with: sudo pacman -S composer"
    exit 1
fi

if command_exists node; then
    NODE_VERSION=$(node -v)
    print_success "Node.js installed: $NODE_VERSION"
else
    print_error "Node.js not found. Install with: sudo pacman -S nodejs npm"
    exit 1
fi

if command_exists git; then
    print_success "Git installed"
else
    print_error "Git not found. Install with: sudo pacman -S git"
    exit 1
fi

echo ""

# Step 2: Check network connection
echo "Step 2: Checking network connection..."
echo "---------------------------------------"

if ping -c 1 google.com &> /dev/null; then
    print_success "Internet connection: OK"
else
    print_error "No internet connection. Connect to hotspot first!"
    print_info "Run: nmcli device wifi connect 'Hotspot_Name' password 'password'"
    exit 1
fi

echo ""

# Step 3: Setup project
echo "Step 3: Setting up project..."
echo "-----------------------------"

# Check if project directory exists
if [ -d "vendor" ] && [ -d "node_modules" ]; then
    print_warning "Dependencies already installed. Skipping..."
else
    print_info "Installing PHP dependencies..."
    composer install --optimize-autoloader
    print_success "Composer dependencies installed"
    
    print_info "Installing Node dependencies..."
    npm install
    print_success "Node dependencies installed"
fi

echo ""

# Step 4: Check environment
echo "Step 4: Checking environment..."
echo "-------------------------------"

if [ ! -f ".env" ]; then
    print_warning ".env not found. Creating from .env.example..."
    cp .env.example .env
    php artisan key:generate
    print_success ".env created and APP_KEY generated"
else
    print_success ".env file exists"
fi

echo ""

# Step 5: Build assets
echo "Step 5: Building frontend assets..."
echo "------------------------------------"

print_info "Running npm run build..."
npm run build

if [ -d "public/build" ]; then
    print_success "Assets built successfully"
else
    print_error "Build failed. Check errors above."
    exit 1
fi

echo ""

# Step 6: Git status
echo "Step 6: Checking Git status..."
echo "------------------------------"

if [ -d ".git" ]; then
    print_success "Git repository initialized"
    
    # Check for uncommitted changes
    if [ -n "$(git status --porcelain)" ]; then
        print_warning "You have uncommitted changes:"
        git status --short
        echo ""
        read -p "Commit changes now? (y/n): " -n 1 -r
        echo
        if [[ $REPLY =~ ^[Yy]$ ]]; then
            read -p "Enter commit message: " COMMIT_MSG
            git add .
            git commit -m "$COMMIT_MSG"
            print_success "Changes committed"
        fi
    else
        print_success "No uncommitted changes"
    fi
    
    # Check remote
    if git remote -v | grep -q "origin"; then
        print_success "Remote 'origin' configured"
        REMOTE_URL=$(git remote get-url origin)
        print_info "Remote: $REMOTE_URL"
    else
        print_warning "No remote configured"
        read -p "Enter GitHub repository URL: " REPO_URL
        git remote add origin "$REPO_URL"
        print_success "Remote added: $REPO_URL"
    fi
else
    print_error "Not a Git repository. Initialize with: git init"
    exit 1
fi

echo ""

# Step 7: Push to GitHub
echo "Step 7: Pushing to GitHub..."
echo "----------------------------"

read -p "Push to GitHub now? (y/n): " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    print_info "Pushing to GitHub..."
    
    # Get current branch
    BRANCH=$(git rev-parse --abbrev-ref HEAD)
    
    if git push origin "$BRANCH"; then
        print_success "Successfully pushed to GitHub"
    else
        print_error "Failed to push. Check your credentials."
        print_info "For authentication issues:"
        print_info "1. Use Personal Access Token"
        print_info "2. Or setup SSH key: ssh-keygen -t ed25519"
        exit 1
    fi
else
    print_warning "Skipped GitHub push"
fi

echo ""

# Step 8: Render deployment info
echo "Step 8: Render Deployment"
echo "-------------------------"
print_info "Next steps for Render deployment:"
echo ""
echo "1. Open browser and go to: https://dashboard.render.com"
echo "2. Login with GitHub account"
echo "3. Click 'New +' → 'Web Service'"
echo "4. Select repository: dayattt111/project_dipaTalent"
echo "5. Configure:"
echo "   - Name: dipatalent-app"
echo "   - Runtime: Docker"
echo "   - Dockerfile Path: ./Dockerfile.render"
echo "   - Branch: $BRANCH"
echo ""
echo "6. Create PostgreSQL Database:"
echo "   - Click 'New +' → 'PostgreSQL'"
echo "   - Name: dipatalent-db"
echo "   - Save credentials!"
echo ""
echo "7. Add Environment Variables in Web Service:"
echo "   - APP_NAME='Dipa Talent'"
echo "   - APP_ENV=production"
echo "   - APP_DEBUG=false"
echo "   - DB_CONNECTION=pgsql"
echo "   - DB_HOST=<from postgresql>"
echo "   - DB_PORT=5432"
echo "   - DB_DATABASE=<from postgresql>"
echo "   - DB_USERNAME=<from postgresql>"
echo "   - DB_PASSWORD=<from postgresql>"
echo ""
echo "8. Deploy and wait for build (~5-10 minutes)"
echo ""
print_success "Setup complete! Follow the steps above to deploy to Render."
echo ""
echo "=================================="
print_info "For detailed guide, see: DEPLOY_LINUX_TO_RENDER.md"
echo "=================================="
