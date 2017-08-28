# Setup

## Requirements

First of all, you need Docker and Docker Compose (>= 1.6.O) on your computer.

## Installation
Initialize your environment:

`./jarvis.sh init`

Then, enter '0' for env number.

You can now build containers and the project by doing `./jarvis.sh full-install` or `./jarvis.sh install` if you don't need OnlyOffice.

## MacOS specific

DockerFs is very slow on macOS. For better performances, we recommends that you use d4m-nfs on macOS.  
Before running `./jarvis.sh install`, run `./d4m-nfs.sh`.  
**Important:** in Docker UI, Preferences, File sharing tab, make sure only `/tmp` is there. Otherwise DockerFs will still be used.

# Web interfaces

* Application: http://jarvis.local:8080/app_dev.php (test/test)
* Log.io: http://jarvis.local:28778
* MailCatcher: http://jarvis.local:1080
* PhpRedmin: http://jarvis.local:9001 (admin/admin)
* RabbitMQ-Management: http://jarvis.local:15672 (guest/guest)

For multiple environments on same host, default strategy is DEFAULT_PORT + ENV_NUMBER (ex: application on env 3 is on port 8083)