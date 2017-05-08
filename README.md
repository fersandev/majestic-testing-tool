# majestic-testing-tool
Majestic Testing Tool (MTT) is a awesome library that helps develop software more efficiently and confidence using and approach for Test Driven Development (TDD).

## Installation
- Add the dependency to `composer.json` file 
{
    "require": {
        "fersandev/majestic-testing-tool": "dev-master"
    },
    "repositories": [
        {
          "type": "package",
          "package": {
            "name": "fersandev/majestic-testing-tool",
            "version": "dev-master",
            "source": {
              "url": "https://github.com/fersandev/majestic-testing-tool.git",
              "type": "git",
              "reference": "master"
             }
            }
        }
    ]    
}

- Install dependencies
`composer install`


## Use
The dashboard for monitors and unit testing is accessed by: [HOST]/vendor/fersandev/majestic-testing-tool/ 

>  ex: http://testing-page-mtt.local.host/vendor/fersandev/majestic-testing-tool/

### For monitoring module
In the dashboard create a new unit monitor, this process throws a monitoring code for php or javascript that you need to include in your code functionalities that you want to monitor.

## Use in Laravel
If you are in Laravel framework please fallow the next steps:

- Change the package directory from [HOST]/vendor/fersandev/majestic-testing-tool/ to [HOST]public/vendor/fersandev/majestic-testing-tool/ 