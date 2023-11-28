#!/bin/bash
usermod -u 1000 www-data
groupmod -g 1000 www-data

#!/bin/bash
set -euo pipefail

# Install Composer globally
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

apache2-foreground

# Execute the original entrypoint (e.g., Apache, PHP-FPM)
exec "$@"
