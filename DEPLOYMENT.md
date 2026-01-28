# Vercel Deployment Guide

## Prerequisites

1. **Vercel Account**: Sign up at [vercel.com](https://vercel.com)
2. **Git Repository**: Your project must be on GitHub, GitLab, or Bitbucket
3. **Node.js & npm**: Installed locally (for Vercel CLI)

## Option 1: Deploy via Vercel Dashboard (Recommended)

### Step 1: Push Your Code to Git

```bash
cd /workspaces/tc
git init
git add .
git commit -m "Initial commit: Invoice application ready for Vercel"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/tc.git
git push -u origin main
```

### Step 2: Connect to Vercel

1. Go to [vercel.com/dashboard](https://vercel.com/dashboard)
2. Click **"Add New..."** → **"Project"**
3. Select your repository (GitHub, GitLab, or Bitbucket)
4. Click **Import**
5. The vercel.json configuration will be auto-detected

### Step 3: Configure Environment Variables (Optional)

If you need custom environment variables:
1. In Project Settings → Environment Variables
2. Add `DB_PATH` if using a custom database path
3. Or use default `/tmp/invoices.db`

### Step 4: Deploy

Click **"Deploy"** and wait for the deployment to complete.

Your app will be live at: `https://your-project-name.vercel.app`

---

## Option 2: Deploy via Vercel CLI

### Step 1: Install Vercel CLI

```bash
npm install -g vercel
```

### Step 2: Login to Vercel

```bash
vercel login
```

### Step 3: Deploy from Your Project

```bash
cd /workspaces/tc
vercel
```

Follow the prompts:
- Link to existing project or create new
- Set project name
- Set root directory (press Enter for default)
- Override settings? (No)

### Step 4: Access Your App

After deployment, you'll get a URL like: `https://tc.vercel.app`

---

## Configuration Details

### vercel.json

The `vercel.json` file configures Vercel to run PHP:

```json
{
  "version": 2,
  "framework": "php",
  "builds": [{
    "src": "public/index.php",
    "use": "@vercelphp/php"
  }],
  "routes": [{
    "src": "/(.*)",
    "dest": "/public/index.php"
  }],
  "env": {
    "DB_PATH": "/tmp/invoices.db"
  }
}
```

**Key Points:**
- Routes all requests to `public/index.php`
- Uses PHP 8.2 runtime
- Database stored in `/tmp/invoices.db` (temporary, cleared on redeploy)

### .vercelignore

Files excluded from deployment:
- node_modules
- .git directories
- Log files
- IDE files

---

## Important Considerations

### 1. Database Storage ⚠️

**Vercel's /tmp directory is ephemeral** - it's cleared on each deployment.

**Options:**
- **Option A**: Use a cloud database (PostgreSQL, MySQL)
  ```php
  // Modify Database.php to use cloud database
  $pdo = new PDO('mysql:host=DB_HOST;dbname=DB_NAME', 'user', 'pass');
  ```

- **Option B**: Accept data loss on deployment (suitable for testing/demo)
  - Current setup uses `/tmp/invoices.db`
  - Ideal for demos and testing

- **Option C**: Use serverless database services:
  - Upstash (Redis)
  - MongoDB Atlas (free tier)
  - Supabase (PostgreSQL)

### 2. Session Storage

For multiple instances, consider:
```php
// Use environment variable for session storage
ini_set('session.save_path', '/tmp');
```

### 3. File Uploads

The `uploads/` directory may not persist. Consider:
- Store in cloud storage (AWS S3, Cloudinary)
- Modify application to upload to CDN

---

## Using External Database (Recommended for Production)

### Example: PostgreSQL with Supabase

1. Create free database at [supabase.com](https://supabase.com)
2. Get connection string
3. Add environment variable in Vercel:
   - Go to Project Settings → Environment Variables
   - Add `DATABASE_URL` with your connection string

4. Update `src/config/Database.php`:

```php
public function __construct() {
    $databaseUrl = getenv('DATABASE_URL');
    
    if ($databaseUrl) {
        // Use PostgreSQL
        $this->connectPostgreSQL($databaseUrl);
    } else {
        // Use SQLite for local development
        $this->connectSQLite();
    }
    
    $this->initializeTables();
}

private function connectPostgreSQL($url) {
    try {
        $this->pdo = new PDO($url);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}
```

---

## Deployment Checklist

- [ ] Code pushed to GitHub/GitLab/Bitbucket
- [ ] vercel.json is in root directory
- [ ] .vercelignore is in root directory
- [ ] Vercel account created
- [ ] Project connected to Vercel
- [ ] Environment variables configured (if needed)
- [ ] Deployment successful
- [ ] Test application at Vercel URL
- [ ] Test all features (create customer, invoice, print, etc.)

---

## Testing After Deployment

1. **Dashboard**: Load the homepage and check statistics
2. **Create Customer**: Add a test customer
3. **Create Invoice**: Generate a test invoice
4. **Print Invoice**: Verify PDF generation works
5. **Search**: Test search functionality
6. **Delete**: Test delete operations

---

## Troubleshooting

### Issue: 500 Internal Server Error

**Check Vercel logs:**
```bash
vercel logs <url> --follow
```

### Issue: Database not found

Ensure database path is writable:
```php
// /tmp should be writable in Vercel
$dbPath = getenv('DB_PATH') ?: '/tmp/invoices.db';
```

### Issue: Sessions not persisting

Use database-backed sessions or file storage in /tmp (temporary):
```php
ini_set('session.save_path', '/tmp');
```

### Issue: Static files not loading

Ensure correct asset paths in templates. All CSS/JS are inline in base.php.

---

## Domains

To use a custom domain:

1. In Vercel Project Settings → Domains
2. Add your domain
3. Update DNS records as instructed by Vercel
4. Wait for DNS propagation (5-48 hours)

---

## Performance Tips

1. **Enable Caching**: Vercel automatically caches static assets
2. **Use CDN**: Font Awesome is already cached via CDN
3. **Optimize Queries**: Add indexes to frequently queried columns
4. **Enable Compression**: Automatically enabled by Vercel

---

## Support

- Vercel Docs: [vercel.com/docs](https://vercel.com/docs)
- PHP Support: [vercel.com/docs/functions/serverless-functions/runtimes/php](https://vercel.com/docs/functions/serverless-functions/runtimes/php)
- Community Help: [GitHub Discussions](https://github.com/vercel/vercel/discussions)

---

## Next Steps

1. Deploy your application
2. Share the Vercel URL with your team
3. Collect feedback
4. Implement production database if needed
5. Monitor usage and performance
