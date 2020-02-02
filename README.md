# Magento 2 Custom Option Default Value
Magento 2 Custom Option Default Value extension use to set custom option default value for products.

# Installation
#### Step-by-step to install the Magento 2 extension through Composer:
1. Locate your Magento 2 project root.

2. Install the Magento 2 extension using [Composer](https://getcomposer.org/)  
 ```bash 
 composer require dmitrykazak/magento2-custom-option-default-value 
 ```

3. After installation is completed the extension:
 ```bash
# Enable the extension and clear static view files
 $ bin/magento module:enable DK_CustomOptionDefaultValue --clear-static-content
 
 # Update the database schema and data
 $ bin/magento setup:upgrade
 
 # Recompile your Magento project
 $ bin/magento setup:di:compile
 
 # Clean the cache 
 $ bin/magento cache:flush
```
#### Manually (not recommended)
* Download the extension of the required version
* Unzip the file
* Create a folder ````{root}/app/code/DK/CustomOptionDefaultValue````
* Copy the files this folder

#### Overview
*The supported custom options are:*
* Dropdown
* Multiselect
* Radio Box
* Checkbox

![Configuration](https://user-images.githubusercontent.com/5670207/73607519-005b9880-45c8-11ea-8b6c-eb7251a8d985.png)

![Setting Custom Option of Product](https://user-images.githubusercontent.com/5670207/73607472-5976fc80-45c7-11ea-8398-b75a3fb593f8.png)

![Product Page](https://user-images.githubusercontent.com/5670207/73607439-1157da00-45c7-11ea-9f4e-4e00763d3e6e.png)

#### Support
 If you encounter any problems or bugs, please open an [issue](https://github.com/dmitrykazak/magento2-custom-option-default-value/issues) on GitHub.

#### Links
* [Contact with me](https://developer-vub3295.slack.com/messages/CLG5P5A0N)