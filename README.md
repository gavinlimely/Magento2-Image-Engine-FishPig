# ImageEngine Module for Magento2

## Instructions
composer require limelyltd/module-image-engine:dev-master

php bin/magento module:enable Limely_ImageEngine

php bin/magento setup:upgrade

php bin/magento setup:di:compile

Go to admin area, navigate to Stores > Configuration. Then change scope to the website view you'd like set up for.

Navigate to Limely > ImageEngine. Set enabled to Yes & add full URL of engine URL. Eg: https://images.limely.co.uk
