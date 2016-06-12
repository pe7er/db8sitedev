DROP TABLE IF EXISTS `#__db8sitedev_checks`;

DELETE FROM `#__content_types` WHERE (type_alias LIKE 'com_db8sitedev.%');

DELETE FROM `#__categories` WHERE (extension = 'com_db8sitedev');