# For projects without a frontend build (e.g. headless/API-only or plain Twig
# without Vite). Versions: only change them here.
ARG PHP_VERSION=8.4

### Craft (web + queue)
FROM ghcr.io/samuelreichor/craftcms-docker:${PHP_VERSION}

# Custom nginx directives, included inside the server block.
COPY .coolify/nginx/ /etc/nginx/server-opts.d/

# Code and dependencies belong to root, so PHP can't modify them.
USER root

# Project specific PHP extensions, e.g.:
# RUN install-php-extensions redis

# Dependencies first, so they stay cached until composer.lock changes.
COPY composer.json composer.lock ./

# Locally craft-query-api comes from the plugins/query-api submodule (path repository),
# which isn't in the build context. Swap it for the dev branch from Packagist and
# re-resolve only that package; everything else stays on the locked versions.
# --no-scripts skips hooks that need a DB connection, --no-autoloader because
# the project code (e.g. modules/) isn't copied yet.
RUN apk add --no-cache jq \
  && jq '.require["samuelreichor/craft-query-api"] = "dev-dev" | .repositories = (.repositories // [] | map(select(.type != "path" or .url != "plugins/query-api")))' composer.json > composer.tmp.json \
  && mv composer.tmp.json composer.json \
  && composer update samuelreichor/craft-query-api --no-interaction --no-dev --no-scripts --no-autoloader \
  && cp composer.json composer.lock /tmp/

COPY . .

# COPY . . brings back the local composer.json/lock, restore the resolved ones.
# COPY also resets folders that exist in the repo (e.g. storage/) to root, so
# hand Craft's writable paths back to www-data.
RUN cp /tmp/composer.json /tmp/composer.lock ./ \
  && composer dump-autoload --no-dev --optimize \
  && chown -R www-data:www-data storage web/cpresources web/assets .env

USER www-data
