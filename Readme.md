# BDD Testing

### Prerequisites
You must have following installed on your host machine

1. Git
2. Docker 

### Dependencies
1. PHP 7.4
1. Composer2
1. Behat
1. Behat Mink
1. Selenium Stand Alone Chrome

### Installation
1. From root run `docker-compose build` to build docker images
1. From root run `docker-compose up -d` to run all containers
1. From php container execute `composer install` 

## Execute Your Test
1. Run all tests `vendor/bin/behat -p chrome`
1. Run specific folder `vendor/bin/behat -p chrome Features/Core`
1. Run Individual feature `vendor/bin/behat -p chrome Features/Test.feature`

## To do
1. Add Firefox Browser support
1. Add Data Fixtures

## Write Your Feature Test

### Resources
1. [Behat](https://docs.behat.org/en/latest/quick_start.html)
1. [Mink](https://mink.behat.org/en/latest/index.html)
1. [Chrome and Firefox](https://blog.bandhosting.nl/blog/testing-your-application-using-selenium,-chrome-firefox-and-behat)
1. [How to Setup behat Selenium Chrome](https://rbrt.wllr.info/2017/11/22/how-setup-testing-behat-selenium-chrome.html)