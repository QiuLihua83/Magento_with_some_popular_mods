#!/bin/bash

ROOT='../'

cd ${ROOT}
echo "pwd:"
pwd

sudo find ./ -type f -exec chmod 644 {} \;
sudo find ./ -type d -exec chmod 777 {} \;
sudo find var/package -type f -exec chmod 766 {} \;
sudo find media -type f -exec chmod 766 {} \;
sudo chmod o+w var/.htaccess
sudo chmod 550 mage
sudo chmod +x  cron.sh
sudo chmod +x  tools/chmod.sh
sudo chmod +x  tools/install.sh
