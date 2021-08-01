# cses-standings-api

This repo is a traduction of https://github.com/bkorecic/cses-standings into a php api.

## Usage:
Clone the repo and:
1) Add your mysql credentials in the files `/api/cses-tasks/index.php` and `/cron/cses-job.php`
2) Implement the `/cron/cses-get-ids.php` file to return an array with the user ids you want to keep track of.
3) Schelude the `/cron/cses-job.php` file, it's recomended to use a time interval of 5 minutes or more.
