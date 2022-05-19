# Putt18

## How entities are organized

| Entity | Description |
|---|---|
| User | A registered user. Users can be given differant roles. Only give the role of `user` to regular users. |
| Player | Registered or unregistered players. Player may be associated with a registerd `User` |
| Ranking | Rankings calculated for leaderboards. Run a ranking calculation logic periodically to update rankings |
| Teams | A game must always have a team. Even if it's a single game. Single games will have only 1 team. Team games will have more than 1 team |
| UpdatePlayerRankingsCommand | Use this command to update player rankings (for leaderboards |

## Deployment Instructions

```
// update the code to latest master branch
git pull origin master

// create a local php alias to the correct version
alias php=/opt/cpanel/ea-php73/root/usr/bin/php

// install with composer
/opt/cpanel/ea-php73/root/usr/bin/php /opt/cpanel/composer/bin/composer install --no-dev
```

## Deployment Server Initial Setup Instructions

```
// copy the .env file
cp .env.example .env

// edit the .env file with the server settings

// link the storage folder
php artisan storage:link

// generate app key
php artisan key:generate
```

### Development Instructions

Migrate and seed the database
```
php artisan db:refresh
```

Run the local development watcher
```
npm run watch
```

Generate API documentation
```
php artisan generate:docs && apidoc -i resources/docs -o public_html/docs/api
```

Before releasing to production, compile the assets
```
npm run production
```

## Other Documents

(Push Notifications)[https://bitbucket.org/elegantmedia/oxygen-push-notifications/src/master/]

## Licence

Project Licenced to Putt18. [Copyright Elegant Media](https://www.elegantmedia.com.au)

## Local Development Setup Instructions
 
- `composer dump-autoload` - Generate the classmap, so the new files are recognized
- `php artisan db:refresh` - Migrate and seed the database
- `npm install` - Install NPM packages. Check if Node.js is installed with `npm -v`
- `npm run dev` - Compile and build. If you get first time error, run it again.
- `npm run watch` - Run and watch the application on browser (Does NOT work with Homestead)
