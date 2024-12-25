# Foosball Ranking App

The Foosball Ranking App is a dynamic platform for tracking and managing foosball matches within your group, company, or
community. Players can easily register matches, and their performance is evaluated using the Elo rating system. This
system ensures fair and competitive rankings by adjusting points based on the relative skill levels of the teams.

- **Elo-Based Ratings**: Earn or lose points based on the match outcome and your opponent's rating.
    - **Win against stronger opponents**: Gain more points as the challenge was greater.
    - **Lose to stronger opponents**: Lose fewer points, as the odds were against you.
    - **Win against weaker opponents**: Gain fewer points, reflecting the lower challenge.
    - **Lose to weaker opponents**: Lose more points for an unexpected result.

Keep your foosball experience exciting and competitive by tracking progress, improving rankings, and fostering friendly
rivalries!

## Prerequisites

- [Docker Desktop](https://www.docker.com/products/docker-desktop) or a similar Docker environment
- [Git](https://git-scm.com/downloads) for cloning the repository

## Why Use Sail?

Laravel Sail is a simple way to manage your development environment with Docker. It provides a pre-configured setup for
Laravel projects, making it easy to get started. While Sail is optional, it ensures consistency and portability across
systems. You can use other methods if you prefer, but Sail simplifies the process significantly.

## Installation

1. **Clone the Repository**

   ```bash
   git clone https://github.com/your-username/your-repo.git
   cd your-repo
   ```

2. **Copy the Environment File**

   ```bash
   cp .env.example .env
   ```

3. **Update the `.env` File**

    - Set any required environment variables (database credentials, app name, etc.) as needed.

4. **Install PHP Dependencies**

   ```bash
   # If you don't have Composer globally, you can use this shortcut:
   docker run --rm \
       -u "$(id -u):$(id -g)" \
       -v "$(pwd)":/var/www/html \
       -w /var/www/html \
       laravelsail/php82-composer:latest \
       composer install
   ```

5. **Start the Containers**

   ```bash
   ./vendor/bin/sail up -d
   ```
   This launches the application in detached mode. If you want to see the logs in real time, omit the `-d`:
   ```bash
   ./vendor/bin/sail up
   ```

6. **Generate Application Key**

   ```bash
   ./vendor/bin/sail artisan key:generate
   ```

7. **Run Migrations (and optionally seed the database)**

   ```bash
   ./vendor/bin/sail artisan migrate --seed
   ```

8. **Install Front-End Dependencies and Compile Assets**

   ```bash
   ./vendor/bin/sail npm install
   ./vendor/bin/sail npm run dev
   ```
   For a production build, you can replace `npm run dev` with:
   ```bash
   ./vendor/bin/sail npm run build
   ```

9. **Visit the App**

    - By default, Sail exposes the app on [http://localhost](http://localhost) or [http://127.0.0.1](http://127.0.0.1).
    - Check your `.env` file for `APP_PORT` or `APP_SERVICE_PORT` if you changed the default.

## Stopping the Containers

```bash
./vendor/bin/sail down
```

## Additional Commands

- **Run Tests**:
  ```bash
  ./vendor/bin/sail test
  ```
- **Run Artisan Commands**:
  ```bash
  ./vendor/bin/sail artisan <command>
  ```
- **Run Composer**:
  ```bash
  ./vendor/bin/sail composer <command>
  ```
- **Shell into the Container**:
  ```bash
  ./vendor/bin/sail shell
  ```

## Troubleshooting

- Ensure Docker is running before executing Sail commands.
- If you encounter permission issues, consider running commands as `sudo` or adjusting file permissions on your host machine.
