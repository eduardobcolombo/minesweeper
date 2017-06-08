
## About Minesweeper

This application is a single player game with API and client to play this old famous game minesweeper

## Requirements
 - PHP 5.6, Sqlite, Composer 

## Running

To run this application follow the lines below.

 - git clone https://github.com/eduardobcolombo/minesweeper.git
 - composer install
 - touch database/database.sqlite
 - cp .env.example to .env
   - input in this file your own configurations, like database...

# API
 
 This API works with two endpoints:
 - api/v1/game 
   - params: username, rows, cols and bombs
   - this endpoing return a JSON messagem with the structure like this:
   
```JSON
{
 "username":"eduardo",
 "game_id":54,
 "status":"playing",
 "rows":"5",
 "cols":"5",
 "bombs":"5",
 "revealed":"H,H,H,H,H,H,H,H,H,H,H,H,H,H,H,H,H,H,H,H,H,H,H,H,H"
}
```
 - api/v1/game/reveal
   - params: game_id, row, col
   - this endpoing return a JSON messagem with the structure like this:
   
with row = 0 and col = 1. is a bomb
```JSON
{
 "status":"Game Over",
 "revealed":"H,B,H,H,H,H,H,H,H,H,H,H,H,H,H,H,H,H,H,H,H,H,H,H,H"
}
```
with row = 0 and col = 2. is a number 1

```JSON
{
 "status":"playing",
 "revealed":"H,H,1,H,H,H,H,H,H,H,H,H,H,H,H,H,H,H,H,H,H,H,H,H,H"
}
```






## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
