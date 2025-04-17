ARG php_version=8.2

FROM craftcms/nginx:${php_version}

USER root

# Install Composer: Copy the Composer executable from the official Composer image.
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install system tools like git, unzip, bash, and vim using apk (Alpine Package Keeper).
# --no-cache avoids caching package lists, reducing image size.
RUN apk add --no-cache git unzip bash vim jq mariadb-connector-c mysql-client

WORKDIR /app

# Copy the composer.json and composer.lock files to the working directory.
COPY composer.json ./

# Change version of craft-query-api in composer json to fix an issue with paths in the image.
RUN jq ".require[\"samuelreichor/craft-query-api\"] = \"dev-dev\" | .repositories = (.repositories // [] | map(select(.type != \"path\" or .url != \"plugins/query-api\")))" composer.json > composer.tmp.json && mv composer.tmp.json composer.json


# Install PHP dependencies using Composer, with --no-interaction, --no-dev, and --optimize-autoloader flags.
# --no-interaction: Prevents Composer from prompting for user input.
# --no-dev: Skips installing development dependencies.
# --optimize-autoloader: Improves autoloader performance.
RUN composer install --no-interaction --no-dev --optimize-autoloader

# Copy the rest of the project files (backend code) into the container.
COPY . .

# Set permissions for Craft CMS directories and .env file.
# Create the storage, cpresources, and assets directories if they don't exist.
# Change ownership of config, storage, cpresources, assets, and .env to www-data.
# Set file permissions to 775 (read, write, execute for owner and group, read and execute for others).
RUN mkdir -p /app/storage /app/web/cpresources /app/web/assets \
  && chown -R www-data:www-data /app/config /app/storage /app/web/cpresources /app/web/assets /app/.env \
  && chmod -R 775 /app/config /app/storage /app/web/cpresources /app/web/assets /app/.env

# Switch back to the www-data user to run the Nginx web server.
USER www-data
