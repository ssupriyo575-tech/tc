# Quick Start: Deploy to Vercel in 5 Minutes

## Fastest Way to Deploy

### 1. Make Sure Code is on GitHub

```bash
# If not already done
cd /workspaces/tc
git init
git add .
git commit -m "Invoice app - ready to deploy"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/tc.git
git push -u origin main
```

### 2. Go to Vercel Dashboard

Visit: https://vercel.com/dashboard

### 3. Click "Add New" → "Project"

- Select your GitHub repository (tc)
- Vercel will auto-detect the configuration
- Click "Deploy"

### 4. That's It! 🎉

Your app will be live in ~1-2 minutes at:
```
https://tc-YOUR_USERNAME.vercel.app
```

---

## What Files We Created for Vercel

✅ **vercel.json** - Vercel configuration
✅ **.vercelignore** - Files to exclude
✅ **DEPLOYMENT.md** - Detailed deployment guide
✅ **api/index.php** - Optional router

---

## Verify Everything Works

1. Open your Vercel URL
2. Create a customer
3. Create an invoice
4. Print the invoice
5. Test all features

---

## Important Notes

⚠️ **Database**: Stored in `/tmp` (clears on redeploy)

For production, use a cloud database:
- Supabase (PostgreSQL) - Free tier
- MongoDB Atlas - Free tier
- AWS RDS - Paid

See `DEPLOYMENT.md` for database setup.

---

## Commands

**Deploy again after changes:**
```bash
git add .
git commit -m "Updates"
git push origin main
# Vercel auto-deploys on push
```

**View logs:**
```bash
vercel logs your-project.vercel.app
```

**Redeploy:**
```bash
vercel --prod
```

---

## Need Help?

- Full guide: Read `DEPLOYMENT.md`
- Vercel docs: https://vercel.com/docs
- Issues? Check Vercel logs in dashboard

---

**Your invoice app is now ready for the world! 🚀**
