# Rate Limiting Configuration

## Overview

Rate limiting is configured to prevent abuse and protect the server from spam, brute force attacks, and scraping.

## Rate Limit Rules

| Route | Limit | Per | Purpose |
|-------|-------|-----|---------|
| `/api/contact` | 3 requests | minute per IP | Prevent contact form spam |
| `/login`, `/register` | 5 requests | minute per email+IP | Prevent brute force attacks |
| `/api/products/search` | 30 requests | minute per IP | Prevent search scraping |
| `/api/*` (general) | 60 requests | minute per user/IP | Prevent API abuse |
| Admin routes | 120 requests | minute per user/IP | Higher limit for admin operations |

## Implementation

Rate limiters are defined in:
- `app/Providers/AppServiceProvider.php` → `configureRateLimiting()` method

Applied in:
- `routes/web.php` → `->middleware('throttle:name')`

## Testing

### Test Contact Form Rate Limit

```bash
# Send 4 requests in quick succession (4th will be blocked)
for i in {1..4}; do
  curl -X POST http://localhost:8000/api/contact \
    -d "name=Test&email=test@test.com&phone=123&location=HCM&inquiry_types[]=EVs&consent_agreed=1"
  echo ""
done
```

Expected: First 3 succeed, 4th returns 429 error.

### Test Login Rate Limit

```bash
# Try 6 login attempts (6th will be blocked)
for i in {1..6}; do
  curl -X POST http://localhost:8000/login \
    -d "email=test@test.com&password=wrong"
  echo ""
done
```

Expected: First 5 processed, 6th returns 429 error.

## Response Format

When rate limit is exceeded, Laravel returns:
```json
{
  "message": "Too Many Requests"
}
```

HTTP Status: `429 Too Many Requests`

## Customization

To change limits, edit `app/Providers/AppServiceProvider.php`:

```php
// Example: Change contact form to 5 requests per minute
RateLimiter::for('contact', function (Request $request) {
    return Limit::perMinute(5)->by($request->ip());
});
```

Then clear and rebuild cache:
```bash
php artisan config:clear
php artisan route:clear
php artisan config:cache
php artisan route:cache
```

## Monitoring

To check if rate limits are being hit:

```bash
# Check Laravel logs
tail -f storage/logs/laravel.log | grep "429"

# Or search for rate limit violations
grep "429" storage/logs/laravel.log
```

## Bypass Rate Limiting (Development Only)

To disable rate limiting temporarily for testing:

```php
// In AppServiceProvider::configureRateLimiting()
// Comment out the specific rate limiter you want to disable

// RateLimiter::for('contact', function (Request $request) {
//     return Limit::perMinute(3)->by($request->ip());
// });
```

⚠️ **Never disable in production!**

## Notes

- Rate limits are tracked in cache (default: file-based)
- Limits reset after the time window expires
- Different IPs are tracked separately
- Admin routes have higher limits for better UX


