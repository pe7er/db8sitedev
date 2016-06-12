INSERT INTO `#__content_types` (`type_title`, `type_alias`, `table`, `content_history_options`)
SELECT * FROM ( SELECT 'Check','com_db8sitedev.check','{"special":{"dbtable":"#__db8sitedev_checks","key":"id",
  "type":"Check","prefix":"db8 Site DevTable"}}', '{"formFile":"administrator\/components\/com_db8sitedev\/models\/forms\/check.xml",
  "hideFields":["checked_out","checked_out_time","params","language"], "ignoreChanges":["modified_by", "modified",
  "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"],
  "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},
  {"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},
  {"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},
  {"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},
  {"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}') AS tmp
WHERE NOT EXISTS (
	SELECT type_alias FROM `#__content_types` WHERE (`type_alias` = 'com_db8sitedev.check')
) LIMIT 1;

UPDATE `#__content_types` SET
	`type_title` = 'Check', 
	`table` = '{"special":{"dbtable":"#__db8sitedev_checks","key":"id","type":"Check","prefix":"db8 Site DevTable"}}', 
	`content_history_options` = '{"formFile":"administrator\/components\/com_db8sitedev\/models\/forms\/check.xml",
	"hideFields":["checked_out","checked_out_time","params","language"], "ignoreChanges":["modified_by", "modified",
	"checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"],
	"displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},
	{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},
	{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},
	{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},
	{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}'
WHERE (`type_alias` = 'com_db8sitedev.check');

UPDATE `#__content_types` SET
	`type_title` = 'Check Category', 
	`table` = '{"special":{"dbtable":"#__categories","key":"id","type":"Category","prefix":"JTable","config":"array()"},
	"common":   {"dbtable":"#__ucm_content","key":"ucm_id","type":"Corecontent","prefix":"JTable","config":"array()"}}',
	`field_mappings` = '{"common":{"core_content_item_id":"id","core_title":"title","core_state":"published",
	"core_alias":"alias","core_created_time":"created_time","core_modified_time":"modified_time","core_body":"description",
	"core_hits":"hits","core_publish_up":"null","core_publish_down":"null","core_access":"access", "core_params":"params",
	"core_featured":"null", "core_metadata":"metadata", "core_language":"language", "core_images":"null", "core_urls":"null",
	"core_version":"version", "core_ordering":"null", "core_metakey":"metakey", "core_metadesc":"metadesc",
	"core_catid":"parent_id", "core_xreference":"null", "asset_id":"asset_id"}, "special":{"parent_id":"parent_id",
	"lft":"lft","rgt":"rgt","level":"level","path":"path","extension":"extension","note":"note"}}',
	`router` = 'db8 Site DevRouter::getCategoryRoute',
	`content_history_options` = '{"formFile":"administrator\/components\/com_categories\/models\/forms\/category.xml",
	"hideFields":["asset_id","checked_out","checked_out_time","version","lft","rgt","level","path","extension"],
	"ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time", "version", "hits", "path"],
	"convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"created_user_id",
	"targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access",
	"targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_user_id",
	"targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"parent_id",
	"targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}]}'
WHERE (`type_alias` = 'com_db8sitedev.category');

INSERT INTO `#__content_types` (`type_title`, `type_alias`, `table`, `field_mappings`, `router`, `content_history_options`)
SELECT * FROM ( SELECT 'Check Category','com_db8sitedev.category','{"special":{"dbtable":"#__categories","key":"id",
  "type":"Category","prefix":"JTable","config":"array()"},"common":   {"dbtable":"#__ucm_content","key":"ucm_id",
  "type":"Corecontent","prefix":"JTable","config":"array()"}}', '{"common":{"core_content_item_id":"id",
  "core_title":"title","core_state":"published","core_alias":"alias","core_created_time":"created_time",
  "core_modified_time":"modified_time","core_body":"description", "core_hits":"hits","core_publish_up":"null",
  "core_publish_down":"null","core_access":"access", "core_params":"params", "core_featured":"null",
  "core_metadata":"metadata", "core_language":"language", "core_images":"null", "core_urls":"null",
  "core_version":"version", "core_ordering":"null", "core_metakey":"metakey", "core_metadesc":"metadesc",
  "core_catid":"parent_id", "core_xreference":"null", "asset_id":"asset_id"}, "special":{"parent_id":"parent_id",
  "lft":"lft","rgt":"rgt","level":"level","path":"path","extension":"extension","note":"note"}}',
  'db8 Site DevRouter::getCategoryRoute', '{"formFile":"administrator\/components\/com_categories\/models\/forms\/category.xml",
  "hideFields":["asset_id","checked_out","checked_out_time","version","lft","rgt","level","path","extension"],
  "ignoreChanges":["modified_user_id", "modified_time", "checked_out", "checked_out_time", "version", "hits", "path"],
  "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"created_user_id","targetTable":"#__users",
  "targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id",
  "displayColumn":"title"},{"sourceColumn":"modified_user_id","targetTable":"#__users","targetColumn":"id",
  "displayColumn":"name"},{"sourceColumn":"parent_id","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"}]}')
	AS tmp
WHERE NOT EXISTS (
	SELECT type_alias FROM `#__content_types` WHERE (`type_alias` = 'com_db8sitedev.category')
) LIMIT 1;
