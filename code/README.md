# Random Quotes Application

This is a simple Laravel application to use for demonstrating OpenTelemetry auto-instrumentation. The version in the
repository does not have OpenTelemetry enabled, but see below for instructions.

## Setup

The easiest way to setup and run this is using docker.

If you want to access it directly from network ports, rename `docker-compose.override.ports.yml` to
`docker-compose.override.yml` and edit it to contain the ports you want to expose the application on.

The first step is to copy `.env.example` to `.env` and edit the `APP_URL` to match your URL. The rest of the settings
should be fine without being touched.

You can now run the following commands to bring the application up:

```bash
docker compose up -d redis database
docker compose run --rm composer install
docker compose run --rm npm install
docker compose run --rm npm run build
docker compose run --rm artisan key:generate
docker compose run --rm artisan migrate
docker compose run --rm artisan db:seed QuotesSeeder
docker compose up -d
```

The application should now be running on the port you've configured in the override.

## Usage

The app is really simple. The homepage just shows a random quote from the database. There is also `/error` which
intentionally just throws an exception.

There is a REST API at `/api/quotes` which can be used to add/remove/update quotes in the database. It has no
authentication or security.

## Adding OpenTelemetry

To add OpenTelemetry, you need to do the following:

1. Add the OpenTelemetry PHP extension to `Dockerfile`. Either add `opentelemetry` to the list of extensions already
   being installed, or add a new line underneath with `RUN install-php-extensions opentelemetry`.
2. You now need to install the Open Telemetry libraries with composer.

```bash
docker compose build composer
docker compose run --rm composer require open-telemetry/sdk \
                                         open-telemetry/exporter-otlp \
                                         open-telemetry/opentelemetry-auto-laravel
```

3. Now you need to enable the collector. Rename `collector.example.yml` to `collector.yml` and edit it to whatever is
   needed by your provider. By default it has the debug exporter as an example.
4. Enable the `docker-compose.override.collector.yml` override by either renaming it to `docker-compose.override.yml`
   or adding it to your existing override
5. Start the collector with:

```bash
docker compose build collector
docker compose up -d collector
```
6. Add the environment variables to the `.env` file to enable auto-instrumentation:

```dotenv
OTEL_PHP_AUTOLOAD_ENABLED=true
OTEL_SERVICE_NAME=quotes
OTEL_EXPORTER_OTLP_PROTOCOL=http/json
OTEL_EXPORTER_OTLP_ENDPOINT=http://collector:4318
```

7. Restart the quotes service with `docker compose up -d quotes`

It should now be using OpenTelemetry and auto-instrumenting the application!

## Contributing

This isn't really a project I'm accepting contributions on as it's more of a demo. That said, submit a PR and I'll
review it!

## Thanks

The only reason I've written this is for the presentation, and the only reason I decided to do that is because of the
following amazing people.

 - Gina Banyard
 - Sara Golemon
 - Dave Liddament
 - Rob Allen

Thanks as well to Zoë O'Connell for helping me test how easy this was to get started with.

## License

The MIT License (MIT)

Copyright (c) 2025 Jessica Smith

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
documentation files (the "Software"), to deal in the Software without restriction, including without limitation the
rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit
persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the
Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
