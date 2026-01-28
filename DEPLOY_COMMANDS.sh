#!/bin/bash

# Invoice App - Vercel Deployment Commands
# Run these commands one by one to deploy to Vercel

echo "==========================================="
echo "Invoice App - Vercel Deployment Guide"
echo "==========================================="
echo ""

# Step 1: Navigate to project
echo "📁 Step 1: Navigate to project directory"
echo "$ cd /workspaces/tc"
echo ""

# Step 2: Initialize/update git
echo "📝 Step 2: Initialize Git (if not already done)"
echo "$ git init"
echo "$ git add ."
echo "$ git commit -m 'Invoice app - ready for Vercel deployment'"
echo "$ git branch -M main"
echo ""

# Step 3: Add remote repository
echo "🔗 Step 3: Add GitHub Repository"
echo "$ git remote add origin https://github.com/YOUR_USERNAME/tc.git"
echo "$ git push -u origin main"
echo ""

# Step 4: Deploy
echo "🚀 Step 4: Deploy to Vercel"
echo ""
echo "Option A: Via Vercel Dashboard (Recommended)"
echo "  1. Go to https://vercel.com/dashboard"
echo "  2. Click 'Add New' → 'Project'"
echo "  3. Select 'tc' repository"
echo "  4. Click 'Deploy'"
echo ""
echo "Option B: Via Vercel CLI"
echo "  $ npm i -g vercel"
echo "  $ vercel"
echo "  (Follow the prompts)"
echo ""

# Step 5: Verification
echo "✅ Step 5: Verify Deployment"
echo "  1. Visit: https://tc-YOUR_USERNAME.vercel.app"
echo "  2. Test creating a customer"
echo "  3. Test creating an invoice"
echo "  4. Test printing an invoice"
echo ""

echo "==========================================="
echo "For detailed guide, see DEPLOYMENT.md"
echo "For quick start, see DEPLOY_QUICK_START.md"
echo "==========================================="
echo ""

# Additional commands
echo ""
echo "📚 Useful Commands:"
echo ""
echo "Check git status:"
echo "$ git status"
echo ""
echo "View Vercel logs:"
echo "$ vercel logs your-app-name.vercel.app --follow"
echo ""
echo "Update after changes:"
echo "$ git add . && git commit -m 'message' && git push origin main"
echo ""
echo "Redeploy (if needed):"
echo "$ vercel --prod"
echo ""
echo "==========================================="
