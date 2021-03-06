# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]
Nothing

## [1.1.6] - 2019-03-14
### Added
- New commands
 - ``Ubiquity restapi`` -> create a REST API controller (based on JsonApi)
  - ``Ubiquity rest`` -> create a REST controller associated to a model
  - ``Ubiquity dao`` -> query the database
    - getOne
    - getAll
    - uGetOne
    - uGetAll
    - count
    - uCount

### Fixed
 - [New project template has invalid link to Admin page](https://github.com/phpMv/ubiquity/issues/8)

## [1.1.5] - 2019-02-22
### Added
- New commands
  - ``Ubiquity config`` -> display config file variables
  - ``Ubiquity config:set --database.dbName=blog`` -> modify/add and save config variables
  - ``Ubiquity info:models`` -> display all models metadatas
  - ``Ubiquity info:model -m=User`` -> display metadatas for the selected model
  - ``Ubiquity info:validation`` -> display validation infos for all models or the selected one

### Changed
- Project structure (commands are in separate classes).
- services.tpl template for new project creation

## [1.1.4] - 2019-02-18
### Added
- New commands
  - ``Ubiquity info:routes`` -> display the router informations/test the routes resolution (with -s parameter)

### Changed
- Project structure (src folder).

## [1.1.3] - 2019-02-13
### Added
- New commands
  - ``Ubiquity serve`` -> php internal web server for dev
