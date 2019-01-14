# KnocksBot

Userbot/bot template for Telegram made with MadelineProto

**All the credits for [MadelineProto](https://github.com/danog/MadelineProto) go to [Danog](https://github.com/danog)**

## Requirements

* PHP 7 or newer
* A HTTPS-enabled server/webserver

## Installation

Clone the repository in your server via

```bash
git clone https://github.com/Knocks83/KnocksBot.git
```

Otherwise if you don't have git you can just download it as a zip and extract it in your server

## Configuration

### Set config file (`config.php`)

Add the admins IDs in the array `$admins`, separated by a comma.
Ex:

```php
$admins = [
    // Add the admin IDs here
    id1,
    id2,
    id3,
]
```

### Setup commands and variables

You can use the default variables (`$isPrivateChat, $user_id, $chat_id, $msg_id`) and add new variables in `EventHandler.php`.

To set the commands you have to edit `commands.php` and add whatever you want. If it's a userbot you can put text as commands (so you don't have to use the `/`),
if it's a bot to use normal text as commands you have to enable it in [BotFather](https://t.me/BotFather).

## First Start

To start the bot for the first time you have to open bot.php via CLI, for beginners you can use the auto-mode (type a when the program will ask for it).
It will ask you for a phone number (to make the application), insert it and type the string you'll receive in Telegram.
It'll ask you again for a phone number, for newbies use the same number you typed in before and type in the code you receive in Telegram.

## Updating MadelineProto

To update MadelineProto you just have to delete `madeline.php`, you won't lose the access to your account and the program will automaticlly download the newest relase of MadelineProto.

---

That's all Folks!
For help just [ask me on Telegram](https://t.me/MakeNekosNotNukes)!

This Source Code Form is subject to the terms of the GNU Affero General Public License v3.0. If a copy of the AGPL-3.0 was not distributed with this
file, You can obtain one at <https://www.gnu.org/licenses/gpl-3.0.en.html>.
